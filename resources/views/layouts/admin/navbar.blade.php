<header class="btg-topbar">

    {{-- Mobile toggle --}}
    <button id="sidebar-toggle" class="btg-icon-btn d-lg-none" aria-label="Toggle sidebar">
        <i class="fas fa-bars"></i>
    </button>

    {{-- Page title (diisi via @section atau default) --}}
    <div class="btg-topbar-title">
        @yield('page_title', 'Dashboard')
        <span>@yield('page_subtitle', 'Selamat datang kembali')</span>
    </div>

    {{-- Actions --}}
    <div class="btg-topbar-actions">

        {{-- Notifikasi --}}
        <a href="#" class="btg-icon-btn" title="Notifikasi">
            <i class="far fa-bell"></i>
            <span class="btg-badge"></span>
        </a>

        {{-- Lihat website --}}
        <a href="{{ route('client.index') }}" target="_blank" class="btg-view-site">
            <i class="fas fa-external-link-alt" style="font-size:11px;"></i>
            Website
        </a>

    </div>

</header>
