<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Protocol | Aaravam</title>
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
            overflow: hidden;
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
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, var(--accent-glow) 0%, transparent 70%);
            filter: blur(80px);
            z-index: -1;
            opacity: 0.2;
            pointer-events: none;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6 relative">
    <!-- Dynamic Background Decor -->
    <div class="glow-overlay top-[-10%] left-[-10%] animate-pulse"></div>
    <div class="glow-overlay bottom-[-10%] right-[-10%] animate-pulse" style="--accent-glow: rgba(99, 102, 241, 0.3);"></div>
    
    <div class="w-full max-w-[440px] relative z-10">
        <!-- Auth Card -->
        <div class="glass-terminal rounded-[2.5rem] p-10 relative overflow-hidden">
            <!-- Top trim -->
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-blue-500/50 to-transparent"></div>

            <div class="mb-8">
                <h2 class="text-2xl font-black text-white tracking-tight">Access Restoration</h2>
                <p class="text-slate-400 text-sm mt-1">Configure high-strength security credentials.</p>
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

            <form action="{{ route('admin.reset-password.post') }}" method="POST" class="space-y-6">
                @csrf
                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[2px] px-1">New System Passkey</label>
                    <div class="relative group">
                        <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-500 group-focus-within:text-blue-500 transition-colors">
                            <i class="fas fa-shield-halved text-sm"></i>
                        </span>
                        <input type="password" name="password" id="password" required 
                               class="w-full executive-input rounded-2xl py-4 pl-14 pr-12 text-sm font-semibold tracking-tight placeholder:text-slate-700" 
                               placeholder="••••••••••••">
                        <button type="button" onclick="togglePassword('password', 'toggleIcon1')" class="absolute right-5 top-1/2 -translate-y-1/2 text-slate-500 hover:text-white transition-colors focus:outline-none">
                            <i class="fas fa-eye-low-vision text-xs" id="toggleIcon1"></i>
                        </button>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[2px] px-1">Validate Integrity</label>
                    <div class="relative group">
                        <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-500 group-focus-within:text-blue-500 transition-colors">
                            <i class="fas fa-shield-check text-sm"></i>
                        </span>
                        <input type="password" name="password_confirmation" id="password_confirmation" required 
                               class="w-full executive-input rounded-2xl py-4 pl-14 pr-12 text-sm font-semibold tracking-tight placeholder:text-slate-700" 
                               placeholder="••••••••••••">
                        <button type="button" onclick="togglePassword('password_confirmation', 'toggleIcon2')" class="absolute right-5 top-1/2 -translate-y-1/2 text-slate-500 hover:text-white transition-colors focus:outline-none">
                            <i class="fas fa-eye-low-vision text-xs" id="toggleIcon2"></i>
                        </button>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-black py-4 rounded-2xl transition-all shadow-xl shadow-blue-900/40 active:scale-[0.98] uppercase text-xs tracking-[2px] flex items-center justify-center gap-3">
                        <span>Commit Credential Change</span>
                        <i class="fas fa-key text-[10px]"></i>
                    </button>
                </div>
            </form>
        </div>

        <!-- Footer Meta -->
        <div class="mt-8 text-center">
            <p class="text-slate-800 text-[9px] font-bold uppercase tracking-[1px]">
                Ensure your new credentials follow the institutional security protocol for high-privilege accounts.
            </p>
        </div>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            
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
    </script>
</body>
</html>
