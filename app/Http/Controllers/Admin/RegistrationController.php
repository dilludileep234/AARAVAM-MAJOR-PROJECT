<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RegistrationController extends Controller
{
    /**
     * Export registrations as CSV.
     */
    public function export(Request $request)
    {
        $admin = auth('admin')->user();
        $status = $request->get('status');
        $category = $request->get('category');
        $query = Registration::with(['items.event'])->latest();
        
        if ($admin->role !== 'super_admin') {
            $category = $admin->category_access;
        }

        if ($status && in_array($status, ['pending', 'approved', 'rejected'])) {
            $query->where('status', $status);
        }

        if ($category) {
            $query->whereHas('items.event', function($q) use ($category) {
                $q->where('category', $category);
            });
        }

        $registrations = $query->get();

        $response = new StreamedResponse(function () use ($registrations, $category) {
            $handle = fopen('php://output', 'w');
            
            // CSV Headers
            fputcsv($handle, ['Student Name', 'Email', 'Reg No', 'Department', 'Semester', 'Event', 'Fees', 'Status', 'Date']);
            
            foreach ($registrations as $registration) {
                foreach($registration->items as $item) {
                    // If category is filtered, only export items from that category
                    if ($category && ($item->event->category ?? '') !== $category) {
                        continue;
                    }

                    fputcsv($handle, [
                        $registration->student_name,
                        $registration->email,
                        $registration->reg_no,
                        $registration->department,
                        $registration->semester,
                        $item->event->name ?? 'N/A',
                        $item->event->fees ?? 0,
                        $registration->status,
                        $registration->created_at->format('Y-m-d H:i')
                    ]);
                }
            }
            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $filenamePrefix = '';
        if ($category) $filenamePrefix .= strtolower($category) . '_';
        if ($status) $filenamePrefix .= $status . '_';
        
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $filenamePrefix . 'registrations_' . date('Y-m-d') . '.csv"');

        return $response;
    }
    /**
     * Display a listing of the registrations.
     */
    public function index(Request $request)
    {
        $admin = auth('admin')->user();
        $query = Registration::with(['items.event'])->latest();
        $category = $request->get('category');

        if ($admin->role !== 'super_admin') {
            $category = $admin->category_access;
        }

        if ($category) {
            $query->whereHas('items.event', function($q) use ($category) {
                $q->where('category', $category);
            });
        }

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('student_name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('reg_no', 'like', "%$search%");
            });
        }

        $allRegistrations = $query->get();
        
        $pendingRegistrations = $allRegistrations->where('status', 'pending');
        $approvedRegistrations = $allRegistrations->where('status', 'approved');
        $rejectedRegistrations = $allRegistrations->where('status', 'rejected');

        // Stats for Overview Grid
        $totalRegistrations = $allRegistrations->count();
        $totalEvents = \App\Models\Event::when($category, function($q) use ($category) {
            $q->where('category', $category);
        })->count();
        $verifiedStudents = $approvedRegistrations->count();
        $pendingApprovals = $pendingRegistrations->count();
        $revokedRegistrations = $rejectedRegistrations->count();
        $isSuper = $admin->role === 'super_admin';

        return view('admin.registrations.index', compact(
            'pendingRegistrations', 
            'approvedRegistrations', 
            'rejectedRegistrations',
            'category',
            'totalRegistrations',
            'totalEvents',
            'verifiedStudents',
            'pendingApprovals',
            'revokedRegistrations',
            'isSuper'
        ));
    }

    public function updateStatus(Request $request, Registration $registration)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected'
        ]);
        $admin = auth('admin')->user();
        if ($admin->role !== 'super_admin') {
            $hasAccess = $registration->items()->whereHas('event', function($q) use ($admin) {
                $q->where('category', $admin->category_access);
            })->exists();

            if (!$hasAccess) {
                abort(403, 'Unauthorized to manage this registration.');
            }
        }

        $registration->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Registration status updated to ' . ucfirst($request->status));
    }

    /**
     * Export an individual student's registration as CSV.
     */
    public function exportIndividual(Registration $registration)
    {
        $admin = auth('admin')->user();
        if ($admin->role !== 'super_admin') {
            $hasAccess = $registration->items()->whereHas('event', function($q) use ($admin) {
                $q->where('category', $admin->category_access);
            })->exists();

            if (!$hasAccess) {
                abort(403, 'Unauthorized to export this registration.');
            }
        }

        $callback = function() use ($registration) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Field', 'Value']);
            fputcsv($file, ['Student Name', $registration->student_name]);
            fputcsv($file, ['Email', $registration->email]);
            fputcsv($file, ['Reg No', $registration->reg_no]);
            fputcsv($file, ['Department', $registration->department]);
            fputcsv($file, ['Semester', $registration->semester]);
            fputcsv($file, ['Status', $registration->status]);
            fputcsv($file, ['Registration Date', $registration->created_at->format('Y-m-d H:i:s')]);
            fputcsv($file, []);
            fputcsv($file, ['Registered Events', 'Fees', 'Score', 'Rank']);

            foreach ($registration->items as $item) {
                fputcsv($file, [
                    $item->event->name ?? 'N/A',
                    $item->event->fees ?? 0,
                    $item->score ?? 'N/A',
                    $item->rank ?? 'N/A'
                ]);
            }
            fclose($file);
        };

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="registration_' . $registration->reg_no . '.csv"',
        ];

        return response()->stream($callback, 200, $headers);
    }
}
