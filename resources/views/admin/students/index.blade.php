@extends(Auth::guard('admin')->user()->role === 'super_admin' ? 'layouts.admin' : 'layouts.category')

@section('title', 'Manage Students')

@section('content')
<div class="space-y-8">
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black tracking-tight text-white mb-2">Student Directory</h1>
            <p class="text-slate-400 text-sm">Manage student accounts, approvals, and access control.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.students.export') }}" class="flex items-center gap-2 px-6 py-3 bg-white/5 hover:bg-cyan-600 text-white border border-white/10 rounded-xl font-bold transition-all active:scale-95 shadow-lg shadow-cyan-950/20">
                <i class="fas fa-file-export"></i> Export Directory
            </a>
            <div class="glass-card px-4 py-2 border-l-2 border-l-blue-500">
                <p class="text-[10px] text-slate-500 font-bold uppercase tracking-wider">Total Base</p>
                <p class="text-lg font-black text-white">{{ number_format($totalRegistrations) }}</p>
            </div>
        </div>
    </div>

    <!-- Stats for Overview Grid -->
    @include('partials.admin-stats-grid')

    <!-- Navigation Tabs -->
    <div class="flex items-center gap-1 bg-white/5 p-1 rounded-2xl w-fit border border-white/5">
        <button onclick="switchTab('active')" id="tab-active" class="student-tab px-6 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all active-tab">
            Active <span class="ml-2 text-[10px] opacity-60">{{ $students->count() }}</span>
        </button>
        <button onclick="switchTab('revoked')" id="tab-revoked" class="student-tab px-6 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all text-slate-500 hover:text-white">
            Revoked <span class="ml-2 text-[10px] opacity-60">{{ $revokedRegistrations }}</span>
        </button>
        <button onclick="switchTab('removed')" id="tab-removed" class="student-tab px-6 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all text-slate-500 hover:text-white">
            Removed <span class="ml-2 text-[10px] opacity-60">{{ $removedCount }}</span>
        </button>
    </div>

    <!-- Search -->
    <div class="glass-card p-4">
        <form action="{{ route('admin.students.index') }}" method="GET" class="flex gap-4">
            <div class="flex-1 relative">
                <i class="fas fa-search absolute left-4 top-3.5 text-slate-500"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email, or reg no..." 
                       class="w-full bg-slate-900/50 border border-white/10 rounded-xl py-3 pl-12 pr-4 text-white focus:outline-none focus:border-cyan-500 transition">
            </div>
            <button type="submit" class="bg-cyan-600 hover:bg-cyan-700 text-white px-8 py-3 rounded-xl font-bold transition">
                Filter
            </button>
        </form>
    </div>

    <!-- Tables Container -->
    <div class="space-y-8">
        <!-- Active Students Table -->
        <div id="section-active" class="student-section">
            <div class="glass-card overflow-hidden">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-white/5 bg-white/[0.02]">
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Student Profile</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Email Address</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Status</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400 text-right">Operations</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($students as $student)
                        <tr class="hover:bg-white/[0.02] transition group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-slate-800 to-slate-900 border border-white/10 flex items-center justify-center text-xs font-black text-white shadow-xl">
                                        {{ substr($student->username, 0, 1) }}
                                    </div>
                                    <p class="font-bold text-white tracking-tight">{{ $student->username }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-300 text-sm italic">{{ $student->email }}</td>
                            <td class="px-6 py-4">
                                @if($student->status === 'approved')
                                    <span class="px-3 py-1 bg-emerald-500/10 text-emerald-500 rounded-lg text-[9px] font-black uppercase tracking-widest border border-emerald-500/20">Approved</span>
                                @else
                                    <span class="px-3 py-1 bg-amber-500/10 text-amber-500 rounded-lg text-[9px] font-black uppercase tracking-widest border border-amber-500/20">Waitlist</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    @if($student->status !== 'approved')
                                    <form action="{{ route('admin.students.approve', $student->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg bg-emerald-500/10 hover:bg-emerald-500 hover:text-white text-emerald-500 transition shadow-lg" title="Approve Student">
                                            <i class="fas fa-check text-xs"></i>
                                        </button>
                                    </form>
                                    @endif

                                    <form action="{{ route('admin.students.reject', $student->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg bg-rose-500/10 hover:bg-rose-500 hover:text-white text-rose-500 transition shadow-lg" title="Revoke Access">
                                            <i class="fas fa-user-slash text-xs"></i>
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" class="inline" onsubmit="return confirm('Suspend this student account?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-800 text-slate-400 hover:bg-red-600 hover:text-white transition shadow-lg" title="Remove Student">
                                            <i class="fas fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center">
                                <i class="fas fa-users text-4xl text-slate-800 mb-4 block"></i>
                                <p class="text-slate-600 font-bold uppercase text-xs tracking-widest">No active students found</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Revoked Students Table -->
        <div id="section-revoked" class="student-section hidden">
            <div class="glass-card overflow-hidden">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-white/5 bg-white/[0.02]">
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Student Profile</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Email Address</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Status</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400 text-right">Operations</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($revokedStudents as $student)
                        <tr class="hover:bg-white/[0.02] transition opacity-70 hover:opacity-100">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-2xl bg-rose-900/20 border border-rose-500/20 flex items-center justify-center text-xs font-black text-rose-500 shadow-xl">
                                        {{ substr($student->username, 0, 1) }}
                                    </div>
                                    <p class="font-bold text-white tracking-tight">{{ $student->username }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-300 text-sm italic">{{ $student->email }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-rose-500/10 text-rose-500 rounded-lg text-[9px] font-black uppercase tracking-widest border border-rose-500/20">Revoked</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <form action="{{ route('admin.students.approve', $student->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-4 py-1.5 rounded-lg bg-emerald-500/10 hover:bg-emerald-500 hover:text-white text-emerald-500 text-[10px] font-black uppercase tracking-widest transition shadow-lg">
                                            Reinstate Access
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-800 text-slate-400 hover:bg-red-600 hover:text-white transition shadow-lg">
                                            <i class="fas fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center">
                                <i class="fas fa-user-shield text-4xl text-slate-800 mb-4 block"></i>
                                <p class="text-slate-600 font-bold uppercase text-xs tracking-widest">No revoked accounts</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Removed Students Table -->
        <div id="section-removed" class="student-section hidden">
            <div class="glass-card overflow-hidden">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-white/5 bg-white/[0.02]">
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Student Profile</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Email Address</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Deleted On</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400 text-right">Operations</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($removedStudents as $student)
                        <tr class="hover:bg-white/[0.02] transition grayscale hover:grayscale-0 opacity-60 hover:opacity-100">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-2xl bg-slate-800 border border-white/5 flex items-center justify-center text-xs font-black text-slate-500 shadow-xl">
                                        {{ substr($student->username, 0, 1) }}
                                    </div>
                                    <p class="font-bold text-white tracking-tight">{{ $student->username }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-300 text-sm italic">{{ $student->email }}</td>
                            <td class="px-6 py-4 text-xs text-slate-500 font-bold uppercase">{{ $student->deleted_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <form action="{{ route('admin.students.restore', $student->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-4 py-1.5 rounded-lg bg-blue-500/10 hover:bg-blue-500 hover:text-white text-blue-500 text-[10px] font-black uppercase tracking-widest transition shadow-lg">
                                            Restore
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.students.force_delete', $student->id) }}" method="POST" class="inline" onsubmit="return confirm('PERMANENTLY DELETE this account? This cannot be undone!')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-600/10 text-red-500 hover:bg-red-600 hover:text-white transition shadow-lg">
                                            <i class="fas fa-skull text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center">
                                <i class="fas fa-ghost text-4xl text-slate-800 mb-4 block"></i>
                                <p class="text-slate-600 font-bold uppercase text-xs tracking-widest">No purged accounts detected</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .active-tab {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
</style>

<script>
function switchTab(tabId) {
    // Hide all sections
    document.querySelectorAll('.student-section').forEach(section => {
        section.classList.add('hidden');
    });
    
    // Show selected section
    document.getElementById('section-' + tabId).classList.remove('hidden');
    
    // Update button styles
    document.querySelectorAll('.student-tab').forEach(btn => {
        btn.classList.remove('active-tab');
        btn.classList.add('text-slate-500');
        btn.classList.remove('text-white');
    });
    
    const activeBtn = document.getElementById('tab-' + tabId);
    activeBtn.classList.add('active-tab');
    activeBtn.classList.remove('text-slate-500');
    activeBtn.classList.add('text-white');
}
</script>
@endsection
