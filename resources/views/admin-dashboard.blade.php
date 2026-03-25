@extends('layouts.admin')

@section('content')
<div class="space-y-10">
    <!-- Header with Welcom Message -->
    <div>
        <h1 class="text-3xl font-black text-white tracking-tight">Executive Dashboard</h1>
        <p class="text-slate-500 text-sm mt-1">Real-time oversight of festival operations and participant engagement.</p>
    </div>

    <!-- Stats Grid -->
    @include('partials.admin-stats-grid')

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="glass-card p-8 lg:col-span-2">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-lg font-bold text-white">Engagement Velocity</h3>
                <div class="flex gap-2 text-[10px] font-bold">
                    <span class="flex items-center gap-1.5 px-3 py-1 bg-white/5 rounded-full text-slate-400 border border-white/5">Daily Snapshots</span>
                </div>
            </div>
            <div class="h-72">
                <canvas id="registrationChart"></canvas>
            </div>
        </div>

        <div class="glass-card p-8">
            <h3 class="text-lg font-bold text-white mb-8">Market Separation</h3>
            <div class="h-72">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
        <!-- Quick Actions -->
        <div class="lg:col-span-2 flex flex-col gap-6">
            <h2 class="text-xl font-black text-white px-2 tracking-tight">Rapid Deployment</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="{{ route('admin.events.create') }}" class="glass-card p-6 hover:bg-blue-600/5 transition-all flex items-center gap-5 group">
                    <div class="w-12 h-12 rounded-2xl bg-blue-600/10 flex items-center justify-center text-blue-500 group-hover:scale-110 transition-transform">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-white">Create Item</p>
                        <p class="text-[10px] text-slate-500 font-medium">Add new event module</p>
                    </div>
                </a>
                <a href="{{ route('admin.registrations.index') }}" class="glass-card p-6 hover:bg-emerald-600/5 transition-all flex items-center gap-5 group">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-600/10 flex items-center justify-center text-emerald-500 group-hover:scale-110 transition-transform">
                        <i class="fas fa-file-invoice"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-white">Audit Log</p>
                        <p class="text-[10px] text-slate-500 font-medium">Review registrations</p>
                    </div>
                </a>
                @if($isSuper)
                <a href="{{ route('admin.manage') }}" class="glass-card p-6 hover:bg-purple-600/5 transition-all flex items-center gap-5 group">
                    <div class="w-12 h-12 rounded-2xl bg-purple-600/10 flex items-center justify-center text-purple-600 group-hover:scale-110 transition-transform">
                        <i class="fas fa-user-lock"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-white">Access Control</p>
                        <p class="text-[10px] text-slate-500 font-medium">Manage administrators</p>
                    </div>
                </a>
                @endif
                <a href="{{ route('admin.fests.index') }}" class="glass-card p-6 hover:bg-amber-600/5 transition-all flex items-center gap-5 group">
                    <div class="w-12 h-12 rounded-2xl bg-amber-600/10 flex items-center justify-center text-amber-500 group-hover:scale-110 transition-transform">
                        <i class="fas fa-list-check"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-white">Inventory</p>
                        <p class="text-[10px] text-slate-500 font-medium">Manage all modules</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Recent Activity Table-like style -->
        <div class="lg:col-span-3">
            <div class="flex justify-between items-center mb-6 px-2">
                <h2 class="text-xl font-black text-white tracking-tight">Recent Activity</h2>
                <a href="{{ route('admin.registrations.index') }}" class="text-[10px] font-black text-blue-500 uppercase tracking-widest hover:text-blue-400">Deep Audit &rarr;</a>
            </div>
            
            <div class="glass-card overflow-hidden">
                <div class="space-y-0.5">
                    @forelse($recentRegistrations as $reg)
                    <div class="p-4 hover:bg-white/[0.02] border-b border-white/5 last:border-0 flex items-center justify-between transition-all group">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-slate-800 border border-white/10 flex items-center justify-center text-xs font-black text-slate-400 group-hover:border-blue-500/50 group-hover:text-blue-400 transition-all">
                                {{ substr($reg->student_name, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-sm font-bold text-white tracking-tight">{{ $reg->student_name }}</p>
                                <p class="text-[10px] text-slate-500 uppercase font-black tracking-tighter">{{ $reg->department }} • {{ $reg->items_count }} Events</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-6">
                            <div class="text-right hidden sm:block">
                                <p class="text-[10px] font-bold text-slate-600">{{ $reg->created_at->diffForHumans() }}</p>
                                <p class="text-[9px] text-slate-700 font-black uppercase tracking-widest">Logged Session</p>
                            </div>
                            <span class="w-20 text-center py-1 bg-white/5 border border-white/10 text-[9px] font-black uppercase tracking-widest rounded-full text-slate-400">
                                {{ $reg->status }}
                            </span>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-16">
                        <i class="fas fa-ghost text-slate-800 text-4xl mb-4"></i>
                        <p class="text-slate-600 text-sm font-bold">Zero recent data detected</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Common Chart Options
    Chart.defaults.color = '#94a3b8';
    Chart.defaults.borderColor = 'rgba(255, 255, 255, 0.1)';

    // Registration Trends Chart
    const ctxTrend = document.getElementById('registrationChart').getContext('2d');
    new Chart(ctxTrend, {
        type: 'line',
        data: {
            labels: {!! json_encode($trendLabels) !!},
            datasets: [{
                label: 'New Registrations',
                data: {!! json_encode($trendData) !!},
                borderColor: '#00f3ff',
                backgroundColor: 'rgba(0, 243, 255, 0.1)',
                borderWidth: 2,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#00f3ff',
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(255, 255, 255, 0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Category Distribution Chart
    const ctxCategory = document.getElementById('categoryChart').getContext('2d');
    new Chart(ctxCategory, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($categoryLabels) !!},
            datasets: [{
                data: {!! json_encode($categoryData) !!},
                backgroundColor: [
                    '#3b82f6', // Blue
                    '#8b5cf6', // Violet
                    '#10b981', // Emerald
                    '#f59e0b', // Amber
                    '#ef4444', // Red
                    '#ec4899'  // Pink
                ],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                }
            },
            cutout: '70%'
        }
    });
</script>
@endsection
