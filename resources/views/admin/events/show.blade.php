@extends(auth('admin')->user()->role === 'super_admin' ? 'layouts.admin' : 'layouts.category')

@section('title', 'Event Details - ' . $event->name)

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8 flex justify-between items-start">
        <div>
            <a href="{{ route('admin.events.index') }}" class="text-slate-400 hover:text-white transition flex items-center gap-2 mb-4">
                <i class="fas fa-arrow-left"></i> Back to Events
            </a>
            <h1 class="text-3xl font-bold text-white">{{ $event->name }}</h1>
            <p class="text-slate-400 mt-2">ID: #{{ $event->id }} | Created on {{ $event->created_at->format('M d, Y') }}</p>
        </div>
        <div class="flex gap-4">
            <a href="{{ route('admin.events.edit', $event) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-bold flex items-center gap-2 transition active:scale-95 shadow-lg shadow-indigo-600/20">
                <i class="fas fa-edit"></i> Edit Event
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-6 py-4 rounded-xl mb-6 flex items-center gap-3">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
    @endif

    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Event Image and Info -->
        <div class="lg:col-span-1 space-y-6">
            <div class="glass-card overflow-hidden">
                <div class="aspect-square relative bg-slate-800">
                    <img src="{{ $event->getDisplayImage() }}" class="w-full h-full object-cover" onerror="this.src='{{ asset('images/default-event.png') }}';">
                </div>
                <div class="p-6 space-y-4">
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Category</label>
                        <p class="text-white">
                            <span class="px-2 py-0.5 bg-blue-500/10 text-blue-400 rounded text-xs font-bold border border-blue-500/20">
                                {{ $event->category }}
                            </span>
                        </p>
                    </div>

                    @if($event->sub_category)
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Sub-Category</label>
                        <p class="text-white">
                            <span class="px-2 py-0.5 bg-slate-500/10 text-slate-400 rounded text-xs font-bold border border-slate-500/20">
                                {{ $event->sub_category }}
                            </span>
                        </p>
                    </div>
                    @endif

                    <div class="space-y-1">
                        <label class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Registration Fees</label>
                        <p class="text-xl font-bold text-white font-mono">
                            {{ $event->fees > 0 ? '₹ ' . number_format($event->fees, 2) : 'FREE' }}
                        </p>
                    </div>

                    <div class="space-y-1">
                        <label class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Scheduled Time</label>
                        <p class="text-white flex items-center gap-2">
                            <i class="far fa-clock text-slate-500"></i>
                            {{ $event->time ?: 'Unscheduled' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Event Description -->
        <div class="lg:col-span-2">
            <div class="glass-card p-8 h-full">
                <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                    <i class="fas fa-info-circle text-indigo-500"></i>
                    Event Description
                </h3>
                
                <div class="prose prose-invert max-w-none text-slate-300 leading-relaxed">
                    @if($event->description)
                        {!! nl2br(e($event->description)) !!}
                    @else
                        <p class="italic text-slate-500">No description provided for this event.</p>
                    @endif
                </div>

                <div class="mt-12 pt-8 border-t border-white/5 grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1">Total Registrations</p>
                        <p class="text-3xl font-black text-white">{{ $event->registrationItems->count() }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1">Total Revenue</p>
                        <p class="text-3xl font-black text-indigo-400">₹ {{ number_format($event->registrationItems->count() * $event->fees, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
