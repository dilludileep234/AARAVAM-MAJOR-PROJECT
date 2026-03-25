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
        body { font-family: 'Inter', sans-serif; background-color: #020617; }
        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 1.5rem;
        }
        .sidebar-link {
            transition: all 0.3s;
            border-radius: 0.75rem;
        }
        .sidebar-link:hover, .sidebar-link.active {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }
    </style>
</head>
<body class="text-slate-200 bg-[#020617]">
    <!-- Mobile Overlay -->
    <div id="mobile-overlay" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden transition-opacity opacity-0"></div>

    <div class="flex min-h-screen relative">
        <!-- Sidebar -->
        <aside id="sidebar" class="w-72 bg-[#01040a] border-r border-white/5 p-6 flex flex-col fixed inset-y-0 left-0 z-50 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out font-sans">
            <div class="flex items-center justify-between mb-12 px-2">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-cyan-500 to-blue-600 flex items-center justify-center shadow-lg shadow-cyan-500/20">
                        <i class="fas fa-users-cog text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-black text-white tracking-tighter leading-none">AARAVAM</h1>
                        <p class="text-[10px] text-cyan-400 font-bold uppercase tracking-widest mt-1">Category Ops</p>
                    </div>
                </div>
                <!-- Mobile Close Button -->
                <button id="sidebar-close" class="md:hidden text-slate-400 hover:text-white transition">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto custom-scrollbar">
                <div class="px-4 pb-2 text-[10px] font-bold text-slate-500 uppercase tracking-widest">Command Center</div>
                
                <a href="{{ route('category.dashboard') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 {{ request()->routeIs('category.dashboard') ? 'active text-cyan-500 bg-cyan-500/10' : 'text-slate-400 hover:text-slate-200' }}">
                    <i class="fas fa-terminal w-5 text-center"></i>
                    <span class="font-medium">Operations Overview</span>
                </a>

                <div class="px-4 pt-4 pb-2 text-[10px] font-bold text-slate-500 uppercase tracking-widest">Sector Assets</div>

                @php
                    $user = Auth::guard('admin')->user();
                @endphp

                <a href="{{ route('admin.events.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.events.*') ? 'active text-cyan-500 bg-cyan-500/10' : 'text-slate-400 hover:text-slate-200' }}">
                    <i class="fas fa-layer-group w-5 text-center"></i>
                    <span class="font-medium">Event Protocols</span>
                </a>

                <a href="{{ route('admin.registrations.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.registrations.*') ? 'active text-cyan-500 bg-cyan-500/10' : 'text-slate-400 hover:text-slate-200' }}">
                    <i class="fas fa-clipboard-list w-5 text-center"></i>
                    <span class="font-medium">Personnel Audit</span>
                </a>

                <a href="{{ route('admin.results.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.results.*') ? 'active text-cyan-500 bg-cyan-500/10' : 'text-slate-400 hover:text-slate-200' }}">
                    <i class="fas fa-trophy w-5 text-center"></i>
                    <span class="font-medium">Result Protocols</span>
                </a>

                <a href="{{ route('admin.gallery.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.gallery.*') ? 'active text-cyan-500 bg-cyan-500/10' : 'text-slate-400 hover:text-slate-200' }}">
                    <i class="fas fa-images w-5 text-center"></i>
                    <span class="font-medium">Gallery Assets</span>
                </a>



            </nav>

            <div class="pt-6 border-t border-white/5">
                <form action="{{ route('category.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-red-400 hover:bg-red-500/10 hover:text-red-300 rounded-xl transition group">
                        <i class="fas fa-power-off w-5 text-center group-hover:scale-110 transition-transform"></i>
                        <span class="font-medium">Terminate Session</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 md:ml-72 min-h-screen flex flex-col transition-all duration-300">
            <header class="h-20 border-b border-white/5 flex items-center justify-between px-4 md:px-8 bg-[#020617]/80 backdrop-blur-md sticky top-0 z-40">
                <div class="flex items-center gap-4">
                    <button id="sidebar-toggle" class="md:hidden text-slate-400 hover:text-white p-2 transition">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <div class="text-sm text-slate-400 hidden sm:block">
                        Sector Control <i class="fas fa-chevron-right text-[10px] mx-2"></i> 
                        <span class="text-white font-medium">@yield('title', 'Dashboard')</span>
                    </div>
                </div>
                
                <div class="flex items-center gap-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-bold text-white uppercase tracking-tight">{{ Auth::guard('admin')->user()->username }}</p>
                        <p class="text-[10px] text-slate-500 uppercase font-black tracking-tighter">
                            {{ Auth::guard('admin')->user()->role == 'super_admin' ? 'System Administrator' : Auth::guard('admin')->user()->category_access . ' Supervisor' }}
                        </p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-cyan-600/20 border border-cyan-500/30 flex items-center justify-center text-cyan-400 font-bold">
                        {{ substr(Auth::guard('admin')->user()->username, 0, 1) }}
                    </div>
                </div>
            </header>

            <div class="p-4 md:p-8 flex-1 overflow-x-hidden">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-xl flex items-center gap-3 animate-fade-in-down">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
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
