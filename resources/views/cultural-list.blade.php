<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cultural Harmony | ആരവം</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap');

        /* Theme Variables */
        :root {
            --bg-color: #0d0612;
            --text-main: #ffffff;
            --text-muted: #a78bfa;
            --glass-bg: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.1);
            --header-bg: rgba(13, 6, 18, 0.85);
            --card-hover: rgba(255, 255, 255, 0.07);
            --accent-orange: #f97316;
            --accent-purple: #7c3aed;
        }

        .light-theme {
            --bg-color: #fef2f2;
            --text-main: #4a044e;
            --text-muted: #7c3aed;
            --glass-bg: rgba(255, 255, 255, 0.8);
            --glass-border: rgba(249, 115, 22, 0.2);
            --header-bg: rgba(254, 242, 242, 0.9);
            --card-hover: rgba(249, 115, 22, 0.05);
            --accent-orange: #ea580c;
            --accent-purple: #6d28d9;
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
            background: radial-gradient(circle at 50% 50%, rgba(249, 115, 22, 0.05) 0%, transparent 70%);
        }

        .nav-link {
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: var(--accent-orange);
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
            border: 2px solid var(--accent-orange);
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
            box-shadow: 0 0 15px rgba(249, 115, 22, 0.4);
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
            background: rgba(249, 115, 22, 0.1);
            color: var(--accent-orange);
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
                <h1 class="text-6xl font-black mb-4 tracking-tight uppercase">Cultural <span
                        class="text-orange-500">Harmony</span></h1>
                <p class="text-lg dynamic-text-muted font-medium max-w-2xl mx-auto">Detailed schedule and activity
                    points for music, dance, and creative celebrations.</p>
            </div>

            <!-- Page Sections -->
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Onstage Section -->
                <section class="reveal">
                    <div class="flex items-center gap-4 mb-6">
                        <div
                            class="w-10 h-10 rounded-xl bg-orange-600/20 flex items-center justify-center text-orange-500 text-lg shadow-lg shadow-orange-500/10">
                            <i class="fas fa-masks-theater"></i>
                        </div>
                        <h2 class="text-2xl font-black uppercase">Main Stage</h2>
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
                                        <td class="px-4 py-3 text-sm font-medium border border-white/10">Musical Night</td>
                                        <td class="px-4 py-3 text-sm border border-white/10 opacity-80">Mar 20</td>
                                        <td class="px-4 py-3 text-sm border border-white/10 opacity-80">06:00 PM</td>
                                        <td
                                            class="px-4 py-3 text-sm text-right font-bold text-orange-500 border border-white/10">
                                            20</td>
                                    </tr>
                                    <tr class="hover:bg-white/5 transition-colors">
                                        <td class="px-4 py-3 text-sm font-medium border border-white/10">Dance Showcase</td>
                                        <td class="px-4 py-3 text-sm border border-white/10 opacity-80">Mar 21</td>
                                        <td class="px-4 py-3 text-sm border border-white/10 opacity-80">05:30 PM</td>
                                        <td
                                            class="px-4 py-3 text-sm text-right font-bold text-orange-500 border border-white/10">
                                            20</td>
                                    </tr>
                                    <tr class="hover:bg-white/5 transition-colors">
                                        <td class="px-4 py-3 text-sm font-medium border border-white/10">Fashion Show</td>
                                        <td class="px-4 py-3 text-sm border border-white/10 opacity-80">Mar 22</td>
                                        <td class="px-4 py-3 text-sm border border-white/10 opacity-80">07:00 PM</td>
                                        <td
                                            class="px-4 py-3 text-sm text-right font-bold text-orange-500 border border-white/10">
                                            25</td>
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
                            <i class="fas fa-palette"></i>
                        </div>
                        <h2 class="text-2xl font-black uppercase">Creative Zone</h2>
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
                                        <td class="px-4 py-3 text-sm font-medium border border-white/10">Drama Performance</td>
                                        <td class="px-4 py-3 text-sm border border-white/10 opacity-80">Mar 23</td>
                                        <td class="px-4 py-3 text-sm border border-white/10 opacity-80">04:00 PM</td>
                                        <td
                                            class="px-4 py-3 text-sm text-right font-bold text-purple-500 border border-white/10">
                                            15</td>
                                    </tr>
                                    <tr class="hover:bg-white/5 transition-colors">
                                        <td class="px-4 py-3 text-sm font-medium border border-white/10">Carnival Event</td>
                                        <td class="px-4 py-3 text-sm border border-white/10 opacity-80">Mar 24</td>
                                        <td class="px-4 py-3 text-sm border border-white/10 opacity-80">10:00 AM</td>
                                        <td
                                            class="px-4 py-3 text-sm text-right font-bold text-purple-500 border border-white/10">
                                            10</td>
                                    </tr>
                                    <tr class="hover:bg-white/5 transition-colors">
                                        <td class="px-4 py-3 text-sm font-medium border border-white/10">Art Gallery</td>
                                        <td class="px-4 py-3 text-sm border border-white/10 opacity-80">Mar 24</td>
                                        <td class="px-4 py-3 text-sm border border-white/10 opacity-80">02:00 PM</td>
                                        <td
                                            class="px-4 py-3 text-sm text-right font-bold text-purple-500 border border-white/10">
                                            5</td>
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
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

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
