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
                <input type="text" name="search" placeholder="Cari produk..." value="{{ request('search') }}" style="width:100%;padding:0.6rem 1.2rem 0.6rem 2.6rem;border:1.5px solid #e8e8e8;border-radius:999px;background:#f7f7f7;font-size:0.875rem;font-family:inherit;transition:all 0.25s ease;color:var(--text-dark);">
            </form>
        </div>

        <div class="header-actions">
            {{-- Bookmark --}}
            <a href="{{ url('/favorit') }}" class="action-btn-bookmark desktop-bookmark" title="Favorit">
                <i data-lucide="bookmark" width="22" height="22"></i>
            </a>

            {{-- User Dropdown --}}
            <div class="user-dropdown-wrap desktop-user-dropdown" x-data="{ open: false }" @click.away="open = false">
                <button class="action-btn-user" @click="open = !open" title="Akun Saya" type="button">
                    @if (Auth::user()->avatar)
                        <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="user-avatar-img">
                    @elseif (Auth::user()->foto ?? null)
                        <img src="{{ asset(Auth::user()->foto) }}" alt="Avatar" class="user-avatar-img">
                    @else
                        <img src="{{ asset('images/default-avatar.svg') }}" alt="Avatar" class="user-avatar-img" style="width:22px;height:22px;object-fit:contain;">
                    @endif
                </button>

                <div class="user-dropdown-menu"
                     x-show="open"
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     style="display:none;">

                    {{-- Info user --}}
                    <div class="dropdown-user-info">
                        <div class="dropdown-avatar" style="overflow:hidden; padding:0;">
                            @if (Auth::user()->avatar)
                                <img src="{{ Auth::user()->avatar }}" alt="Avatar" style="width:34px;height:34px;border-radius:50%;object-fit:cover;">
                            @elseif (Auth::user()->foto ?? null)
                                <img src="{{ asset(Auth::user()->foto) }}" alt="Avatar" style="width:34px;height:34px;border-radius:50%;object-fit:cover;">
                            @else
                                <img src="{{ asset('images/default-avatar.svg') }}" alt="Avatar" style="width:20px;height:20px;object-fit:contain;">
                            @endif
                        </div>
                        <div>
                            <div class="dropdown-name">{{ Auth::user()->name }}</div>
                            <div class="dropdown-email">{{ Auth::user()->email }}</div>
                        </div>
                    </div>

                    <div class="user-dropdown-divider"></div>

                    @if(Route::has('profile.edit'))
                    <a href="{{ route('profile.edit') }}" class="user-dropdown-item">
                        <i data-lucide="user" width="15" height="15"></i>
                        Profile
                    </a>
                    @endif

                    @if(Auth::user()->role === 'admin')
                    <div class="user-dropdown-divider"></div>
                    <a href="{{ route('admin.dashboard') }}" class="user-dropdown-item" style="color:#1a5c2a;font-weight:600;">
                        <i data-lucide="layout-dashboard" width="15" height="15"></i>
                        Admin Dashboard
                    </a>
                    @endif

                    <div class="user-dropdown-divider"></div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="user-dropdown-item user-dropdown-item--danger">
                            <i data-lucide="log-out" width="15" height="15"></i>
                            Log Out
                        </button>
                    </form>
                </div>
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

        <!-- Drawer User Info -->
        <div class="drawer-user-info-section">
            <div class="dropdown-avatar" style="overflow:hidden; padding:0; width:40px; height:40px; border-radius:50%; flex-shrink:0;">
                @if (Auth::user()->avatar)
                    <img src="{{ Auth::user()->avatar }}" alt="Avatar" style="width:40px;height:40px;border-radius:50%;object-fit:cover;">
                @elseif (Auth::user()->foto ?? null)
                    <img src="{{ asset(Auth::user()->foto) }}" alt="Avatar" style="width:40px;height:40px;border-radius:50%;object-fit:cover;">
                @else
                    <img src="{{ asset('images/default-avatar.svg') }}" alt="Avatar" style="width:24px;height:24px;object-fit:contain;">
                @endif
            </div>
            <div>
                <div class="drawer-user-name" style="font-size:14px; font-weight:700; color:var(--text-dark); line-height:1.2;">{{ Auth::user()->name }}</div>
                <div class="drawer-user-email" style="font-size:12px; color:var(--text-gray); word-break:break-all;">{{ Auth::user()->email }}</div>
            </div>
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
            @if(Route::has('profile.edit'))
            <a href="{{ route('profile.edit') }}" class="drawer-link">
                <i data-lucide="user" width="18" height="18"></i> Profile Saya
            </a>
            @endif
            @if(Auth::user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}" class="drawer-link" style="color:#1a5c2a;font-weight:600;">
                <i data-lucide="layout-dashboard" width="18" height="18"></i> Admin Dashboard
            </a>
            @endif
        </nav>
        <div class="drawer-footer" style="padding:16px; border-top:1px solid #f0f0f0; margin-top:auto;">
            <form method="POST" action="{{ route('logout') }}" style="width:100%;">
                @csrf
                <button type="submit" class="drawer-btn drawer-btn-logout" style="width:100%;display:flex;align-items:center;justify-content:center;gap:8px;padding:12px;border-radius:10px;font-size:14px;font-weight:700;background:rgba(192, 57, 43, 0.08);color:#c0392b;border:none;cursor:pointer;transition:all 0.2s;">
                    <i data-lucide="log-out" width="16" height="16"></i> Log Out
                </button>
            </form>
        </div>
    </div>
</header>

<script src="https://unpkg.com/lucide@latest"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();
    });
</script>
