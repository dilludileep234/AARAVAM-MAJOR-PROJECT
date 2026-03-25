<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Registration;
use App\Models\RegistrationItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FestManagementController extends Controller
{
    /**
     * Display an overview of all fests.
     */
    public function index()
    {
        $admin = auth('admin')->user();
        if ($admin->role !== 'super_admin') {
            return redirect()->route('admin.fests.show', strtolower($admin->category_access));
        }
        $categories = Event::select('category')->distinct()->get();
        return view('admin.fests.index', compact('categories'));
    }

    /**
     * Display a dashboard for a specific fest category.
     */
    public function show($category)
    {
        // Category normalization (matching DB values)
        $categoryMap = [
            'sports' => 'Sports',
            'arts' => 'Arts',
            'softskill' => 'softskill',
            'algorithm' => 'Algorithm',
            'cultural' => 'Cultural'
        ];

        $dbCategory = $categoryMap[strtolower($category)] ?? $category;

        // Authorization check
        $admin = auth('admin')->user();
        if ($admin->role !== 'super_admin' && $admin->category_access !== $dbCategory) {
            abort(403, 'Unauthorized access to this festival category.');
        }
        
        // Metrics
        $totalEvents = Event::where('category', $dbCategory)->count();
        
        $totalParticipants = DB::table('registration_items')
            ->join('events', 'registration_items.event_id', '=', 'events.id')
            ->join('registrations', 'registration_items.registration_id', '=', 'registrations.id')
            ->where('events.category', $dbCategory)
            ->distinct('registrations.user_id')
            ->count('registrations.user_id');

        $totalRevenue = DB::table('registration_items')
            ->join('events', 'registration_items.event_id', '=', 'events.id')
            ->where('events.category', $dbCategory)
            ->sum('events.fees');

        // Popular Events
        $popularEvents = Event::where('category', $dbCategory)
            ->withCount('registrationItems')
            ->orderBy('registration_items_count', 'desc')
            ->take(5)
            ->get();

        // Recent Registrations for this category
        $recentRegistrations = Registration::whereHas('items.event', function($query) use ($dbCategory) {
            $query->where('category', $dbCategory);
        })
        ->with(['items' => function($q) use ($dbCategory) {
            $q->whereHas('event', function($ev) use ($dbCategory) {
                $ev->where('category', $dbCategory);
            })->with('event');
        }])
        ->latest()
        ->take(10)
        ->get();

        // Standardized Metrics for Overview Grid
        $statQuery = Registration::whereHas('items.event', function($q) use ($dbCategory) {
            $q->where('category', $dbCategory);
        });
        
        $totalRegistrations = (clone $statQuery)->count();
        $totalEvents = Event::where('category', $dbCategory)->count();
        $verifiedStudents = (clone $statQuery)->where('status', 'approved')->count();
        $pendingApprovals = (clone $statQuery)->where('status', 'pending')->count();
        $revokedRegistrations = (clone $statQuery)->where('status', 'rejected')->count();
        $isSuper = $admin->role === 'super_admin';

        return view('admin.fests.show', [
            'category' => $dbCategory,
            'slug' => strtolower($category),
            'totalEvents' => $totalEvents,
            'totalParticipants' => $totalParticipants,
            'totalRevenue' => $totalRevenue,
            'popularEvents' => $popularEvents,
            'recentRegistrations' => $recentRegistrations,
            'totalRegistrations' => $totalRegistrations,
            'verifiedStudents' => $verifiedStudents,
            'pendingApprovals' => $pendingApprovals,
            'revokedRegistrations' => $revokedRegistrations,
            'isSuper' => $isSuper
        ]);
    }
}
