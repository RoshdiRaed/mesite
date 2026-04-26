@extends('layouts.dashboard', ['title' => 'Profile'])

@section('page-title', 'Profile Settings')

@section('dashboard-content')

<div style="animation: fadeUp 0.4s ease both;">

    {{-- Update Profile Information --}}
    <div style="border: 1px solid var(--border); border-radius: 12px; padding: 2rem; margin-bottom: 2rem; background: color-mix(in srgb, var(--paper2) 20%, transparent);">
        <h3 style="font-family: var(--serif); font-size: 1.25rem; margin-bottom: 0.5rem;">Profile Information</h3>
        <p style="font-family: var(--mono); font-size: 0.72rem; color: var(--muted); margin-bottom: 2rem;">
            Update your account's profile information and email address.
        </p>

        <form method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div class="form-group">
                <label class="form-label" for="name">Name</label>
                <input class="form-input" style="max-width: 450px;" id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus>
                @error('name')
                    <div style="font-family: var(--mono); font-size: 0.68rem; color: var(--accent); margin-top: 0.4rem;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="email">Email Address</label>
                <input class="form-input" style="max-width: 450px;" id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div style="font-family: var(--mono); font-size: 0.68rem; color: var(--accent); margin-top: 0.4rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-top: 2rem;">
                <button type="submit" class="btn-submit">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    {{-- Update Password --}}
    <div style="border: 1px solid var(--border); border-radius: 12px; padding: 2rem; margin-bottom: 2rem; background: color-mix(in srgb, var(--paper2) 20%, transparent);">
        <h3 style="font-family: var(--serif); font-size: 1.25rem; margin-bottom: 0.5rem;">Update Password</h3>
        <p style="font-family: var(--mono); font-size: 0.72rem; color: var(--muted); margin-bottom: 2rem;">
            Ensure your account is using a long, random password to stay secure.
        </p>

        <form method="post" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <div class="form-group">
                <label class="form-label" for="current_password">Current Password</label>
                <input class="form-input" style="max-width: 450px;" id="current_password" name="current_password" type="password" autocomplete="current-password">
                @error('current_password', 'updatePassword')
                    <div style="font-family: var(--mono); font-size: 0.68rem; color: var(--accent); margin-top: 0.4rem;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password">New Password</label>
                <input class="form-input" style="max-width: 450px;" id="password" name="password" type="password" autocomplete="new-password">
                @error('password', 'updatePassword')
                    <div style="font-family: var(--mono); font-size: 0.68rem; color: var(--accent); margin-top: 0.4rem;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password_confirmation">Confirm Password</label>
                <input class="form-input" style="max-width: 450px;" id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password">
                @error('password_confirmation', 'updatePassword')
                    <div style="font-family: var(--mono); font-size: 0.68rem; color: var(--accent); margin-top: 0.4rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-top: 2rem;">
                <button type="submit" class="btn-submit">
                    Update Password
                </button>
            </div>
        </form>
    </div>

    {{-- Delete Account --}}
    <div style="border: 1px solid var(--border); border-radius: 12px; padding: 2rem;" x-data="{ confirmDelete: false }">
        <h3 style="font-family: var(--serif); font-size: 1.25rem; margin-bottom: 0.5rem; color: #ef4444;">Danger Zone</h3>
        <p style="font-family: var(--mono); font-size: 0.72rem; color: var(--muted); margin-bottom: 2rem;">
            Once your account is deleted, all of its resources and data will be permanently deleted.
        </p>

        <button @click="confirmDelete = true"
                class="msg-btn danger" style="padding: 0.6rem 1.5rem;"
                x-show="!confirmDelete">
            Delete Account
        </button>

        <form method="post" action="{{ route('profile.destroy') }}" x-show="confirmDelete" x-cloak>
            @csrf
            @method('delete')

            <div class="form-group">
                <label class="form-label" for="delete_password">Enter your password to confirm</label>
                <input class="form-input" style="max-width: 450px;" id="delete_password" name="password" type="password" placeholder="Confirm with password">
                @error('password', 'userDeletion')
                    <div style="font-family: var(--mono); font-size: 0.68rem; color: #ef4444; margin-top: 0.4rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="display: flex; gap: 0.75rem;">
                <button type="button" @click="confirmDelete = false" class="msg-btn">
                    Cancel
                </button>
                <button type="submit" class="msg-btn danger" style="background: #ef4444; color: #fff;">
                    Permanently Delete
                </button>
            </div>
        </form>
    </div>

</div>

@endsection
