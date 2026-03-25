@extends(Auth::guard('admin')->user()->role == 'super_admin' ? 'layouts.admin' : 'layouts.category')

@section('title', 'Manage Events')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold text-white">Competition Events</h1>
    <a href="{{ route('admin.events.create') }}" class="bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-3 rounded-xl font-bold flex items-center gap-2 transition active:scale-95 shadow-lg shadow-cyan-600/20">
        <i class="fas fa-plus"></i> Add New Event
    </a>
</div>
@include('partials.admin-stats-grid')

<!-- Search and Filter -->
<div class="glass-card mb-6 p-4">
    <form action="{{ route('admin.events.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
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
        @if(request()->has('search') || request()->has('category'))
            <a href="{{ route('admin.events.index') }}" class="bg-slate-700 hover:bg-slate-600 text-white px-6 py-3 rounded-xl font-bold transition flex items-center justify-center">
                Clear
            </a>
        @endif
    </form>
</div>

<div class="glass-card overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-white/5 border-b border-white/5">
            <tr>
                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Event Details</th>
                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Category</th>
                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Fees</th>
                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Time</th>
                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/5">
            @forelse($events as $event)
            <tr class="hover:bg-white/[0.02] transition">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-lg bg-slate-800 overflow-hidden flex-shrink-0 border border-white/5">
                            <img src="{{ $event->getDisplayImage() }}" class="w-full h-full object-cover" onerror="this.src='{{ asset('images/default-event.png') }}';">
                        </div>
                        <div>
                            <p class="font-bold text-white">{{ $event->name }}</p>
                            <p class="text-xs text-slate-500">{{ Str::limit($event->description, 50) }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 bg-blue-500/10 text-blue-400 rounded-full text-xs font-bold border border-blue-500/20">
                        {{ $event->category }}
                    </span>
                    @if($event->sub_category)
                    <span class="ml-2 px-3 py-1 bg-slate-500/10 text-slate-400 rounded-full text-xs font-bold border border-slate-500/20">
                        {{ $event->sub_category }}
                    </span>
                    @endif
                </td>
                <td class="px-6 py-4 text-white font-mono">
                    {{ $event->fees > 0 ? '₹ ' . number_format($event->fees, 2) : 'FREE' }}
                </td>
                <td class="px-6 py-4 text-slate-300">
                    {{ $event->time ?: '-' }}
                </td>
                <td class="px-6 py-4 text-right">
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.events.show', $event) }}" class="w-9 h-9 flex items-center justify-center rounded-lg bg-cyan-500/10 hover:bg-cyan-500/20 text-cyan-500 transition" title="View Details">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.events.edit', $event) }}" class="w-9 h-9 flex items-center justify-center rounded-lg bg-white/5 hover:bg-white/10 text-slate-300 hover:text-white transition">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.events.destroy', $event) }}" method="POST" onsubmit="return confirm('Archive this event? Student data remains secure.')">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-9 h-9 flex items-center justify-center rounded-lg bg-red-500/10 hover:bg-red-500/20 text-red-500 transition">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-6 py-12 text-center text-slate-500 italic">
                    <i class="fas fa-calendar-times text-4xl mb-4 block opacity-20"></i>
                    No events registered yet. Start by adding one above.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
