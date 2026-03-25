<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Calendar | ആരവം</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap');

        :root {
            --bg-color: #050a18;
            --text-main: #ffffff;
            --text-muted: #9ca3af;
            --glass-bg: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.1);
            --header-bg: rgba(5, 10, 24, 0.8);
            --card-hover: rgba(255, 255, 255, 0.07);
            --accent-blue: #3b82f6;

            /* Event Colors - Enhanced */
            --color-academic: #10b981;
            /* Emerald */
            --color-exam: #ef4444;
            /* Red */
            --color-internship: #f59e0b;
            /* Amber */
            --color-cultural: #8b5cf6;
            /* Violet */
            --color-sports: #06b6d4;
            /* Cyan */
            --color-holiday: #6b7280;
            /* Gray */
        }

        .light-theme {
            --bg-color: #f8fafc;
            --text-main: #0f172a;
            --text-muted: #475569;
            --glass-bg: rgba(255, 255, 255, 0.8);
            --glass-border: rgba(59, 130, 246, 0.2);
            --header-bg: rgba(248, 250, 252, 0.9);
            --card-hover: rgba(59, 130, 246, 0.05);
            --accent-blue: #2563eb;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-main);
            font-family: 'Inter', sans-serif;
            transition: background-color 0.4s ease, color 0.4s ease;
            min-height: 100vh;
        }

        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
        }

        /* Nav Link Hover */
        /* Nav Link Hover */
        .nav-link {
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: var(--accent-blue);
        }



        header .flex.items-center.gap-3 {
            display: flex;
            align-items: center;
            padding-left: 45px;
        }


        /* Calendar specific styles */

        /* Calendar specific styles */
        .day-cell {
            aspect-ratio: 1;
            width: 100%;
            max-width: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 0.8rem;
            font-weight: 700;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .day-cell:hover:not(.empty) {
            transform: scale(1.1);
            z-index: 10;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .day-off {
            opacity: 0.4;
            background: rgba(255, 255, 255, 0.05);
        }

        .light-theme .day-off {
            background: rgba(0, 0, 0, 0.05);
        }

        /* Profile section */
        .profile-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .profile-trigger {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            border: 2px solid var(--accent-blue);
            padding: 2px;
            cursor: pointer;
            transition: 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            overflow: hidden;
            background: var(--glass-bg);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile-trigger:hover {
            transform: scale(1.1);
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.4);
        }

        .profile-trigger img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .profile-dropdown {
            position: absolute;
            top: calc(100% + 15px);
            right: 0;
            width: 220px;
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 10px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            z-index: 1000;
        }

        .profile-dropdown.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            color: var(--text-main);
            text-decoration: none;
            border-radius: 12px;
            transition: 0.2s;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .dropdown-item:hover {
            background: rgba(59, 130, 246, 0.1);
            color: var(--accent-blue);
        }

        .dropdown-item i {
            width: 20px;
            text-align: center;
            font-size: 1rem;
        }

        .dropdown-divider {
            height: 1px;
            background: var(--glass-border);
            margin: 8px 10px;
        }

        /* Event Indicators */
        .event-dot {
            position: absolute;
            bottom: 4px;
            width: 4px;
            height: 4px;
            border-radius: 50%;
        }

        .day-cell[data-event]:hover::after {
            content: attr(data-event);
            position: absolute;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            background: #1e293b;
            color: white;
            padding: 0.4rem 0.6rem;
            border-radius: 0.4rem;
            font-size: 0.7rem;
            white-space: nowrap;
            z-index: 50;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
            pointer-events: none;
        }

        /* Event categories colors */
        .ev-academic {
            background-color: var(--color-academic);
            color: #fff;
        }

        .ev-exam {
            background-color: var(--color-exam);
            color: #fff;
        }

        .ev-internship {
            background-color: var(--color-internship);
            color: #000;
        }

        .ev-cultural {
            background-color: var(--color-cultural);
            color: #fff;
        }

        .ev-sports {
            background-color: var(--color-sports);
            color: #fff;
        }

        .ev-holiday {
            background-color: var(--color-holiday);
            color: #fff;
        }

        #bg-glow {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            pointer-events: none;
        }
    </style>
</head>

<body>
    <div id="bg-glow"></div>

    @include('partials.header')

    <main class="max-w-7xl mx-auto px-6 py-1">
        <div class="mb-1 text-center md:text-left">
            <h1 class="text-3xl md:text-4xl font-black mb-1 tracking-tight">{{ $settings['calendar_title'] }}</h1>
            <p class="opacity-60 font-medium">State Institute of Technical Teachers Training & Research | {{ $settings['academic_year'] }}</p>
        </div>

        <div class="grid lg:grid-cols-4 gap-4">
            <!-- Calendar Grid -->
            <div class="lg:col-span-3 grid md:grid-cols-2 lg:grid-cols-3 gap-2">
                @php
                    $startDate = \Carbon\Carbon::parse($settings['calendar_start_date'])->startOfMonth();
                @endphp

                @for ($i = 0; $i < 6; $i++)
                    @php
                        $currentMonth = $startDate->copy()->addMonths($i);
                        $monthName = $currentMonth->format('F');
                        $year = $currentMonth->format('Y');
                        $daysInMonth = $currentMonth->daysInMonth;
                        $firstDayOfWeek = $currentMonth->dayOfWeek; // 0 (Sun) to 6 (Sat)
                        
                        // Fetch events for this specific month
                        $monthEvents = $events->filter(function($event) use ($currentMonth) {
                            return \Carbon\Carbon::parse($event->date)->format('Y-m') == $currentMonth->format('Y-m');
                        });
                    @endphp

                    <div class="glass-card p-1 rounded-xl flex flex-col h-full">
                        <div class="pt-0.5 flex justify-between items-start mb-0.5">
                            <div>
                                <h2 class="text-xl font-black italic">{{ $monthName }}</h2>
                                <p class="text-[10px] uppercase tracking-widest opacity-60 font-bold">
                                    Events: {{ $monthEvents->count() }}
                                </p>
                            </div>
                            <span class="text-blue-500/50 font-black italic">{{ $year }}</span>
                        </div>
                        <div class="grid grid-cols-7 gap-1 text-center text-[10px] font-black opacity-40 mb-0.5 uppercase tracking-tighter">
                            <span>Sun</span><span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span>
                        </div>
                        <div class="grid grid-cols-7 gap-0.5 flex-grow pb-1">
                            {{-- Empty cells for days before the 1st of the month --}}
                            @for ($j = 0; $j < $firstDayOfWeek; $j++)
                                <div class="day-cell empty"></div>
                            @endfor

                            {{-- Days of the month --}}
                            @for ($day = 1; $day <= $daysInMonth; $day++)
                                @php
                                    $date = $currentMonth->copy()->day($day);
                                    $isWeekend = $date->isWeekend();
                                    $dayEvents = $monthEvents->filter(function($e) use ($date) {
                                        return \Carbon\Carbon::parse($e->date)->isSameDay($date);
                                    });
                                    
                                    $eventClass = '';
                                    $eventData = '';
                                    if ($dayEvents->count() > 0) {
                                        $mainEvent = $dayEvents->first();
                                        $typeClasses = [
                                            'event' => 'ev-academic',
                                            'exam' => 'ev-exam',
                                            'holiday' => 'ev-holiday',
                                            'other' => 'ev-internship'
                                        ];
                                        $eventClass = $typeClasses[$mainEvent->type] ?? 'ev-internship';
                                        $eventData = $mainEvent->title;
                                    }
                                @endphp

                                <div class="day-cell {{ $isWeekend ? 'day-off' : '' }} {{ $eventClass }}" 
                                     @if($eventData) data-event="{{ $eventData }}" @endif>
                                    {{ $day }}
                                </div>
                            @endfor
                        </div>
                    </div>
                @endfor
            </div>

            <!-- Sidebar / Legend -->
            <div class="space-y-6">
                <!-- Event Legend -->
                <div class="glass-card p-3 rounded-2xl">
                    <h3 class="text-md font-black mb-2 flex items-center gap-2">
                        <i class="fas fa-tags text-blue-500"></i> Categories
                    </h3>
                    <div class="grid grid-cols-2 lg:grid-cols-1 gap-1">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full ev-academic"></div>
                            <span class="text-[11px] font-semibold opacity-80">Academic Deadlines</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full ev-exam"></div>
                            <span class="text-[11px] font-semibold opacity-80">Exams / Assessment</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full ev-internship"></div>
                            <span class="text-[11px] font-semibold opacity-80">Internship / Training</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full ev-cultural"></div>
                            <span class="text-[11px] font-semibold opacity-80">Arts / Cultural Fests</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full ev-sports"></div>
                            <span class="text-[11px] font-semibold opacity-80">Sports Events</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full ev-holiday"></div>
                            <span class="text-[11px] font-semibold opacity-80">Holiday / Weekend</span>
                        </div>
                    </div>
                </div>

                <!-- Key Events List (Static) -->
                <div class="glass-card p-3 rounded-2xl">
                    <h3 class="text-md font-black mb-2 flex items-center gap-2">
                        <i class="fas fa-calendar-check text-blue-500"></i> Key Dates
                    </h3>
                    <ul class="space-y-2 max-h-60 overflow-y-auto pr-2 custom-scrollbar">
                        <li class="border-b border-white/5 pb-1">
                            <p class="text-[10px] font-bold text-blue-500 uppercase">Nov 24</p>
                            <p class="text-sm font-semibold opacity-80">Classes Commence</p>
                        </li>
                        <li class="border-b border-white/5 pb-1">
                            <p class="text-[10px] font-bold text-blue-500 uppercase">Dec 01</p>
                            <p class="text-sm font-semibold opacity-80">Internship Starts</p>
                        </li>
                        <li class="border-b border-white/5 pb-1">
                            <p class="text-[10px] font-bold text-blue-500 uppercase">Mar 17</p>
                            <p class="text-sm font-semibold opacity-80">Last Working Day</p>
                        </li>
                        <li class="pb-1">
                            <p class="text-[10px] font-bold text-blue-500 uppercase">Mar 24</p>
                            <p class="text-sm font-semibold opacity-80">End Semester Exam (T)</p>
                        </li>
                    </ul>
                </div>

                <!-- Dynamic Scheduled Events -->
                <div class="glass-card p-3 rounded-2xl">
                    <h3 class="text-md font-black mb-2 flex items-center gap-2">
                        <i class="fas fa-database text-indigo-500"></i> Scheduled Events
                    </h3>
                    @if($events && $events->count() > 0)
                        <ul class="space-y-3">
                            @foreach($events as $event)
                                <li class="border-b border-white/5 pb-2 last:border-0 last:pb-0">
                                    <div class="flex justify-between items-start mb-1">
                                        <p class="text-[10px] font-bold text-indigo-400 uppercase">
                                            {{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }}
                                        </p>
                                        <span class="text-[8px] px-1.5 py-0.5 rounded-full border border-indigo-500/20 bg-indigo-500/10 text-indigo-400 font-bold uppercase">
                                            {{ $event->type }}
                                        </span>
                                    </div>
                                    <p class="text-sm font-bold text-white">{{ $event->title }}</p>
                                    @if($event->description)
                                        <p class="text-[10px] text-slate-500 leading-tight mt-1">{{ Str::limit($event->description, 60) }}</p>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="py-4 text-center">
                            <p class="text-xs text-slate-500 italic">No dynamic events scheduled.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <footer class="pt-24 pb-12 px-6 md:px-12 border-t border-white/5 reveal reveal-up">
        <div class="max-w-7xl mx-auto grid md:grid-cols-4 gap-12 mb-20">
            <div class="col-span-1">
                <div class="flex items-center gap-3 mb-8">
                    <div class="bg-blue-600 w-9 h-9 rounded-xl flex items-center justify-center font-bold text-white">E</div>
                    <span class="text-2xl font-black tracking-widest">ആരവം</span>
                </div>
                <p class="dynamic-text-muted text-sm leading-relaxed">Connecting the dots for every student at GPTC Muttom. Join our journey to redefine campus excellence.</p>
            </div>

            <div>
                <h4 class="font-bold mb-8 uppercase tracking-widest text-xs">Explore</h4>
                <ul class="dynamic-text-muted text-sm space-y-4 font-medium">
                    <li><a href="{{ route('home') }}" class="hover:text-blue-500 transition">Home</a></li>
                    <li><a href="{{ route('fests') }}" class="hover:text-blue-500 transition">Fests</a></li>
                    <li><a href="{{ route('calendar') }}" class="hover:text-blue-500 transition">Academic Calendar</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-blue-500 transition">Contact</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold mb-8 uppercase tracking-widest text-xs">Contact</h4>
                <div class="dynamic-text-muted text-sm space-y-5">
                    <p class="flex items-start gap-4"><i class="fas fa-map-marker-alt text-blue-600 mt-1"></i> Idukki, Kerala, 685587</p>
                    <p class="flex items-center gap-4"><i class="fas fa-envelope text-blue-600"></i> aaravam@gptcmuttom.ac.in</p>
                    <p class="flex items-center gap-4"><i class="fas fa-phone text-blue-600"></i> +91 4862 255 310</p>
                </div>
            </div>

            <div>
                <h4 class="font-bold mb-8 uppercase tracking-widest text-xs">Follow Us</h4>
                <div class="flex space-x-3 text-gray-500">
                    <a href="https://www.facebook.com/GptcMuttomthodupuzha" target="_blank" class="w-9 h-9 bg-slate-900 rounded-lg flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-9 h-9 bg-slate-900 rounded-lg flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://gpcmuttom.ac.in/" target="_blank" class="w-9 h-9 bg-slate-900 rounded-lg flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all">
                        <i class="fas fa-globe"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="text-center dynamic-text-muted text-[10px] tracking-[0.4em] uppercase pt-10 border-t border-white/5">
            © 2026 ആരവം. Engineered by the Students of GPTC Muttom.
        </div>
    </footer>

    <script>
        // --- Parallax Mouse Glow ---
        const glow = document.getElementById('bg-glow');
        document.addEventListener('mousemove', (e) => {
            const x = (e.clientX / window.innerWidth - 0.5) * 60;
            const y = (e.clientY / window.innerHeight - 0.5) * 60;
            glow.style.transform = `translate(${x}px, ${y}px)`;
            glow.style.background = `radial-gradient(circle at ${e.clientX}px ${e.clientY}px, rgba(59, 130, 246, 0.1) 0%, transparent 70%)`;
        });

        // --- Profile Dropdown Logic ---
        const profileTrigger = document.getElementById('profileTrigger');
        const profileDropdown = document.getElementById('profileDropdown');

        if (profileTrigger && profileDropdown) {
            profileTrigger.addEventListener('click', (e) => {
                e.stopPropagation();
                profileDropdown.classList.toggle('active');
            });

            document.addEventListener('click', () => {
                profileDropdown.classList.remove('active');
            });
        }
    </script>
</body>

</html>
