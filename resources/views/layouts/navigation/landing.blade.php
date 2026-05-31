<header x-data="{ scrolled: false }"
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

        <div class="search-bar">
            <form action="{{ route('katalog') }}" method="GET" style="display:flex;align-items:center;width:100%;position:relative;">
                <span class="search-icon">
                  <i data-lucide="search" width="18" height="18"></i>
                </span>
                <input type="text" name="search" id="searchInput" placeholder="Cari produk..." value="{{ request('search') }}" style="width:100%;padding:0.6rem 1.2rem 0.6rem 2.6rem;border:1.5px solid #e8e8e8;border-radius:999px;background:#f7f7f7;font-size:0.875rem;font-family:inherit;transition:all 0.25s ease;color:var(--text-dark);">
            </form>
        </div>

        <div class="header-actions">
            {{-- === BELUM LOGIN: Sign Up + Log In === --}}
            <div class="auth-btns">
                <a href="{{ route('register') }}" class="header-btn header-btn-signup-outline">Sign Up</a>
                <a href="{{ route('login') }}" class="header-btn header-btn-login-filled">
                    <i data-lucide="user" width="14" height="14"></i>
                    Log In
                </a>
            </div>
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
