<nav class="navbar">
    <div class="navbar__container">
        <a href="#" class="navbar__logo">
            <img src="{{ asset($site->logo) }}" alt="Benteng Indonesische Delicatessen">
        </a>

        <button class="navbar__toggle" id="navToggle" aria-label="Menu">
            <span></span><span></span><span></span>
        </button>

        <ul class="navbar__menu" id="navMenu">
            <li><a href="#" class="navbar__link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
            <li><a href="#" class="navbar__link {{ request()->routeIs('menu') ? 'active' : '' }}">Menukaart</a>
            </li>
            <li><a href="#" class="navbar__link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
            </li>
            <li class="navbar__lang">
                <a href="{{ route('client.index-nl') }}" class="navbar__lang-btn">
                    <img src="{{ asset('assets/images/NL.png') }}" alt="NL" width="22">
                    <span>NL</span>
                </a>
                <a href="{{ route('client.index') }}" class="navbar__lang-btn">
                    <img src="{{ asset('assets/images/EN.png') }}" alt="EN" width="22">
                    <span>EN</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

<script>
    document.getElementById('navToggle').addEventListener('click', function() {
        document.getElementById('navMenu').classList.toggle('open');
    });
</script>
