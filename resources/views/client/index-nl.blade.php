@extends('layouts.client.app')

@section('content')
    {{-- ═══════════════════════════════════════
     HERO SECTION
════════════════════════════════════════ --}}
    <section class="hero">
        <div class="hero__content">
            <h1 class="hero__title">
                {{ $site->desc1 }}
            </h1>
            <div class="hero__actions">
                <a href="#" class="btn btn--outline">Online Bestellen</a>
                <a href="#" class="btn btn--outline">Bekijk Menukaart</a>
            </div>
        </div>
        <div class="hero__visual">
            <img src="{{ asset($site->img1) }}" alt="Indonesisch eten" class="hero__image">
            <div class="hero__overlay"></div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════
     ABOUT / VERHAAL SECTION
════════════════════════════════════════ --}}
    <section class="about">
        <div class="about__container">
            <div class="about__image-wrap">
                <img src="{{ asset($site->img2) }}" alt="Benteng winkel" class="about__image">
            </div>
            <div class="about__content">
                <h2 class="section-title">{{ $site->title2 }}</h2>
                <p class="about__text">
                    {{ $site->desc2 }}
                </p>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════
     LOCATIES SECTION
════════════════════════════════════════ --}}
    <section class="locations">
        <div class="locations__container">
            <h2 class="section-title section-title--center">Onze Locaties</h2>

            <div class="locations__grid">
                <div class="locations__cards">

                    {{-- Locatie 1 --}}
                    <div class="location-card">
                        <div>
                            <img src="{{ asset($site->img_store1) }}" alt="Benteng">
                        </div>
                        <div class="location-card__info">
                            <h3 class="location-card__name">{{ $site->store_name1 }}</h3>
                            <p>{{ $site->address1 }}</p>
                            <p>{{ $site->phone1 }}</p>
                            <div class="orderbutton">
                                <a href="{{ $site->store_link1 }}" target="_blank" class="btn btn--primary">Online
                                    Bestellen</a>
                            </div>
                        </div>
                    </div>

                    {{-- Locatie 2 --}}
                    <div class="location-card">
                        <div>
                            <img src="{{ asset($site->img_store2) }}" alt="Benteng">
                        </div>
                        <div class="location-card__info">
                            <h3 class="location-card__name">{{ $site->store_name2 }}</h3>
                            <p>{{ $site->address2 }}</p>
                            <p>{{ $site->phone2 }}</p>
                            <div class="orderbutton">
                                <a href="{{ $site->store_link2 }}" target="_blank" class="btn btn--primary">Online
                                    Bestellen</a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="locations__map" id="client-locations-map" style="min-height: 450px; height: 100%; z-index: 1;">
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════
     RAMES SECTION
════════════════════════════════════════ --}}
    <section class="rames">
        <div class="rames__container">

            {{-- Header --}}
            <div class="rames__header">
                <h2 class="rames__title">Onze Rames</h2>
                <p class="rames__subtitle">Zoals Jij Het Wilt</p>
            </div>

            {{-- Size Picker Bar --}}
            <div class="rames__sizebar">
                <div class="sizebar__item sizebar__item--left">
                    <p class="sizebar__price"><span>13.75</span> <strong>KLEIN</strong></p>
                    <p class="sizebar__desc">1x vlees of vis, 1x groente &amp; sambal goreng ei</p>
                </div>
                <div class="sizebar__middle">
                    <p class="sizebar__hint">Kies eerst jouw grootte en kies daarna<br>in 3 simpele stappen de rest van jouw
                        rames.</p>
                </div>
                <div class="sizebar__item sizebar__item--right">
                    <p class="sizebar__price sizebar__price--groot"><strong>GROOT</strong> <span class="sizebar__plus">+
                            3,-</span></p>
                    <p class="sizebar__desc">2x vlees of vis, 2x groente, Tahoe of Tempe &amp; sambal goreng ei</p>
                </div>
            </div>

            @php
                $menuCategories = ($categories ?? collect())->filter(fn ($category) => $category->products->isNotEmpty())->values();
            @endphp

            {{-- Dynamic Category Grid --}}
            <div class="rames__steps">
                @forelse($menuCategories as $index => $category)
                    <div class="step {{ $loop->first ? 'step--wide' : '' }}">
                        <div class="step__circle-wrap">
                            <div class="step__circle">
                                <span class="step__num">{{ $index + 1 }}</span>
                            </div>
                        </div>

                        <div class="step__col">
                            <h4 class="step__col-head">{{ strtoupper($category->name) }}</h4>
                            @if($category->subtitle)
                                <p class="sizebar__desc" style="margin-bottom: 12px;">{{ $category->subtitle }}</p>
                            @endif
                            <ul class="step__list">
                                @foreach($category->products as $product)
                                    <li class="step__item">
                                        <strong>
                                            {{ strtoupper($product->name) }}
                                            @if($product->is_spicy)
                                                <span class="chili">🌶</span>
                                            @endif
                                        </strong>
                                        @php
                                            $description = $product->description_nl ?: ($product->description_en ?: $product->description);
                                        @endphp
                                        @if($description)
                                            <span>{{ $description }}</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @empty
                    <p class="rames__extra">Menu wordt binnenkort bijgewerkt.</p>
                @endforelse
            </div>{{-- /.rames__steps --}}

        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="footer">
        <div class="footer__container">

            <div class="footer__brand">
                <img src="{{ asset($site->logo) }}" alt="Benteng" class="footer__logo">
                <p class="footer__tagline">Indonesische Delicatessen</p>
            </div>

            <div class="footer__block">
                <h4 class="footer__title">Adres</h4>
                <div class="footer__location">
                    <p class="footer__location-name">{{ $site->store_name1 }}</p>
                    <p>{{ $site->address1 }}</p>
                    <p>{{ $site->phone1 }}</p>
                </div>
                <div class="footer__location">
                    <p class="footer__location-name">{{ $site->store_name2 }}</p>
                    <p>{{ $site->address2 }}</p>
                    <p>{{ $site->phone2 }}</p>
                </div>
            </div>

            <div class="footer__block">
                <h4 class="footer__title">{{ $site->title }}</h4>
                <p class="footer__hours">{{ $site->opening_hour }}</p>
            </div>

            <div class="footer__block">
                <h4 class="footer__title">Contact</h4>
                <p class="footer__email">{{ $site->email }}</p>
                <p class="footer__phone">{{ $site->phone }}</p>
            </div>

        </div>

        <div class="footer__bottom">
            <p>&copy; {{ date('Y') }} Benteng Indonesische Delicatessen. Alle rechten voorbehouden.</p>
        </div>
    </footer>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <style>
        .leaflet-popup-content-wrapper {
            background: #000;
            color: #fff;
            font-family: 'Raleway', sans-serif;
            border-radius: 12px;
            padding: 6px;
        }

        .leaflet-popup-content b {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.5rem;
            letter-spacing: 0.5px;
            color: #fff;
        }

        .leaflet-popup-tip {
            background: #000;
        }

        .leaflet-popup-content p {
            margin: 4px 0 0;
            font-size: 0.95rem;
            color: rgba(255, 255, 255, 0.85);
            font-weight: 500;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var store1 = {
                name: @json($site->store_name1 ?? 'Store 1'),
                address: @json($site->address1 ?? ''),
                lat: parseFloat(@json($site->lat_coordinate1)),
                lng: parseFloat(@json($site->lon_coordinate1))
            };

            var store2 = {
                name: @json($site->store_name2 ?? 'Store 2'),
                address: @json($site->address2 ?? ''),
                lat: parseFloat(@json($site->lat_coordinate2)),
                lng: parseFloat(@json($site->lon_coordinate2))
            };

            var map = L.map('client-locations-map');

            L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
                subdomains: 'abcd',
                maxZoom: 20
            }).addTo(map);

            var markers = [];

            if (!isNaN(store1.lat) && !isNaN(store1.lng)) {
                var marker1 = L.marker([store1.lat, store1.lng]).addTo(map)
                    .bindPopup('<b>' + store1.name + '</b><p>' + store1.address + '</p>');
                markers.push(marker1);
            }

            if (!isNaN(store2.lat) && !isNaN(store2.lng)) {
                var marker2 = L.marker([store2.lat, store2.lng]).addTo(map)
                    .bindPopup('<b>' + store2.name + '</b><p>' + store2.address + '</p>');
                markers.push(marker2);
            }

            if (markers.length > 0) {
                var group = new L.featureGroup(markers);
                map.fitBounds(group.getBounds().pad(0.15));
            } else {
                map.setView([52.3676, 4.9041], 12);
            }
        });
    </script>
@endpush
