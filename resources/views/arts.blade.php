<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>UTSAV 2025 | ആരവം</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #0a0a1a;
            --primary-pink-rgb: 236, 72, 153;
            --primary-pink: rgb(var(--primary-pink-rgb));
            --primary-purple-rgb: 124, 58, 237;
            --primary-purple: rgb(var(--primary-purple-rgb));
            --accent-blue: #3b82f6;
            --card-bg: rgba(15, 23, 42, 0.6);
            --text-main: #ffffff;
            --text-dim: #cbd5e1;
            --utsav-gradient: linear-gradient(135deg, #4c1d95 0%, #831843 50%, #0a0a1a 100%);
            --bg-color: #0a0a1a;
            --glass-bg: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.1);
            --nav-bg: rgba(10, 10, 26, 0.8);
            --section-bg: rgba(255, 255, 255, 0.02);
            --footer-bg: #050510;
            --input-bg: rgba(255, 255, 255, 0.06);
            --panel-bg: rgba(255, 255, 255, 0.03);
            --glow-color: rgba(30, 58, 138, 0.2);
            --rose-accent: #e11d48;
        }

        .light-theme {
            --bg-dark: #f8fafc;
            --bg-color: #f8fafc;
            --text-main: #0f172a;
            --text-dim: #475569;
            --card-bg: rgba(255, 255, 255, 0.8);
            --glass-bg: rgba(255, 255, 255, 0.8);
            --glass-border: rgba(59, 130, 246, 0.2);
            --utsav-gradient: linear-gradient(135deg, #fdf2f8 0%, #f8fafc 100%);
            --nav-bg: rgba(248, 250, 252, 0.8);
            --section-bg: rgba(236, 72, 153, 0.02);
            --footer-bg: #f1f5f9;
            --input-bg: rgba(15, 23, 42, 0.05);
            --panel-bg: rgba(255, 255, 255, 0.9);
            --glow-color: rgba(59, 130, 246, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-main);
            overflow-x: hidden;
            scroll-behavior: smooth;
            transition: background-color 0.4s ease, color 0.4s ease;
        }

        #bg-glow {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 50% 50%, var(--glow-color) 0%, transparent 70%);
            z-index: -1;
            pointer-events: none;
        }

        /* Standard Header Styles Override */
        .profile-trigger {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            border: 2px solid var(--accent-blue);
            cursor: pointer;
            overflow: hidden;
        }
        .profile-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            width: 200px;
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            display: none;
            z-index: 1001;
        }
        .profile-dropdown.active { display: block; }

        /* Utsav Specific */
        .hero {
            height: 100vh;
            background: var(--utsav-gradient);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 0 10%;
            position: relative;
        }

        #hero-particles {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            z-index: 1; pointer-events: none;
        }

        .hero-tag { color: var(--primary-pink); letter-spacing: 3px; font-weight: 700; margin-bottom: 1rem; }
        .hero h1 { font-size: 5rem; font-weight: 900; margin-bottom: 1rem; letter-spacing: -2px; }
        .hero p { font-size: 1.5rem; color: var(--text-dim); margin-bottom: 2rem; max-width: 600px; }

        .btn-reg {
            background: var(--primary-pink);
            padding: 15px 40px;
            border-radius: 12px;
            color: white;
            font-weight: 800;
            text-decoration: none;
            transition: 0.3s;
            box-shadow: 0 10px 20px rgba(var(--primary-pink-rgb), 0.3);
        }
        .btn-reg:hover { transform: translateY(-3px); box-shadow: 0 15px 30px rgba(var(--primary-pink-rgb), 0.5); }

        /* Countdown */
        .countdown-container { display: flex; gap: 20px; margin-top: 40px; }
        .countdown-item {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 20px;
            min-width: 100px;
        }
        .countdown-value { display: block; font-size: 2.5rem; font-weight: 900; color: var(--primary-pink); }
        .countdown-label { font-size: 0.8rem; text-transform: uppercase; color: var(--text-dim); }

        /* Sections */
        .about-section { padding: 100px 10%; display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center; }
        .about-img { width: 100%; border-radius: 30px; box-shadow: 0 20px 40px rgba(0,0,0,0.3); }
        .about-content h2 { font-size: 3rem; margin-bottom: 20px; font-weight: 800; }
        .about-content p { font-size: 1.1rem; color: var(--text-dim); line-height: 1.8; margin-bottom: 20px; }

        .events-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; padding: 0 10% 100px; }
        .event-card {
            background: var(--card-bg);
            border: 1px solid var(--glass-border);
            padding: 40px;
            border-radius: 24px;
            cursor: pointer;
            transition: 0.4s;
            position: relative;
        }
        .event-card:hover { transform: translateY(-10px); border-color: var(--primary-pink); background: rgba(var(--primary-pink-rgb), 0.05); }
        .event-card.selected { border-color: var(--primary-pink); background: rgba(var(--primary-pink-rgb), 0.1); }
        .event-card h3 { font-size: 1.8rem; margin-bottom: 15px; font-weight: 700; }
        
        /* Category Selection */
        .category-selection {
            padding: 40px 10% 0;
            display: flex;
            justify-content: center;
            gap: 30px;
        }

        .category-btn {
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(var(--primary-pink-rgb), 0.3);
            color: white;
            padding: 15px 40px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            text-transform: uppercase;
            letter-spacing: 2px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .category-btn i {
            font-size: 1.2rem;
            color: var(--primary-pink);
        }

        .category-btn:hover {
            transform: translateY(-5px);
            border-color: var(--primary-pink);
            background: rgba(var(--primary-pink-rgb), 0.1);
        }

        .category-btn.active {
            background: var(--primary-pink);
            border-color: var(--primary-pink);
            box-shadow: 0 0 30px rgba(var(--primary-pink-rgb), 0.4);
        }

        .category-btn.active i {
            color: white;
        }

        /* Events Wrapper */
        .events-wrapper {
            display: grid;
            grid-template-rows: 0fr;
            transition: 1s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        .events-wrapper.open {
            grid-template-rows: 1fr;
        }

        .events-inner {
            min-height: 0;
        }

        /* Modern Registration Panel Styling */
        .global-reg-section {
            display: grid;
            grid-template-rows: 0fr;
            transition: 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            width: 100%;
            margin-top: 50px;
        }

        .global-reg-section.open {
            grid-template-rows: 1fr;
        }

        .reg-content-wrapper {
            min-height: 0;
            background: rgba(10, 10, 30, 0.95);
            border: 1px solid var(--primary-pink);
            border-radius: 30px;
            padding: 50px;
            backdrop-filter: blur(40px);
            max-width: 1150px;
            margin: 0 auto 100px;
            box-shadow: 0 40px 100px rgba(0, 0, 0, 0.6), 0 0 30px rgba(var(--primary-pink-rgb), 0.1);
        }

        .reg-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .reg-header h2 {
            font-size: 3rem;
            font-weight: 900;
            color: var(--primary-pink);
            letter-spacing: -1px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .reg-header p {
            color: var(--text-dim);
            font-size: 1.1rem;
        }

        .selection-visualizer {
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 40px;
        }

        .selection-visualizer h4 {
            color: var(--primary-purple);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-align: center;
            margin-bottom: 20px;
            font-weight: 800;
        }

        .chips-container {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: center;
        }

        .event-chip {
            background: rgba(var(--primary-pink-rgb), 0.1);
            color: var(--primary-pink);
            padding: 10px 22px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 700;
            border: 1px solid rgba(var(--primary-pink-rgb), 0.3);
            animation: chipIn 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        @keyframes chipIn {
            from { transform: scale(0.8); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        .registration-form-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            max-width: 950px;
            margin: 0 auto;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .input-group label {
            font-size: 0.75rem;
            text-transform: uppercase;
            color: var(--text-dim);
            letter-spacing: 1.5px;
            font-weight: 700;
        }

        .input-group input,
        .input-group select {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 18px 24px;
            border-radius: 16px;
            color: white;
            font-size: 1rem;
            outline: none;
            transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .input-group input:focus,
        .input-group select:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--primary-pink);
            box-shadow: 0 0 20px rgba(var(--primary-pink-rgb), 0.2);
            transform: translateY(-2px);
        }

        .submit-btn-wrapper {
            grid-column: span 3;
            margin-top: 20px;
        }

        .confirm-reg-btn {
            width: 100%;
            background: linear-gradient(135deg, var(--primary-pink), var(--primary-purple));
            border: none;
            padding: 22px;
            border-radius: 18px;
            color: white;
            font-weight: 900;
            font-size: 1.2rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            cursor: pointer;
            transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 20px 40px rgba(var(--primary-pink-rgb), 0.2);
        }

        .confirm-reg-btn:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 30px 60px rgba(var(--primary-pink-rgb), 0.4);
            filter: brightness(1.1);
        }

        .confirm-reg-btn:active {
            transform: scale(0.98);
        }

        @media (max-width: 900px) {
            .registration-form-grid {
                grid-template-columns: 1fr;
            }
            .submit-btn-wrapper {
                grid-column: span 1;
            }
        }

        /* Reveal Styles */
        .reveal { opacity: 1; transition: 1s ease; }
        .reveal-hidden { opacity: 0; transform: translateY(30px); }
        .reveal.active { opacity: 1; transform: translateY(0); }

        /* --- Highlights Slider --- */
        .highlights-section {
            padding: 80px 10%;
            background: var(--section-bg);
            overflow: hidden;
            position: relative;
        }

        .highlights-container {
            display: flex;
            gap: 30px;
            width: fit-content;
            animation: slideLeftUtsav 30s linear infinite;
        }

        .highlights-container:hover {
            animation-play-state: paused;
        }

        .highlight-card {
            min-width: 500px;
            height: 300px;
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: 0.5s;
        }

        .highlight-card:hover {
            transform: scale(1.05);
            border-color: var(--primary-pink);
            box-shadow: 0 0 40px rgba(var(--primary-pink-rgb), 0.3);
        }

        .highlight-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.8s;
        }

        .highlight-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(transparent, rgba(10, 10, 26, 0.8));
            display: flex;
            align-items: flex-end;
            padding: 30px;
            opacity: 0;
            transition: 0.5s;
        }

        .highlight-card:hover .highlight-overlay {
            opacity: 1;
        }

        .highlight-overlay h3 {
            color: var(--primary-pink);
            font-size: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        @keyframes slideLeftUtsav {
            0% { transform: translateX(0); }
            100% { transform: translateX(calc(-530px * 5)); }
        }

        footer { background: var(--footer-bg); padding: 80px 10% 40px; border-top: 1px solid var(--glass-border); }
    </style>
</head>

<body>
    <div id="bg-glow"></div>

    <!-- Header -->
    @include("partials.header")

    <section class="hero">
        <canvas id="hero-particles"></canvas>
        <span class="hero-tag reveal">ARTS FEST 2025</span>
        <h1 class="reveal">UTSAV</h1>
        <p class="reveal">Bringing colors to life and movements to soul. The grandest arts festival of GPTC Muttom.</p>
        <div class="hero-btns reveal">
            <a href="#featured-events" class="btn-reg">Register Now</a>
        </div>

        <div class="countdown-container reveal">
            <div class="countdown-item">
                <span class="countdown-value" id="days">00</span>
                <span class="countdown-label">Days</span>
            </div>
            <div class="countdown-item">
                <span class="countdown-value" id="hours">00</span>
                <span class="countdown-label">Hours</span>
            </div>
            <div class="countdown-item">
                <span class="countdown-value" id="minutes">00</span>
                <span class="countdown-label">Mins</span>
            </div>
            <div class="countdown-item">
                <span class="countdown-value" id="seconds">00</span>
                <span class="countdown-label">Secs</span>
            </div>
        </div>
    </section>

    <!-- Results Creative Banner -->
    <section class="results-banner reveal py-12 px-6">
        <div class="max-w-7xl mx-auto">
            <a href="{{ route('results', ['category' => 'Arts']) }}" class="group block relative overflow-hidden rounded-[2rem] border border-pink-500/30 bg-pink-500/5 p-8 md:p-12 transition-all hover:border-pink-500 hover:bg-pink-500/10">
                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                    <div>
                        <span class="text-pink-400 text-xs font-black uppercase tracking-[0.3em] mb-4 block">Creative Scores: Compiled</span>
                        <h2 class="text-3xl md:text-5xl font-black text-white mb-4">The Artistic Honor Roll</h2>
                        <p class="text-slate-400 text-lg max-w-xl">The curtain has fallen and the scores are in. Discover the maestros of Utsav 2025 who painted the campus with success.</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-2xl bg-pink-600 flex items-center justify-center text-white text-2xl group-hover:scale-110 transition-transform">
                            <i class="fas fa-palette"></i>
                        </div>
                        <i class="fas fa-chevron-right text-pink-400 text-2xl animate-pulse"></i>
                    </div>
                </div>
                <div class="absolute top-0 right-0 w-64 h-64 bg-pink-600/10 blur-[80px] rounded-full -mr-32 -mt-32"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-purple-600/10 blur-[60px] rounded-full -ml-24 -mb-24"></div>
            </a>
        </div>
    </section>

    <section class="about-section reveal" id="about">
        <img src="{{ asset('images/arts/painting.png') }}" class="about-img" alt="Utsav Theme">
        <div class="about-content">
            <h2>About Utsav</h2>
            <p>UTSAV is the ultimate stage for creativity, expression, and cultural pride. It brings together artists, performers, and creators from across the campus to compete, collaborate, and celebrate the spirit of arts.</p>
            <p>From the rhythmic beats of traditional dance to the soulful melodies of modern music, UTSAV is where passion meets performance.</p>
        </div>
    </section>

    <section class="category-selection reveal">
        <button class="category-btn" onclick="selectArtsCategory('indoor', this)">
            <i class="fas fa-theater-masks"></i> Indoor Arts
        </button>
        <button class="category-btn" onclick="selectArtsCategory('outdoor', this)">
            <i class="fas fa-palette"></i> Outdoor Arts
        </button>
    </section>

    <div class="events-wrapper" id="artsEventsWrapper">
        <div class="events-inner">
            <section class="py-20" id="featured-events">
                <div class="text-center mb-16 reveal">
                    <h2 class="text-4xl font-black mb-4 uppercase" id="categoryTitle">Featured Events</h2>
                    <p class="text-gray-400" id="categoryDesc">Select your stage and shine.</p>
                </div>

                <div class="events-grid">
                    @forelse($events as $event)
                    <div class="event-card reveal" 
                         data-category="{{ strtolower($event->sub_category) }}" 
                         data-name="{{ $event->name }}" 
                         data-id="{{ $event->id }}"
                         onclick="selectEvent(this)">
                        <div class="flex justify-between items-start mb-4">
                            @if($event->image_path)
                                <img src="{{ asset('storage/' . $event->image_path) }}" class="card-img" alt="{{ $event->name }}">
                            @else
                                <img src="{{ asset('images/arts/' . strtolower(str_replace([' ', '&'], ['_'], $event->name)) . '.png') }}" 
                                     class="card-img" 
                                     alt="{{ $event->name }}"
                                     onerror="this.src='https://images.unsplash.com/photo-1460661419201-fd4cecea8f82?q=80&w=1480&auto=format&fit=crop'">
                            @endif

                            @if($event->has_results > 0)
                            <a href="{{ route('results', ['category' => 'Arts', 'event_id' => $event->id]) }}" 
                               class="absolute top-4 right-4 z-20 inline-flex items-center gap-2 px-3 py-1.5 bg-pink-600 text-white text-[10px] font-black uppercase tracking-widest rounded-xl shadow-lg hover:scale-105 transition-all" 
                               onclick="event.stopPropagation()">
                                <i class="fas fa-trophy"></i> Results
                            </a>
                            @endif
                        </div>
                        <h3 class="text-2xl font-bold mb-2">{{ $event->name }}</h3>
                        <p class="dynamic-text-muted text-sm">{{ $event->description }}</p>
                        <div style="display:flex; justify-content:space-between; margin-top:15px; color:var(--primary-pink); font-weight:bold;">
                            <span>{{ $event->fees > 0 ? '₹ ' . number_format($event->fees, 0) : 'FREE' }}</span>
                            <span>{{ $event->sub_category }}</span>
                        </div>
                        @if($event->time)
                        <div style="margin-top:8px; font-size: 0.85rem; color: #a4b0be; display: flex; align-items: center; gap: 5px;">
                            <i class="far fa-clock"></i> {{ $event->time }}
                        </div>
                        @endif
                    </div>
                    @empty
                    <div class="col-span-full py-20 text-center opacity-50">
                        <i class="fas fa-calendar-times text-5xl mb-4 block"></i>
                        <p>No events found in this category.</p>
                    </div>
                    @endforelse
                </div>

                <div class="text-center mt-12 reveal">
                    <a href="{{ route('arts.list') }}" class="inline-block bg-white/5 border border-pink-500/30 hover:bg-pink-500/10 px-8 py-3 rounded-xl text-sm font-bold transition-all active:scale-95">
                        <i class="fas fa-list-ul mr-2"></i> View Full Schedule & Activity Points
                    </a>
                </div>
            </section>
        </div>
    </div>

    <section class="global-reg-section" id="globalReg">
        <div class="reg-content-wrapper reveal">
            <div class="reg-header">
                <h2>Event Registration</h2>
                <p>Provide your official details to secure your spot in UTSAV 2025</p>
            </div>

            <div class="selection-visualizer">
                <h4>You are registering for:</h4>
                <div class="chips-container" id="regChips">
                    <span class="text-gray-500 italic">No events selected yet</span>
                </div>
            </div>

            <form class="registration-form-grid" onsubmit="handleRegistration(event)">
                <div class="input-group">
                    <label>Full Name</label>
                    <input type="text" placeholder="Enter your name" required>
                </div>
                <div class="input-group">
                    <label>Roll Number</label>
                    <input type="text" placeholder="Enter Roll Number" required>
                </div>
                <div class="input-group">
                    <label>Semester</label>
                    <select required>
                        <option value="" disabled selected>Select Semester</option>
                        <option>S1</option><option>S2</option><option>S3</option><option>S4</option><option>S5</option><option>S6</option>
                    </select>
                </div>
                <div class="input-group">
                    <label>College Email</label>
                    <input type="email" placeholder="example@gptcmuttom.ac.in" required>
                </div>
                <div class="input-group" style="grid-column: span 2;">
                    <label>Department</label>
                    <input type="text" id="deptInput" list="deptList" placeholder="Search or select department" required>
                    <datalist id="deptList">
                        <option value="CT">Computer Engineering</option>
                        <option value="ME">Mechanical Engineering</option>
                        <option value="EEE">Electrical Engineering</option>
                        <option value="CE">Civil Engineering</option>
                        <option value="EL">Electronics Engineering</option>
                    </datalist>
                </div>
                <div class="submit-btn-wrapper">
                    <button type="submit" class="confirm-reg-btn">Complete Registration</button>
                </div>
            </form>
        </div>
    </section>

    <section class="highlights-section reveal">
        <div class="section-title reveal" style="text-align: center; margin-bottom: 50px;">
            <h2 class="text-3xl font-bold">Previous Year Highlights</h2>
            <p class="text-gray-400">Relive the magic of our past celebrations</p>
        </div>
        <div class="highlights-container">
            <div class="highlight-card">
                <img src="{{ asset('images/arts/music.png') }}" alt="Musical Night">
                <div class="highlight-overlay"><h3>Epic Musical Night</h3></div>
            </div>
            <div class="highlight-card">
                <img src="{{ asset('images/arts/dance.png') }}" alt="Dance Showcase">
                <div class="highlight-overlay"><h3>Dance Showcase</h3></div>
            </div>
            <div class="highlight-card">
                <img src="{{ asset('images/arts/carnival.png') }}" alt="Carnival">
                <div class="highlight-overlay"><h3>Grand Carnival</h3></div>
            </div>
            <div class="highlight-card">
                <img src="{{ asset('images/arts/mural.png') }}" alt="Mural Art">
                <div class="highlight-overlay"><h3>Mural Art Exhibition</h3></div>
            </div>
            <div class="highlight-card">
                <img src="{{ asset('images/arts/street_dance.png') }}" alt="Street Dance">
                <div class="highlight-overlay"><h3>Street Dance Battle</h3></div>
            </div>
            <!-- Duplicates for seamless loop -->
            <div class="highlight-card">
                <img src="{{ asset('images/arts/music.png') }}" alt="Musical Night">
                <div class="highlight-overlay"><h3>Epic Musical Night</h3></div>
            </div>
            <div class="highlight-card">
                <img src="{{ asset('images/arts/dance.png') }}" alt="Dance Showcase">
                <div class="highlight-overlay"><h3>Dance Showcase</h3></div>
            </div>
        </div>
    </section>

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
                    <li><a href="{{ route('results', ['category' => 'Arts']) }}" class="hover:text-blue-500 transition">Results Board</a></li>
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
        // Reveal Logic
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                    entry.target.classList.remove('reveal-hidden');
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.reveal').forEach(el => {
            el.classList.add('reveal-hidden');
            observer.observe(el);
        });

        // Category Selection
        function selectArtsCategory(category, btn) {
            document.querySelectorAll('.category-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const title = document.getElementById('categoryTitle');
            const desc = document.getElementById('categoryDesc');
            title.textContent = category === 'indoor' ? 'Indoor Arts' : 'Outdoor Arts';
            desc.textContent = category === 'indoor' ? 'Theater, Music, and Gallery exhibitions.' : 'Carnivals, Street Battles, and Open Stage sessions.';

            const cards = document.querySelectorAll('.event-card');
            cards.forEach(card => {
                if (card.getAttribute('data-category') === category) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });

            const wrapper = document.getElementById('artsEventsWrapper');
            if (!wrapper.classList.contains('open')) {
                wrapper.classList.add('open');
            }

            setTimeout(() => {
                wrapper.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }, 300);
        }

        // Event Selection
        let selectedEvents = new Map(); // Store [id, name]
        function selectEvent(card) {
            const eventName = card.getAttribute('data-name');
            const eventId = card.getAttribute('data-id');
            
            if (selectedEvents.has(eventId)) {
                selectedEvents.delete(eventId);
                card.classList.remove('selected', 'ring-4', 'ring-pink-500');
            } else {
                selectedEvents.set(eventId, eventName);
                card.classList.add('selected', 'ring-4', 'ring-pink-500');
                // Automatically open registration form when an item is selected
                triggerSlideDown();
            }
            
            syncSelection();
        }

        function syncSelection() {
            const chipsContainer = document.getElementById('regChips');
            chipsContainer.innerHTML = '';
            
            if (selectedEvents.size === 0) {
                chipsContainer.innerHTML = '<span class="text-gray-500 italic">No events selected yet</span>';
                document.getElementById('globalReg').classList.remove('open');
                return;
            }

            selectedEvents.forEach((name, id) => {
                const chip = document.createElement('span');
                chip.className = 'event-chip';
                chip.textContent = name;
                chipsContainer.appendChild(chip);
            });
        }

        function triggerSlideDown() {
            const regSection = document.getElementById('globalReg');
            if (!regSection.classList.contains('open')) {
                regSection.classList.add('open');
                setTimeout(() => {
                    regSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }, 100);
            }
        }

        async function handleRegistration(event) {
            event.preventDefault();
            const form = event.target;
            const inputs = form.querySelectorAll('input, select');
            const deptValue = document.getElementById('deptInput').value.trim().toLowerCase();
            const allowedDepts = ['ct', 'computer', 'me', 'mechanical', 'eee', 'electrical', 'ce', 'civil', 'el', 'electronics'];
            
            if (!allowedDepts.includes(deptValue)) {
                alert('Invalid Department! Please enter one of: CT, Computer, ME, Mechanical, EEE, Electrical, CE, Civil, EL, or Electronics.');
                document.getElementById('deptInput').focus();
                document.getElementById('deptInput').style.borderColor = '#ec4899';
                return;
            }

            const data = {
                student_name: inputs[0].value,
                reg_no: inputs[1].value,
                semester: inputs[2].value,
                email: inputs[3].value,
                department: document.getElementById('deptInput').value,
                event_ids: Array.from(selectedEvents.keys())
            };

            const submitBtn = form.querySelector('button');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Processing...';
            submitBtn.disabled = true;

            try {
                const response = await fetch('{{ route("registrations.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (response.ok) {
                    alert('Registration Successful! Welcome to UTSAV 2025.');
                    // Reset
                    selectedEvents.clear();
                    document.querySelectorAll('.event-card').forEach(c => {
                        c.classList.remove('selected', 'ring-4', 'ring-pink-500');
                    });
                    syncSelection();
                    form.reset();
                    document.getElementById('globalReg').classList.remove('open');
                } else {
                    alert(result.message || 'Registration failed. Please try again.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred. Please check your connection.');
            } finally {
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            }
        }

        // Profile Toggle
        const trigger = document.getElementById('profileTrigger');
        const dropdown = document.getElementById('profileDropdown');
        if (trigger) {
            trigger.onclick = (e) => {
                e.stopPropagation();
                dropdown.classList.toggle('active');
            };
            document.onclick = () => dropdown.classList.remove('active');
        }

        // Countdown
        (function() {
            const target = new Date("March 25, 2026 09:00:00").getTime();
            setInterval(() => {
                const now = new Date().getTime();
                const d = Math.max(0, target - now);
                
                document.getElementById('days').innerText = Math.floor(d / (1000 * 60 * 60 * 24)).toString().padStart(2, '0');
                document.getElementById('hours').innerText = Math.floor((d % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)).toString().padStart(2, '0');
                document.getElementById('minutes').innerText = Math.floor((d % (1000 * 60 * 60)) / (1000 * 60)).toString().padStart(2, '0');
                document.getElementById('seconds').innerText = Math.floor((d % (1000 * 60)) / 1000).toString().padStart(2, '0');
            }, 1000);
        })();

        // Particles
        (function() {
            const canvas = document.getElementById('hero-particles');
            const ctx = canvas.getContext('2d');
            let particles = [];
            function resize() { canvas.width = canvas.offsetWidth; canvas.height = canvas.offsetHeight; }
            window.onresize = resize; resize();

            class Particle {
                constructor() { this.reset(); }
                reset() {
                    this.x = Math.random() * canvas.width;
                    this.y = Math.random() * canvas.height;
                    this.vx = (Math.random() - 0.5) * 0.5;
                    this.vy = (Math.random() - 0.5) * 0.5;
                    this.size = Math.random() * 2 + 1;
                    this.alpha = Math.random() * 0.5;
                }
                update() {
                    this.x += this.vx; this.y += this.vy;
                    if (this.x < 0 || this.x > canvas.width || this.y < 0 || this.y > canvas.height) this.reset();
                }
                draw() {
                    ctx.fillStyle = `rgba(236, 72, 153, ${this.alpha})`;
                    ctx.beginPath(); ctx.arc(this.x, this.y, this.size, 0, Math.PI*2); ctx.fill();
                }
            }
            for(let i=0; i<80; i++) particles.push(new Particle());
            function animate() {
                ctx.clearRect(0,0,canvas.width, canvas.height);
                particles.forEach(p => { p.update(); p.draw(); });
                requestAnimationFrame(animate);
            }
            animate();
        })();

        // Mouse Glow
        document.onmousemove = (e) => {
            const glow = document.getElementById('bg-glow');
            glow.style.transform = `translate(${e.clientX - window.innerWidth/2}px, ${e.clientY - window.innerHeight/2}px)`;
        };
    </script>
</body>

</html>
