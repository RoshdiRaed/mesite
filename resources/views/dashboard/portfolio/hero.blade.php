@extends('layouts.dashboard', ['title' => 'Hero Customization'])

@section('page-title', 'Hero Section')

@section('dashboard-content')

<div style="max-width: 700px; animation: fadeUp 0.4s ease both;">
    <p style="color: var(--muted); font-family: var(--mono); font-size: 0.85rem; margin-bottom: 2.5rem;">
        The Hero section is the first thing visitors see. Keep it punchy and professional.
    </p>

    <form method="POST" action="{{ route('dashboard.portfolio.settings.update') }}">
        @csrf

        <div style="border: 1px solid var(--border); border-radius: 12px; padding: 2rem; background: color-mix(in srgb, var(--paper2) 30%, transparent);">
            <div class="form-group">
                <label class="form-label">Main Title / Name</label>
                <input type="text" name="hero_title" class="form-input" value="{{ $settings['hero_title'] ?? '' }}" placeholder="e.g. Roshdi">
            </div>

            <div class="form-group">
                <label class="form-label">Subtitle / Role</label>
                <input type="text" name="hero_subtitle" class="form-input" value="{{ $settings['hero_subtitle'] ?? '' }}" placeholder="e.g. Laravel Developer">
            </div>

            <div class="form-group">
                <label class="form-label">Hero Description</label>
                <textarea name="hero_description" class="form-textarea" style="min-height: 120px;" placeholder="I build robust, elegant backends...">{{ $settings['hero_description'] ?? '' }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Availability Status</label>
                <input type="text" name="status" class="form-input" value="{{ $settings['status'] ?? '' }}" placeholder="e.g. building & open to work">
            </div>
        </div>

        <div style="margin-top: 2rem; text-align: right;">
            <button type="submit" class="btn-submit" style="padding: 0.8rem 3rem;">
                Update Hero Section
            </button>
        </div>
    </form>
</div>

@endsection
