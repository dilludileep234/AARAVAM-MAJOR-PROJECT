<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results Board | Aaravam</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #020617; }
        h1, h2, h3 { font-family: 'Outfit', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.05); }
        .gold-glow { box-shadow: 0 0 20px rgba(234, 179, 8, 0.2); border-color: rgba(234, 179, 8, 0.3) !important; }
        .silver-glow { box-shadow: 0 0 20px rgba(148, 163, 184, 0.2); border-color: rgba(148, 163, 184, 0.3) !important; }
        .bronze-glow { box-shadow: 0 0 20px rgba(180, 83, 9, 0.2); border-color: rgba(180, 83, 9, 0.3) !important; }

        .light-theme {
            background-color: #f1f5f9;
            --bg-color: #f1f5f9;
            --text-main: #0f172a;
            --text-muted: #334155;
            --glass-bg: rgba(255, 255, 255, 0.7);
            --glass-border: rgba(15, 23, 42, 0.1);
            --header-bg: rgba(241, 245, 249, 0.85);
        }

        .light-theme body { background-color: #f1f5f9; }
        .light-theme .text-white { color: #0f172a !important; }
        .light-theme .text-slate-200 { color: #1e293b !important; }
        .light-theme .text-slate-400 { color: #475569 !important; }
        .light-theme .text-slate-500 { color: #64748b !important; }
        .light-theme .glass { background: rgba(255, 255, 255, 0.7); border-color: rgba(15, 23, 42, 0.1); }
        .light-theme .bg-slate-950\/50 { background-color: rgba(241, 245, 249, 0.9); }
    </style>
</head>
<body class="text-slate-200 min-h-screen">
    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 glass border-b border-white/5">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-cyan-500 to-blue-600 flex items-center justify-center">
                    <i class="fas fa-trophy text-white text-lg"></i>
                </div>
                <span class="text-2xl font-black text-white tracking-tighter">AARAVAM</span>
            </a>
            <div class="flex items-center gap-8">
                <a href="{{ route('home') }}" class="text-sm font-medium hover:text-cyan-400 transition">Back to Home</a>
                @guest
                    <a href="{{ route('student') }}" class="bg-white/10 hover:bg-white/20 text-white px-6 py-2 rounded-full text-sm font-bold transition">Sign In</a>
                @else
                    <a href="{{ route('portal') }}" class="bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-2 rounded-full text-sm font-bold transition">My Portal</a>
                @endguest
            </div>
        </div>
    </nav>

    <main class="pt-32 pb-20 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <span class="px-4 py-1.5 bg-cyan-500/10 text-cyan-400 rounded-full text-xs font-bold uppercase tracking-widest border border-cyan-500/20">Hall of Fame</span>
                <h1 class="text-5xl md:text-6xl font-black text-white mt-6 mb-4">Competition Results</h1>
                <p class="text-slate-400 text-lg max-w-2xl mx-auto">Celebrating the brilliance, dedication, and sportsmanship of our incredible participants.</p>
            </div>

            <!-- Category Filter -->
            <div class="flex flex-wrap justify-center gap-4 mb-8">
                @foreach($categories as $category)
                <a href="{{ route('results', ['category' => $category]) }}" 
                   class="px-8 py-3 rounded-2xl font-bold transition-all border {{ strtolower($selectedCategory) == strtolower($category) ? 'bg-cyan-600 border-cyan-500 text-white shadow-lg shadow-cyan-600/20' : 'bg-white/5 border-white/5 text-slate-400 hover:bg-white/10 hover:border-white/10' }}">
                    {{ $category }}
                </a>
                @endforeach
            </div>

            <!-- Event Specific Filter & Search -->
            <div class="max-w-4xl mx-auto mb-16 flex flex-col md:flex-row gap-4 items-center">
                <div class="flex-[3] relative w-full">
                    <i class="fas fa-search absolute left-6 top-1/2 -translate-y-1/2 text-slate-500"></i>
                    <input type="text" id="eventSearch" placeholder="Search for an event (e.g. Running, Dance...)" 
                           class="w-full bg-white/5 border border-white/10 rounded-2xl py-4 pl-14 pr-6 text-white outline-none focus:border-cyan-500/50 transition-all">
                </div>
                <div class="flex-[2] w-full">
                    <select onchange="window.location.href=this.value" 
                            class="w-full bg-white/5 border border-white/10 rounded-2xl py-4 px-6 text-slate-400 outline-none focus:border-cyan-500/50 transition-all appearance-none cursor-pointer text-center">
                        <option value="{{ route('results', ['category' => $selectedCategory]) }}">All {{ $selectedCategory }} Events</option>
                        @foreach($allEventsInCategory as $catEvent)
                            <option value="{{ route('results', ['category' => $selectedCategory, 'event_id' => $catEvent->id]) }}" {{ $selectedEventId == $catEvent->id ? 'selected' : '' }}>
                                {{ $catEvent->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <a href="{{ route('results.export', ['category' => $selectedCategory]) }}" 
                   class="w-full md:w-16 h-14 flex items-center justify-center bg-cyan-600 hover:bg-cyan-700 text-white rounded-2xl shadow-lg shadow-cyan-600/20 transition-all" 
                   title="Export Leaderboard">
                    <i class="fas fa-file-csv text-xl"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 gap-12" id="eventsContainer">
                @forelse($events as $event)
                <div class="event-result-card glass rounded-[2rem] p-8 md:p-12 transition-all duration-500" data-event-name="{{ strtolower($event->name) }}">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12 pb-8 border-b border-white/5">
                        <div class="flex items-center gap-6">
                            <div class="w-20 h-20 rounded-2xl overflow-hidden bg-slate-900 border border-white/5">
                                <img src="{{ $event->getDisplayImage() }}" class="w-full h-full object-cover" onerror="this.src='{{ asset('images/default-event.png') }}';">
                            </div>
                            <div>
                                <h2 class="text-3xl font-black text-white">{{ $event->name }}</h2>
                                <p class="text-slate-500 font-medium">{{ $event->category }} • {{ $event->registrationItems->count() }} Competitors</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="px-4 py-2 bg-white/5 rounded-xl text-xs font-bold text-slate-400 border border-white/10 uppercase tracking-widest">{{ $event->sub_category }}</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        @php
                            $rank1Items = $event->registrationItems->where('rank', '1');
                            $rank2Items = $event->registrationItems->where('rank', '2');
                            $rank3Items = $event->registrationItems->where('rank', '3');
                            $others = $event->registrationItems->whereNotNull('rank')->whereNotIn('rank', ['1', '2', '3']);
                        @endphp

                        <!-- Silver / 2nd Place -->
                        <div class="order-2 md:order-1 flex flex-col gap-4">
                            @foreach($rank2Items as $item)
                            <div class="glass silver-glow p-6 rounded-3xl flex flex-col items-center text-center relative overflow-hidden group hover:bg-white/5 transition-all">
                                <div class="absolute top-0 right-0 px-4 py-1 bg-slate-400 text-slate-900 text-[10px] font-black uppercase rounded-bl-xl">2nd Place</div>
                                <div class="w-16 h-16 rounded-full bg-slate-400/20 flex items-center justify-center mb-4 text-slate-400 text-2xl font-bold border border-slate-400/20 group-hover:scale-110 transition-transform">
                                    {{ substr($item->registration->student_name, 0, 1) }}
                                </div>
                                <h3 class="text-lg font-bold text-white">{{ $item->registration->student_name }}</h3>
                                <p class="text-xs text-slate-500 mb-4">{{ $item->registration->department }}</p>
                                <div class="mt-auto px-4 py-2 bg-white/5 rounded-xl border border-white/5">
                                    <span class="text-slate-400 text-xs font-bold uppercase tracking-widest">Score: {{ $item->score }}</span>
                                </div>
                            </div>
                            @endforeach
                            @if($rank2Items->isEmpty())
                                <div class="h-full min-h-[150px] border border-dashed border-white/5 rounded-3xl flex items-center justify-center text-slate-700">
                                    <span class="text-xs uppercase font-bold tracking-widest">No 2nd Place</span>
                                </div>
                            @endif
                        </div>

                        <!-- Gold / Champion -->
                        <div class="order-1 md:order-2 flex flex-col gap-6">
                            @foreach($rank1Items as $item)
                            <div class="glass gold-glow p-8 rounded-3xl flex flex-col items-center text-center relative overflow-hidden transform md:scale-105 z-10 bg-slate-950 group hover:scale-[1.08] transition-all">
                                <div class="absolute top-0 right-0 px-6 py-2 bg-yellow-500 text-yellow-950 text-xs font-black uppercase rounded-bl-2xl shadow-xl">Champion</div>
                                <div class="w-24 h-24 rounded-full bg-yellow-500/20 flex items-center justify-center mb-6 text-yellow-500 text-4xl font-bold border border-yellow-500/30 group-hover:rotate-12 transition-transform">
                                    {{ substr($item->registration->student_name, 0, 1) }}
                                </div>
                                <h3 class="text-2xl font-black text-white mb-1">{{ $item->registration->student_name }}</h3>
                                <p class="text-sm text-yellow-500/70 font-bold uppercase tracking-widest mb-6">{{ $item->registration->department }}</p>
                                <div class="mt-auto px-6 py-3 bg-yellow-500/10 rounded-2xl border border-yellow-500/20">
                                    <span class="text-yellow-500 text-sm font-black uppercase tracking-widest">Grand Score: {{ $item->score }}</span>
                                </div>
                            </div>
                            @endforeach
                            @if($rank1Items->isEmpty())
                                <div class="h-full min-h-[200px] border-2 border-dashed border-yellow-500/10 rounded-3xl flex flex-col items-center justify-center text-slate-700">
                                    <i class="fas fa-trophy text-4xl mb-4 opacity-20"></i>
                                    <span class="text-sm uppercase font-black tracking-widest">Awaiting Champion</span>
                                </div>
                            @endif
                        </div>

                        <!-- Bronze / 3rd Place -->
                        <div class="order-3 flex flex-col gap-4">
                            @foreach($rank3Items as $item)
                            <div class="glass bronze-glow p-6 rounded-3xl flex flex-col items-center text-center relative overflow-hidden group hover:bg-white/5 transition-all">
                                <div class="absolute top-0 right-0 px-4 py-1 bg-amber-700 text-amber-50 text-[10px] font-black uppercase rounded-bl-xl">3rd Place</div>
                                <div class="w-16 h-16 rounded-full bg-amber-700/20 flex items-center justify-center mb-4 text-amber-700 text-2xl font-bold border border-amber-700/20 group-hover:scale-110 transition-transform">
                                    {{ substr($item->registration->student_name, 0, 1) }}
                                </div>
                                <h3 class="text-lg font-bold text-white">{{ $item->registration->student_name }}</h3>
                                <p class="text-xs text-slate-500 mb-4">{{ $item->registration->department }}</p>
                                <div class="mt-auto px-4 py-2 bg-white/5 rounded-xl border border-white/5">
                                    <span class="text-slate-400 text-xs font-bold uppercase tracking-widest">Score: {{ $item->score }}</span>
                                </div>
                            </div>
                            @endforeach
                            @if($rank3Items->isEmpty())
                                <div class="h-full min-h-[150px] border border-dashed border-white/5 rounded-3xl flex items-center justify-center text-slate-700">
                                    <span class="text-xs uppercase font-bold tracking-widest">No 3rd Place</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if($others->count() > 0)
                    <div class="mt-12 p-6 bg-white/5 rounded-2xl border border-white/5">
                        <h4 class="text-xs font-black text-slate-500 uppercase tracking-widest mb-4">Participation Honors</h4>
                        <div class="flex flex-wrap gap-4">
                            @foreach($others as $other)
                            <div class="px-4 py-2 bg-white/5 rounded-lg border border-white/5 text-xs text-slate-300 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-slate-600"></span>
                                <span class="font-bold text-white">{{ $other->registration->student_name }}</span>
                                <span class="text-slate-600">|</span>
                                <span class="text-slate-400 capitalize">{{ $other->registration->department }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                @empty
                <div class="text-center py-20 glass rounded-[2rem]">
                    <i class="fas fa-hourglass-half text-6xl text-slate-800 mb-6"></i>
                    <h3 class="text-2xl font-bold text-white mb-2">Results Awaited</h3>
                    <p class="text-slate-500">The evaluation for this category is currently in progress. Please check back later.</p>
                </div>
                @endforelse
            </div>
        </div>
    </main>

    <script>
        document.getElementById('eventSearch').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const cards = document.querySelectorAll('.event-result-card');
            
            cards.forEach(card => {
                const eventName = (card.getAttribute('data-event-name') || '').toLowerCase();
                if (eventName.includes(searchTerm)) {
                    card.style.display = 'block';
                    setTimeout(() => card.style.opacity = '1', 10);
                } else {
                    card.style.opacity = '0';
                    setTimeout(() => card.style.display = 'none', 500);
                }
            });
        });
    </script>


    <footer class="py-12 border-t border-white/5 bg-slate-950/50">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="text-slate-500 text-sm">© 2026 Aaravam Festival Commitee. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
