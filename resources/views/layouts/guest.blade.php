<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ theme: localStorage.getItem('theme') || 'dark' }" x-init="$watch('theme', val => { localStorage.setItem('theme', val) })" :class="theme">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Roshdi') }}</title>

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
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        body::before {
            content: '';
            position: fixed; inset: 0;
            background-image:
                linear-gradient(var(--border) 1px, transparent 1px),
                linear-gradient(90deg, var(--border) 1px, transparent 1px);
            background-size: 40px 40px;
            opacity: 0.25;
            pointer-events: none;
            z-index: 0;
        }

        .auth-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 420px;
            padding: 2rem;
        }

        .auth-logo {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        .auth-logo a {
            font-family: var(--mono);
            font-size: 1rem;
            color: var(--accent);
            text-decoration: none;
            letter-spacing: 0.05em;
        }

        .auth-card {
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 2rem;
            background: color-mix(in srgb, var(--paper2) 60%, transparent);
            backdrop-filter: blur(8px);
        }

        .auth-card h2 {
            font-family: var(--serif);
            font-size: 1.6rem;
            margin-bottom: 0.5rem;
        }

        .auth-card p.subtitle {
            font-family: var(--mono);
            font-size: 0.72rem;
            color: var(--muted);
            margin-bottom: 1.75rem;
            letter-spacing: 0.05em;
        }

        .auth-field { margin-bottom: 1.25rem; }
        .auth-label {
            display: block;
            font-family: var(--mono);
            font-size: 0.72rem;
            color: var(--muted);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 0.4rem;
        }
        .auth-input {
            width: 100%;
            background: var(--paper);
            border: 1px solid var(--border);
            border-radius: 6px;
            padding: 0.7rem 0.9rem;
            font-family: var(--sans);
            font-size: 0.95rem;
            color: var(--ink);
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }
        .auth-input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px color-mix(in srgb, var(--accent) 15%, transparent);
        }
        .auth-input::placeholder { color: var(--muted); opacity: 0.5; }

        .auth-error {
            font-family: var(--mono);
            font-size: 0.68rem;
            color: var(--accent);
            margin-top: 0.3rem;
        }

        .auth-remember {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.25rem;
        }
        .auth-remember input[type="checkbox"] {
            width: 16px; height: 16px;
            accent-color: var(--accent);
            cursor: pointer;
        }
        .auth-remember label {
            font-family: var(--mono);
            font-size: 0.72rem;
            color: var(--muted);
            cursor: pointer;
        }

        .auth-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .auth-link {
            font-family: var(--mono);
            font-size: 0.72rem;
            color: var(--muted);
            text-decoration: none;
            transition: color 0.2s;
        }
        .auth-link:hover { color: var(--accent); }

        .auth-btn {
            font-family: var(--mono);
            font-size: 0.78rem;
            letter-spacing: 0.08em;
            padding: 0.65rem 1.5rem;
            background: var(--accent);
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .auth-btn:hover {
            background: color-mix(in srgb, var(--accent) 85%, black);
            transform: translateY(-1px);
        }

        .auth-footer {
            text-align: center;
            margin-top: 1.5rem;
            font-family: var(--mono);
            font-size: 0.72rem;
            color: var(--muted);
        }
        .auth-footer a {
            color: var(--accent);
            text-decoration: none;
        }
        .auth-footer a:hover { text-decoration: underline; }

        .auth-status {
            font-family: var(--mono);
            font-size: 0.78rem;
            color: #22c55e;
            margin-bottom: 1rem;
            padding: 0.75rem 1rem;
            border: 1px solid #22c55e;
            border-radius: 8px;
            background: color-mix(in srgb, #22c55e 10%, transparent);
        }

        .theme-toggle-mini {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 10;
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
        .theme-toggle-mini:hover { color: var(--ink); border-color: var(--ink); }

        [x-cloak] { display: none !important; }
    </style>
</head>
<body>
    <button class="theme-toggle-mini"
        @click="theme = theme === 'dark' ? 'light' : 'dark'">
        <span x-show="theme === 'dark'">☀</span>
        <span x-show="theme === 'light'">☾</span>
    </button>

    <div class="auth-wrapper">
        <div class="auth-logo">
            <a href="{{ route('home') }}">roshdi.dev</a>
        </div>
        <div class="auth-card">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
