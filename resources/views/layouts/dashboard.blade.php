<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ theme: localStorage.getItem('theme') || 'dark', sidebarOpen: false }" x-init="$watch('theme', val => { localStorage.setItem('theme', val) })" :class="theme">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Dashboard' }} — {{ config('app.name') }}</title>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Geist+Mono:wght@300;400;500&family=Instrument+Sans:ital,wght@0,400;0,500;1,400&display=swap" rel="stylesheet">

    <style>
        :root {
            --ink: #0f0e0c; --paper: #f5f2eb; --paper2: #ede9e0;
            --accent: #c84b2f; --accent2: #2f6bc8; --muted: #8a8479; --border: #d4cfc4;
            --serif: 'DM Serif Display', Georgia, serif;
            --mono: 'Geist Mono', monospace;
            --sans: 'Instrument Sans', sans-serif;
        }
        .dark {
            --ink: #f0ece3; --paper: #100f0d; --paper2: #1a1916;
            --accent: #e8694a; --accent2: #5b9cf6; --muted: #6b6760; --border: #2a2925;
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

        body::before {
            content: '';
            position: fixed; inset: 0;
            background-image:
                linear-gradient(var(--border) 1px, transparent 1px),
                linear-gradient(90deg, var(--border) 1px, transparent 1px);
            background-size: 40px 40px;
            opacity: 0.15;
            pointer-events: none;
            z-index: 0;
        }

        /* ── DASHBOARD LAYOUT ── */
        .dash-layout {
            display: grid;
            grid-template-columns: 240px 1fr;
            min-height: 100vh;
            position: relative;
            z-index: 1;
        }

        @media (max-width: 768px) {
            .dash-layout { grid-template-columns: 1fr; }
        }

        /* ── SIDEBAR ── */
        .dash-sidebar {
            border-right: 1px solid var(--border);
            padding: 1.5rem 0;
            position: sticky;
            top: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        @media (max-width: 768px) {
            .dash-sidebar {
                position: fixed;
                top: 0; left: 0; bottom: 0;
                width: 260px;
                background: var(--paper);
                z-index: 200;
                transform: translateX(-100%);
                transition: transform 0.2s ease;
            }
            .dash-sidebar.open { transform: translateX(0); }
            .dash-overlay {
                position: fixed; inset: 0;
                background: rgba(0,0,0,0.4);
                z-index: 199;
            }
        }

        .dash-brand {
            padding: 0 1.5rem 1.5rem;
            border-bottom: 1px solid var(--border);
            margin-bottom: 1rem;
        }
        .dash-brand a {
            font-family: var(--mono);
            font-size: 0.85rem;
            color: var(--accent);
            text-decoration: none;
            letter-spacing: 0.05em;
        }

        .dash-nav { flex: 1; padding: 0 0.75rem; }
        .dash-nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.65rem 0.75rem;
            border-radius: 6px;
            font-family: var(--mono);
            font-size: 0.78rem;
            color: var(--muted);
            text-decoration: none;
            transition: all 0.15s;
            margin-bottom: 0.2rem;
            letter-spacing: 0.03em;
        }
        .dash-nav-item:hover { background: var(--paper2); color: var(--ink); }
        .dash-nav-item.active {
            background: color-mix(in srgb, var(--accent) 12%, transparent);
            color: var(--accent);
        }
        .dash-nav-icon { font-size: 1rem; width: 1.25rem; text-align: center; }

        .dash-nav-section {
            font-family: var(--mono);
            font-size: 0.62rem;
            color: var(--muted);
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 1rem 0.75rem 0.4rem;
        }

        .dash-user {
            border-top: 1px solid var(--border);
            padding: 1rem 1.5rem 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .dash-user-info {
            display: flex;
            flex-direction: column;
        }
        .dash-user-name {
            font-family: var(--mono);
            font-size: 0.78rem;
            color: var(--ink);
        }
        .dash-user-email {
            font-family: var(--mono);
            font-size: 0.62rem;
            color: var(--muted);
        }

        .dash-logout {
            font-family: var(--mono);
            font-size: 0.68rem;
            color: var(--muted);
            background: none;
            border: 1px solid var(--border);
            border-radius: 4px;
            padding: 0.3rem 0.6rem;
            cursor: pointer;
            transition: all 0.2s;
        }
        .dash-logout:hover { color: var(--accent); border-color: var(--accent); }

        /* ── MAIN CONTENT ── */
        .dash-main-container {
            display: flex;
            gap: 3rem;
            align-items: flex-start;
        }

        .dash-content-area {
            flex: 1;
            max-width: 900px;
        }

        .dash-mascot-area {
            width: 320px;
            position: sticky;
            top: 7rem;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            animation: fadeUp 0.6s 0.2s ease both;
        }

        .king-card-wrap {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid var(--border);
            box-shadow: 0 20px 40px -10px rgba(0,0,0,0.2);
            transition: transform 0.3s ease, border-color 0.3s;
            background: var(--paper2);
        }
        .king-card-wrap:hover {
            transform: translateY(-5px) rotate(1deg);
            border-color: var(--accent);
        }
        .king-card-img {
            width: 100%;
            display: block;
            mix-blend-mode: multiply;
            opacity: 0.9;
        }
        .dark .king-card-img { mix-blend-mode: normal; opacity: 0.8; }

        .mascot-label {
            font-family: var(--mono);
            font-size: 0.62rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.2em;
            text-align: center;
        }

        @media (max-width: 1200px) {
            .dash-mascot-area { display: none; }
        }

        .dash-main {
            padding: 2rem;
            flex: 1;
        }

        .dash-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border);
        }

        .dash-topbar h1 {
            font-family: var(--serif);
            font-size: 1.6rem;
        }

        .dash-mobile-toggle {
            display: none;
            background: none;
            border: 1px solid var(--border);
            border-radius: 4px;
            padding: 0.35rem 0.6rem;
            cursor: pointer;
            color: var(--muted);
            font-size: 1.1rem;
        }
        @media (max-width: 768px) {
            .dash-mobile-toggle { display: block; }
        }

        /* ── STAT CARDS ── */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }
        .stat-card {
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 1.25rem;
            transition: border-color 0.2s;
        }
        .stat-card:hover { border-color: var(--accent); }
        .stat-label {
            font-family: var(--mono);
            font-size: 0.68rem;
            color: var(--muted);
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }
        .stat-value {
            font-family: var(--serif);
            font-size: 2rem;
            line-height: 1.2;
        }

        /* ── MESSAGE TABLE ── */
        .msg-list { display: flex; flex-direction: column; }
        .msg-item {
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 1rem;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid var(--border);
        }
        .msg-item:first-child { border-top: 1px solid var(--border); }

        .msg-dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            background: var(--accent);
            flex-shrink: 0;
        }
        .msg-dot.read { background: var(--border); }

        .msg-info {}
        .msg-name {
            font-size: 0.95rem;
            font-weight: 500;
            margin-bottom: 0.1rem;
        }
        .msg-subject {
            font-family: var(--mono);
            font-size: 0.72rem;
            color: var(--muted);
        }
        .msg-date {
            font-family: var(--mono);
            font-size: 0.68rem;
            color: var(--muted);
            white-space: nowrap;
        }
        .msg-actions {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }
        .msg-btn {
            font-family: var(--mono);
            font-size: 0.62rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            padding: 0.4rem 0.8rem;
            border: 1px solid var(--border);
            border-radius: 4px;
            background: none;
            color: var(--muted);
            cursor: pointer;
            transition: all 0.15s;
        }
        .msg-btn:hover {
            border-color: var(--ink);
            color: var(--ink);
            background: var(--paper2);
        }
        .msg-btn.danger:hover {
            border-color: #ef4444;
            color: #ef4444;
            background: color-mix(in srgb, #ef4444 8%, transparent);
        }

        /* ── MESSAGE DETAIL ── */
        .msg-detail {
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 1.5rem;
            margin-top: 1rem;
        }
        .msg-detail-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border);
        }
        .msg-detail-body {
            color: var(--muted);
            line-height: 1.8;
        }

        /* ── ALERT ── */
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

        /* ── MODAL ── */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            z-index: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        .modal-content {
            background: var(--paper);
            border: 1px solid var(--border);
            border-radius: 12px;
            width: 100%;
            max-width: 500px;
            padding: 2rem;
            position: relative;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 1.5rem;
            border-bottom: 1px solid var(--border);
            padding-bottom: 1rem;
        }
        .modal-title { font-family: var(--serif); font-size: 1.5rem; }
        .modal-close {
            background: none;
            border: none;
            color: var(--muted);
            cursor: pointer;
            font-size: 1.25rem;
        }

        .dash-alert { display: none; } /* Hide old alerts */

        .theme-toggle {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--muted);
            font-family: var(--mono);
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            padding: 0.5rem 0.75rem;
            transition: all 0.25s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border-bottom: 1px solid transparent;
        }
        .theme-toggle:hover {
            color: var(--ink);
            background: var(--paper2);
            border-radius: 4px;
        }

        [x-cloak] { display: none !important; }

        /* ── EMPTY STATE ── */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--muted);
        }
        .empty-state-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            opacity: 0.4;
        }
        .empty-state p {
            font-family: var(--mono);
            font-size: 0.78rem;
        }

        /* ── BUTTONS ── */
        .btn-icon {
            background: none;
            border: 1px solid var(--border);
            border-radius: 6px;
            width: 32px; height: 32px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            color: var(--muted);
            transition: all 0.2s;
        }
        .btn-icon:hover { border-color: var(--accent); color: var(--accent); background: var(--paper2); }

        .btn-submit {
            font-family: var(--mono);
            font-size: 0.68rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.75rem 1.75rem;
            background: var(--ink);
            color: var(--paper);
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-submit:hover {
            opacity: 0.85;
            transform: translateY(-1px);
        }

        /* ── FORMS ── */
        .form-group { margin-bottom: 1.5rem; }
        .form-label {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-family: var(--mono);
            font-size: 0.62rem;
            font-weight: 500;
            color: var(--muted);
            letter-spacing: 0.12em;
            text-transform: uppercase;
            margin-bottom: 0.65rem;
        }
        .form-label::before {
            content: '';
            width: 5px; height: 5px;
            background: var(--accent);
            border-radius: 50%;
            display: block;
        }
        .form-input, .form-textarea, select.form-input {
            width: 100%;
            background: var(--paper2);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-family: var(--sans);
            font-size: 0.92rem;
            color: var(--ink);
            transition: all 0.2s ease;
            outline: none;
            display: block;
        }
        .form-input:focus, .form-textarea:focus {
            border-color: var(--accent);
            background: var(--paper);
            box-shadow: 0 0 0 3px color-mix(in srgb, var(--accent) 15%, transparent);
        }
        .form-textarea { min-height: 120px; resize: vertical; }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }
    </style>
</head>
<body x-data="{ 
    theme: localStorage.getItem('theme') || 'dark', 
    sidebarOpen: false,
    showMascot: localStorage.getItem('showMascot') !== 'false',
    toast: '{{ session('success') }}'
}" 
x-init="
    $watch('theme', val => { localStorage.setItem('theme', val) });
    $watch('showMascot', val => { localStorage.setItem('showMascot', val) });
    if(toast) setTimeout(() => toast = '', 4000)
" 
:class="theme">
    <div class="dash-layout">
        {{-- Mobile overlay --}}
        <div class="dash-overlay" x-show="sidebarOpen" x-cloak @click="sidebarOpen = false"
             style="display:none;" x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

        {{-- Sidebar --}}
        <aside class="dash-sidebar" :class="{ 'open': sidebarOpen }">
            <div class="dash-brand">
                <a href="{{ route('home') }}">roshdi.dev</a>
            </div>

            <nav class="dash-nav">
                <div class="dash-nav-section">Main</div>
                <a href="{{ route('dashboard') }}" class="dash-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <span class="dash-nav-icon">◈</span>
                    Dashboard
                </a>
                <a href="{{ route('dashboard.messages') }}" class="dash-nav-item {{ request()->routeIs('dashboard.messages') ? 'active' : '' }}">
                    <span class="dash-nav-icon">✉</span>
                    Messages
                </a>

                <div class="dash-nav-section">Portfolio</div>
                <a href="{{ route('dashboard.portfolio.hero') }}" class="dash-nav-item {{ request()->routeIs('dashboard.portfolio.hero') ? 'active' : '' }}">
                    <span class="dash-nav-icon">✧</span>
                    Hero Section
                </a>
                <a href="{{ route('dashboard.portfolio.about') }}" class="dash-nav-item {{ request()->routeIs('dashboard.portfolio.about') ? 'active' : '' }}">
                    <span class="dash-nav-icon">👤</span>
                    About Section
                </a>
                <a href="{{ route('dashboard.portfolio.skills') }}" class="dash-nav-item {{ request()->routeIs('dashboard.portfolio.skills') ? 'active' : '' }}">
                    <span class="dash-nav-icon">⚛</span>
                    Skills
                </a>
                <a href="{{ route('dashboard.portfolio.projects') }}" class="dash-nav-item {{ request()->routeIs('dashboard.portfolio.projects') ? 'active' : '' }}">
                    <span class="dash-nav-icon">▤</span>
                    Projects
                </a>
                <a href="{{ route('dashboard.portfolio.library') }}" class="dash-nav-item {{ request()->routeIs('dashboard.portfolio.library') ? 'active' : '' }}">
                    <span class="dash-nav-icon">✎</span>
                    Library
                </a>

                <div class="dash-nav-section">Account</div>
                <a href="{{ route('profile.edit') }}" class="dash-nav-item {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                    <span class="dash-nav-icon">⚙</span>
                    Profile
                </a>
                <a href="{{ route('home') }}" class="dash-nav-item">
                    <span class="dash-nav-icon">↗</span>
                    View Site
                </a>
            </nav>

            <div class="dash-user">
                <div class="dash-user-info">
                    <span class="dash-user-name">{{ Auth::user()->name }}</span>
                    <span class="dash-user-email">{{ Auth::user()->email }}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dash-logout">logout</button>
                </form>
            </div>
        </aside>

        {{-- Main Content --}}
        <div class="dash-main">
            <div class="dash-topbar">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <button class="dash-mobile-toggle" @click="sidebarOpen = !sidebarOpen">☰</button>
                    <h1>@yield('page-title', 'Dashboard')</h1>
                </div>
                
                <div style="display: flex; gap: 0.75rem; align-items: center;">
                    <button class="theme-toggle" @click="showMascot = !showMascot">
                        <span x-show="showMascot">✕ hide mascot</span>
                        <span x-show="!showMascot">👑 show mascot</span>
                    </button>
                    <button class="theme-toggle"
                        @click="theme = theme === 'dark' ? 'light' : 'dark'">
                        <span x-show="theme === 'dark'">☀ light</span>
                        <span x-show="theme === 'light'">☾ dark</span>
                    </button>
                </div>
            </div>

            <div class="dash-main-container">
                <div class="dash-content-area">
                    @yield('dashboard-content')
                </div>

                <div class="dash-mascot-area" x-show="showMascot" x-cloak x-transition>
                    <div class="mascot-label">// king of developers</div>
                    <div class="king-card-wrap">
                        <img src="{{ asset('assets/img/king-card.png') }}" alt="King Card Mascot" class="king-card-img">
                    </div>
                    <div style="font-family: var(--serif); font-size: 0.9rem; text-align: center; color: var(--muted); padding: 0 1rem;">
                        "The backbone of every product is a robust backend."
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Toast Notification --}}
    <div class="toast-container" x-show="toast" x-transition x-cloak>
        <div class="toast">
            <span style="color: #22c55e;">✓</span>
            <span x-text="toast"></span>
        </div>
    </div>
</body>
</html>
