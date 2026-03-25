<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Aaravam - GPTC Muttom</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
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
            --social-bg: rgba(255, 255, 255, 0.05);
            --social-text: #9ca3af;
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
            --social-bg: rgba(15, 23, 42, 0.05);
            --social-text: #475569;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-main);
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            transition: background-color 0.4s ease, color 0.4s ease;
            scroll-behavior: smooth;
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

        /* Reveal Animation */
        .reveal {
            opacity: 0;
            filter: blur(5px);
            transition: all 1s ease-out;
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

        .nav-link {
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: var(--accent-blue);
        }

        /* Profile Section */
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

        /* Animated Gallery Styles */
        .gallery-container {
            width: 90%;
            max-width: 1000px;
            height: 400px;
            display: flex;
            justify-content: center;
            align-items: stretch;
            gap: 1.25rem;
            transition: all 400ms;
            margin: 0 auto;
        }

        .gallery-card {
            flex: 1;
            height: 100%;
            transition: all 400ms cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            border-radius: 1.5rem;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background-color: rgba(255, 255, 255, 0.03);
            position: relative;
            perspective: 1000px;
        }

        .gallery-card>img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 600ms cubic-bezier(0.4, 0, 0.2, 1);
            transform-origin: top;
        }

        .gallery-card:hover>img {
            transform: scale(1.02);
        }

        .gallery-card:nth-child(odd) {
            transform: translateY(-20px);
        }

        .gallery-card:nth-child(even) {
            transform: translateY(20px);
        }

        .gallery-container:hover .gallery-card:not(:hover) {
            filter: grayscale(100%);
            opacity: 0.4;
        }

        .card-hover-label {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 0.8rem 1.6rem;
            border-radius: 1rem;
            color: white;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.3em;
            font-size: 0.7rem;
            pointer-events: none;
            opacity: 0;
            transition: all 500ms cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 20;
            white-space: nowrap;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        .gallery-card:hover .card-hover-label,
        .gallery-card.locked .card-hover-label {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1.1);
        }

        .gallery-card:hover,
        .gallery-card.locked {
            flex: 2;
            border-color: #60a5fa;
            box-shadow: 0 25px 50px -12px rgba(59, 130, 246, 0.5);
        }

        .gallery-card.locked img {
            transform: rotateX(15deg) scale(1.05);
        }

        /* New Category Details Shelf Styles */
        #category-details-shelf {
            max-width: 80rem;
            margin: 0 auto;
            padding: 0 2rem;
            overflow: hidden;
            transition: all 600ms cubic-bezier(0.4, 0, 0.2, 1);
            opacity: 0;
            max-height: 0;
            margin-bottom: 2rem;
        }

        #category-details-shelf.active {
            opacity: 1;
            max-height: 5000px;
            margin-bottom: 8rem;
        }

        .shelf-content {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border-radius: 4rem;
            padding: 6rem 5rem;
            display: none;
            flex-direction: column;
            gap: 4rem;
        }

        .shelf-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 6rem;
            margin-bottom: 6rem;
            align-items: center;
        }

        .feature-image-container {
            width: 80%;
            margin: 0 auto;
            aspect-ratio: 4 / 5;
            border-radius: 2.5rem;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.6);
        }

        .feature-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 1s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .feature-image-container:hover img {
            transform: scale(1.03);
        }

        .shelf-gallery {
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            grid-auto-flow: dense;
            gap: 1.25rem;
            margin-top: 4rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 4rem 0;
        }

        .shelf-gallery-item {
            width: 100%;
            border-radius: 0;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.05);
            background: rgba(255, 255, 255, 0.05);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .shelf-gallery-item:nth-child(1) { grid-column: span 4; aspect-ratio: 4 / 3; }
        .shelf-gallery-item:nth-child(2) { grid-column: span 2; aspect-ratio: 9 / 16; }
        .shelf-gallery-item:nth-child(3) { grid-column: span 2; aspect-ratio: 1 / 1; }
        .shelf-gallery-item:nth-child(4) { grid-column: span 2; aspect-ratio: 4 / 5; }
        .shelf-gallery-item:nth-child(5) { grid-column: span 3; aspect-ratio: 1 / 1; }
        .shelf-gallery-item:nth-child(6) { grid-column: span 3; aspect-ratio: 4 / 3; }
        .shelf-gallery-item:nth-child(7) { grid-column: span 2; aspect-ratio: 4 / 5; }
        .shelf-gallery-item:nth-child(8) { grid-column: span 2; aspect-ratio: 1 / 1; }
        .shelf-gallery-item:nth-child(9) { grid-column: span 3; aspect-ratio: 4 / 3; }
        .shelf-gallery-item:nth-child(10) { grid-column: span 2; aspect-ratio: 4 / 5; }

        .shelf-gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s ease;
        }

        .shelf-gallery-item:hover {
            z-index: 10;
            transform: scale(1.01);
            border-color: rgba(96, 165, 250, 0.5);
            box-shadow: 0 30px 60px -20px rgba(0, 0, 0, 0.8);
        }

        .shelf-gallery-item:hover img {
            transform: scale(1.01);
        }

        .shelf-story-text {
            font-size: 1.125rem;
            line-height: 1.8;
            color: var(--text-muted);
            margin-bottom: 2rem;
        }

        .shelf-content.active {
            display: flex;
            animation: shelfFadeSlide 800ms cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        @keyframes shelfFadeSlide {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .shelf-category-label {
            display: inline-block;
            padding: 0.5rem 1rem;
            background: rgba(59, 130, 246, 0.1);
            border: 1px solid rgba(59, 130, 246, 0.2);
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 700;
            color: #60a5fa;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 1.5rem;
        }

        .shelf-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--text-main);
            line-height: 1.2;
            margin-bottom: 1rem;
        }

        .shelf-achievements {
            list-style: none;
            padding: 0;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .achievement-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: var(--text-muted);
            font-size: 1rem;
        }

        .achievement-icon {
            color: #60a5fa;
            font-size: 1.25rem;
        }

        /* Vision & Mission Styles */
        .glass-info-card {
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            padding: 3.5rem;
            border-radius: 2.5rem;
            position: relative;
            overflow: hidden;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .glass-info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at top right, rgba(59, 130, 246, 0.05), transparent);
            pointer-events: none;
        }

        .glass-info-card:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.04);
            border-color: rgba(59, 130, 246, 0.2);
            box-shadow: 0 40px 80px -20px rgba(0, 0, 0, 0.6);
        }

        .info-card-icon {
            width: 3.5rem;
            height: 3.5rem;
            background: rgba(59, 130, 246, 0.1);
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
            font-size: 1.5rem;
            color: #60a5fa;
            border: 1px solid rgba(59, 130, 246, 0.2);
            transition: all 0.3s ease;
        }

        .glass-info-card:hover .info-card-icon {
            background: #2563eb;
            color: white;
            transform: rotate(-10deg) scale(1.1);
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.3);
        }

        /* Compact Refined Glass for Vision/Mission */
        .glass-compact-refined {
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .glass-compact-refined:hover {
            transform: translateY(-8px);
            background: rgba(255, 255, 255, 0.04);
            border-color: rgba(59, 130, 246, 0.2);
            box-shadow: 0 30px 60px -15px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>

<body>
    <div id="bg-glow"></div>

    @include("partials.header")

    <section class="text-center pt-12 pb-12 px-4 animate__animated animate__fadeIn">
        <h1 class="text-4xl md:text-6xl font-extrabold mb-6 tracking-tight">About ആരവം</h1>
        <p class="max-w-3xl mx-auto dynamic-text-muted text-lg leading-relaxed">
            ആരവം is GPTC Muttom's comprehensive platform for student engagement, connecting over 5000 students with clubs,
            societies, and campus events.
        </p>
    </section>

    <!-- Animated Gallery Section -->
    <section class="max-w-7xl mx-auto px-8 md:px-16 py-12 mb-4 reveal" data-anim="animate__fadeIn">
        <div class="gallery-container">
            <div class="gallery-card" onclick="toggleLock('arts')" onmouseenter="showDetails('arts')"
                onmouseleave="hideDetails()">
                <img src="https://i.pinimg.com/1200x/61/ed/56/61ed5637e9418f0f2d4def9a5fcc6df0.jpg" alt="Arts">
                <div class="card-hover-label">utsav</div>
            </div>
            <div class="gallery-card" onclick="toggleLock('sports')" onmouseenter="showDetails('sports')"
                onmouseleave="hideDetails()">
                <img src="https://i.pinimg.com/736x/13/10/25/1310252211a165162a01e172d3728525.jpg" alt="Sports">
                <div class="card-hover-label">arena</div>
            </div>
            <div class="gallery-card" onclick="toggleLock('tech')" onmouseenter="showDetails('tech')"
                onmouseleave="hideDetails()">
                <img src="https://i.pinimg.com/1200x/01/c2/d0/01c2d09a8e6cabb09d7817d709727b9b.jpg" alt="Tech Fest">
                <div class="card-hover-label">algorythm</div>
            </div>
            <div class="gallery-card" onclick="toggleLock('cultural')" onmouseenter="showDetails('cultural')"
                onmouseleave="hideDetails()">
                <img src="https://i.pinimg.com/736x/97/87/02/978702d1aec58d68adbb81950f8c03ff.jpg"
                    alt="Kerala Cultural Festival">
                <div class="card-hover-label">cultural</div>
            </div>
            <div class="gallery-card" onclick="toggleLock('elevate')" onmouseenter="showDetails('elevate')"
                onmouseleave="hideDetails()">
                <img src="{{ asset('images/about/elevate_main.png') }}" alt="Elevate">
                <div class="card-hover-label">elevate</div>
            </div>
        </div>
    </section>


    <!-- Dynamic Category Details Shelf -->
    <div id="category-details-shelf">
        <!-- Arts Content -->
        <div id="details-arts" class="shelf-content">
            <div class="shelf-row">
                <div class="feature-image-container">
                    <img src="https://images.unsplash.com/photo-1513364776144-60967b0f800f?auto=format&fit=crop&q=80&w=1000"
                        alt="Arts Legacy">
                </div>
                <div>
                    <span class="shelf-category-label">The Foundation</span>
                    <h4 class="shelf-title">Artistic Legacy</h4>
                    <p class="shelf-story-text">The Fine Arts Academy at GPTC Muttom is not just a department, but a sanctuary
                        for creative souls. Our legacy spans decades of nurturing artists who have gone on to redefine
                        visual storytelling across India.</p>
                </div>
            </div>
            <div class="shelf-row">
                <div>
                    <span class="shelf-category-label">Global Impact</span>
                    <h4 class="shelf-title">Creative Victories</h4>
                    <div class="grid grid-cols-2 gap-8 mt-6">
                        <ul class="shelf-achievements space-y-4 text-sm">
                            <li class="achievement-item"><span class="achievement-icon">🏆</span> National Painting Gold
                            </li>
                            <li class="achievement-item"><span class="achievement-icon">🎨</span> 'Chitra' Fest Best
                                College</li>
                        </ul>
                        <ul class="shelf-achievements space-y-4 text-sm">
                            <li class="achievement-item"><span class="achievement-icon">🌟</span> Global Studio Alumni
                            </li>
                            <li class="achievement-item"><span class="achievement-icon">📸</span> Photography Excellence
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="feature-image-container">
                    <img src="https://images.unsplash.com/photo-1547826039-bfc35e0f1ea8?auto=format&fit=crop&q=80&w=1000"
                        alt="Arts Modern">
                </div>
            </div>
            <div class="shelf-row">
                <div class="feature-image-container">
                    <img src="https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?auto=format&fit=crop&q=80&w=1000"
                        alt="Arts Workshop">
                </div>
                <div>
                    <span class="shelf-category-label">Future Visions</span>
                    <h4 class="shelf-title">Avenue of Creation</h4>
                    <p class="shelf-story-text">We are expanding our horizons with new digital art labs and
                        international artist residencies. Our mission is to blend traditional Indian aesthetics with
                        modern technological tools.</p>
                </div>
            </div>
            <!-- Bottom Gallery: 10 Photos -->
            <div class="shelf-gallery">
                @if(isset($galleries['arts']) && count($galleries['arts']) > 0)
                    @foreach($galleries['arts'] as $image)
                        <div class="shelf-gallery-item">
                            <img src="{{ $image->url }}" alt="Arts">
                        </div>
                    @endforeach
                @else
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?auto=format&fit=crop&q=80&w=800"
                            alt="Arts 1"></div>
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1541963463532-d68292c34b19?auto=format&fit=crop&q=80&w=800"
                            alt="Arts 2"></div>
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1460661419201-fd4cecdf8a8b?auto=format&fit=crop&q=80&w=800"
                            alt="Arts 3"></div>
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1513364776144-60967b0f800f?auto=format&fit=crop&q=80&w=800"
                            alt="Arts 4"></div>
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1547826039-bfc35e0f1ea8?auto=format&fit=crop&q=80&w=800"
                            alt="Arts 5"></div>
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1579762715118-a6f1d4b934f1?auto=format&fit=crop&q=80&w=800"
                            alt="Arts 6"></div>
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1525909002-1b05e0c869d8?auto=format&fit=crop&q=80&w=800"
                            alt="Arts 7"></div>
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1545639140-5e6490656a42?auto=format&fit=crop&q=80&w=800"
                            alt="Arts 8"></div>
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1515405295579-ba7b45403062?auto=format&fit=crop&q=80&w=800"
                            alt="Arts 9"></div>
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1541450805268-4822a3a774ca?auto=format&fit=crop&q=80&w=800"
                            alt="Arts 10"></div>
                @endif
            </div>
        </div>

        <!-- Sports Content -->
        <div id="details-sports" class="shelf-content">
            <div class="shelf-row">
                <div class="feature-image-container">
                    <img src="https://images.unsplash.com/photo-1508098682722-e99c43a406b2?auto=format&fit=crop&q=80&w=1000"
                        alt="Sports Arena">
                </div>
                <div>
                    <span class="shelf-category-label">Athletics Hub</span>
                    <h4 class="shelf-title">Heart of Champions</h4>
                    <p class="shelf-story-text">From the crack of the bat to the final whistle, our athletics program
                        embodies the spirit of resilience. We believe that true champions are forged in the heat of
                        competition.</p>
                </div>
            </div>
            <div class="shelf-row">
                <div>
                    <span class="shelf-category-label">Winning Streaks</span>
                    <h4 class="shelf-title">Elite Performance</h4>
                    <div class="grid grid-cols-2 gap-8 mt-6">
                        <ul class="shelf-achievements space-y-4 text-sm">
                            <li class="achievement-item"><span class="achievement-icon">🥇</span> Zonal Basketball
                                Winners</li>
                            <li class="achievement-item"><span class="achievement-icon">🏅</span> 12+ University Golds
                            </li>
                        </ul>
                        <ul class="shelf-achievements space-y-4 text-sm">
                            <li class="achievement-item"><span class="achievement-icon">🏅</span> VTU Overall Sports
                                Shield</li>
                            <li class="achievement-item"><span class="achievement-icon">⚽</span> Best Football Facility
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="feature-image-container">
                    <img src="https://images.unsplash.com/photo-1517649763962-0c623066013b?auto=format&fit=crop&q=80&w=1000"
                        alt="Sports Victory">
                </div>
            </div>
            <div class="shelf-row">
                <div class="feature-image-container">
                    <img src="https://images.unsplash.com/photo-1461896836934-ffe607ba8211?auto=format&fit=crop&q=80&w=1000"
                        alt="Sports Future">
                </div>
                <div>
                    <span class="shelf-category-label">Next Gen</span>
                    <h4 class="shelf-title">The Athletics Path</h4>
                    <p class="shelf-story-text">Our state-of-the-art training facilities are now open for inter-college
                        leagues. We are committed to developing world-class athletes who excel both on the field and in
                        their character.</p>
                </div>
            </div>
            <div class="shelf-gallery">
                @if(isset($galleries['sports']) && count($galleries['sports']) > 0)
                    @foreach($galleries['sports'] as $image)
                        <div class="shelf-gallery-item">
                            <img src="{{ $image->url }}" alt="Sports">
                        </div>
                    @endforeach
                @else
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1541252260737-d4d2b3e3974d?auto=format&fit=crop&q=80&w=800"
                            alt="Sports 1"></div>
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1461896836934-ffe607ba8211?auto=format&fit=crop&q=80&w=800"
                            alt="Sports 2"></div>
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1543351611-58f69d7c1781?auto=format&fit=crop&q=80&w=800"
                            alt="Sports 3"></div>
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1508098682722-e99c43a406b2?auto=format&fit=crop&q=80&w=800"
                            alt="Sports 4"></div>
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1517649763962-0c623066013b?auto=format&fit=crop&q=80&w=1000"
                            alt="Sports 5"></div>
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1526676037777-05a232554f77?auto=format&fit=crop&q=80&w=800"
                            alt="Sports 6"></div>
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1519315901367-f34ff9154487?auto=format&fit=crop&q=80&w=800"
                            alt="Sports 7"></div>
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1434608519344-49d77a699e1d?auto=format&fit=crop&q=80&w=800"
                            alt="Sports 8"></div>
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1530549387631-ce80ffc91f17?auto=format&fit=crop&q=80&w=800"
                            alt="Sports 9"></div>
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1476480862126-209bfaa8edc8?auto=format&fit=crop&q=80&w=800"
                            alt="Sports 10"></div>
                @endif
            </div>
        </div>

        <!-- Tech Content -->
        <div id="details-tech" class="shelf-content">
            <div class="shelf-row">
                <div class="feature-image-container">
                    <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&q=80&w=1000"
                        alt="Tech Lab">
                </div>
                <div>
                    <span class="shelf-category-label">Innovation Lab</span>
                    <h4 class="shelf-title">Code, Build, Disrupt</h4>
                    <p class="shelf-story-text">GPTC Muttom's technological fests are widely regarded as the most competitive
                        in the region. We provide our students with the tools to build the future.</p>
                </div>
            </div>
            <div class="shelf-row">
                <div>
                    <span class="shelf-category-label">Future Builders</span>
                    <h4 class="shelf-title">Global Recognition</h4>
                    <div class="grid grid-cols-2 gap-8 mt-6">
                        <ul class="shelf-achievements space-y-4 text-sm">
                            <li class="achievement-item"><span class="achievement-icon">💻</span> India Hackathon
                                Winners</li>
                            <li class="achievement-item"><span class="achievement-icon">🚀</span> Global SpaceX Top 10
                            </li>
                        </ul>
                        <ul class="shelf-achievements space-y-4 text-sm">
                            <li class="achievement-item"><span class="achievement-icon">🛰️</span> Student Satellite
                                Lead</li>
                            <li class="achievement-item"><span class="achievement-icon">💡</span> 15+ Student Patents
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="feature-image-container">
                    <img src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b?auto=format&fit=crop&q=80&w=1000"
                        alt="Tech Future">
                </div>
            </div>
            <div class="shelf-row">
                <div class="feature-image-container">
                    <img src="https://images.unsplash.com/photo-1531297484001-80022131f5a1?auto=format&fit=crop&q=80&w=1000"
                        alt="AI Lab">
                </div>
                <div>
                    <span class="shelf-category-label">AI Frontiers</span>
                    <h4 class="shelf-title">Machine Intelligence</h4>
                    <p class="shelf-story-text">Our new Artificial Intelligence and Robotics lab is at the forefront of
                        research. Students are building autonomous systems that will drive the industries of tomorrow.
                    </p>
                </div>
            </div>
            <div class="shelf-gallery">
                @if(isset($galleries['tech']) && count($galleries['tech']) > 0)
                    @foreach($galleries['tech'] as $image)
                        <div class="shelf-gallery-item">
                            <img src="{{ $image->url }}" alt="Tech">
                        </div>
                    @endforeach
                @else
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1531297484001-80022131f5a1?auto=format&fit=crop&q=80&w=800"
                            alt="Tech 1"></div>
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1485083269755-a7b559a4fe5e?auto=format&fit=crop&q=80&w=800"
                            alt="Tech 2"></div>
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&q=80&w=800"
                            alt="Tech 3"></div>
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&q=80&w=800"
                            alt="Tech 4"></div>
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b?auto=format&fit=crop&q=80&w=800"
                            alt="Tech 5"></div>
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?auto=format&fit=crop&q=80&w=800"
                            alt="Tech 6"></div>
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&q=80&w=800"
                            alt="Tech 7"></div>
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1517077304055-6e89abbf09b0?auto=format&fit=crop&q=80&w=800"
                            alt="Tech 8"></div>
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1535223289827-42f1e9919769?auto=format&fit=crop&q=80&w=800"
                            alt="Tech 9"></div>
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1525373612132-b3e277947ef8?auto=format&fit=crop&q=80&w=800"
                            alt="Tech 10"></div>
                @endif
            </div>
        </div>


        <!-- Cultural Content -->
        <div id="details-cultural" class="shelf-content">
            <div class="shelf-row">
                <div class="feature-image-container">
                    <img src="https://images.unsplash.com/photo-1626261545169-8bcbc7273934?auto=format&fit=crop&q=80&w=1000"
                        alt="Culture Heritage">
                </div>
                <div>
                    <span class="shelf-category-label">Heritage Preservatory</span>
                    <h4 class="shelf-title">Legacy of Kerala</h4>
                    <p class="shelf-story-text">Our cultural fests are a vibrant tapestry of tradition. We celebrate the
                        colors of Kathakali and the rhythms of Chenda.</p>
                </div>
            </div>
            <div class="shelf-row">
                <div>
                    <span class="shelf-category-label">Fine Arts</span>
                    <h4 class="shelf-title">Artistic Expression</h4>
                    <div class="grid grid-cols-2 gap-8 mt-6">
                        <ul class="shelf-achievements space-y-4 text-sm">
                            <li class="achievement-item"><span class="achievement-icon">🎭</span> Best Regional
                                Kathakali</li>
                            <li class="achievement-item"><span class="achievement-icon">🥁</span> State Percussion Gold
                            </li>
                        </ul>
                        <ul class="shelf-achievements space-y-4 text-sm">
                            <li class="achievement-item"><span class="achievement-icon">🪷</span> 50 Years of Traditions
                            </li>
                            <li class="achievement-item"><span class="achievement-icon">🎓</span> Art Performance Gold
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="feature-image-container">
                    <img src="https://images.unsplash.com/photo-1625946112521-4979e27eaec8?auto=format&fit=crop&q=80&w=1000"
                        alt="Culture Performance">
                </div>
            </div>
            <div class="shelf-row">
                <div class="feature-image-container">
                    <img src="https://images.unsplash.com/photo-1616423642371-331575ca1bad?auto=format&fit=crop&q=80&w=1000"
                        alt="Dance Fest">
                </div>
                <div>
                    <span class="shelf-category-label">Rhythms</span>
                    <h4 class="shelf-title">Dance of the Gods</h4>
                    <p class="shelf-story-text">The energy of our annual dance festivals is unmatched. We bring together
                        performers from across the state to celebrate the diversity of our heritage.</p>
                </div>
            </div>
            <div class="shelf-gallery">
                @if(isset($galleries['cultural']) && count($galleries['cultural']) > 0)
                    @foreach($galleries['cultural'] as $image)
                        <div class="shelf-gallery-item">
                            <img src="{{ $image->url }}" alt="Cultural">
                        </div>
                    @endforeach
                @else
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1625946112521-4979e27eaec8?auto=format&fit=crop&q=80&w=800"
                            alt="Culture 1"></div>
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1616423642371-331575ca1bad?auto=format&fit=crop&q=80&w=800"
                            alt="Culture 2"></div>
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1601614210609-b68f44d8521e?auto=format&fit=crop&q=80&w=800"
                            alt="Culture 3"></div>
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?auto=format&fit=crop&q=80&w=800"
                            alt="Culture 4"></div>
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1626261545169-8bcbc7273934?auto=format&fit=crop&q=80&w=800"
                            alt="Culture 5"></div>
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1600100398055-124007749488?auto=format&fit=crop&q=80&w=800"
                            alt="Culture 6"></div>
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1541339907198-e08756ebafe3?auto=format&fit=crop&q=80&w=800"
                            alt="Culture 7"></div>
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1506157786151-b8491531f063?auto=format&fit=crop&q=80&w=800"
                            alt="Culture 8"></div>
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1514525253342-b0bb04f23bba?auto=format&fit=crop&q=80&w=800"
                            alt="Culture 9"></div>
                    <div class="shelf-gallery-item"><img
                            src="https://images.unsplash.com/photo-1605721911519-3dfeb3be25e7?auto=format&fit=crop&q=80&w=800"
                            alt="Culture 10"></div>
                @endif
            </div>
        </div>

        <!-- Elevate Content (Soft Skills) -->
        <div id="details-elevate" class="shelf-content">
            <div class="shelf-row">
                <div class="feature-image-container">
                    <img src="{{ asset('images/about/elevate_main.png') }}" alt="Elevate Leadership">
                </div>
                <div>
                    <span class="shelf-category-label">Professional Excellence</span>
                    <h4 class="shelf-title">Elevate Your Potential</h4>
                    <p class="shelf-story-text">Soft skills are the foundation of professional excellence. Elevate is our dedicated fest for communication, leadership, and emotional intelligence, transforming students into industry-ready leaders.</p>
                </div>
            </div>
            <div class="shelf-row">
                <div>
                    <span class="shelf-category-label">Career Growth</span>
                    <h4 class="shelf-title">Leadership Foundations</h4>
                    <div class="grid grid-cols-2 gap-8 mt-6">
                        <ul class="shelf-achievements space-y-4 text-sm">
                            <li class="achievement-item"><span class="achievement-icon">📈</span> 500+ Students Certified</li>
                            <li class="achievement-item"><span class="achievement-icon">🤝</span> 20+ Corporate Trainers</li>
                        </ul>
                        <ul class="shelf-achievements space-y-4 text-sm">
                            <li class="achievement-item"><span class="achievement-icon">🌟</span> Best Leadership Program</li>
                            <li class="achievement-item"><span class="achievement-icon">💼</span> Top Placement Support</li>
                        </ul>
                    </div>
                </div>
                <div class="feature-image-container">
                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&q=80&w=1000" alt="Elevate Workshop">
                </div>
            </div>
            <div class="shelf-gallery">
                @if(isset($galleries['elevate']) && count($galleries['elevate']) > 0)
                    @foreach($galleries['elevate'] as $image)
                        <div class="shelf-gallery-item">
                            <img src="{{ $image->url }}" alt="Elevate">
                        </div>
                    @endforeach
                @else
                    <div class="shelf-gallery-item"><img src="https://images.unsplash.com/photo-1515187029135-18ee286d815b?auto=format&fit=crop&q=80&w=800" alt="Elevate 1"></div>
                    <div class="shelf-gallery-item"><img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&q=80&w=800" alt="Elevate 2"></div>
                    <div class="shelf-gallery-item"><img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&q=80&w=800" alt="Elevate 3"></div>
                    <div class="shelf-gallery-item"><img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&q=80&w=800" alt="Elevate 4"></div>
                    <div class="shelf-gallery-item"><img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&q=80&w=800" alt="Elevate 5"></div>
                    <div class="shelf-gallery-item"><img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&q=80&w=800" alt="Elevate 6"></div>
                    <div class="shelf-gallery-item"><img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&q=80&w=800" alt="Elevate 7"></div>
                    <div class="shelf-gallery-item"><img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&q=80&w=800" alt="Elevate 8"></div>
                    <div class="shelf-gallery-item"><img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&q=80&w=800" alt="Elevate 9"></div>
                    <div class="shelf-gallery-item"><img src="https://images.unsplash.com/photo-1552581234-2612b74d5022?auto=format&fit=crop&q=80&w=800" alt="Elevate 10"></div>
                @endif
            </div>
        </div>
    </div>
    </div>

    <section class="max-w-7xl mx-auto px-8 md:px-16 py-16 grid md:grid-cols-2 gap-16 items-center reveal"
        data-anim="animate__fadeInUp">
        <div class="space-y-6">
            <h2 class="text-4xl font-bold text-[var(--text-main)]">Our Story</h2>
            <p class="dynamic-text-muted leading-relaxed text-lg">
                EVENTURA was born from a simple idea: make it easier for students to discover and participate in the
                vibrant extracurricular life at GPTC Muttom. What started as a student initiative has grown into the central
                hub for all campus activities.
            </p>
            <p class="dynamic-text-muted leading-relaxed text-lg">
                Today, we connect students with 12+ active clubs, organize 100+ events annually, and manage two major
                fests that attract thousands of participants from across India.
            </p>
        </div>
        <div class="rounded-3xl overflow-hidden border border-white/10 shadow-2xl reveal"
            data-anim="animate__fadeInRight">
            <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=1000"
                alt="Students Collaborative"
                class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-1000">
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-8 md:px-16 py-12">
        <div class="grid md:grid-cols-2 gap-8">
            <div class="glass-compact-refined p-8 rounded-[2rem] reveal" data-anim="animate__fadeInLeft">
                <div
                    class="w-10 h-10 bg-blue-600/20 rounded-xl flex items-center justify-center text-blue-500 text-xl mb-5">
                    👁️</div>
                <h3 class="text-2xl font-bold mb-3">Our Vision</h3>
                <p class="text-gray-400 leading-relaxed text-sm">To be the leading platform for student innovation and
                    collaboration at GPTC Muttom, fostering a community where every student's potential is recognized and
                    celebrated through meaningful engagement.</p>
            </div>
            <div class="glass-compact-refined p-8 rounded-[2rem] reveal" data-anim="animate__fadeInRight">
                <div
                    class="w-10 h-10 bg-purple-600/20 rounded-xl flex items-center justify-center text-purple-500 text-xl mb-5">
                    🚀</div>
                <h3 class="text-2xl font-bold mb-3">Our Mission</h3>
                <p class="text-gray-400 leading-relaxed text-sm">Our mission is to streamline campus life by providing a
                    centralized digital hub that connects students with diverse clubs, technical fests, and cultural
                    events.</p>
            </div>
        </div>
    </section>

    <!-- Our Impact Section (Moved Up) -->
    <section class="max-w-7xl mx-auto px-8 md:px-16 py-12 mb-24">
        <div class="text-center mb-12 reveal" data-anim="animate__fadeIn">
            <h2 class="text-3xl font-bold mb-3">Our Impact</h2>
            <p class="text-gray-500 text-sm">Quantifying our commitment to campus excellence.</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="glass-compact-refined p-8 rounded-[2rem] text-center reveal" data-anim="animate__fadeInUp">
                <div class="text-4xl font-extrabold text-blue-500 mb-1">5+</div>
                <div class="text-gray-400 text-[11px] uppercase tracking-widest font-bold">Major Festivals</div>
            </div>
            <div class="glass-compact-refined p-8 rounded-[2rem] text-center reveal" data-anim="animate__fadeInUp"
                style="animation-delay: 0.1s">
                <div class="text-4xl font-extrabold text-blue-500 mb-1">5000+</div>
                <div class="text-gray-400 text-[11px] uppercase tracking-widest font-bold">Students</div>
            </div>
            <div class="glass-compact-refined p-8 rounded-[2rem] text-center reveal" data-anim="animate__fadeInUp"
                style="animation-delay: 0.2s">
                <div class="text-4xl font-extrabold text-blue-500 mb-1">100+</div>
                <div class="text-gray-400 text-[11px] uppercase tracking-widest font-bold">Annual Events</div>
            </div>
            <div class="glass-compact-refined p-8 rounded-[2rem] text-center reveal" data-anim="animate__fadeInUp"
                style="animation-delay: 0.3s">
                <div class="text-4xl font-extrabold text-blue-500 mb-1">50+</div>
                <div class="text-gray-400 text-[11px] uppercase tracking-widest font-bold">Awards Won</div>
            </div>
        </div>
    </section>



    <section class="max-w-7xl mx-auto px-8 md:px-16 py-24">
        <div class="text-center mb-16 reveal" data-anim="animate__fadeInUp">
            <h2 class="text-4xl font-bold mb-4">Our Team</h2>
            <p class="text-gray-500">Meet the dedicated team behind EVENTURA</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            <div class="glass-card p-10 rounded-2xl text-center reveal" data-anim="animate__zoomIn">
                <div
                    class="w-24 h-24 bg-blue-900/40 rounded-full flex items-center justify-center mx-auto mb-6 border-2 border-blue-500/50 shadow-[0_0_15px_rgba(59,130,246,0.3)] overflow-hidden">
                    <img src="https://ui-avatars.com/api/?name=Aslamkhan+V+A&background=random"
                        alt="Aslamkhan V A" class="w-full h-full object-cover">
                </div>
                <h4 class="font-bold text-lg">Aslamkhan V A</h4>
                <p class="text-xs text-blue-400 mb-1">Platform Coordinator</p>
                <p class="text-[10px] text-gray-500 uppercase tracking-widest font-medium">FINAL YEAR CSE</p>
            </div>
            <div class="glass-card p-10 rounded-2xl text-center reveal" data-anim="animate__zoomIn"
                style="animation-delay: 0.1s">
                <div
                    class="w-24 h-24 bg-pink-900/40 rounded-full flex items-center justify-center mx-auto mb-6 border-2 border-blue-500/50 shadow-[0_0_15px_rgba(59,130,246,0.3)] overflow-hidden">
                    <img src="https://ui-avatars.com/api/?name=Dillu+Dileep&background=random"
                        alt="Dillu Dileep" class="w-full h-full object-cover">
                </div>
                <h4 class="font-bold text-lg">Dillu Dileep</h4>
                <p class="text-xs text-pink-400 mb-1">Student Affairs Head</p>
                <p class="text-[10px] text-gray-500 uppercase tracking-widest font-medium">FINAL YEAR CSE</p>
            </div>
            <div class="glass-card p-10 rounded-2xl text-center reveal" data-anim="animate__zoomIn"
                style="animation-delay: 0.2s">
                <div
                    class="w-24 h-24 bg-blue-900/40 rounded-full flex items-center justify-center mx-auto mb-6 border-2 border-blue-500/50 shadow-[0_0_15px_rgba(59,130,246,0.3)] overflow-hidden">
                    <img src="https://ui-avatars.com/api/?name=Athul+Vasu&background=random"
                        alt="Athul Vasu" class="w-full h-full object-cover">
                </div>
                <h4 class="font-bold text-lg">Athul Vasu</h4>
                <p class="text-xs text-blue-400 mb-1">Technical Lead</p>
                <p class="text-[10px] text-gray-500 uppercase tracking-widest font-medium">Final Year CSE</p>
            </div>
            <div class="glass-card p-10 rounded-2xl text-center reveal" data-anim="animate__zoomIn"
                style="animation-delay: 0.3s">
                <div
                    class="w-24 h-24 bg-pink-900/40 rounded-full flex items-center justify-center mx-auto mb-6 border-2 border-blue-500/50 shadow-[0_0_15px_rgba(59,130,246,0.3)] overflow-hidden">
                    <img src="https://ui-avatars.com/api/?name=Ajaydev+Sajeev&background=random" alt="Ajaydev Sajeev"
                        class="w-full h-full object-cover">
                </div>
                <h4 class="font-bold text-lg">Ajaydev Sajeev</h4>
                <p class="text-xs text-pink-400 mb-1">Cultural Coordinator</p>
                <p class="text-[10px] text-gray-500 uppercase tracking-widest font-medium">Final Year CSE</p>
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

        // --- Gallery Logic ---
        let lockedCategory = null;

        function toggleLock(category) {
            const cards = document.querySelectorAll('.gallery-card');
            const clickedCard = event.currentTarget;

            if (lockedCategory === category) {
                // Unlock
                lockedCategory = null;
                clickedCard.classList.remove('locked');
                // Optionally hide the shelf immediately when unlocking
                document.getElementById('category-details-shelf').classList.remove('active');
            } else {
                // Lock new
                lockedCategory = category;
                cards.forEach(c => c.classList.remove('locked'));
                clickedCard.classList.add('locked');
                showDetails(category);
            }
        }

        // Remove mouseenter/mouseleave events for 'showDetails' so it only triggers on click (lock)
        // OR keep them if that's the desired behavior. The original code had:
        // onmouseenter="showDetails('arts')" onmouseleave="hideDetails()"
        // I kept them in HTML, so I need to preserve the functions.

        function showDetails(category) {
            const shelf = document.getElementById('category-details-shelf');
            const contents = document.querySelectorAll('.shelf-content');

            shelf.classList.add('active');

            contents.forEach(content => {
                content.classList.remove('active');
                if (content.id === `details-${category}`) {
                    content.classList.add('active');
                }
            });
        }

        function hideDetails() {
            const shelf = document.getElementById('category-details-shelf');

            if (lockedCategory) {
                // Instead of minimizing, return to the locked content
                showDetails(lockedCategory);
            } else {
                shelf.classList.remove('active');
            }
        }

        // --- Scroll Animation Logic ---
        const observerOptions = { threshold: 0.1 };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const animationName = entry.target.getAttribute('data-anim');
                    if (animationName) {
                        entry.target.classList.add('animate__animated', animationName);
                    }
                    entry.target.classList.add('active');
                    entry.target.style.opacity = '1';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.reveal').forEach((el) => observer.observe(el));

        // --- Parallax Mouse Glow ---
        const glow = document.getElementById('bg-glow');
        document.addEventListener('mousemove', (e) => {
            const x = (e.clientX / window.innerWidth - 0.5) * 60;
            const y = (e.clientY / window.innerHeight - 0.5) * 60;
            glow.style.transform = `translate(${x}px, ${y}px)`;

            // Move radial gradient center with mouse
            glow.style.background = `radial-gradient(circle at ${e.clientX}px ${e.clientY}px, rgba(59, 130, 246, 0.15) 0%, transparent 70%)`;
        });
    </script>
</body>

</html>
