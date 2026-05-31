<x-admin-panel>

    {{-- Breadcrumb --}}
    <div class="mb-1">
        <nav class="text-xs text-gray-400 flex items-center gap-1.5">
            <span>Dashboard</span>
            <i class='bx bx-chevron-right'></i>
            <span class="text-gray-600 font-medium">Ringkasan Utama</span>
        </nav>
    </div>

    {{-- Page Title --}}
    <div class="mb-6">
        <h1 class="text-xl font-bold text-gray-800">Ringkasan Performa</h1>
        <p class="text-sm text-gray-500 mt-0.5">Pantau pertumbuhan ekosistem UMKM BojongStore secara real-time.</p>
    </div>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

        {{-- Card 1: Total Produk --}}
        <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 bg-[#e8f5ec] rounded-lg flex items-center justify-center">
                    <i class='bx bx-package text-xl text-[#1a5c2a]'></i>
                </div>
                <span class="text-xs font-semibold text-[#1a5c2a] bg-[#e8f5ec] px-2.5 py-1 rounded-full">+12% Bulan Ini</span>
            </div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Total Produk</p>
            <p class="text-3xl font-bold text-gray-800">{{ $total_products }}</p>
        </div>

        {{-- Card 2: UMKM --}}
        <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 bg-[#e8f5ec] rounded-lg flex items-center justify-center">
                    <i class='bx bx-store text-xl text-[#1a5c2a]'></i>
                </div>
                <span class="text-xs font-semibold text-[#1a5c2a] bg-[#e8f5ec] px-2.5 py-1 rounded-full">Mitra Aktif</span>
            </div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Total UMKM</p>
            <p class="text-3xl font-bold text-gray-800">{{ $total_umkm }}</p>
        </div>

        {{-- Card 3: Review --}}
        <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 bg-[#e8f5ec] rounded-lg flex items-center justify-center">
                    <i class='bx bx-star text-xl text-[#1a5c2a]'></i>
                </div>
                <span class="text-xs font-semibold text-orange-500 bg-orange-50 px-2.5 py-1 rounded-full">{{ $avg_rating > 0 ? number_format($avg_rating, 1) : '0' }} Avg Rating</span>
            </div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Total Review</p>
            <p class="text-3xl font-bold text-gray-800">{{ $total_reviews }}</p>
        </div>
    </div>

    {{-- Bottom Section --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

        {{-- Aktivitas Terkini --}}
        <div class="lg:col-span-2 bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
            <div class="flex items-center justify-between mb-5">
                <h2 class="font-bold text-gray-800">Aktivitas Terkini</h2>
                <a href="#" class="text-sm font-semibold text-[#1a5c2a] hover:underline">Lihat Semua</a>
            </div>

            <div class="space-y-4">
                {{-- Activity 1 --}}
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 bg-[#e8f5ec] rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                        <i class='bx bx-plus text-[#1a5c2a] text-base'></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-700">
                            <span class="font-semibold text-gray-900">Admin</span> menambahkan produk baru
                            <span class="font-semibold text-[#1a5c2a]">{{ $top_products->first()->name ?? 'Tas Anyaman Pandan Premium' }}</span>
                        </p>
                        <p class="text-xs text-gray-400 mt-0.5">5 menit yang lalu • Menu: Produk</p>
                    </div>
                </div>

                {{-- Activity 2 --}}
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 bg-[#e8f5ec] rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                        <i class='bx bx-check-circle text-[#1a5c2a] text-base'></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-700">
                            <span class="font-semibold text-gray-900">Admin</span> memverifikasi UMKM
                            <span class="font-semibold text-[#1a5c2a]">Kelompok Tani Mekar Wangi</span>
                        </p>
                        <p class="text-xs text-gray-400 mt-0.5">25 menit yang lalu • Menu: UMKM</p>
                    </div>
                </div>

                {{-- Activity 3 --}}
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 bg-[#e8f5ec] rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                        <i class='bx bx-image text-[#1a5c2a] text-base'></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-700">
                            <span class="font-semibold text-gray-900">Admin</span> mengubah banner
                            <span class="font-semibold text-[#1a5c2a]">Promo Merdeka Sale 2024</span>
                        </p>
                        <p class="text-xs text-gray-400 mt-0.5">2 jam yang lalu • Menu: Konten</p>
                    </div>
                </div>

                {{-- Activity 4 --}}
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 bg-[#e8f5ec] rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                        <i class='bx bx-file text-[#1a5c2a] text-base'></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-700">
                            <span class="font-semibold text-gray-900">Admin</span> menerbitkan panduan
                            <span class="font-semibold text-[#1a5c2a]">Digitalisasi Pasar Kaget Bojongsoang</span>
                        </p>
                        <p class="text-xs text-gray-400 mt-0.5">3 jam yang lalu • Menu: Konten</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Featured Card (Pasar Kreatif) --}}
        <div class="relative rounded-xl overflow-hidden shadow-sm border border-gray-100 min-h-[280px]">
            {{-- Background image --}}
            <div class="absolute inset-0 bg-gradient-to-b from-black/20 to-black/70"></div>
            <img src="{{ asset('images/foto-dashboard-admin.jpeg') }}"
                 alt="Pasar Kreatif"
                 class="absolute inset-0 w-full h-full object-cover -z-10">

            {{-- Content --}}
            <div class="absolute bottom-0 left-0 right-0 p-5 text-white">
                <h3 class="font-bold text-lg leading-tight">Pasar Kreatif Bojongsoang</h3>
                <p class="text-sm text-white/75 mt-1">Jadwal pameran di Kantor Desa Lengkong.</p>
            </div>
        </div>
    </div>

</x-admin-panel>
