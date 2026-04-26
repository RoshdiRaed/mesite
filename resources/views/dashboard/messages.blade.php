@extends('layouts.dashboard', ['title' => 'Messages'])

@section('page-title', 'Messages')

@section('dashboard-content')

@if($messages->isEmpty())
    <div class="empty-state">
        <div class="empty-state-icon">✉</div>
        <p>No messages yet. They'll appear here when someone contacts you.</p>
    </div>
@else
    <div class="msg-list">
        @foreach($messages as $msg)
            <div class="msg-item" x-data="{ expanded: false }">
                <div class="msg-dot {{ $msg->is_read ? 'read' : '' }}"></div>
                <div style="flex: 1; cursor: pointer;" @click="expanded = !expanded">
                    <div class="msg-info">
                        <div class="msg-name">
                            {{ $msg->name }}
                            <span style="font-family: var(--mono); font-size: 0.68rem; color: var(--muted); margin-left: 0.5rem;">
                                &lt;{{ $msg->email }}&gt;
                            </span>
                        </div>
                        <div class="msg-subject">{{ $msg->subject }}</div>
                    </div>

                    {{-- Expanded message body --}}
                    <div x-show="expanded" x-cloak x-transition
                         style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid var(--border); color: var(--muted); line-height: 1.8; font-size: 0.9rem;">
                        {!! nl2br(e($msg->message)) !!}
                    </div>
                </div>
                <div style="display: flex; flex-direction: column; gap: 0.4rem; align-items: flex-end;">
                    <div class="msg-date">{{ $msg->created_at->format('M d, Y') }}</div>
                    <div class="msg-actions">
                        <form method="POST" action="{{ route('dashboard.messages.toggle', $msg) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="msg-btn" title="{{ $msg->is_read ? 'Mark unread' : 'Mark read' }}">
                                {{ $msg->is_read ? '○' : '●' }}
                            </button>
                        </form>
                        <form method="POST" action="{{ route('dashboard.messages.destroy', $msg) }}"
                              onsubmit="return confirm('Delete this message?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="msg-btn danger" title="Delete">✕</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    @if($messages->hasPages())
        <div class="pagination-wrap">
            @if($messages->onFirstPage())
                <span style="opacity: 0.4;">←</span>
            @else
                <a href="{{ $messages->previousPageUrl() }}">←</a>
            @endif

            @foreach($messages->getUrlRange(1, $messages->lastPage()) as $page => $url)
                @if($page == $messages->currentPage())
                    <span class="active">{{ $page }}</span>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach

            @if($messages->hasMorePages())
                <a href="{{ $messages->nextPageUrl() }}">→</a>
            @else
                <span style="opacity: 0.4;">→</span>
            @endif
        </div>
    @endif
@endif

@endsection
