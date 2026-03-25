@extends(Auth::guard('admin')->user()->role == 'super_admin' ? 'layouts.admin' : 'layouts.category')

@section('title', 'Manage Results')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold text-white">Publish Results</h1>
</div>

<div class="glass-card mb-6 p-4">
    <form action="{{ route('admin.results.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
        <div class="flex-1 relative">
            <i class="fas fa-search absolute left-4 top-3.5 text-gray-400"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search events..." class="w-full bg-slate-900/50 border border-white/10 rounded-xl py-3 pl-12 pr-4 text-white focus:outline-none focus:border-cyan-500 transition">
        </div>
        @if(Auth::guard('admin')->user()->role == 'super_admin')
        <div class="w-full md:w-64">
            <select name="category" class="w-full bg-slate-900/50 border border-white/10 rounded-xl py-3 px-4 text-white focus:outline-none focus:border-cyan-500 transition appearance-none cursor-pointer" onchange="this.form.submit()">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>{{ $category }}</option>
                @endforeach
            </select>
        </div>
        @endif
        <button type="submit" class="bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-3 rounded-xl font-bold transition">
            Search
        </button>
    </form>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($events as $event)
    <div class="glass-card overflow-hidden group hover:border-cyan-500/30 transition-all duration-300">
        <div class="h-40 overflow-hidden relative">
            <img src="{{ $event->getDisplayImage() }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" onerror="this.src='{{ asset('images/default-event.png') }}';">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 to-transparent"></div>
            <div class="absolute bottom-4 left-4">
                <span class="px-2 py-1 bg-cyan-500/20 text-cyan-400 rounded text-[10px] font-bold uppercase tracking-wider border border-cyan-500/30">
                    {{ $event->category }}
                </span>
            </div>
        </div>
        <div class="p-5">
            <h3 class="text-lg font-bold text-white mb-2">{{ $event->name }}</h3>
            <div class="flex items-center justify-between text-sm text-slate-400 mb-6">
                <span><i class="fas fa-users mr-1"></i> {{ $event->registration_items_count }} Participants</span>
                <span><i class="fas fa-trophy mr-1 text-yellow-500/50"></i> Results</span>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.results.edit', $event) }}" class="flex-1 text-center bg-white/5 hover:bg-cyan-600 text-white py-3 rounded-xl font-bold transition-all border border-white/5 hover:border-cyan-500 active:scale-95 text-sm">
                    {{ $event->registrationItems->whereNotNull('rank')->count() > 0 ? 'Edit Results' : 'Enter Results' }}
                </a>
                <a href="{{ route('admin.results.export', $event) }}" class="w-12 flex items-center justify-center bg-slate-800 hover:bg-slate-700 text-cyan-400 py-3 rounded-xl border border-white/5 transition-all" title="Export CSV">
                    <i class="fas fa-file-csv text-lg"></i>
                </a>
                @if($event->registrationItems->whereNotNull('rank')->count() > 0)
                <form action="{{ route('admin.results.destroy', $event) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to clear all results for this event? This will remove all ranks and scores.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-12 flex items-center justify-center bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white py-3 rounded-xl border border-red-500/20 transition-all active:scale-95" title="Clear Results">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-full py-20 text-center">
        <div class="w-20 h-20 bg-slate-900 rounded-full flex items-center justify-center mx-auto mb-4 border border-white/5">
            <i class="fas fa-clipboard-list text-3xl text-slate-700"></i>
        </div>
        <h3 class="text-xl font-bold text-white mb-2">No Events Found</h3>
        <p class="text-slate-500">Try adjusting your search or category filters.</p>
    </div>
    @endforelse
</div>
@endsection
