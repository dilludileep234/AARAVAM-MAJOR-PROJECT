<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @include('partials.theme-system')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Major Fests | ആരവം</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #050a18;
            --text-main: #ffffff;
            --text-muted: #9ca3af;
            --glass-bg: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.1);
            --header-bg: rgba(5, 10, 24, 0.8);
            --card-hover: rgba(255, 255, 255, 0.07);
            --accent-blue: #3b82f6;
            --footer-bg: #020617;
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
            --footer-bg: #f1f5f9;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            transition: background-color 0.4s ease, color 0.4s ease;
        }

        .dynamic-text-muted {
            color: var(--text-muted);
        }

        .dynamic-text-main {
            color: var(--text-main);
        }

        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .glass-card:hover {
            transform: translateY(-10px);
            background: var(--card-hover);
            border-color: var(--accent-blue);
            box-shadow: 0 10px 30px -10px rgba(59, 130, 246, 0.3);
        }

        .gradient-text {
            background: linear-gradient(90deg, #60a5fa, #a78bfa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-color);
        }

        ::-webkit-scrollbar-thumb {
            background: #1e293b;
            border-radius: 10px;
        }

        /* Profile Dropdown */
        .profile-wrapper {
            position: relative;
        }

        .profile-trigger {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            border: 2px solid var(--accent-blue);
            cursor: pointer;
            transition: 0.3s;
            overflow: hidden;
            background: var(--glass-bg);
        }

        .profile-trigger:hover {
            transform: scale(1.1);
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.4);
        }

        .profile-trigger img {
            width: 100%;
            height: 100%;
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
        }

        .dropdown-divider {
            height: 1px;
            background: var(--glass-border);
            margin: 8px 10px;
        }
        /* Nav Link Hover */
        .nav-link {
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: var(--accent-blue);
        }

        /* Hamburger Menu Styles */
        .drawer-list {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 100vw;
            transform: translate(-100vw, 0);
            -ms-transform: translatex(-100vw);
            box-sizing: border-box;
            pointer-events: none;
            padding-top: 125px;
            transition: width 475ms ease-out, transform 450ms ease, border-radius 0.8s 0.1s ease;
            border-bottom-right-radius: 100vw;
            background: transparent;
            backdrop-filter: blur(10px);
            z-index: 100;
            margin-right: -50px;
        }

        @media (min-width: 768px) {
            .drawer-list {
                width: 40vw;
            }
        }

        .drawer-list ul {
            height: 100%;
            width: 100%;
            margin: 0;
            padding: 0;
            overflow: auto;
            overflow-x: hidden;
            pointer-events: auto;
        }

        .drawer-list li {
            list-style: none;
            text-transform: uppercase;
            pointer-events: auto;
            white-space: nowrap;
            box-sizing: border-box;
            transform: translatex(-100vw);
            -ms-transform: translatex(-100vw);
        }

        .drawer-list li:last-child {
            margin-bottom: 2em;
        }

        .drawer-list li a {
            text-decoration: none;
            color: #FEFEFE;
            text-align: center;
            display: block;
            padding: 1rem;
            font-size: calc(24px - .5vw);
        }

        @media (min-width: 768px) {
            .drawer-list li a {
                text-align: left;
                padding: 0.5rem;
                padding-left: 2rem;
            }
        }

        .drawer-list li a:hover {
            cursor: pointer;
            color: var(--accent-blue);
            background-color: var(--glass-bg);
            padding-left: 2rem;
        }

        .drawer-list li a i {
            margin-right: 15px;
            width: 25px;
            text-align: center;
            color: var(--accent-blue);
            font-size: 1.2rem;
        }

        input.hamburger {
            display: none;
        }

        input.hamburger:checked~.drawer-list {
            transform: translatex(0);
            border-bottom-right-radius: 0;
        }

        input.hamburger:checked~.drawer-list li {
            transform: translatex(0);
        }

        input.hamburger:checked~.drawer-list li:nth-child(1) {
            transition: transform 1s 0.08s cubic-bezier(0.29, 1.4, 0.44, 0.96);
        }

        input.hamburger:checked~.drawer-list li:nth-child(2) {
            transition: transform 1s 0.16s cubic-bezier(0.29, 1.4, 0.44, 0.96);
        }

        input.hamburger:checked~.drawer-list li:nth-child(3) {
            transition: transform 1s 0.24s cubic-bezier(0.29, 1.4, 0.44, 0.96);
        }

        input.hamburger:checked~.drawer-list li:nth-child(4) {
            transition: transform 1s 0.32s cubic-bezier(0.29, 1.4, 0.44, 0.96);
        }

        input.hamburger:checked~.drawer-list li:nth-child(5) {
            transition: transform 1s 0.40s cubic-bezier(0.29, 1.4, 0.44, 0.96);
        }

        input.hamburger:checked~label>i {
            background-color: transparent;
            transform: rotate(90deg);
        }

        input.hamburger:checked~label>i:before {
            transform: translate(-50%, -50%) rotate(45deg);
        }

        input.hamburger:checked~label>i:after {
            transform: translate(-50%, -50%) rotate(-45deg);
        }

        input.hamburger:checked~label close {
            color: var(--text-main);
            width: 60px;
        }

        input.hamburger:checked~label open {
            color: rgba(0, 0, 0, 0);
            width: 0;
        }

        label.hamburger {
            z-index: 9999;
            position: absolute;
            display: block;
            height: 30px;
            width: 30px;
            cursor: pointer;
            top: 50%;
            left: 20px;
            transform: translateY(-50%);
            flex-shrink: 0;
        }

        label.hamburger text close,
        label.hamburger text open {
            text-transform: uppercase;
            font-size: 0.8em;
            position: absolute;
            transform: translateY(30px);
            text-align: center;
            width: 60px;
            left: -15px;
            overflow: hidden;
            transition: width 0.25s 0.35s, color 0.45s 0.35s;
        }

        label.hamburger text close {
            color: rgba(0, 0, 0, 0);
            left: -15px;
            width: 0;
        }

        label.hamburger text open {
            color: var(--text-main);
            width: 60px;
        }

        label.hamburger>i {
            position: absolute;
            width: 100%;
            height: 2px;
            top: 50%;
            background-color: var(--text-main);
            pointer-events: auto;
            transition-duration: 0.35s;
            transition-delay: 0.35s;
        }

        label.hamburger>i:before,
        label.hamburger>i:after {
            position: absolute;
            display: block;
            width: 100%;
            height: 2px;
            left: 50%;
            background-color: var(--text-main);
            content: "";
            transition: transform 0.35s;
            transform-origin: 50% 50%;
        }

        label.hamburger:hover>i,
        label.hamburger:hover>i:before,
        label.hamburger:hover>i:after {
            background-color: var(--accent-blue);
        }

        label.hamburger>i:before {
            transform: translate(-50%, -8px);
        }

        label.hamburger>i:after {
            transform: translate(-50%, 8px);
        }

        header .flex.items-center.gap-3 {
            display: flex;
            align-items: center;
            padding-left: 45px;
        }
    </style>
</head>

<body class="overflow-x-hidden">

    @include('partials.header')

    <section class="text-center py-20 px-4 animate__animated animate__fadeIn">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Major Fests</h1>
        <p class="max-w-2xl mx-auto dynamic-text-muted text-lg">
            Experience the pinnacle of technical innovation and cultural celebration at GPTC Muttom's flagship events. Join thousands of students in these unforgettable experiences.
        </p>
    </section>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 px-10 max-w-6xl mx-auto mb-20">
        <div class="glass-card p-8 rounded-[2rem] text-center animate__animated animate__fadeInUp">
            <div class="text-3xl font-bold mb-2">5000+</div>
            <div class="text-gray-400 dynamic-text-muted text-sm uppercase tracking-widest">Participants</div>
        </div>
        <div class="glass-card p-8 rounded-[2rem] text-center animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
            <div class="text-3xl font-bold mb-2">6</div>
            <div class="text-gray-400 dynamic-text-muted text-sm uppercase tracking-widest">Days of Events</div>
        </div>
        <div class="glass-card p-8 rounded-[2rem] text-center animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
            <div class="text-3xl font-bold mb-2">₹10L+</div>
            <div class="text-gray-400 dynamic-text-muted text-sm uppercase tracking-widest">Total Prize</div>
        </div>
        <div class="glass-card p-8 rounded-[2rem] text-center animate__animated animate__fadeInUp" style="animation-delay: 0.3s">
            <div class="text-3xl font-bold mb-2">30+</div>
            <div class="text-gray-400 dynamic-text-muted text-sm uppercase tracking-widest">Events</div>
        </div>
    </div>

    <!-- ALGORYTHM -->
    <section class="px-10 max-w-7xl mx-auto mb-16">
        <div class="glass-card rounded-[2.5rem] p-8 md:p-12 flex flex-col md:flex-row gap-12 bg-gradient-to-br from-blue-900/20 to-transparent">
            <div class="flex-1 space-y-6">
                <span class="bg-blue-900/50 text-blue-400 px-4 py-1 rounded-full text-sm font-semibold">Technical Fest</span>
                <h2 class="text-5xl font-bold">ALGORYTHM</h2>
                <p class="italic dynamic-text-muted">Transform. Innovate. Elevate.</p>
                <p class="dynamic-text-muted leading-relaxed">
                    ALGORYTHM is GPTC Muttom's flagship technical fest that brings together the brightest minds to showcase innovation, compete in technical challenges, and learn from industry experts.
                </p>
                <div class="flex items-center space-x-2 dynamic-text-muted">
                    <span>📅 March 15-17, 2025</span>
                </div>
                <a href="{{ route('algorithm') }}" class="bg-blue-600 hover:bg-blue-700 px-8 py-3 rounded-xl font-bold flex items-center gap-2 group transition-all inline-flex">
                    Explore ALGORYTHM <span class="group-hover:translate-x-2 transition-transform">→</span>
                </a>
            </div>
            <div class="flex-1">
                <h3 class="text-xl font-bold mb-6">Highlights</h3>
                <ul class="space-y-4">
                    <li class="flex items-center gap-3 dynamic-text-muted hover:text-blue-400 transition"><span class="text-blue-500">✦</span> Industry Expert Keynotes</li>
                    <li class="flex items-center gap-3 dynamic-text-muted hover:text-blue-400 transition"><span class="text-blue-500">✦</span> Career Fair with 50+ Companies</li>
                    <li class="flex items-center gap-3 dynamic-text-muted hover:text-blue-400 transition"><span class="text-blue-500">✦</span> Innovation Lab Tours</li>
                    <li class="flex items-center gap-3 dynamic-text-muted hover:text-blue-400 transition"><span class="text-blue-500">✦</span> Networking Sessions</li>
                    <li class="flex items-center gap-3 dynamic-text-muted hover:text-blue-400 transition"><span class="text-blue-500">✦</span> Startup Pitching Competition</li>
                </ul>
            </div>
        </div>
    </section>


    <!-- CULTURAL FESTIVALS -->
    <section class="px-10 max-w-7xl mx-auto mb-20">
        <div class="glass-card rounded-[2.5rem] p-8 md:p-12 flex flex-col md:flex-row gap-12 bg-gradient-to-br from-pink-900/20 to-transparent">
            <div class="flex-1 space-y-6">
                <span class="bg-pink-900/50 text-pink-400 px-4 py-1 rounded-full text-sm font-semibold">Cultural Fest</span>
                <h2 class="text-5xl font-bold">CULTURAL FESTIVALS</h2>
                <p class="italic dynamic-text-muted">Culture. Passion. Pride.</p>
                <p class="dynamic-text-muted leading-relaxed">
                    GPTC Muttom's signature cultural festival honoring art, heritage, and harmony. A three-day journey of captivating performances, creative competitions, and moments that turn talent into timeless memories.
                </p>
                <div class="flex items-center space-x-2 dynamic-text-muted">
                    <span>📅 April 5-7, 2025</span>
                </div>
                <button class="bg-pink-600 hover:bg-pink-700 px-8 py-3 rounded-xl font-bold flex items-center gap-2 group transition-all" onclick="window.location.href='{{ route('cultural') }}'">
                    Explore Cultural Fests <span class="group-hover:translate-x-2 transition-transform">→</span>
                </button>
            </div>
            <div class="flex-1">
                <h3 class="text-xl font-bold mb-6">Highlights</h3>
                <ul class="space-y-4">
                    <li class="flex items-center gap-3 dynamic-text-muted hover:text-pink-400 transition"><span class="text-pink-500">✦</span> Celebrity Guest Performances</li>
                    <li class="flex items-center gap-3 dynamic-text-muted hover:text-pink-400 transition"><span class="text-pink-500">✦</span> Food Festival</li>
                    <li class="flex items-center gap-3 dynamic-text-muted hover:text-pink-400 transition"><span class="text-pink-500">✦</span> Cultural Night</li>
                    <li class="flex items-center gap-3 dynamic-text-muted hover:text-pink-400 transition"><span class="text-pink-500">✦</span> Traditional Arts Showcase</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- ARENA -->
    <section class="px-10 max-w-7xl mx-auto mb-20">
        <div class="glass-card rounded-[2.5rem] p-8 md:p-12 flex flex-col md:flex-row gap-12 bg-gradient-to-br from-emerald-900/20 to-transparent">
            <div class="flex-1 space-y-6">
                <span class="bg-emerald-900/50 text-emerald-400 px-4 py-1 rounded-full text-sm font-semibold">Sports Fest</span>
                <h2 class="text-5xl font-bold">ARENA</h2>
                <p class="italic dynamic-text-muted">Power. Speed. Glory.</p>
                <p class="dynamic-text-muted leading-relaxed">
                    ARENA is GPTC Muttom's grand sports extravaganza that celebrates sportsmanship and teamwork. A three-day festival filled with competitions and athletic excellence.
                </p>
                <div class="flex items-center space-x-2 dynamic-text-muted">
                    <span>📅 January 20-22, 2025</span>
                </div>
                <a href="{{ route('sports') }}" class="bg-emerald-600 hover:bg-emerald-700 px-8 py-3 rounded-xl font-bold flex items-center gap-2 group transition-all inline-flex">
                    Explore ARENA <span class="group-hover:translate-x-2 transition-transform">→</span>
                </a>
            </div>
            <div class="flex-1">
                <h3 class="text-xl font-bold mb-6">Highlights</h3>
                <ul class="space-y-4">
                    <li class="flex items-center gap-3 dynamic-text-muted hover:text-emerald-400 transition"><span class="text-emerald-500">✦</span> Inter-College Tournaments</li>
                    <li class="flex items-center gap-3 dynamic-text-muted hover:text-emerald-400 transition"><span class="text-emerald-500">✦</span> Athletic Championships</li>
                    <li class="flex items-center gap-3 dynamic-text-muted hover:text-emerald-400 transition"><span class="text-emerald-500">✦</span> Team Sports Competitions</li>
                    <li class="flex items-center gap-3 dynamic-text-muted hover:text-emerald-400 transition"><span class="text-emerald-500">✦</span> Sports Awards Ceremony</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- UTSAV -->
    <section class="px-10 max-w-7xl mx-auto mb-20 animate__animated animate__fadeInUp">
        <div class="glass-card rounded-[2.5rem] p-8 md:p-12 flex flex-col md:flex-row gap-12 bg-gradient-to-br from-rose-900/20 to-transparent">
            <div class="flex-1 space-y-6">
                <span class="bg-rose-900/50 text-rose-400 px-4 py-1 rounded-full text-sm font-semibold">Arts Fest</span>
                <h2 class="text-5xl font-bold">UTSAV</h2>
                <p class="italic dynamic-text-muted">Expression. Passion. Soul.</p>
                <p class="dynamic-text-muted leading-relaxed">
                    UTSAV is the grand celebration of creativity and talent at GPTC Muttom. From classical dance to modern music, it's a stage where every artist finds their voice.
                </p>
                <div class="flex items-center space-x-2 dynamic-text-muted">
                    <span>📅 February 25-27, 2025</span>
                </div>
                <a href="{{ route('arts') }}" class="bg-rose-600 hover:bg-rose-700 px-8 py-3 rounded-xl font-bold flex items-center gap-2 group transition-all inline-flex">
                    Explore UTSAV <span class="group-hover:translate-x-2 transition-transform">→</span>
                </a>
            </div>
            <div class="flex-1">
                <h3 class="text-xl font-bold mb-6">Highlights</h3>
                <ul class="space-y-4">
                    <li class="flex items-center gap-3 dynamic-text-muted hover:text-rose-400 transition"><span class="text-rose-500">✦</span> Classical & Cinematic Dance</li>
                    <li class="flex items-center gap-3 dynamic-text-muted hover:text-rose-400 transition"><span class="text-rose-500">✦</span> Musical Extravaganza</li>
                    <li class="flex items-center gap-3 dynamic-text-muted hover:text-rose-400 transition"><span class="text-rose-500">✦</span> Fine Arts Exhibition</li>
                    <li class="flex items-center gap-3 dynamic-text-muted hover:text-rose-400 transition"><span class="text-rose-500">✦</span> Literary Competitions</li>
                    <li class="flex items-center gap-3 dynamic-text-muted hover:text-rose-400 transition"><span class="text-rose-500">✦</span> Grand Closing Ceremony</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- ELEVATE -->
    <section class="px-10 max-w-7xl mx-auto mb-20 animate__animated animate__fadeInUp">
        <div class="glass-card rounded-[2.5rem] p-8 md:p-12 flex flex-col md:flex-row gap-12 bg-gradient-to-br from-purple-900/20 to-transparent">
            <div class="flex-1 space-y-6">
                <span class="bg-purple-900/50 text-purple-400 px-4 py-1 rounded-full text-sm font-semibold">Softskill Fest</span>
                <h2 class="text-5xl font-bold">ELEVATE</h2>
                <p class="italic dynamic-text-muted">Empower. Lead. Succeed.</p>
                <p class="dynamic-text-muted leading-relaxed">
                    ELEVATE is a premium training intensive designed to bridge the gap between technical expertise and professional excellence. Master high-impact soft skills and leadership values.
                </p>
                <div class="flex items-center space-x-2 dynamic-text-muted">
                    <span>📅 April 05-07, 2026</span>
                </div>
                <a href="{{ route('elevate') }}" class="bg-purple-600 hover:bg-purple-700 px-8 py-3 rounded-xl font-bold flex items-center gap-2 group transition-all inline-flex">
                    Explore ELEVATE <span class="group-hover:translate-x-2 transition-transform">→</span>
                </a>
            </div>
            <div class="flex-1">
                <h3 class="text-xl font-bold mb-6">Highlights</h3>
                <ul class="space-y-4">
                    <li class="flex items-center gap-3 dynamic-text-muted hover:text-purple-400 transition"><span class="text-purple-500">✦</span> Persuasive Communication Workshop</li>
                    <li class="flex items-center gap-3 dynamic-text-muted hover:text-purple-400 transition"><span class="text-purple-500">✦</span> Leadership & Ethics Intensive</li>
                    <li class="flex items-center gap-3 dynamic-text-muted hover:text-purple-400 transition"><span class="text-purple-500">✦</span> Up to 60 Activity Points</li>
                    <li class="flex items-center gap-3 dynamic-text-muted hover:text-purple-400 transition"><span class="text-purple-500">✦</span> Expert Mentorship</li>
                </ul>
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
        // Profile Dropdown ---

        // Profile Dropdown
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
