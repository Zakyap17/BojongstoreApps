<x-admin-panel>

    {{-- Breadcrumb --}}
    <div class="mb-1">
        <nav class="text-xs text-gray-400 flex items-center gap-1.5">
            <span>Produk</span>
            <i class='bx bx-chevron-right'></i>
            <span class="text-gray-600 font-medium">Daftar Produk</span>
        </nav>
    </div>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 mt-4">
        {{-- Total Produk --}}
        <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm flex items-center gap-4">
            <div class="w-11 h-11 bg-[#e8f5ec] rounded-xl flex items-center justify-center flex-shrink-0">
                <i class='bx bx-package text-2xl text-[#1a5c2a]'></i>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Produk</p>
                <p class="text-2xl font-bold text-gray-800">{{ number_format($total_products) }}</p>
                <p class="text-xs text-[#1a5c2a] font-semibold mt-0.5">↑ +12% bulan ini</p>
            </div>
        </div>

        {{-- Produk Unggulan --}}
        <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm flex items-center gap-4">
            <div class="w-11 h-11 bg-orange-50 rounded-xl flex items-center justify-center flex-shrink-0">
                <i class='bx bxs-star text-2xl text-orange-400'></i>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Produk Unggulan</p>
                <p class="text-2xl font-bold text-gray-800">{{ $total_featured }}</p>
                <p class="text-xs text-gray-400 mt-0.5">Status: Aktif</p>
            </div>
        </div>

        {{-- Jumlah Kategori --}}
        <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm flex items-center gap-4">
            <div class="w-11 h-11 bg-blue-50 rounded-xl flex items-center justify-center flex-shrink-0">
                <i class='bx bx-category text-2xl text-blue-500'></i>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Jumlah Kategori</p>
                <p class="text-2xl font-bold text-gray-800">{{ $total_categories }}</p>
                <p class="text-xs text-gray-400 mt-0.5">2 Baru ditambahkan</p>
            </div>
        </div>
    </div>

    {{-- Table Card --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
        {{-- Toolbar --}}
        <div class="p-5 flex flex-col sm:flex-row items-center gap-3 border-b border-gray-100">
            {{-- Search --}}
            <div class="relative flex-1 w-full">
                <i class='bx bx-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-lg'></i>
                <input type="text" id="searchInput" placeholder="Sambal" onkeyup="filterTable()"
                       class="w-full pl-9 pr-4 py-2.5 border border-gray-200 rounded-lg text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20 placeholder-gray-400">
            </div>

            {{-- Category Filter --}}
            <select id="categoryFilter" onchange="filterTable()"
                    class="border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-600 focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20 min-w-[160px]">
                <option value="">Semua Kategori</option>
                @foreach(\App\Models\Category::all() as $cat)
                    <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                @endforeach
            </select>

            {{-- Tambah Produk --}}
            <button onclick="document.getElementById('modalTambahProduk').classList.remove('hidden')"
                    class="flex items-center gap-2 bg-[#1a5c2a] hover:bg-[#154a22] text-white text-sm font-semibold px-5 py-2.5 rounded-lg transition-colors whitespace-nowrap shadow-sm">
                <i class='bx bx-plus text-lg'></i> Tambah Produk
            </button>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full" id="productTable">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="text-left py-3 px-5 text-xs font-bold text-gray-400 uppercase tracking-wider">Produk</th>
                        <th class="text-left py-3 px-5 text-xs font-bold text-gray-400 uppercase tracking-wider">Harga</th>
                        <th class="text-left py-3 px-5 text-xs font-bold text-gray-400 uppercase tracking-wider">Kategori</th>
                        <th class="text-center py-3 px-5 text-xs font-bold text-gray-400 uppercase tracking-wider">Unggulan</th>
                        <th class="text-right py-3 px-5 text-xs font-bold text-gray-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($products as $product)
                    <tr class="hover:bg-gray-50/50 transition-colors" data-category="{{ $product->category->name ?? '' }}" data-name="{{ strtolower($product->name) }}">
                        {{-- Produk --}}
                        <td class="py-3.5 px-5">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0">
                                    @if($product->image)
                                        <img src="{{ $product->image_url }}"
                                             alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <i class='bx bx-image text-gray-300 text-2xl'></i>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">{{ $product->name }}</p>
                                    <p class="text-xs text-gray-400">SKU: PRD-{{ str_pad($product->id, 3, '0', STR_PAD_LEFT) }}</p>
                                    @php $shopName = $product->umkm?->name ?? $product->seller; @endphp
                                    @if($shopName)
                                    <span class="inline-flex items-center gap-1 mt-0.5 text-xs font-semibold text-[#1a5c2a]">🏪 {{ $shopName }}</span>
                                    @endif
                                </div>
                            </div>
                        </td>

                        {{-- Harga --}}
                        <td class="py-3.5 px-5">
                            <span class="text-sm font-semibold text-gray-700">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        </td>

                        {{-- Kategori --}}
                        <td class="py-3.5 px-5">
                            @if($product->category)
                                <span class="text-xs font-semibold px-2.5 py-1 rounded-full
                                    {{ in_array($product->category->name, ['Makanan', 'Minuman', 'Makanan & Minuman']) ? 'bg-orange-100 text-orange-600' : 'bg-blue-100 text-blue-600' }}">
                                    {{ $product->category->name }}
                                </span>
                            @else
                                <span class="text-xs text-gray-400">—</span>
                            @endif
                        </td>

                        {{-- Toggle Unggulan --}}
                        <td class="py-3.5 px-5 text-center">
                            <form action="{{ route('admin.products.toggleFeatured', $product->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" title="{{ $product->is_featured ? 'Nonaktifkan' : 'Jadikan Unggulan' }}"
                                        class="relative inline-flex items-center w-11 h-6 rounded-full transition-colors focus:outline-none
                                               {{ $product->is_featured ? 'bg-[#1a5c2a]' : 'bg-gray-200' }}">
                                    <span class="inline-block w-5 h-5 bg-white rounded-full shadow transform transition-transform
                                                 {{ $product->is_featured ? 'translate-x-5' : 'translate-x-0.5' }}"></span>
                                </button>
                            </form>
                        </td>

                        {{-- Aksi --}}
                        <td class="py-3.5 px-5 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.products.edit', $product->id) }}"
                                   class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-500 hover:bg-gray-100 hover:text-[#1a5c2a] transition-colors">
                                    <i class='bx bx-edit-alt text-base'></i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-500 hover:bg-red-50 hover:text-red-500 transition-colors">
                                        <i class='bx bx-trash text-base'></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-16 text-gray-400">
                            <i class='bx bx-package text-4xl mb-2 block'></i>
                            <p class="text-sm">Belum ada produk. Tambah produk pertama Anda!</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Footer / Pagination --}}
        <div class="px-5 py-4 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-xs text-gray-400">
                Menampilkan {{ $products->firstItem() }}–{{ $products->lastItem() }} dari {{ $products->total() }} produk
            </p>
            <div class="text-sm">
                {{ $products->links() }}
            </div>
        </div>
    </div>

    {{-- ===================== MODAL TAMBAH PRODUK ===================== --}}
    <div id="modalTambahProduk"
         class="hidden fixed inset-0 z-[200] bg-black/40 backdrop-blur-sm flex items-center justify-center px-4"
         onclick="if(event.target===this) this.classList.add('hidden')">

        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-y-auto">
            {{-- Modal Header --}}
            <div class="px-7 pt-7 pb-4 flex items-start justify-between">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Tambah Produk Baru</h2>
                    <p class="text-sm text-gray-500 mt-1">Lengkapi informasi produk UMKM sesuai standar kualitas Bojongsoang untuk ditayangkan di BojongStore.</p>
                </div>
                <button onclick="document.getElementById('modalTambahProduk').classList.add('hidden')"
                        class="text-gray-400 hover:text-gray-600 transition-colors ml-4 mt-1">
                    <i class='bx bx-x text-2xl'></i>
                </button>
            </div>

            {{-- Modal Body --}}
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="px-7 pb-7">
                    <div class="flex flex-col md:flex-row gap-6">

                        {{-- LEFT: Image Upload --}}
                        <div class="md:w-5/12 flex-shrink-0">
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Foto Produk</p>

                            {{-- Main Image --}}
                            <label for="mainImageInput"
                                   class="block w-full aspect-square border-2 border-dashed border-gray-200 rounded-xl bg-gray-50 hover:bg-gray-100 cursor-pointer transition-colors relative overflow-hidden">
                                <div id="mainImagePreview" class="w-full h-full flex flex-col items-center justify-center text-gray-400 gap-2">
                                    <i class='bx bx-upload text-4xl'></i>
                                    <span class="text-sm font-medium">Pilih Foto Utama</span>
                                    <span class="text-[10px] text-center text-gray-400 px-4">Format JPG, PNG atau WEBP.<br>Rekomendasi 1200×1600px (Maks. 5MB).</span>
                                </div>
                                <img id="mainImagePreviewImg" src="" alt="" class="hidden absolute inset-0 w-full h-full object-cover">
                                <input type="file" id="mainImageInput" name="image" accept="image/*" class="hidden"
                                       onchange="previewMainImage(event)">
                            </label>

                            {{-- Extra slots --}}
                            <div class="grid grid-cols-3 gap-2 mt-3">
                                @for($i = 0; $i < 3; $i++)
                                <label class="aspect-square border-2 border-dashed border-gray-200 rounded-xl bg-gray-50 hover:bg-gray-100 cursor-pointer flex items-center justify-center transition-colors">
                                    <i class='bx bx-plus text-gray-300 text-2xl'></i>
                                </label>
                                @endfor
                            </div>
                        </div>

                        {{-- RIGHT: Form Fields --}}
                        <div class="flex-1 space-y-4">
                            {{-- Nama Produk --}}
                            <div>
                                <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Nama Produk</label>
                                <input type="text" name="name" placeholder="Contoh: Kripik Pisang Madu Organik"
                                       class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20 placeholder-gray-300"
                                       value="{{ old('name') }}" required>
                                @error('name')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                            </div>

                            {{-- Harga & Kategori --}}
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Harga (RP)</label>
                                    <input type="number" name="price" placeholder="0" min="0"
                                           class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20"
                                           value="{{ old('price') }}" required>
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Kategori</label>
                                    <select name="category_id"
                                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20" required>
                                        <option value="" disabled selected>Pilih Kategori</option>
                                        @foreach(\App\Models\Category::all() as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            {{-- Deskripsi --}}
                            <div>
                                <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Deskripsi Produk</label>
                                <textarea name="description" rows="4" placeholder="Jelaskan detail produk, bahan, dan keunggulan..."
                                          class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20 placeholder-gray-300 resize-none"
                                          required>{{ old('description') }}</textarea>
                                @error('description')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                            </div>

                            {{-- Toggle Unggulan --}}
                            <div class="border border-gray-200 rounded-xl p-4 flex items-center gap-4">
                                <div class="w-9 h-9 bg-[#e8f5ec] rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class='bx bxs-star text-[#1a5c2a]'></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-gray-800">Jadikan Produk Unggulan</p>
                                    <p class="text-xs text-gray-400">Produk akan tampil di halaman depan sebagai rekomendasi.</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="is_featured" value="1" class="sr-only peer" {{ old('is_featured') ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-gray-200 peer-checked:bg-[#1a5c2a] rounded-full transition-colors"></div>
                                    <div class="absolute left-0.5 top-0.5 w-5 h-5 bg-white rounded-full shadow transition-transform peer-checked:translate-x-5"></div>
                                </label>
                            </div>

                            {{-- UMKM & Seller --}}
                            <div>
                                <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Nama Toko / UMKM</label>
                                <select name="umkm_id"
                                        class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20">
                                    <option value="">-- Pilih UMKM (opsional) --</option>
                                    @foreach(\App\Models\Umkm::where('status','terverifikasi')->orderBy('name')->get() as $umkm)
                                        <option value="{{ $umkm->id }}">{{ $umkm->name }} ({{ $umkm->category }})</option>
                                    @endforeach
                                </select>
                                <p class="text-xs text-gray-400 mt-1">Atau isi nama penjual manual jika UMKM belum terdaftar.</p>
                            </div>
                            {{-- Hidden fields --}}
                            <input type="hidden" name="seller" value="{{ Auth::user()->name }}">
                        </div>
                    </div>
                </div>

                {{-- Modal Footer --}}
                <div class="px-7 py-4 border-t border-gray-100 flex justify-end gap-3">
                    <button type="button"
                            onclick="document.getElementById('modalTambahProduk').classList.add('hidden')"
                            class="px-5 py-2.5 text-sm font-medium text-gray-600 hover:text-gray-800 transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                            class="flex items-center gap-2 bg-[#1a5c2a] hover:bg-[#154a22] text-white text-sm font-semibold px-6 py-2.5 rounded-lg transition-colors shadow-sm">
                        <i class='bx bx-check'></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Auto-open modal if validation errors exist --}}
    @if($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('modalTambahProduk').classList.remove('hidden');
        });
    </script>
    @endif

    <script>
        // Preview gambar utama
        function previewMainImage(event) {
            const file = event.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('mainImagePreviewImg');
                img.src = e.target.result;
                img.classList.remove('hidden');
                document.getElementById('mainImagePreview').classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }

        // Filter tabel
        function filterTable() {
            const search = document.getElementById('searchInput').value.toLowerCase();
            const category = document.getElementById('categoryFilter').value.toLowerCase();
            const rows = document.querySelectorAll('#productTable tbody tr');
            rows.forEach(row => {
                const name = (row.dataset.name || '').toLowerCase();
                const cat = (row.dataset.category || '').toLowerCase();
                const matchSearch = search === '' || name.includes(search);
                const matchCat = category === '' || cat.includes(category);
                row.style.display = (matchSearch && matchCat) ? '' : 'none';
            });
        }
    </script>

</x-admin-panel>