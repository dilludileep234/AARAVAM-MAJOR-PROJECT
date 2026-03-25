<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Event::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $admin = auth('admin')->user();
        if ($admin->role !== 'super_admin') {
            $query->where('category', $admin->category_access);
        } else {
            // Category filter for super admin
            if ($request->has('category') && $request->category != '') {
                $query->where('category', $request->category);
            }
        }

        // Pagination
        $events = $query->latest()->paginate(10);
        
        $categories = Event::distinct()->pluck('category');

        $admin = auth('admin')->user();
        $category = $admin->role !== 'super_admin' ? $admin->category_access : $request->get('category');
        
        $statQuery = \App\Models\Registration::query();
        if ($category) {
            $statQuery->whereHas('items.event', function($q) use ($category) {
                $q->where('category', $category);
            });
        }
        
        $totalRegistrations = $statQuery->count();
        $totalEvents = Event::when($category, function($q) use ($category) {
            $q->where('category', $category);
        })->count();
        $verifiedStudents = (clone $statQuery)->where('status', 'approved')->count();
        $pendingApprovals = (clone $statQuery)->where('status', 'pending')->count();
        $revokedRegistrations = (clone $statQuery)->where('status', 'rejected')->count();
        $isSuper = $admin->role === 'super_admin';

        return view('admin.events.index', compact(
            'events', 'categories', 'totalRegistrations', 'totalEvents', 'verifiedStudents', 'pendingApprovals', 'revokedRegistrations', 'isSuper'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $admin = auth('admin')->user();
        $category = $request->get('category');
        
        if ($admin->role !== 'super_admin') {
            $category = $admin->category_access;
        }

        return view('admin.events.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'sub_category' => 'nullable|string',
            'description' => 'nullable|string',
            'fees' => 'nullable|numeric|min:0',
            'time' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $admin = auth('admin')->user();
        $data = $request->all();
        $data['fees'] = $data['fees'] ?? 0;

        if ($admin->role !== 'super_admin') {
            $data['category'] = $admin->category_access;
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('events', 'public');
            $data['image_path'] = $path;
        }

        Event::create($data);

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $admin = auth('admin')->user();
        if ($admin->role !== 'super_admin' && $admin->category_access !== $event->category) {
            abort(403, 'Unauthorized to view this event.');
        }
        return view('admin.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $admin = auth('admin')->user();
        if ($admin->role !== 'super_admin' && $admin->category_access !== $event->category) {
            abort(403, 'Unauthorized to edit this event.');
        }
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $admin = auth('admin')->user();
        if ($admin->role !== 'super_admin' && $admin->category_access !== $event->category) {
            abort(403, 'Unauthorized to update this event.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'sub_category' => 'nullable|string',
            'description' => 'nullable|string',
            'fees' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();
        $data['fees'] = $data['fees'] ?? 0;

        if ($admin->role !== 'super_admin') {
            $data['category'] = $admin->category_access;
        }

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($event->image_path) {
                Storage::disk('public')->delete($event->image_path);
            }
            $path = $request->file('image')->store('events', 'public');
            $data['image_path'] = $path;
        }

        $event->update($data);

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $admin = auth('admin')->user();
        if ($admin->role !== 'super_admin' && $admin->category_access !== $event->category) {
            abort(403, 'Unauthorized to delete this event.');
        }

        if ($event->image_path) {
            Storage::disk('public')->delete($event->image_path);
        }
        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully.');
    }
}
