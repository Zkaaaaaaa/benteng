@extends('layouts.admin.app')

@section('title', 'Kelola Kategori')
@section('page_title', 'Kelola Kategori')
@section('page_subtitle', 'Tambah, ubah, dan hapus kategori menu')


@section('content')

    {{-- ── ALERTS ── --}}
    {{-- ── FLASH ALERTS ── --}}

    @if (session('success'))
        <div class="btg-alert success" id="alert-success">
            <div class="btg-alert-icon"><i class="fas fa-check"></i></div>
            <div style="flex:1;">
                <div style="font-weight:600; margin-bottom:2px;">Berhasil!</div>
                {{ session('success') }}
            </div>
            <button class="btg-alert-close" onclick="this.closest('.btg-alert').remove()">×</button>
        </div>
    @endif

    @if ($errors->any())
        <div class="btg-alert danger" id="alert-error">
            <div class="btg-alert-icon"><i class="fas fa-times"></i></div>
            <div style="flex:1;">
                <div style="font-weight:600; margin-bottom:4px;">Terjadi kesalahan!</div>
                <ul style="margin:0; padding-left:16px; font-size:12.5px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button class="btg-alert-close" onclick="this.closest('.btg-alert').remove()">×</button>
        </div>
    @endif

    {{-- ── PAGE HEADER ── --}}
    <div class="page-header">
        <div>
            <div style="font-size:12px; color:var(--btg-muted); margin-bottom:4px;">
                <a href="{{ route('admin.dashboard') }}" style="color:var(--btg-muted); text-decoration:none;">Dashboard</a>
                <span style="margin:0 6px;">›</span>
                <span>Kategori</span>
            </div>
        </div>
        <button class="btn-add" onclick="openModal('modal-add')">
            <i class="fas fa-plus"></i> Tambah Kategori
        </button>
    </div>

    {{-- ── TABLE PANEL ── --}}
    <div class="panel">
        <div class="panel-head">
            <div class="panel-title">
                <i class="fas fa-tags"></i>
                Daftar Kategori
                <span
                    style="font-family:'DM Sans',sans-serif; font-size:12px; font-weight:400; color:var(--btg-muted); margin-left:4px;">
                    ({{ $categories->count() }})
                </span>
            </div>
        </div>

        <table class="cat-table">
            <thead>
                <tr>
                    <th style="width:60px;">No</th>
                    <th>Nama Kategori</th>
                    <th>Slug</th>
                    <th>Produk</th>
                    <th style="width:160px; text-align:right; padding-right:24px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $dotColors = [
                        '#c0392b',
                        '#c8973a',
                        '#27ae60',
                        '#2980b9',
                        '#8e44ad',
                        '#16a085',
                        '#d35400',
                        '#7f8c8d',
                    ];
                @endphp

                @forelse($categories as $index => $category)
                    <tr>
                        <td><span class="row-num">{{ $index + 1 }}</span></td>
                        <td>
                            <div class="cat-name-cell">
                                <span class="cat-color-dot"
                                    style="background: {{ $dotColors[$index % count($dotColors)] }};"></span>
                                <span class="cat-name-text">{{ $category->name }}</span>
                            </div>
                        </td>
                        <td><span class="slug-badge">{{ $category->slug }}</span></td>
                        <td>
                            <span class="prod-count">
                                <i class="fas fa-utensils" style="font-size:10px;"></i>
                                <strong>{{ $category->products_count ?? $category->products->count() }}</strong> produk
                            </span>
                        </td>
                        <td>
                            <div class="action-group" style="justify-content:flex-end;">
                                <button class="btn-action edit"
                                    onclick="openEdit('{{ $category->id }}', '{{ addslashes($category->name) }}')">
                                    <i class="fas fa-pen"></i> Edit
                                </button>
                                <button class="btn-action delete"
                                    onclick="openDelete('{{ $category->id }}', '{{ addslashes($category->name) }}', '{{ $category->products_count ?? $category->products->count() }}')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <div class="empty-icon"><i class="fas fa-tags"></i></div>
                                <p>Belum ada kategori. Mulai dengan menambahkan kategori pertama.</p>
                                <button class="btn-add" onclick="openModal('modal-add')">
                                    <i class="fas fa-plus"></i> Tambah Kategori
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ── MODALS ── --}}
    @include('admin.category.create')
    @include('admin.category.edit')
    @include('admin.category.delete')

@endsection

@push('scripts')
    <script>
        // ── Modal helpers ───────────────────────────────────
        function openModal(id) {
            document.getElementById(id).classList.add('open');
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('open');
        }

        // Close on overlay click
        document.querySelectorAll('.btg-modal-overlay').forEach(overlay => {
            overlay.addEventListener('click', function(e) {
                if (e.target === this) closeModal(this.id);
            });
        });

        // Close on ESC
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') {
                document.querySelectorAll('.btg-modal-overlay.open').forEach(m => {
                    m.classList.remove('open');
                });
            }
        });

        // ── Edit ────────────────────────────────────────────
        function openEdit(id, name) {
            document.getElementById('edit-name').value = name;
            document.getElementById('form-edit').action = '/admin/categories/' + id;
            openModal('modal-edit');
        }

        function openDelete(id, name, productsCount) {
            document.getElementById('delete-category-name').textContent = name;
            document.getElementById('form-delete').action = '/admin/categories/' + id;

            const count = parseInt(productsCount) || 0;
            const warningBox = document.getElementById('delete-warning-box');
            const safeBox = document.getElementById('delete-safe-box');
            const countSpan = document.getElementById('delete-products-count');

            if (count > 0) {
                countSpan.textContent = count;
                warningBox.style.display = 'flex';
                safeBox.style.display = 'none';
            } else {
                warningBox.style.display = 'none';
                safeBox.style.display = 'flex';
            }

            openModal('modal-delete');
        }

        // ── Auto-dismiss alerts ─────────────────────────────
        setTimeout(() => {
            document.querySelectorAll('.btg-alert').forEach(el => {
                el.style.transition = 'opacity .4s, transform .4s';
                el.style.opacity = '0';
                el.style.transform = 'translateY(-8px)';
                setTimeout(() => el.remove(), 400);
            });
        }, 4000);
    </script>
@endpush
