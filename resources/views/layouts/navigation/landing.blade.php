<header x-data="{ scrolled: false, mobileMenuOpen: false, searchOpen: false }"
        @scroll.window="scrolled = window.scrollY > 10"
        :class="{ 'header-scrolled': scrolled }">
    <div class="container">
        <div class="header-left">
            <a href="{{ route('home') }}" class="logo-wrapper">
                <span class="logo-text">BOJONGSTORE</span>
                <img src="{{ asset('images/logo_tree.png') }}" width="36" height="36" alt="Logo" class="logo-img">
            </a>
            <nav class="nav-links">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
                <a href="{{ route('produk') }}" class="nav-link {{ request()->routeIs('produk') ? 'active' : '' }}">Produk</a>
            </nav>
        </div>

        <div class="search-bar desktop-search">
            <form action="{{ route('katalog') }}" method="GET" style="display:flex;align-items:center;width:100%;position:relative;">
                <span class="search-icon">
                  <i data-lucide="search" width="18" height="18"></i>
                </span>
                <input type="text" name="search" id="searchInput" placeholder="Cari produk..." value="{{ request('search') }}" style="width:100%;padding:0.6rem 1.2rem 0.6rem 2.6rem;border:1.5px solid #e8e8e8;border-radius:999px;background:#f7f7f7;font-size:0.875rem;font-family:inherit;transition:all 0.25s ease;color:var(--text-dark);">
            </form>
        </div>

        <div class="header-actions">
            {{-- === BELUM LOGIN: Sign Up + Log In === --}}
            <div class="auth-btns desktop-auth">
                <a href="{{ route('register') }}" class="header-btn header-btn-signup-outline">Sign Up</a>
                <a href="{{ route('login') }}" class="header-btn header-btn-login-filled">
                    <i data-lucide="user" width="14" height="14"></i>
                    Log In
                </a>
            </div>

            <!-- Mobile Buttons -->
            <button @click="searchOpen = !searchOpen" class="mobile-action-btn mobile-search-toggle" type="button" title="Cari">
                <i data-lucide="search" width="20" height="20"></i>
            </button>
            <button @click="mobileMenuOpen = true" class="mobile-action-btn mobile-nav-toggle" type="button" title="Menu">
                <i data-lucide="menu" width="22" height="22"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Collapsible Search -->
    <div x-show="searchOpen" x-transition style="display:none;" class="mobile-search-bar-wrap">
        <form action="{{ route('katalog') }}" method="GET" style="position:relative; width:100%;">
            <span class="search-icon">
              <i data-lucide="search" width="16" height="16"></i>
            </span>
            <input type="text" name="search" placeholder="Cari produk..." value="{{ request('search') }}" style="width:100%;padding:0.6rem 1.2rem 0.6rem 2.6rem;border:1.5px solid #e8e8e8;border-radius:999px;background:#f7f7f7;font-size:0.875rem;font-family:inherit;color:var(--text-dark);">
        </form>
    </div>

    <!-- Mobile Slide-out Drawer Menu -->
    <div class="mobile-drawer-overlay" x-show="mobileMenuOpen" @click="mobileMenuOpen = false" x-transition.opacity style="display:none;"></div>
    <div class="mobile-drawer" x-show="mobileMenuOpen"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="translate-x-full"
         style="display:none;">
        <div class="drawer-header">
            <span class="logo-text">MENU</span>
            <button @click="mobileMenuOpen = false" class="drawer-close-btn" type="button">
                <i data-lucide="x" width="20" height="20"></i>
            </button>
        </div>
        <nav class="drawer-nav">
            <a href="{{ route('home') }}" class="drawer-link {{ request()->routeIs('home') ? 'active' : '' }}">
                <i data-lucide="home" width="18" height="18"></i> Beranda
            </a>
            <a href="{{ route('produk') }}" class="drawer-link {{ request()->routeIs('produk') ? 'active' : '' }}">
                <i data-lucide="shopping-bag" width="18" height="18"></i> Produk
            </a>
            <a href="{{ route('favorit') }}" class="drawer-link {{ request()->routeIs('favorit') ? 'active' : '' }}">
                <i data-lucide="bookmark" width="18" height="18"></i> Favorit Saya
            </a>
        </nav>
        <div class="drawer-footer">
            <a href="{{ route('register') }}" class="drawer-btn drawer-btn-signup">Sign Up</a>
            <a href="{{ route('login') }}" class="drawer-btn drawer-btn-login">
                <i data-lucide="user" width="14" height="14"></i> Log In
            </a>
        </div>
    </div>
</header>

{{-- Toast Notification --}}
@if(session('auth_required'))
<div id="authToast" class="auth-toast">
    <i data-lucide="alert-circle" width="18" height="18"></i>
    <span>{{ session('auth_required') }}</span>
</div>
@endif

<script src="https://unpkg.com/lucide@latest"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();

        // Auto-hide toast
        const toast = document.getElementById('authToast');
        if (toast) {
            setTimeout(() => toast.classList.add('auth-toast--hide'), 3500);
            setTimeout(() => toast.remove(), 4000);
        }
    });
</script>
