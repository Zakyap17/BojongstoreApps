<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Panel – {{ config('app.name', 'BojongStore') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

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
        html,
        body,
        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-[#f0f2f0] antialiased">

    <div class="flex h-screen overflow-hidden">

        {{-- ===================== SIDEBAR ===================== --}}
        <aside class="w-52 bg-[#1a5c2a] flex flex-col flex-shrink-0">
            {{-- Logo --}}
            <div class="px-5 py-5 border-b border-white/10">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-white/20 rounded-lg flex items-center justify-center">
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
                <a href="{{ route('admin.review.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.review*') ? 'active' : '' }}">
                    <i class='bx bx-star text-lg'></i>
                    Review
                </a>
                <a href="{{ route('admin.complaints.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.complaints.*') ? 'active' : '' }}">
                    <i class='bx bx-message-error text-lg'></i>
                    Keluhan
                </a>
            </nav>

            {{-- Bottom actions --}}
            <div class="px-3 py-4 border-t border-white/10 space-y-1">
                <a href="{{ route('home') }}" class="sidebar-link">
                    <i class='bx bx-home text-lg'></i>
                    Ke Halaman Home
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
                <form action="{{ route('admin.products.index') }}" method="GET" class="flex-1 max-w-md">
                    <div class="relative">
                        <i class='bx bx-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-lg'></i>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari data produk atau laporan"
                            class="w-full pl-9 pr-4 py-2 bg-gray-100 rounded-full text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/30 placeholder-gray-400">
                    </div>
                </form>

                <div class="ml-auto flex items-center gap-3">
                    {{-- Divider --}}
                    <div class="border-l border-gray-200 h-6"></div>

                    {{-- Notif --}}
                    @php
                        $latestReviews = \App\Models\Review::latest()->take(3)->get()->map(function ($item) {
                            $item->notif_type = 'review';
                            return $item;
                        });
                        $latestComplaints = \App\Models\HelpComplaint::latest()->take(3)->get()->map(function ($item) {
                            $item->notif_type = 'complaint';
                            return $item;
                        });
                        $notifications = $latestReviews->concat($latestComplaints)->sortByDesc('created_at')->take(5);
                    @endphp
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open"
                            class="relative w-9 h-9 flex items-center justify-center rounded-full hover:bg-gray-100 transition text-gray-500">
                            <i class='bx bx-bell text-xl'></i>
                            @if($notifications->count() > 0)
                                <span
                                    class="absolute top-1 right-1 w-2 h-2 bg-red-500 border border-white rounded-full"></span>
                            @endif
                        </button>
                        <div x-show="open" @click.outside="open = false" style="display: none;" x-transition
                            class="absolute right-0 mt-2 w-72 bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden z-50">
                            <div class="px-4 py-3 border-b border-gray-100 bg-gray-50/50">
                                <h3 class="text-sm font-semibold text-gray-800">Notifikasi</h3>
                            </div>
                            <div class="max-h-80 overflow-y-auto">
                                @forelse($notifications as $notif)
                                    <a href="{{ $notif->notif_type == 'review' ? route('admin.review.index') : '#' }}"
                                        class="px-4 py-3 border-b border-gray-50 hover:bg-gray-50 flex gap-3 items-start transition-colors">
                                        <div
                                            class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 {{ $notif->notif_type == 'review' ? 'bg-yellow-50 text-yellow-600' : 'bg-red-50 text-red-600' }}">
                                            <i
                                                class='bx {{ $notif->notif_type == 'review' ? 'bx-star' : 'bx-message-error' }}'></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-800">
                                                {{ $notif->notif_type == 'review' ? 'Ulasan Baru' : 'Keluhan/Bantuan' }}</p>
                                            <p class="text-[11px] text-gray-500 mt-0.5 line-clamp-1">
                                                {{ $notif->notif_type == 'review' ? $notif->user_name . ' memberi ' . $notif->rating . ' bintang' : $notif->name . ' mengirim pesan' }}
                                            </p>
                                            <p class="text-[10px] text-gray-400 mt-1">
                                                {{ $notif->created_at->diffForHumans() }}</p>
                                        </div>
                                    </a>
                                @empty
                                    <div class="px-4 py-6 text-center text-gray-500 text-sm">
                                        Belum ada notifikasi
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="border-l border-gray-200 h-6"></div>

                    {{-- Profile --}}
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center gap-2 hover:opacity-80 transition">
                            <div class="text-right hidden sm:block">
                                <div class="text-sm font-semibold text-gray-800 leading-tight">{{ Auth::user()->name }}
                                </div>
                            </div>
                            <div
                                class="w-9 h-9 rounded-full bg-[#1a5c2a] flex items-center justify-center text-white font-bold text-sm overflow-hidden">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        </button>
                        <div x-show="open" @click.outside="open = false"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            class="absolute right-0 mt-2 w-40 bg-white rounded-xl shadow-lg border border-gray-100 py-1 z-50">
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Profil</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Keluar</button>
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
        @if ($errors->any())
            Swal.fire({ icon: 'error', title: 'Gagal Menyimpan', text: 'Terdapat isian yang tidak valid atau wajib diisi. Silakan periksa kembali pesan error pada form.', confirmButtonColor: '#1a5c2a' });
        @endif

        // Global SweetAlert2 delete confirmation
        document.addEventListener('DOMContentLoaded', function () {
            document.body.addEventListener('submit', function (e) {
                const form = e.target;
                if (form.classList.contains('confirm-delete')) {
                    e.preventDefault();
                    const message = form.getAttribute('data-message') || 'Apakah Anda yakin ingin menghapus data ini?';
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: message,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6e7881',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal',
                        background: '#ffffff',
                        customClass: {
                            popup: 'rounded-2xl',
                            confirmButton: 'rounded-lg px-4 py-2 text-sm font-semibold',
                            cancelButton: 'rounded-lg px-4 py-2 text-sm font-semibold'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>