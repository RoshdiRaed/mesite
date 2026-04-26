@extends('layouts.public', ['title' => '404 — Page Not Found'])

@section('content')

<section style="padding: 12rem 0; text-align: center; border-bottom: none;">
    <p class="hero-eyebrow" style="animation: fadeUp 0.5s ease both;">// error 404</p>
    <h1 class="hero-name" style="animation: fadeUp 0.5s 0.1s ease both; font-size: clamp(4rem, 15vw, 10rem);">
        <em>Lost</em>
    </h1>
    <p class="hero-desc" style="animation: fadeUp 0.5s 0.2s ease both; margin: 0 auto 2.5rem; max-width: 400px;">
        The page you are looking for has been moved, deleted, or never existed in this dimension.
    </p>
    
    <div style="animation: fadeUp 0.5s 0.3s ease both;">
        <a href="{{ route('home') }}" class="btn-submit" style="text-decoration: none; display: inline-block;">
            Return to Reality
        </a>
    </div>
</section>

@endsection
