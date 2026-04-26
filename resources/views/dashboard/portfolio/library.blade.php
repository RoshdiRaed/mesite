@extends('layouts.dashboard', ['title' => 'Manage Library'])

@section('page-title', 'Library')

@section('dashboard-content')

<div x-data="{ 
    showModal: false, 
    isEdit: false,
    book: { id: '', title: '', author: '', status: 'reading', progress: 0 },
    openAdd() {
        this.isEdit = false;
        this.book = { id: '', title: '', author: '', status: 'reading', progress: 0 };
        this.showModal = true;
    },
    openEdit(b) {
        this.isEdit = true;
        this.book = { ...b };
        this.showModal = true;
    }
}">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <p style="color: var(--muted); font-family: var(--mono); font-size: 0.85rem;">
            Curate your digital library and track your reading progress.
        </p>
        <button @click="openAdd()" class="btn-submit" style="padding: 0.6rem 1.25rem;">
            + Add Book
        </button>
    </div>

    {{-- Books Grid by Status --}}
    <div style="display: flex; flex-direction: column; gap: 3rem;">
        @foreach(['reading' => 'Reading Now', 'read' => 'Have Read', 'want' => 'Want to Read'] as $status => $label)
        <div style="animation: fadeUp 0.4s ease both;">
            <div style="display: flex; align-items: baseline; gap: 1rem; margin-bottom: 1.5rem; border-bottom: 1px solid var(--border); padding-bottom: 0.75rem;">
                <h4 style="font-family: var(--serif); font-size: 1.4rem;">{{ $label }}</h4>
                <span style="font-family: var(--mono); font-size: 0.72rem; color: var(--muted);">{{ isset($books[$status]) ? count($books[$status]) : 0 }} items</span>
            </div>

            @if(isset($books[$status]))
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1rem;">
                    @foreach($books[$status] as $b)
                        <div style="border: 1px solid var(--border); border-radius: 12px; padding: 1.25rem; background: color-mix(in srgb, var(--paper2) 15%, transparent); position: relative; transition: all 0.2s;">
                            <div style="display: flex; justify-content: space-between; align-baseline: start; margin-bottom: 0.75rem;">
                                <div class="msg-dot {{ $status === 'read' ? 'read' : '' }}" 
                                     style="{{ $status === 'want' ? 'background: var(--accent);' : '' }}{{ $status === 'reading' ? 'background: var(--accent2);' : '' }}"></div>
                                
                                <div style="display: flex; gap: 0.4rem;">
                                    <button @click="openEdit({ id: '{{ $b->id }}', title: '{{ addslashes($b->title) }}', author: '{{ addslashes($b->author) }}', status: '{{ $b->status }}', progress: {{ $b->progress }} })" 
                                            class="btn-icon" style="width: 26px; height: 26px; font-size: 0.7rem;" title="Edit">
                                        ✎
                                    </button>
                                    <form method="POST" action="{{ route('dashboard.portfolio.library.delete', $b) }}" onsubmit="return confirm('Delete this book?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-icon" style="width: 26px; height: 26px; font-size: 0.7rem; color: var(--accent);" title="Delete">
                                            ✕
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div style="font-family: var(--serif); font-size: 1.05rem; line-height: 1.3; margin-bottom: 0.25rem;">{{ $b->title }}</div>
                            <div style="font-family: var(--mono); font-size: 0.68rem; color: var(--muted);">by {{ $b->author }}</div>

                            @if($status === 'reading')
                                <div style="margin-top: 1.25rem;">
                                    <div style="display: flex; justify-content: space-between; font-family: var(--mono); font-size: 0.62rem; color: var(--muted); margin-bottom: 0.4rem;">
                                        <span>Progress</span>
                                        <span>{{ $b->progress }}%</span>
                                    </div>
                                    <div style="height: 3px; background: var(--border); border-radius: 5px; overflow: hidden;">
                                        <div style="width: {{ $b->progress }}%; height: 100%; background: var(--accent2);"></div>
                                    </div>
                                </div>
                            @endif
                            
                            @if($status === 'want')
                                <form method="POST" action="{{ route('dashboard.portfolio.library.update', $b) }}" style="margin-top: 1.25rem;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="reading">
                                    <button type="submit" class="btn-submit" style="width: 100%; padding: 0.4rem; font-size: 0.68rem; border-radius: 4px; background: var(--paper2); color: var(--ink); border: 1px solid var(--border);">
                                        Start Reading
                                    </button>
                                </form>
                            @endif

                            @if($status === 'reading' && $b->progress >= 100)
                                <form method="POST" action="{{ route('dashboard.portfolio.library.update', $b) }}" style="margin-top: 1.25rem;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="read">
                                    <button type="submit" class="btn-submit" style="width: 100%; padding: 0.4rem; font-size: 0.68rem; border-radius: 4px; background: #22c55e; color: #fff;">
                                        Complete Book ✓
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state" style="padding: 1.5rem; border: 1px dashed var(--border); border-radius: 8px;">
                    <p style="font-size: 0.72rem;">No books in this category yet.</p>
                </div>
            @endif
        </div>
        @endforeach
    </div>

    {{-- MODAL --}}
    <template x-if="showModal">
        <div class="modal-overlay" @click.self="showModal = false" x-transition>
            <div class="modal-content" style="max-width: 500px;">
                <div class="modal-header">
                    <h3 class="modal-title" x-text="isEdit ? 'Edit Book Info' : 'Add to Library'"></h3>
                    <button class="modal-close" @click="showModal = false">✕</button>
                </div>

                <form :action="isEdit ? `/dashboard/portfolio/library/${book.id}` : '{{ route('dashboard.portfolio.library.add') }}'" method="POST">
                    @csrf
                    <template x-if="isEdit">
                        <input type="hidden" name="_method" value="PATCH">
                    </template>

                    <div class="form-group">
                        <label class="form-label">Book Title</label>
                        <input type="text" name="title" class="form-input" x-model="book.title" required autofocus>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Author</label>
                        <input type="text" name="author" class="form-input" x-model="book.author" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-input" x-model="book.status" required>
                                <option value="reading">Reading Now</option>
                                <option value="read">Have Read</option>
                                <option value="want">Want to Read</option>
                            </select>
                        </div>
                        <div class="form-group" x-show="book.status === 'reading'">
                            <label class="form-label">Progress (%)</label>
                            <input type="number" name="progress" class="form-input" x-model="book.progress" min="0" max="100">
                        </div>
                    </div>

                    <div style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 2.5rem;">
                        <button type="button" class="dash-logout" @click="showModal = false" style="padding: 0.6rem 1.25rem;">Cancel</button>
                        <button type="submit" class="btn-submit" x-text="isEdit ? 'Save Changes' : 'Add Book'"></button>
                    </div>
                </form>
            </div>
        </div>
    </template>

</div>

@endsection
