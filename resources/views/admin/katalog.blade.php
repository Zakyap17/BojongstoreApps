<x-app-layout>
    <div class="max-w-6xl mx-auto px-4" style="padding-top: 120px;">
    <div class="max-w-6xl mx-auto px-4" style="padding-top: 10px;">
        {{-- Filter & Search --}}
        <form method="GET" action="{{ route('katalog') }}" class="flex flex-col md:flex-row gap-4 mb-12">
            {{-- Dropdown Kategori --}}
            <div class="w-full md:w-1/4">
                <select name="category" class="border border-gray-300 rounded-lg px-4 py-3 w-full focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Input Pencarian --}}
            <div class="flex w-full md:w-2/4">
                <input type="text" name="search" value="{{ request('search') }}" class="border border-gray-300 rounded-l-lg px-4 py-3 w-full focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="Cari Produk">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-12 rounded-r-lg transition-colors duration-200 font-medium whitespace-nowrap">
                    Cari
                </button>
            </div>
        </form>

        {{-- Produk Grid - Menggunakan data dari Controller --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">

            {{-- Menghapus data statis dan langsung loop data $products dari controller --}}
            @foreach($products as $product)
            {{-- Mengubah div menjadi tag <a> agar seluruh kartu produk bisa diklik --}}
            <a href="{{ route('produk.detail', $product->slug) }}" class="bg-white border rounded-xl shadow-lg p-4 flex flex-col items-center hover:shadow-xl transition-shadow duration-300 no-underline">
                <div class="w-full h-48 mb-4 flex items-center justify-center">
                    {{-- Menggunakan gambar placeholder karena belum ada kolom gambar di database --}}
                    <img  src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/400x400/e2e8f0/333333?text=No+Image' }}" alt="{{ $product->name }}" class="max-h-full max-w-full object-contain">
                </div>
                <div class="text-center w-full">
                    {{-- Mengambil nama dari database --}}
                    <h3 class="font-semibold text-sm md:text-base mb-2 text-gray-800 line-clamp-2">{{ $product->name }}</h3>
                    
                    {{-- Mengambil harga dari database --}}
                    <div class="text-green-700 font-bold text-lg mb-2">
                        Rp{{ number_format($product->price, 0, ',', '.') }}
                    </div>
                    
                    {{-- Memberi rating statis untuk menjaga tampilan --}}
                    <div class="flex justify-center text-yellow-400 text-sm mb-3">
                        @for ($i = 1; $i <= 5; $i++)
                            {!! $i <= 4 ? '★' : '☆' !!} {{-- Rating statis 4 bintang --}}
                        @endfor
                    </div>

                    {{-- Tombol ini sekarang bagian dari link, fungsinya menjadi visual --}}
                    <div class="w-full bg-green-600 text-white py-2 px-4 rounded-lg text-sm font-medium">
                        Lihat Detail
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        {{-- Pagination - Menggunakan link dari Laravel Pagination --}}
        <div class="mt-12 flex justify-center items-center">
            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>