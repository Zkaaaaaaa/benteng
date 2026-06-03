@props(['product', 'locale' => 'en'])

@php
    $badges = $product->activeAllergenBadges($locale);
@endphp

<span class="allergen-badges" {{ $attributes }}>
    @if(count($badges) > 0)
        @foreach($badges as $badge)
            <span class="allergen-badge" title="{{ $badge['label'] }}">{{ $badge['icon'] }} {{ $badge['label'] }}</span>
        @endforeach
    @else
        <span class="allergen-none">{{ $locale === 'nl' ? 'Geen allergenen' : 'No allergens' }}</span>
    @endif
</span>
