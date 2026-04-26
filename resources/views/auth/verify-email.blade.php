<x-guest-layout>
    <h2>Verify email</h2>
    <p class="subtitle">// check your inbox for a verification link</p>

    <div style="color: var(--muted); font-size: 0.9rem; margin-bottom: 1.5rem;">
        Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="auth-status">
            A new verification link has been sent to the email address you provided.
        </div>
    @endif

    <div style="display: flex; align-items: center; justify-content: space-between;">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="auth-btn">Resend Email →</button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="auth-link" style="background: none; border: none; cursor: pointer;">
                Log Out
            </button>
        </form>
    </div>
</x-guest-layout>
