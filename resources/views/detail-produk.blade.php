@extends('layouts.landing')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumbs -->
        <nav class="flex text-sm text-gray-500 mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="/" class="hover:text-primary transition-colors">Beranda</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class='bx bx-chevron-right text-gray-400 text-lg'></i>
                        <a href="{{ route('katalog') }}" class="ml-1 hover:text-primary transition-colors">Produk</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class='bx bx-chevron-right text-gray-400 text-lg'></i>
                        <span class="ml-1 text-gray-800 font-medium line-clamp-1">{{ $product->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="bg-white rounded-2xl shadow-sm p-6 md:p-8 mb-8">
            <div class="flex flex-col md:flex-row gap-8 lg:gap-12">
                
                <!-- Product Image -->
                <div class="w-full md:w-5/12 flex-shrink-0">
                    <div class="bg-gray-100 rounded-2xl aspect-square p-6 flex items-center justify-center relative overflow-hidden">
                        @auth
                        <form action="{{ route('favorit.toggle', $product->id) }}" method="POST" class="absolute top-4 right-4 z-10">
                            @csrf
                            @php
                                $isFavorited = auth()->user()->favorites->contains($product->id);
                            @endphp
                            <button type="submit" class="w-10 h-10 rounded-full shadow flex items-center justify-center transition-colors {{ $isFavorited ? 'bg-primary text-white' : 'bg-white text-gray-400 hover:text-primary' }}" title="{{ $isFavorited ? 'Hapus dari Favorit' : 'Tambah ke Favorit' }}">
                                <i class='bx {{ $isFavorited ? 'bxs-bookmark' : 'bx-bookmark' }} text-xl'></i>
                            </button>
                        </form>
                        @endauth
                        <img src="{{ $product->image ? asset('storage/' . str_replace('public/', '', $product->image)) : 'https://placehold.co/400x400/e2e8f0/333333?text=No+Image' }}" alt="{{ $product->name }}" class="max-w-full max-h-full object-contain drop-shadow-xl hover:scale-105 transition-transform duration-500">
                    </div>
                </div>

                <!-- Product Info -->
                <div class="w-full md:w-7/12 flex flex-col justify-center">
                    <div class="mb-2 flex items-center gap-2">
                        <span class="bg-green-100 text-primary text-xs font-bold px-2.5 py-1 rounded-md uppercase tracking-wider">{{ $product->category->name ?? 'Produk Lokal' }}</span>
                    </div>
                    
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>
                    
                    <div class="flex items-center gap-4 mb-6">
                        <div class="flex items-center text-yellow-400 text-lg">
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star-half'></i>
                        </div>
                        <span class="text-sm font-medium text-gray-600">4.9/5 dari <a href="#ulasan" class="text-primary hover:underline">50 Ulasan</a></span>
                    </div>
                    
                    <div class="text-4xl font-extrabold text-primary mb-6">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </div>

                    <div class="mb-8">
                        <h3 class="text-sm font-bold text-gray-900 mb-2 uppercase tracking-wide">Deskripsi</h3>
                        <p class="text-gray-600 leading-relaxed text-sm md:text-base">
                            {{ $product->description }}
                        </p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 mt-auto">
                        <a href="https://wa.me/{{ $product->whatsapp ?? '6281312821849' }}" target="_blank" class="flex-1 bg-primary hover:bg-secondary text-white font-semibold py-3.5 px-6 rounded-xl flex items-center justify-center gap-2 transition-colors shadow-lg shadow-primary/30">
                            <i class='bx bxl-whatsapp text-xl'></i> Beli via WhatsApp
                        </a>
                        @if($product->shoppee)
                        <a href="{{ $product->shoppee }}" target="_blank" class="flex-1 bg-[#ee4d2d] hover:bg-[#d74325] text-white font-semibold py-3.5 px-6 rounded-xl flex items-center justify-center gap-2 transition-colors shadow-lg shadow-[#ee4d2d]/30">
                            <i class='bx bx-shopping-bag text-xl'></i> Beli di Shopee
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Ulasan Section -->
        <div id="ulasan" class="bg-white rounded-2xl shadow-sm p-6 md:p-8 mb-8">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-1">Rating & Ulasan</h2>
                    <p class="text-sm text-gray-500">Kata mereka yang sudah mencoba produk ini</p>
                </div>
                <button onclick="document.getElementById('review-modal').classList.remove('hidden')" class="border-2 border-primary text-primary font-semibold py-2 px-6 rounded-lg hover:bg-primary/5 transition-colors">
                    Tulis Ulasan
                </button>
            </div>

            <!-- Review Items -->
            <div class="space-y-6">
                <!-- Review 1 -->
                <div class="border-b border-gray-100 pb-6">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-bold">
                                A
                            </div>
                            <div>
                                <div class="font-bold text-gray-900 text-sm">Andi Setiawan</div>
                                <div class="text-xs text-gray-500">12 Mei 2026</div>
                            </div>
                        </div>
                        <div class="flex text-yellow-400">
                            <i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm">Sayurannya sangat segar, pengiriman cepat, dan kualitasnya terjaga. Pasti akan beli lagi disini!</p>
                </div>
                
                <!-- Review 2 -->
                <div class="border-b border-gray-100 pb-6">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-bold">
                                B
                            </div>
                            <div>
                                <div class="font-bold text-gray-900 text-sm">Budi Santoso</div>
                                <div class="text-xs text-gray-500">10 Mei 2026</div>
                            </div>
                        </div>
                        <div class="flex text-yellow-400">
                            <i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star-half'></i>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm">Sangat puas dengan produk UMKM ini, harganya sangat terjangkau dibanding di supermarket.</p>
                </div>
            </div>
            
            <div class="mt-6 text-center">
                <button class="text-primary font-medium text-sm hover:underline">Lihat Semua Ulasan</button>
            </div>
        </div>

        <!-- Produk Lainnya -->
        @if($relatedProducts->isNotEmpty())
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Produk Lainnya</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($relatedProducts as $relatedProduct)
                    <a href="{{ route('produk.detail', $relatedProduct->slug) }}" class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow group">
                        <div class="w-full h-40 bg-gray-50 p-4 relative flex items-center justify-center">
                            <img class="w-full h-full object-contain group-hover:scale-105 transition-transform" src="{{ $relatedProduct->image ? asset('storage/' . str_replace('public/', '', $relatedProduct->image)) : 'https://placehold.co/400x400/e2e8f0/333333?text=No+Image' }}" alt="{{ $relatedProduct->name }}">
                        </div>
                        <div class="p-4">
                            <h3 class="font-medium text-gray-800 text-sm mb-1 truncate">{{ $relatedProduct->name }}</h3>
                            <p class="text-primary font-bold">Rp {{ number_format($relatedProduct->price, 0, ',', '.') }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</div>

<!-- Modal Ulasan -->
<div id="review-modal" class="fixed inset-0 z-[100] hidden bg-black/50 backdrop-blur-sm flex items-center justify-center px-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden relative transform transition-all">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-surface">
            <h3 class="font-bold text-gray-900 text-lg">Tulis Ulasan</h3>
            <button onclick="document.getElementById('review-modal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600 transition-colors">
                <i class='bx bx-x text-2xl'></i>
            </button>
        </div>
        
        <!-- Body -->
        <div class="p-6">
            <div class="flex items-center gap-4 mb-6 pb-6 border-b border-gray-100">
                <div class="w-16 h-16 bg-gray-100 rounded-lg p-2 flex items-center justify-center">
                    <img src="{{ $product->image ? asset('storage/' . str_replace('public/', '', $product->image)) : 'https://placehold.co/400x400/e2e8f0/333333?text=No+Image' }}" alt="{{ $product->name }}" class="max-w-full max-h-full object-contain">
                </div>
                <div>
                    <div class="font-bold text-gray-900 text-sm line-clamp-2">{{ $product->name }}</div>
                </div>
            </div>
            
            <form action="" method="POST" onsubmit="event.preventDefault(); alert('Ulasan berhasil dikirim!'); document.getElementById('review-modal').classList.add('hidden');">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2 text-center">Beri Rating</label>
                    <div class="flex justify-center gap-2 text-3xl text-gray-300">
                        <button type="button" class="hover:text-yellow-400 focus:text-yellow-400 transition-colors"><i class='bx bxs-star'></i></button>
                        <button type="button" class="hover:text-yellow-400 focus:text-yellow-400 transition-colors"><i class='bx bxs-star'></i></button>
                        <button type="button" class="hover:text-yellow-400 focus:text-yellow-400 transition-colors"><i class='bx bxs-star'></i></button>
                        <button type="button" class="hover:text-yellow-400 focus:text-yellow-400 transition-colors"><i class='bx bxs-star'></i></button>
                        <button type="button" class="hover:text-yellow-400 focus:text-yellow-400 transition-colors"><i class='bx bxs-star'></i></button>
                    </div>
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Ulasan Anda</label>
                    <textarea rows="4" class="w-full border border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-primary/50 outline-none text-sm resize-none" placeholder="Ceritakan pengalaman Anda menggunakan produk ini..."></textarea>
                </div>
                
                <button type="submit" class="w-full bg-primary hover:bg-secondary text-white font-bold py-3 rounded-xl transition-colors">
                    Kirim Ulasan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection