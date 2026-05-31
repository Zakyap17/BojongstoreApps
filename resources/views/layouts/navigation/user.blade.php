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
                <input type="text" name="search" placeholder="Cari produk..." value="{{ request('search') }}" style="width:100%;padding:0.6rem 1.2rem 0.6rem 2.6rem;border:1.5px solid #e8e8e8;border-radius:999px;background:#f7f7f7;font-size:0.875rem;font-family:inherit;transition:all 0.25s ease;color:var(--text-dark);">
            </form>
        </div>

        <div class="header-actions">
            {{-- Bookmark --}}
            <a href="{{ url('/favorit') }}" class="action-btn-bookmark" title="Favorit">
                <i data-lucide="bookmark" width="22" height="22"></i>
            </a>

            {{-- User Dropdown --}}
            <div class="user-dropdown-wrap" x-data="{ open: false }" @click.away="open = false">
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
        </div>
    </div>
</header>

<script src="https://unpkg.com/lucide@latest"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();
    });
</script>
