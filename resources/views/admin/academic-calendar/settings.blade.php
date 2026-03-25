@extends(auth('admin')->user()->role === 'super_admin' ? 'layouts.admin' : 'layouts.category')

@section('title', 'Calendar Settings')

@section('content')
<div class="max-w-4xl">
    <div class="mb-8">
        <a href="{{ route('admin.academic-calendar.index') }}" class="text-slate-400 hover:text-white transition flex items-center gap-2 mb-4">
            <i class="fas fa-arrow-left"></i> Back to Calendar
        </a>
        <h1 class="text-3xl font-bold text-white">Calendar Configuration</h1>
        <p class="text-slate-400 mt-2">Set the active academic year and starting date for the public calendar display.</p>
    </div>

    <form action="{{ route('admin.academic-calendar.settings.update') }}" method="POST" class="space-y-6">
        @csrf

        <div class="glass-card p-8 space-y-6">
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-400">Academic Year</label>
                    <input type="text" name="academic_year" value="{{ $settings['academic_year'] }}" required 
                           class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 transition"
                           placeholder="e.g. 2025-2026">
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-400">Calendar Start Date</label>
                    <input type="date" name="calendar_start_date" value="{{ $settings['calendar_start_date'] }}" required 
                           class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 transition">
                    <p class="text-[10px] text-slate-500 italic">This date determines the first month shown in the 6-month public view.</p>
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-wider text-slate-400">Calendar Display Title</label>
                <input type="text" name="calendar_title" value="{{ $settings['calendar_title'] }}" required 
                       class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 transition"
                       placeholder="e.g. S6 Academic Calendar">
            </div>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white py-4 rounded-xl font-bold text-lg shadow-lg shadow-indigo-600/20 transition active:scale-[0.98]">
                Save Configuration
            </button>
            <a href="{{ route('admin.academic-calendar.index') }}" class="px-8 bg-white/5 hover:bg-white/10 text-white py-4 rounded-xl font-bold border border-white/10 transition flex items-center">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
