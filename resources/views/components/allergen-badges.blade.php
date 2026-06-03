@props(['product', 'locale' => 'en'])

@php
    $badges = $product->activeAllergenBadges($locale);
@endphp

@if(count($badges) > 0)
    <span class="allergen-badges" {{ $attributes }}>
        @foreach($badges as $badge)
            <span class="allergen-badge" title="{{ $badge['label'] }}" aria-label="{{ $badge['label'] }}">{{ $badge['icon'] }}</span>
        @endforeach
    </span>
@endif
