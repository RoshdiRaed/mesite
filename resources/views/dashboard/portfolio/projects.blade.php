@extends('layouts.dashboard', ['title' => 'Manage Projects'])

@section('page-title', 'Projects')

@section('dashboard-content')

<div x-data="{ 
    showModal: false, 
    isEdit: false,
    project: { id: '', name: '', stack: '', url: '' },
    openAdd() {
        this.isEdit = false;
        this.project = { id: '', name: '', stack: '', url: '' };
        this.showModal = true;
    },
    openEdit(p) {
        this.isEdit = true;
        this.project = { ...p };
        this.showModal = true;
    }
}">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <p style="color: var(--muted); font-family: var(--mono); font-size: 0.85rem;">
            Feature your best work with custom titles, stacks, and links.
        </p>
        <button @click="openAdd()" class="btn-submit" style="padding: 0.6rem 1.25rem;">
            + New Project
        </button>
    </div>

    @if($projects->isEmpty())
        <div class="empty-state">
            <div class="empty-state-icon">▤</div>
            <p>No projects added yet. Click the button above to start.</p>
        </div>
    @else
        <div class="msg-list">
            @foreach($projects as $p)
                <div class="msg-item" style="padding: 1.25rem; border: 1px solid var(--border); border-radius: 8px; margin-bottom: 1rem; background: color-mix(in srgb, var(--paper2) 10%, transparent);">
                    <div style="font-family: var(--mono); color: var(--muted); font-size: 0.72rem; padding: 0 1rem 0 0;">{{ str_pad($p->order, 2, '0', STR_PAD_LEFT) }}</div>
                    
                    <div class="msg-info">
                        <div class="msg-name" style="font-family: var(--serif); font-size: 1.15rem; color: var(--ink);">{{ $p->name }}</div>
                        <div class="msg-subject" style="margin-top: 0.2rem;">{{ $p->stack }}</div>
                        @if($p->url)
                            <div style="font-family: var(--mono); font-size: 0.65rem; color: var(--accent2); margin-top: 0.4rem; opacity: 0.8;">{{ $p->url }}</div>
                        @endif
                    </div>

                    <div style="display: flex; gap: 0.75rem;">
                        <button @click="openEdit({ id: '{{ $p->id }}', name: '{{ addslashes($p->name) }}', stack: '{{ addslashes($p->stack) }}', url: '{{ $p->url }}' })" 
                                class="btn-icon" title="Edit">
                            ✎
                        </button>
                        <form method="POST" action="{{ route('dashboard.portfolio.projects.delete', $p) }}" onsubmit="return confirm('Delete this project?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-icon" style="color: var(--accent);" title="Delete">
                                ✕
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- MODAL --}}
    <template x-if="showModal">
        <div class="modal-overlay" @click.self="showModal = false" x-transition>
            <div class="modal-content" style="max-width: 600px;">
                <div class="modal-header">
                    <h3 class="modal-title" x-text="isEdit ? 'Edit Project' : 'New Project'"></h3>
                    <button class="modal-close" @click="showModal = false">✕</button>
                </div>

                <form :action="isEdit ? `/dashboard/portfolio/projects/${project.id}` : '{{ route('dashboard.portfolio.projects.add') }}'" method="POST">
                    @csrf
                    <template x-if="isEdit">
                        <input type="hidden" name="_method" value="PATCH">
                    </template>

                    <div class="form-group">
                        <label class="form-label">Project Name</label>
                        <input type="text" name="name" class="form-input" x-model="project.name" placeholder="e.g. Sanad — SaaS Platform" required autofocus>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tech Stack</label>
                        <input type="text" name="stack" class="form-input" x-model="project.stack" placeholder="e.g. Laravel · Tailwind · MySQL" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Project URL (External Link)</label>
                        <input type="url" name="url" class="form-input" x-model="project.url" placeholder="https://github.com/...">
                    </div>

                    <div style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 2.5rem;">
                        <button type="button" class="dash-logout" @click="showModal = false" style="padding: 0.6rem 1.25rem;">Cancel</button>
                        <button type="submit" class="btn-submit" x-text="isEdit ? 'Save Changes' : 'Create Project'"></button>
                    </div>
                </form>
            </div>
        </div>
    </template>

</div>

@endsection
