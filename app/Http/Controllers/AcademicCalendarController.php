<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AcademicCalendar;
use App\Models\Setting;

class AcademicCalendarController extends Controller
{
    public function index()
    {
        $settings = [
            'academic_year' => Setting::getVal('academic_year', '2025-2026'),
            'calendar_start_date' => Setting::getVal('calendar_start_date', '2025-11-01'),
            'calendar_title' => Setting::getVal('calendar_title', 'S6 Academic Calendar'),
        ];
        
        $events = AcademicCalendar::orderBy('date', 'asc')->get();
        return view('calendar', compact('events', 'settings'));
    }
}
