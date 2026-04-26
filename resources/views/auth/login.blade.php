<x-guest-layout>
    <h2>Welcome back</h2>
    <p class="subtitle">// sign in to your account</p>

    <!-- Session Status -->
    @if (session('status'))
        <div class="auth-status">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="auth-field">
            <label class="auth-label" for="email">Email</label>
            <input class="auth-input" id="email" type="email" name="email"
                   value="{{ old('email') }}" required autofocus autocomplete="username"
                   placeholder="you@example.com">
            @error('email')
                <div class="auth-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="auth-field">
            <label class="auth-label" for="password">Password</label>
            <input class="auth-input" id="password" type="password" name="password"
                   required autocomplete="current-password" placeholder="••••••••">
            @error('password')
                <div class="auth-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="auth-remember">
            <input id="remember_me" type="checkbox" name="remember">
            <label for="remember_me">Remember me</label>
        </div>

        <div class="auth-actions">
            @if (Route::has('password.request'))
                <a class="auth-link" href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            @endif
            <button type="submit" class="auth-btn">Log in →</button>
        </div>
    </form>

    <div class="auth-footer">
        Don't have an account? <a href="{{ route('register') }}">Register</a>
    </div>
</x-guest-layout>
