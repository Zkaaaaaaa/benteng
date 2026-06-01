@extends('layouts.admin.app')

@section('title', 'Pengaturan Website NL')
@section('page_title', 'Pengaturan Website NL')
@section('page_subtitle', 'Kelola informasi toko, kontak, jam buka, dan logo NL')

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
                <span>Pengaturan Website</span>
            </div>
        </div>
    </div>

    {{-- ── FORM PANEL ── --}}
    <div class="panel">
        <div class="panel-head">
            <div class="panel-title">
                <i class="fas fa-cog"></i>
                Ubah Pengaturan Website
            </div>
        </div>

        <div style="padding: 28px;">
            <form method="POST" action="{{ route('admin.site-settings-nl.update') }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- 1. INFORMASI WEBSITE & BRANDING --}}
                <div style="margin-bottom: 35px;">
                    <div
                        style="font-family:'Playfair Display', serif; font-size:16px; font-weight:600; color:var(--btg-text); border-bottom:1px solid var(--btg-border); padding-bottom:8px; margin-bottom:20px; display:flex; align-items:center; gap:8px;">
                        <i class="fas fa-globe" style="color:var(--btg-gold); font-size:14px;"></i>
                        Informasi Website & Branding
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                        <div>
                            <label class="btg-label" for="title">Judul Website <span>*</span></label>
                            <input type="text" class="btg-input" id="title" name="title"
                                value="{{ old('title', $siteSetting->title) }}" required
                                placeholder="Contoh: Benteng Kopi & Resto">
                        </div>
                        <div>
                            <label class="btg-label" for="logo">Logo Website</label>
                            <input type="file" class="btg-input" id="logo" name="logo" accept="image/*">
                            @if ($siteSetting->logo)
                                <div style="margin-top: 8px; display: flex; align-items: center; gap: 10px;">
                                    <img src="{{ $siteSetting->logo_url }}" alt="Logo Current"
                                        style="max-height: 40px; border-radius: 6px; border: 1px solid var(--btg-border);">
                                    <span style="font-size: 11px; color: var(--btg-muted);">File saat ini:
                                        {{ basename($siteSetting->logo) }}</span>
                                </div>
                            @endif
                        </div>
                        <div style="grid-column: 1 / -1;">
                            <label class="btg-label" for="opening_hour">Jam Operasional / Waktu Buka</label>
                            <input type="text" class="btg-input" id="opening_hour" name="opening_hour"
                                value="{{ old('opening_hour', $siteSetting->opening_hour) }}"
                                placeholder="Contoh: Setiap Hari: 10:00 - 22:00">
                        </div>
                    </div>
                </div>

                {{-- 2. KONTEN HERO UTAMA (SECTION 1 & 2) --}}
                <div style="margin-bottom: 35px;">
                    <div
                        style="font-family:'Playfair Display', serif; font-size:16px; font-weight:600; color:var(--btg-text); border-bottom:1px solid var(--btg-border); padding-bottom:8px; margin-bottom:20px; display:flex; align-items:center; gap:8px;">
                        <i class="fas fa-images" style="color:var(--btg-gold); font-size:14px;"></i>
                        Konten Beranda / Hero Banner
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px;">
                        {{-- Section 1 --}}
                        <div
                            style="background: #faf7f4; border: 1px solid var(--btg-border); border-radius: 10px; padding: 20px;">
                            <div
                                style="font-weight: 600; font-size: 13.5px; color: var(--btg-text); margin-bottom: 15px; display: flex; align-items: center; gap: 6px;">
                                <span
                                    style="display:inline-block; width:20px; height:20px; border-radius:50%; background:var(--btg-accent); color:#fff; text-align:center; line-height:20px; font-size:11px;">1</span>
                                Hero Utama (Slide/Bagian 1)
                            </div>

                            <div style="margin-bottom: 14px;">
                                <label class="btg-label" for="title1">Judul Hero 1 <span>*</span></label>
                                <input type="text" class="btg-input" id="title1" name="title1"
                                    value="{{ old('title1', $siteSetting->title1) }}" required>
                            </div>

                            <div style="margin-bottom: 14px;">
                                <label class="btg-label" for="img1">Gambar Hero 1</label>
                                <input type="file" class="btg-input" id="img1" name="img1" accept="image/*">
                                @if ($siteSetting->img1)
                                    <div style="margin-top: 8px; display: flex; align-items: center; gap: 10px;">
                                        <img src="{{ $siteSetting->img1_url }}" alt="Hero 1 Current"
                                            style="max-height: 50px; border-radius: 6px; border: 1px solid var(--btg-border);">
                                        <span style="font-size: 11px; color: var(--btg-muted);">File saat ini:
                                            {{ basename($siteSetting->img1) }}</span>
                                    </div>
                                @endif
                            </div>

                            <div>
                                <label class="btg-label" for="desc1">Deskripsi Hero 1 <span>*</span></label>
                                <textarea class="btg-input" id="desc1" name="desc1" rows="3" style="resize: vertical;" required>{{ old('desc1', $siteSetting->desc1) }}</textarea>
                            </div>
                        </div>

                        {{-- Section 2 --}}
                        <div
                            style="background: #faf7f4; border: 1px solid var(--btg-border); border-radius: 10px; padding: 20px;">
                            <div
                                style="font-weight: 600; font-size: 13.5px; color: var(--btg-text); margin-bottom: 15px; display: flex; align-items: center; gap: 6px;">
                                <span
                                    style="display:inline-block; width:20px; height:20px; border-radius:50%; background:var(--btg-gold); color:#fff; text-align:center; line-height:20px; font-size:11px;">2</span>
                                Hero Sekunder (Slide/Bagian 2 - Opsional)
                            </div>

                            <div style="margin-bottom: 14px;">
                                <label class="btg-label" for="title2">Judul Hero 2</label>
                                <input type="text" class="btg-input" id="title2" name="title2"
                                    value="{{ old('title2', $siteSetting->title2) }}">
                            </div>

                            <div style="margin-bottom: 14px;">
                                <label class="btg-label" for="img2">Gambar Hero 2</label>
                                <input type="file" class="btg-input" id="img2" name="img2" accept="image/*">
                                @if ($siteSetting->img2)
                                    <div style="margin-top: 8px; display: flex; align-items: center; gap: 10px;">
                                        <img src="{{ $siteSetting->img2_url }}" alt="Hero 2 Current"
                                            style="max-height: 50px; border-radius: 6px; border: 1px solid var(--btg-border);">
                                        <span style="font-size: 11px; color: var(--btg-muted);">File saat ini:
                                            {{ basename($siteSetting->img2) }}</span>
                                    </div>
                                @endif
                            </div>

                            <div>
                                <label class="btg-label" for="desc2">Deskripsi Hero 2</label>
                                <textarea class="btg-input" id="desc2" name="desc2" rows="3" style="resize: vertical;">{{ old('desc2', $siteSetting->desc2) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 3. CABANG TOKO --}}
                <div style="margin-bottom: 35px;">
                    <div
                        style="font-family:'Playfair Display', serif; font-size:16px; font-weight:600; color:var(--btg-text); border-bottom:1px solid var(--btg-border); padding-bottom:8px; margin-bottom:20px; display:flex; align-items:center; gap:8px;">
                        <i class="fas fa-store" style="color:var(--btg-gold); font-size:14px;"></i>
                        Informasi Cabang Toko / Outlet
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 24px;">
                        {{-- Store 1 --}}
                        <div
                            style="background: #faf7f4; border: 1px solid var(--btg-border); border-radius: 10px; padding: 20px;">
                            <div
                                style="font-weight: 600; font-size: 13.5px; color: var(--btg-text); margin-bottom: 15px; display: flex; align-items: center; gap: 6px;">
                                <i class="fas fa-map-marker-alt" style="color: var(--btg-accent);"></i>
                                Cabang Toko 1
                            </div>

                            <div style="margin-bottom: 12px;">
                                <label class="btg-label" for="store_name1">Nama Cabang 1 <span>*</span></label>
                                <input type="text" class="btg-input" id="store_name1" name="store_name1"
                                    value="{{ old('store_name1', $siteSetting->store_name1) }}" required>
                            </div>

                            <div style="margin-bottom: 12px;">
                                <label class="btg-label" for="address1">address Cabang 1 <span>*</span></label>
                                <input type="text" class="btg-input" id="address1" name="address1"
                                    value="{{ old('address1', $siteSetting->address1) }}" required>
                            </div>

                            <div style="margin-bottom: 12px;">
                                <label class="btg-label" for="phone1">Telepon Cabang 1</label>
                                <input type="text" class="btg-input" id="phone1" name="phone1"
                                    value="{{ old('phone1', $siteSetting->phone1) }}">
                            </div>

                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 12px;">
                                <div>
                                    <label class="btg-label" for="lat_coordinate1">Latitude</label>
                                    <input type="text" class="btg-input" id="lat_coordinate1" name="lat_coordinate1"
                                        value="{{ old('lat_coordinate1', $siteSetting->lat_coordinate1) }}"
                                        placeholder="-6.1234">
                                </div>
                                <div>
                                    <label class="btg-label" for="lon_coordinate1">Longitude</label>
                                    <input type="text" class="btg-input" id="lon_coordinate1" name="lon_coordinate1"
                                        value="{{ old('lon_coordinate1', $siteSetting->lon_coordinate1) }}"
                                        placeholder="106.1234">
                                </div>
                            </div>

                            <div style="margin-bottom: 12px;">
                                <label class="btg-label">Pilih di Peta (Geser penanda / klik peta)</label>
                                <div id="map-picker-1"
                                    style="height: 180px; border-radius: 9px; border: 1.5px solid var(--btg-border); z-index: 1;">
                                </div>
                            </div>

                            <div style="margin-bottom: 12px;">
                                <label class="btg-label" for="img_store1">Gambar Toko 1</label>
                                <input type="file" class="btg-input" id="img_store1" name="img_store1"
                                    accept="image/*">
                                @if ($siteSetting->img_store1)
                                    <div style="margin-top: 8px; display: flex; align-items: center; gap: 10px;">
                                        <img src="{{ $siteSetting->img_store1_url }}" alt="Toko 1 Current"
                                            style="max-height: 50px; border-radius: 6px; border: 1px solid var(--btg-border);">
                                        <span style="font-size: 11px; color: var(--btg-muted);">File saat ini:
                                            {{ basename($siteSetting->img_store1) }}</span>
                                    </div>
                                @endif
                            </div>

                            <div>
                                <label class="btg-label" for="store_link1">Link pesan toko 1</label>
                                <input type="url" class="btg-input" id="store_link1" name="store_link1"
                                    value="{{ old('store_link1', $siteSetting->store_link1) }}"
                                    placeholder="https://maps.google.com/...">
                            </div>
                        </div>

                        {{-- Store 2 --}}
                        <div
                            style="background: #faf7f4; border: 1px solid var(--btg-border); border-radius: 10px; padding: 20px;">
                            <div
                                style="font-weight: 600; font-size: 13.5px; color: var(--btg-text); margin-bottom: 15px; display: flex; align-items: center; gap: 6px;">
                                <i class="fas fa-map-marker-alt" style="color: var(--btg-gold);"></i>
                                Cabang Toko 2 (Opsional)
                            </div>

                            <div style="margin-bottom: 12px;">
                                <label class="btg-label" for="store_name2">Nama Cabang 2</label>
                                <input type="text" class="btg-input" id="store_name2" name="store_name2"
                                    value="{{ old('store_name2', $siteSetting->store_name2) }}">
                            </div>

                            <div style="margin-bottom: 12px;">
                                <label class="btg-label" for="address2">address Cabang 2</label>
                                <input type="text" class="btg-input" id="address2" name="address2"
                                    value="{{ old('address2', $siteSetting->address2) }}">
                            </div>

                            <div style="margin-bottom: 12px;">
                                <label class="btg-label" for="phone2">Telepon Cabang 2</label>
                                <input type="text" class="btg-input" id="phone2" name="phone2"
                                    value="{{ old('phone2', $siteSetting->phone2) }}">
                            </div>

                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 12px;">
                                <div>
                                    <label class="btg-label" for="lat_coordinate2">Latitude</label>
                                    <input type="text" class="btg-input" id="lat_coordinate2" name="lat_coordinate2"
                                        value="{{ old('lat_coordinate2', $siteSetting->lat_coordinate2) }}"
                                        placeholder="-6.1234">
                                </div>
                                <div>
                                    <label class="btg-label" for="lon_coordinate2">Longitude</label>
                                    <input type="text" class="btg-input" id="lon_coordinate2" name="lon_coordinate2"
                                        value="{{ old('lon_coordinate2', $siteSetting->lon_coordinate2) }}"
                                        placeholder="106.1234">
                                </div>
                            </div>

                            <div style="margin-bottom: 12px;">
                                <label class="btg-label">Pilih di Peta (Geser penanda / klik peta)</label>
                                <div id="map-picker-2"
                                    style="height: 180px; border-radius: 9px; border: 1.5px solid var(--btg-border); z-index: 1;">
                                </div>
                            </div>

                            <div style="margin-bottom: 12px;">
                                <label class="btg-label" for="img_store2">Gambar Toko 2</label>
                                <input type="file" class="btg-input" id="img_store2" name="img_store2"
                                    accept="image/*">
                                @if ($siteSetting->img_store2)
                                    <div style="margin-top: 8px; display: flex; align-items: center; gap: 10px;">
                                        <img src="{{ $siteSetting->img_store2_url }}" alt="Toko 2 Current"
                                            style="max-height: 50px; border-radius: 6px; border: 1px solid var(--btg-border);">
                                        <span style="font-size: 11px; color: var(--btg-muted);">File saat ini:
                                            {{ basename($siteSetting->img_store2) }}</span>
                                    </div>
                                @endif
                            </div>

                            <div>
                                <label class="btg-label" for="store_link2">Link pesan toko 2</label>
                                <input type="url" class="btg-input" id="store_link2" name="store_link2"
                                    value="{{ old('store_link2', $siteSetting->store_link2) }}"
                                    placeholder="https://maps.google.com/...">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 4. KONTAK & address UTAMA --}}
                <div style="margin-bottom: 30px;">
                    <div
                        style="font-family:'Playfair Display', serif; font-size:16px; font-weight:600; color:var(--btg-text); border-bottom:1px solid var(--btg-border); padding-bottom:8px; margin-bottom:20px; display:flex; align-items:center; gap:8px;">
                        <i class="fas fa-envelope" style="color:var(--btg-gold); font-size:14px;"></i>
                        Kontak & address Utama (Footer)
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
                        <div>
                            <label class="btg-label" for="email">Email Utama</label>
                            <input type="email" class="btg-input" id="email" name="email"
                                value="{{ old('email', $siteSetting->email) }}"
                                placeholder="Contoh: info@bentengkopi.com">
                        </div>
                        <div>
                            <label class="btg-label" for="phone">Telepon Utama</label>
                            <input type="text" class="btg-input" id="phone" name="phone"
                                value="{{ old('phone', $siteSetting->phone) }}" placeholder="Contoh: +62 812-3456-7890">
                        </div>
                        <div style="grid-column: 1 / -1;">
                            <label class="btg-label" for="address">address Utama / Kantor Pusat</label>
                            <input type="text" class="btg-input" id="address" name="address"
                                value="{{ old('address', $siteSetting->address) }}"
                                placeholder="Contoh: Jl. Benteng Raya No. 45, Jakarta Selatan">
                        </div>
                    </div>
                </div>

                {{-- ACTION BUTTONS --}}
                <div
                    style="border-top: 1px solid var(--btg-border); padding-top: 24px; display: flex; justify-content: flex-end; gap: 10px;">
                    <a href="{{ route('admin.dashboard') }}" class="btn-cancel"
                        style="text-decoration: none; display: inline-flex; align-items: center; justify-content: center;">Batal</a>
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <style>
        .leaflet-container {
            cursor: crosshair;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- MAP 1 ---
            var latInput1 = document.getElementById('lat_coordinate1');
            var lngInput1 = document.getElementById('lon_coordinate1');

            var initLat1 = parseFloat(latInput1.value) || 52.3676;
            var initLng1 = parseFloat(lngInput1.value) || 4.9041;

            var map1 = L.map('map-picker-1').setView([initLat1, initLng1], 13);

            L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
                maxZoom: 20
            }).addTo(map1);

            var marker1 = L.marker([initLat1, initLng1], {
                draggable: true
            }).addTo(map1);

            marker1.on('dragend', function(e) {
                var pos = marker1.getLatLng();
                latInput1.value = pos.lat.toFixed(6);
                lngInput1.value = pos.lng.toFixed(6);
            });

            map1.on('click', function(e) {
                marker1.setLatLng(e.latlng);
                latInput1.value = e.latlng.lat.toFixed(6);
                lngInput1.value = e.latlng.lng.toFixed(6);
            });

            function updateMap1() {
                var lat = parseFloat(latInput1.value);
                var lng = parseFloat(lngInput1.value);
                if (!isNaN(lat) && !isNaN(lng)) {
                    marker1.setLatLng([lat, lng]);
                    map1.setView([lat, lng], map1.getZoom());
                }
            }
            latInput1.addEventListener('input', updateMap1);
            lngInput1.addEventListener('input', updateMap1);


            // --- MAP 2 ---
            var latInput2 = document.getElementById('lat_coordinate2');
            var lngInput2 = document.getElementById('lon_coordinate2');

            var initLat2 = parseFloat(latInput2.value) || 52.3676;
            var initLng2 = parseFloat(lngInput2.value) || 4.9041;

            var map2 = L.map('map-picker-2').setView([initLat2, initLng2], 13);

            L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
                maxZoom: 20
            }).addTo(map2);

            var marker2 = L.marker([initLat2, initLng2], {
                draggable: true
            }).addTo(map2);

            marker2.on('dragend', function(e) {
                var pos = marker2.getLatLng();
                latInput2.value = pos.lat.toFixed(6);
                lngInput2.value = pos.lng.toFixed(6);
            });

            map2.on('click', function(e) {
                marker2.setLatLng(e.latlng);
                latInput2.value = e.latlng.lat.toFixed(6);
                lngInput2.value = e.latlng.lng.toFixed(6);
            });

            function updateMap2() {
                var lat = parseFloat(latInput2.value);
                var lng = parseFloat(lngInput2.value);
                if (!isNaN(lat) && !isNaN(lng)) {
                    marker2.setLatLng([lat, lng]);
                    map2.setView([lat, lng], map2.getZoom());
                }
            }
            latInput2.addEventListener('input', updateMap2);
            lngInput2.addEventListener('input', updateMap2);

            // Fix potential Leaflet sizing issues on render
            setTimeout(function() {
                map1.invalidateSize();
                map2.invalidateSize();
            }, 400);

            // --- Alert Auto-dismiss ---
            setTimeout(() => {
                document.querySelectorAll('.btg-alert').forEach(el => {
                    el.style.transition = 'opacity .4s, transform .4s';
                    el.style.opacity = '0';
                    el.style.transform = 'translateY(-8px)';
                    setTimeout(() => el.remove(), 400);
                });
            }, 4000);
        });
    </script>
@endpush
