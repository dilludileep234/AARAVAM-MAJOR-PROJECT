<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\RegistrationItem;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    /**
     * Display the results page.
     */
    public function index(Request $request)
    {
        $categories = Event::select('category')
            ->whereRaw('LOWER(category) != ?', ['softskill'])
            ->distinct()
            ->pluck('category');
        $requestedCategory = $request->get('category');
        
        // Find the actual category name from DB cross-checking with request (case-insensitive)
        $selectedCategory = $categories->first(function($cat) use ($requestedCategory) {
            return strtolower($cat) === strtolower($requestedCategory);
        }) ?? ($categories->first() ?? 'Sports');

        $selectedEventId = $request->get('event_id');

        // Get all events in this category that have results for the dropdown
        $allEventsInCategory = Event::where('category', $selectedCategory)
            ->whereHas('registrationItems', function($query) {
                $query->whereNotNull('rank');
            })
            ->orderBy('name')
            ->get();

        $query = Event::where('category', $selectedCategory)
            ->whereHas('registrationItems', function($query) {
                $query->whereNotNull('rank');
            });

        if ($selectedEventId) {
            $query->where('id', $selectedEventId);
        }

        $events = $query->with(['registrationItems' => function($query) {
                $query->whereNotNull('rank')
                    ->with('registration')
                    ->orderByRaw("CAST(rank AS UNSIGNED) ASC")
                    ->orderBy('score', 'desc');
            }])
            ->get();

        return view('results', compact('categories', 'selectedCategory', 'events', 'allEventsInCategory', 'selectedEventId'));
    }

    /**
     * Download current user's personal results as CSV.
     */
    public function downloadMyResults()
    {
        $user = auth()->user();
        if (!$user) return redirect()->route('login');

        $registrations = \App\Models\Registration::where('user_id', $user->id)
            ->with(['items.event'])
            ->get();

        $firstReg = $registrations->first();
        $studentName = $firstReg ? $firstReg->student_name : $user->username;

        $callback = function() use ($registrations, $user, $studentName) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Aaravam Festival 2026 - Personal Result Sheet']);
            fputcsv($file, ['Student:', $studentName]);
            fputcsv($file, ['Email:', $user->email]);
            fputcsv($file, []);
            fputcsv($file, ['Event Name', 'Category', 'Status', 'Score', 'Rank']);

            foreach ($registrations as $reg) {
                foreach ($reg->items as $item) {
                    if (!$item->rank && $reg->status !== 'approved') continue;
                    
                    fputcsv($file, [
                        $item->event->name ?? 'N/A',
                        $item->event->category ?? 'N/A',
                        ucfirst($reg->status),
                        $item->score ?? 'N/A',
                        $item->rank ?? 'N/A'
                    ]);
                }
            }
            fclose($file);
        };

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="my_results_' . date('Y-m-d') . '.csv"',
        ];

        return response()->stream($callback, 200, $headers);
    }
    /**
     * Export absolute results for a category (Public view).
     */
    public function exportCategory(Request $request)
    {
        $category = $request->get('category', 'Arts');
        
        $items = RegistrationItem::whereHas('event', function($q) use ($category) {
                $q->where('category', $category);
            })
            ->whereNotNull('rank')
            ->with(['registration', 'event'])
            ->orderBy('event_id')
            ->orderByRaw("CAST(rank AS UNSIGNED) ASC")
            ->orderBy('score', 'desc')
            ->get();

        $callback = function() use ($items, $category) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Aaravam Festival 2026 - Category Winners: ' . $category]);
            fputcsv($file, ['Event Name', 'Rank', 'Score', 'Student Name', 'Department']);

            foreach ($items as $item) {
                fputcsv($file, [
                    $item->event->name ?? 'N/A',
                    $item->rank,
                    $item->score,
                    $item->registration->student_name,
                    $item->registration->department
                ]);
            }
            fclose($file);
        };

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . strtolower($category) . '_leaderboard_' . date('Y-m-d') . '.csv"',
        ];

        return response()->stream($callback, 200, $headers);
    }
    /**
     * Download a specific event's result for the current user.
     */
    public function exportSingleResult(RegistrationItem $item)
    {
        $user = auth()->user();
        if (!$user || $item->registration->user_id !== $user->id) {
            abort(403, 'Unauthorized access to this result.');
        }

        if (!$item->rank) {
            return back()->with('error', 'Result not yet published for this event.');
        }

        $callback = function() use ($item, $user) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Aaravam Festival 2026 - Performance Certificate Data']);
            fputcsv($file, ['Field', 'Details']);
            fputcsv($file, ['Student Name', $item->registration->student_name]);
            fputcsv($file, ['Reg No', $item->registration->reg_no]);
            fputcsv($file, ['Event Name', $item->event->name]);
            fputcsv($file, ['Category', $item->event->category]);
            fputcsv($file, ['Grand Score', $item->score ?? '0']);
            fputcsv($file, ['Final Rank', $item->rank]);
            fputcsv($file, ['Issue Date', date('Y-m-d H:i')]);
            fclose($file);
        };

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="result_' . str_replace(' ', '_', $item->event->name) . '.csv"',
        ];

        return response()->stream($callback, 200, $headers);
    }
}
