@extends('layouts.admin.app')

@section('title', 'Manage Rames')
@section('page_title', 'Manage Rames')
@section('page_subtitle', 'Atur teks dan produk menu Rames di website')

@section('content')
    @if (session('success'))
        <div class="btg-alert success">
            <div class="btg-alert-icon"><i class="fas fa-check"></i></div>
            <div style="flex:1;">{{ session('success') }}</div>
        </div>
    @endif

    @if ($errors->any())
        <div class="btg-alert danger">
            <div class="btg-alert-icon"><i class="fas fa-times"></i></div>
            <div style="flex:1;">
                <ul style="margin:0; padding-left:16px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    {{-- Teks di homepage (judul, harga, tombol) --}}
    <form method="POST" action="{{ route('admin.rames.settings.update') }}" class="panel mb-4">
        @csrf
        @method('PUT')
        <div class="panel-head">
            <div class="panel-title"><i class="fas fa-font"></i> Teks di Website</div>
        </div>
        <div style="padding:22px;">
            <p style="color:var(--btg-muted); font-size:13px; margin:0 0 18px;">
                Judul, harga, dan kalimat di bagian Rames. Isi NL untuk halaman Belanda, EN untuk halaman Inggris.
            </p>

            <h4 style="font-size:13px; font-weight:600; margin:0 0 12px; color:var(--btg-text);">Judul utama</h4>
            <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:14px; margin-bottom:20px;">
                <div>
                    <label class="btg-label">Judul (NL) — contoh: Onze Rames</label>
                    <input class="btg-input" name="title_nl" value="{{ old('title_nl', $setting->title_nl) }}">
                </div>
                <div>
                    <label class="btg-label">Judul (EN) — contoh: Our Rames</label>
                    <input class="btg-input" name="title_en" value="{{ old('title_en', $setting->title_en) }}">
                </div>
                <div>
                    <label class="btg-label">Subjudul (NL)</label>
                    <input class="btg-input" name="subtitle_nl" value="{{ old('subtitle_nl', $setting->subtitle_nl) }}">
                </div>
                <div>
                    <label class="btg-label">Subjudul (EN)</label>
                    <input class="btg-input" name="subtitle_en" value="{{ old('subtitle_en', $setting->subtitle_en) }}">
                </div>
            </div>

            <h4 style="font-size:13px; font-weight:600; margin:0 0 12px; color:var(--btg-text);">Ukuran & harga (KLEIN / GROOT)</h4>
            <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:14px; margin-bottom:20px;">
                <div>
                    <label class="btg-label">Label kecil (NL)</label>
                    <input class="btg-input" name="small_title_nl" value="{{ old('small_title_nl', $setting->small_title_nl) }}">
                </div>
                <div>
                    <label class="btg-label">Label kecil (EN)</label>
                    <input class="btg-input" name="small_title_en" value="{{ old('small_title_en', $setting->small_title_en) }}">
                </div>
                <div>
                    <label class="btg-label">Harga KLEIN (€)</label>
                    <input type="number" step="0.01" class="btg-input" name="small_price" value="{{ old('small_price', $setting->small_price) }}">
                </div>
                <div>
                    <label class="btg-label">Deskripsi paket kecil</label>
                    <input class="btg-input" name="small_desc" value="{{ old('small_desc', $setting->small_desc) }}">
                </div>
                <div>
                    <label class="btg-label">Label besar (NL)</label>
                    <input class="btg-input" name="large_title_nl" value="{{ old('large_title_nl', $setting->large_title_nl) }}">
                </div>
                <div>
                    <label class="btg-label">Label besar (EN)</label>
                    <input class="btg-input" name="large_title_en" value="{{ old('large_title_en', $setting->large_title_en) }}">
                </div>
                <div>
                    <label class="btg-label">Tambahan harga GROOT (€)</label>
                    <input type="number" step="0.01" class="btg-input" name="large_surcharge" value="{{ old('large_surcharge', $setting->large_surcharge) }}">
                </div>
                <div>
                    <label class="btg-label">Deskripsi paket besar</label>
                    <input class="btg-input" name="large_desc" value="{{ old('large_desc', $setting->large_desc) }}">
                </div>
            </div>

            <h4 style="font-size:13px; font-weight:600; margin:0 0 12px; color:var(--btg-text);">Petunjuk di tengah</h4>
            <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:14px; margin-bottom:20px;">
                <div>
                    <label class="btg-label">Kalimat petunjuk (NL)</label>
                    <input class="btg-input" name="instruction_nl" value="{{ old('instruction_nl', $setting->instruction_nl) }}">
                </div>
                <div>
                    <label class="btg-label">Kalimat petunjuk (EN)</label>
                    <input class="btg-input" name="instruction_en" value="{{ old('instruction_en', $setting->instruction_en) }}">
                </div>
            </div>

            <h4 style="font-size:13px; font-weight:600; margin:0 0 12px; color:var(--btg-text);">Tombol & teks bawah (opsional)</h4>
            <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:14px;">
                <div>
                    <label class="btg-label">Tombol menu (NL)</label>
                    <input class="btg-input" name="button_label_nl" value="{{ old('button_label_nl', $setting->button_label_nl) }}">
                </div>
                <div>
                    <label class="btg-label">Tombol menu (EN)</label>
                    <input class="btg-input" name="button_label_en" value="{{ old('button_label_en', $setting->button_label_en) }}">
                </div>
                <div>
                    <label class="btg-label">Judul bawah (NL)</label>
                    <input class="btg-input" name="bottom_title_nl" value="{{ old('bottom_title_nl', $setting->bottom_title_nl) }}">
                </div>
                <div>
                    <label class="btg-label">Judul bawah (EN)</label>
                    <input class="btg-input" name="bottom_title_en" value="{{ old('bottom_title_en', $setting->bottom_title_en) }}">
                </div>
                <div style="grid-column:1/-1;">
                    <label class="btg-label">Teks bawah (NL)</label>
                    <textarea class="btg-input" name="bottom_text_nl" rows="2" style="width:100%; resize:vertical;">{{ old('bottom_text_nl', $setting->bottom_text_nl) }}</textarea>
                </div>
                <div style="grid-column:1/-1;">
                    <label class="btg-label">Teks bawah (EN)</label>
                    <textarea class="btg-input" name="bottom_text_en" rows="2" style="width:100%; resize:vertical;">{{ old('bottom_text_en', $setting->bottom_text_en) }}</textarea>
                </div>
            </div>

            <button type="submit" class="btn-primary" style="margin-top:20px; padding:12px 20px;">
                <i class="fas fa-save"></i> Simpan Teks
            </button>
        </div>
    </form>

    <h3 style="font-size:15px; font-weight:600; margin:0 0 8px;">Produk per bagian</h3>
    <p style="color:var(--btg-muted); margin-bottom:20px; font-size:14px; line-height:1.5;">
        Pilih bagian, lalu tambahkan produk dari daftar. Setiap produk hanya bisa ada di satu bagian.
        @if ($availableProducts->isEmpty() && collect($sections)->sum(fn ($s) => $s['items']->count()) > 0)
            <br><span style="color:var(--btg-accent);">Semua produk aktif sudah ditambahkan.</span>
        @endif
    </p>

    @foreach ($sections as $sectionKey => $section)
        <div class="panel mb-4">
            <div class="panel-head">
                <div class="panel-title"><i class="fas fa-list"></i> {{ $section['label'] }}</div>
            </div>
            <div style="padding:18px 22px;">
                <ul style="list-style:none; margin:0 0 16px; padding:0; display:flex; flex-direction:column; gap:8px;">
                    @forelse($section['items'] as $item)
                        @if ($item->product)
                            <li style="display:flex; align-items:flex-start; justify-content:space-between; gap:12px; border:1px solid var(--btg-border); border-radius:10px; padding:12px 14px;">
                                <div>
                                    <strong>{{ $item->product->name }}</strong>
                                    @php($desc = $item->product->description_nl ?: ($item->product->description_en ?: $item->product->description))
                                    @if($desc)
                                        <div style="font-size:13px; color:var(--btg-muted); margin-top:4px;">{{ $desc }}</div>
                                    @endif
                                </div>
                                <form method="POST" action="{{ route('admin.rames.items.destroy', $item) }}" style="flex-shrink:0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-primary" style="background:#c0392b; border-color:#c0392b; padding:8px 12px; font-size:13px;"
                                        onclick="return confirm('Hapus {{ $item->product->name }} dari bagian ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </li>
                        @endif
                    @empty
                        <li style="color:var(--btg-muted); font-size:14px; padding:8px 0;">Belum ada produk di bagian ini.</li>
                    @endforelse
                </ul>

                @if ($availableProducts->isNotEmpty())
                    <form method="POST" action="{{ route('admin.rames.items.store') }}"
                        style="display:flex; flex-wrap:wrap; gap:10px; align-items:flex-end; padding-top:4px; border-top:1px solid var(--btg-border);">
                        @csrf
                        <input type="hidden" name="section_key" value="{{ $sectionKey }}">
                        <div style="flex:1; min-width:200px;">
                            <label class="btg-label" style="margin-bottom:6px;">Tambah produk</label>
                            <select class="btg-input" name="product_id" required style="width:100%;">
                                <option value="">— Pilih produk —</option>
                                @foreach ($availableProducts as $product)
                                    <option value="{{ $product->id }}" @selected(old('product_id') == $product->id && old('section_key') === $sectionKey)>
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn-primary" style="padding:12px 18px; white-space:nowrap;">
                            <i class="fas fa-plus"></i> Tambah Produk
                        </button>
                    </form>
                @else
                    <p style="margin:8px 0 0; font-size:13px; color:var(--btg-muted);">
                        Tidak ada produk tersedia.
                        <a href="{{ route('admin.products.index') }}" style="color:var(--btg-accent);">Kelola Produk</a>
                    </p>
                @endif
            </div>
        </div>
    @endforeach
@endsection
