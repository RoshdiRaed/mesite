<x-guest-layout>
    <h2>Create account</h2>
    <p class="subtitle">// join the platform</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="auth-field">
            <label class="auth-label" for="name">Name</label>
            <input class="auth-input" id="name" type="text" name="name"
                   value="{{ old('name') }}" required autofocus autocomplete="name"
                   placeholder="Your name">
            @error('name')
                <div class="auth-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="auth-field">
            <label class="auth-label" for="email">Email</label>
            <input class="auth-input" id="email" type="email" name="email"
                   value="{{ old('email') }}" required autocomplete="username"
                   placeholder="you@example.com">
            @error('email')
                <div class="auth-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="auth-field">
            <label class="auth-label" for="password">Password</label>
            <input class="auth-input" id="password" type="password" name="password"
                   required autocomplete="new-password" placeholder="••••••••">
            @error('password')
                <div class="auth-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="auth-field">
            <label class="auth-label" for="password_confirmation">Confirm Password</label>
            <input class="auth-input" id="password_confirmation" type="password"
                   name="password_confirmation" required autocomplete="new-password"
                   placeholder="••••••••">
            @error('password_confirmation')
                <div class="auth-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="auth-actions" style="justify-content: flex-end;">
            <button type="submit" class="auth-btn">Register →</button>
        </div>
    </form>

    <div class="auth-footer">
        Already have an account? <a href="{{ route('login') }}">Log in</a>
    </div>
</x-guest-layout>
