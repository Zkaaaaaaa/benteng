@extends('layouts.admin.app')

@section('title', 'Kelola Produk')
@section('page_title', 'Kelola Produk')
@section('page_subtitle', 'Tambah, ubah, dan hapus menu masakan & minuman')

@section('content')

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
                <span>Produk</span>
            </div>
        </div>
        <button class="btn-add" onclick="openModal('modal-add')">
            <i class="fas fa-plus"></i> Tambah Produk
        </button>
    </div>

    {{-- ── TABLE PANEL ── --}}
    <div class="panel">
        <div class="panel-head">
            <div class="panel-title">
                <i class="fas fa-utensils"></i>
                Daftar Produk
                <span
                    style="font-family:'DM Sans',sans-serif; font-size:12px; font-weight:400; color:var(--btg-muted); margin-left:4px;">
                    ({{ $products->count() }})
                </span>
            </div>
        </div>

        <table class="cat-table">
            <thead>
                <tr>
                    <th style="width:60px;">No</th>
                    <th style="width:100px;">Gambar</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th style="width:180px; text-align:right; padding-right:24px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $index => $product)
                    <tr>
                        <td><span class="row-num">{{ $index + 1 }}</span></td>
                        <td>
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                    style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px; border: 1px solid var(--btg-border);">
                            @else
                                <img src="{{ asset('dist/img/boxed-bg.jpg') }}" alt="Placeholder"
                                    style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px; border: 1px solid var(--btg-border); opacity: 0.6;">
                            @endif
                        </td>
                        <td>
                            <div style="font-weight:600; color:var(--btg-text); font-size: 14px;">{{ $product->name }}</div>
                            @if ($product->description)
                                <div style="font-size:11.5px; color:var(--btg-muted); margin-top:2px; max-width: 280px; line-height: 1.4;"
                                    class="text-wrap">
                                    {{ Str::limit($product->description, 60) }}
                                </div>
                            @endif
                        </td>
                        <td>
                            @if ($product->category)
                                <span class="slug-badge"
                                    style="background:#e8f4fd; color:#2471a3; font-family:'DM Sans',sans-serif;">{{ $product->category->name }}</span>
                            @else
                                <span class="slug-badge"
                                    style="background:#f5f0eb; color:var(--btg-muted); font-family:'DM Sans',sans-serif;">Tanpa
                                    Kategori</span>
                            @endif
                        </td>
                        <td>
                            <strong style="color:var(--btg-text);">€
                                {{ number_format($product->price, 2, ',', '.') }}</strong>
                        </td>
                        <td>
                            @if ($product->stock > 5)
                                <span class="slug-badge"
                                    style="background:#e8f8f5; color:#117a65; font-family:'DM Sans',sans-serif; font-weight: 600;">
                                    {{ $product->stock }} pcs
                                </span>
                            @elseif($product->stock > 0)
                                <span class="slug-badge"
                                    style="background:#fef9e7; color:#b7950b; font-family:'DM Sans',sans-serif; font-weight: 600;">
                                    {{ $product->stock }} pcs (Hampir Habis)
                                </span>
                            @else
                                <span class="slug-badge"
                                    style="background:#fadbd8; color:#922b21; font-family:'DM Sans',sans-serif; font-weight: 600;">
                                    Habis
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="action-group" style="justify-content:flex-end;">
                                <button class="btn-action edit"
                                    onclick="openEdit('{{ $product->id }}', '{{ addslashes($product->name) }}', '{{ $product->category_id }}', '{{ $product->price }}', '{{ $product->stock }}', '{{ addslashes($product->description) }}', '{{ $product->image ? asset('storage/' . $product->image) : '' }}')">
                                    <i class="fas fa-pen"></i> Edit
                                </button>
                                <button class="btn-action delete"
                                    onclick="openDelete('{{ $product->id }}', '{{ addslashes($product->name) }}')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <div class="empty-icon"><i class="fas fa-utensils"></i></div>
                                <p>Belum ada produk. Mulai dengan menambahkan produk pertama.</p>
                                <button class="btn-add" onclick="openModal('modal-add')">
                                    <i class="fas fa-plus"></i> Tambah Produk
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ── MODALS ── --}}
    @include('admin.product.create')
    @include('admin.product.edit')
    @include('admin.product.delete')

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
        function openEdit(id, name, categoryId, price, stock, description, imageSrc) {
            document.getElementById('edit-name').value = name;
            document.getElementById('edit-category_id').value = categoryId;
            document.getElementById('edit-price').value = price;
            document.getElementById('edit-stock').value = stock;
            document.getElementById('edit-description').value = description;

            // Preview Image handling
            if (imageSrc) {
                document.getElementById('edit-image-preview').src = imageSrc;
                document.getElementById('preview-container').style.display = 'flex';
            } else {
                document.getElementById('edit-image-preview').src = '';
                document.getElementById('preview-container').style.display = 'none';
            }

            document.getElementById('form-edit').action = '/admin/products/' + id;
            openModal('modal-edit');
        }

        // ── Delete ──────────────────────────────────────────
        function openDelete(id, name) {
            document.getElementById('delete-product-name').textContent = name;
            document.getElementById('form-delete').action = '/admin/products/' + id;
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
