@extends('layouts.landing')

@section('content')

<!-- HERO SECTION -->
<section class="pt-12 pb-12 md:pt-16 md:pb-20 overflow-hidden bg-white">
    <div class="max-w-7xl mx-auto px-4 md:px-8 flex flex-col-reverse md:flex-row items-center gap-12">
        <div class="w-full md:w-1/2" data-aos="fade-right">
            <h1 class="text-4xl md:text-5xl lg:text-[3.5rem] font-extrabold text-gray-900 leading-[1.1] mb-6">
                Dukung <span class="text-primary italic">UMKM</span><br>
                <span class="text-primary italic">Lokal</span> Tumbuh<br>
                Lebih Jauh
            </h1>
            <p class="text-gray-600 text-[15px] mb-8 max-w-[400px] leading-relaxed">
                Temukan berbagai produk unggulan dari pelaku usaha lokal, mulai dari makanan, hingga kebutuhan sehari-hari semua dalam satu platform digital !
            </p>
            <a href="{{ route('katalog') }}" class="inline-block bg-primary hover:bg-secondary text-white font-semibold py-3.5 px-8 rounded-full transition-colors shadow-md">
                Mulai Belanja
            </a>
            
            <div class="mt-10 flex items-center gap-4">
                <div class="flex -space-x-3">
                    <img src="https://i.pravatar.cc/100?img=1" alt="User" class="w-10 h-10 rounded-full border-2 border-white object-cover">
                    <img src="https://i.pravatar.cc/100?img=2" alt="User" class="w-10 h-10 rounded-full border-2 border-white object-cover">
                    <img src="https://i.pravatar.cc/100?img=3" alt="User" class="w-10 h-10 rounded-full border-2 border-white object-cover">
                    <div class="w-10 h-10 rounded-full border-2 border-white bg-yellow-400 flex items-center justify-center text-[10px] font-bold text-gray-900">+10</div>
                </div>
                <div class="text-[13px] font-medium text-gray-600 leading-tight">
                    <span class="text-primary font-bold">10+ UMKM</span><br>
                    Telah Bergabung & Berkembang
                </div>
            </div>
        </div>
        
        <div class="w-full md:w-1/2 relative h-[400px] md:h-[600px] lg:h-[650px] mt-8 md:mt-12 overflow-visible" data-aos="fade-left">
            <!-- Illustrations Group (Fully Responsive Precision) -->
            <div class="relative w-full h-full max-w-sm md:max-w-md mx-auto">
                <!-- Top Face (Girl) -->
                <div class="absolute top-0 left-1/2 -translate-x-1/2 md:left-[15%] md:translate-x-0 w-[55%] md:w-[52%] aspect-square z-10">
                    <div class="absolute inset-0 bg-accent rounded-[60%_40%_70%_30%/40%_70%_30%_60%] opacity-40 transform rotate-6"></div>
                    <img src="{{ asset('images/mitra-1.png') }}" class="absolute inset-0 w-[90%] h-[90%] m-auto object-contain">
                </div>
                
                <!-- Center Right Face (Mustache Man) -->
                <div class="absolute top-[25%] -right-4 md:-right-12 w-[50%] md:w-[48%] aspect-square z-10">
                    <div class="absolute inset-0 bg-accent rounded-[70%_30%_60%_40%/30%_60%_40%_70%] opacity-30 transform rotate-12"></div>
                    <img src="{{ asset('images/mitra-2.png') }}" class="absolute inset-0 w-[90%] h-[90%] m-auto object-contain">
                </div>
                
                <!-- Bottom Face (Boy) -->
                <div class="absolute top-[50%] left-[5%] md:top-[52%] md:left-[10%] w-[52%] md:w-[50%] aspect-square z-10">
                    <div class="absolute inset-0 bg-accent rounded-[40%_60%_30%_70%/60%_30%_70%_40%] opacity-30 transform -rotate-12"></div>
                    <img src="{{ asset('images/mitra-3.png') }}" class="absolute inset-0 w-[90%] h-[90%] m-auto object-contain">
                </div>
                
                <!-- Floating Card (Glassmorphism Effect) -->
                <div class="absolute bottom-[8%] left-1/2 -translate-x-1/2 md:top-[72%] md:left-[10%] md:-translate-x-[100%] bg-white/80 backdrop-blur-md rounded-2xl shadow-xl border border-white/50 py-2.5 px-4 flex items-center gap-4 z-20 w-max">
                    <div class="w-9 h-9 md:w-10 md:h-10 bg-primary/10 rounded-xl flex items-center justify-center text-primary shadow-sm shrink-0">
                        <i class='bx bxs-shopping-bag-alt text-lg md:text-xl'></i>
                    </div>
                    <div class="flex flex-col justify-center">
                        <div class="text-[10px] md:text-[12px] font-bold text-gray-900 leading-none">Produk Terlaris</div>
                        <div class="text-[8px] md:text-[10px] text-gray-600 leading-tight mt-1">Rendang Kemasan terjual baru saja!</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- KATEGORI PILIHAN -->
<section class="py-16 bg-[#f1f6f1]">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-1">Kategori Pilihan</h2>
                <p class="text-gray-500 text-sm">Temukan keajaiban lokal dalam berbagai varian.</p>
            </div>
            <a href="{{ route('katalog') }}" class="text-primary font-bold text-sm flex items-center hover:underline">
                Lihat Semua <i class='bx bx-right-arrow-alt ml-1 text-lg'></i>
            </a>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
            <a href="{{ route('katalog', ['category' => 'sayuran']) }}" class="bg-white rounded-[2rem] p-8 flex flex-col items-center justify-center gap-4 shadow-sm hover:shadow-md transition-shadow group border border-transparent hover:border-primary/10">
                <div class="w-16 h-16 rounded-full bg-[#e7f9ec] flex items-center justify-center group-hover:scale-110 transition-transform shadow-inner">
                    <img src="{{ asset('images/cat-sayuran.png') }}" class="w-10 h-10 object-contain">
                </div>
                <div class="text-center">
                    <div class="font-bold text-gray-900 mb-1">Sayuran</div>
                    <div class="text-[11px] text-gray-500">Segar & Organik</div>
                </div>
            </a>
            
            <a href="{{ route('katalog', ['category' => 'buah']) }}" class="bg-white rounded-[2rem] p-8 flex flex-col items-center justify-center gap-4 shadow-sm hover:shadow-md transition-shadow group border border-transparent hover:border-orange-100">
                <div class="w-16 h-16 rounded-full bg-[#fff0e0] flex items-center justify-center group-hover:scale-110 transition-transform shadow-inner">
                    <img src="{{ asset('images/cat-buah.png') }}" class="w-10 h-10 object-contain">
                </div>
                <div class="text-center">
                    <div class="font-bold text-gray-900 mb-1">Buah</div>
                    <div class="text-[11px] text-gray-500">Lokal & Manis</div>
                </div>
            </a>
            
            <a href="{{ route('katalog', ['category' => 'makanan']) }}" class="bg-white rounded-[2rem] p-8 flex flex-col items-center justify-center gap-4 shadow-sm hover:shadow-md transition-shadow group border border-transparent hover:border-yellow-100">
                <div class="w-16 h-16 rounded-full bg-[#fff8e1] flex items-center justify-center group-hover:scale-110 transition-transform shadow-inner">
                    <img src="{{ asset('images/cat-makanan.png') }}" class="w-10 h-10 object-contain">
                </div>
                <div class="text-center">
                    <div class="font-bold text-gray-900 mb-1">Makanan</div>
                    <div class="text-[11px] text-gray-500">Resep Warisan</div>
                </div>
            </a>
            
            <a href="{{ route('katalog', ['category' => 'minuman']) }}" class="bg-white rounded-[2rem] p-8 flex flex-col items-center justify-center gap-4 shadow-sm hover:shadow-md transition-shadow group border border-transparent hover:border-blue-100">
                <div class="w-16 h-16 rounded-full bg-[#e3f2fd] flex items-center justify-center group-hover:scale-110 transition-transform shadow-inner">
                    <img src="{{ asset('images/cat-minuman.png') }}" class="w-10 h-10 object-contain">
                </div>
                <div class="text-center">
                    <div class="font-bold text-gray-900 mb-1">Minuman</div>
                    <div class="text-[11px] text-gray-500">Alami</div>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- CERITA SUKSES -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 md:px-8 text-center">
        <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Cerita Sukses <span class="text-primary italic">Mitra Kami</span></h2>
        <p class="text-gray-500 mb-12 text-[15px]">Bukan sekadar transaksi, tapi tentang membangun mimpi.</p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-left">
            <!-- Card 1 -->
            <div class="bg-[#e3f2fd] rounded-3xl p-8 relative">
                <div class="text-gray-400 font-serif text-5xl absolute top-6 left-6 leading-none">"</div>
                <p class="text-gray-700 italic relative z-10 mb-8 mt-6 text-[13px] leading-relaxed">
                    "Dulu jualan cuma di sekitar rumah. Setelah masuk BojongStore, produk saya lebih mudah ditemukan, dan banyak yang langsung order lewat WhatsApp. Sekarang pesanan datang dari luar daerah."
                </p>
                <div class="flex items-center gap-3">
                    <img src="https://i.pravatar.cc/100?img=5" class="w-10 h-10 rounded-full object-cover">
                    <div>
                        <div class="font-bold text-gray-900 text-sm">Ibu Ani</div>
                        <div class="text-[10px] text-gray-500">Pemilik Omah Batik</div>
                    </div>
                </div>
            </div>
            
            <!-- Card 2 -->
            <div class="bg-[#fff9c4] rounded-3xl p-8 relative">
                <div class="text-gray-400 font-serif text-5xl absolute top-6 left-6 leading-none">"</div>
                <p class="text-gray-700 italic relative z-10 mb-8 mt-6 text-[13px] leading-relaxed">
                    "Awalnya bingung promosi online. Lewat BojongStore, pembeli bisa lihat produk lalu langsung checkout via Shopee. Jadi lebih praktis dan penjualan ikut meningkat."
                </p>
                <div class="flex items-center gap-3">
                    <img src="https://i.pravatar.cc/100?img=8" class="w-10 h-10 rounded-full object-cover">
                    <div>
                        <div class="font-bold text-gray-900 text-sm">Pak Budi</div>
                        <div class="text-[10px] text-gray-500">Penjual Sambal Kemasan</div>
                    </div>
                </div>
            </div>
            
            <!-- Card 3 -->
            <div class="bg-[#e8f5e9] rounded-3xl p-8 relative">
                <div class="text-gray-400 font-serif text-5xl absolute top-6 left-6 leading-none">"</div>
                <p class="text-gray-700 italic relative z-10 mb-8 mt-6 text-[13px] leading-relaxed">
                    "Sebelumnya hanya dijual ke lingkungan sekitar. Setelah masuk BojongStore, produk saya punya etalase digital dan banyak pembeli order lewat WhatsApp."
                </p>
                <div class="flex items-center gap-3">
                    <img src="https://i.pravatar.cc/100?img=11" class="w-10 h-10 rounded-full object-cover">
                    <div>
                        <div class="font-bold text-gray-900 text-sm">Mas Dana</div>
                        <div class="text-[10px] text-gray-500">Penjual Kerupuk Ikan</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TENTANG KAMI -->
<section class="py-12 mb-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        <div class="bg-[#f1f6f1] rounded-[2rem] p-10 md:p-14">
            <div class="mb-2 text-[10px] font-bold text-primary tracking-widest uppercase">MENGENAL KAMI</div>
            <h2 class="text-3xl font-extrabold text-gray-900 mb-6">Tentang BojongStore</h2>
            
            <div class="flex flex-col md:flex-row gap-12">
                <div class="md:w-3/5 space-y-4 text-gray-600 leading-relaxed text-[13px]">
                    <p>BojongStore adalah platform digital yang dikembangkan mahasiswa untuk membantu UMKM di Bojongsoang mempromosikan produk mereka secara lebih luas. Website ini menyediakan katalog digital berisi informasi produk lengkap dan tampilan menarik, sehingga memudahkan pengguna dalam mencari dan memilih produk.</p>
                    <p>Selain itu, BojongStore menawarkan kemudahan transaksi melalui WhatsApp atau marketplace seperti Shopee. Platform ini tidak hanya menjadi media promosi, tetapi juga menjembatani UMKM dengan pasar yang lebih luas, guna meningkatkan visibilitas, penjualan, dan pertumbuhan ekonomi lokal.</p>
                </div>
                
                <div class="md:w-2/5 flex flex-col justify-center gap-6">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-[#81c784] flex items-center justify-center text-white shrink-0">
                            <i class='bx bx-store-alt text-lg'></i>
                        </div>
                        <div class="text-[11px] font-bold text-gray-900 uppercase tracking-wide">Mendorong UMKM Lokal</div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-[#90caf9] flex items-center justify-center text-white shrink-0">
                            <i class='bx bx-laptop text-lg'></i>
                        </div>
                        <div class="text-[11px] font-bold text-gray-900 uppercase tracking-wide">Digitalisasi Inovatif</div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-[#fff59d] flex items-center justify-center text-yellow-700 shrink-0">
                            <i class='bx bx-line-chart text-lg'></i>
                        </div>
                        <div class="text-[11px] font-bold text-gray-900 uppercase tracking-wide">Pertumbuhan Ekonomi</div>
                    </div>
                </div>
            </div>
            
            <div class="mt-12 text-[10px] text-gray-500 italic">
                *Dikembangkan oleh tim mahasiswa sebagai bagian dari proyek pengembangan UMKM berbasis digital.
            </div>
        </div>
    </div>
</section>

@endsection

<style>
    .group:hover .group-hover\:scale-110 {
        transform: scale(1.1);
    }
    a, button {
        transition: all 0.3s ease-in-out;
    }
</style>
