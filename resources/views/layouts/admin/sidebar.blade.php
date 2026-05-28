<aside class="btg-sidebar">

    {{-- Brand --}}
    <a href="{{ route('admin.dashboard') }}" class="btg-brand">
        <div class="btg-brand-icon">
            <i class="fas fa-store"></i>
        </div>
        <div>
            <div class="btg-brand-text">BENTENG</div>
            <div class="btg-brand-sub">Admin Panel</div>
        </div>
    </a>

    {{-- User --}}
    <div class="btg-user">
        <div class="btg-user-avatar">
            {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
        </div>
        <div>
            <div class="btg-user-name">{{ auth()->user()->name ?? 'Administrator' }}</div>
            <div class="btg-user-role">Admin</div>
        </div>
    </div>

    {{-- Nav --}}
    <nav style="margin-top: 20px; flex: 1;">

        <div class="btg-nav-header">Utama</div>

        <a href="{{ route('admin.dashboard') }}"
            class="btg-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-th-large"></i>
            Dashboard
        </a>

        <div class="btg-nav-header">Kelola Menu</div>

        <a href="{{ route('admin.categories.index') }}"
            class="btg-nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <i class="fas fa-tags"></i>
            Kategori
        </a>

        <a href="{{ route('admin.products.index') }}"
            class="btg-nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
            <i class="fas fa-utensils"></i>
            Produk
        </a>

        <a href="{{ route('admin.rames.edit') }}"
            class="btg-nav-link {{ request()->routeIs('admin.rames.*') ? 'active' : '' }}">
            <i class="fas fa-stream"></i>
            Manage Rames
        </a>

        <a href="{{ route('admin.site-settings.edit') }}"
            class="btg-nav-link {{ request()->routeIs('admin.site-settings.*') ? 'active' : '' }}">
            <i class="fas fa-cog"></i>
            Pengaturan Website
        </a>

        <a href="{{ route('admin.site-settings-nl.edit') }}"
            class="btg-nav-link {{ request()->routeIs('admin.site-settings-nl.*') ? 'active' : '' }}">
            <i class="fas fa-cog"></i>
            Pengaturan Website NL
        </a>

        <div class="btg-nav-divider"></div>

        <a href="{{ route('client.index') }}" target="_blank" class="btg-nav-link">
            <i class="fas fa-external-link-alt"></i>
            Lihat Website
        </a>

        {{-- Logout --}}
        <a href="#" class="btg-nav-link danger"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>
            Keluar
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
        </form>

    </nav>

    {{-- Footer --}}
    <div class="btg-sidebar-footer">
        <span>BENTENG &copy; {{ date('Y') }}</span>
    </div>

</aside>
