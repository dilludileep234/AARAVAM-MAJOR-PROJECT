<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;

class RegistrationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'reg_no'       => 'required|string|max:50',
            'semester'     => 'required|string',
            'department'   => 'required|string',
            'email'        => 'required|email|max:255',
            'event_ids'    => 'required|array',
            'event_ids.*'  => 'exists:events,id',
        ]);

        $registration = Registration::create([
            'user_id'      => auth()->id(),
            'student_name' => $request->student_name,
            'reg_no'       => $request->reg_no,
            'semester'     => $request->semester,
            'department'   => $request->department,
            'email'        => $request->email,
            'status'       => 'pending',
        ]);

        foreach ($request->event_ids as $eventId) {
            \App\Models\RegistrationItem::create([
                'registration_id' => $registration->id,
                'event_id'        => $eventId,
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Registration successful!']);
    }
}
