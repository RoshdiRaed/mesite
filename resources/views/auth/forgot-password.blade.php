<x-guest-layout>
    <h2>Reset password</h2>
    <p class="subtitle">// enter your email to receive a reset link</p>

    @if (session('status'))
        <div class="auth-status">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="auth-field">
            <label class="auth-label" for="email">Email</label>
            <input class="auth-input" id="email" type="email" name="email"
                   value="{{ old('email') }}" required autofocus
                   placeholder="you@example.com">
            @error('email')
                <div class="auth-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="auth-actions" style="justify-content: flex-end;">
            <button type="submit" class="auth-btn">Send Reset Link →</button>
        </div>
    </form>

    <div class="auth-footer">
        Remember your password? <a href="{{ route('login') }}">Log in</a>
    </div>
</x-guest-layout>
