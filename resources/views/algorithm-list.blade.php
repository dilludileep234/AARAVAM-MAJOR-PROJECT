<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Algorithm Festival | ആരവം</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap');

        /* Theme Variables */
        :root {
            --bg-color: #050510;
            --text-main: #ffffff;
            --text-muted: #94a3b8;
            --glass-bg: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.1);
            --header-bg: rgba(5, 5, 16, 0.85);
            --card-hover: rgba(255, 255, 255, 0.07);
            --accent-blue: #00f3ff;
            --accent-purple: #bc13fe;
        }

        .light-theme {
            --bg-color: #f8fafc;
            --text-main: #0f172a;
            --text-muted: #475569;
            --glass-bg: rgba(255, 255, 255, 0.8);
            --glass-border: rgba(0, 243, 255, 0.2);
            --header-bg: rgba(248, 250, 252, 0.9);
            --card-hover: rgba(0, 243, 255, 0.05);
            --accent-blue: #0ea5e9;
            --accent-purple: #7e22ce;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-main);
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            transition: background-color 0.4s ease, color 0.4s ease;
        }

        .dynamic-text-muted {
            color: var(--text-muted);
        }

        .dynamic-glass {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
        }

        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .glass-card:hover {
            transform: translateY(-5px);
            background: var(--card-hover);
        }

        .reveal {
            opacity: 0;
            filter: blur(5px);
            transition: all 1s ease-out;
            transform: translateY(30px);
        }

        .reveal.active {
            opacity: 1;
            filter: blur(0);
            transform: translateY(0);
        }

        #bg-glow {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            pointer-events: none;
            background: radial-gradient(circle at 50% 50%, rgba(0, 243, 255, 0.05) 0%, transparent 70%);
        }

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
            box-sizing: border-box;
            pointer-events: none;
            padding-top: 125px;
            transition: width 475ms ease-out, transform 450ms ease, border-radius 0.8s 0.1s ease;
            border-bottom-right-radius: 100vw;
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
            overflow: auto;
            pointer-events: auto;
        }

        .drawer-list li {
            list-style: none;
            text-transform: uppercase;
            transform: translatex(-100vw);
        }

        .drawer-list li a {
            text-decoration: none;
            color: #FEFEFE;
            text-align: center;
            display: block;
            padding: 1rem;
            font-size: 1.2rem;
        }

        @media (min-width: 768px) {
            .drawer-list li a {
                text-align: left;
                padding-left: 2rem;
            }
        }

        .drawer-list li a:hover {
            color: var(--accent-blue);
            background-color: var(--glass-bg);
        }

        .drawer-list li a i {
            margin-right: 15px;
            color: var(--accent-blue);
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
            transition: transform 1s cubic-bezier(0.29, 1.4, 0.44, 0.96);
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

        label.hamburger>i {
            position: absolute;
            width: 100%;
            height: 2px;
            top: 50%;
            background-color: var(--text-main);
            transition: 0.35s;
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
            transition: 0.35s;
            transform-origin: 50% 50%;
        }

        label.hamburger>i:before {
            transform: translate(-50%, -8px);
        }

        label.hamburger>i:after {
            transform: translate(-50%, 8px);
        }

        input.hamburger:checked~label>i {
            background-color: transparent;
        }

        input.hamburger:checked~label>i:before {
            transform: translate(-50%, -50%) rotate(45deg);
        }

        input.hamburger:checked~label>i:after {
            transform: translate(-50%, -50%) rotate(-45deg);
        }

        /* Profile Styles */
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
            box-shadow: 0 0 15px rgba(0, 243, 255, 0.4);
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
            background: rgba(0, 243, 255, 0.1);
            color: var(--accent-blue);
        }

        .dropdown-divider {
            height: 1px;
            background: var(--glass-border);
            margin: 8px 10px;
        }
    </style>
</head>

<body>
    <div id="bg-glow"></div>

    @include("partials.header")

    <main class="pt-12 pb-20 px-6">
        <div class="max-w-7xl mx-auto">
            <!-- Hero -->
            <div class="text-center mb-16 reveal">
                <h1 class="text-6xl font-black mb-4 tracking-tight uppercase">Algorithm <span
                        class="text-cyan-500">Festival</span></h1>
                <p class="text-lg dynamic-text-muted font-medium max-w-2xl mx-auto">Detailed schedule and activity
                    points for onstage and offstage tech events.</p>
            </div>

            <!-- Page Sections -->
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Onstage Section -->
                <section class="reveal">
                    <div class="flex items-center gap-4 mb-6">
                        <div
                            class="w-10 h-10 rounded-xl bg-cyan-600/20 flex items-center justify-center text-cyan-500 text-lg shadow-lg shadow-cyan-500/10">
                            <i class="fas fa-code"></i>
                        </div>
                        <h2 class="text-2xl font-black uppercase">Onstage Events</h2>
                    </div>

                    <div class="glass-card rounded-2xl overflow-hidden border border-white/10">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-white/10">
                                        <th
                                            class="px-4 py-3 text-xs font-bold uppercase tracking-wider border border-white/10 text-white text-center">
                                            Item</th>
                                        <th
                                            class="px-4 py-3 text-xs font-bold uppercase tracking-wider border border-white/10 text-white text-center">
                                            Date</th>
                                        <th
                                            class="px-4 py-3 text-xs font-bold uppercase tracking-wider border border-white/10 text-white text-center">
                                            Time</th>
                                        <th
                                            class="px-4 py-3 text-xs font-bold uppercase tracking-wider border border-white/10 text-white text-center">
                                            Activity Points</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="hover:bg-white/5 transition-colors">
                                        <td class="px-4 py-3 text-sm font-medium border border-white/10">Code Quest</td>
                                        <td class="px-4 py-3 text-sm border border-white/10 opacity-80">Mar 10</td>
                                        <td class="px-4 py-3 text-sm border border-white/10 opacity-80">10:00 AM</td>
                                        <td
                                            class="px-4 py-3 text-sm text-right font-bold text-cyan-500 border border-white/10">
                                            15</td>
                                    </tr>
                                    <tr class="hover:bg-white/5 transition-colors">
                                        <td class="px-4 py-3 text-sm font-medium border border-white/10">Robo Wars</td>
                                        <td class="px-4 py-3 text-sm border border-white/10 opacity-80">Mar 10</td>
                                        <td class="px-4 py-3 text-sm border border-white/10 opacity-80">01:00 PM</td>
                                        <td
                                            class="px-4 py-3 text-sm text-right font-bold text-cyan-500 border border-white/10">
                                            20</td>
                                    </tr>
                                    <tr class="hover:bg-white/5 transition-colors">
                                        <td class="px-4 py-3 text-sm font-medium border border-white/10">AI Challenge</td>
                                        <td class="px-4 py-3 text-sm border border-white/10 opacity-80">Mar 12</td>
                                        <td class="px-4 py-3 text-sm border border-white/10 opacity-80">10:00 AM</td>
                                        <td
                                            class="px-4 py-3 text-sm text-right font-bold text-cyan-500 border border-white/10">
                                            18</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <!-- Offstage Section -->
                <section class="reveal">
                    <div class="flex items-center gap-4 mb-6">
                        <div
                            class="w-10 h-10 rounded-xl bg-purple-600/20 flex items-center justify-center text-purple-500 text-lg shadow-lg shadow-purple-500/10">
                            <i class="fas fa-keyboard"></i>
                        </div>
                        <h2 class="text-2xl font-black uppercase">Offstage Events</h2>
                    </div>

                    <div class="glass-card rounded-2xl overflow-hidden border border-white/10">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-white/10">
                                        <th
                                            class="px-4 py-3 text-xs font-bold uppercase tracking-wider border border-white/10 text-white text-center">
                                            Item</th>
                                        <th
                                            class="px-4 py-3 text-xs font-bold uppercase tracking-wider border border-white/10 text-white text-center">
                                            Date</th>
                                        <th
                                            class="px-4 py-3 text-xs font-bold uppercase tracking-wider border border-white/10 text-white text-center">
                                            Time</th>
                                        <th
                                            class="px-4 py-3 text-xs font-bold uppercase tracking-wider border border-white/10 text-white text-center">
                                            Activity Points</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="hover:bg-white/5 transition-colors">
                                        <td class="px-4 py-3 text-sm font-medium border border-white/10">Tech Trivia</td>
                                        <td class="px-4 py-3 text-sm border border-white/10 opacity-80">Mar 11</td>
                                        <td class="px-4 py-3 text-sm border border-white/10 opacity-80">09:30 AM</td>
                                        <td
                                            class="px-4 py-3 text-sm text-right font-bold text-purple-500 border border-white/10">
                                            10</td>
                                    </tr>
                                    <tr class="hover:bg-white/5 transition-colors">
                                        <td class="px-4 py-3 text-sm font-medium border border-white/10">Debugging Duel</td>
                                        <td class="px-4 py-3 text-sm border border-white/10 opacity-80">Mar 11</td>
                                        <td class="px-4 py-3 text-sm border border-white/10 opacity-80">11:30 AM</td>
                                        <td
                                            class="px-4 py-3 text-sm text-right font-bold text-purple-500 border border-white/10">
                                            12</td>
                                    </tr>
                                    <tr class="hover:bg-white/5 transition-colors">
                                        <td class="px-4 py-3 text-sm font-medium border border-white/10">Web Weaver</td>
                                        <td class="px-4 py-3 text-sm border border-white/10 opacity-80">Mar 11</td>
                                        <td class="px-4 py-3 text-sm border border-white/10 opacity-80">02:00 PM</td>
                                        <td
                                            class="px-4 py-3 text-sm text-right font-bold text-purple-500 border border-white/10">
                                            15</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
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
        // Reveal Logic
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // Profile Toggle ---
        const trigger = document.getElementById('profileTrigger');
        const dropdown = document.getElementById('profileDropdown');
        if (trigger) {
            trigger.onclick = (e) => {
                e.stopPropagation();
                dropdown.classList.toggle('active');
            };
            document.onclick = () => dropdown.classList.remove('active');
        }
    </script>
</body>

</html>
