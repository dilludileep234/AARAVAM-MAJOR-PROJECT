<!DOCTYPE html>
<html lang="en">

<head>
@include('partials.theme-system')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aaravam | GPTC Muttom</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
            --social-bg: rgba(255, 255, 255, 0.05);
            --social-text: #9ca3af;
        }

        .light-theme {
            --bg-color: #f1f5f9;
            --text-main: #0f172a;
            --text-muted: #334155;
            --glass-bg: rgba(255, 255, 255, 0.7);
            --glass-border: rgba(15, 23, 42, 0.1);
            --header-bg: rgba(241, 245, 249, 0.85);
            --card-hover: rgba(59, 130, 246, 0.08);
            --accent-blue: #2563eb;
            --social-bg: rgba(15, 23, 42, 0.04);
            --social-text: #334155;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-main);
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            transition: background-color 0.4s ease, color 0.4s ease;
        }

        /* Helper Classes for Theme Variables */
        .dynamic-text-muted {
            color: var(--text-muted);
        }

        .dynamic-glass {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
        }

        /* Glassmorphism Effect */
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

        /* Scroll Animations */
        .reveal {
            opacity: 0;
            filter: blur(5px);
            transition: all 1s ease-out;
        }

        .reveal-left {
            transform: translateX(-80px);
        }

        .reveal-right {
            transform: translateX(80px);
        }

        .reveal-up {
            transform: translateY(50px);
        }

        .active {
            opacity: 1;
            filter: blur(0);
            transform: translate(0, 0);
        }

        /* Mouse Follow Glow */
        #bg-glow {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 50% 50%, rgba(30, 58, 138, 0.2) 0%, transparent 70%);
            z-index: -1;
            pointer-events: none;
            transition: transform 0.2s ease-out;
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

        /* Multilingual Text Morphing */
        .text-cycle-container {
            position: relative;
            display: inline-block;
        }

        .hero-cycle {
            width: 100%;
            height: 1.2em;
            max-width: 800px;
            margin: 0 auto;
        }

        .text-cycle {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0;
            animation: fadeInOut 12s ease-in-out infinite;
            white-space: nowrap;
            width: 100%;
            text-align: center;
        }

        .text-cycle:nth-child(1) { animation-delay: 0s; }
        .text-cycle:nth-child(2) { animation-delay: 3s; }
        .text-cycle:nth-child(3) { animation-delay: 6s; }
        .text-cycle:nth-child(4) { animation-delay: 9s; }

        @keyframes fadeInOut {
            0% { opacity: 0; transform: translate(-50%, -50%); filter: blur(8px); }
            6.25% { opacity: 1; transform: translate(-50%, -50%); filter: blur(0px); }
            18.75% { opacity: 1; transform: translate(-50%, -50%); filter: blur(0px); }
            25% { opacity: 0; transform: translate(-50%, -50%); filter: blur(8px); }
            100% { opacity: 0; transform: translate(-50%, -50%); filter: blur(8px); }
        }
    </style>
</head>

<body>
    <div id="bg-glow"></div>

    @include('partials.header')

    <section class="relative pt-24 pb-32 text-center px-4">
        <div class="reveal reveal-up active">
            <p class="text-blue-500 text-xs font-bold mb-4 uppercase tracking-[0.3em]">Welcome to GPTC Muttom</p>
            
            <div class="text-cycle-container hero-cycle my-20">
                <h1 class="text-6xl md:text-8xl font-extrabold tracking-tighter text-cycle">AARAVAM</h1>
                <h1 class="text-6xl md:text-8xl font-extrabold tracking-tighter text-cycle">ആരവം</h1>
                <h1 class="text-6xl md:text-8xl font-extrabold tracking-tighter text-cycle">आरवम</h1>
                <h1 class="text-6xl md:text-8xl font-extrabold tracking-tighter text-cycle">ஆரவம்</h1>
            </div>

            <p class="dynamic-text-muted text-lg md:text-xl mb-10 max-w-2xl mx-auto leading-relaxed font-medium">
                Elevating Campus Life. Innovating the Future. <span class="text-blue-500">2k26</span>
            </p>
            <div class="flex flex-col md:flex-row justify-center gap-4">
                <a href="{{ route('events') }}" class="bg-white/5 hover:bg-white/10 border border-white/10 px-10 py-4 rounded-2xl font-bold transition dynamic-text-muted flex items-center justify-center">
                    View Fests
                </a>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-5xl mx-auto mt-28 reveal reveal-up">
            <div class="p-8 glass-card rounded-[2rem]">
                <i class="fas fa-calendar-check text-blue-500 text-3xl mb-4"></i>
                <h3 class="text-4xl font-black italic">100+</h3>
                <p class="dynamic-text-muted text-[10px] uppercase font-bold tracking-widest mt-1">Events/Year</p>
            </div>
            <div class="p-8 glass-card rounded-[2rem]">
                <i class="fas fa-award text-blue-500 text-3xl mb-4"></i>
                <h3 class="text-4xl font-black italic">50+</h3>
                <p class="dynamic-text-muted text-[10px] uppercase font-bold tracking-widest mt-1">Awards Won</p>
            </div>
            <div class="p-8 glass-card rounded-[2rem]">
                <i class="fas fa-bolt text-blue-500 text-3xl mb-4"></i>
                <h3 class="text-4xl font-black italic">2</h3>
                <p class="dynamic-text-muted text-[10px] uppercase font-bold tracking-widest mt-1">Major Fests</p>
            </div>
        </div>
    </section>

    <section class="py-24 px-6 md:px-12 max-w-7xl mx-auto grid md:grid-cols-2 gap-20 items-center">
        <div class="reveal reveal-left">
            <h4 class="text-blue-500 font-bold text-sm uppercase tracking-widest mb-3">About GPTC MUTTOM</h4>
            <h2 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">Empowering Student <br><span class="text-blue-500">Communities.</span></h2>
            <p class="dynamic-text-muted leading-relaxed mb-8 text-lg">
                offering a centralized platform for fest registrations and technical excellence.
            </p>
            <button class="bg-white/5 border border-white/10 hover:border-blue-500 px-8 py-4 rounded-xl flex items-center gap-3 transition-all group font-bold">
                Learn More <i class="fas fa-arrow-right text-blue-500 group-hover:translate-x-2 transition"></i>
            </button>
        </div>

        <div class="grid grid-cols-2 gap-6 reveal reveal-right">
            <div class="space-y-6">
                <img src="{{ asset('images/home/student_collab.png') }}" class="rounded-[2.5rem] h-52 w-full object-cover grayscale hover:grayscale-0 transition duration-700" alt="Student Collab">
                <img src="{{ asset('images/home/technical_workshop.png') }}" class="rounded-[2.5rem] h-72 w-full object-cover grayscale hover:grayscale-0 transition duration-700" alt="Technical Workshop">
            </div>
            <div class="space-y-6 pt-12">
                <img src="{{ asset('images/home/event_presentation.png') }}" class="rounded-[2.5rem] h-72 w-full object-cover grayscale hover:grayscale-0 transition duration-700" alt="Event Presentation">
                <img src="{{ asset('images/home/cultural_fest.png') }}" class="rounded-[2.5rem] h-52 w-full object-cover grayscale hover:grayscale-0 transition duration-700" alt="Cultural Fest">
            </div>
        </div>
    </section>

    <section class="py-24 px-6 md:px-12 bg-blue-900/5">
        <div class="max-w-7xl mx-auto text-center mb-16 reveal reveal-up">
            <h2 class="text-4xl font-bold mb-4">Major Flagship Fests</h2>
            <p class="dynamic-text-muted">Experience the peak of technical and cultural excellence</p>
        </div>

        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-8">
            <div class="glass-card p-12 rounded-[2.5rem] border-l-8 border-blue-600 reveal reveal-left">
                <span class="bg-blue-600/20 text-blue-500 px-5 py-1.5 rounded-full text-xs font-black uppercase">OUR</span>
                <h3 class="text-4xl font-black mt-8 mb-2 tracking-tighter">VISION</h3>
                <p class="text-blue-500/80 italic mb-6 font-semibold">Transform. Innovate. Elevate.</p>
                <p class="dynamic-text-muted mb-10 leading-relaxed text-lg">To be a leading institution that empowers students to become innovative leaders and responsible global citizens through transformative education and holistic development.</p>
            </div>
            <div class="glass-card p-12 rounded-[2.5rem] border-l-8 border-pink-600 reveal reveal-right">
                <span class="bg-pink-600/20 text-pink-500 px-5 py-1.5 rounded-full text-xs font-black uppercase">OUR</span>
                <h3 class="text-4xl font-black mt-8 mb-2 tracking-tighter">MISSION</h3>
                <p class="text-pink-500/80 italic mb-6 font-semibold">Celebrate. Create. Connect.</p>
                <p class="dynamic-text-muted mb-10 leading-relaxed text-lg">We are committed to providing exceptional educational experiences that foster creativity, critical thinking, and character development while preparing students for successful careers and meaningful lives.</p>
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
                <div class="flex space-x-3" style="color: var(--social-text)">
                    <a href="https://www.facebook.com/GptcMuttomthodupuzha" target="_blank" class="w-9 h-9 rounded-lg flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all" style="background: var(--social-bg)">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-9 h-9 rounded-lg flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all" style="background: var(--social-bg)">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://gpcmuttom.ac.in/" target="_blank" class="w-9 h-9 rounded-lg flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all" style="background: var(--social-bg)">
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
        // --- Scroll Animation Logic ---
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('active');
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.reveal').forEach((el) => observer.observe(el));

        // --- Parallax Mouse Glow ---
        const glow = document.getElementById('bg-glow');
        document.addEventListener('mousemove', (e) => {
            const x = (e.clientX / window.innerWidth - 0.5) * 60;
            const y = (e.clientY / window.innerHeight - 0.5) * 60;
            glow.style.transform = `translate(${x}px, ${y}px)`;
            glow.style.background = `radial-gradient(circle at ${e.clientX}px ${e.clientY}px, rgba(59, 130, 246, 0.15) 0%, transparent 70%)`;
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
