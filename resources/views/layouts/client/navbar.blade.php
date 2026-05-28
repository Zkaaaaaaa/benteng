@php
    $isEnglish = request()->routeIs('client.index');
    $isHome = request()->routeIs('client.index', 'client.index-nl');
    $homeUrl = $isEnglish ? route('client.index') : route('client.index-nl');
    $menuLabel = $isEnglish ? 'Menu' : 'Menukaart';
    $contactLabel = $isEnglish ? 'Locations' : 'Contact';
@endphp

<nav class="navbar{{ $isHome ? '' : ' is-scrolled' }}" id="siteNavbar">
    <div class="navbar__container">
        <a href="{{ $isHome ? '#hero' : $homeUrl . '#hero' }}" class="navbar__logo">
            @if(!empty($site?->logo))
                <img src="{{ asset($site->logo) }}" alt="Benteng Indonesische Delicatessen">
            @endif
        </a>

        <button class="navbar__toggle" id="navToggle" aria-label="Menu" type="button">
            <span></span><span></span><span></span>
        </button>

        <ul class="navbar__menu" id="navMenu">
            <li><a href="{{ $isHome ? '#hero' : $homeUrl . '#hero' }}" class="navbar__link">Home</a></li>
            <li><a href="{{ $isHome ? '#rames' : $homeUrl . '#rames' }}" class="navbar__link">{{ $menuLabel }}</a></li>
            <li><a href="{{ $isHome ? '#locations' : $homeUrl . '#locations' }}" class="navbar__link">{{ $contactLabel }}</a></li>
            <li class="navbar__lang">
                <a href="{{ route('client.index-nl') }}"
                    class="navbar__lang-btn{{ $isEnglish ? '' : ' is-active' }}"
                    title="Nederlands">
                    <img src="{{ asset('assets/images/NL.png') }}" alt="NL" width="20" height="14">
                    <span>NL</span>
                </a>
                <a href="{{ route('client.index') }}"
                    class="navbar__lang-btn{{ $isEnglish ? ' is-active' : '' }}"
                    title="English">
                    <img src="{{ asset('assets/images/EN.png') }}" alt="EN" width="20" height="14">
                    <span>EN</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
