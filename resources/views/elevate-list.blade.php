<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ELEVATE | Training Tracks | ആരവം</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap');

        /* Theme Variables */
        :root {
            --bg-color: #0d0118;
            --text-main: #ffffff;
            --text-muted: #94a3b8;
            --glass-bg: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.1);
            --header-bg: rgba(13, 1, 24, 0.85);
            --card-hover: rgba(255, 255, 255, 0.07);
            --accent-purple: #a855f7;
            --accent-cyan: #22d3ee;
        }

        .light-theme {
            --bg-color: #f8fafc;
            --text-main: #0f172a;
            --text-muted: #475569;
            --glass-bg: rgba(255, 255, 255, 0.8);
            --glass-border: rgba(168, 85, 247, 0.2);
            --header-bg: rgba(248, 250, 252, 0.9);
            --card-hover: rgba(168, 85, 247, 0.05);
            --accent-purple: #9333ea;
            --accent-cyan: #0891b2;
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
            background: radial-gradient(circle at 50% 50%, rgba(168, 85, 247, 0.05) 0%, transparent 70%);
        }

        /* Profile Styles (Consistent with other pages) */
        .profile-wrapper { position: relative; display: flex; align-items: center; }
        .profile-trigger { width: 42px; height: 42px; border-radius: 50%; border: 2px solid var(--accent-purple); padding: 2px; cursor: pointer; overflow: hidden; background: var(--glass-bg); display: flex; align-items: center; justify-content: center; transition: 0.3s; }
        .profile-dropdown { position: absolute; top: calc(100% + 15px); right: 0; width: 220px; background: rgba(15, 23, 42, 0.95); backdrop-filter: blur(20px); border: 1px solid var(--glass-border); border-radius: 20px; padding: 10px; opacity: 0; visibility: hidden; transform: translateY(10px); transition: 0.3s; z-index: 1000; }
        .profile-dropdown.active { opacity: 1; visibility: visible; transform: translateY(0); }
        .dropdown-item { display: flex; align-items: center; gap: 12px; padding: 12px 15px; color: var(--text-main); text-decoration: none; border-radius: 12px; transition: 0.2s; font-size: 0.9rem; }
        .dropdown-item:hover { background: rgba(168, 85, 247, 0.1); color: var(--accent-purple); }
    </style>
</head>

<body>
    <div id="bg-glow"></div>

    @include("partials.header")

    <main class="pt-12 pb-20 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16 reveal">
                <h1 class="text-6xl font-black mb-4 tracking-tight uppercase">Elevate <span class="text-purple-500">Tracks</span></h1>
                <p class="text-lg dynamic-text-muted font-medium max-w-2xl mx-auto">Master the art of professional excellence. Activity points breakdown for all training tracks.</p>
            </div>

            <div class="reveal">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-purple-600/20 flex items-center justify-center text-purple-500 text-lg">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h2 class="text-2xl font-black uppercase">Workshop Schedule</h2>
                </div>

                <div class="glass-card rounded-2xl overflow-hidden border border-white/10">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-white/5">
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-purple-400">Track Name</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-purple-400">Category</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-purple-400">Time Segment</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-purple-400 text-right">Activity Points</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($events as $event)
                            <tr class="border-t border-white/5 hover:bg-white/5 transition-colors">
                                <td class="px-6 py-4 text-sm font-semibold">{{ $event->name }}</td>
                                <td class="px-6 py-4 text-sm opacity-70">{{ $event->sub_category }}</td>
                                <td class="px-6 py-4 text-sm opacity-70">{{ $event->time }}</td>
                                <td class="px-6 py-4 text-sm text-right font-bold text-purple-500">+{{ $event->activity_points }} AP</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center dynamic-text-muted">No tracks found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-12 text-center">
                    <a href="{{ route('elevate') }}" class="inline-flex items-center gap-2 text-purple-400 hover:text-purple-300 font-bold transition">
                        <i class="fas fa-arrow-left"></i> Back to Elevate Details
                    </a>
                </div>
            </div>
        </div>
    </main>

    <footer class="pt-24 pb-12 px-6 md:px-12 border-t border-white/5 reveal">
        <div class="text-center dynamic-text-muted text-[10px] tracking-[0.4em] uppercase">
            © 2026 ആരവം. Engineered by the Students of GPTC Muttom.
        </div>
    </footer>

    <script>
        // Reveal Logic
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('active');
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
