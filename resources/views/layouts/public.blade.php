<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $description ?? 'Roshdi — Laravel Developer. Building robust, elegant backends with Laravel and crafting seamless APIs.' }}">
    <meta name="theme-color" content="#c84b2f">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $title ?? 'Roshdi — Laravel Developer' }}">
    <meta property="og:description" content="{{ $description ?? 'Roshdi — Laravel Developer. Building robust, elegant backends with Laravel and crafting seamless APIs.' }}">
    <meta property="og:image" content="{{ asset('assets/img/og-image.png') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $title ?? 'Roshdi — Laravel Developer' }}">
    <meta property="twitter:description" content="{{ $description ?? 'Roshdi — Laravel Developer. Building robust, elegant backends with Laravel and crafting seamless APIs.' }}">
    <meta property="twitter:image" content="{{ asset('assets/img/og-image.png') }}">

    <title>{{ $title ?? 'Roshdi — Laravel Developer' }}</title>

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Geist+Mono:wght@300;400;500&family=Instrument+Sans:ital,wght@0,400;0,500;1,400&display=swap" rel="stylesheet">
    
    <script>
        (function() {
            const theme = localStorage.getItem('theme') || 'dark';
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>

    <style>
        :root {
            --ink:       #0f0e0c;
            --paper:     #f5f2eb;
            --paper2:    #ede9e0;
            --accent:    #c84b2f;
            --accent2:   #2f6bc8;
            --muted:     #8a8479;
            --border:    #d4cfc4;
            --serif:     'DM Serif Display', Georgia, serif;
            --mono:      'Geist Mono', monospace;
            --sans:      'Instrument Sans', sans-serif;
        }
        .dark {
            --ink:       #f0ece3;
            --paper:     #100f0d;
            --paper2:    #1a1916;
            --accent:    #e8694a;
            --accent2:   #5b9cf6;
            --muted:     #6b6760;
            --border:    #2a2925;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }

        body {
            background: var(--paper);
            color: var(--ink);
            font-family: var(--sans);
            font-size: 16px;
            line-height: 1.7;
            transition: background 0.3s ease, color 0.3s ease;
            overflow-x: hidden;
        }

        /* Grid texture */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(var(--border) 1px, transparent 1px),
                linear-gradient(90deg, var(--border) 1px, transparent 1px);
            background-size: 40px 40px;
            opacity: 0.25;
            pointer-events: none;
            z-index: 0;
        }

        /* ── LAYOUT ── */
        .container {
            max-width: 860px;
            margin: 0 auto;
            padding: 0 2rem;
            position: relative;
            z-index: 1;
        }

        /* ── NAV ── */
        nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 100;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            backdrop-filter: blur(12px);
            background: color-mix(in srgb, var(--paper) 85%, transparent);
            border-bottom: 1px solid var(--border);
        }

        .nav-logo {
            font-family: var(--mono);
            font-size: 0.85rem;
            color: var(--accent);
            text-decoration: none;
            letter-spacing: 0.05em;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 1.75rem;
            list-style: none;
        }

        .nav-links a {
            font-family: var(--mono);
            font-size: 0.75rem;
            color: var(--muted);
            text-decoration: none;
            letter-spacing: 0.08em;
            transition: color 0.2s;
        }
        .nav-links a:hover { color: var(--ink); }
        .nav-links a.active { color: var(--accent); }

        .theme-toggle {
            background: none;
            border: 1px solid var(--border);
            border-radius: 4px;
            padding: 0.35rem 0.6rem;
            cursor: pointer;
            color: var(--muted);
            font-family: var(--mono);
            font-size: 0.75rem;
            transition: all 0.2s;
        }
        .theme-toggle:hover { color: var(--ink); border-color: var(--ink); }

        /* ── HERO ── */
        .hero {
            padding: 9rem 0 5rem;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 3rem;
            align-items: end;
            border-bottom: 1px solid var(--border);
        }

        .hero-eyebrow {
            font-family: var(--mono);
            font-size: 0.72rem;
            color: var(--accent);
            letter-spacing: 0.15em;
            text-transform: uppercase;
            margin-bottom: 1rem;
        }

        .hero-name {
            font-family: var(--serif);
            font-size: clamp(3rem, 8vw, 5.5rem);
            line-height: 1.05;
            letter-spacing: -0.02em;
            margin-bottom: 1.5rem;
        }

        .hero-name em {
            color: var(--accent);
            font-style: italic;
        }

        .hero-desc {
            color: var(--muted);
            max-width: 480px;
            font-size: 1rem;
        }

        .hero-meta {
            text-align: right;
        }

        .hero-status {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-family: var(--mono);
            font-size: 0.72rem;
            color: var(--muted);
            border: 1px solid var(--border);
            border-radius: 100px;
            padding: 0.4rem 0.9rem;
            margin-bottom: 1rem;
        }

        .status-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: #4ade80;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.4; }
        }

        .hero-year {
            font-family: var(--mono);
            font-size: 5rem;
            color: var(--border);
            line-height: 1;
            font-weight: 300;
        }

        /* ── SECTIONS ── */
        section {
            padding: 4rem 0;
            border-bottom: 1px solid var(--border);
        }

        .section-header {
            display: flex;
            align-items: baseline;
            gap: 1rem;
            margin-bottom: 2.5rem;
        }

        .section-num {
            font-family: var(--mono);
            font-size: 0.72rem;
            color: var(--accent);
            letter-spacing: 0.1em;
        }

        .section-title {
            font-family: var(--serif);
            font-size: 1.8rem;
            letter-spacing: -0.01em;
        }

        /* ── ABOUT ── */
        .about-grid {
            display: grid;
            grid-template-columns: 3fr 2fr;
            gap: 3rem;
            align-items: start;
        }

        .about-text p { color: var(--muted); margin-bottom: 1rem; }
        .about-text p:last-child { margin-bottom: 0; }
        .about-text em { color: var(--ink); font-style: italic; }

        .about-facts {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .fact-item {
            border-left: 2px solid var(--accent);
            padding-left: 1rem;
        }

        .fact-label {
            font-family: var(--mono);
            font-size: 0.68rem;
            color: var(--muted);
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 0.2rem;
        }

        .fact-value {
            font-size: 0.95rem;
            color: var(--ink);
        }

        /* ── SKILLS ── */
        .skills-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        .skill-group {
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 1.25rem;
            transition: border-color 0.2s;
        }
        .skill-group:hover { border-color: var(--accent); }

        .skill-group-label {
            font-family: var(--mono);
            font-size: 0.68rem;
            color: var(--accent);
            letter-spacing: 0.12em;
            text-transform: uppercase;
            margin-bottom: 0.85rem;
        }

        .skill-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.4rem;
        }

        .skill-tag {
            font-family: var(--mono);
            font-size: 0.72rem;
            padding: 0.25rem 0.65rem;
            border-radius: 4px;
            border: 1px solid var(--border);
            color: var(--muted);
            transition: all 0.2s;
            cursor: default;
        }
        .skill-tag:hover {
            background: var(--paper2);
            color: var(--ink);
            border-color: var(--muted);
        }

        /* ── PROJECTS ── */
        .projects-list {
            display: flex;
            flex-direction: column;
        }

        .project-item {
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 1.5rem;
            align-items: center;
            padding: 1.25rem 0;
            border-bottom: 1px solid var(--border);
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            color: inherit;
        }
        .project-item:first-child { border-top: 1px solid var(--border); }
        .project-item:hover .project-name { color: var(--accent); }
        .project-item:hover .project-arrow { transform: translateX(4px); color: var(--accent); }

        .project-num {
            font-family: var(--mono);
            font-size: 0.68rem;
            color: var(--muted);
            min-width: 2rem;
        }

        .project-name {
            font-family: var(--serif);
            font-size: 1.1rem;
            transition: color 0.2s;
            margin-bottom: 0.2rem;
        }
        .project-stack {
            font-family: var(--mono);
            font-size: 0.68rem;
            color: var(--muted);
        }

        .project-arrow {
            font-size: 1rem;
            color: var(--muted);
            transition: all 0.2s;
        }

        /* ── BOOKS ── */
        .books-tabs {
            display: flex;
            border: 1px solid var(--border);
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 2rem;
            width: fit-content;
        }

        .book-tab {
            font-family: var(--mono);
            font-size: 0.72rem;
            letter-spacing: 0.08em;
            padding: 0.5rem 1.25rem;
            cursor: pointer;
            border: none;
            background: transparent;
            color: var(--muted);
            transition: all 0.2s;
        }
        .book-tab[aria-selected="true"] {
            background: var(--ink);
            color: var(--paper);
        }

        .books-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }

        .book-card {
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 1.1rem;
            transition: all 0.2s;
        }
        .book-card:hover { border-color: var(--accent2); }

        .book-badge {
            font-family: var(--mono);
            font-size: 0.62rem;
            letter-spacing: 0.1em;
            padding: 0.2rem 0.55rem;
            border-radius: 100px;
            margin-bottom: 0.75rem;
            display: inline-block;
        }

        .badge-reading { background: color-mix(in srgb, var(--accent2) 15%, transparent); color: var(--accent2); }
        .badge-read    { background: color-mix(in srgb, #4ade80 12%, transparent); color: #22c55e; }
        .badge-want    { background: color-mix(in srgb, var(--accent) 12%, transparent); color: var(--accent); }

        .book-title {
            font-family: var(--serif);
            font-size: 0.95rem;
            line-height: 1.35;
            margin-bottom: 0.3rem;
        }

        .book-author {
            font-family: var(--mono);
            font-size: 0.68rem;
            color: var(--muted);
        }

        .reading-progress {
            margin-top: 0.75rem;
            height: 2px;
            background: var(--border);
            border-radius: 100px;
            overflow: hidden;
        }
        .reading-progress-bar {
            height: 100%;
            background: var(--accent2);
            border-radius: 100px;
            transition: width 0.6s ease;
        }

        .progress-pct {
            font-family: var(--mono);
            font-size: 0.62rem;
            color: var(--muted);
            margin-top: 0.35rem;
        }

        /* ── CONTACT FORM ── */
        .form-group { margin-bottom: 1.5rem; }
        .form-label {
            display: block;
            font-family: var(--mono);
            font-size: 0.72rem;
            color: var(--muted);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }
        .form-input, .form-textarea {
            width: 100%;
            background: var(--paper2);
            border: 1px solid var(--border);
            border-radius: 6px;
            padding: 0.75rem 1rem;
            font-family: var(--sans);
            font-size: 0.95rem;
            color: var(--ink);
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }
        .form-input:focus, .form-textarea:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px color-mix(in srgb, var(--accent) 15%, transparent);
        }
        .form-input::placeholder, .form-textarea::placeholder {
            color: var(--muted);
            opacity: 0.6;
        }
        .form-textarea { resize: vertical; min-height: 140px; }
        .form-error {
            font-family: var(--mono);
            font-size: 0.68rem;
            color: var(--accent);
            margin-top: 0.35rem;
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }
        .btn-submit {
            font-family: var(--mono);
            font-size: 0.78rem;
            letter-spacing: 0.08em;
            padding: 0.7rem 2rem;
            background: var(--accent);
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-submit:hover {
            background: color-mix(in srgb, var(--accent) 85%, black);
            transform: translateY(-1px);
        }
        .btn-submit:active { transform: translateY(0); }

        .alert-success {
            border: 1px solid #22c55e;
            background: color-mix(in srgb, #22c55e 10%, transparent);
            color: #22c55e;
            padding: 1rem 1.25rem;
            border-radius: 8px;
            font-family: var(--mono);
            font-size: 0.78rem;
            margin-bottom: 2rem;
        }

        /* ── FOOTER ── */
        footer {
            padding: 3rem 0 2rem;
        }

        .footer-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .footer-left {
            font-family: var(--mono);
            font-size: 0.72rem;
            color: var(--muted);
        }

        .footer-links {
            display: flex;
            gap: 1.5rem;
        }

        .footer-links a {
            font-family: var(--mono);
            font-size: 0.72rem;
            color: var(--muted);
            text-decoration: none;
            transition: color 0.2s;
        }
        .footer-links a:hover { color: var(--accent); }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .hero-eyebrow { animation: fadeUp 0.5s ease both; }
        .hero-name    { animation: fadeUp 0.5s 0.1s ease both; }
        .hero-desc    { animation: fadeUp 0.5s 0.2s ease both; }
        .hero-meta    { animation: fadeUp 0.5s 0.15s ease both; }

        [x-cloak] { display: none !important; }

        /* ── RESPONSIVE ── */
        @media (max-width: 640px) {
            .hero { grid-template-columns: 1fr; }
            .hero-meta { display: none; }
            .about-grid { grid-template-columns: 1fr; }
            .skills-grid { grid-template-columns: 1fr; }
            .books-grid { grid-template-columns: repeat(2, 1fr); }
            nav { padding: 0.75rem 1rem; }
            .nav-links { display: none; }
            .container { padding: 0 1rem; }
            .form-row { grid-template-columns: 1fr; }
        }

        @media (max-width: 420px) {
            .books-grid { grid-template-columns: 1fr; }
        }

        /* ── MOBILE NAV ── */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: 1px solid var(--border);
            border-radius: 4px;
            padding: 0.35rem 0.6rem;
            cursor: pointer;
            color: var(--muted);
            font-size: 1.1rem;
            transition: all 0.2s;
        }
        .mobile-menu-btn:hover { color: var(--ink); border-color: var(--ink); }

        @media (max-width: 640px) {
            .mobile-menu-btn { display: block; }
        }

        .mobile-nav {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            z-index: 200;
            background: var(--paper);
            padding: 2rem;
            display: flex;
            flex-direction: column;
            gap: 2rem;
            padding-top: 5rem;
        }
        .mobile-nav a {
            font-family: var(--mono);
            font-size: 1rem;
            color: var(--muted);
            text-decoration: none;
            letter-spacing: 0.08em;
            transition: color 0.2s;
            padding: 0.5rem 0;
            border-bottom: 1px solid var(--border);
        }
        .mobile-nav a:hover { color: var(--ink); }
        .mobile-nav-close {
            position: absolute;
            top: 1rem;
            right: 1.5rem;
            background: none;
            border: 1px solid var(--border);
            border-radius: 4px;
            padding: 0.35rem 0.6rem;
            cursor: pointer;
            color: var(--muted);
            font-family: var(--mono);
            font-size: 0.9rem;
        }
        /* ── TOAST ── */
        .toast-container {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }
        .toast {
            background: var(--paper2);
            border: 1px solid var(--border);
            border-left: 4px solid var(--accent);
            padding: 1rem 1.5rem;
            border-radius: 8px;
            color: var(--ink);
            font-family: var(--mono);
            font-size: 0.85rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 1rem;
            animation: slideIn 0.3s ease forwards;
        }
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    </style>
</head>
<body x-data="{ 
    theme: localStorage.getItem('theme') || 'dark',
    mobileNav: false,
    toast: '{{ session('success') }}'
}" 
x-init="
    $watch('theme', val => {
        localStorage.setItem('theme', val);
        document.documentElement.classList.toggle('dark', val === 'dark');
    });
    if(toast) setTimeout(() => toast = '', 4000)
"
:class="theme">

    {{-- NAV --}}
    <nav>
        <a href="{{ route('home') }}" class="nav-logo">{{ strtolower(App\Models\Setting::get('hero_title', 'roshdi')) }}.dev</a>
        <ul class="nav-links">
            <li><a href="{{ route('home') }}#about" class="{{ request()->routeIs('home') ? 'active' : '' }}">about</a></li>
            <li><a href="{{ route('home') }}#skills">skills</a></li>
            <li><a href="{{ route('home') }}#projects">projects</a></li>
            <li><a href="{{ route('home') }}#books">library</a></li>
            <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">contact</a></li>
            @auth
                <li><a href="{{ route('dashboard') }}" style="color: var(--accent);">dashboard</a></li>
            @else
                <li><a href="{{ route('login') }}">login</a></li>
            @endauth
        </ul>

        <div style="display: flex; gap: 0.75rem; align-items: center;">
            <button class="theme-toggle"
                @click="theme = theme === 'dark' ? 'light' : 'dark'">
                <span x-show="theme === 'dark'">☀ light</span>
                <span x-show="theme === 'light'">☾ dark</span>
            </button>
            <button class="mobile-menu-btn" @click="mobileNav = true">☰</button>
        </div>
    </nav>

    {{-- Mobile Nav --}}
    <div class="mobile-nav" x-show="mobileNav" x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click.away="mobileNav = false">
        <button class="mobile-nav-close" @click="mobileNav = false">✕</button>
        <a href="{{ route('home') }}#about" @click="mobileNav = false">about</a>
        <a href="{{ route('home') }}#skills" @click="mobileNav = false">skills</a>
        <a href="{{ route('home') }}#projects" @click="mobileNav = false">projects</a>
        <a href="{{ route('home') }}#books" @click="mobileNav = false">library</a>
        <a href="{{ route('contact') }}" @click="mobileNav = false">contact</a>
        @auth
            <a href="{{ route('dashboard') }}" @click="mobileNav = false">dashboard</a>
        @else
            <a href="{{ route('login') }}" @click="mobileNav = false">login</a>
        @endauth
    </div>

    <main class="container">
        @yield('content')
    </main>

    <footer>
        <div class="container">
            <div class="footer-inner">
                <span class="footer-left">© {{ date('Y') }} — Built with Laravel &amp; Alpine.js</span>
                <div class="footer-links">
                    @if($github = App\Models\Setting::get('github_url'))
                        <a href="{{ $github }}" target="_blank">GitHub</a>
                    @endif
                    @if($linkedin = App\Models\Setting::get('linkedin_url'))
                        <a href="{{ $linkedin }}" target="_blank">LinkedIn</a>
                    @endif
                    @if($email = App\Models\Setting::get('contact_email'))
                        <a href="mailto:{{ $email }}">Email</a>
                    @endif
                </div>
            </div>
        </div>
    </footer>

    {{-- Toast Notification --}}
    <div class="toast-container" x-show="toast" x-transition x-cloak>
        <div class="toast">
            <span style="color: #22c55e;">✓</span>
            <span x-text="toast"></span>
        </div>
    </div>

</body>
</html>
