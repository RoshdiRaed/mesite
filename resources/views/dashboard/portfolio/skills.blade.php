@extends('layouts.dashboard', ['title' => 'Manage Skills'])

@section('page-title', 'Skills')

@section('dashboard-content')

<div x-data="{ 
    showModal: false, 
    isEdit: false,
    skill: { id: '', name: '', group: 'Backend' },
    openAdd() {
        this.isEdit = false;
        this.skill = { id: '', name: '', group: 'Backend' };
        this.showModal = true;
    },
    openEdit(s) {
        this.isEdit = true;
        this.skill = { ...s };
        this.showModal = true;
    }
}">

    {{-- Header with action --}}
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <p style="color: var(--muted); font-family: var(--mono); font-size: 0.85rem;">
            Manage the skills displayed on your public profile.
        </p>
        <button @click="openAdd()" class="btn-submit" style="padding: 0.6rem 1.25rem;">
            + Add Skill
        </button>
    </div>

    {{-- Skills Grid --}}
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(380px, 1fr)); gap: 1.5rem;">
        @foreach($skills as $group => $items)
        <div style="border: 1px solid var(--border); border-radius: 12px; padding: 1.5rem; background: color-mix(in srgb, var(--paper2) 20%, transparent);">
            <div style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 1.5rem;">
                <h4 style="font-family: var(--mono); font-size: 0.72rem; color: var(--accent); text-transform: uppercase; letter-spacing: 0.1em;">
                    {{ $group }}
                </h4>
                <span style="font-family: var(--mono); font-size: 0.62rem; color: var(--muted);">{{ count($items) }} tags</span>
            </div>

            <div style="display: flex; flex-wrap: wrap; gap: 0.6rem;">
                @foreach($items as $s)
                    <div class="skill-tag-admin" 
                         style="display: flex; align-items: center; gap: 0.5rem; background: var(--paper); padding: 0.4rem 0.8rem; border-radius: 6px; border: 1px solid var(--border); transition: all 0.2s;">
                        <span style="font-family: var(--mono); font-size: 0.78rem;">{{ $s->name }}</span>
                        
                        <div style="display: flex; gap: 0.25rem;">
                            <button @click="openEdit({ id: '{{ $s->id }}', name: '{{ addslashes($s->name) }}', group: '{{ $s->group }}' })" 
                                    style="background: none; border: none; color: var(--muted); cursor: pointer; font-size: 0.8rem; height: 20px;" title="Edit">
                                ✎
                            </button>
                            <form method="POST" action="{{ route('dashboard.portfolio.skills.delete', $s) }}" onsubmit="return confirm('Delete this skill?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: none; border: none; color: color-mix(in srgb, var(--accent) 60%, transparent); cursor: pointer; font-size: 0.8rem; height: 20px;" title="Delete">
                                    ✕
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>

    {{-- MODAL --}}
    <template x-if="showModal">
        <div class="modal-overlay" @click.self="showModal = false" x-transition>
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" x-text="isEdit ? 'Edit Skill' : 'Add New Skill'"></h3>
                    <button class="modal-close" @click="showModal = false">✕</button>
                </div>

                <form :action="isEdit ? `/dashboard/portfolio/skills/${skill.id}` : '{{ route('dashboard.portfolio.skills.add') }}'" method="POST">
                    @csrf
                    <template x-if="isEdit">
                        <input type="hidden" name="_method" value="PATCH">
                    </template>

                    <div class="form-group">
                        <label class="form-label">Skill Name</label>
                        <input type="text" name="name" class="form-input" x-model="skill.name" placeholder="e.g. Redis" required autofocus>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Group</label>
                        <select name="group" class="form-input" x-model="skill.group" required>
                            <option value="Backend">Backend</option>
                            <option value="Frontend">Frontend</option>
                            <option value="Database & Infra">Database & Infra</option>
                            <option value="Principles">Principles</option>
                        </select>
                    </div>

                    <div style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 2rem;">
                        <button type="button" class="dash-logout" @click="showModal = false" style="padding: 0.6rem 1.25rem;">Cancel</button>
                        <button type="submit" class="btn-submit" x-text="isEdit ? 'Update Skill' : 'Add Skill'"></button>
                    </div>
                </form>
            </div>
        </div>
    </template>

</div>

@endsection
