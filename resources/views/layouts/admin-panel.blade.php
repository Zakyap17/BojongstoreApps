<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Panel – {{ config('app.name', 'BojongStore') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo_tree.png') }}">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html, body, * { font-family: 'Poppins', sans-serif; }
        .sidebar-link { @apply flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-white/75 hover:bg-white/10 hover:text-white transition-all; }
        .sidebar-link.active { @apply bg-white/15 text-white font-semibold; }
    </style>
</head>
<body class="bg-[#f0f2f0] antialiased">

<div class="flex h-screen overflow-hidden">

    {{-- ===================== SIDEBAR ===================== --}}
    <aside class="w-52 bg-[#1a5c2a] flex flex-col flex-shrink-0">
        {{-- Logo --}}
        <div class="px-5 py-5 border-b border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-white rounded-lg flex items-center justify-center shadow-sm">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-6 h-6 object-contain">
                </div>
                <div>
                    <div class="text-white font-bold text-sm leading-tight">BojongStore</div>
                    <div class="text-white/50 text-[10px]">Admin Panel</div>
                </div>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class='bx bxs-grid-alt text-lg'></i>
                Dashboard
            </a>
            <a href="{{ route('admin.products.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <i class='bx bx-package text-lg'></i>
                Produk
            </a>
            <a href="#"
               class="sidebar-link {{ request()->routeIs('admin.umkm*') ? 'active' : '' }}">
                <i class='bx bx-store text-lg'></i>
                UMKM
            </a>
            <a href="#"
               class="sidebar-link {{ request()->routeIs('admin.review*') ? 'active' : '' }}">
                <i class='bx bx-star text-lg'></i>
                Review
            </a>
        </nav>

        {{-- Bottom actions --}}
        <div class="px-3 py-4 border-t border-white/10 space-y-1">
            <a href="#" class="sidebar-link">
                <i class='bx bx-support text-lg'></i>
                Bantuan Support
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-link w-full text-left">
                    <i class='bx bx-log-out text-lg'></i>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- ===================== MAIN AREA ===================== --}}
    <div class="flex-1 flex flex-col overflow-hidden">

        {{-- TOP BAR --}}
        <header class="bg-white h-14 flex items-center px-6 gap-4 border-b border-gray-200 flex-shrink-0">
            {{-- Search --}}
            <div class="flex-1 max-w-md">
                <div class="relative">
                    <i class='bx bx-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-lg'></i>
                    <input type="text" placeholder="Cari data, laporan, atau UMKM..."
                           class="w-full pl-9 pr-4 py-2 bg-gray-100 rounded-full text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/30 placeholder-gray-400">
                </div>
            </div>

            <div class="ml-auto flex items-center gap-3">
                {{-- Divider --}}
                <div class="border-l border-gray-200 h-6"></div>

                {{-- Notif --}}
                <button class="relative w-9 h-9 flex items-center justify-center rounded-full hover:bg-gray-100 transition text-gray-500">
                    <i class='bx bx-bell text-xl'></i>
                </button>

                {{-- Settings --}}
                <button class="relative w-9 h-9 flex items-center justify-center rounded-full hover:bg-gray-100 transition text-gray-500">
                    <i class='bx bx-cog text-xl'></i>
                </button>

                <div class="border-l border-gray-200 h-6"></div>

                {{-- Profile --}}
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center gap-2 hover:opacity-80 transition">
                        <div class="text-right hidden sm:block">
                            <div class="text-sm font-semibold text-gray-800 leading-tight">{{ Auth::user()->name }}</div>
                            <div class="text-[11px] text-gray-400 leading-tight">Bojong Store</div>
                        </div>
                        <div class="w-9 h-9 rounded-full bg-[#1a5c2a] flex items-center justify-center text-white font-bold text-sm overflow-hidden">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    </button>
                    <div x-show="open" @click.outside="open = false"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         class="absolute right-0 mt-2 w-40 bg-white rounded-xl shadow-lg border border-gray-100 py-1 z-50">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Profil</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Keluar</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        {{-- PAGE CONTENT --}}
        <main class="flex-1 overflow-y-auto p-6">
            {{ $slot }}
        </main>
    </div>
</div>

{{-- SweetAlert for flash messages --}}
<script>
    @if (session('success'))
        Swal.fire({ icon: 'success', title: 'Berhasil!', text: '{{ session('success') }}', timer: 2500, showConfirmButton: false });
    @endif
    @if (session('error'))
        Swal.fire({ icon: 'error', title: 'Oops...', text: '{{ session('error') }}' });
    @endif
</script>
</body>
</html>
