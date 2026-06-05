@props(['locale' => 'en'])

@php
    $title = $locale === 'nl' ? 'Uitleg allergenen' : 'Allergen guide';
    $labelKey = $locale === 'nl' ? 'nl' : 'en';
@endphp

<div class="allergen-legend" {{ $attributes }}>
    <p class="allergen-legend__title">{{ $title }}</p>
    <div class="allergen-legend__items">
        @foreach (\App\Models\Product::allergenCatalog() as $meta)
            <span class="allergen-legend__item">
                <span class="allergen-legend__icon" aria-hidden="true">{{ $meta['icon'] }}</span>
                <span class="allergen-legend__label">{{ $meta[$labelKey] }}</span>
            </span>
        @endforeach
    </div>
</div>
