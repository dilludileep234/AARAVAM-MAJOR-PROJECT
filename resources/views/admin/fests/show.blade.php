@extends(auth('admin')->user()->role === 'super_admin' ? 'layouts.admin' : 'layouts.category')

@section('title', $category . ' Management')

@section('content')
<div class="p-4 md:p-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <span class="px-2.5 py-1 bg-cyan-500/10 text-cyan-400 text-[10px] font-black uppercase tracking-widest rounded-lg border border-cyan-500/20">
                    {{ $category }} Hub
                </span>
                <span class="w-1.5 h-1.5 rounded-full bg-slate-800"></span>
                <p class="text-[10px] text-slate-500 font-bold uppercase tracking-[2px]">Sector Analytics Active</p>
            </div>
            <h1 class="text-4xl font-black text-white tracking-tight">{{ $category }} <span class="text-slate-500 font-light">Management Hub</span></h1>
        </div>
        <div class="flex gap-4">
            <a href="{{ route('admin.events.create', ['category' => $category]) }}" class="px-6 py-3 bg-cyan-600 hover:bg-cyan-500 text-white text-[10px] font-black uppercase tracking-[2px] rounded-2xl transition-all shadow-xl shadow-cyan-900/20 flex items-center gap-2">
                <i class="fas fa-plus"></i> Add Event
            </a>
            <a href="{{ route('admin.registrations.export', ['category' => $category]) }}" class="px-6 py-3 bg-white/5 hover:bg-white/10 text-white text-[10px] font-black uppercase tracking-[2px] rounded-2xl border border-white/5 transition-all flex items-center gap-2 text-center">
                <i class="fas fa-file-export"></i> Export Intelligence
            </a>
        </div>
    </div>

    <!-- Stats Grid -->
    @include('partials.admin-stats-grid')

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Popular Events -->
        <div class="glass-card p-0 overflow-hidden border-white/5">
            <div class="p-6 border-b border-white/5 flex justify-between items-center">
                <h3 class="text-sm font-black text-white uppercase tracking-widest">Popular Hub Modules</h3>
            </div>
            <div class="p-6 space-y-4">
                @forelse($popularEvents as $event)
                <div class="flex items-center justify-between p-4 bg-white/[0.02] border border-white/5 rounded-2xl hover:bg-white/[0.04] transition-all">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-cyan-600/20 flex items-center justify-center text-cyan-400 font-bold overflow-hidden border border-cyan-500/20">
                            @if($event->image_path)
                                <img src="{{ asset('storage/' . $event->image_path) }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-lg">{{ substr($event->name, 0, 1) }}</span>
                            @endif
                        </div>
                        <div>
                            <h4 class="text-xs font-black text-white uppercase tracking-tight">{{ $event->name }}</h4>
                            <p class="text-[10px] text-slate-500 font-bold uppercase">{{ $event->registrationItems->count() }} Submissions</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.events.show', $event->id) }}" class="p-2 text-slate-600 hover:text-cyan-400 transition-all">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
                @empty
                <div class="text-center py-12 text-slate-600">
                    <p class="text-xs font-bold uppercase tracking-[2px]">No modules detected in sector.</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="glass-card p-0 overflow-hidden border-white/5">
            <div class="p-6 border-b border-white/5 flex justify-between items-center">
                <h3 class="text-sm font-black text-white uppercase tracking-widest">Recent Activity Log</h3>
                <a href="{{ route('admin.registrations.index', ['category' => $category]) }}" class="text-[10px] font-black text-cyan-500 hover:text-cyan-400 uppercase tracking-widest">Audit Full Log &rarr;</a>
            </div>
            <div class="p-6 space-y-4">
                @forelse($recentRegistrations as $reg)
                <div class="flex items-center justify-between p-4 bg-white/[0.02] border border-white/5 rounded-2xl">
                    <div class="flex-1">
                        <h4 class="text-xs font-black text-white uppercase tracking-tight">{{ $reg->student_name }}</h4>
                        <div class="flex flex-wrap gap-2 mt-2">
                            @foreach($reg->items as $item)
                                <span class="px-2 py-0.5 bg-cyan-500/10 text-cyan-400 text-[9px] font-black uppercase rounded border border-cyan-500/10">{{ $item->event->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="text-right ml-4">
                        <span class="text-[10px] font-bold text-slate-600 uppercase">{{ $reg->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                @empty
                <div class="text-center py-12 text-slate-600">
                    <p class="text-xs font-bold uppercase tracking-[2px]">No recent activity logged.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
