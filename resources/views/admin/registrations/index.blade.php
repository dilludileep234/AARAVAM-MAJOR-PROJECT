@extends(Auth::guard('admin')->user()->role == 'super_admin' ? 'layouts.admin' : 'layouts.category')

@section('title', ($category ? $category . ' ' : '') . 'Manage Registrations')

@section('content')
<div class="space-y-8">
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black tracking-tight text-white mb-2">
                @if($category)
                    {{ $category }} Registrations
                @else
                    Student Registrations
                @endif
            </h1>
            <p class="text-slate-400">Review and approve event sign-ups.</p>
        </div>
        <div class="flex flex-wrap gap-2">
            @if($category && Auth::guard('admin')->user()->role == 'super_admin')
                <a href="{{ route('admin.registrations.index') }}" class="flex items-center gap-2 bg-white/5 hover:bg-white/10 text-white px-5 py-2.5 rounded-xl font-bold transition text-sm">
                    <i class="fas fa-times"></i> Clear Filter
                </a>
            @endif
            <a href="{{ route('admin.registrations.export', ['category' => $category]) }}" class="flex items-center gap-2 bg-slate-700 hover:bg-slate-600 text-white px-5 py-2.5 rounded-xl font-bold transition shadow-lg shadow-slate-900/20 active:scale-95 text-sm">
                <i class="fas fa-file-csv"></i> Export {{ $category ? $category : 'All' }}
            </a>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="glass-card p-4">
        <form action="{{ route('admin.registrations.index') }}" method="GET" class="flex gap-4">
            <div class="flex-1 relative">
                <i class="fas fa-search absolute left-4 top-3.5 text-gray-500"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, reg no, or email..." 
                       class="w-full bg-slate-900/50 border border-white/10 rounded-xl py-3 pl-12 pr-4 text-white focus:outline-none focus:border-cyan-500 transition">
            </div>
            @if($category)
                <input type="hidden" name="category" value="{{ $category }}">
            @endif
            <button type="submit" class="bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-3 rounded-xl font-bold transition">
                Search
            </button>
        </form>
    </div>
    
    <!-- Stats Overview -->
    @include('partials.admin-stats-grid')

    <!-- Pending Registrations -->
    <div class="mb-4 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <h2 class="text-xl font-bold text-white">Pending Approvals</h2>
            <span class="px-2 py-1 rounded-full bg-amber-500/10 text-amber-500 text-xs font-bold">{{ $pendingRegistrations->count() }}</span>
        </div>
        <a href="{{ route('admin.registrations.export', ['status' => 'pending', 'category' => $category]) }}" class="flex items-center gap-2 bg-amber-500/20 hover:bg-amber-500/30 text-amber-400 border border-amber-500/20 px-3 py-1.5 rounded-lg text-xs font-bold transition">
            <i class="fas fa-file-csv"></i> Export Pending
        </a>
    </div>
    <div class="glass-card overflow-hidden mb-8">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-white/5 bg-white/[0.02]">
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Student Info</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Events</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($pendingRegistrations as $registration)
                    <tr class="hover:bg-white/[0.02] transition">
                        <td class="px-6 py-4">
                            <p class="font-bold text-white">{{ $registration->student_name }}</p>
                            <p class="text-xs text-slate-500">{{ $registration->email }}</p>
                            <p class="text-[10px] text-slate-600 uppercase mt-1">{{ $registration->reg_no }} | {{ $registration->department }} | {{ $registration->semester }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-2">
                                @foreach($registration->items as $item)
                                <span class="px-2 py-1 rounded-md bg-blue-600/10 border border-blue-500/20 text-[10px] font-bold text-blue-400">
                                    {{ $item->event->name }}
                                </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.registrations.exportIndividual', $registration) }}" class="w-8 h-8 rounded-lg bg-slate-800 text-cyan-400 hover:bg-slate-700 transition flex items-center justify-center" title="Export Individual">
                                    <i class="fas fa-file-csv text-xs"></i>
                                </a>
                                <form action="{{ route('admin.registrations.updateStatus', $registration) }}" method="POST" class="inline">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="w-8 h-8 rounded-lg bg-emerald-500/10 text-emerald-500 hover:bg-emerald-500 hover:text-white transition flex items-center justify-center" title="Approve">
                                        <i class="fas fa-check text-xs"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.registrations.updateStatus', $registration) }}" method="POST" class="inline">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="w-8 h-8 rounded-lg bg-rose-500/10 text-rose-500 hover:bg-rose-500 hover:text-white transition flex items-center justify-center" title="Reject">
                                        <i class="fas fa-times text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center text-slate-500 italic">
                            <i class="fas fa-check-circle text-4xl mb-4 block opacity-20"></i>
                            No pending registrations.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Approved Registrations -->
    <div class="mb-4 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <h2 class="text-xl font-bold text-white">Approved Registrations</h2>
            <span class="px-2 py-1 rounded-full bg-emerald-500/10 text-emerald-500 text-xs font-bold">{{ $approvedRegistrations->count() }}</span>
        </div>
        <a href="{{ route('admin.registrations.export', ['status' => 'approved', 'category' => $category]) }}" class="flex items-center gap-2 bg-emerald-500/20 hover:bg-emerald-500/30 text-emerald-400 border border-emerald-500/20 px-3 py-1.5 rounded-lg text-xs font-bold transition">
            <i class="fas fa-file-csv"></i> Export Approved
        </a>
    </div>
    <div class="glass-card overflow-hidden mb-8">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-white/5 bg-white/[0.02]">
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Student Info</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Events</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($approvedRegistrations as $registration)
                    <tr class="hover:bg-white/[0.02] transition">
                        <td class="px-6 py-4">
                            <p class="font-bold text-white">{{ $registration->student_name }}</p>
                            <p class="text-xs text-slate-500">{{ $registration->email }}</p>
                            <p class="text-[10px] text-slate-600 uppercase mt-1">{{ $registration->reg_no }} | {{ $registration->department }} | {{ $registration->semester }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-2">
                                @foreach($registration->items as $item)
                                <span class="px-2 py-1 rounded-md bg-blue-600/10 border border-blue-500/20 text-[10px] font-bold text-blue-400">
                                    {{ $item->event->name }}
                                </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.registrations.exportIndividual', $registration) }}" class="w-8 h-8 rounded-lg bg-slate-800 text-cyan-400 hover:bg-slate-700 transition flex items-center justify-center" title="Export Individual">
                                    <i class="fas fa-file-csv text-xs"></i>
                                </a>
                                <form action="{{ route('admin.registrations.updateStatus', $registration) }}" method="POST" class="inline">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="w-8 h-8 rounded-lg bg-rose-500/10 text-rose-500 hover:bg-rose-500 hover:text-white transition flex items-center justify-center" title="Reject">
                                        <i class="fas fa-times text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center text-slate-500 italic">
                            <i class="fas fa-inbox text-4xl mb-4 block opacity-20"></i>
                            No approved registrations yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Rejected Registrations -->
    <div class="mb-4 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <h2 class="text-xl font-bold text-white">Rejected Registrations</h2>
            <span class="px-2 py-1 rounded-full bg-rose-500/10 text-rose-500 text-xs font-bold">{{ $rejectedRegistrations->count() }}</span>
        </div>
        <a href="{{ route('admin.registrations.export', ['status' => 'rejected', 'category' => $category]) }}" class="flex items-center gap-2 bg-rose-500/20 hover:bg-rose-500/30 text-rose-400 border border-rose-500/20 px-3 py-1.5 rounded-lg text-xs font-bold transition">
            <i class="fas fa-file-csv"></i> Export Rejected
        </a>
    </div>
    <div class="glass-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-white/5 bg-white/[0.02]">
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Student Info</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Events</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($rejectedRegistrations as $registration)
                    <tr class="hover:bg-white/[0.02] transition opacity-60 hover:opacity-100">
                        <td class="px-6 py-4">
                            <p class="font-bold text-white">{{ $registration->student_name }}</p>
                            <p class="text-xs text-slate-500">{{ $registration->email }}</p>
                            <p class="text-[10px] text-slate-600 uppercase mt-1">{{ $registration->reg_no }} | {{ $registration->department }} | {{ $registration->semester }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-2">
                                @foreach($registration->items as $item)
                                <span class="px-2 py-1 rounded-md bg-slate-600/10 border border-slate-500/20 text-[10px] font-bold text-slate-400">
                                    {{ $item->event->name }}
                                </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.registrations.exportIndividual', $registration) }}" class="w-8 h-8 rounded-lg bg-slate-800 text-cyan-400 hover:bg-slate-700 transition flex items-center justify-center" title="Export Individual">
                                    <i class="fas fa-file-csv text-xs"></i>
                                </a>
                                <form action="{{ route('admin.registrations.updateStatus', $registration) }}" method="POST" class="inline">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="w-8 h-8 rounded-lg bg-emerald-500/10 text-emerald-500 hover:bg-emerald-500 hover:text-white transition flex items-center justify-center" title="Approve">
                                        <i class="fas fa-check text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center text-slate-500 italic">
                            <i class="fas fa-check text-4xl mb-4 block opacity-20"></i>
                            No rejected registrations.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
