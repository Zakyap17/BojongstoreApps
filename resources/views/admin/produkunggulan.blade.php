<x-app-layout>
    <section class="relative h-screen overflow-hidden">
        <video class="absolute inset-0 w-full h-full object-cover" autoplay loop muted playsinline>
            <source src="{{ asset('videos/hero-banjarsari.mp4') }}" type="video/mp4">
        </video>
        <div class="absolute inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center">
            <div class="text-center text-white px-4" data-aos="fade-up" data-aos-duration="1000">
                <h1 class="text-4xl md:text-6xl font-bold mb-4 drop-shadow-lg">Dari Banjarsari, Untukmu</h1>
                <p class="text-lg md:text-xl mb-8 font-medium">Temukan produk UMKM Banjarsari dari desa, untuk semua, kini hadir secara digital</p>
                <a href="#artikel" class="bg-[#00923F] hover:bg-green-700 text-white font-medium py-3 px-6 transition duration-300 ease-in-out transform hover:scale-105 shadow-lg">
                    Lebih Lanjut
                </a>
            </div>
        </div>
    </section>

    <div class="bg-gradient-to-b from-[#c8e6c0] via-[#e8f0e4] to-white pb-50">
        <section class="relative -mt-20 z-10 px-4 md:px-8 lg:px-16 mb-16">
            <div class="bg-white rounded-xl shadow-xl p-6 md:p-8 lg:p-10 max-w-6xl mx-auto flex flex-col md:flex-row justify-around items-center gap-6 transition-all duration-300 ease-in-out">
                <div class="flex flex-col items-center text-center p-4 group" data-aos="fade-up" data-aos-delay="100">
                    <div class="overflow-hidden rounded-full p-2 mb-3 transition-all duration-300 ease-in-out">
                        <img src="{{ asset('images/icon-transformasi.png') }}" alt="Transformasi Digital" class="w-16 h-16 object-contain transition-transform duration-300 group-hover:scale-110">
                    </div>
                    <p class="text-lg font-semibold text-gray-800 transition-transform duration-300 group-hover:scale-110">Transformasi Digital</p>
                    <p class="text-sm text-gray-600 transition-transform duration-300 group-hover:scale-110">Mendukung pengembangan UMKM melalui teknologi</p>
                </div>
                <div class="flex flex-col items-center text-center p-4 group" data-aos="fade-up" data-aos-delay="200">
                    <div class="overflow-hidden rounded-full p-2 mb-3 transition-all duration-300 ease-in-out">
                        <img src="{{ asset('images/icon-lokal.png') }}" alt="Produk Lokal Asli" class="w-16 h-16 object-contain transition-transform duration-300 group-hover:scale-110">
                    </div>
                    <p class="text-lg font-semibold text-gray-800 transition-transform duration-300 group-hover:scale-110">Produk Lokal Asli</p>
                    <p class="text-sm text-gray-600 transition-transform duration-300 group-hover:scale-110">Hasil karya warga dengan kualitas terjamin</p>
                </div>
                <div class="flex flex-col items-center text-center p-4 group" data-aos="fade-up" data-aos-delay="300">
                    <div class="overflow-hidden rounded-full p-2 mb-3 transition-all duration-300 ease-in-out">
                        <img src="{{ asset('images/icon-ekonomi.png') }}" alt="Ekonomi Lebih Maju" class="w-16 h-16 object-contain transition-transform duration-300 group-hover:scale-110">
                    </div>
                    <p class="text-lg font-semibold text-gray-800 transition-transform duration-300 group-hover:scale-110">Ekonomi Lebih Maju</p>
                    <p class="text-sm text-gray-600 transition-transform duration-300 group-hover:scale-110">Kontribusi nyata dalam memperkuat perekonomian lokal</p>
                </div>
            </div>
        </section>

        <section class="py-16 px-4 md:px-8 lg:px-16">
            <div class="max-w-6xl mx-auto">
                <div class="flex justify-between items-center mb-10">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800">
                        Produk Unggulan Kami
                    </h2>
                    <a href="/katalog" class="bg-black text-white font-medium py-2 px-4 transition duration-300 ease-in-out flex items-center gap-2 shadow-lg group relative overflow-hidden">
                        <span class="relative z-10">Belanja Sekarang</span> 
                        <span class="text-xl transition-transform duration-300 group-hover:translate-x-2 relative z-10">></span>
                        <span class="absolute inset-0 bg-[#00923F] transform translate-x-full transition-transform duration-300 ease-out group-hover:translate-x-0"></span>
                    </a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="relative bg-white rounded-lg shadow-xl overflow-hidden p-2 transform transition-all duration-300 hover:scale-[1.03] hover:shadow-2xl group flex flex-col border border-transparent hover:border-green-400 min-h-[460px]" data-aos="fade-up" data-aos-delay="100">
                        <div class="w-full aspect-square overflow-hidden rounded-md mb-4">
                            <img src="{{ asset('images/produk-1.png') }}" alt="Lombok Hijau" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-grow px-4 text-left">
                            <span class="inline-block bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded-full mb-1 hover:bg-gray-200 transition-colors duration-300">Sayuran</span>
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">Lombok Hijau</h3>
                            <p class="text-gray-600">Rp12.000/kg</p>
                            <div class="mt-2 text-sm text-orange-600 flex items-center animate-pulse">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-orange-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 18L10 11L14 15L21 8"></path>
                                    <polyline points="21 12 21 8 17 8"></polyline>
                                </svg>
                                <span>Sudah terjual <span class="font-bold">420</span> sejak Januari 2025!</span>
                            </div>
                        </div>
                    </div>
                    <div class="relative bg-white rounded-lg shadow-xl overflow-hidden p-2 transform transition-all duration-300 hover:scale-[1.03] hover:shadow-2xl group flex flex-col border border-transparent hover:border-green-400 min-h-[460px]" data-aos="fade-up" data-aos-delay="200">
                        <div class="w-full aspect-square overflow-hidden rounded-md mb-4">
                            <img src="{{ asset('images/produk-2.png') }}" alt="Jagung Banjarsari" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-grow px-4 text-left">
                            <span class="inline-block bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded-full mb-1 hover:bg-gray-200 transition-colors duration-300">Sayuran</span>
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">Jagung Banjarsari</h3>
                            <p class="text-gray-600">Rp14.900</p>
                            <div class="mt-2 text-sm text-orange-600 flex items-center animate-pulse">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-orange-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 18L10 11L14 15L21 8"></path>
                                    <polyline points="21 12 21 8 17 8"></polyline>
                                </svg>
                                <span>Sudah terjual <span class="font-bold">75</span> sejak Januari 2025!</span>
                            </div>
                        </div>
                    </div>
                    <div class="relative bg-white rounded-lg shadow-xl overflow-hidden p-2 transform transition-all duration-300 hover:scale-[1.03] hover:shadow-2xl group flex flex-col border border-transparent hover:border-green-400 min-h-[460px]" data-aos="fade-up" data-aos-delay="300">
                        <div class="w-full aspect-square overflow-hidden rounded-md mb-4">
                            <img src="{{ asset('images/produk-3.png') }}" alt="Apel Banjarsari" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-grow px-4 text-left">
                            <span class="inline-block bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded-full mb-1 hover:bg-gray-200 transition-colors duration-300">Buah-buahan</span>
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">Apel Banjarsari</h3>
                            <p class="text-gray-600">Rp5.000</p>
                            <div class="mt-2 text-sm text-orange-600 flex items-center animate-pulse">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-orange-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 18L10 11L14 15L21 8"></path>
                                    <polyline points="21 12 21 8 17 8"></polyline>
                                </svg>
                                <span>Sudah terjual <span class="font-bold">120</span> sejak Januari 2025!</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="artikel" class="py-16 px-4 md:px-8 lg:px-16 bg-gradient-to-b from-transparent via-white/50 to-white">
            <div class="max-w-6xl mx-auto">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-8 text-left leading-tight" data-aos="fade-up">
                        Menganyam Harapan dan Membangun<br>Masa Depan Cerah Melalui UMKM Desa Banjarsari.
                    </h2>
                <div class="flex flex-col md:flex-row gap-8 mb-12">
                    <p class="text-gray-700 leading-relaxed md:w-1/2" data-aos="fade-right" data-aos-delay="100">
                        Desa Banjarsari menyimpan potensi besar melalui UMKM yang berkembang dari kreativitas dan kearifan warga. Produk-produk asli desa ini tidak hanya berkualitas, tapi juga membawa nilai budaya yang kuat. UMKM menjadi sumber harapan untuk ekonomi yang mandiri dan masa depan yang lebih cerah bagi seluruh warga.
                    </p>
                    <p class="text-gray-700 leading-relaxed md:w-1/2" data-aos="fade-left" data-aos-delay="200">
                        Dengan dukungan teknologi, UMKM Banjarsari menjangkau pasar lebih luas tanpa meninggalkan tradisi. Setiap transaksi mendukung ekonomi desa dan melestarikan budaya. Bersama, kita membangun masa depan gemilang.
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="overflow-hidden shadow-lg" data-aos="fade-down" data-aos-delay="100">
                        <img src="{{ asset('images/foto-kerajinan.jpeg') }}" alt="Kerajinan Tangan" class="w-full h-72 object-cover">
                    </div>
                    <div class="overflow-hidden shadow-lg" data-aos="fade-down" data-aos-delay="200">
                        <img src="{{ asset('images/foto-pasar.jpg') }}" alt="Pasar Lokal" class="w-full h-72 object-cover">
                    </div>
                </div>
            </div>
        </section>
    </div>

    <footer class="bg-[#00923F] text-white py-4">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-4">
                <a href="" class="text-white text-decoration-none">
                    <img src="{{ asset('images/logo.png') }}" alt="Banjarsari" class="logo-img" style="height: 45px; width: auto; object-fit: contain;">
                </a>
                <div class="d-flex gap-4">
                    <a href="" class="text-white text-decoration-none hover:text-white/80 transition-colors duration-300">Privacy Policy</a>
                    <a href="" class="text-white text-decoration-none hover:text-white/80 transition-colors duration-300">Hubungi Kami</a>
                </div>
            </div>
            <div class="text-white/80">
                © {{ date('Y') }} Banjarsari. All Rights Reserved.
            </div>
        </div>
    </footer>

    <style>
    /* Additional animations and hover effects */
    .group:hover .group-hover\:scale-110 {
        transform: scale(1.1);
    }
    
    .group:hover .group-hover\:translate-x-1 {
        transform: translateX(0.25rem);
    }
    
    /* Smooth transitions for all interactive elements */
    a, button, .transition-all {
        transition: all 0.3s ease-in-out;
    }
    
    /* Enhanced visual elements */
    .shadow-xl {
        box-shadow: 0 10px 25px -5px rgba(0, 146, 63, 0.1), 0 8px 10px -6px rgba(0, 146, 63, 0.1);
    }
    
    .shadow-2xl {
        box-shadow: 0 25px 50px -12px rgba(0, 146, 63, 0.15);
    }
    
    /* Subtle dividers for sections */
    section {
        position: relative;
    }
    
    section:not(:last-of-type)::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 10%;
        right: 10%;
        height: 1px;
        background: linear-gradient(to right, transparent, rgba(0, 146, 63, 0.2), transparent);
    }
    
    /* Ensure animations are smooth across devices */
    @media (prefers-reduced-motion: reduce) {
        .transition-all, .transition-transform, .transition-colors, .animate-pulse {
            transition-duration: 0.01ms !important;
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
        }
    }
    </style>

</x-app-layout>