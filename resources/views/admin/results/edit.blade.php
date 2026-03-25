@extends(Auth::guard('admin')->user()->role == 'super_admin' ? 'layouts.admin' : 'layouts.category')

@section('title', 'Enter Results - ' . $event->name)

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.results.index') }}" class="text-cyan-500 hover:text-cyan-400 text-sm font-bold flex items-center gap-2 mb-4">
        <i class="fas fa-arrow-left"></i> Back to Events
    </a>
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-white">Performative Audit: {{ $event->name }}</h1>
            <p class="text-slate-400 mt-1">Assign scores and ranks to approved participants.</p>
        </div>
        @if($items->whereNotNull('rank')->count() > 0)
        <form action="{{ route('admin.results.destroy', $event) }}" method="POST" onsubmit="return confirm('Clear all results for this event?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-5 py-2.5 bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white rounded-xl text-xs font-bold uppercase tracking-widest border border-red-500/20 transition-all flex items-center gap-2">
                <i class="fas fa-trash-alt"></i> Clear Results
            </button>
        </form>
        @endif
    </div>
</div>

<div class="glass-card overflow-hidden">
    <form action="{{ route('admin.results.update', $event) }}" method="POST">
        @csrf
        @method('PATCH')
        
        <table class="w-full text-left">
            <thead class="bg-white/5 border-b border-white/5">
                <tr>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Participant</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Reg No / Dept</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400 w-32">Score</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400 w-48">Rank / Position</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($items as $item)
                <tr class="hover:bg-white/[0.02] transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded bg-slate-800 flex items-center justify-center text-xs font-bold text-slate-500">
                                {{ substr($item->registration->student_name, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-bold text-white">{{ $item->registration->student_name }}</p>
                                <p class="text-[10px] text-slate-500">{{ $item->registration->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-sm text-slate-300 font-mono">{{ $item->registration->reg_no }}</p>
                        <p class="text-[10px] text-slate-500">{{ $item->registration->department }} - {{ $item->registration->semester }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <input type="number" 
                               name="results[{{ $item->id }}][score]" 
                               value="{{ $item->score }}" 
                               placeholder="0"
                               class="w-full bg-slate-900/50 border border-white/10 rounded-lg py-2 px-3 text-white focus:outline-none focus:border-cyan-500 transition text-center font-mono">
                    </td>
                    <td class="px-6 py-4">
                        <select name="results[{{ $item->id }}][rank]" class="w-full bg-slate-900/50 border border-white/10 rounded-lg py-2 px-3 text-white focus:outline-none focus:border-cyan-500 transition">
                            <option value="">No Rank</option>
                            <option value="1" {{ $item->rank == '1' ? 'selected' : '' }}>🥇 1st Place</option>
                            <option value="2" {{ $item->rank == '2' ? 'selected' : '' }}>🥈 2nd Place</option>
                            <option value="3" {{ $item->rank == '3' ? 'selected' : '' }}>🥉 3rd Place</option>
                            <option value="Participation" {{ $item->rank == 'Participation' ? 'selected' : '' }}>Certificate</option>
                        </select>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-20 text-center text-slate-500 italic">
                        <i class="fas fa-user-slash text-4xl mb-4 block opacity-20"></i>
                        No approved participants found for this event.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        @if($items->count() > 0)
        <div class="p-6 bg-white/5 border-t border-white/5 flex justify-end">
            <button type="submit" class="bg-cyan-600 hover:bg-cyan-700 text-white px-8 py-3 rounded-xl font-bold transition active:scale-95 shadow-lg shadow-cyan-600/20">
                Commit Results
            </button>
        </div>
        @endif
    </form>
</div>
@endsection
