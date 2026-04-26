@extends('layouts.public', ['title' => 'Contact — Roshdi'])

@section('content')

<section style="padding: 9rem 0 3rem; border-bottom: 1px solid var(--border);">
    <p class="hero-eyebrow" style="animation: fadeUp 0.5s ease both;">// get in touch</p>
    <h1 class="hero-name" style="animation: fadeUp 0.5s 0.1s ease both; font-size: clamp(2.5rem, 6vw, 4rem);">
        Let's <em>Talk</em>
    </h1>
    <p class="hero-desc" style="animation: fadeUp 0.5s 0.2s ease both;">
        Have a project in mind, a question, or just want to say hello?
        Fill out the form below and I'll get back to you as soon as possible.
    </p>
</section>

<section style="border-bottom: none;">
    @if(session('success'))
        <div class="alert-success">
            ✓ {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('contact.store') }}">
        @csrf

        <div class="form-row">
            <div class="form-group">
                <label class="form-label" for="contact-name">Name</label>
                <input class="form-input" type="text" id="contact-name" name="name"
                       value="{{ old('name') }}" placeholder="Your name" required>
                @error('name')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="contact-email">Email</label>
                <input class="form-input" type="email" id="contact-email" name="email"
                       value="{{ old('email') }}" placeholder="you@example.com" required>
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="contact-subject">Subject</label>
            <input class="form-input" type="text" id="contact-subject" name="subject"
                   value="{{ old('subject') }}" placeholder="What's this about?" required>
            @error('subject')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="contact-message">Message</label>
            <textarea class="form-textarea" id="contact-message" name="message"
                      placeholder="Your message..." required>{{ old('message') }}</textarea>
            @error('message')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn-submit">Send Message →</button>
    </form>
</section>

@endsection
