<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AcademicCalendar;
use App\Models\Setting;

class AcademicCalendarController extends Controller
{
    private function checkSuperAdmin()
    {
        if (auth('admin')->user()->role !== 'super_admin') {
            abort(403, 'Unauthorized access to academic calendar.');
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = AcademicCalendar::orderBy('date', 'asc')->get();
        
        // Stats for Overview Grid
        $totalRegistrations = \App\Models\Registration::count();
        $totalEvents = \App\Models\Event::count();
        $verifiedStudents = \App\Models\Registration::where('status', 'approved')->count();
        $pendingApprovals = \App\Models\Registration::where('status', 'pending')->count();
        $revokedRegistrations = \App\Models\Registration::where('status', 'rejected')->count();
        $isSuper = true;

        return view('admin.academic-calendar.index', compact(
            'events', 'totalRegistrations', 'totalEvents', 'verifiedStudents', 'pendingApprovals', 'revokedRegistrations', 'isSuper'
        ));
    }

    /**
     * Show the calendar configuration page.
     */
    public function settings()
    {
        $this->checkSuperAdmin();
        $settings = [
            'academic_year' => Setting::getVal('academic_year', date('Y') . '-' . (date('Y') + 1)),
            'calendar_start_date' => Setting::getVal('calendar_start_date', date('Y') . '-11-01'),
            'calendar_title' => Setting::getVal('calendar_title', 'S6 Academic Calendar'),
        ];
        return view('admin.academic-calendar.settings', compact('settings'));
    }

    /**
     * Update calendar configuration.
     */
    public function updateSettings(Request $request)
    {
        $this->checkSuperAdmin();
        $request->validate([
            'academic_year' => 'required|string|max:50',
            'calendar_start_date' => 'required|date',
            'calendar_title' => 'required|string|max:255',
        ]);

        Setting::setVal('academic_year', $request->academic_year);
        Setting::setVal('calendar_start_date', $request->calendar_start_date);
        Setting::setVal('calendar_title', $request->calendar_title);

        return redirect()->route('admin.academic-calendar.index')->with('success', 'Calendar settings updated successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->checkSuperAdmin();
        return view('admin.academic-calendar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->checkSuperAdmin();
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'type' => 'required|string|in:event,exam,holiday,other',
            'description' => 'nullable|string',
        ]);

        AcademicCalendar::create($request->all());

        return redirect()->route('admin.academic-calendar.index')->with('success', 'Calendar event created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AcademicCalendar $academicCalendar)
    {
        $this->checkSuperAdmin();
        return view('admin.academic-calendar.edit', ['event' => $academicCalendar]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AcademicCalendar $academicCalendar)
    {
        $this->checkSuperAdmin();
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'type' => 'required|string|in:event,exam,holiday,other',
            'description' => 'nullable|string',
        ]);

        $academicCalendar->update($request->all());

        return redirect()->route('admin.academic-calendar.index')->with('success', 'Calendar event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademicCalendar $academicCalendar)
    {
        $this->checkSuperAdmin();
        $academicCalendar->delete();

        return redirect()->route('admin.academic-calendar.index')->with('success', 'Calendar event deleted successfully.');
    }
}
