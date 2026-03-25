<!DOCTYPE html>
<html lang="en">

<head>
@include('partials.theme-system')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventura - Algorythm 2025</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #050510;
            --primary-pink: #00f3ff;
            /* Swapped to neon cyan */
            --primary-purple: #bc13fe;
            /* Swapped to neon purple */
            --accent-blue: #482fec;
            /* Swapped to neon green */
            --card-bg: rgba(10, 10, 30, 0.7);
            --text-main: #ffffff;
            --text-dim: #94a3b8;
            --utsav-gradient: linear-gradient(135deg, #050510 0%, #0a0a2e 50%, #050510 100%);
            --bg-color: #050510;
            --glass-bg: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.1);
            --nav-bg: rgba(5, 5, 16, 0.85);
            --section-bg: rgba(255, 255, 255, 0.02);
            --footer-bg: #050510;
            --input-bg: rgba(255, 255, 255, 0.06);
            --panel-bg: rgba(255, 255, 255, 0.03);
            --glow-color: rgba(0, 243, 255, 0.1);
        }

        .light-theme {
            --bg-dark: #f8fafc;
            --bg-color: #f8fafc;
            --text-main: #0f172a;
            --text-dim: #475569;
            --card-bg: rgba(255, 255, 255, 0.8);
            --glass-bg: rgba(255, 255, 255, 0.8);
            --glass-border: rgba(0, 243, 255, 0.2);
            --utsav-gradient: linear-gradient(135deg, #f0fdff 0%, #f8fafc 100%);
            --nav-bg: rgba(248, 250, 252, 0.8);
            --section-bg: rgba(0, 243, 255, 0.02);
            --footer-bg: #f1f5f9;
            --input-bg: rgba(15, 23, 42, 0.05);
            --panel-bg: rgba(255, 255, 255, 0.9);
            --glow-color: rgba(0, 243, 255, 0.1);
        }

        .light-theme .countdown-item {
            background: rgba(15, 23, 42, 0.05);
            border-color: rgba(15, 23, 42, 0.1);
        }

        .light-theme .countdown-value {
            color: #0f172a;
            text-shadow: none;
        }

        .light-theme .countdown-label {
            color: #475569;
        }

        .dynamic-text-muted {
            color: var(--text-dim);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-main);
            overflow-x: hidden;
            scroll-behavior: smooth;
            transition: background-color 0.4s ease, color 0.4s ease;
        }

        /* Hamburger Menu Styles */
        .drawer-list {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 100vw;
            transform: translate(-100vw, 0);
            box-sizing: border-box;
            pointer-events: none;
            padding-top: 125px;
            transition: width 475ms ease-out, transform 450ms ease, border-radius 0.8s 0.1s ease;
            border-bottom-right-radius: 100vw;
            background: transparent;
            backdrop-filter: blur(10px);
            z-index: 100;
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
            color: var(--accent-blue);
            background-color: var(--glass-bg);
            padding-left: 2rem;
            transition: 0.3s;
        }

        .drawer-list li a i {
            margin-right: 15px;
            width: 25px;
            text-align: center;
            color: var(--accent-blue);
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
            z-index: 1000;
            position: absolute;
            display: block;
            height: 30px;
            width: 30px;
            cursor: pointer;
            top: 50%;
            left: 20px;
            transform: translateY(-50%);
        }

        label.hamburger text close,
        label.hamburger text open {
            text-transform: uppercase;
            font-size: 0.7em;
            position: absolute;
            transform: translateY(28px);
            text-align: center;
            width: 60px;
            left: -15px;
            overflow: hidden;
            transition: width 0.25s 0.35s, color 0.45s 0.35s;
            font-weight: 700;
            letter-spacing: 1px;
        }

        label.hamburger text close {
            color: rgba(0, 0, 0, 0);
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

        .logo-container {
            display: flex;
            align-items: center;
            padding-left: 45px;
        }

        /* --- Nav --- */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.2rem 6%;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            background: rgba(5, 5, 16, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0, 243, 255, 0.2);
        }

        .logo {
            font-weight: 700;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logo-box {
            background: var(--accent-blue);
            padding: 5px 10px;
            border-radius: 4px;
        }

        .nav-links {
            display: flex;
            gap: 2.5rem;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-dim);
            transition: 0.3s;
            font-size: 0.95rem;
        }

        .nav-links a:hover {
            color: var(--primary-pink);
        }

        .btn-auth {
            background: linear-gradient(to right, var(--accent-blue), var(--primary-purple));
            padding: 10px 22px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            font-weight: 600;
            transition: 0.3s;
        }

        /* --- Hero --- */
        .hero {
            height: 100vh;
            background: var(--utsav-gradient);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 0 10%;
            position: relative;
            overflow: hidden;
        }

        #hero-particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            pointer-events: none;
        }

        .hero>*:not(#hero-particles) {
            position: relative;
            z-index: 2;
        }

        .hero-tag {
            color: var(--primary-pink);
            font-size: 0.9rem;
            letter-spacing: 3px;
            margin-bottom: 1rem;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            letter-spacing: 2px;
        }

        .hero p {
            font-size: 1.8rem;
            color: var(--text-dim);
            margin-bottom: 2.5rem;
        }

        .hero-btns {
            display: flex;
            gap: 20px;
        }

        .btn-reg {
            background: var(--primary-pink);
            padding: 14px 35px;
            border-radius: 8px;
            text-decoration: none;
            color: #000;
            font-weight: bold;
        }

        .btn-view {
            border: 1px solid white;
            padding: 14px 35px;
            border-radius: 8px;
            text-decoration: none;
            color: white;
        }

        .hero-stats {
            display: flex;
            gap: 40px;
            margin-top: 50px;
            color: var(--text-dim);
            font-size: 0.9rem;
        }

        /* --- Countdown Timer --- */
        .countdown-container {
            display: flex;
            gap: 20px;
            margin-top: 40px;
        }

        .countdown-item {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 15px 20px;
            border-radius: 15px;
            min-width: 90px;
            text-align: center;
            transition: 0.3s;
        }

        .countdown-item:hover {
            background: rgba(0, 243, 255, 0.1);
            border-color: var(--primary-pink);
            transform: translateY(-5px);
        }

        .countdown-value {
            display: block;
            font-size: 2.2rem;
            font-weight: 900;
            color: var(--primary-pink);
            line-height: 1;
            margin-bottom: 5px;
            text-shadow: 0 0 20px rgba(0, 243, 255, 0.3);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .countdown-item.ticking .countdown-value {
            animation: tickPulse 1s infinite;
        }

        @keyframes tickPulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.05);
                opacity: 0.8;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .countdown-item::after {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: 15px;
            border: 1px solid transparent;
            transition: 0.3s;
        }

        .countdown-item:hover::after {
            border-color: var(--primary-pink);
            box-shadow: 0 0 20px rgba(0, 243, 255, 0.2);
        }

        .countdown-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--text-dim);
            font-weight: 600;
        }

        /* --- Highlights Slider --- */
        .highlights-section {
            padding: 80px 10%;
            background: rgba(255, 255, 255, 0.02);
            overflow: hidden;
            position: relative;
        }

        .highlights-container {
            display: flex;
            gap: 30px;
            width: fit-content;
            animation: slideLeft 30s linear infinite;
        }

        .highlights-container:hover {
            animation-play-state: paused;
        }

        .highlight-card {
            min-width: 500px;
            height: 300px;
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: 0.5s;
        }

        .highlight-card:hover {
            transform: scale(1.05);
            border-color: var(--primary-pink);
            box-shadow: 0 10px 40px rgba(0, 243, 255, 0.3);
        }

        .highlight-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.8s;
        }

        .highlight-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(transparent, rgba(5, 5, 20, 0.8));
            display: flex;
            align-items: flex-end;
            padding: 30px;
            opacity: 0;
            transition: 0.5s;
        }

        .highlight-card:hover .highlight-overlay {
            opacity: 1;
        }

        .highlight-overlay h3 {
            color: var(--primary-pink);
            font-size: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        @keyframes slideLeft {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(calc(-530px * 3));
            }
        }

        /* --- About Section --- */
        .about-section {
            padding: 100px 10%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .about-img {
            width: 100%;
            border-radius: 20px;
            border: 1px solid rgba(0, 243, 255, 0.2);
            box-shadow: 0 0 30px rgba(0, 243, 255, 0.1);
            transition: transform 0.5s ease;
        }

        .about-img:hover {
            transform: scale(1.02);
        }

        /* --- Highlights Slider --- */
        .highlights-section {
            padding: 80px 10%;
            background: rgba(255, 255, 255, 0.02);
            overflow: hidden;
            position: relative;
        }

        .highlights-container {
            display: flex;
            gap: 30px;
            width: fit-content;
            animation: slideLeft 30s linear infinite;
        }

        .highlights-container:hover {
            animation-play-state: paused;
        }

        .highlight-card {
            min-width: 500px;
            height: 300px;
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: 0.5s;
        }

        .highlight-card:hover {
            transform: scale(1.05);
            border-color: var(--primary-pink);
            box-shadow: 0 10px 40px rgba(0, 243, 255, 0.3);
        }

        .highlight-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.8s;
        }

        .highlight-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(transparent, rgba(5, 5, 20, 0.8));
            display: flex;
            align-items: flex-end;
            padding: 30px;
            opacity: 0;
            transition: 0.5s;
        }

        .highlight-card:hover .highlight-overlay {
            opacity: 1;
        }

        .highlight-overlay h3 {
            color: var(--primary-pink);
            font-size: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        @keyframes slideLeft {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(calc(-530px * 3));
            }
        }

        .about-content h2 {
            font-size: 2.2rem;
            margin-bottom: 20px;
        }

        .about-content p {
            color: var(--text-dim);
            margin-bottom: 15px;
        }

        /* --- Events Grid --- */
        .events-section {
            padding: 80px 10%;
        }

        .section-title {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-title h2 {
            font-size: 2.5rem;
        }

        .section-title p {
            color: var(--text-dim);
            margin-top: 10px;
        }

        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
        }

        .event-card {
            background: var(--card-bg);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 15px;
            transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .event-card:hover {
            transform: scale(1.03);
            border-color: var(--primary-pink);
            background: rgba(10, 10, 30, 0.9);
        }

        .event-card h3 {
            font-size: 1.4rem;
            margin-bottom: 12px;
        }

        .event-card p {
            color: var(--text-dim);
            font-size: 0.9rem;
            margin-bottom: 20px;
        }

        .event-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .prize {
            color: var(--accent-blue);
            font-weight: 700;
        }

        .date {
            font-size: 0.8rem;
            color: #64748b;
        }

        /* --- Footer --- */
        footer {
            padding: 80px 10% 40px;
            background: #02020a;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        .footer-main {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr 1fr;
            gap: 40px;
            margin-bottom: 60px;
        }

        .footer-col h4 {
            margin-bottom: 25px;
            color: white;
        }

        .footer-col ul {
            list-style: none;
        }

        .footer-col ul li {
            margin-bottom: 12px;
            color: var(--text-dim);
            cursor: pointer;
            transition: 0.2s;
        }

        .footer-col ul li:hover {
            color: var(--primary-pink);
        }

        /* --- Animations --- */
        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: 1s ease-out;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        .reveal-up {
            transform: translateY(50px);
        }

        .event-card.selected {
            border-color: var(--primary-pink);
            background: rgba(0, 243, 255, 0.1);
            box-shadow: 0 0 30px rgba(0, 243, 255, 0.2);
        }

        .event-card.selected::after {
            content: "\f058";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            position: absolute;
            top: 20px;
            right: 20px;
            color: var(--primary-pink);
            font-size: 1.2rem;
        }

        /* --- Floating Selection Bar --- */
        .selection-panel {
            position: fixed;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%) translateY(150%);
            background: rgba(5, 5, 20, 0.85);
            backdrop-filter: blur(25px);
            border: 1px solid var(--primary-pink);
            padding: 15px 40px;
            border-radius: 100px;
            display: flex;
            align-items: center;
            gap: 30px;
            z-index: 2000;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.6);
            transition: 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .selection-panel.active {
            transform: translateX(-50%) translateY(0);
        }

        .count-text {
            font-size: 1.1rem;
            color: white;
            font-weight: 600;
        }

        .count-text span {
            color: var(--primary-pink);
            font-size: 1.3rem;
            margin-right: 5px;
        }

        .arrow-trigger {
            background: var(--primary-pink);
            color: #000;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: 0.3s;
            border: none;
            box-shadow: 0 10px 20px rgba(0, 243, 255, 0.4);
        }

        .arrow-trigger:hover {
            transform: scale(1.1) rotate(5deg);
        }

        /* Modern Registration Panel Styling */
        .global-reg-section {
            display: grid;
            grid-template-rows: 0fr;
            transition: 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            width: 100%;
            margin-top: 50px;
        }

        .global-reg-section.open {
            grid-template-rows: 1fr;
        }

        .reg-content-wrapper {
            min-height: 0;
            background: rgba(10, 10, 30, 0.95);
            border: 1px solid var(--primary-pink);
            border-radius: 30px;
            padding: 50px;
            backdrop-filter: blur(40px);
            max-width: 1150px;
            margin: 0 auto 100px;
            box-shadow: 0 40px 100px rgba(0, 0, 0, 0.6), 0 0 30px rgba(0, 243, 255, 0.1);
        }

        .reg-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .reg-header h2 {
            font-size: 3rem;
            font-weight: 900;
            color: var(--primary-pink);
            letter-spacing: -1px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .reg-header p {
            color: var(--text-dim);
            font-size: 1.1rem;
        }

        .selection-visualizer {
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 40px;
        }

        .selection-visualizer h4 {
            color: var(--accent-blue);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-align: center;
            margin-bottom: 20px;
            font-weight: 800;
        }

        .chips-container {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: center;
        }

        .event-chip {
            background: rgba(0, 243, 255, 0.1);
            color: var(--primary-pink);
            padding: 10px 22px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 700;
            border: 1px solid rgba(0, 243, 255, 0.3);
            animation: chipIn 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        @keyframes chipIn {
            from { transform: scale(0.8); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        .registration-form-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            max-width: 950px;
            margin: 0 auto;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .input-group label {
            font-size: 0.75rem;
            text-transform: uppercase;
            color: var(--text-dim);
            letter-spacing: 1.5px;
            font-weight: 700;
        }

        .input-group input,
        .input-group select {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 18px 24px;
            border-radius: 16px;
            color: white;
            font-size: 1rem;
            outline: none;
            transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .input-group input:focus,
        .input-group select:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--primary-pink);
            box-shadow: 0 0 20px rgba(0, 243, 255, 0.2);
            transform: translateY(-2px);
        }

        .submit-btn-wrapper {
            grid-column: span 3;
            margin-top: 20px;
        }

        .confirm-reg-btn {
            width: 100%;
            background: linear-gradient(135deg, var(--primary-pink), var(--primary-purple));
            border: none;
            padding: 22px;
            border-radius: 18px;
            color: #000;
            font-weight: 900;
            font-size: 1.2rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            cursor: pointer;
            transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 20px 40px rgba(0, 243, 255, 0.2);
        }

        .confirm-reg-btn:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 30px 60px rgba(0, 243, 255, 0.4);
            filter: brightness(1.1);
        }

        .confirm-reg-btn:active {
            transform: scale(0.98);
        }

        @media (max-width: 900px) {

            .about-section,
            .footer-main {
                grid-template-columns: 1fr;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .landscape-flex-form {
                grid-template-columns: 1fr;
            }

            .final-reg-btn,
            .input-box {
                grid-column: span 1;
            }
        }

        /* Profile Section */
        .profile-container {
            position: relative;
            margin-left: 15px;
        }

        .profile-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid var(--primary-pink);
            cursor: pointer;
            transition: 0.3s;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.05);
        }

        .profile-btn:hover {
            box-shadow: 0 0 15px var(--primary-pink);
            transform: scale(1.05);
        }

        .profile-btn img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>

<body>

    <nav>
        <div class="logo-container">

            <div class="logo">
                <span class="logo-box">A</span> AARAVAM
            </div>
        </div>
        <div class="nav-links">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('fests') }}">Fests</a>
            <a href="{{ route('about') }}">About Us</a>
            <a href="{{ route('contact') }}">Contact</a>
        </div>
        <div class="profile-container" style="display: flex; align-items: center; gap: 15px;">
            <button id="theme-toggle" class="w-10 h-10 rounded-full flex items-center justify-center text-cyan-400 hover:scale-110 transition active:scale-95" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); cursor: pointer;">
                <i class="fas fa-moon" id="theme-icon"></i>
            </button>

            @auth
            <a href="{{ route('portal') }}" class="profile-btn" id="festProfileBtn">
                 @if(Auth::user()->profile_image)
                    <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="Profile">
                @else
                   <img src="https://via.placeholder.com/150/00f3ff/000000?text=USER" alt="Profile">
                @endif
            </a>
            @else
            <a href="{{ route('student') }}" class="profile-btn" id="festProfileBtn">
                <img src="https://via.placeholder.com/150/00f3ff/000000?text=LOGIN" alt="Login">
             </a>
            @endauth
        </div>
    </nav>

    <section class="hero">
        <canvas id="hero-particles"></canvas>
        <span class="hero-tag reveal">TECH FEST 2025</span>
        <h1 class="reveal">ALGORYTHM</h1>
        <p class="reveal">The systematic sequence of innovation. Logic, Gaming, and Robotics collision.</p>
        <div class="hero-btns reveal">
            <a href="#featured-events" class="btn-reg">Join the Grid</a>
        </div>

        <div class="countdown-container reveal">
            <div class="countdown-item">
                <span class="countdown-value" id="days">00</span>
                <span class="countdown-label">Days</span>
            </div>
            <div class="countdown-item">
                <span class="countdown-value" id="hours">00</span>
                <span class="countdown-label">Hours</span>
            </div>
            <div class="countdown-item">
                <span class="countdown-value" id="minutes">00</span>
                <span class="countdown-label">Mins</span>
            </div>
            <div class="countdown-item">
                <span class="countdown-value" id="seconds">00</span>
                <span class="countdown-label">Secs</span>
            </div>
        </div>
        <div class="hero-stats reveal">
            <span>UPCOMING PHASE 02</span>
            <span>•</span>
            <span>20+ CHALLENGES</span>
            <span>•</span>
            <span>INR 50K+ PRIZES</span>
        </div>
    </section>

    <!-- Results Banner -->
    <section class="results-banner reveal py-12 px-6">
        <div class="max-w-7xl mx-auto">
            <a href="{{ route('results', ['category' => 'Algorithm']) }}" class="group block relative overflow-hidden rounded-[2rem] border border-[#00f3ff]/30 bg-[#00f3ff]/5 p-8 md:p-12 transition-all hover:border-[#00f3ff] hover:bg-[#00f3ff]/10">
                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                    <div>
                        <span class="text-[#00f3ff] text-xs font-black uppercase tracking-[0.3em] mb-4 block">Event Status: Evaluated</span>
                        <h2 class="text-3xl md:text-5xl font-black text-white mb-4">The Hall of Fame is Live</h2>
                        <p class="text-slate-400 text-lg max-w-xl">Witness the champions of Algorithm 2025. The results for coding, gaming, and robotics are now official.</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-2xl bg-[#00f3ff] flex items-center justify-center text-black text-2xl group-hover:scale-110 transition-transform">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <i class="fas fa-arrow-right text-[#00f3ff] text-2xl animate-pulse"></i>
                    </div>
                </div>
                <!-- Abstract backgrounds -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-[#00f3ff]/10 blur-[80px] rounded-full -mr-32 -mt-32"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-[#bc13fe]/10 blur-[60px] rounded-full -ml-24 -mb-24"></div>
            </a>
        </div>
    </section>

    <section class="about-section reveal">
        <img src="{{ asset('images/algorithm/about_tech.jpg') }}"
            class="about-img" alt="Tech Theme">
        <div class="about-content">
            <h2>About Algorythm</h2>
            <p>Algorythm is the ultimate tech arena where minds innovate and skills dominate. A three-day journey into
                the future of digital excellence.</p>
            <p>This year's theme, <strong>"Cyber-Sync"</strong>, celebrates the harmony between human intellect and
                computational power.</p>
        </div>
    </section>

    <section class="events-section">
        <div class="section-title reveal">
            <h2>Featured Events</h2>
            <p>Experience the best of technical performances and competitions</p>
        </div>

        <div class="events-grid" id="featured-events">
            @forelse($events as $event)
            <div class="event-card reveal" data-id="{{ $event->id }}" data-name="{{ $event->name }}" onclick="selectEvent(this)">
                <div class="flex justify-between items-start mb-4">
                    <h3>{{ $event->name }}</h3>
                    @if($event->has_results > 0)
                        <a href="{{ route('results', ['category' => 'Algorithm', 'event_id' => $event->id]) }}" 
                           class="inline-flex items-center gap-1.5 px-3 py-1 bg-cyan-500/10 text-cyan-400 text-[10px] font-black uppercase tracking-widest rounded-lg border border-cyan-500/20 hover:bg-cyan-500 hover:text-black transition-all stop-propagation" 
                           onclick="event.stopPropagation()">
                            <i class="fas fa-microchip"></i> Results
                        </a>
                    @endif
                </div>
                <p>{{ $event->description }}</p>
                <div class="event-footer">
                    <span class="prize">{{ $event->fees > 0 ? '₹ ' . number_format($event->fees, 0) : 'FREE' }}</span>
                    <span class="date">{{ $event->sub_category }}</span>
                </div>
                @if($event->time)
                <div style="margin-top:10px; font-size: 0.85rem; color: #00f3ff; display: flex; align-items: center; gap: 5px;">
                    <i class="far fa-clock"></i> {{ $event->time }}
                </div>
                @endif
            </div>
            @empty
            <div class="col-span-full text-center py-10">
                <p>No featured events currently available.</p>
            </div>
            @endforelse
        </div>

        <div class="text-center mt-12 reveal">
            <a href="{{ route('algorithm.list') }}" class="inline-flex items-center gap-2 bg-[#00f3ff] hover:bg-[#00d4e0] px-8 py-3 rounded-full font-bold transition active:scale-95 shadow-lg shadow-[#00f3ff]/30 text-black">
                <i class="fas fa-list-ul"></i> View Full Schedule & Activity Points
            </a>
        </div>

        <div class="global-reg-section" id="globalReg">
            <div class="reg-content-wrapper">
                <div class="reg-header">
                    <h2>Event Registration</h2>
                    <p>Provide your official details to secure your spot in Algorythm 2025</p>
                </div>

                <div class="selection-visualizer">
                    <h4>You are registering for:</h4>
                    <div class="chips-container" id="regChips">
                        <span class="text-gray-500 italic">No events selected yet</span>
                    </div>
                </div>

                <form class="registration-form-grid" onsubmit="handleRegistration(event)">
                    <div class="input-group">
                        <label>Full Name</label>
                        <input type="text" placeholder="Enter your name" required>
                    </div>
                    <div class="input-group">
                        <label>Roll Number</label>
                        <input type="text" placeholder="Enter Roll Number" required>
                    </div>
                    <div class="input-group">
                        <label>Semester</label>
                        <select required>
                            <option value="" disabled selected>Select Semester</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                            <option value="S4">S4</option>
                            <option value="S5">S5</option>
                            <option value="S6">S6</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label>College Email</label>
                        <input type="email" placeholder="example@gptcmuttom.ac.in" required>
                    </div>
                    <div class="input-group" style="grid-column: span 2;">
                        <label>Department</label>
                        <input type="text" id="deptInput" list="deptList" placeholder="Search or select department" required>
                        <datalist id="deptList">
                            <option value="CT">Computer Engineering</option>
                            <option value="ME">Mechanical Engineering</option>
                            <option value="EEE">Electrical Engineering</option>
                            <option value="CE">Civil Engineering</option>
                            <option value="EL">Electronics Engineering</option>
                        </datalist>
                    </div>
                    <div class="submit-btn-wrapper">
                        <button type="submit" class="confirm-reg-btn">Complete Tech Registration</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <div class="selection-panel" id="selectionPanel">
        <div class="count-text"><span id="eventCount">0</span> Events Highlighted</div>
        <button class="arrow-trigger" onclick="triggerSlideDown()">
            <i class="fas fa-arrow-down"></i>
        </button>
    </div>

    <section class="highlights-section reveal">
        <div class="section-title reveal" style="text-align: center; margin-bottom: 50px;">
            <h2>Algorythm Highlights</h2>
            <p>Explore the frontier of tech and innovation</p>
        </div>
        <div class="highlights-container">
            <div class="highlight-card">
                <img src="{{ asset('images/algorithm/robo_synergy.jpg') }}"
                    alt="Robotic Interface">
                <div class="highlight-overlay">
                    <h3>Robotic Synergy</h3>
                </div>
            </div>
            <div class="highlight-card">
                <img src="{{ asset('images/algorithm/future_ui.jpg') }}"
                    alt="Digital UI">
                <div class="highlight-overlay">
                    <h3>Future UI Design</h3>
                </div>
            </div>
            <div class="highlight-card">
                <img src="{{ asset('images/algorithm/cyber_sync.jpg') }}"
                    alt="Cyber Sync">
                <div class="highlight-overlay">
                    <h3>Cyber Sync Core</h3>
                </div>
            </div>
            <!-- Duplicates for seamless loop -->
            <div class="highlight-card">
                <img src="{{ asset('images/algorithm/robo_synergy.jpg') }}"
                    alt="Robotic Interface">
                <div class="highlight-overlay">
                    <h3>Robotic Synergy</h3>
                </div>
            </div>
            <div class="highlight-card">
                <img src="{{ asset('images/algorithm/future_ui.jpg') }}"
                    alt="Digital UI">
                <div class="highlight-overlay">
                    <h3>Future UI Design</h3>
                </div>
            </div>
            <div class="highlight-card">
                <img src="{{ asset('images/algorithm/cyber_sync.jpg') }}"
                    alt="Cyber Sync">
                <div class="highlight-overlay">
                    <h3>Cyber Sync Core</h3>
                </div>
            </div>
        </div>
    </section>

    <footer class="pt-24 pb-12 px-6 md:px-12 border-t border-white/5 reveal reveal-up">
        <div class="max-w-7xl mx-auto grid md:grid-cols-4 gap-12 mb-20">
            <div class="col-span-1">
                <div class="flex items-center gap-3 mb-8">
                    <div class="bg-[#00f3ff] w-9 h-9 rounded-xl flex items-center justify-center font-bold text-black">A</div>
                    <span class="text-2xl font-black tracking-widest">ആരവം</span>
                </div>
                <p class="dynamic-text-muted text-sm leading-relaxed">Connecting the dots for every student at GPTC Muttom. Join our journey to redefine campus excellence.</p>
            </div>

            <div>
                <h4 class="font-bold mb-8 uppercase tracking-widest text-xs">Explore</h4>
                <ul class="dynamic-text-muted text-sm space-y-4 font-medium">
                    <li><a href="{{ route('home') }}" class="hover:text-[#00f3ff] transition">Home</a></li>
                    <li><a href="{{ route('fests') }}" class="hover:text-[#00f3ff] transition">Fests</a></li>
                    <li><a href="{{ route('results', ['category' => 'Algorithm']) }}" class="hover:text-[#00f3ff] transition">Results Board</a></li>
                    <li><a href="{{ route('calendar') }}" class="hover:text-[#00f3ff] transition">Academic Calendar</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-[#00f3ff] transition">Contact</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold mb-8 uppercase tracking-widest text-xs">Contact</h4>
                <div class="dynamic-text-muted text-sm space-y-5">
                    <p class="flex items-start gap-4"><i class="fas fa-map-marker-alt text-[#00f3ff] mt-1"></i> Idukki, Kerala, 685587</p>
                    <p class="flex items-center gap-4"><i class="fas fa-envelope text-[#00f3ff]"></i> aaravam@gptcmuttom.ac.in</p>
                    <p class="flex items-center gap-4"><i class="fas fa-phone text-[#00f3ff]"></i> +91 4862 255 310</p>
                </div>
            </div>

            <div>
                <h4 class="font-bold mb-8 uppercase tracking-widest text-xs">Follow Us</h4>
                <div class="flex space-x-3 text-gray-500">
                    <a href="https://www.facebook.com/GptcMuttomthodupuzha" target="_blank" class="w-9 h-9 bg-slate-900 rounded-lg flex items-center justify-center hover:bg-[#00f3ff] hover:text-white transition-all">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-9 h-9 bg-slate-900 rounded-lg flex items-center justify-center hover:bg-[#00f3ff] hover:text-white transition-all">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://gpcmuttom.ac.in/" target="_blank" class="w-9 h-9 bg-slate-900 rounded-lg flex items-center justify-center hover:bg-[#00f3ff] hover:text-white transition-all">
                        <i class="fas fa-globe"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="text-center dynamic-text-muted text-xs tracking-[0.3em] uppercase pt-12 border-t border-white/5">
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

        let selectedEvents = new Map();
        const selectionPanel = document.getElementById('selectionPanel');
        const eventCountLabel = document.getElementById('eventCount');
        const regChipsContainer = document.getElementById('regChips');
        const globalRegSection = document.getElementById('globalReg');

        function selectEvent(card) {
            const eventId = card.getAttribute('data-id');
            const eventName = card.getAttribute('data-name');
            if (selectedEvents.has(eventId)) {
                selectedEvents.delete(eventId);
                card.classList.remove('selected');
            } else {
                selectedEvents.set(eventId, eventName);
                card.classList.add('selected');
                // Automatically open registration form when an item is selected
                triggerSlideDown();
            }
            syncSelection();
        }

        function syncSelection() {
            const count = selectedEvents.size;
            eventCountLabel.textContent = count;
            if (count > 0) {
                selectionPanel.classList.add('active');
            }
            else { 
                selectionPanel.classList.remove('active'); 
                globalRegSection.classList.remove('open'); 
            }
            
            regChipsContainer.innerHTML = '';
            
            if (count === 0) {
                regChipsContainer.innerHTML = '<span class="text-gray-500 italic">No events selected yet</span>';
                return;
            }

            selectedEvents.forEach((name, id) => {
                const chip = document.createElement('div');
                chip.className = 'event-chip';
                chip.textContent = name;
                regChipsContainer.appendChild(chip);
            });
        }

        function triggerSlideDown() {
            if (!globalRegSection.classList.contains('open')) {
                globalRegSection.classList.add('open');
                setTimeout(() => { 
                    globalRegSection.scrollIntoView({ behavior: 'smooth', block: 'start' }); 
                }, 100);
            }
        }

        async function handleRegistration(event) {
            event.preventDefault();
            const form = event.target;
            const inputs = form.querySelectorAll('input, select');
            
            const deptValue = document.getElementById('deptInput').value.trim().toLowerCase();
            const allowedDepts = ['ct', 'computer', 'me', 'mechanical', 'eee', 'electrical', 'ce', 'civil', 'el', 'electronics'];
            
            if (!allowedDepts.includes(deptValue)) {
                alert('Invalid Department! Please enter one of: CT, Computer, ME, Mechanical, EEE, Electrical, CE, Civil, EL, or Electronics.');
                document.getElementById('deptInput').focus();
                document.getElementById('deptInput').style.borderColor = 'var(--primary-pink)';
                return;
            }

            const data = {
                student_name: inputs[0].value,
                reg_no: inputs[1].value,
                semester: inputs[2].value,
                email: inputs[3].value,
                department: document.getElementById('deptInput').value,
                event_ids: Array.from(selectedEvents.keys())
            };

            try {
                const response = await fetch('{{ route("registrations.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();
                if (result.success) {
                    alert('Registration Successful! Redirecting to portal...');
                    window.location.href = '{{ route("portal") }}';
                } else {
                    alert('Error: ' + result.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Registration failed. Please try again.');
            }
        }

        // Listen for global theme changes to update particles
        window.addEventListener('theme-changed', () => {
            if (window.updateAllParticles) window.updateAllParticles();
        });

        // --- Live Countdown Logic ---
        (function () {
            const targetDate = new Date("April 5, 2026 00:00:00").getTime();
            function updateTimer() {
                const now = new Date().getTime();
                const distance = targetDate - now;

                if (distance < 0) {
                    const container = document.querySelector(".countdown-container");
                    if (container) container.innerHTML = "<h2 style='text-align:center; width:100%; color:var(--primary-pink); letter-spacing:4px; font-size:1.5rem;'>UTSAV IS LIVE!</h2>";
                    return;
                }

                const d = Math.floor(distance / (1000 * 60 * 60 * 24));
                const h = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const m = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const s = Math.floor((distance % (1000 * 60)) / 1000);

                const dEl = document.getElementById("days");
                const hEl = document.getElementById("hours");
                const mEl = document.getElementById("minutes");
                const sEl = document.getElementById("seconds");

                if (dEl) dEl.innerText = d.toString().padStart(2, '0');
                if (hEl) hEl.innerText = h.toString().padStart(2, '0');
                if (mEl) mEl.innerText = m.toString().padStart(2, '0');
                if (sEl) {
                    sEl.innerText = s.toString().padStart(2, '0');
                    if (sEl.closest('.countdown-item')) {
                        sEl.closest('.countdown-item').classList.add('ticking');
                    }
                }
            }
            setInterval(updateTimer, 1000);
            updateTimer();
        })();

        // --- Gaming Particles ---
        (function () {
            const canvas = document.getElementById('hero-particles');
            const ctx = canvas.getContext('2d');
            let particles = [];
            function resize() { canvas.width = canvas.offsetWidth; canvas.height = canvas.offsetHeight; }
            window.addEventListener('resize', resize);
            resize();

            class Particle {
                constructor() { this.reset(); }
                reset() {
                    this.x = Math.random() * canvas.width;
                    this.y = Math.random() * canvas.height;
                    this.vx = (Math.random() - 0.5) * 0.4;
                    this.vy = (Math.random() - 0.5) * 0.4;
                    this.size = Math.random() * 3 + 2;
                    this.alpha = Math.random() * 0.4 + 0.1;
                    this.updateColor();
                    this.shape = Math.floor(Math.random() * 5); // △, □, ╳, ○, Hex
                    this.rotation = Math.random() * Math.PI * 2;
                    this.vr = (Math.random() - 0.5) * 0.02;
                }
                updateColor() {
                    const isLight = document.body.classList.contains('light-theme');
                    // Neon Cyan (0, 243, 255) for dark, Deeper Cyan (0, 100, 200) for light
                    const r = isLight ? 0 : 0;
                    const g = isLight ? 100 : 243;
                    const b = isLight ? 200 : 255;
                    this.color = `rgba(${r}, ${g}, ${b}, ${isLight ? this.alpha + 0.3 : this.alpha})`;
                }
                update() {
                    this.x += this.vx; this.y += this.vy; this.rotation += this.vr;
                    if (this.x < 0 || this.x > canvas.width || this.y < 0 || this.y > canvas.height) this.reset();
                }
                draw() {
                    ctx.save();
                    ctx.translate(this.x, this.y);
                    ctx.rotate(this.rotation);
                    ctx.strokeStyle = this.color;
                    ctx.lineWidth = 1;
                    ctx.beginPath();
                    if (this.shape === 0) { // Triangle
                        ctx.moveTo(0, -this.size); ctx.lineTo(this.size, this.size); ctx.lineTo(-this.size, this.size); ctx.closePath();
                    } else if (this.shape === 1) { // Square
                        ctx.rect(-this.size, -this.size, this.size * 2, this.size * 2);
                    } else if (this.shape === 2) { // Cross
                        ctx.moveTo(-this.size, -this.size); ctx.lineTo(this.size, this.size);
                        ctx.moveTo(this.size, -this.size); ctx.lineTo(-this.size, this.size);
                    } else if (this.shape === 3) { // Circle
                        ctx.arc(0, 0, this.size, 0, Math.PI * 2);
                    } else { // Hex glitch
                        ctx.rect(-this.size, -this.size / 2, this.size * 2, 1);
                    }
                    ctx.stroke();
                    ctx.restore();
                }
            }
            for (let i = 0; i < 100; i++) particles.push(new Particle());

            window.updateAllParticles = function () {
                particles.forEach(p => p.updateColor());
            };

            window.addEventListener('theme-changed', window.updateAllParticles);

            function animate() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                particles.forEach(p => { p.update(); p.draw(); });
                requestAnimationFrame(animate);
            }
            animate();
        })();
    </script>
</body>

</html>
