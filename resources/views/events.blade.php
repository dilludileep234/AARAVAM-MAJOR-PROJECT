<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events | ആരവം</title>
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
            transform: translateY(-10px);
            background: var(--card-hover);
            border-color: var(--accent-blue);
            box-shadow: 0 10px 30px -10px rgba(59, 130, 246, 0.3);
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
            transition: transform 0.2s ease-out;
        }

        .nav-link {
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: var(--accent-blue);
        }

        /* Filter Tabs */
        .filter-tab {
            padding: 10px 24px;
            border-radius: 99px;
            font-size: 0.875rem;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 1px solid var(--glass-border);
            background: var(--glass-bg);
            color: var(--text-muted);
        }

        .filter-tab.active {
            background: var(--accent-blue);
            color: white;
            border-color: var(--accent-blue);
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        /* Hamburger & Profile - Standardized */
        .drawer-list {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 100vw;
            transform: translate(-100vw, 0);
            backdrop-filter: blur(10px);
            z-index: 100;
            transition: transform 450ms ease;
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
            padding: 125px 0 0 0;
            overflow: auto;
            pointer-events: auto;
        }

        .drawer-list li {
            list-style: none;
            text-transform: uppercase;
            transform: translatex(-100vw);
            transition: transform 1s cubic-bezier(0.29, 1.4, 0.44, 0.96);
        }

        .drawer-list li a {
            text-decoration: none;
            color: #FEFEFE;
            display: block;
            padding: 1rem;
            font-size: 1.2rem;
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
        }

        input.hamburger:checked~.drawer-list li {
            transform: translatex(0);
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
            overflow: hidden;
            cursor: pointer;
            transition: 0.3s;
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
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: 0.3s;
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
            border-radius: 12px;
            transition: 0.2s;
            font-size: 0.9rem;
            text-decoration: none;
        }

        .dropdown-item:hover {
            background: rgba(59, 130, 246, 0.1);
            color: var(--accent-blue);
        }
    </style>
</head>

<body>
    <div id="bg-glow"></div>

    @include("partials.header")

    <main class="py-12 px-6 md:px-12 max-w-7xl mx-auto">
        <section class="text-center mb-16 reveal">
            <h1 class="text-4xl md:text-6xl font-extrabold mb-6 tracking-tight">Events @ <span
                    class="text-blue-500 uppercase">ആരവം</span></h1>
            <p class="max-w-2xl mx-auto dynamic-text-muted text-lg mb-10">Discover workshops, technical fests, and
                cultural celebrations happening at GPTC Muttom.</p>

            <!-- Filters -->
            <div class="flex flex-wrap justify-center gap-3 mb-12">
                <div class="filter-tab active" data-category="all">All Events</div>
                <div class="filter-tab" data-category="tech">Technical</div>
                <div class="filter-tab" data-category="cultural">Cultural</div>
                <div class="filter-tab" data-category="sports">Sports</div>

            </div>
        </section>

        <!-- Events Table Container -->
        <div class="glass-card rounded-[2.5rem] overflow-hidden reveal">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-white/10 bg-white/5">
                            <th class="px-8 py-6 text-xs font-bold uppercase tracking-widest opacity-70">Event Name</th>
                            <th class="px-8 py-6 text-xs font-bold uppercase tracking-widest opacity-70">Category</th>
                            <th class="px-8 py-6 text-xs font-bold uppercase tracking-widest opacity-70">Date & Time
                            </th>
                            <th class="px-8 py-6 text-xs font-bold uppercase tracking-widest opacity-70">Organizer</th>
                            <th class="px-8 py-6 text-xs font-bold uppercase tracking-widest opacity-70">Activity Points</th>
                            <th class="px-8 py-6 text-xs font-bold uppercase tracking-widest opacity-70 text-right">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody id="events-table-body">
                        <!-- Arts Event -->
                        <tr class="border-b border-white/5 hover:bg-white/5 transition-colors event-row"
                            data-category="cultural">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-pink-600/20 flex items-center justify-center text-pink-500">
                                        <i class="fas fa-palette"></i>
                                    </div>
                                    <span class="font-bold">Arts Festival</span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span
                                    class="bg-pink-600/20 text-pink-500 px-3 py-1 rounded-full text-[10px] font-bold uppercase">Cultural</span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="text-sm font-medium">March 05, 2026</div>
                                <div class="text-[10px] opacity-60 uppercase font-bold">10:00 AM</div>
                            </td>
                            <td class="px-8 py-6 text-sm font-medium opacity-80">ARTS CLUB</td>
                            <td class="px-8 py-6 text-sm font-bold text-blue-500">-</td>
                            <td class="px-8 py-6 text-right">
                                <a href="{{ route('arts.list') }}"
                                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl text-xs font-bold transition-all active:scale-95 text-center">View
                                    List</a>
                            </td>
                        </tr>

                        <!-- Sports Event -->
                        <tr class="border-b border-white/5 hover:bg-white/5 transition-colors event-row"
                            data-category="sports">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-green-600/20 flex items-center justify-center text-green-500">
                                        <i class="fas fa-volleyball-ball"></i>
                                    </div>
                                    <span class="font-bold">Annual Sports</span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span
                                    class="bg-green-600/20 text-green-500 px-3 py-1 rounded-full text-[10px] font-bold uppercase">Sports</span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="text-sm font-medium">March 15, 2026</div>
                                <div class="text-[10px] opacity-60 uppercase font-bold">8:30 AM</div>
                            </td>
                            <td class="px-8 py-6 text-sm font-medium opacity-80">SPORTS CELL</td>
                            <td class="px-8 py-6 text-sm font-bold text-blue-500">-</td>
                            <td class="px-8 py-6 text-right">
                                <a href="{{ route('sports.list') }}"
                                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl text-xs font-bold transition-all active:scale-95">
                                    View List
                                </a>
                            </td>
                        </tr>

                        <!-- Tech Fest Event -->
                        <tr class="border-b border-white/5 hover:bg-white/5 transition-colors event-row"
                            data-category="tech">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-blue-600/20 flex items-center justify-center text-blue-500">
                                        <i class="fas fa-microchip"></i>
                                    </div>
                                    <span class="font-bold">Tech Fests</span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span
                                    class="bg-blue-600/20 text-blue-500 px-3 py-1 rounded-full text-[10px] font-bold uppercase">Technical</span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="text-sm font-medium">March 25, 2026</div>
                                <div class="text-[10px] opacity-60 uppercase font-bold">9:00 AM</div>
                            </td>
                            <td class="px-8 py-6 text-sm font-medium opacity-80">TECH COUNCIL</td>
                            <td class="px-8 py-6 text-sm font-bold text-blue-500">-</td>
                            <td class="px-8 py-6 text-right">
                                <a href="{{ route('algorithm.list') }}"
                                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl text-xs font-bold transition-all active:scale-95">
                                    View List
                                </a>
                            </td>
                        </tr>


                        <!-- Cultural Fest Event -->
                        <tr class="border-b border-white/5 hover:bg-white/5 transition-colors event-row"
                            data-category="cultural">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-pink-600/20 flex items-center justify-center text-pink-500">
                                        <i class="fas fa-masks-theater"></i>
                                    </div>
                                    <span class="font-bold">Cultural Fest</span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span
                                    class="bg-pink-600/20 text-pink-500 px-3 py-1 rounded-full text-[10px] font-bold uppercase">Cultural</span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="text-sm font-medium">April 10, 2026</div>
                                <div class="text-[10px] opacity-60 uppercase font-bold">5:00 PM</div>
                            </td>
                            <td class="px-8 py-6 text-sm font-medium opacity-80">STUDENTS UNION</td>
                            <td class="px-8 py-6 text-sm font-bold text-blue-500">-</td>
                            <td class="px-8 py-6 text-right">
                                <a href="{{ route('cultural.list') }}"
                                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl text-xs font-bold transition-all active:scale-95">
                                    View List
                                </a>
                            </td>
                        </tr>


                    </tbody>
                </table>
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
        // --- Profile Dropdown Logic ---
        const profileTrigger = document.getElementById('profileTrigger');
        const profileDropdown = document.getElementById('profileDropdown');
        if (profileTrigger && profileDropdown) {
            profileTrigger.addEventListener('click', (e) => {
                e.stopPropagation();
                profileDropdown.classList.toggle('active');
            });
            document.addEventListener('click', (e) => {
                if (!profileTrigger.contains(e.target) && !profileDropdown.contains(e.target)) {
                    profileDropdown.classList.remove('active');
                }
            });
        }

        // --- Filtering Logic ---
        const filterTabs = document.querySelectorAll('.filter-tab');
        const eventRows = document.querySelectorAll('.event-row');

        filterTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                filterTabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');

                const category = tab.getAttribute('data-category');

                eventRows.forEach(row => {
                    const rowCategory = row.getAttribute('data-category');
                    if (category === 'all' || category === rowCategory) {
                        row.style.display = 'table-row';
                        setTimeout(() => row.style.opacity = '1', 10);
                    } else {
                        row.style.opacity = '0';
                        setTimeout(() => row.style.display = 'none', 300);
                    }
                });
            });
        });

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
    </script>
</body>

</html>
