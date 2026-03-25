<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cultural Harmony | Aaravam</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap');

        /* Theme Variables */
        :root {
            --bg-color: #050a18;
            --text-main: #ffffff;
            --text-muted: #9ca3af;
            --glass-bg: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.1);
            --header-bg: rgba(5, 10, 24, 0.8);
            --card-hover: rgba(255, 255, 255, 0.07);
            --accent-blue: #3b82f6;
            --primary-pink-rgb: 249, 115, 22;
            --primary-pink: rgb(var(--primary-pink-rgb));
            --primary-purple-rgb: 234, 88, 12;
            --primary-purple: rgb(var(--primary-purple-rgb));
            --accent-cream: #fff7ed;
            --card-bg: rgba(20, 20, 20, 0.7);
            --utsav-gradient: linear-gradient(135deg, #431407 0%, #c2410c 50%, #0f0f0f 100%);
            --glow-color: rgba(249, 115, 22, 0.2);
        }

        .light-theme {
            --bg-color: #fff7ed;
            --text-main: #431407;
            --text-muted: #9a3412;
            --card-bg: rgba(255, 255, 255, 0.8);
            --glass-bg: rgba(255, 255, 255, 0.8);
            --glass-border: rgba(249, 115, 22, 0.2);
            --utsav-gradient: linear-gradient(135deg, #fff7ed 0%, #fed7aa 100%);
            --header-bg: rgba(255, 247, 237, 0.9);
            --card-hover: rgba(249, 115, 22, 0.05);
            --glow-color: rgba(249, 115, 22, 0.1);
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-main);
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            transition: background-color 0.4s ease, color 0.4s ease;
        }

        /* Helper Classes */
        .dynamic-text-muted {
            color: var(--text-muted);
        }

        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
        }

        /* Mouse Follow Glow */
        #bg-glow {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 50% 50%, var(--glow-color) 0%, transparent 70%);
            z-index: -1;
            pointer-events: none;
            transition: transform 0.2s ease-out;
        }

        /* Hero Section */
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
            overflow: hidden;
        }

        #hero-particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            pointer-events: none;
        }

        .hero * {
            position: relative;
            z-index: 2;
        }

        .hero-tag {
            color: var(--primary-pink);
            font-size: 0.9rem;
            letter-spacing: 3px;
            margin-bottom: 1rem;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            letter-spacing: 2px;
        }

        .hero p {
            font-size: 1.8rem;
            color: var(--text-muted);
            margin-bottom: 2.5rem;
        }

        /* Countdown */
        .countdown-container {
            display: flex;
            gap: 20px;
            margin-top: 40px;
        }

        .countdown-item {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 15px 20px;
            border-radius: 15px;
            min-width: 90px;
        }

        .countdown-value {
            display: block;
            font-size: 2.2rem;
            font-weight: 900;
            color: var(--primary-pink);
        }

        .countdown-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            color: var(--text-muted);
        }

        /* Events Section */
        .events-section {
            padding: 100px 10%;
        }

        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title h2 {
            font-size: 2.8rem;
            margin-bottom: 15px;
        }

        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
        }

        .event-card {
            background: var(--card-bg);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 20px;
            transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
        }

        .event-card:hover {
            transform: translateY(-10px);
            border-color: var(--primary-pink);
            background: rgba(var(--primary-pink-rgb), 0.1);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        .event-card h3 {
            font-size: 1.8rem;
            margin-bottom: 15px;
            color: var(--primary-pink);
        }

        .event-card p {
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 25px;
        }

        .event-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
        }

        .date {
            font-weight: 600;
            color: var(--accent-cream);
        }

        /* Animations */
        /* Selection Panel */
        .selection-panel {
            position: fixed;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%) translateY(150%);
            background: rgba(15, 23, 42, 0.9);
            backdrop-filter: blur(20px);
            border: 1px solid var(--primary-pink);
            padding: 15px 40px;
            border-radius: 100px;
            display: flex;
            align-items: center;
            gap: 30px;
            z-index: 2000;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
            transition: 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .selection-panel.active {
            transform: translateX(-50%) translateY(0);
        }

        .count-text {
            color: white;
            font-weight: 600;
        }

        .arrow-trigger {
            background: var(--primary-pink);
            color: white;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            border: none;
            transition: 0.3s;
        }

        .arrow-trigger:hover {
            transform: scale(1.1);
        }

        /* Registration Chips */
        .selected-list-area {
            background: rgba(0, 0, 0, 0.2);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 30px;
        }

        .chips-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }

        .event-chip {
            background: rgba(var(--primary-pink-rgb), 0.1);
            border: 1px solid var(--primary-pink);
            color: var(--primary-pink);
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
        }

        .event-card.selected {
            border-color: var(--primary-pink);
            background: rgba(var(--primary-pink-rgb), 0.15);
        }

        .event-card.selected::after {
            content: "\f058";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            position: absolute;
            top: 20px;
            right: 20px;
            color: var(--primary-pink);
            font-size: 1.2rem;
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
            background: rgba(10, 5, 24, 0.95);
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
            color: var(--text-muted);
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
            color: var(--primary-pink);
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
            color: var(--text-muted);
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

        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: 1.1s ease-out;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        .reveal-up {
            transform: translateY(50px);
        }

        /* Hamburger Menu */
        .drawer-list {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 100vw;
            transform: translate(-100vw, 0);
            box-sizing: border-box;
            pointer-events: none;
            padding-top: 125px;
            transition: width 475ms ease-out, transform 450ms ease, border-radius 0.8s 0.1s ease;
            border-bottom-right-radius: 100vw;
            background: transparent;
            backdrop-filter: blur(10px);
            z-index: 100;
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
            color: #3b82f6;
            background-color: var(--glass-bg);
            padding-left: 2rem;
            transition: 0.3s;
        }

        .drawer-list li a i {
            margin-right: 15px;
            width: 25px;
            text-align: center;
            color: #3b82f6;
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
        }

        label.hamburger text close,
        label.hamburger text open {
            text-transform: uppercase;
            font-size: 0.7em;
            position: absolute;
            transform: translateY(28px);
            text-align: center;
            width: 60px;
            left: -15px;
            overflow: hidden;
            transition: width 0.25s 0.35s, color 0.45s 0.35s;
            font-weight: 700;
            letter-spacing: 1px;
        }

        label.hamburger text close {
            color: rgba(0, 0, 0, 0);
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
            background-color: #3b82f6;
        }

        label.hamburger>i:before {
            transform: translate(-50%, -8px);
        }

        label.hamburger>i:after {
            transform: translate(-50%, 8px);
        }

        /* Nav Link Hover */
        .nav-link {
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #3b82f6;
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
            border: 2px solid #3b82f6;
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
            color: #3b82f6;
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

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            .hero p {
                font-size: 1.2rem;
            }
        }
    </style>
</head>

<body>
    <div id="bg-glow"></div>

    @include("partials.header")

    <section class="hero">
        <canvas id="hero-particles"></canvas>
        <span class="hero-tag reveal">GPTC MUTTOM 2026</span>
        <h1 class="reveal">CULTURAL HARMONY</h1>
        <p class="reveal">Celebrating Traditions, Creating Bonds.</p>
        <div class="hero-btns reveal mt-8 mb-12 flex gap-6">
            <a href="#featured-events" class="px-10 py-4 rounded-xl bg-orange-600 text-white font-extrabold hover:bg-orange-700 transition-all shadow-lg shadow-orange-600/20">Join the Festival</a>
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

    <!-- Results Celebration Banner -->
    <section class="results-banner reveal py-12 px-6">
        <div class="max-w-7xl mx-auto">
            <a href="{{ route('results', ['category' => 'Cultural']) }}" class="group block relative overflow-hidden rounded-[2rem] border border-orange-500/30 bg-orange-500/5 p-8 md:p-12 transition-all hover:border-orange-500 hover:bg-orange-500/10">
                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                    <div>
                        <span class="text-orange-400 text-xs font-black uppercase tracking-[0.3em] mb-4 block">Festivity Report: Published</span>
                        <h2 class="text-3xl md:text-5xl font-black text-white mb-4">The Artistic Podium</h2>
                        <p class="text-slate-400 text-lg max-w-xl">The cultural performances have been judged. Witness the masters of harmony and tradition who excelled at Utsav 2025.</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-2xl bg-orange-600 flex items-center justify-center text-white text-2xl group-hover:scale-110 transition-transform">
                            <i class="fas fa-theater-masks"></i>
                        </div>
                        <i class="fas fa-chevron-right text-orange-400 text-2xl animate-pulse"></i>
                    </div>
                </div>
                <div class="absolute top-0 right-0 w-64 h-64 bg-orange-600/10 blur-[80px] rounded-full -mr-32 -mt-32"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-red-600/10 blur-[60px] rounded-full -ml-24 -mb-24"></div>
            </a>
        </div>
    </section>

    <section class="events-section">
        <div class="section-title reveal">
            <h2>Upcoming Celebrations</h2>
            <p>Join us in celebrating the vibrant culture of GPTC Muttom</p>
        </div>

        <div class="events-grid">
            @forelse($events as $event)
            <div class="event-card reveal" data-id="{{ $event->id }}" data-name="{{ $event->name }}" onclick="selectEvent(this)" style="cursor: pointer;">
                <div class="flex justify-between items-start mb-4">
                    <h3>{{ $event->name }}</h3>
                    @if($event->has_results > 0)
                        <a href="{{ route('results', ['category' => 'Cultural', 'event_id' => $event->id]) }}" 
                           class="inline-flex items-center gap-1.5 px-3 py-1 bg-orange-500/10 text-orange-400 text-[10px] font-black uppercase tracking-widest rounded-lg border border-orange-500/20 hover:bg-orange-500 hover:text-white transition-all stop-propagation" 
                           onclick="event.stopPropagation()">
                            <i class="fas fa-trophy"></i> Results
                        </a>
                    @endif
                </div>
                <p>{{ $event->description }}</p>
                <div class="event-footer">
                    <span class="prize" style="color: var(--primary-pink); font-weight: bold;">{{ $event->fees > 0 ? '₹ ' . number_format($event->fees, 0) : 'FREE' }}</span>
                    <span class="date">{{ $event->sub_category }}</span>
                </div>
                @if($event->time)
                <div style="margin-top:10px; font-size: 0.85rem; color: #fed7aa; display: flex; align-items: center; gap: 5px;">
                    <i class="far fa-clock"></i> {{ $event->time }}
                </div>
                @endif
            </div>
            @empty
            <div class="col-span-full text-center py-10">
                <p>No celebrations scheduled at the moment.</p>
            </div>
            @endforelse
        </div>

        <div class="text-center mt-12 reveal">
            <a href="{{ route('cultural.list') }}" class="inline-flex items-center gap-2 bg-orange-600 hover:bg-orange-700 px-8 py-3 rounded-full font-bold transition active:scale-95 shadow-lg shadow-orange-600/20 text-white">
                <i class="fas fa-list-ul"></i> View Full Schedule & Activity Points
            </a>
        </div>

        <div class="global-reg-section" id="globalReg">
            <div class="reg-content-wrapper">
                <div class="reg-header">
                    <h2>Join the Celebration</h2>
                    <p>Register for your favorite cultural events</p>
                </div>

                <div class="selection-visualizer">
                    <h4>Selected Events:</h4>
                    <div class="chips-container" id="regChips">
                        <span class="text-gray-500 italic">No events selected yet</span>
                    </div>
                </div>

                <form class="registration-form-grid" onsubmit="handleRegistration(event)">
                    @csrf
                    <div class="input-group">
                        <label>Full Name</label>
                        <input type="text" placeholder="Enter your full name" required value="{{ auth()->user()->name ?? '' }}">
                    </div>
                    <div class="input-group">
                        <label>Registration Number</label>
                        <input type="text" placeholder="Enter registration number" required>
                    </div>
                    <div class="input-group">
                        <label>Semester</label>
                        <select required>
                            <option value="" disabled selected>Select Semester</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                            <option value="S4">S4</option>
                            <option value="S5">S5</option>
                            <option value="S6">S6</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label>Email ID</label>
                        <input type="email" placeholder="example@email.com" required value="{{ auth()->user()->email ?? '' }}">
                    </div>
                    <div class="input-group">
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
                    <div class="input-group">
                        <label>Contact Number</label>
                        <input type="tel" placeholder="+91 00000 00000" required>
                    </div>
                    <div class="submit-btn-wrapper">
                        <button type="submit" class="confirm-reg-btn">Complete & Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <div class="selection-panel" id="selectionPanel">
        <div class="count-text"><span id="eventCount">0</span> Events Selected</div>
        <button class="arrow-trigger" onclick="triggerSlideDown()">
            <i class="fas fa-arrow-down"></i>
        </button>
    </div>

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
                    <li><a href="{{ route('results', ['category' => 'Cultural']) }}" class="hover:text-blue-500 transition">Results Board</a></li>
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
        // Reveal on Scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('active');
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // Mouse Glow
        const glow = document.getElementById('bg-glow');
        document.addEventListener('mousemove', (e) => {
            const x = (e.clientX / window.innerWidth - 0.5) * 60;
            const y = (e.clientY / window.innerHeight - 0.5) * 60;
            glow.style.transform = `translate(${x}px, ${y}px)`;
            glow.style.background = `radial-gradient(circle at ${e.clientX}px ${e.clientY}px, var(--glow-color) 0%, transparent 70%)`;
        });

        // Live Countdown
        (function () {
            const targetDate = new Date("April 5, 2026 00:00:00").getTime();

            function updateTimer() {
                const now = new Date().getTime();
                const distance = targetDate - now;

                if (distance < 0) {
                    const container = document.querySelector(".countdown-container");
                    if (container) container.innerHTML = "<h2 style='text-align:center; width:100%; color:var(--primary-pink); letter-spacing:4px; font-size:1.5rem;'>CULTURAL FEST IS LIVE!</h2>";
                    return;
                }

                const d = Math.floor(distance / (1000 * 60 * 60 * 24));
                const h = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const m = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const s = Math.floor((distance % (1000 * 60)) / 1000);

                const dEl = document.getElementById("days");
                const hEl = document.getElementById("hours");
                const mEl = document.getElementById("minutes");
                const sEl = document.getElementById("seconds");

                if (dEl) dEl.innerText = d.toString().padStart(2, '0');
                if (hEl) hEl.innerText = h.toString().padStart(2, '0');
                if (mEl) mEl.innerText = m.toString().padStart(2, '0');
                if (sEl) sEl.innerText = s.toString().padStart(2, '0');
            }

            setInterval(updateTimer, 1000);
            updateTimer();
        })();

        // Particles
        (function () {
            const canvas = document.getElementById('hero-particles');
            const ctx = canvas.getContext('2d');
            let particles = [];

            function resize() {
                canvas.width = canvas.offsetWidth;
                canvas.height = canvas.offsetHeight;
            }
            window.addEventListener('resize', resize);
            resize();

            class Particle {
                constructor() { this.reset(); }
                reset() {
                    this.x = Math.random() * canvas.width;
                    this.y = Math.random() * canvas.height;
                    this.vx = (Math.random() - 0.5) * 0.5;
                    this.vy = (Math.random() - 0.5) * 0.5;
                    this.size = Math.random() * 3 + 1;
                    this.alpha = Math.random() * 0.5;
                    this.updateColor();
                }
                updateColor() {
                    const isLight = document.body.classList.contains('light-theme');
                    const r = 249;
                    const g = 115;
                    const b = 22;
                    this.color = `rgba(${r}, ${g}, ${b}, ${isLight ? this.alpha + 0.3 : this.alpha})`;
                }
                update() {
                    this.x += this.vx; this.y += this.vy;
                    if (this.x < 0 || this.x > canvas.width || this.y < 0 || this.y > canvas.height) this.reset();
                }
                draw() {
                    ctx.fillStyle = this.color;
                    ctx.beginPath();
                    ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                    ctx.fill();
                }
            }
            for (let i = 0; i < 80; i++) {
                const p = new Particle();
                p.updateColor();
                particles.push(p);
            }
            function animate() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                particles.forEach(p => { p.update(); p.draw(); });
                requestAnimationFrame(animate);
            }
            animate();
        })();

        // Registration Logic
        let selectedEvents = new Map();
        const selectionPanel = document.getElementById('selectionPanel');
        const eventCountLabel = document.getElementById('eventCount');
        const regChipsContainer = document.getElementById('regChips');
        const globalRegSection = document.getElementById('globalReg');

        function selectEvent(card) {
            const eventId = card.getAttribute('data-id');
            const eventName = card.getAttribute('data-name');
            if (selectedEvents.has(eventId)) {
                selectedEvents.delete(eventId);
                card.classList.remove('selected');
            } else {
                selectedEvents.set(eventId, eventName);
                card.classList.add('selected');
                // Automatically open registration form when an item is selected
                triggerSlideDown();
            }
            syncSelection();
        }

        function syncSelection() {
            const count = selectedEvents.size;
            eventCountLabel.textContent = count;
            if (count > 0) {
                selectionPanel.classList.add('active');
            }
            else { 
                selectionPanel.classList.remove('active'); 
                globalRegSection.classList.remove('open'); 
            }
            regChipsContainer.innerHTML = '';
            
            if (count === 0) {
                regChipsContainer.innerHTML = '<span class="text-gray-500 italic">No events selected yet</span>';
                return;
            }

            selectedEvents.forEach((name, id) => {
                const chip = document.createElement('div');
                chip.className = 'event-chip';
                chip.textContent = name;
                regChipsContainer.appendChild(chip);
            });
        }

        function triggerSlideDown() {
            if (!globalRegSection.classList.contains('open')) {
                globalRegSection.classList.add('open');
                setTimeout(() => { 
                    globalRegSection.scrollIntoView({ behavior: 'smooth', block: 'start' }); 
                }, 100);
            }
        }

        async function handleRegistration(event) {
            event.preventDefault();
            
            @guest
                alert('Please login to register for events.');
                window.location.href = '{{ route("role.selection") }}';
                return;
            @endguest

            const form = event.target;
            const inputs = form.querySelectorAll('input, select');
            
            const deptValue = document.getElementById('deptInput').value.trim().toLowerCase();
            const allowedDepts = ['ct', 'computer', 'me', 'mechanical', 'eee', 'electrical', 'ce', 'civil', 'el', 'electronics'];
            
            if (!allowedDepts.includes(deptValue)) {
                alert('Invalid Department! Please enter one of: CT, Computer, ME, Mechanical, EEE, Electrical, CE, Civil, EL, or Electronics.');
                document.getElementById('deptInput').focus();
                return;
            }

            const data = {
                student_name: inputs[1].value, // inputs[0] is CSRF
                reg_no: inputs[2].value,
                semester: inputs[3].value,
                email: inputs[4].value,
                department: document.getElementById('deptInput').value,
                event_ids: Array.from(selectedEvents.keys())
            };

            try {
                const response = await fetch('{{ route("registrations.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();
                if (result.success) {
                    alert('Registration Successful! Redirecting to portal...');
                    window.location.href = '{{ route("portal") }}';
                } else {
                    alert('Error: ' + result.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Registration failed. Please try again.');
            }
        }

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
