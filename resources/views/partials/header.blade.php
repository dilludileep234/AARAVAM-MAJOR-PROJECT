@include('partials.theme-system')
<header class="flex items-center justify-between px-6 md:px-12 py-5 sticky top-0 z-50 backdrop-blur-md border-b border-white/5" style="background-color: var(--header-bg);">
    <div class="flex items-center gap-3">
        <div class="bg-blue-600 w-10 h-10 rounded-lg flex items-center justify-center font-bold shadow-lg shadow-blue-600/30 text-white">E</div>
        <span class="text-xl font-bold tracking-tighter uppercase">ആരവം</span>
    </div>

    <nav class="hidden md:flex gap-10 text-sm font-medium dynamic-text-muted">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-blue-500 border-b-2 border-blue-500 pb-1' : 'nav-link' }}">Home</a>
        <a href="{{ route('fests') }}" class="{{ request()->routeIs('fests') ? 'text-blue-500 border-b-2 border-blue-500 pb-1' : 'nav-link' }}">Fests</a>
        <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'text-blue-500 border-b-2 border-blue-500 pb-1' : 'nav-link' }}">About Us</a>
        <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'text-blue-500 border-b-2 border-blue-500 pb-1' : 'nav-link' }}">Contact</a>
    </nav>

    <div class="flex items-center gap-4">
        <button id="theme-toggle" class="w-10 h-10 rounded-full glass-card flex items-center justify-center text-blue-500 hover:scale-110 transition active:scale-95">
            <i class="fas fa-moon" id="theme-icon"></i>
        </button>

        @if(Auth::guard('admin')->check())
            @if(Auth::guard('admin')->user()->role === 'super_admin')
                <a href="{{ route('admin.dashboard') }}" class="bg-blue-600 hover:bg-blue-700 px-6 py-2.5 rounded-full text-sm font-semibold transition active:scale-95 shadow-lg shadow-blue-600/20 text-white flex items-center gap-2">
                    <i class="fas fa-user-shield"></i> Admin Panel
                </a>
            @else
                <a href="{{ route('category.dashboard') }}" class="bg-blue-600 hover:bg-blue-700 px-6 py-2.5 rounded-full text-sm font-semibold transition active:scale-95 shadow-lg shadow-blue-600/20 text-white flex items-center gap-2">
                    <i class="fas fa-user-shield"></i> Category Panel
                </a>
            @endif
        @elseif(Auth::check())
            <div class="profile-wrapper">
                <div class="profile-trigger" id="profileTrigger">
                    <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('images/default-avatar.png') }}" alt="User Profile">
                </div>
                <div class="profile-dropdown" id="profileDropdown">
                    <div class="px-4 py-2 border-b border-white/10 mb-2">
                        <p class="text-sm font-bold text-white">{{ Auth::user()->username }}</p>
                        <p class="text-xs text-gray-400">{{ Auth::user()->email }}</p>
                    </div>
                    <a href="{{ route('profile') }}" class="dropdown-item"><i class="fas fa-user-circle"></i> My Profile</a>
                    <a href="{{ route('portal') }}" class="dropdown-item"><i class="fas fa-cog"></i> Dashboard</a>
                    <a href="#" class="dropdown-item"><i class="fas fa-calendar-alt"></i> My Events</a>
                    <div class="dropdown-divider"></div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item text-red-500 hover:bg-red-500/10">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>
        @else
            <a href="{{ route('role.selection') }}" class="bg-blue-600 hover:bg-blue-700 px-6 py-2.5 rounded-full text-sm font-semibold transition active:scale-95 shadow-lg shadow-blue-600/20 text-white">
                Login / Signup
            </a>
        @endif
    </div>
</header>
