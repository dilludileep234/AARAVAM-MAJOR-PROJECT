<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | ആരവം</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap');

        /* Theme Variables */
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

        /* Helper Classes for Theme Variables */
        .dynamic-text-muted {
            color: var(--text-muted);
        }

        .dynamic-glass {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
        }

        /* Glassmorphism Effect */
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

        /* Scroll Animations */
        .reveal {
            opacity: 0;
            filter: blur(5px);
            transition: all 1s ease-out;
        }

        .reveal-left {
            transform: translateX(-80px);
        }

        .reveal-right {
            transform: translateX(80px);
        }

        .reveal-up {
            transform: translateY(50px);
        }

        .active {
            opacity: 1;
            filter: blur(0);
            transform: translate(0, 0);
        }

        /* Mouse Follow Glow */
        #bg-glow {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 50% 50%, rgba(30, 58, 138, 0.2) 0%, transparent 70%);
            z-index: -1;
            pointer-events: none;
            transition: transform 0.2s ease-out;
        }

        /* Nav Link Hover */
        .nav-link {
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: var(--accent-blue);
        }

        /* Hamburger Menu Styles */
        .drawer-list {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 100vw;
            transform: translate(-100vw, 0);
            -ms-transform: translatex(-100vw);
            box-sizing: border-box;
            pointer-events: none;
            padding-top: 125px;
            transition: width 475ms ease-out, transform 450ms ease, border-radius 0.8s 0.1s ease;
            border-bottom-right-radius: 100vw;
            background: transparent;
            backdrop-filter: blur(10px);
            z-index: 100;
            margin-right: -50px;
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
            padding: 0;
            overflow: auto;
            overflow-x: hidden;
            pointer-events: auto;
        }

        .drawer-list li {
            list-style: none;
            text-transform: uppercase;
            pointer-events: auto;
            white-space: nowrap;
            box-sizing: border-box;
            transform: translatex(-100vw);
            -ms-transform: translatex(-100vw);
        }

        .drawer-list li:last-child {
            margin-bottom: 2em;
        }

        .drawer-list li a {
            text-decoration: none;
            color: #FEFEFE;
            text-align: center;
            display: block;
            padding: 1rem;
            font-size: calc(24px - .5vw);
        }

        @media (min-width: 768px) {
            .drawer-list li a {
                text-align: left;
                padding: 0.5rem;
                padding-left: 2rem;
            }
        }

        .drawer-list li a:hover {
            cursor: pointer;
            color: var(--accent-blue);
            background-color: var(--glass-bg);
            padding-left: 2rem;
        }

        .drawer-list li a i {
            margin-right: 15px;
            width: 25px;
            text-align: center;
            color: var(--accent-blue);
            font-size: 1.2rem;
        }

        input.hamburger {
            display: none;
        }

        input.hamburger:checked~.drawer-list {
            transform: translatex(0);
            border-bottom-right-radius: 0;
        }

        input.hamburger:checked~.drawer-list li {
            transform: translatex(0);
        }

        input.hamburger:checked~.drawer-list li:nth-child(1) {
            transition: transform 1s 0.08s cubic-bezier(0.29, 1.4, 0.44, 0.96);
        }

        input.hamburger:checked~.drawer-list li:nth-child(2) {
            transition: transform 1s 0.16s cubic-bezier(0.29, 1.4, 0.44, 0.96);
        }

        input.hamburger:checked~.drawer-list li:nth-child(3) {
            transition: transform 1s 0.24s cubic-bezier(0.29, 1.4, 0.44, 0.96);
        }

        input.hamburger:checked~.drawer-list li:nth-child(4) {
            transition: transform 1s 0.32s cubic-bezier(0.29, 1.4, 0.44, 0.96);
        }

        input.hamburger:checked~.drawer-list li:nth-child(5) {
            transition: transform 1s 0.40s cubic-bezier(0.29, 1.4, 0.44, 0.96);
        }

        input.hamburger:checked~label>i {
            background-color: transparent;
            transform: rotate(90deg);
        }

        input.hamburger:checked~label>i:before {
            transform: translate(-50%, -50%) rotate(45deg);
        }

        input.hamburger:checked~label>i:after {
            transform: translate(-50%, -50%) rotate(-45deg);
        }

        input.hamburger:checked~label close {
            color: var(--text-main);
            width: 60px;
        }

        input.hamburger:checked~label open {
            color: rgba(0, 0, 0, 0);
            width: 0;
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
            flex-shrink: 0;
        }

        label.hamburger text close,
        label.hamburger text open {
            text-transform: uppercase;
            font-size: 0.8em;
            position: absolute;
            transform: translateY(30px);
            text-align: center;
            width: 60px;
            left: -15px;
            overflow: hidden;
            transition: width 0.25s 0.35s, color 0.45s 0.35s;
        }

        label.hamburger text close {
            color: rgba(0, 0, 0, 0);
            left: -15px;
            width: 0;
        }

        label.hamburger text open {
            color: var(--text-main);
            width: 60px;
        }

        label.hamburger>i {
            position: absolute;
            width: 100%;
            height: 2px;
            top: 50%;
            background-color: var(--text-main);
            pointer-events: auto;
            transition-duration: 0.35s;
            transition-delay: 0.35s;
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
            transition: transform 0.35s;
            transform-origin: 50% 50%;
        }

        label.hamburger:hover>i,
        label.hamburger:hover>i:before,
        label.hamburger:hover>i:after {
            background-color: var(--accent-blue);
        }

        label.hamburger>i:before {
            transform: translate(-50%, -8px);
        }

        label.hamburger>i:after {
            transform: translate(-50%, 8px);
        }

        header .flex.items-center.gap-3 {
            display: flex;
            align-items: center;
            padding-left: 45px;
        }

        /* Profile section */
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

        /* Page Specific Styles */
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
    </style>
</head>
<body>
    <div id="bg-glow"></div>

    @include("partials.header")

    <section class="text-center py-16 px-4 animate__animated animate__fadeIn">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Get in Touch</h1>
            Have questions about events or ആരവം? We're here to help! Reach out to us and we'll get back to you as soon as possible.
    </section>

    <section class="max-w-7xl mx-auto px-8 md:px-16 grid lg:grid-cols-3 gap-8 pb-20">
        
        <div class="lg:col-span-1 space-y-4">
            <div class="glass-card p-6 rounded-2xl flex items-start space-x-4 reveal" data-anim="animate__fadeInLeft">
                <div class="text-blue-500 text-xl mt-1">📍</div>
                <div>
                    <h4 class="font-bold mb-1">Address</h4>
                    <p class="text-sm text-gray-400">Government Polytechnic College Muttom,<br>Idukki, Kerala - 685587, India</p>
                </div>
            </div>
            <div class="glass-card p-6 rounded-2xl flex items-start space-x-4 reveal" data-anim="animate__fadeInLeft">
                <div class="text-blue-500 text-xl mt-1">📞</div>
                <div>
                    <h4 class="font-bold mb-1">Phone</h4>
                    <p class="text-sm text-gray-400">+91 4862 255 310</p>
                </div>
            </div>
            <div class="glass-card p-6 rounded-2xl flex items-start space-x-4 reveal" data-anim="animate__fadeInLeft">
                <div class="text-blue-500 text-xl mt-1">📧</div>
                <div>
                    <h4 class="font-bold mb-1">Email</h4>
                    <p class="text-sm text-gray-400">aaravam@gptcmuttom.ac.in</p>
                </div>
            </div>
            <div class="glass-card p-6 rounded-2xl flex items-start space-x-4 reveal" data-anim="animate__fadeInLeft">
                <div class="text-blue-500 text-xl mt-1">⏰</div>
                <div>
                    <h4 class="font-bold mb-1">Office Hours</h4>
                    <p class="text-sm text-gray-400">Monday - Friday: 9:00 AM - 4:00 PM<br>Saturday: 9:00 AM - 1:00 PM</p>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 glass-card p-8 md:p-10 rounded-3xl reveal" data-anim="animate__fadeInRight">
            <h3 class="text-2xl font-bold mb-6">Send us a Message</h3>
            
            @if(session('success'))
                <div class="bg-green-600/20 border border-green-600/50 text-green-400 p-4 rounded-xl mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-600/20 border border-red-600/50 text-red-400 p-4 rounded-xl mb-6">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="space-y-6" method="POST" action="{{ route('contact.submit') }}">
                @csrf
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm text-gray-400 mb-2">Your Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Name" class="w-full p-3 rounded-xl input-field" required>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-400 mb-2">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" class="w-full p-3 rounded-xl input-field" required>
                    </div>
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-2">Subject</label>
                    <input type="text" name="subject" value="{{ old('subject') }}" placeholder="subject" class="w-full p-3 rounded-xl input-field" required>
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-2">Message</label>
                    <textarea name="message" rows="4" placeholder="Tell us how we can help you..." class="w-full p-3 rounded-xl input-field" required>{{ old('message') }}</textarea>
                </div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 w-full py-4 rounded-xl font-bold flex items-center justify-center space-x-2 transition-all">
                    <span>🚀</span>
                    <span>Send Message</span>
                </button>
            </form>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-8 md:px-16 mb-20 reveal" data-anim="animate__fadeInUp">
        <h2 class="text-3xl font-bold mb-8 text-center">here to connect</h2>
        <div class="glass-card w-full h-96 rounded-3xl relative overflow-hidden group">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3931.0821205095504!2d76.73539007465551!3d9.843470090254083!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b07c674407e1329%3A0xe7920dbab7c9883b!2sGovernment%20Polytechnic%20College%2C%20Muttom!5e0!3m2!1sen!2sin!4v1770786985943!5m2!1sen!2sin" 
                width="100%" 
                height="100%" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade"
                class="grayscale opacity-50 contrast-125 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-700">
            </iframe>
            <div class="absolute bottom-6 left-6 glass-card px-6 py-4 rounded-2xl pointer-events-none group-hover:opacity-0 transition-opacity">
                <h3 class="font-bold text-lg">GPTC Muttom</h3>
                <p class="text-xs text-gray-400">Thodupuzha, Idukki</p>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-8 md:px-16 py-20 border-t border-white/5">
        <div class="text-center mb-12 reveal" data-anim="animate__fadeInUp">
            <h2 class="text-3xl font-bold mb-2">Quick Questions</h2>
            <p class="text-gray-500">Common questions about ആരവം</p>
        </div>
        <div class="grid md:grid-cols-2 gap-8">
            <div class="glass-card p-6 rounded-2xl reveal" data-anim="animate__fadeInUp">
                <h4 class="font-bold mb-2">How do I register for a fest event?</h4>
                <p class="text-sm text-gray-400">Navigate to the 'Fests' page, select your desired festival, and click 'Register Now' to view the specific events and registration forms.</p>
            </div>
            <div class="glass-card p-6 rounded-2xl reveal" data-anim="animate__fadeInUp" style="animation-delay: 0.1s">
                <h4 class="font-bold mb-2">Are fests free to attend?</h4>
                <p class="text-sm text-gray-400">Many events within our fests are free for GPTC Muttom students. However, certain flagship competitions may have a registration fee.</p>
            </div>
            <div class="glass-card p-6 rounded-2xl reveal" data-anim="animate__fadeInUp" style="animation-delay: 0.2s">
                <h4 class="font-bold mb-2">Can I participate in multiple fests?</h4>
                <p class="text-sm text-gray-400">Yes! Students are encouraged to participate across technical, arts, and sports festivals to showcase their diverse talents.</p>
            </div>
            <div class="glass-card p-6 rounded-2xl reveal" data-anim="animate__fadeInUp" style="animation-delay: 0.3s">
                <h4 class="font-bold mb-2">Where can I find the fest schedule?</h4>
                <p class="text-sm text-gray-400">Full schedules and activity point details are available on the 'Fests' page. Click 'View List' on any festival to see the complete timetable.</p>
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
        // --- Scroll Animation Logic ---
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                   entry.target.classList.add('active');
                   // Also trigger animate.css animations if present
                   const anim = entry.target.getAttribute('data-anim');
                   if (anim) {
                       entry.target.classList.add('animate__animated', anim);
                       entry.target.style.opacity = '1';
                   }
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.reveal').forEach((el) => observer.observe(el));

        // --- Parallax Mouse Glow ---
        const glow = document.getElementById('bg-glow');
        if (glow) {
            document.addEventListener('mousemove', (e) => {
                const x = (e.clientX / window.innerWidth - 0.5) * 60;
                const y = (e.clientY / window.innerHeight - 0.5) * 60;
                glow.style.transform = `translate(${x}px, ${y}px)`;
                glow.style.background = `radial-gradient(circle at ${e.clientX}px ${e.clientY}px, rgba(59, 130, 246, 0.15) 0%, transparent 70%)`;
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
