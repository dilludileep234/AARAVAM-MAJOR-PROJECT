<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\RegistrationItem;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    /**
     * Display a listing of events to manage results.
     */
    public function index(Request $request)
    {
        $admin = auth('admin')->user();
        $query = Event::query();

        if ($admin->role !== 'super_admin') {
            $query->where('category', $admin->category_access);
        }

        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $events = $query->with(['registrationItems'])->withCount('registrationItems')->get();
        $categories = Event::select('category')->distinct()->pluck('category');

        return view('admin.results.index', compact('events', 'categories'));
    }

    /**
     * Show the form for editing results for a specific event.
     */
    public function edit(Event $event)
    {
        $admin = auth('admin')->user();
        if ($admin->role !== 'super_admin' && $admin->category_access !== $event->category) {
            abort(403, 'Unauthorized access to this event.');
        }

        $items = RegistrationItem::where('event_id', $event->id)
            ->with('registration')
            ->whereHas('registration', function($q) {
                $q->where('status', 'approved');
            })
            ->get();

        return view('admin.results.edit', compact('event', 'items'));
    }

    /**
     * Update the results for a specific event.
     */
    public function update(Request $request, Event $event)
    {
        $admin = auth('admin')->user();
        if ($admin->role !== 'super_admin' && $admin->category_access !== $event->category) {
            abort(403, 'Unauthorized access to this event.');
        }

        $results = $request->input('results', []);

        foreach ($results as $itemId => $data) {
            RegistrationItem::where('id', $itemId)
                ->where('event_id', $event->id)
                ->update([
                    'score' => $data['score'] ?? null,
                    'rank' => $data['rank'] ?? null,
                ]);
        }

        return redirect()->route('admin.results.index')->with('success', 'Results updated successfully for ' . $event->name);
    }

    /**
     * Export results for a specific event as CSV.
     */
    public function export(Event $event)
    {
        $admin = auth('admin')->user();
        if ($admin->role !== 'super_admin' && $admin->category_access !== $event->category) {
            abort(403, 'Unauthorized access to this event.');
        }

        $items = RegistrationItem::where('event_id', $event->id)
            ->whereNotNull('rank')
            ->with('registration')
            ->orderByRaw("CAST(rank AS UNSIGNED) ASC")
            ->orderBy('score', 'desc')
            ->get();

        $callback = function() use ($items, $event) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Rank', 'Score', 'Student Name', 'Reg No', 'Department', 'Semester']);

            foreach ($items as $item) {
                fputcsv($file, [
                    $item->rank,
                    $item->score,
                    $item->registration->student_name,
                    $item->registration->reg_no,
                    $item->registration->department,
                    $item->registration->semester,
                ]);
            }
            fclose($file);
        };

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . str_replace(' ', '_', $event->name) . '_results_' . date('Y-m-d') . '.csv"',
        ];

        return response()->stream($callback, 200, $headers);
    }
    /**
     * Clear results for a specific event.
     */
    public function destroy(Event $event)
    {
        $admin = auth('admin')->user();
        if ($admin->role !== 'super_admin' && $admin->category_access !== $event->category) {
            abort(403, 'Unauthorized access to this event.');
        }

        RegistrationItem::where('event_id', $event->id)->update([
            'score' => null,
            'rank' => null,
        ]);

        return redirect()->route('admin.results.index')->with('success', 'Results cleared successfully for ' . $event->name);
    }
}
