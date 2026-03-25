<!DOCTYPE html>
<html lang="en">

<head>
@include('partials.theme-system')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ELEVATE | Soft Skills Workshop</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap');

        :root {
            --bg-dark: #050a10;
            --primary-teal: #9333ea;
            /* Primary Purple */
            --primary-indigo: #4338ca;
            --accent-cyan: #c084fc;
            /* Light Purple/Violet */
            --card-bg: rgba(10, 20, 30, 0.7);
            --text-main: #ffffff;
            --text-dim: #94a3b8;
            --utsav-gradient: linear-gradient(135deg, #2e1065 0%, #4c1d95 50%, #050a10 100%);
            --primary-pink: #d946ef;
            /* Magenta/Violet */
            --accent-blue: #7e22ce;
            --nav-bg: rgba(5, 5, 10, 0.85);
            --input-bg: rgba(255, 255, 255, 0.06);
            --glass-bg: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.1);
            --panel-bg: rgba(10, 5, 30, 0.95);
            --btn-gradient: linear-gradient(135deg, #a855f7 0%, #22d3ee 100%);
            --btn-glow: rgba(168, 85, 247, 0.5);
        }

        .light-theme {
            --bg-dark: #f8fafc;
            --bg-color: #f8fafc;
            --text-main: #0f172a;
            --text-dim: #475569;
            --card-bg: rgba(255, 255, 255, 0.8);
            --glass-bg: rgba(255, 255, 255, 0.8);
            --glass-border: rgba(192, 132, 252, 0.2);
            --utsav-gradient: linear-gradient(135deg, #f0fdff 0%, #f8fafc 100%);
            --nav-bg: transparent;
            --panel-bg: rgba(255, 255, 255, 0.9);
            --input-bg: rgba(255, 255, 255, 0.95);
            --dark-green: #064e3b;
        }

        .light-theme .countdown-item {
            background: rgba(15, 23, 42, 0.05);
            border-color: rgba(15, 23, 42, 0.1);
        }

        .light-theme .countdown-value {
            color: #0f172a;
            text-shadow: none;
        }

        .light-theme .countdown-label {
            color: #475569;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-main);
            overflow-x: hidden;
            scroll-behavior: smooth;
            transition: background-color 0.4s ease, color 0.4s ease;
        }

        /* --- Nav --- */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.2rem 6%;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            background: var(--nav-bg);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(192, 132, 252, 0.2);
        }


        .logo-container {
            display: flex;
            align-items: center;
        }

        .nav-links {
            display: flex;
            gap: 2.5rem;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-dim);
            transition: 0.3s;
            font-size: 0.95rem;
        }

        .nav-links a:hover {
            color: var(--primary-pink);
        }

        .profile-btn {
            display: block;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid var(--primary-teal);
            transition: 0.3s;
        }

        .profile-btn:hover {
            box-shadow: 0 0 15px var(--primary-pink);
            transform: scale(1.05);
        }

        .profile-btn img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .logo {
            font-weight: 700;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logo-box {
            background: var(--primary-teal);
            padding: 5px 10px;
            border-radius: 4px;
            color: white;
        }


        /* --- Hero --- */
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

        .hero>*:not(#hero-particles) {
            position: relative;
            z-index: 2;
        }

        .hero-tag {
            color: var(--accent-cyan);
            font-size: 0.9rem;
            letter-spacing: 3px;
            margin-bottom: 1rem;
            text-transform: uppercase;
        }

        .hero h1 {
            font-size: 4.5rem;
            margin-bottom: 1.5rem;
            letter-spacing: 4px;
            font-weight: 900;
            text-shadow: 0 0 30px rgba(192, 132, 252, 0.4);
        }

        .hero p {
            font-size: 1.6rem;
            color: var(--text-dim);
            margin-bottom: 2.5rem;
            max-width: 800px;
        }

        .hero-btns {
            display: flex;
            gap: 20px;
        }

        .btn-reg {
            background: var(--btn-gradient);
            padding: 14px 40px;
            border-radius: 12px;
            text-decoration: none;
            color: #000;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 10px 20px -10px var(--btn-glow);
        }

        .btn-reg:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 30px -10px var(--btn-glow);
            filter: brightness(1.1);
        }

        .btn-view {
            border: 1px solid white;
            padding: 14px 35px;
            border-radius: 8px;
            text-decoration: none;
            color: white;
            transition: 0.3s;
        }

        .btn-view:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        /* --- Countdown Timer --- */
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
            text-align: center;
            transition: 0.3s;
        }

        .countdown-item:hover {
            background: rgba(192, 132, 252, 0.1);
            border-color: var(--primary-pink);
            transform: translateY(-5px);
        }

        .countdown-value {
            display: block;
            font-size: 2.2rem;
            font-weight: 900;
            color: var(--primary-pink);
            line-height: 1;
            margin-bottom: 5px;
            text-shadow: 0 0 20px rgba(192, 132, 252, 0.3);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .countdown-item.ticking .countdown-value {
            animation: tickPulse 1s infinite;
        }

        @keyframes tickPulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.05);
                opacity: 0.8;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .countdown-item::after {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: 15px;
            border: 1px solid transparent;
            transition: 0.3s;
        }

        .countdown-item:hover::after {
            border-color: var(--primary-pink);
            box-shadow: 0 0 20px rgba(192, 132, 252, 0.2);
        }

        .countdown-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--text-dim);
            font-weight: 600;
        }

        /* --- Stats Bar --- */
        .hero-stats {
            margin-top: 30px;
            display: flex;
            gap: 40px;
            justify-content: center;
            font-size: 1.1rem;
            color: var(--text-main);
        }

        .hero-stats i {
            color: var(--accent-cyan);
            margin-right: 8px;
        }

        /* --- About Section --- */
        .about-section {
            padding: 100px 10%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .about-img {
            width: 100%;
            border-radius: 20px;
            border: 1px solid rgba(147, 51, 234, 0.2);
            box-shadow: 0 0 30px rgba(147, 51, 234, 0.1);
            transition: 0.5s;
        }

        .about-img:hover {
            transform: scale(1.02);
        }

        .about-content h2 {
            font-size: 2.2rem;
            margin-bottom: 20px;
            color: var(--primary-teal);
        }

        .about-content p {
            color: var(--text-dim);
            margin-bottom: 15px;
            line-height: 1.6;
        }

        /* --- Events Grid --- */
        .events-section {
            padding: 80px 10%;
        }

        .section-title {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-title h2 {
            font-size: 2.5rem;
            color: var(--primary-teal);
        }

        .section-title p {
            color: var(--text-dim);
        }

        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
        }

        .event-card {
            background: var(--card-bg);
            border: 1px solid rgba(147, 51, 234, 0.2);
            padding: 30px;
            border-radius: 15px;
            transition: 0.4s;
            cursor: pointer;
            position: relative;
        }

        .event-card:hover {
            transform: translateY(-5px);
            border-color: var(--accent-cyan);
            background: rgba(30, 10, 50, 0.9);
        }

        .event-card.selected {
            border-color: var(--accent-cyan);
            background: rgba(192, 132, 252, 0.1);
        }

        .event-card.selected::after {
            content: "\f058";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            position: absolute;
            top: 20px;
            right: 20px;
            color: var(--accent-cyan);
            font-size: 1.2rem;
        }

        /* --- Highlights Slider --- */
        .highlights-section {
            padding: 80px 10%;
            background: rgba(255, 255, 255, 0.02);
            overflow: hidden;
            position: relative;
        }

        .highlights-container {
            display: flex;
            gap: 30px;
            width: fit-content;
            animation: slideLeft 30s linear infinite;
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
            border: 1px solid rgba(147, 51, 234, 0.1);
        }

        .highlight-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .highlight-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(transparent, rgba(5, 10, 16, 0.8));
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
            color: var(--accent-cyan);
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        @keyframes slideLeft {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(calc(-530px * 3));
            }
        }

        /* --- Floating Selection Bar --- */
        .selection-panel {
            position: fixed;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%) translateY(150%);
            background: rgba(5, 5, 20, 0.85);
            backdrop-filter: blur(25px);
            border: 1px solid var(--primary-pink);
            padding: 15px 40px;
            border-radius: 100px;
            display: flex;
            align-items: center;
            gap: 30px;
            z-index: 2000;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.6);
            transition: 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .selection-panel.active {
            transform: translateX(-50%) translateY(0);
        }

        .count-text {
            font-size: 1.1rem;
            color: white;
            font-weight: 600;
        }

        .count-text span {
            color: var(--primary-pink);
            font-size: 1.3rem;
            margin-right: 5px;
        }

        .arrow-trigger {
            background: var(--primary-pink);
            color: #000;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: 0.3s;
            border: none;
            box-shadow: 0 10px 20px rgba(192, 132, 252, 0.4);
        }

        .arrow-trigger:hover {
            transform: scale(1.1) rotate(5deg);
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
            background: rgba(10, 5, 30, 0.95);
            border: 1px solid var(--primary-teal);
            border-radius: 30px;
            padding: 50px;
            backdrop-filter: blur(40px);
            max-width: 1150px;
            margin: 0 auto 100px;
            box-shadow: 0 40px 100px rgba(0, 0, 0, 0.6), 0 0 30px rgba(147, 51, 234, 0.1);
        }

        .reg-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .reg-header h2 {
            font-size: 3rem;
            font-weight: 900;
            color: var(--primary-teal);
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
            color: var(--accent-cyan);
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
            background: rgba(147, 51, 234, 0.1);
            color: var(--primary-teal);
            padding: 10px 22px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 700;
            border: 1px solid rgba(147, 51, 234, 0.3);
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
            border-color: var(--primary-teal);
            box-shadow: 0 0 20px rgba(147, 51, 234, 0.2);
            transform: translateY(-2px);
        }

        .submit-btn-wrapper {
            grid-column: span 3;
            margin-top: 20px;
        }

        .confirm-reg-btn {
            width: 100%;
            background: linear-gradient(135deg, var(--primary-teal), var(--accent-cyan));
            border: none;
            padding: 22px;
            border-radius: 18px;
            color: #000;
            font-weight: 900;
            font-size: 1.2rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            cursor: pointer;
            transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 20px 40px rgba(147, 51, 234, 0.2);
        }

        .confirm-reg-btn:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 30px 60px rgba(147, 51, 234, 0.4);
            filter: brightness(1.1);
        }

        .confirm-reg-btn:active {
            transform: scale(0.98);
        }

        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: 0.8s ease-out;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* --- Footer --- */
        footer {
            padding: 80px 10% 40px;
            background: #02020a;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        .footer-main {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr 1fr;
            gap: 40px;
            margin-bottom: 60px;
        }

        .footer-col h4 {
            margin-bottom: 25px;
            color: white;
        }

        .footer-col ul {
            list-style: none;
        }

        .footer-col ul li {
            margin-bottom: 12px;
            color: var(--text-dim);
            cursor: pointer;
            transition: 0.2s;
        }

        .footer-col ul li:hover {
            color: var(--primary-pink);
        }

        /* --- Light Theme Overrides (Visibility Fixes) --- */
        .light-theme footer {
            background: #f1f5f9;
            border-top: 1px solid rgba(148, 163, 184, 0.2);
        }

        .light-theme .footer-col h4 {
            color: #0f172a;
        }

        .light-theme .footer-col ul li {
            color: #475569;
        }

        .light-theme .footer-col ul li:hover {
            color: var(--primary-pink);
        }

        .light-theme .footer-copyright {
            border-top-color: rgba(148, 163, 184, 0.2) !important;
            color: #64748b !important;
        }

        .light-theme .nav-links a {
            color: #475569;
        }

        .light-theme .nav-links a:hover {
            color: var(--primary-pink);
        }

        .light-theme .logo {
            color: #0f172a;
        }

        .light-theme label.hamburger>i,
        .light-theme label.hamburger>i:before,
        .light-theme label.hamburger>i:after {
            background-color: #0f172a;
        }

        .light-theme .btn-view {
            border-color: #0f172a;
            color: #0f172a;
        }

        .light-theme .btn-view:hover {
            background: rgba(15, 23, 42, 0.05);
        }

        .light-theme .hero-stats {
            color: #475569;
        }
    </style>
</head>

<body>
    <nav>
        <div class="logo-container">

            <div class="logo">
                <span class="logo-box">A</span> ELEVATE 2026
            </div>
        </div>
        <div class="nav-links hidden md:flex">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('fests') }}">Fests</a>
            <a href="{{ route('about') }}">About Us</a>
            <a href="{{ route('contact') }}">Contact</a>
        </div>
        <div class="profile-container" style="display: flex; align-items: center; gap: 15px;">
            <button id="theme-toggle" class="w-10 h-10 rounded-full flex items-center justify-center text-cyan-400 hover:scale-110 transition active:scale-95" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); cursor: pointer;">
                <i class="fas fa-moon" id="theme-icon"></i>
            </button>

            @auth
            <a href="{{ route('portal') }}" class="profile-btn">
                <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('images/default-avatar.png') }}" alt="Profile">
            </a>
            @else
            <a href="{{ route('role.selection') }}" class="px-6 py-2 bg-purple-600 rounded-full text-white font-bold text-sm hover:bg-purple-700 transition">Login</a>
            @endauth
        </div>
    </nav>

    <section class="hero">
        <canvas id="hero-particles"></canvas>
        <span class="hero-tag reveal">Professional Growth Workshop 2026</span>
        <h1 class="reveal">ELEVATE</h1>
        <p class="reveal">Empowering the next generation of leaders through essential soft skills.</p>
        <div class="hero-btns reveal">
            <a href="#tracks" class="btn-reg">Book My Spot</a>
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

        <div class="hero-stats reveal">
            <span><i class="far fa-calendar"></i> April 05-07, 2026</span>
            <span><i class="fas fa-map-marker-alt"></i> Diamond Jubilee Hub</span>
            <span><i class="fas fa-users"></i> 500+ Professionals</span>
        </div>
    </section>


    <section class="about-section reveal">
        <img src="{{ asset('images/softskills/about_workshop.png') }}"
            class="about-img" alt="Soft Skill Workshop">
        <div class="about-content">
            <h2>The Art of Soft Skills</h2>
            <p>ELEVATE is a premier training program designed to bridge the gap between technical expertise and
                professional excellence. We focus on the high-impact skills that drive careers forward.</p>
            <p>Our 2026 theme, <strong>"The Human Connection"</strong>, explores how empathy, communication, and
                emotional intelligence shaped the future of work in an AI-driven world.</p>
        </div>
    </section>

    <section class="events-section" id="tracks">
        <div class="section-title reveal">
            <h2>Training Tracks</h2>
            <p>High-impact modules led by industry veterans</p>
        </div>
        
        <div class="events-grid">
            @forelse($events as $event)
            <div class="event-row event-card reveal" 
                 data-id="{{ $event->id }}" 
                 data-name="{{ $event->name }}" 
                 onclick="selectEvent(this)">
                <h3 class="text-xl font-bold mb-2">{{ $event->name }}</h3>
                <p class="text-sm opacity-80 mb-4">{{ $event->description }}</p>
                <div class="flex justify-between items-center mt-auto">
                    <div class="font-bold text-cyan-400">
                        <span>{{ $event->sub_category }}</span> | <span>{{ $event->time }}</span>
                    </div>
                    <div class="text-xs font-bold bg-white/10 px-2 py-1 rounded text-purple-400">
                        +{{ $event->activity_points }} AP
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-20 opacity-50">
                <p class="text-xl">No softskill events scheduled yet.</p>
            </div>
            @endforelse
        </div>



        <div class="global-reg-section" id="globalReg">
            <div class="reg-content-wrapper">
                <div class="reg-header">
                    <h2>Professional Enrollment</h2>
                    <p>Secure your spot in the leadership intensive</p>
                </div>

                <div class="selection-visualizer">
                    <h4>Selected Training Tracks:</h4>
                    <div class="chips-container" id="regChips">
                        <span class="text-gray-500 italic">No tracks selected yet</span>
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

    <section class="highlights-section reveal">
        <div class="section-title reveal">
            <h2>Past Workshop Moments</h2>
            <p>Excellence in action</p>
        </div>
        <div class="highlights-container">
            <div class="highlight-card">
                <img src="{{ asset('images/softskills/highlight_keynote.png') }}"
                    alt="Inspirational Keynote">
                <div class="highlight-overlay">
                    <h3>Inspirational Keynotes</h3>
                </div>
            </div>
            <div class="highlight-card">
                <img src="{{ asset('images/softskills/highlight_collab.png') }}"
                    alt="Group Collaboration">
                <div class="highlight-overlay">
                    <h3>Collaborative Learning</h3>
                </div>
            </div>
            <div class="highlight-card">
                <img src="{{ asset('images/softskills/highlight_cert.png') }}"
                    alt="Awards Ceremony">
                <div class="highlight-overlay">
                    <h3>Certification Ceremony</h3>
                </div>
            </div>
            <!-- Duplicates for seamless loop -->
            <div class="highlight-card">
                <img src="{{ asset('images/softskills/highlight_keynote.png') }}"
                    alt="Inspirational Keynote">
                <div class="highlight-overlay">
                    <h3>Inspirational Keynotes</h3>
                </div>
            </div>
        </div>
    </section>

    <div class="selection-panel" id="selectionPanel">
        <div class="count-text"><span id="eventCount">0</span> Tracks Selected</div>
        <button class="arrow-trigger" onclick="triggerSlideDown()">
            <i class="fas fa-arrow-down"></i>
        </button>
    </div>

    <footer>
        <div class="footer-main">
            <div class="footer-col">
                <div class="logo"><span class="logo-box">A</span> Aaravam</div>
                <p style="margin-top:20px; color:var(--text-dim)">Your gateway to GPTC MUTTOM fests and culture.</p>
            </div>
            <div class="footer-col">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('fests') }}">Fests</a></li>
                    <li><a href="{{ route('results') }}">Results Board</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Contact Us</h4>
                <ul>
                    <li>Idukki, Kerala, 685587</li>
                    <li>aaravam@gptcmuttom.ac.in</li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Follow Us</h4>
                <div style="display:flex; gap:15px; font-size:1.2rem; color:var(--text-dim)">
                    <i class="fab fa-instagram"></i>
                    <i class="fab fa-youtube"></i>
                    <i class="fab fa-twitter"></i>
                </div>
            </div>
        </div>
        <div class="footer-copyright"
            style="text-align:center; color:#475569; font-size:0.8rem; border-top:1px solid rgba(255,255,255,0.05); padding-top:30px;">
            © 2026 ആരവം. Engineered by the Students of GPTC Muttom.
        </div>
    </footer>

    <script>
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => { if (entry.isIntersecting) entry.target.classList.add('active'); });
        }, { threshold: 0.1 });
        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

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
                regChipsContainer.innerHTML = '<span class="text-gray-500 italic">No tracks selected yet</span>';
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
                student_name: inputs[1].value, // Full Name (after hidden CSRF)
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

        // --- Live Countdown Logic ---
        (function () {
            const targetDate = new Date("April 5, 2026 00:00:00").getTime();
            function updateTimer() {
                const now = new Date().getTime();
                const distance = targetDate - now;

                if (distance < 0) {
                    const container = document.querySelector(".countdown-container");
                    if (container) container.innerHTML = "<h2 style='text-align:center; width:100%; color:var(--primary-pink); letter-spacing:4px; font-size:1.5rem;'>UTSAV IS LIVE!</h2>";
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
                if (sEl) {
                    sEl.innerText = s.toString().padStart(2, '0');
                    if (sEl.closest('.countdown-item')) {
                        sEl.closest('.countdown-item').classList.add('ticking');
                    }
                }
            }
            setInterval(updateTimer, 1000);
            updateTimer();
        })();

        // Particle Canvas
        (function () {
            const canvas = document.getElementById('hero-particles');
            const ctx = canvas.getContext('2d');
            let ps = [];
            function resize() { 
                canvas.width = canvas.offsetWidth; 
                canvas.height = canvas.offsetHeight; 
                ps = [];
                for (let i = 0; i < 50; i++) ps.push(new P());
            }
            window.addEventListener('resize', resize); 
            resize();

            class P {
                constructor() { this.reset(); }
                reset() {
                    this.x = Math.random() * canvas.width; 
                    this.y = Math.random() * canvas.height;
                    this.vx = (Math.random() - 0.5) * 0.5; 
                    this.vy = (Math.random() - 0.5) * 0.5;
                    this.size = Math.random() * 4 + 4; 
                    this.shape = Math.floor(Math.random() * 4);
                    this.alpha = Math.random() * 0.3 + 0.1;
                    this.updateColor();
                    this.rot = Math.random() * Math.PI * 2; 
                    this.vr = (Math.random() - 0.5) * 0.02;
                }
                updateColor() {
                    const isLight = document.body.classList.contains('light-theme');
                    const r = isLight ? 147 : 192; 
                    const g = isLight ? 51 : 132;
                    const b = isLight ? 234 : 252;
                    this.color = `rgba(${r}, ${g}, ${b}, ${isLight ? this.alpha + 0.3 : this.alpha})`;
                }
                update() {
                    this.x += this.vx; this.y += this.vy; this.rot += this.vr;
                    if (this.x < 0 || this.x > canvas.width || this.y < 0 || this.y > canvas.height) this.reset();
                }
                draw() {
                    ctx.save(); ctx.translate(this.x, this.y); ctx.rotate(this.rot);
                    ctx.strokeStyle = this.color; ctx.lineWidth = 1.5; ctx.beginPath();
                    if (this.shape === 0) { // Speech Bubble
                        ctx.moveTo(-5, -5); ctx.lineTo(5, -5); ctx.lineTo(5, 2); ctx.lineTo(-2, 2); ctx.lineTo(-5, 5); ctx.closePath();
                    } else if (this.shape === 1) { // Light Bulb
                        ctx.arc(0, -3, 4, 0, Math.PI * 2); ctx.moveTo(-2, 1); ctx.lineTo(2, 1);
                    } else if (this.shape === 2) { // Handshake
                        ctx.arc(-2, 0, 3, 0, Math.PI * 2); ctx.arc(2, 0, 3, 0, Math.PI * 2);
                    } else { // Progress Arrow
                        ctx.moveTo(-4, 4); ctx.lineTo(4, -4); ctx.lineTo(1, -4); ctx.moveTo(4, -4); ctx.lineTo(4, -1);
                    }
                    ctx.stroke(); ctx.restore();
                }
            }

            function anim() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                ps.forEach(p => { 
                    p.updateColor();
                    p.update(); 
                    p.draw(); 
                });
                requestAnimationFrame(anim);
            }
            anim();
        })();
    </script>
</body>

</html>
