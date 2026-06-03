@props(['product', 'locale' => 'en'])

@php
    $badges = $product->activeAllergenBadges($locale);
@endphp

@if(count($badges) > 0)
    <span class="allergen-badges" {{ $attributes }}>
        @foreach($badges as $badge)
            <span class="allergen-badge" title="{{ $badge['label'] }}">{{ $badge['icon'] }} {{ $badge['label'] }}</span>
        @endforeach
    </span>
@endif
