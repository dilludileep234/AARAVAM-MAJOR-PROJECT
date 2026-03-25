@extends(auth('admin')->user()->role === 'super_admin' ? 'layouts.admin' : 'layouts.category')

@section('title', 'Add Calendar Event')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.academic-calendar.index') }}" class="text-slate-500 hover:text-white"><i class="fas fa-arrow-left"></i></a>
        <h1 class="text-3xl font-bold text-white">Add New Calendar Event</h1>
    </div>

    @if ($errors->any())
    <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 text-red-400 rounded-xl">
        <ul class="list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.academic-calendar.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="glass-card p-8 space-y-6">
            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-wider text-slate-400">Event Title</label>
                <input type="text" name="title" value="{{ old('title') }}" required 
                       class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 transition"
                       placeholder="e.g. End Semester Exams">
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-400">Date</label>
                    <input type="date" name="date" value="{{ old('date') }}" required 
                           class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 transition">
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-400">Event Type</label>
                    <select name="type" required 
                            class="w-full bg-[#0f172a] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 transition cursor-pointer">
                        <option value="event" {{ old('type') == 'event' ? 'selected' : '' }}>General Event</option>
                        <option value="exam" {{ old('type') == 'exam' ? 'selected' : '' }}>Examination</option>
                        <option value="holiday" {{ old('type') == 'holiday' ? 'selected' : '' }}>Holiday</option>
                        <option value="other" {{ old('type') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-wider text-slate-400">Description (Optional)</label>
                <textarea name="description" rows="4" 
                          class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 transition"
                          placeholder="Provide more details about the event...">{{ old('description') }}</textarea>
            </div>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white py-4 rounded-xl font-bold text-lg shadow-lg shadow-indigo-600/20 transition active:scale-[0.98]">
                Create Event
            </button>
            <a href="{{ route('admin.academic-calendar.index') }}" class="px-8 bg-white/5 hover:bg-white/10 text-white py-4 rounded-xl font-bold border border-white/10 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
