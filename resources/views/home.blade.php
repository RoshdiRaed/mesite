@extends('layouts.public', ['title' => ($settings['hero_title'] ?? 'Roshdi') . ' — ' . ($settings['hero_subtitle'] ?? 'Laravel Developer')])

@section('content')

{{-- ══════════════════════════════════
     HERO
══════════════════════════════════ --}}
<section class="hero" id="top">
    <div class="hero-left">
        <p class="hero-eyebrow">// {{ strtolower($settings['hero_subtitle'] ?? 'laravel developer') }}</p>
        <h1 class="hero-name">
            {{ $settings['hero_title'] ?? 'Roshdi' }}<br>
            <em>{{ $settings['hero_subtitle'] ?? 'Developer' }}</em>
        </h1>
        <p class="hero-desc">
            {{ $settings['hero_description'] ?? 'I build robust, elegant backends with Laravel and craft seamless APIs.' }}
        </p>
    </div>

    <div class="hero-meta">
        <div class="hero-status">
            <span class="status-dot"></span>
            {{ $settings['status'] ?? 'open to work' }}
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
            @foreach(explode("\n\n", $settings['about_text'] ?? "I'm a Laravel developer...") as $paragraph)
                <p>{!! nl2br(e($paragraph)) !!}</p>
            @endforeach
        </div>

        <div class="about-facts">
            <div class="fact-item">
                <div class="fact-label">Location</div>
                <div class="fact-value">{{ $settings['location'] ?? 'West Bank, Palestine' }}</div>
            </div>
            <div class="fact-item">
                <div class="fact-label">Primary Stack</div>
                <div class="fact-value">{{ $settings['primary_stack'] ?? 'Laravel + Alpine.js' }}</div>
            </div>
            <div class="fact-item">
                <div class="fact-label">Experience</div>
                <div class="fact-value">{{ $settings['experience'] ?? '4+ years' }}</div>
            </div>
            <div class="fact-item">
                <div class="fact-label">Currently</div>
                <div class="fact-value">{{ $settings['status'] ?? 'Building' }}</div>
            </div>
            <div class="fact-item">
                <div class="fact-label">Languages</div>
                <div class="fact-value">{{ $settings['languages'] ?? 'Arabic · English' }}</div>
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
        @foreach($skills as $group => $groupSkills)
        <div class="skill-group">
            <div class="skill-group-label">// {{ $group }}</div>
            <div class="skill-tags">
                @foreach($groupSkills as $skill)
                    <span class="skill-tag">{{ $skill->name }}</span>
                @endforeach
            </div>
        </div>
        @endforeach
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
        @foreach($projects as $i => $project)
            <a href="{{ $project->url ?? '#' }}" class="project-item">
                <span class="project-num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                <div class="project-info">
                    <div class="project-name">{{ $project->name }}</div>
                    <div class="project-stack">{{ $project->stack }}</div>
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
        <button class="book-tab" role="tab"
            :aria-selected="tab === 'reading'"
            x-on:click="tab = 'reading'">
            Reading now
        </button>
        <button class="book-tab" role="tab"
            :aria-selected="tab === 'read'"
            x-on:click="tab = 'read'">
            Have read
        </button>
        <button class="book-tab" role="tab"
            :aria-selected="tab === 'want'"
            x-on:click="tab = 'want'">
            Want to read
        </button>
    </div>

    {{-- Reading Now --}}
    <div x-show="tab === 'reading'" x-transition class="books-grid">
        @if(isset($books['reading']))
            @foreach($books['reading'] as $book)
            <div class="book-card">
                <span class="book-badge badge-reading">reading</span>
                <div class="book-title">{{ $book->title }}</div>
                <div class="book-author">{{ $book->author }}</div>
                <div class="reading-progress">
                    <div class="reading-progress-bar" style="width: {{ $book->progress }}%"></div>
                </div>
                <div class="progress-pct">{{ $book->progress }}% complete</div>
            </div>
            @endforeach
        @else
            <p style="grid-column: span 3; text-align: center; color: var(--muted); padding: 2rem;">No books in this section.</p>
        @endif
    </div>

    {{-- Have Read --}}
    <div x-show="tab === 'read'" x-transition class="books-grid">
        @if(isset($books['read']))
            @foreach($books['read'] as $book)
            <div class="book-card">
                <span class="book-badge badge-read">finished</span>
                <div class="book-title">{{ $book->title }}</div>
                <div class="book-author">{{ $book->author }}</div>
            </div>
            @endforeach
        @else
            <p style="grid-column: span 3; text-align: center; color: var(--muted); padding: 2rem;">No books in this section.</p>
        @endif
    </div>

    {{-- Want to Read --}}
    <div x-show="tab === 'want'" x-transition class="books-grid">
        @if(isset($books['want']))
            @foreach($books['want'] as $book)
            <div class="book-card">
                <span class="book-badge badge-want">on the list</span>
                <div class="book-title">{{ $book->title }}</div>
                <div class="book-author">{{ $book->author }}</div>
            </div>
            @endforeach
        @else
            <p style="grid-column: span 3; text-align: center; color: var(--muted); padding: 2rem;">No books in this section.</p>
        @endif
    </div>
</section>

@endsection
