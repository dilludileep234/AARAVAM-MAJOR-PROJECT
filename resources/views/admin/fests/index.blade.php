@extends(auth('admin')->user()->role === 'super_admin' ? 'layouts.admin' : 'layouts.category')

@section('title', 'Fest Management')

@section('content')
<div class="p-4 md:p-8">
    <div class="mb-12">
        <h1 class="text-4xl font-black text-white mb-2 tracking-tight">Fest Management Hub</h1>
        <p class="text-slate-400">Select a festival category to manage its events and participants.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Sports Card -->
        <a href="{{ route('admin.fests.show', 'sports') }}" class="group relative overflow-hidden glass-card p-1 hover:border-cyan-500/50 transition-all duration-500 hover:scale-[1.02]">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-600/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <div class="relative p-8">
                <div class="w-14 h-14 rounded-2xl bg-blue-500/20 flex items-center justify-center text-blue-400 mb-6 group-hover:scale-110 transition-transform duration-500">
                    <i class="fas fa-running text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Arena</h3>
                <p class="text-sm text-slate-500 mb-6">Manage track events, football, cricket, and athletics competitions.</p>
                <div class="flex items-center text-cyan-400 text-xs font-bold uppercase tracking-widest gap-2">
                    Open Dashboard <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </div>
            </div>
        </a>

        <!-- Arts Card -->
        <a href="{{ route('admin.fests.show', 'arts') }}" class="group relative overflow-hidden glass-card p-1 hover:border-purple-500/50 transition-all duration-500 hover:scale-[1.02]">
            <div class="absolute inset-0 bg-gradient-to-br from-purple-600/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <div class="relative p-8">
                <div class="w-14 h-14 rounded-2xl bg-purple-500/20 flex items-center justify-center text-purple-400 mb-6 group-hover:scale-110 transition-transform duration-500">
                    <i class="fas fa-palette text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Utsav</h3>
                <p class="text-sm text-slate-500 mb-6">Coordinate dance, music, painting, and stage performance events.</p>
                <div class="flex items-center text-cyan-400 text-xs font-bold uppercase tracking-widest gap-2">
                    Open Dashboard <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </div>
            </div>
        </a>

        <!-- Soft Skills Card -->
        <a href="{{ route('admin.fests.show', 'softskill') }}" class="group relative overflow-hidden glass-card p-1 hover:border-amber-500/50 transition-all duration-500 hover:scale-[1.02]">
            <div class="absolute inset-0 bg-gradient-to-br from-amber-600/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <div class="relative p-8">
                <div class="w-14 h-14 rounded-2xl bg-amber-500/20 flex items-center justify-center text-amber-400 mb-6 group-hover:scale-110 transition-transform duration-500">
                    <i class="fas fa-lightbulb text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Elevate</h3>
                <p class="text-sm text-slate-500 mb-6">Manage workshops, leadership training, and personality development sessions.</p>
                <div class="flex items-center text-cyan-400 text-xs font-bold uppercase tracking-widest gap-2">
                    Open Dashboard <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </div>
            </div>
        </a>

        <!-- Tech Card -->
        <a href="{{ route('admin.fests.show', 'algorithm') }}" class="group relative overflow-hidden glass-card p-1 hover:border-emerald-500/50 transition-all duration-500 hover:scale-[1.02]">
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-600/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <div class="relative p-8">
                <div class="w-14 h-14 rounded-2xl bg-emerald-500/20 flex items-center justify-center text-emerald-400 mb-6 group-hover:scale-110 transition-transform duration-500">
                    <i class="fas fa-code text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Algorythm</h3>
                <p class="text-sm text-slate-500 mb-6">Oversee coding competitions, robo-wars, hackathons, and gaming fests.</p>
                <div class="flex items-center text-cyan-400 text-xs font-bold uppercase tracking-widest gap-2">
                    Open Dashboard <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </div>
            </div>
        </a>

        <!-- Cultural Card -->
        <a href="{{ route('admin.fests.show', 'cultural') }}" class="group relative overflow-hidden glass-card p-1 hover:border-rose-500/50 transition-all duration-500 hover:scale-[1.02]">
            <div class="absolute inset-0 bg-gradient-to-br from-rose-600/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <div class="relative p-8">
                <div class="w-14 h-14 rounded-2xl bg-rose-500/20 flex items-center justify-center text-rose-400 mb-6 group-hover:scale-110 transition-transform duration-500">
                    <i class="fas fa-theater-masks text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Cultural Fest</h3>
                <p class="text-sm text-slate-500 mb-6">Manage traditional programs, community celebrations, and guest events.</p>
                <div class="flex items-center text-cyan-400 text-xs font-bold uppercase tracking-widest gap-2">
                    Open Dashboard <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </div>
            </div>
        </a>

        <!-- Add Category Placeholder -->
        <div class="group relative overflow-hidden rounded-[1.5rem] border-2 border-dashed border-white/5 p-8 flex flex-col items-center justify-center text-center opacity-50 hover:opacity-100 transition-opacity">
            <div class="w-14 h-14 rounded-full bg-white/5 flex items-center justify-center text-slate-400 mb-4">
                <i class="fas fa-plus"></i>
            </div>
            <h3 class="text-lg font-bold text-white mb-1">New Category</h3>
            <p class="text-xs text-slate-500">Dynamically load categories from events table.</p>
        </div>
    </div>
</div>
@endsection
