<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Registration;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    private function checkSuperAdmin()
    {
        if (auth('admin')->user()->role !== 'super_admin') {
            abort(403, 'Unauthorized access to student management.');
        }
    }

    public function index(Request $request)
    {
        $this->checkSuperAdmin();
        
        $search = $request->get('search');
        
        // Active Students (Pending & Approved)
        $activeQuery = User::whereIn('status', ['pending', 'approved']);
        if ($search) {
            $activeQuery->where(function($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        $students = $activeQuery->latest()->get();

        // Revoked Students (Rejected)
        $revokedQuery = User::where('status', 'rejected');
        if ($search) {
            $revokedQuery->where(function($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        $revokedStudents = $revokedQuery->latest()->get();

        // Removed Students (Soft Deleted)
        $removedQuery = User::onlyTrashed();
        if ($search) {
            $removedQuery->where(function($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        $removedStudents = $removedQuery->latest()->get();

        // Stats for Overview Grid
        $admin = auth('admin')->user();
        $totalRegistrations = User::withTrashed()->count();
        $totalEvents = \App\Models\Event::count();
        $verifiedStudents = User::where('status', 'approved')->count();
        $pendingApprovals = User::where('status', 'pending')->count();
        $revokedRegistrations = User::where('status', 'rejected')->count();
        $removedCount = User::onlyTrashed()->count();
        $isSuper = $admin->role === 'super_admin';

        return view('admin.students.index', compact(
            'students', 
            'revokedStudents', 
            'removedStudents',
            'totalRegistrations', 
            'totalEvents', 
            'verifiedStudents', 
            'pendingApprovals', 
            'revokedRegistrations', 
            'removedCount',
            'isSuper'
        ));
    }

    public function show($id)
    {
        $this->checkSuperAdmin();
        $student = User::withTrashed()->findOrFail($id);
        return view('admin.students.show', compact('student'));
    }

    public function destroy(User $student)
    {
        $this->checkSuperAdmin();
        $student->delete();
        return back()->with('success', 'Student removed successfully (Soft Deleted).');
    }

    public function restore($id)
    {
        $this->checkSuperAdmin();
        $student = User::onlyTrashed()->findOrFail($id);
        $student->restore();
        return back()->with('success', 'Student restored successfully.');
    }

    public function forceDelete($id)
    {
        $this->checkSuperAdmin();
        $student = User::withTrashed()->findOrFail($id);
        $student->forceDelete();
        return back()->with('success', 'Student permanently deleted.');
    }

    public function approve(User $student)
    {
        $this->checkSuperAdmin();
        $student->update(['status' => 'approved']);
        return back()->with('success', 'Student approved successfully.');
    }

    public function reject(User $student)
    {
        $this->checkSuperAdmin();
        $student->update(['status' => 'rejected']);
        return back()->with('success', 'Student access revoked (Rejected).');
    }
    public function export()
    {
        $this->checkSuperAdmin();
        $students = User::withTrashed()->latest()->get();

        $callback = function() use ($students) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Username', 'Email', 'Status', 'Joined Date', 'Deleted At']);

            foreach ($students as $student) {
                fputcsv($file, [
                    $student->id,
                    $student->username,
                    $student->email,
                    ucfirst($student->status),
                    $student->created_at->format('Y-m-d'),
                    $student->deleted_at ? $student->deleted_at->format('Y-m-d') : 'Active'
                ]);
            }
            fclose($file);
        };

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="student_directory_' . date('Y-m-d') . '.csv"',
        ];

        return response()->stream($callback, 200, $headers);
    }
}
