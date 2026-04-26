@extends('layouts.app', ['title' => 'Your Name — Laravel Developer'])

@section('content')

{{-- ══════════════════════════════════
     HERO
══════════════════════════════════ --}}
<section class="hero" id="top">
    <div class="hero-left">
        <p class="hero-eyebrow">// laravel developer</p>
        <h1 class="hero-name">
            Your<br>
            <em>Name</em><br>
            Here
        </h1>
        <p class="hero-desc">
            I build robust, elegant backends with Laravel and craft seamless APIs.
            Based in the West Bank — writing code, reading books, thinking deeply.
        </p>
    </div>

    <div class="hero-meta">
        <div class="hero-status">
            <span class="status-dot"></span>
            open to work
        </div>
        <div class="hero-year">{{ date('Y') }}</div>
    </div>
</section>


{{-- ══════════════════════════════════
     ABOUT
══════════════════════════════════ --}}
<section id="about">
    <div class="section-header">
        <span class="section-num">01</span>
        <h2 class="section-title">About</h2>
    </div>

    <div class="about-grid">
        <div class="about-text">
            <p>
                I'm a Laravel developer with a deep appreciation for clean architecture, meaningful abstractions, and code that reads like prose. I believe the backend is not just infrastructure — it's the backbone of every great product.
            </p>
            <p>
                When I'm not designing systems and writing PHP, I'm usually in the middle of a book. I treat reading and programming with the same discipline: always improving, always questioning defaults.
            </p>
            <p>
                My work philosophy: <em>simplicity is the hardest thing to build</em>.
            </p>
        </div>

        <div class="about-facts">
            <div class="fact-item">
                <div class="fact-label">Location</div>
                <div class="fact-value">West Bank, Palestine 🇵🇸</div>
            </div>
            <div class="fact-item">
                <div class="fact-label">Primary Stack</div>
                <div class="fact-value">Laravel + Alpine.js + Livewire</div>
            </div>
            <div class="fact-item">
                <div class="fact-label">Experience</div>
                <div class="fact-value">4+ years shipping products</div>
            </div>
            <div class="fact-item">
                <div class="fact-label">Currently</div>
                <div class="fact-value">Building & open to opportunities</div>
            </div>
            <div class="fact-item">
                <div class="fact-label">Languages</div>
                <div class="fact-value">Arabic · English</div>
            </div>
        </div>
    </div>
</section>


{{-- ══════════════════════════════════
     SKILLS
══════════════════════════════════ --}}
<section id="skills">
    <div class="section-header">
        <span class="section-num">02</span>
        <h2 class="section-title">Skills</h2>
    </div>

    <div class="skills-grid">
        <div class="skill-group">
            <div class="skill-group-label">// Backend</div>
            <div class="skill-tags">
                @foreach(['Laravel', 'PHP 8.x', 'Livewire', 'Eloquent ORM', 'REST APIs', 'Queue & Jobs', 'Events & Listeners', 'Artisan CLI'] as $skill)
                    <span class="skill-tag">{{ $skill }}</span>
                @endforeach
            </div>
        </div>

        <div class="skill-group">
            <div class="skill-group-label">// Frontend</div>
            <div class="skill-tags">
                @foreach(['Alpine.js', 'Blade', 'Livewire', 'Tailwind CSS', 'Inertia.js', 'Vite', 'Vue.js'] as $skill)
                    <span class="skill-tag">{{ $skill }}</span>
                @endforeach
            </div>
        </div>

        <div class="skill-group">
            <div class="skill-group-label">// Database & Infra</div>
            <div class="skill-tags">
                @foreach(['MySQL', 'PostgreSQL', 'Redis', 'Docker', 'Linux', 'Nginx', 'GitHub Actions', 'Forge'] as $skill)
                    <span class="skill-tag">{{ $skill }}</span>
                @endforeach
            </div>
        </div>

        <div class="skill-group">
            <div class="skill-group-label">// Principles</div>
            <div class="skill-tags">
                @foreach(['SOLID', 'DDD', 'TDD', 'Clean Architecture', 'API Design', 'Code Review', 'Documentation'] as $skill)
                    <span class="skill-tag">{{ $skill }}</span>
                @endforeach
            </div>
        </div>
    </div>
</section>


{{-- ══════════════════════════════════
     PROJECTS
══════════════════════════════════ --}}
<section id="projects">
    <div class="section-header">
        <span class="section-num">03</span>
        <h2 class="section-title">Projects</h2>
    </div>

    <div class="projects-list">

        @php
        $projects = [
            [
                'name'  => 'Sanad — Project Management SaaS',
                'stack' => 'Laravel · Livewire · Alpine · MySQL',
                'url'   => '#',
            ],
            [
                'name'  => 'Noor — E-commerce Platform',
                'stack' => 'Laravel · Inertia.js · Vue · Stripe',
                'url'   => '#',
            ],
            [
                'name'  => 'Maktaba — Books API',
                'stack' => 'Laravel · REST API · Redis · OpenLibrary',
                'url'   => '#',
            ],
            [
                'name'  => 'Multitenant CMS Boilerplate',
                'stack' => 'Laravel · Tenancy for Laravel · Forge',
                'url'   => '#',
            ],
            [
                'name'  => 'Open Source: laravel-audit-trail',
                'stack' => 'PHP Package · Packagist · 400+ installs',
                'url'   => '#',
            ],
        ];
        @endphp

        @foreach($projects as $i => $project)
            <a href="{{ $project['url'] }}" class="project-item" target="_blank">
                <span class="project-num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                <div class="project-info">
                    <div class="project-name">{{ $project['name'] }}</div>
                    <div class="project-stack">{{ $project['stack'] }}</div>
                </div>
                <span class="project-arrow">→</span>
            </a>
        @endforeach

    </div>
</section>


{{-- ══════════════════════════════════
     BOOKS / LIBRARY
══════════════════════════════════ --}}
<section id="books" x-data="{ tab: 'reading' }">
    <div class="section-header">
        <span class="section-num">04</span>
        <h2 class="section-title">Library</h2>
    </div>

    {{-- Tabs --}}
    <div class="books-tabs" role="tablist">
        <button class="book-tab"
            role="tab"
            :aria-selected="tab === 'reading'"
            @click="tab = 'reading'">
            Reading now
        </button>
        <button class="book-tab"
            role="tab"
            :aria-selected="tab === 'read'"
            @click="tab = 'read'">
            Have read
        </button>
        <button class="book-tab"
            role="tab"
            :aria-selected="tab === 'want'"
            @click="tab = 'want'">
            Want to read
        </button>
    </div>

    {{-- Reading Now --}}
    <div x-show="tab === 'reading'" x-transition:enter="fadeUp" class="books-grid">
        @php
        $reading = [
            ['title' => 'A Philosophy of Software Design', 'author' => 'John Ousterhout', 'progress' => 70],
            ['title' => 'The Pragmatic Programmer', 'author' => 'Hunt & Thomas', 'progress' => 45],
            ['title' => 'The Remains of the Day', 'author' => 'Kazuo Ishiguro', 'progress' => 30],
        ];
        @endphp

        @foreach($reading as $book)
        <div class="book-card">
            <span class="book-badge badge-reading">reading</span>
            <div class="book-title">{{ $book['title'] }}</div>
            <div class="book-author">{{ $book['author'] }}</div>
            <div class="reading-progress">
                <div class="reading-progress-bar" style="width: {{ $book['progress'] }}%"></div>
            </div>
            <div style="font-family: var(--mono); font-size: 0.62rem; color: var(--muted); margin-top: 0.35rem;">
                {{ $book['progress'] }}% complete
            </div>
        </div>
        @endforeach
    </div>

    {{-- Have Read --}}
    <div x-show="tab === 'read'" x-transition:enter="fadeUp" class="books-grid">
        @php
        $read = [
            ['title' => 'Clean Code', 'author' => 'Robert C. Martin'],
            ['title' => 'Domain-Driven Design', 'author' => 'Eric Evans'],
            ['title' => 'The Alchemist', 'author' => 'Paulo Coelho'],
            ['title' => 'Refactoring', 'author' => 'Martin Fowler'],
            ['title' => 'Laravel: Up & Running', 'author' => 'Matt Stauffer'],
            ['title' => 'Sapiens', 'author' => 'Yuval Noah Harari'],
        ];
        @endphp

        @foreach($read as $book)
        <div class="book-card">
            <span class="book-badge badge-read">finished</span>
            <div class="book-title">{{ $book['title'] }}</div>
            <div class="book-author">{{ $book['author'] }}</div>
        </div>
        @endforeach
    </div>

    {{-- Want to Read --}}
    <div x-show="tab === 'want'" x-transition:enter="fadeUp" class="books-grid">
        @php
        $want = [
            ['title' => 'Structure and Interpretation of Computer Programs', 'author' => 'Abelson & Sussman'],
            ['title' => 'The Mythical Man-Month', 'author' => 'Fred Brooks'],
            ['title' => 'Designing Data-Intensive Applications', 'author' => 'Martin Kleppmann'],
            ['title' => 'Working in Public', 'author' => 'Nadia Eghbal'],
            ['title' => 'The Art of Thinking Clearly', 'author' => 'Rolf Dobelli'],
        ];
        @endphp

        @foreach($want as $book)
        <div class="book-card">
            <span class="book-badge badge-want">on the list</span>
            <div class="book-title">{{ $book['title'] }}</div>
            <div class="book-author">{{ $book['author'] }}</div>
        </div>
        @endforeach
    </div>

</section>

@endsection
