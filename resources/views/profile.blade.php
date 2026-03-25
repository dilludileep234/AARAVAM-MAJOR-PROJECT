<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @include('partials.theme-system')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile | Aaravam</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #020617;
            --text-main: #ffffff;
            --text-dim: #9ca3af;
            --glass-bg: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.1);
            --accent-blue: #3b82f6;
            --border: rgba(255, 255, 255, 0.06);
            --social-bg: rgba(255, 255, 255, 0.05);
            --social-text: #9ca3af;
            --header-bg: rgba(2, 6, 23, 0.85);
            --card-hover: rgba(255, 255, 255, 0.07);
        }

        .light-theme {
            --bg-color: #f8fafc;
            --text-main: #0f172a;
            --text-dim: #475569;
            --glass-bg: rgba(255, 255, 255, 0.8);
            --glass-border: rgba(59, 130, 246, 0.2);
            --border: rgba(15, 23, 42, 0.08);
            --accent-blue: #2563eb;
            --social-bg: rgba(15, 23, 42, 0.05);
            --social-text: #475569;
            --header-bg: rgba(248, 250, 252, 0.9);
            --card-hover: rgba(59, 130, 246, 0.05);
        }

        body { 
            font-family: 'Inter', sans-serif; 
            background-color: var(--bg-color); 
            color: var(--text-main); 
            overflow-x: hidden; 
            transition: background-color 0.4s ease, color 0.4s ease;
        }
        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
        }
        .input-field {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            color: white;
            transition: all 0.3s ease;
        }
        .input-field:focus {
            border-color: var(--accent-blue);
            background: rgba(255, 255, 255, 0.08);
            outline: none;
        }
        .reveal { opacity: 0; }

        /* Profile Section Styles */
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

        /* Large Profile Image styles */
        .large-profile-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 4px solid var(--accent-blue);
            object-fit: cover;
            box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3);
        }
         .edit-btn {
            position: absolute; 
            bottom: 0; 
            right: 0; 
            background: var(--accent-blue); 
            border: none; 
            color: white; 
            width: 40px; 
            height: 40px; 
            border-radius: 50%; 
            cursor: pointer; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            transition: all 0.3s; 
            z-index: 10;
        }
        .edit-btn:hover {
            transform: scale(1.1);
        }



        .light-theme nav {
            background: rgba(248, 250, 252, 0.95) !important;
            border-color: rgba(15, 23, 42, 0.08) !important;
        }

        .light-theme .glass-card {
            background: #ffffff;
            border-color: rgba(15, 23, 42, 0.08);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .light-theme .input-field {
            background: #f1f5f9;
            border-color: #cbd5e1;
            color: #0f172a;
        }
        
        .light-theme .text-gray-400 {
            color: #475569;
        }

        .light-theme .profile-dropdown {
            background: #ffffff;
            border-color: #e2e8f0;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .light-theme .dropdown-item {
            color: #1e293b;
        }

        .light-theme .dynamic-text-muted {
            color: #475569;
        }
    </style>
</head>
<body>

    @include('partials.header')

    <section class="max-w-4xl mx-auto px-8 md:px-16 py-20">
        <div class="glass-card p-10 rounded-3xl reveal" data-anim="animate__fadeInUp">
            <div class="text-center mb-10">
                <h1 class="text-3xl font-bold mb-2">My Profile</h1>
                <p class="text-gray-400">Manage your personal details</p>
            </div>
            
            @if(session('success'))
                <div class="bg-green-600/20 border border-green-600/50 text-green-400 p-4 rounded-xl mb-6 text-center">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex flex-col items-center mb-10">
                <div class="relative">
                    <div style="width: 150px; height: 150px; border-radius: 50%; border: 4px solid var(--accent-blue); overflow: hidden; position: relative;" class="shadow-lg shadow-blue-600/20">
                         @if(Auth::user()->profile_image)
                            <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="Profile" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <div style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center; background: #1e293b;">
                                <i class="fas fa-user-circle" style="font-size: 90px; color: var(--accent-blue);"></i>
                            </div>
                        @endif
                    </div>
                    
                    <button onclick="document.getElementById('profile_image_input').click()" class="edit-btn">
                        <i class="fas fa-camera"></i>
                    </button>

                    <form id="profile_form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" style="display: none;">
                        @csrf
                        <input type="file" id="profile_image_input" name="profile_image" accept="image/*" onchange="document.getElementById('profile_form').submit()">
                    </form>
                </div>
                <h2 class="text-2xl font-bold mt-4">{{ Auth::user()->username }}</h2>
                <p class="text-blue-400">Student</p>
            </div>

            <div class="space-y-6 max-w-md mx-auto w-full">
                <div>
                    <label class="block text-sm text-gray-400 mb-2 text-center md:text-left">Username</label>
                    <div class="w-full p-4 rounded-xl input-field text-lg text-center md:text-left">
                        {{ Auth::user()->username }}
                    </div>
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-2 text-center md:text-left">Email Address</label>
                    <div class="w-full p-4 rounded-xl input-field text-lg text-center md:text-left">
                        {{ Auth::user()->email }}
                    </div>
                </div>
                 <div>
                    <label class="block text-sm text-gray-400 mb-2 text-center md:text-left">Member Since</label>
                    <div class="w-full p-4 rounded-xl input-field text-lg text-center md:text-left">
                        {{ Auth::user()->created_at->format('F d, Y') }}
                    </div>
                </div>
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
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const anim = entry.target.getAttribute('data-anim');
                    entry.target.classList.add('animate__animated', anim);
                    entry.target.style.opacity = '1';
                }
            });
        }, { threshold: 0.1 });
        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

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
