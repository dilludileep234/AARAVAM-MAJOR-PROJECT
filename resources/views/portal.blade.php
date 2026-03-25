<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @include('partials.theme-system')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ആരവം</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap');

        :root {
            --bg-dark: #020617;
            --card-bg: #0f172a;
            --accent-blue: #3b82f6;
            --accent-purple: #8b5cf6;
            --accent-orange: #f59e0b;
            --text-main: #f8fafc;
            --text-dim: #94a3b8;
            --border: rgba(255, 255, 255, 0.06);
            --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            --social-bg: rgba(255, 255, 255, 0.05);
            --social-text: #94a3b8;
            --header-bg: rgba(2, 6, 23, 0.85);
            --card-hover: rgba(255, 255, 255, 0.07);
            --glass-bg: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.1);
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
        }

        .dynamic-text-muted {
            color: var(--text-dim);
        }

        /* Profile Styles */
        .profile-wrapper {
            position: relative;
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

        .light-theme .profile-dropdown {
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
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
            background: transparent;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
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
            background: var(--border);
            margin: 8px 10px;
        }

        /* --- MAIN CONTAINER --- */
        .container {
            max-width: 1350px;
            margin: 0 auto;
            padding: 40px 4%;
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 40px;
        }

        /* --- STAT CARDS --- */
        .stats-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 50px;
        }

        .stat-card {
            flex: 1 1 250px;
            max-width: 280px;
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(12px);
            padding: 20px 24px;
            border-radius: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .stat-card:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.07);
            border-color: var(--accent-blue);
            box-shadow: 0 10px 30px -10px rgba(59, 130, 246, 0.3);
        }

        .stat-card h2 {
            font-size: 2.2rem;
            margin: 5px 0;
        }

        .stat-card span {
            font-size: 0.85rem;
            color: var(--text-dim);
        }

        .stat-icon {
            font-size: 1.4rem;
            padding: 10px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .blue {
            color: var(--accent-blue);
            background: rgba(59, 130, 246, 0.1);
        }

        .purple {
            color: var(--accent-purple);
            background: rgba(139, 92, 246, 0.1);
        }

        .orange {
            color: var(--accent-orange);
            background: rgba(245, 158, 11, 0.1);
        }

        /* --- CLUB GRID --- */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .club-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 60px;
        }

        .club-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
            padding: 30px;
            border-radius: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .club-card:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.07);
            border-color: var(--accent-blue);
            box-shadow: 0 10px 30px -10px rgba(59, 130, 246, 0.3);
        }

        .club-card i {
            font-size: 2.5rem;
            margin-bottom: 15px;
            display: block;
        }

        .badge {
            font-size: 0.75rem;
            background: rgba(59, 130, 246, 0.15);
            color: var(--accent-blue);
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: 600;
        }

        /* --- UPCOMING EVENTS LIST --- */
        .event-item {
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(12px);
            padding: 16px 20px;
            border-radius: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .event-item:hover {
            transform: translateX(10px) translateY(-5px);
            background: rgba(255, 255, 255, 0.07);
            border-color: var(--accent-blue);
            box-shadow: 0 10px 30px -10px rgba(59, 130, 246, 0.3);
        }

        .event-meta h4 {
            font-size: 1rem;
            margin-bottom: 4px;
        }

        .event-meta p {
            font-size: 0.85rem;
            color: var(--text-dim);
        }

        .status-pill {
            background: rgba(34, 197, 94, 0.1);
            color: #22c55e;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .btn-view {
            border: 1px solid var(--accent-blue);
            color: var(--accent-blue);
            text-decoration: none;
            padding: 6px 15px;
            border-radius: 8px;
            font-size: 0.85rem;
            transition: 0.3s;
        }

        .btn-view:hover {
            background: var(--accent-blue);
            color: white;
        }

        /* --- ACHIEVEMENTS GRID --- */
        .achieve-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 60px;
        }

        .achieve-card {
            flex: 1 1 180px;
            max-width: 220px;
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(12px);
            padding: 24px;
            border-radius: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.05);
            text-align: center;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .achieve-card:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.07);
            border-color: var(--accent-blue);
            box-shadow: 0 10px 30px -10px rgba(59, 130, 246, 0.3);
        }

        .achieve-card i {
            font-size: 2.2rem;
            margin-bottom: 12px;
            display: block;
        }

        .gold {
            color: #facc15;
        }

        .silver {
            color: #94a3b8;
        }

        .bronze {
            color: #d97706;
        }

        /* --- SIDEBAR --- */
        .sidebar {
            background: var(--card-bg);
            padding: 25px;
            border-radius: 20px;
            border: 1px solid var(--border);
            height: fit-content;
        }

        .sidebar h3 {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.1rem;
        }

        .notif-box {
            border-bottom: 1px solid var(--border);
            padding: 15px 0;
        }

        .notif-box:last-child {
            border: none;
        }

        .notif-box h5 {
            color: var(--accent-blue);
            font-size: 0.95rem;
            margin-bottom: 5px;
        }

        .notif-box p {
            font-size: 0.85rem;
            color: var(--text-dim);
        }

        /* --- FOOTER --- */
        .dynamic-text-muted {
            color: var(--text-dim);
            transition: color 0.4s ease;
        }

        .dynamic-text-muted a {
            color: inherit;
            text-decoration: none;
        }

        .light-theme .dynamic-text-muted {
            color: #475569;
        }



        /* --- ANIMATIONS --- */
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

        .reveal-up {
            transform: translateY(50px);
        }

        .light-theme {
            --bg-dark: #f1f5f9;
            --card-bg: #ffffff;
            --text-main: #0f172a;
            --text-dim: #334155;
            --border: rgba(15, 23, 42, 0.08);
            --social-bg: rgba(15, 23, 42, 0.04);
            --social-text: #334155;
            --header-bg: rgba(241, 245, 249, 0.85);
            --card-hover: rgba(59, 130, 246, 0.06);
            --glass-bg: rgba(255, 255, 255, 0.8);
            --glass-border: rgba(15, 23, 42, 0.1);
        }

        .light-theme nav {
            background: rgba(248, 250, 252, 0.85);
        }

        .light-theme .stat-card, 
        .light-theme .club-card, 
        .light-theme .achieve-card, 
        .light-theme .event-item, 
        .light-theme .sidebar {
            background: #ffffff;
            border-color: rgba(15, 23, 42, 0.08);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        @media (max-width: 1100px) {
            .container {
                grid-template-columns: 1fr;
            }
        }

        /* --- PROFILE ICON --- */
        .profile-container {
            display: flex;
            align-items: center;
        }

        .profile-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid var(--accent-blue);
            cursor: pointer;
            transition: var(--transition);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.05);
        }

        .profile-btn:hover {
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.4);
            transform: scale(1.05);
        }

        .profile-btn img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* --- LARGE WELCOME PROFILE --- */
        .welcome-section {
            display: flex;
            align-items: center;
            gap: 25px;
            margin-bottom: 50px;
        }

        .large-profile-img {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            border: 4px solid var(--accent-blue);
            object-fit: cover;
            box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3);
        }

        .start-100 { left: 100%!important; }
        .translate-middle { transform: translate(-50%,-50%)!important; }
        .rounded-circle { border-radius: 50%!important; }
        .bg-primary { background-color: #0d6efd!important; }
        .btn-sm { padding: .25rem .5rem; font-size: .875rem; border-radius: .2rem; }
        .text-white { color: #fff!important; }
        
        .welcome-text h1 {
            font-size: 2.5rem;
        }
        
        .logout-btn {
            color: var(--text-dim);
            text-decoration: none;
            font-size: 0.9rem;
            transition: 0.3s;
            margin-left: 20px;
        }
        
        .logout-btn:hover {
            color: var(--accent-blue);
        }
    </style>
</head>

<body>

    @include('partials.header')

    <div class="container">
        <main>
            <div class="welcome-section">
                <!-- Profile Image with Edit Button -->
                <div class="large-profile-img" style="position: relative; overflow: visible; border: none; background: transparent; box-shadow: none;">
                    <div style="width: 160px; height: 160px; border-radius: 50%; border: 4px solid var(--accent-blue); overflow: hidden; position: relative;">
                         @if(Auth::user()->profile_image)
                            <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="Profile" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <div style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center; background: #1e293b;">
                                <i class="fas fa-user-circle" style="font-size: 100px; color: var(--accent-blue);"></i>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Edit Button -->
                    <button onclick="document.getElementById('profile_image_input').click()" 
                            style="position: absolute; bottom: 10px; right: 10px; background: var(--accent-blue); border: none; color: white; width: 40px; height: 40px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.3s; z-index: 10;">
                        <i class="fas fa-camera"></i>
                    </button>

                    <!-- Hidden Form -->
                    <form id="profile_form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" style="display: none;">
                        @csrf
                        <input type="file" id="profile_image_input" name="profile_image" accept="image/*" onchange="document.getElementById('profile_form').submit()">
                    </form>
                </div>
                
                <div class="welcome-text flex-1">
                    <h1>Welcome back, {{ Auth::user()->username ?? 'User' }}!</h1>
                    <p style="color:var(--text-dim)">Track your college activities and upcoming events.</p>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('results.download') }}" class="flex items-center gap-2 px-6 py-3 bg-blue-600/10 hover:bg-blue-600 text-blue-500 hover:text-white border border-blue-500/20 rounded-xl font-bold transition-all active:scale-95 shadow-lg shadow-blue-950/20">
                        <i class="fas fa-download"></i> Download My Results
                    </a>
                </div>
            </div>

            <div class="stats-grid">
                <div class="stat-card reveal active" style="transition-delay: 0.1s;">
                    <div><span>Events Registered</span>
                        <h2>{{ $registrations->flatMap->items->count() }}</h2><span class="purple">Upcoming</span>
                    </div>
                    <div class="stat-icon purple"><i class="fas fa-calendar-check"></i></div>
                </div>
                <div class="stat-card reveal active" style="transition-delay: 0.2s;">
                    <div><span>Achievements</span>
                        <h2>{{ $registrations->flatMap->items->whereNotNull('rank')->count() }}</h2><span class="orange">Earned</span>
                    </div>
                    <div class="stat-icon orange"><i class="fas fa-trophy"></i></div>
                </div>
            </div>


            <!-- Competition Results Section -->
            @php
                $rankedItems = $registrations->flatMap->items->whereNotNull('rank');
            @endphp
            
            @if($rankedItems->count() > 0)
            <div class="section-header reveal" style="margin-top: 50px;">
                <h3 class="flex items-center gap-2 px-4 py-2 bg-yellow-500/10 text-yellow-500 border border-yellow-500/20 rounded-xl text-sm font-bold w-fit">
                    <i class="fas fa-award"></i> Competition Track
                </h3>
            </div>
            <div class="reveal">
                @foreach($rankedItems as $item)
                <div class="event-item" style="border-left: 4px solid {{ $item->rank == '1' ? '#facc15' : ($item->rank == '2' ? '#94a3b8' : ($item->rank == '3' ? '#d97706' : '#3b82f6')) }}">
                    <div class="event-meta">
                        <h4 class="flex items-center gap-2">
                            {{ $item->event->name }}
                            @if($item->rank == '1') <i class="fas fa-trophy text-yellow-500 text-xs"></i> 
                            @elseif($item->rank == '2') <i class="fas fa-medal text-slate-400 text-xs"></i>
                            @elseif($item->rank == '3') <i class="fas fa-medal text-amber-600 text-xs"></i>
                            @endif
                        </h4>
                        <p>{{ $item->event->category }} • Score: <span class="text-white font-bold">{{ $item->score ?? '0' }}</span></p>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest bg-white/5 border border-white/10 {{ $item->rank == '1' ? 'text-yellow-500 border-yellow-500/20' : ($item->rank == '2' ? 'text-slate-400 border-slate-400/20' : ($item->rank == '3' ? 'text-amber-600 border-amber-600/20' : 'text-cyan-400')) }}">
                            {{ $item->rank == '1' ? '🥇 1st Place' : ($item->rank == '2' ? '🥈 2nd Place' : ($item->rank == '3' ? '🥉 3rd Place' : $item->rank)) }}
                        </span>
                        <a href="{{ route('results.item.export', $item) }}" class="w-10 h-10 flex items-center justify-center bg-white/5 hover:bg-blue-600 text-slate-400 hover:text-white rounded-xl border border-white/5 transition-all" title="Download Result">
                            <i class="fas fa-file-download"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            <div class="section-header reveal" style="margin-top: 50px;">
                <h3>Upcoming Events</h3>
            </div>
            <div class="reveal">
                @forelse($registrations->flatMap->items as $item)
                <div class="event-item">
                    <div class="event-meta">
                        <h4>{{ $item->event->name }}</h4>
                        <p>{{ $item->event->category }} • {{ $item->event->sub_category }} • Registered on {{ $item->created_at->format('M d, Y') }}</p>
                    </div>
                    <div style="display:flex; gap:15px; align-items:center;">
                        @if($item->rank)
                            <span class="px-3 py-1 bg-yellow-500/10 text-yellow-500 border border-yellow-500/20 rounded-full text-[10px] font-bold">Result Published</span>
                        @endif
                        <span class="status-pill">{{ ucfirst($item->registration->status) }}</span>
                        <button class="btn-view bg-transparent cursor-pointer event-details-btn" 
                                data-event="{{ json_encode($item->event) }}" 
                                data-status="{{ ucfirst($item->registration->status) }}"
                                data-score="{{ $item->score }}"
                                data-rank="{{ $item->rank }}"
                                data-id="{{ $item->id }}">
                            Details
                        </button>
                    </div>
                </div>
                @empty
                <div class="text-center py-10 opacity-50">
                    <p>You haven't registered for any events yet.</p>
                    <a href="{{ route('fests') }}" class="text-blue-500 hover:underline">Browse Events</a>
                </div>
                @endforelse
            </div>

            <div class="section-header reveal" style="margin-top: 50px;">
                <h3>Achievements</h3>
            </div>
            <div class="achieve-grid">
                <div class="achieve-card reveal">
                    <i class="fas fa-medal gold"></i>
                    <h4>Early Bird</h4>
                    <p style="font-size:0.8rem; color:var(--text-dim)">Top 5% early registrations</p>
                </div>
                <div class="achieve-card reveal" style="transition-delay: 0.1s;">
                    <i class="fas fa-award silver"></i>
                    <h4>Student Life</h4>
                    <p style="font-size:0.8rem; color:var(--text-dim)">Active in 3+ societies</p>
                </div>
                <div class="achieve-card reveal" style="transition-delay: 0.2s;">
                    <i class="fas fa-star bronze"></i>
                    <h4>Active Member</h4>
                    <p style="font-size:0.8rem; color:var(--text-dim)">Attended 10+ events</p>
                </div>
            </div>
        </main>

        <aside class="sidebar reveal active">
            <h3><i class="far fa-bell"></i> Notifications</h3>
            <div class="notif-box">
                <h5>Code Sprint 2025</h5>
                <p>Registration closes in 2 hours!</p>
            </div>
            <div class="notif-box">
                <h5>PhaseShift 2025</h5>
                <p>Early bird tickets are now live.</p>
            </div>
            <div class="notif-box">
                <h5>Life Update</h5>
                <p>Robotics meeting moved to Hall B.</p>
            </div>
        </aside>
    </div>

    <footer class="pt-24 pb-12 px-6 md:px-[1.5%] border-t border-white/5 reveal reveal-up">
        <div class="max-w-[1750px] mx-auto grid md:grid-cols-4 gap-12 mb-20">
            <div class="col-span-1">
                <div class="flex items-center gap-3 mb-8">
                    <div class="bg-blue-600 w-9 h-9 rounded-xl flex items-center justify-center font-bold text-white">E</div>
                    <span class="text-2xl font-black tracking-widest">ആരവം</span>
                </div>
                <p class="dynamic-text-muted text-sm leading-relaxed">Connecting the dots for every student at GPTC Muttom. Join our journey to redefine campus excellence.</p>
            </div>

            <div>
                <h4 class="font-bold mb-8 uppercase tracking-widest text-xs tracking-tighter">Explore</h4>
                <ul class="dynamic-text-muted text-sm space-y-4 font-medium">
                    <li><a href="{{ route('home') }}" class="hover:text-blue-500 transition">Home</a></li>
                    <li><a href="{{ route('fests') }}" class="hover:text-blue-500 transition">Fests</a></li>
                    <li><a href="{{ route('calendar') }}" class="hover:text-blue-500 transition">Academic Calendar</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-blue-500 transition">Contact</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold mb-8 uppercase tracking-widest text-xs tracking-tighter">Contact</h4>
                <div class="dynamic-text-muted text-sm space-y-5">
                    <p class="flex items-start gap-4"><i class="fas fa-map-marker-alt text-blue-600 mt-1"></i> Idukki, Kerala, 685587</p>
                    <p class="flex items-center gap-4"><i class="fas fa-envelope text-blue-600"></i> aaravam@gptcmuttom.ac.in</p>
                    <p class="flex items-center gap-4"><i class="fas fa-phone text-blue-600"></i> +91 4862 255 310</p>
                </div>
            </div>

            <div>
                <h4 class="font-bold mb-8 uppercase tracking-widest text-xs tracking-tighter">Follow Us</h4>
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
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('active');
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // SweetAlert for Session Messages
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('success') }}",
                background: '#0f172a',
                color: '#f8fafc',
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        @endif

        @if($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: "{!! implode('<br>', $errors->all()) !!}",
                background: '#0f172a',
                color: '#f8fafc'
            });
        @endif

        // Show Event Details Listener
        document.addEventListener('DOMContentLoaded', function() {
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('event-details-btn')) {
                    try {
                        const event = JSON.parse(e.target.getAttribute('data-event'));
                        const status = e.target.getAttribute('data-status');
                        const score = e.target.getAttribute('data-score');
                        const rank = e.target.getAttribute('data-rank');
                        const itemId = e.target.getAttribute('data-id');
                        showDetails(event, status, score, rank, itemId);
                    } catch (err) {
                        console.error('Error parsing event data:', err);
                    }
                }
            });
        });

        function showDetails(event, status, score = null, rank = null, itemId = null) {
            let statusColor = '#22c55e'; // default green (approved)
            let statusBg = 'rgba(34, 197, 94, 0.1)';
            
            if (status.toLowerCase() === 'pending') {
                statusColor = '#f59e0b'; // amber
                statusBg = 'rgba(245, 158, 11, 0.1)';
            } else if (status.toLowerCase() === 'rejected') {
                statusColor = '#ef4444'; // red
                statusBg = 'rgba(239, 68, 68, 0.1)';
            }

            let resultHtml = '';
            if (rank && rank !== 'null' && rank !== '') {
                const rankDisplay = rank == '1' ? '🥇 1st Place' : (rank == '2' ? '🥈 2nd Place' : (rank == '3' ? '🥉 3rd Place' : rank));
                resultHtml = `
                    <div style="margin-top: 15px; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 15px;">
                        <strong style="color: #facc15;"><i class="fas fa-trophy mr-1"></i> Performance Result:</strong>
                        <div style="display: flex; gap: 10px; margin-top: 10px;">
                            <div style="flex: 1; background: rgba(59, 130, 246, 0.05); padding: 10px; border-radius: 12px; border: 1px solid rgba(59, 130, 246, 0.2); text-align: center;">
                                <p style="font-size: 0.6rem; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px;">Rank</p>
                                <p style="font-size: 1rem; color: #fff; font-weight: 800;">${rankDisplay}</p>
                            </div>
                            <div style="flex: 1; background: rgba(255,255,255,0.05); padding: 10px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.1); text-align: center;">
                                <p style="font-size: 0.6rem; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px;">Score</p>
                                <p style="font-size: 1rem; color: #fff; font-weight: 800;">${score || '0'}</p>
                            </div>
                            <a href="/results/item/${itemId}/export" style="flex: 0 0 50px; background: #3b82f6; color: #white; display: flex; align-items: center; justify-content: center; border-radius: 12px; text-decoration: none; font-size: 1.2rem;" title="Download Data">
                                <i class="fas fa-download"></i>
                            </a>
                        </div>
                    </div>
                `;
            }

            Swal.fire({
                title: event.name,
                html: `
                    <div style="text-align: left; padding: 10px;">
                        <p style="margin-bottom: 8px;"><strong style="color: #3b82f6;">Category:</strong> ${event.category} ${event.sub_category ? ' • ' + event.sub_category : ''}</p>
                        <p style="margin-bottom: 8px;"><strong style="color: #3b82f6;">Time/Schedule:</strong> ${event.time ? event.time : 'TBA'}</p>
                        <p style="margin-bottom: 8px;"><strong style="color: #3b82f6;">Registration Fee:</strong> ₹${event.fees}</p>
                        ${event.activity_points ? `<p style="margin-bottom: 8px;"><strong style="color: #3b82f6;">Activity Points:</strong> ${event.activity_points}</p>` : ''}
                        <p style="margin-bottom: 8px;"><strong style="color: #3b82f6;">Registration Status:</strong> <span style="background: ${statusBg}; color: ${statusColor}; padding: 3px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; margin-left: 5px;">${status}</span></p>
                        
                        ${resultHtml}

                        <div style="margin-top: 15px; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 15px;">
                            <strong style="color: #3b82f6;">About the Event:</strong><br>
                            <p style="color: #94a3b8; font-size: 0.9rem; margin-top: 5px; max-height: 150px; overflow-y: auto;">${event.description ? event.description : 'No description provided.'}</p>
                        </div>
                    </div>
                `,
                background: '#0f172a',
                color: '#f8fafc',
                confirmButtonColor: '#3b82f6',
                confirmButtonText: 'Close',
                customClass: {
                    popup: 'border border-white/10 rounded-2xl animate__animated animate__zoomIn'
                }
            });
        }

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
