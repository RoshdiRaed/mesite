@extends('layouts.dashboard', ['title' => 'About Customization'])

@section('page-title', 'About Section')

@section('dashboard-content')

<div style="animation: fadeUp 0.4s ease both;">
    <p style="color: var(--muted); font-family: var(--mono); font-size: 0.85rem; margin-bottom: 2.5rem;">
        Detailed information about your background, location, and social presence.
    </p>

    <form method="POST" action="{{ route('dashboard.portfolio.settings.update') }}">
        @csrf

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
            
            {{-- Long Bio --}}
            <div style="border: 1px solid var(--border); border-radius: 12px; padding: 2rem; background: color-mix(in srgb, var(--paper2) 30%, transparent);">
                <h3 style="font-family: var(--serif); font-size: 1.2rem; margin-bottom: 1.5rem;">Biography</h3>
                <div class="form-group">
                    <label class="form-label">Full About Text (Use double line breaks for paragraphs)</label>
                    <textarea name="about_text" class="form-textarea" style="min-height: 300px;">{{ $settings['about_text'] ?? '' }}</textarea>
                </div>
            </div>

            <div style="display: flex; flex-direction: column; gap: 2rem;">
                {{-- Quick Facts --}}
                <div style="border: 1px solid var(--border); border-radius: 12px; padding: 2rem; background: color-mix(in srgb, var(--paper2) 30%, transparent);">
                    <h3 style="font-family: var(--serif); font-size: 1.2rem; margin-bottom: 1.5rem;">Quick Facts</h3>
                    
                    <div class="form-group">
                        <label class="form-label">Location</label>
                        <input type="text" name="location" class="form-input" value="{{ $settings['location'] ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Primary Stack</label>
                        <input type="text" name="primary_stack" class="form-input" value="{{ $settings['primary_stack'] ?? '' }}">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Experience</label>
                            <input type="text" name="experience" class="form-input" value="{{ $settings['experience'] ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Languages</label>
                            <input type="text" name="languages" class="form-input" value="{{ $settings['languages'] ?? '' }}">
                        </div>
                    </div>
                </div>

                {{-- Social & Contact --}}
                <div style="border: 1px solid var(--border); border-radius: 12px; padding: 2rem; background: color-mix(in srgb, var(--paper2) 30%, transparent);">
                    <h3 style="font-family: var(--serif); font-size: 1.2rem; margin-bottom: 1.5rem;">Social & Footer</h3>
                    
                    <div class="form-group">
                        <label class="form-label">GitHub URL</label>
                        <input type="text" name="github_url" class="form-input" value="{{ $settings['github_url'] ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">LinkedIn URL</label>
                        <input type="text" name="linkedin_url" class="form-input" value="{{ $settings['linkedin_url'] ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Contact Email</label>
                        <input type="text" name="contact_email" class="form-input" value="{{ $settings['contact_email'] ?? '' }}">
                    </div>
                </div>
            </div>

        </div>

        <div style="margin-top: 2.5rem; text-align: right;">
            <button type="submit" class="btn-submit" style="padding: 0.8rem 3rem;">
                Save About Information
            </button>
        </div>
    </form>
</div>

@endsection
