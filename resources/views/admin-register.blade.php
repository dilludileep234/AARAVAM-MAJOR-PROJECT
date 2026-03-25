<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clearance Request | Aaravam</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --accent: #3b82f6;
            --accent-glow: rgba(59, 130, 246, 0.4);
            --bg-dark: #020617;
        }
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: var(--bg-dark);
            color: #f8fafc;
        }
        .glass-terminal {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(24px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }
        .executive-input {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .executive-input:focus {
            background: rgba(255, 255, 255, 0.05);
            border-color: var(--accent);
            box-shadow: 0 0 20px -5px var(--accent-glow);
            outline: none;
        }
        .glow-overlay {
            position: absolute;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, var(--accent-glow) 0%, transparent 70%);
            filter: blur(100px);
            z-index: -1;
            opacity: 0.15;
            pointer-events: none;
        }
        .brand-gradient {
            background: linear-gradient(135deg, #fff 0%, #94a3b8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6 relative">
    <!-- Dynamic Background Decor -->
    <div class="glow-overlay top-[-20%] left-[-10%] animate-pulse"></div>
    <div class="glow-overlay bottom-[-20%] right-[-10%] animate-pulse" style="--accent-glow: rgba(99, 102, 241, 0.3);"></div>
    
    <div class="w-full max-w-[540px] relative z-10">
        <!-- Logo Header -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-white/5 border border-white/10 mb-6 backdrop-blur-xl shadow-2xl">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-tr from-blue-600 to-indigo-500 flex items-center justify-center shadow-lg shadow-blue-500/20">
                    <i class="fas fa-user-plus text-white text-xl"></i>
                </div>
            </div>
            <h1 class="text-4xl font-black tracking-[8px] brand-gradient uppercase mb-2">AARAVAM</h1>
            <p class="text-slate-500 text-xs font-bold uppercase tracking-[4px]">Personnel Enrollment Portal</p>
        </div>

        <!-- Enrollment Card -->
        <div class="glass-terminal rounded-[2.5rem] p-10 relative overflow-hidden">
            <!-- Top trim -->
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-blue-500/50 to-transparent"></div>

            <div class="mb-8">
                <h2 class="text-2xl font-black text-white tracking-tight">Category Admin Enrollment</h2>
                <p class="text-slate-400 text-sm mt-1">Submit your credentials for sector-specific clearance.</p>
            </div>

            @if ($errors->any())
            <div class="mb-6 p-4 bg-red-500/5 border border-red-500/20 text-red-400 rounded-2xl text-[11px] font-bold uppercase tracking-wider leading-relaxed">
                @foreach ($errors->all() as $error)
                    <div class="flex items-center gap-2">
                        <i class="fas fa-triangle-exclamation"></i>
                        <span>{{ $error }}</span>
                    </div>
                @endforeach
            </div>
            @endif

            <form action="{{ route('admin.register.post') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="form_type" value="register">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[2px] px-1">Access Identity</label>
                        <div class="relative group">
                            <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-500 group-focus-within:text-blue-500 transition-colors">
                                <i class="fas fa-user-gear text-sm"></i>
                            </span>
                            <input type="text" name="username" value="{{ old('username') }}" required 
                                   class="w-full executive-input rounded-2xl py-4 pl-14 pr-5 text-sm font-semibold tracking-tight placeholder:text-slate-700" 
                                   placeholder="Full Name">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[2px] px-1">Contact Link</label>
                        <div class="relative group">
                            <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-500 group-focus-within:text-blue-500 transition-colors">
                                <i class="fas fa-at text-sm"></i>
                            </span>
                            <input type="email" name="email" value="{{ old('email') }}" required 
                                   class="w-full executive-input rounded-2xl py-4 pl-14 pr-5 text-sm font-semibold tracking-tight placeholder:text-slate-700" 
                                   placeholder="Email">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[2px] px-1">Administrative Role</label>
                        <select name="role" id="role-select" onchange="toggleCategorySelect()" required
                                class="w-full executive-input rounded-2xl py-4 px-5 text-sm font-semibold tracking-tight appearance-none cursor-pointer text-slate-300">
                            <option value="super_admin">System Administrator</option>
                            <option value="category_admin" selected>Category Admin (Principal Ops)</option>
                            <option value="coordinator">Event Coordinator (Support)</option>
                        </select>
                    </div>

                    <div class="space-y-2" id="category-box">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[2px] px-1">Sector Assignment</label>
                        <select name="category_access" class="w-full executive-input rounded-2xl py-4 px-5 text-sm font-semibold tracking-tight appearance-none cursor-pointer text-slate-300">
                            <option value="Sports">Sports (Arena)</option>
                            <option value="Arts">Arts (Utsav)</option>
                            <option value="Algorithm">Tech (Algorythm)</option>
                            <option value="softskill">Soft Skills (Elevate)</option>
                            <option value="Cultural">Cultural Fest</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[2px] px-1">Security Passkey</label>
                    <div class="relative group">
                        <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-500 group-focus-within:text-blue-500 transition-colors">
                            <i class="fas fa-shield-halved text-sm"></i>
                        </span>
                        <input type="password" id="password" name="password" required 
                               class="w-full executive-input rounded-2xl py-4 pl-14 pr-12 text-sm font-semibold tracking-tight placeholder:text-slate-700" 
                               placeholder="••••••••••••">
                        <button type="button" onclick="togglePassword()" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 hover:text-white transition-colors focus:outline-none">
                            <i class="fas fa-eye-low-vision text-xs" id="eye-icon"></i>
                        </button>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-black py-4 rounded-2xl transition-all shadow-xl shadow-blue-900/40 active:scale-[0.98] uppercase text-xs tracking-[2px] flex items-center justify-center gap-3">
                        <span>Submit Authorization Request</span>
                        <i class="fas fa-paper-plane text-[10px]"></i>
                    </button>
                    <p class="mt-4 text-[9px] text-slate-600 font-bold uppercase tracking-[1px] text-center">
                        Enrollment is subject to manual verification by the System Admin.
                    </p>
                </div>
            </form>

            <div class="mt-10 pt-8 border-t border-white/5 text-center">
                <p class="text-slate-500 text-[10px] font-bold uppercase tracking-widest leading-relaxed">
                    Already authenticated? <br>
                    <a href="{{ route('admin') }}" class="text-white hover:text-blue-400 mt-2 inline-block transition">Back to Terminal &rarr;</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        function toggleCategorySelect() {
            const role = document.getElementById('role-select').value;
            const categoryBox = document.getElementById('category-box');
            if (role === 'category_admin' || role === 'coordinator') {
                categoryBox.style.display = 'block';
            } else {
                categoryBox.style.display = 'none';
            }
        }

        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye-low-vision');
                icon.classList.add('fa-eye');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-low-vision');
            }
        }
        
        // Run on load
        toggleCategorySelect();
    </script>
</body>
</html>
