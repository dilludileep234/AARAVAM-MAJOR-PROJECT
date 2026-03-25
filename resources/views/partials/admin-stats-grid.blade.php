<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-10">
    <!-- Total Registrations -->
    <div class="glass-card p-6 border-l-4 border-l-blue-600 shadow-2xl relative overflow-hidden group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-blue-600/5 rounded-full blur-2xl group-hover:bg-blue-600/10 transition-all"></div>
        <div class="flex items-center justify-between mb-4">
            <div class="w-10 h-10 rounded-xl bg-blue-600/10 flex items-center justify-center text-blue-500">
                <i class="fas fa-users-viewfinder"></i>
            </div>
            <span class="text-[10px] font-black text-blue-500 bg-blue-500/10 px-2 py-0.5 rounded uppercase tracking-widest">Active</span>
        </div>
        <p class="text-slate-500 text-[11px] font-bold uppercase tracking-wider">Total Enrollment</p>
        <h3 class="text-4xl font-black text-white mt-1">{{ number_format($totalRegistrations) }}</h3>
    </div>

    <!-- Total Events -->
    <div class="glass-card p-6 border-l-4 border-l-indigo-600 shadow-2xl relative overflow-hidden group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-indigo-600/5 rounded-full blur-2xl group-hover:bg-indigo-600/10 transition-all"></div>
        <div class="flex items-center justify-between mb-4">
            <div class="w-10 h-10 rounded-xl bg-indigo-600/10 flex items-center justify-center text-indigo-500">
                <i class="fas fa-calendar-check"></i>
            </div>
        </div>
        <p class="text-slate-500 text-[11px] font-bold uppercase tracking-wider">Live Modules</p>
        <h3 class="text-4xl font-black text-white mt-1">{{ number_format($totalEvents) }}</h3>
    </div>

    <!-- Verified Students -->
    <div class="glass-card p-6 border-l-4 border-l-emerald-600 shadow-2xl relative overflow-hidden group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-emerald-600/5 rounded-full blur-2xl group-hover:bg-emerald-600/10 transition-all"></div>
        <div class="flex items-center justify-between mb-4">
            <div class="w-10 h-10 rounded-xl bg-emerald-600/10 flex items-center justify-center text-emerald-500">
                <i class="fas fa-user-shield"></i>
            </div>
        </div>
        <p class="text-slate-500 text-[11px] font-bold uppercase tracking-wider">{{ $isSuper ? 'Verified Registrations' : 'Approved' }}</p>
        <h3 class="text-4xl font-black text-white mt-1">{{ number_format($verifiedStudents) }}</h3>
    </div>

    <!-- Pending Approvals -->
    <div class="glass-card p-6 border-l-4 border-l-amber-600 shadow-2xl relative overflow-hidden group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-amber-600/5 rounded-full blur-2xl group-hover:bg-amber-600/10 transition-all"></div>
        <div class="flex items-center justify-between mb-4">
            <div class="w-10 h-10 rounded-xl bg-amber-600/10 flex items-center justify-center text-amber-500">
                <i class="fas fa-hourglass-half"></i>
            </div>
            @if($pendingApprovals > 0)
            <span class="flex items-center text-[10px] font-black text-amber-500 bg-amber-500/10 px-2 py-0.5 rounded uppercase tracking-widest animate-pulse">Action Required</span>
            @endif
        </div>
        <p class="text-slate-500 text-[11px] font-bold uppercase tracking-wider">Waitlist Volume</p>
        <h3 class="text-4xl font-black text-white mt-1">{{ number_format($pendingApprovals) }}</h3>
    </div>

    <!-- Rejected Registrations -->
    <div class="glass-card p-6 border-l-4 border-l-red-600 shadow-2xl relative overflow-hidden group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-red-600/5 rounded-full blur-2xl group-hover:bg-red-600/10 transition-all"></div>
        <div class="flex items-center justify-between mb-4">
            <div class="w-10 h-10 rounded-xl bg-red-600/10 flex items-center justify-center text-red-500">
                <i class="fas fa-ban"></i>
            </div>
        </div>
        <p class="text-slate-500 text-[11px] font-bold uppercase tracking-wider">Rejected Registrations</p>
        <h3 class="text-4xl font-black text-white mt-1">{{ number_format($revokedRegistrations) }}</h3>
    </div>
</div>
