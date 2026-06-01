@extends('layouts.admin.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset_version('assets/css/gallery.css') }}">
@endpush

@section('title', 'Kelola Galeri')
@section('page_title', 'Kelola Galeri')
@section('page_subtitle', 'Unggah foto hidangan untuk carousel di website')

@section('content')
    @if (session('success'))
        <div class="btg-alert success mb-4">
            <div class="btg-alert-icon"><i class="fas fa-check"></i></div>
            <div style="flex:1;">{{ session('success') }}</div>
        </div>
    @endif

    <div class="panel mb-4">
        <div class="panel-head">
            <div class="panel-title"><i class="fas fa-cloud-upload-alt"></i> Unggah Foto Baru</div>
        </div>
        <div style="padding:22px;">
            <p style="color:var(--btg-muted); font-size:13px; margin:0 0 18px;">
                Foto disimpan di <code>storage/app/public/gallery</code> dan diakses melalui symlink
                <code>public/storage</code>. Jalankan <code>php artisan storage:link</code> jika belum.
            </p>

            <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data">
                @csrf
                <div style="margin-bottom:16px;">
                    <label class="btg-label" for="gallery-name">Nama Hidangan / Caption</label>
                    <input class="btg-input @error('name') is-invalid @enderror" id="gallery-name" name="name"
                        type="text" value="{{ old('name') }}" placeholder="Contoh: Nasi Goreng Spesial" required>
                    @error('name')
                        <p class="text-danger" style="font-size:12px;margin-top:6px;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="margin-bottom:16px;">
                    <label class="btg-label" for="gallery-image">Gambar</label>
                    <input class="btg-input @error('image') is-invalid @enderror" id="gallery-image" name="image"
                        type="file" accept="image/jpeg,image/png,image/webp" required>
                    @error('image')
                        <p class="text-danger" style="font-size:12px;margin-top:6px;">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn-primary">
                    <i class="fas fa-upload"></i> Upload ke Galeri
                </button>
            </form>
        </div>
    </div>

    <div class="panel mb-4">
        <div class="panel-head">
            <div class="panel-title"><i class="fas fa-th"></i> Daftar Foto Galeri</div>
        </div>
        <div style="padding:0 0 8px;">
            @if ($photos->isEmpty())
                <p style="color:var(--btg-muted);font-size:14px;margin:0;padding:18px 22px;">
                    Belum ada foto. Unggah foto pertama di atas.
                </p>
            @else
                <div style="overflow-x:auto;">
                    <table class="cat-table gallery-admin__table">
                        <thead>
                            <tr>
                                <th style="width:48px;">No</th>
                                <th>Foto &amp; Nama</th>
                                <th style="width:100px; text-align:right; padding-right:24px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($photos as $index => $photo)
                                <tr>
                                    <td><span class="row-num">{{ $index + 1 }}</span></td>
                                    <td>
                                        <div class="gallery-admin__inline">
                                            <a href="{{ $photo->image_url }}" target="_blank" rel="noopener"
                                                class="gallery-admin__thumb-btn" title="Lihat foto">
                                                <img src="{{ $photo->image_url }}" alt=""
                                                    class="gallery-admin__thumb" width="32" height="32"
                                                    draggable="false">
                                            </a>
                                            <div class="gallery-admin__inline-text">
                                                <span class="gallery-admin__name">{{ $photo->name }}</span>
                                                <span
                                                    class="gallery-admin__date">{{ $photo->created_at?->format('d M Y H:i') }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="action-group" style="justify-content:flex-end;">
                                            <form method="POST"
                                                action="{{ route('admin.gallery.destroy', $photo) }}"
                                                onsubmit="return confirm('Hapus &quot;{{ $photo->name }}&quot; dari galeri?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action delete">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
