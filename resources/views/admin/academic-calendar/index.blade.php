@extends(auth('admin')->user()->role === 'super_admin' ? 'layouts.admin' : 'layouts.category')

@section('title', 'Academic Calendar')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold text-white">Academic Calendar</h1>
    <div class="flex gap-4">
        <a href="{{ route('admin.academic-calendar.settings') }}" class="bg-white/5 hover:bg-white/10 text-white px-6 py-3 rounded-xl font-bold flex items-center gap-2 transition border border-white/10 active:scale-95">
            <i class="fas fa-cog"></i> Settings
        </a>
        <a href="{{ route('calendar') }}" target="_blank" class="bg-white/5 hover:bg-white/10 text-white px-6 py-3 rounded-xl font-bold flex items-center gap-2 transition border border-white/10 active:scale-95">
            <i class="fas fa-eye"></i> View Public Calendar
        </a>
        <a href="{{ route('admin.academic-calendar.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-bold flex items-center gap-2 transition active:scale-95 shadow-lg shadow-indigo-600/20">
            <i class="fas fa-plus"></i> Add New Event
        </a>
    </div>
</div>
@include('partials.admin-stats-grid')
@if(session('success'))
<div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-xl flex items-center gap-3">
    <i class="fas fa-check-circle"></i>
    {{ session('success') }}
</div>
@endif

<div class="glass-card overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-white/5 border-b border-white/5">
            <tr>
                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Date</th>
                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Event Title</th>
                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Type</th>
                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/5">
            @forelse($events as $event)
            <tr class="hover:bg-white/[0.02] transition">
                <td class="px-6 py-4 text-white font-mono">
                    {{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }}
                </td>
                <td class="px-6 py-4">
                    <p class="font-bold text-white">{{ $event->title }}</p>
                    @if($event->description)
                        <p class="text-xs text-slate-500">{{ Str::limit($event->description, 50) }}</p>
                    @endif
                </td>
                <td class="px-6 py-4">
                    @php
                        $typeClasses = [
                            'event' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                            'exam' => 'bg-rose-500/10 text-rose-400 border-rose-500/20',
                            'holiday' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
                            'other' => 'bg-slate-500/10 text-slate-400 border-slate-500/20',
                        ];
                        $class = $typeClasses[$event->type] ?? $typeClasses['other'];
                    @endphp
                    <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $class }}">
                        {{ ucfirst($event->type) }}
                    </span>
                </td>
                <td class="px-6 py-4 text-right">
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.academic-calendar.edit', $event) }}" class="w-9 h-9 flex items-center justify-center rounded-lg bg-white/5 hover:bg-white/10 text-slate-300 hover:text-white transition">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.academic-calendar.destroy', $event) }}" method="POST" onsubmit="return confirm('Delete this calendar event?')">
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
                    <i class="fas fa-calendar-alt text-4xl mb-4 block opacity-20"></i>
                    No events scheduled yet.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
