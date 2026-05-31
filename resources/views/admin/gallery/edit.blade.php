@extends('layouts.admin.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/gallery.css') }}">
@endpush

@section('title', 'Kelola Galeri')
@section('page_title', 'Kelola Galeri')
@section('page_subtitle', 'Unggah foto hidangan untuk carousel di website')

@section('content')
    <div data-gallery-admin>
        <div class="btg-alert success" data-gallery-alert hidden></div>

        <div class="panel mb-4">
            <div class="panel-head">
                <div class="panel-title"><i class="fas fa-cloud-upload-alt"></i> Unggah Foto Baru</div>
            </div>
            <div style="padding:22px;">
                <p style="color:var(--btg-muted); font-size:13px; margin:0 0 18px;">
                    Foto disimpan di browser (localStorage) dan langsung tampil di carousel website. Ukuran otomatis 800×800 px.
                </p>

                <form data-gallery-form>
                    <div style="margin-bottom:16px;">
                        <label class="btg-label" for="gallery-name">Nama Hidangan / Caption</label>
                        <input class="btg-input" id="gallery-name" data-gallery-name type="text" placeholder="Contoh: Nasi Goreng Spesial" required>
                    </div>

                    <div class="gallery-admin__dropzone" data-gallery-dropzone>
                        <i class="fas fa-images" style="font-size:2rem;color:var(--btg-accent);"></i>
                        <p><strong>Klik</strong> atau seret gambar ke sini</p>
                        <p>JPG, PNG, WebP — maks. 2 MB disarankan</p>
                        <input type="file" data-gallery-file accept="image/*" hidden>
                    </div>

                    <div class="gallery-admin__preview" data-gallery-preview-wrap hidden>
                        <label class="btg-label">Pratinjau (klik untuk perbesar)</label>
                        <button type="button" class="gallery-admin__preview-btn" data-gallery-upload-preview-btn hidden>
                            <img src="" alt="" data-gallery-preview width="72" height="72" draggable="false">
                        </button>
                    </div>

                    <button type="submit" class="btn-primary" style="margin-top:18px;">
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
                <p data-gallery-list-empty style="color:var(--btg-muted);font-size:14px;margin:0;padding:18px 22px;" hidden>
                    Belum ada foto. Unggah foto pertama di atas.
                </p>
                <div data-gallery-table-wrap hidden style="overflow-x:auto;">
                    <table class="cat-table gallery-admin__table">
                        <thead>
                            <tr>
                                <th style="width:48px;">No</th>
                                <th>Foto &amp; Nama</th>
                                <th style="width:100px; text-align:right; padding-right:24px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody data-gallery-list></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="btg-modal-overlay" id="modal-gallery-preview" aria-hidden="true">
        <div class="btg-modal" style="max-width: 560px;" role="dialog" aria-modal="true" aria-label="Pratinjau foto">
            <div class="btg-modal-head">
                <div class="btg-modal-head-icon primary">
                    <i class="fas fa-image"></i>
                </div>
                <div class="btg-modal-head-title" data-gallery-modal-caption></div>
                <button type="button" class="btg-modal-close" data-gallery-modal-close aria-label="Tutup">&times;</button>
            </div>
            <div class="btg-modal-body" style="text-align: center; padding-top: 12px;">
                <img src="" alt="" data-gallery-modal-img class="gallery-admin__modal-img">
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/gallery-storage.js') }}"></script>
    <script src="{{ asset('assets/js/gallery-admin.js') }}"></script>
@endpush
