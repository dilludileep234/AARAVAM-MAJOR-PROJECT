@extends('layouts.category')

@section('content')
<div class="p-6 md:p-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <span class="px-2.5 py-1 bg-cyan-500/10 text-cyan-400 text-[10px] font-black uppercase tracking-widest rounded-lg border border-cyan-500/20">
                    {{ $categoryDisplayName }} Sector
                </span>
                <span class="w-1.5 h-1.5 rounded-full bg-slate-800"></span>
                <p class="text-[10px] text-slate-500 font-bold uppercase tracking-[2px]">Clearance Active</p>
            </div>
            <h1 class="text-4xl font-black text-white tracking-tight">{{ $categoryDisplayName }} <span class="text-slate-500 font-light">Operations Center</span></h1>
        </div>
        <div class="text-left md:text-right">
            <p class="text-xs font-black text-white uppercase tracking-widest">{{ Auth::guard('admin')->user()->username }}</p>
            <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest mt-1">Designated Category Admin</p>
        </div>
    </div>

    <!-- Stats Grid -->
    @include('partials.admin-stats-grid')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        <!-- Event Management Action -->
        <div class="lg:col-span-1">
            <div class="glass-card p-8 bg-gradient-to-br from-slate-900 to-black border-white/5 h-full flex flex-col justify-between">
                <div>
                    <h2 class="text-xl font-black text-white tracking-tight mb-2">Sector Command</h2>
                    <p class="text-slate-500 text-xs leading-relaxed mb-6">Execute new protocols for the {{ $categoryDisplayName }} sector. All additions are logged under your clearance.</p>
                    
                    <div class="space-y-4 mb-8">
                        <div class="flex items-start gap-4 p-4 bg-white/[0.02] border border-white/5 rounded-2xl">
                            <div class="w-8 h-8 rounded-lg bg-cyan-500/10 flex items-center justify-center shrink-0">
                                <i class="fas fa-plus text-cyan-400 text-xs"></i>
                            </div>
                            <div>
                                <h4 class="text-[10px] font-black text-white uppercase tracking-widest mb-1">New Event Deployment</h4>
                                <p class="text-[9px] text-slate-500 uppercase font-bold">Add competition or activity</p>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="{{ route('admin.events.create') }}" class="w-full py-4 bg-cyan-600 hover:bg-cyan-500 text-white text-[10px] font-black uppercase tracking-[2px] rounded-2xl transition-all shadow-xl shadow-cyan-900/20 text-center flex items-center justify-center gap-3">
                    <span>Initiate Deployment</span>
                    <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
            </div>
        </div>

        <!-- Registration Activity -->
        <div class="lg:col-span-2">
            <div class="glass-card p-0 overflow-hidden border-white/5 h-full">
                <div class="p-6 border-b border-white/5 flex justify-between items-center">
                    <h3 class="text-sm font-black text-white uppercase tracking-widest">Recent Sector Activity</h3>
                    <a href="{{ route('admin.registrations.index') }}" class="text-[10px] font-black text-cyan-500 hover:text-cyan-400 uppercase tracking-widest">Global Audit &rarr;</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-white/[0.02] text-slate-500">
                                <th class="px-6 py-4 text-[9px] font-black uppercase tracking-widest">Personnel</th>
                                <th class="px-6 py-4 text-[9px] font-black uppercase tracking-widest">Assigned Dept</th>
                                <th class="px-6 py-4 text-[9px] font-black uppercase tracking-widest">Status</th>
                                <th class="px-6 py-4 text-[9px] font-black uppercase tracking-widest">Activity Log</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @forelse($recentRegistrations as $reg)
                            <tr class="hover:bg-white/[0.02] transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-slate-700 to-slate-900 border border-white/10 flex items-center justify-center text-[10px] font-black text-white">
                                            {{ substr($reg->student_name, 0, 1) }}
                                        </div>
                                        <p class="text-xs font-bold text-white tracking-tight">{{ $reg->student_name }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-[10px] text-slate-400 font-bold uppercase">{{ $reg->department }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 bg-blue-500/10 text-blue-400 text-[9px] font-black uppercase tracking-widest rounded-md border border-blue-500/20">
                                        {{ $reg->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-[10px] text-slate-500 font-medium italic">{{ $reg->created_at->diffForHumans() }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-slate-600 text-xs font-bold uppercase tracking-widest">No sector activity detected.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Category Events List -->
    <div class="glass-card p-0 overflow-hidden border-white/5 mb-8">
        <div class="p-6 border-b border-white/5 flex justify-between items-center">
            <h3 class="text-sm font-black text-white uppercase tracking-widest">{{ $categoryDisplayName }} Sector Events</h3>
            <a href="{{ route('admin.events.index') }}" class="text-[10px] font-black text-cyan-500 hover:text-cyan-400 uppercase tracking-widest">View All &rarr;</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-white/[0.02] text-slate-500">
                        <th class="px-6 py-4 text-[9px] font-black uppercase tracking-widest">Event Name</th>
                        <th class="px-6 py-4 text-[9px] font-black uppercase tracking-widest">Sub-Category</th>
                        <th class="px-6 py-4 text-[9px] font-black uppercase tracking-widest">Fees</th>
                        <th class="px-6 py-4 text-[9px] font-black uppercase tracking-widest">Created At</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($categoryEvents as $event)
                    <tr class="hover:bg-white/[0.02] transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-cyan-700 to-cyan-900 border border-white/10 flex items-center justify-center text-[10px] font-black text-white">
                                    {{ substr($event->name, 0, 1) }}
                                </div>
                                <p class="text-xs font-bold text-white tracking-tight">{{ $event->name }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-[10px] text-slate-400 font-bold uppercase">{{ $event->sub_category ?? 'N/A' }}</td>
                        <td class="px-6 py-4">
                            <span class="text-[10px] font-bold {{ $event->fees > 0 ? 'text-emerald-400' : 'text-slate-400' }}">
                                {{ $event->fees > 0 ? '₹' . $event->fees : 'Free' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-[10px] text-slate-500 font-medium italic">{{ $event->created_at->format('d M, Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-slate-600 text-xs font-bold uppercase tracking-widest">No events deployed in this sector.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
