@extends('layouts.client.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/gallery.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/js/gallery-carousel.js') }}" defer></script>
@endpush

@section('content')
    {{-- ═══════════════════════════════════════
     HERO SECTION
════════════════════════════════════════ --}}
    <section class="hero" id="hero">
        <div class="hero__bg">
            <img src="{{ $site->img1_url }}" alt="Indonesian food" class="hero__image">
            <div class="hero__overlay"></div>
        </div>
        <div class="hero__inner">
            <div class="hero__content">
                <h1 class="hero__title">{{ $site->desc1 }}</h1>
                <div class="hero__actions">
                    <a href="#locations" class="btn btn--light">Our Locations</a>
                    <a href="#rames" class="btn btn--light">View Menu</a>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════
     ABOUT / VERHAAL SECTION
════════════════════════════════════════ --}}
    <section class="about" id="about">
        <div class="about__container">
            <div class="about__image-wrap">
                <img src="{{ $site->img2_url }}" alt="Benteng winkel" class="about__image">
            </div>
            <div class="about__content">
                <h2 class="section-title">{{ $site->title2 }}</h2>
                <p class="about__text">
                    {{ $site->desc2 }}
                </p>
            </div>
        </div>
    </section>

    @include('client.partials.gallery', [
        'galleryHeading' => 'Gallery',
        'galleryEmptyText' => 'Our dish photos will appear here soon.',
        'galleryPhotos' => $galleryPhotos,
    ])

    {{-- ═══════════════════════════════════════
     LOCATIES SECTION
════════════════════════════════════════ --}}
    <section class="locations" id="locations">
        <div class="locations__container">
            <h2 class="section-title section-title--center">Our Locations</h2>

            <div class="locations__grid">
                <div class="locations__cards">

                    {{-- Locatie 1 --}}
                    <div class="location-card">
                        <div>
                            <img src="{{ $site->img_store1_url }}" alt="Benteng">
                        </div>
                        <div class="location-card__info">
                            <h3 class="location-card__name">{{ $site->store_name1 }}</h3>
                            <p>{{ $site->address1 }}</p>
                            <p>{{ $site->phone1 }}</p>
                            <div class="orderbutton">
                                <a href="{{ $site->store_link1 }}" target="_blank" class="btn btn--primary">Order
                                    Online</a>
                            </div>
                        </div>
                    </div>

                    {{-- Locatie 2 --}}
                    <div class="location-card">
                        <div>
                            <img src="{{ $site->img_store2_url }}" alt="Benteng">
                        </div>
                        <div class="location-card__info">
                            <h3 class="location-card__name">{{ $site->store_name2 }}</h3>
                            <p>{{ $site->address2 }}</p>
                            <p>{{ $site->phone2 }}</p>
                            <div class="orderbutton">
                                <a href="{{ $site->store_link2 }}" target="_blank" class="btn btn--primary">Order
                                    Online</a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="locations__map" id="client-locations-map">
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════
     RAMES SECTION
════════════════════════════════════════ --}}
    <section class="rames" id="rames">
        <div class="rames__container">
            <div class="rames__header">
                <h2 class="rames__title">{{ $ramesSetting->title_en ?? 'Our Rames' }}</h2>
                <p class="rames__subtitle">{{ $ramesSetting->subtitle_en ?? 'Just the Way You Like It' }}</p>
            </div>

            <div class="rames__sizebar">
                <div class="sizebar__item sizebar__item--left">
                    <p class="sizebar__price"><span>{{ number_format((float) ($ramesSetting->small_price ?? 13.75), 2) }}</span> <strong>{{ $ramesSetting->small_title_en ?? 'KLEIN' }}</strong></p>
                    <p class="sizebar__desc">{{ $ramesSetting->small_desc ?? '1x meat or fish, 1x vegetables & sambal goreng egg' }}</p>
                </div>
                <div class="sizebar__middle">
                    <p class="sizebar__hint">{{ $ramesSetting->instruction_en ?? 'Choose your size first, then complete your rames in 3 simple steps.' }}</p>
                </div>
                <div class="sizebar__item sizebar__item--right">
                    <p class="sizebar__price sizebar__price--groot"><strong>{{ $ramesSetting->large_title_en ?? 'GROOT' }}</strong> <span class="sizebar__plus">+ {{ number_format((float) ($ramesSetting->large_surcharge ?? 3), 2) }}</span></p>
                    <p class="sizebar__desc">{{ $ramesSetting->large_desc ?? '2x meat or fish, 2x vegetables, Tahoe or Tempe & sambal goreng egg' }}</p>
                </div>
            </div>

            @php
                $basisItems = $ramesMenu['basis'] ?? collect();
                $kipItems = $ramesMenu['kip'] ?? collect();
                $vleesItems = $ramesMenu['vlees'] ?? collect();
                $visItems = $ramesMenu['vis'] ?? collect();
                $groenteItems = $ramesMenu['groenten'] ?? collect();
            @endphp

            <div class="rames__steps">
                <div class="step">
                    <div class="step__circle-wrap"><div class="step__circle"><span class="step__num">1</span></div></div>
                    <div class="step__col">
                        <h4 class="step__col-head">DE BASIS</h4>
                        <ul class="step__list">
                            @forelse($basisItems as $product)
                                <li class="step__item">
                                    <strong>{{ strtoupper($product->name) }} @if($product->is_spicy)<span class="chili">🌶</span>@endif</strong>
                                    @php($description = $product->description_en ?: ($product->description_nl ?: $product->description))
                                    @if($description)<span>{{ $description }}</span>@endif
                                </li>
                            @empty
                                <li class="step__item"><span>No base items configured yet.</span></li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                <div class="step step--wide">
                    <div class="step__circle-wrap"><div class="step__circle"><span class="step__num">2</span></div></div>
                    <div class="step__cols3">
                        <div class="step__col">
                            <h4 class="step__col-head">KIP</h4>
                            <ul class="step__list">
                                @forelse($kipItems as $product)
                                    <li class="step__item">
                                        <strong>{{ strtoupper($product->name) }} @if($product->is_spicy)<span class="chili">🌶</span>@endif</strong>
                                        @php($description = $product->description_en ?: ($product->description_nl ?: $product->description))
                                        @if($description)<span>{{ $description }}</span>@endif
                                    </li>
                                @empty
                                    <li class="step__item"><span>-</span></li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="step__col">
                            <h4 class="step__col-head">VLEES</h4>
                            <ul class="step__list">
                                @forelse($vleesItems as $product)
                                    <li class="step__item">
                                        <strong>{{ strtoupper($product->name) }} @if($product->is_spicy)<span class="chili">🌶</span>@endif</strong>
                                        @php($description = $product->description_en ?: ($product->description_nl ?: $product->description))
                                        @if($description)<span>{{ $description }}</span>@endif
                                    </li>
                                @empty
                                    <li class="step__item"><span>-</span></li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="step__col">
                            <h4 class="step__col-head">VIS</h4>
                            <ul class="step__list">
                                @forelse($visItems as $product)
                                    <li class="step__item">
                                        <strong>{{ strtoupper($product->name) }} @if($product->is_spicy)<span class="chili">🌶</span>@endif</strong>
                                        @php($description = $product->description_en ?: ($product->description_nl ?: $product->description))
                                        @if($description)<span>{{ $description }}</span>@endif
                                    </li>
                                @empty
                                    <li class="step__item"><span>-</span></li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="step">
                    <div class="step__circle-wrap"><div class="step__circle"><span class="step__num">3</span></div></div>
                    <div class="step__col">
                        <h4 class="step__col-head">DE GROENTEN</h4>
                        <ul class="step__list">
                            @forelse($groenteItems as $product)
                                <li class="step__item">
                                    <strong>{{ strtoupper($product->name) }} @if($product->is_spicy)<span class="chili">🌶</span>@endif</strong>
                                    @php($description = $product->description_en ?: ($product->description_nl ?: $product->description))
                                    @if($description)<span>{{ $description }}</span>@endif
                                </li>
                            @empty
                                <li class="step__item"><span>No vegetable items configured yet.</span></li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            @if(($ramesSetting->bottom_title_en ?? null) || ($ramesSetting->bottom_text_en ?? null))
                <div class="text-center mt-8">
                    @if($ramesSetting->bottom_title_en)
                        <p class="rames__extra"><strong>{{ $ramesSetting->bottom_title_en }}</strong></p>
                    @endif
                    @if($ramesSetting->bottom_text_en)
                        <p class="sizebar__desc">{{ $ramesSetting->bottom_text_en }}</p>
                    @endif
                </div>
            @endif

            <div class="text-center mt-8">
                <button type="button" class="btn btn--outline" id="open-full-menu">{{ $ramesSetting->button_label_en ?? 'View Full Menu' }}</button>
            </div>
        </div>
    </section>

    <div id="full-menu-modal" class="full-menu-modal">
        <div class="full-menu-dialog">
            <button type="button" class="full-menu-close" id="close-full-menu">×</button>
            <h3 class="rames__title">Full Menu</h3>
            @foreach(($categories ?? collect())->filter(fn ($c) => $c->products->isNotEmpty()) as $category)
                <div class="full-menu-group">
                    <h4>{{ $category->name }}</h4>
                    @foreach($category->products as $product)
                        <div class="full-menu-item">
                            <div>
                                <strong>{{ $product->name }}</strong>
                                @php($description = $product->description_en ?: ($product->description_nl ?: $product->description))
                                @if($description)<p>{{ $description }}</p>@endif
                            </div>
                            <span>€{{ number_format((float) $product->price, 2, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>

    {{-- FOOTER --}}
    <footer class="footer">
        <div class="footer__container">
            <div class="footer__brand">
                <img src="{{ $site->logo_url }}" alt="Benteng" class="footer__logo">
            </div>

            <div class="footer__info">
                <div class="footer__block footer__block--address">
                    <h4 class="footer__title">Address</h4>
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

                <div class="footer__block footer__block--meta">
                    <div class="footer__hours-wrap">
                        <h4 class="footer__title">{{ $site->title }}</h4>
                        <p class="footer__hours">{{ $site->opening_hour }}</p>
                    </div>
                    <div class="footer__contact-wrap">
                        <h4 class="footer__title">Contact</h4>
                        <p class="footer__email">{{ $site->email }}</p>
                        <p class="footer__phone">{{ $site->phone }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer__bottom">
            <p>&copy; {{ date('Y') }} Benteng Indonesische Delicatessen. All rights reserved.</p>
        </div>
    </footer>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
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

            var openBtn = document.getElementById('open-full-menu');
            var closeBtn = document.getElementById('close-full-menu');
            var modal = document.getElementById('full-menu-modal');
            if (openBtn && closeBtn && modal) {
                openBtn.addEventListener('click', function() {
                    modal.classList.add('open');
                });
                closeBtn.addEventListener('click', function() {
                    modal.classList.remove('open');
                });
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) modal.classList.remove('open');
                });
            }
        });
    </script>
@endpush
