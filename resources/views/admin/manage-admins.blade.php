@extends(auth('admin')->user()->role === 'super_admin' ? 'layouts.admin' : 'layouts.category')

@section('content')
<div class="space-y-10">
    <div class="flex justify-between items-center px-4">
        <div>
            <h1 class="text-3xl font-black text-white tracking-tight">Access Control</h1>
            <p class="text-slate-500 text-sm mt-1">Audit and manage the administrative hierarchy and sectoral oversight.</p>
        </div>
    </div>

    <!-- Stats Overview -->
    @include('partials.admin-stats-grid')

    <!-- Pending Admins -->
    <div class="space-y-4">
        <div class="flex items-center gap-3 px-4">
            <div class="w-8 h-8 rounded-lg bg-amber-500/10 flex items-center justify-center text-amber-500">
                <i class="fas fa-user-clock text-xs"></i>
            </div>
            <h2 class="text-lg font-bold text-white tracking-tight">Pending Authorizations</h2>
            <span class="px-2 py-0.5 bg-slate-800 text-[10px] font-black text-slate-400 rounded-full border border-white/5">{{ $pendingAdmins->count() }}</span>
        </div>
        
        <div class="glass-card overflow-hidden">
            @if($pendingAdmins->count() > 0)
                <table class="w-full text-left">
                    <thead class="bg-white/5 border-b border-white/5">
                        <tr>
                            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-[2px] text-slate-500">Identity</th>
                            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-[2px] text-slate-500">Classification</th>
                            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-[2px] text-slate-500 text-right">Directives</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($pendingAdmins as $admin)
                            <tr class="hover:bg-white/[0.02] transition-all group">
                                <td class="px-6 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-xl bg-slate-800 border border-white/5 flex items-center justify-center text-slate-500 font-bold">
                                            {{ substr($admin->username, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-white tracking-tight">{{ $admin->username }}</p>
                                            <p class="text-[10px] text-slate-500 font-medium">{{ $admin->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-6">
                                    <div class="flex flex-col gap-1">
                                        <span class="text-[10px] font-black uppercase tracking-widest {{ $admin->role == 'super_admin' ? 'text-blue-400' : ($admin->role == 'category_admin' ? 'text-purple-400' : 'text-amber-400') }}">
                                            {{ str_replace('_', ' ', $admin->role) }}
                                        </span>
                                        <span class="text-[9px] font-bold text-slate-600 italic">{{ $admin->category_access ?: 'Global Access' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-6">
                                    <div class="flex justify-end gap-3">
                                        <form action="{{ route('admin.approve', $admin->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="px-4 py-2 bg-emerald-500/10 hover:bg-emerald-500 text-emerald-400 hover:text-white border border-emerald-500/20 text-[10px] font-black uppercase tracking-widest rounded-lg transition-all">
                                                Grant
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.reject', $admin->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="px-4 py-2 bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white border border-red-500/20 text-[10px] font-black uppercase tracking-widest rounded-lg transition-all">
                                                Deny
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="py-16 text-center">
                    <i class="fas fa-check-double text-slate-800 text-3xl mb-4"></i>
                    <p class="text-slate-600 text-xs font-bold uppercase tracking-widest">No pending requests detected</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Approved Admins -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <div class="lg:col-span-2 space-y-4">
            <div class="flex items-center gap-3 px-4">
                <div class="w-8 h-8 rounded-lg bg-emerald-500/10 flex items-center justify-center text-emerald-500">
                    <i class="fas fa-user-shield text-xs"></i>
                </div>
                <h2 class="text-lg font-bold text-white tracking-tight">Active Duty</h2>
            </div>
            
            <div class="glass-card overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-white/5 border-b border-white/5">
                        <tr>
                            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-[2px] text-slate-500">Identity</th>
                            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-[2px] text-slate-500 text-right">Directives</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($approvedAdmins as $admin)
                            <tr class="hover:bg-white/[0.01] transition-all group">
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-4">
                                        <div class="w-8 h-8 rounded-lg bg-blue-600/10 border border-blue-500/20 flex items-center justify-center text-blue-500 text-xs font-black">
                                            {{ substr($admin->username, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-white tracking-tight">{{ $admin->username }}</p>
                                            <span class="text-[9px] font-black uppercase tracking-widest {{ $admin->role == 'super_admin' ? 'text-blue-500' : 'text-slate-500' }}">
                                                {{ str_replace('_', ' ', $admin->role) }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex justify-end">
                                        <form action="{{ route('admin.delete', $admin->id) }}" method="POST" onsubmit="return confirm('Revoke account permanentely?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="w-8 h-8 flex items-center justify-center text-slate-600 hover:text-red-400 transition-colors">
                                                <i class="fas fa-trash-can text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="2" class="py-10 text-center text-slate-600 italic text-sm">No personnel active</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="space-y-10">
            <!-- Rejected History -->
            <div class="space-y-4">
                <div class="flex items-center gap-3 px-4">
                    <div class="w-8 h-8 rounded-lg bg-red-500/10 flex items-center justify-center text-red-500">
                        <i class="fas fa-user-xmark text-xs"></i>
                    </div>
                    <h2 class="text-lg font-bold text-white tracking-tight">Access Revoked</h2>
                </div>
                
                <div class="glass-card">
                    <div class="divide-y divide-white/5">
                        @forelse($rejectedAdmins as $admin)
                            <div class="p-4 flex items-center justify-between group">
                                <div>
                                    <p class="text-xs font-bold text-slate-300">{{ $admin->username }}</p>
                                    <p class="text-[9px] text-slate-600 font-black uppercase tracking-widest">Rejected Access</p>
                                </div>
                                <form action="{{ route('admin.approve', $admin->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-[9px] font-black uppercase tracking-widest text-emerald-500 opacity-0 group-hover:opacity-100 transition-opacity">
                                        Re-Grant
                                    </button>
                                </form>
                            </div>
                        @empty
                            <p class="p-10 text-center text-slate-600 text-xs font-bold uppercase tracking-widest">Clear History</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Terminated Personnel -->
            <div class="space-y-4">
                <div class="flex items-center gap-3 px-4">
                    <div class="w-8 h-8 rounded-lg bg-orange-500/10 flex items-center justify-center text-orange-500">
                        <i class="fas fa-user-slash text-xs"></i>
                    </div>
                    <h2 class="text-lg font-bold text-white tracking-tight">Terminated Personnel</h2>
                    <span class="px-2 py-0.5 bg-slate-800 text-[10px] font-black text-slate-400 rounded-full border border-white/5">{{ $deletedAdmins->count() }}</span>
                </div>
                
                <div class="glass-card">
                    <div class="divide-y divide-white/5">
                        @forelse($deletedAdmins as $admin)
                            <div class="p-4 flex items-center justify-between group">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-slate-800 border border-white/5 flex items-center justify-center text-slate-600 text-[10px] grayscale">
                                        {{ substr($admin->username, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-slate-400 line-through decoration-slate-600">{{ $admin->username }}</p>
                                        <p class="text-[9px] text-slate-600 font-black uppercase tracking-widest">Account Terminated</p>
                                    </div>
                                </div>
                                <form action="{{ route('admin.restore', $admin->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-3 py-1.5 bg-blue-500/10 hover:bg-blue-500 text-blue-500 hover:text-white border border-blue-500/20 text-[9px] font-black uppercase tracking-widest rounded-md transition-all opacity-0 group-hover:opacity-100">
                                        Restore
                                    </button>
                                </form>
                            </div>
                        @empty
                            <div class="py-10 text-center">
                                <i class="fas fa-shield-halved text-slate-800 text-xl mb-2"></i>
                                <p class="text-slate-600 text-[10px] font-black uppercase tracking-widest">No terminated accounts</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
