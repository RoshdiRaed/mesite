<x-guest-layout>
    <h2>New password</h2>
    <p class="subtitle">// set your new password</p>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="auth-field">
            <label class="auth-label" for="email">Email</label>
            <input class="auth-input" id="email" type="email" name="email"
                   value="{{ old('email', $request->email) }}" required autofocus autocomplete="username"
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
            <button type="submit" class="auth-btn">Reset Password →</button>
        </div>
    </form>
</x-guest-layout>
