<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Registration;
use App\Models\User;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $admin = auth('admin')->user();
        if ($admin->role !== 'super_admin') {
            return redirect()->route('category.dashboard');
        }

        $isSuper = true;
        // Global Stats
        $totalRegistrations = Registration::count();
        $totalEvents = Event::count();
        $verifiedStudents = Registration::where('status', 'approved')->count();
        $pendingApprovals = Registration::where('status', 'pending')->count();
        $revokedRegistrations = Registration::where('status', 'rejected')->count();

        // 2. Registration Trends (Last 7 Days)
        $registrationTrends = Registration::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', Carbon::now()->subDays(6))
            ->groupBy('date')->orderBy('date', 'ASC')->get();

        $trendLabels = []; $trendData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $trendLabels[] = Carbon::now()->subDays($i)->format('M d');
            $record = $registrationTrends->firstWhere('date', $date);
            $trendData[] = $record ? $record->count : 0;
        }

        $eventDistribution = Event::select('category', DB::raw('count(*) as count'))
            ->groupBy('category')->pluck('count', 'category');
        $categoryLabels = $eventDistribution->keys();
        $categoryData = $eventDistribution->values();

        $recentRegistrations = Registration::withCount('items')->latest()->take(5)->get();

        return view('admin-dashboard', compact(
            'totalRegistrations', 'totalEvents', 'verifiedStudents', 'pendingApprovals', 'revokedRegistrations',
            'trendLabels', 'trendData', 'categoryLabels', 'categoryData', 'recentRegistrations', 'isSuper'
        ));
    }

    public function categoryIndex()
    {
        $admin = auth('admin')->user();
        if ($admin->role === 'super_admin') {
            return redirect()->route('admin.dashboard');
        }

        $isSuper = false;
        $category = $admin->category_access;

        // Category Stats
        $totalRegistrations = Registration::whereHas('items.event', function($q) use ($category) {
            $q->where('category', $category);
        })->count();
        $totalEvents = Event::where('category', $category)->count();
        $verifiedStudents = Registration::where('status', 'approved')->whereHas('items.event', function($q) use ($category) {
            $q->where('category', $category);
        })->count();
        $pendingApprovals = Registration::where('status', 'pending')->whereHas('items.event', function($q) use ($category) {
            $q->where('category', $category);
        })->count();
        $revokedRegistrations = Registration::where('status', 'rejected')->whereHas('items.event', function($q) use ($category) {
            $q->where('category', $category);
        })->count();

        // Trends
        $registrationTrends = Registration::whereHas('items.event', function($q) use ($category) {
            $q->where('category', $category);
        })->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', Carbon::now()->subDays(6))
            ->groupBy('date')->orderBy('date', 'ASC')->get();

        $trendLabels = []; $trendData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $trendLabels[] = Carbon::now()->subDays($i)->format('M d');
            $record = $registrationTrends->firstWhere('date', $date);
            $trendData[] = $record ? $record->count : 0;
        }

        $eventDistribution = Event::where('category', $category)
            ->select(DB::raw('COALESCE(sub_category, "Uncategorized") as sub_category_name'), DB::raw('count(*) as count'))
            ->groupBy(DB::raw('COALESCE(sub_category, "Uncategorized")'))
            ->pluck('count', 'sub_category_name');
        $categoryLabels = $eventDistribution->keys();
        $categoryData = $eventDistribution->values();

        $recentRegistrations = Registration::withCount('items')->whereHas('items.event', function($q) use ($category) {
            $q->where('category', $category);
        })->latest()->take(5)->get();

        $categoryEvents = Event::where('category', $category)->latest()->take(5)->get();

        $categoryDisplayName = [
            'softskill' => 'Soft Skills',
            'Algorithm' => 'Algorithm',
            'Cultural' => 'Cultural',
            'Sports' => 'Sports',
            'Arts' => 'Arts'
        ][$category] ?? $category;

        return view('category-dashboard', compact(
            'totalRegistrations', 'totalEvents', 'verifiedStudents', 'pendingApprovals', 'revokedRegistrations',
            'trendLabels', 'trendData', 'categoryLabels', 'categoryData', 'recentRegistrations', 'isSuper', 'category', 'categoryEvents', 'categoryDisplayName'
        ));
    }
}
