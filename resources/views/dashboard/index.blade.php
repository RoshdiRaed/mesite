@extends('layouts.dashboard', ['title' => 'Dashboard'])

@section('page-title', 'Dashboard')

@section('dashboard-content')

{{-- Welcome --}}
<div style="margin-bottom: 2rem;">
    <p style="color: var(--muted); font-family: var(--mono); font-size: 0.85rem;">
        Welcome back, <span style="color: var(--ink);">{{ Auth::user()->name }}</span>. Here's your overview.
    </p>
</div>

{{-- Stats --}}
<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-label">Total Messages</div>
        <div class="stat-value">{{ $totalMessages }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Unread</div>
        <div class="stat-value" style="color: var(--accent);">{{ $unreadMessages }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Read</div>
        <div class="stat-value" style="color: #22c55e;">{{ $totalMessages - $unreadMessages }}</div>
    </div>
</div>

{{-- Recent Messages --}}
<div style="margin-top: 2rem;">
    <div style="display: flex; align-items: baseline; justify-content: space-between; margin-bottom: 1rem;">
        <h2 style="font-family: var(--serif); font-size: 1.3rem;">Recent Messages</h2>
        @if($totalMessages > 0)
            <a href="{{ route('dashboard.messages') }}" style="font-family: var(--mono); font-size: 0.72rem; color: var(--accent); text-decoration: none;">
                View all →
            </a>
        @endif
    </div>

    @if($recentMessages->isEmpty())
        <div class="empty-state">
            <div class="empty-state-icon">✉</div>
            <p>No messages yet. They'll appear here when someone contacts you.</p>
        </div>
    @else
        <div class="msg-list">
            @foreach($recentMessages as $msg)
                <div class="msg-item">
                    <div class="msg-dot {{ $msg->is_read ? 'read' : '' }}"></div>
                    <div class="msg-info">
                        <div class="msg-name">{{ $msg->name }}</div>
                        <div class="msg-subject">{{ $msg->subject }} — {{ Str::limit($msg->message, 60) }}</div>
                    </div>
                    <div class="msg-date">{{ $msg->created_at->diffForHumans() }}</div>
                </div>
            @endforeach
        </div>
    @endif
</div>

@endsection
