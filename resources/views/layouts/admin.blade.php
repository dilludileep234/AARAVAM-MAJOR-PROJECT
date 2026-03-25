<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Aaravam</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 280px;
            --header-height: 70px;
            --accent: #3b82f6; /* Modern Blue */
            --bg-master: #020617;
            --bg-sidebar: #070a13;
            --glass: rgba(255, 255, 255, 0.02);
            --glass-border: rgba(255, 255, 255, 0.06);
        }
        body { font-family: 'Inter', sans-serif; background-color: var(--bg-master); color: #e2e8f0; }
        .glass-card {
            background: var(--glass);
            backdrop-filter: blur(16px);
            border: 1px solid var(--glass-border);
            border-radius: 1.25rem;
            box-shadow: 0 10px 30px -10px rgba(0,0,0,0.5);
        }
        .sidebar-link {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            color: #94a3b8;
        }
        .sidebar-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.03);
        }
        .sidebar-link.active {
            color: var(--accent);
            background: rgba(59, 130, 246, 0.08);
            font-weight: 600;
        }
        .sidebar-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 25%;
            height: 50%;
            width: 3px;
            background: var(--accent);
            border-radius: 0 4px 4px 0;
            box-shadow: 2px 0 10px var(--accent);
        }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
    </style>
</head>
<body class="antialiased custom-scrollbar">
    <!-- Mobile Overlay -->
    <div id="mobile-overlay" class="fixed inset-0 bg-black/60 z-50 hidden md:hidden backdrop-blur-sm transition-all duration-300 opacity-0"></div>

    <div class="flex min-h-screen relative">
        <!-- Sidebar -->
        <aside id="sidebar" class="w-[var(--sidebar-width)] bg-[var(--bg-sidebar)] border-r border-white/5 flex flex-col fixed inset-y-0 left-0 z-[60] transform -translate-x-full md:translate-x-0 transition-all duration-300 ease-in-out">
            <!-- Logo area -->
            <div class="h-[var(--header-height)] flex items-center justify-between px-8 border-b border-white/5">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-blue-600 to-cyan-500 flex items-center justify-center shadow-lg shadow-blue-500/20">
                        <i class="fas fa-shield-alt text-white text-xs"></i>
                    </div>
                    <div>
                        <span class="text-sm font-black tracking-[4px] text-white">AARAVAM</span>
                        <p class="text-[8px] text-blue-400 font-bold uppercase tracking-widest leading-none mt-0.5">Control Center</p>
                    </div>
                </div>
                <!-- Mobile Close Button -->
                <button id="sidebar-close" class="md:hidden text-slate-400 hover:text-white transition">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-8 custom-scrollbar">
                <!-- Main Section -->
                <div class="space-y-1">
                    <p class="px-4 pb-2 text-[10px] font-bold text-slate-500 uppercase tracking-[2px]">Main Menu</p>
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-grid-2 text-sm"></i>
                        <span class="text-sm">Overview</span>
                    </a>
                    <a href="{{ route('admin.registrations.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.registrations.*') ? 'active' : '' }}">
                        <i class="fas fa-receipt text-sm"></i>
                        <span class="text-sm">Registrations</span>
                    </a>
                    <a href="{{ route('admin.results.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.results.*') ? 'active' : '' }}">
                        <i class="fas fa-trophy text-sm"></i>
                        <span class="text-sm">Results Board</span>
                    </a>
                </div>

                <!-- Operations -->
                <div class="space-y-1">
                    <p class="px-4 pb-2 text-[10px] font-bold text-slate-500 uppercase tracking-[2px]">Operations</p>
                    <a href="{{ route('admin.fests.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.fests.*') ? 'active' : '' }}">
                        <i class="fas fa-layer-group text-sm"></i>
                        <span class="text-sm">Module Management</span>
                    </a>
                    <a href="{{ route('admin.academic-calendar.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.academic-calendar.*') ? 'active' : '' }}">
                        <i class="fas fa-clock-rotate-left text-sm"></i>
                        <span class="text-sm">Academic Timeline</span>
                    </a>
                    <a href="{{ route('admin.gallery.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
                        <i class="fas fa-images text-sm"></i>
                        <span class="text-sm">Photo Gallery</span>
                    </a>
                </div>

                <!-- System -->
                @if(Auth::guard('admin')->user()->role == 'super_admin')
                <div class="space-y-1">
                    <p class="px-4 pb-2 text-[10px] font-bold text-slate-500 uppercase tracking-[2px]">Infrastructure</p>
                    <a href="{{ route('admin.manage') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.manage') ? 'active' : '' }}">
                        <i class="fas fa-user-gear text-sm"></i>
                        <span class="text-sm">Staff Accounts</span>
                    </a>
                    <a href="{{ route('admin.students.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.students.*') ? 'active' : '' }}">
                        <i class="fas fa-graduation-cap text-sm"></i>
                        <span class="text-sm">Student Access</span>
                    </a>
                </div>
                @endif
            </nav>

            <!-- Bottom utility -->
            <div class="p-4 bg-black/20 border-t border-white/5">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-red-400/70 hover:text-red-400 hover:bg-red-400/5 rounded-xl transition-all">
                        <i class="fas fa-power-off text-sm"></i>
                        <span class="text-sm font-semibold">Terminate Session</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 md:ml-[var(--sidebar-width)] min-h-screen flex flex-col transition-all duration-300">
            <!-- Modern Header -->
            <header class="h-[var(--header-height)] border-b border-white/5 flex items-center justify-between px-6 md:px-10 bg-[var(--bg-master)]/80 backdrop-blur-md sticky top-0 z-40">
                <div class="flex items-center gap-6">
                    <button id="sidebar-toggle" class="md:hidden text-slate-400 hover:text-white p-2 transition">
                        <i class="fas fa-bars-staggered text-lg"></i>
                    </button>
                    <!-- Enhanced Breadcrumbs -->
                    <nav class="hidden sm:flex items-center text-[11px] font-semibold text-slate-500 uppercase tracking-widest gap-2">
                        <i class="fas fa-house text-[10px]"></i>
                        <span>Root</span>
                        <i class="fas fa-chevron-right text-[8px] opacity-40"></i>
                        <span class="text-white">@yield('title', 'Admin Dashboard')</span>
                    </nav>
                </div>
                
                <div class="flex items-center gap-8">
                    <!-- User Section -->
                    <div class="flex items-center gap-4 pl-8 border-l border-white/5">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-bold text-white tracking-tight leading-none">{{ Auth::guard('admin')->user()->username }}</p>
                            <span class="text-[9px] text-blue-400 font-black uppercase tracking-widest">
                                {{ Auth::guard('admin')->user()->role == 'super_admin' ? 'Master Root' : 'Sector Head' }}
                            </span>
                        </div>
                        <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center text-white ring-4 ring-blue-500/10 shadow-xl font-black">
                            {{ substr(Auth::guard('admin')->user()->username, 0, 1) }}
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="p-6 md:p-10 flex-1 overflow-x-hidden relative">
                <!-- Background decor -->
                <div class="absolute top-0 right-0 w-[50%] h-[30%] bg-blue-600/5 blur-[120px] -z-10 rounded-full"></div>
                
                @if(session('success'))
                    <div class="mb-8 p-4 bg-emerald-500/5 border border-emerald-500/20 text-emerald-400 rounded-2xl flex items-center gap-4 animate-fade-in-down shadow-lg shadow-emerald-500/5">
                        <div class="w-8 h-8 rounded-full bg-emerald-500/20 flex items-center justify-center">
                            <i class="fas fa-check text-xs"></i>
                        </div>
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 text-red-400 rounded-xl">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('mobile-overlay');
        const toggleBtn = document.getElementById('sidebar-toggle');
        const closeBtn = document.getElementById('sidebar-close');

        function toggleSidebar() {
            const isClosed = sidebar.classList.contains('-translate-x-full');
            if (isClosed) {
                // Open sidebar
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                setTimeout(() => overlay.classList.remove('opacity-0'), 10);
            } else {
                // Close sidebar
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('opacity-0');
                setTimeout(() => overlay.classList.add('hidden'), 300);
            }
        }

        toggleBtn.addEventListener('click', toggleSidebar);
        closeBtn.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);
    </script>
</body>
</html>
