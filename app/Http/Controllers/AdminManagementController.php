<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminManagementController extends Controller
{
    private function checkSuperAdmin()
    {
        if (auth('admin')->user()->role !== 'super_admin') {
            abort(403, 'Unauthorized access to admin management.');
        }
    }

    // Show pending admin approvals
    public function pendingAdmins()
    {
        $this->checkSuperAdmin();
        $pendingAdmins = Admin::where('status', 'pending')->orderBy('created_at', 'desc')->get();
        $approvedAdmins = Admin::where('status', 'approved')->orderBy('created_at', 'desc')->get();
        $rejectedAdmins = Admin::where('status', 'rejected')->orderBy('created_at', 'desc')->get();
        $deletedAdmins = Admin::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        
        // Stats for Overview Grid
        $totalRegistrations = \App\Models\Registration::count();
        $totalEvents = \App\Models\Event::count();
        $verifiedStudents = \App\Models\Registration::where('status', 'approved')->count();
        $pendingApprovals = \App\Models\Registration::where('status', 'pending')->count();
        $revokedRegistrations = \App\Models\Registration::where('status', 'rejected')->count();
        $isSuper = true;

        return view('admin.manage-admins', compact(
            'pendingAdmins', 'approvedAdmins', 'rejectedAdmins', 'deletedAdmins',
            'totalRegistrations', 'totalEvents', 'verifiedStudents', 'pendingApprovals', 'revokedRegistrations', 'isSuper'
        ));
    }

    // Approve admin
    public function approveAdmin($id)
    {
        $this->checkSuperAdmin();
        $admin = Admin::findOrFail($id);
        $admin->status = 'approved';
        $admin->save();

        return back()->with('success', 'Admin approved successfully!');
    }

    // Reject admin
    public function rejectAdmin($id)
    {
        $this->checkSuperAdmin();
        $admin = Admin::findOrFail($id);
        $admin->status = 'rejected';
        $admin->save();

        return back()->with('success', 'Admin rejected.');
    }

    // Delete admin (Soft Delete)
    public function deleteAdmin($id)
    {
        $this->checkSuperAdmin();
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return back()->with('success', 'Admin account terminated.');
    }

    // Restore admin
    public function restoreAdmin($id)
    {
        $this->checkSuperAdmin();
        $admin = Admin::onlyTrashed()->findOrFail($id);
        $admin->restore();

        return back()->with('success', 'Admin account restored.');
    }
}
