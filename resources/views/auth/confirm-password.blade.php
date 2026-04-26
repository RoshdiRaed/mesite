<x-guest-layout>
    <h2>Confirm password</h2>
    <p class="subtitle">// please confirm your password to continue</p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="auth-field">
            <label class="auth-label" for="password">Password</label>
            <input class="auth-input" id="password" type="password" name="password"
                   required autocomplete="current-password" placeholder="••••••••">
            @error('password')
                <div class="auth-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="auth-actions" style="justify-content: flex-end;">
            <button type="submit" class="auth-btn">Confirm →</button>
        </div>
    </form>
</x-guest-layout>
