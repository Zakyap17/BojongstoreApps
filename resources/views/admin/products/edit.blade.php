<x-admin-panel>

    {{-- Breadcrumb --}}
    <div class="mb-1">
        <nav class="text-xs text-gray-400 flex items-center gap-1.5">
            <a href="{{ route('admin.products.index') }}" class="hover:text-gray-600">Produk</a>
            <i class='bx bx-chevron-right'></i>
            <span class="text-gray-600 font-medium">Edit Produk</span>
        </nav>
    </div>

    {{-- Page Title --}}
    <div class="mb-6">
        <h1 class="text-xl font-bold text-gray-800">Edit Produk</h1>
        <p class="text-sm text-gray-500 mt-0.5">{{ $product->name }}</p>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-5 text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex flex-col lg:flex-row gap-6">

                {{-- LEFT: Image Upload --}}
                <div class="lg:w-5/12 flex-shrink-0">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Foto Produk</p>

                    @php
                        $hasImage = !empty($product->image);
                        $imgUrl = '';
                        if ($hasImage) {
                            $imgUrl = asset('storage/products/' . basename($product->image));
                        }
                    @endphp

                    {{-- Main Image --}}
                    <label for="mainImageInput"
                        class="block w-full aspect-square border-2 border-dashed border-gray-200 rounded-xl bg-gray-50 hover:bg-gray-100 cursor-pointer transition-colors relative overflow-hidden">
                        <div id="mainImagePreview"
                            class="w-full h-full flex flex-col items-center justify-center text-gray-400 gap-2 {{ $hasImage ? 'hidden' : '' }}">
                            <i class='bx bx-upload text-4xl'></i>
                            <span class="text-sm font-medium">Pilih Foto Utama</span>
                            <span class="text-[10px] text-center text-gray-400 px-4">Format JPG, PNG atau
                                WEBP.<br>Rekomendasi 1200×1600px (Maks. 2MB).</span>
                        </div>
                        <img id="mainImagePreviewImg" src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            class="{{ $hasImage ? '' : 'hidden' }} absolute inset-0 w-full h-full object-cover">
                        <input type="file" id="mainImageInput" name="image" accept="image/*" class="hidden"
                            onchange="previewMainImage(event)">
                    </label>
                </div>

                {{-- RIGHT: Form Fields --}}
                <div class="flex-1 space-y-4">
                    {{-- Nama Produk --}}
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Nama Produk
                            <span class="text-red-500">*</span></label>
                        <input type="text" name="name" placeholder="Contoh: Kripik Pisang Madu Organik"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20 placeholder-gray-300"
                            value="{{ old('name', $product->name) }}" required>
                        @error('name')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Harga & Kategori --}}
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Harga
                                (RP) <span class="text-red-500">*</span></label>
                            <input type="number" name="price" placeholder="0" min="0"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20"
                                value="{{ old('price', $product->price) }}" required>
                            @error('price')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label
                                class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Kategori
                                <span class="text-red-500">*</span></label>
                            <select name="category_id"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20"
                                required>
                                <option value="" disabled>Pilih Kategori</option>
                                @foreach(\App\Models\Category::all() as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Deskripsi
                            Produk <span class="text-red-500">*</span></label>
                        <textarea name="description" rows="4"
                            placeholder="Jelaskan detail produk, bahan, dan keunggulan..."
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20 placeholder-gray-300 resize-none"
                            required>{{ old('description', $product->description) }}</textarea>
                        @error('description')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Toggle Unggulan --}}
                    <div class="border border-gray-200 rounded-xl p-4 flex items-center gap-4">
                        <div class="w-9 h-9 bg-[#e8f5ec] rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class='bx bxs-star text-[#1a5c2a]'></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-800">Jadikan Produk Unggulan</p>
                            <p class="text-xs text-gray-400">Produk akan tampil di halaman depan sebagai rekomendasi.
                            </p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_featured" value="1" class="sr-only peer" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                            <div
                                class="w-11 h-6 bg-gray-200 peer-checked:bg-[#1a5c2a] rounded-full transition-colors mb-0">
                            </div>
                            <div
                                class="absolute left-0.5 top-0.5 w-5 h-5 bg-white rounded-full shadow transition-transform peer-checked:translate-x-5">
                            </div>
                        </label>
                    </div>

                    {{-- Kontak & Sosial --}}
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Nomor
                                WhatsApp</label>
                            <input type="text" name="whatsapp" placeholder="Contoh: 628123456789"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20 placeholder-gray-300"
                                value="{{ old('whatsapp', $product->whatsapp) }}">
                            @error('whatsapp')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Link
                                Shopee</label>
                            <input type="url" name="shoppee" placeholder="Contoh: https://shopee.co.id/..."
                                class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20 placeholder-gray-300"
                                value="{{ old('shoppee', $product->shoppee) }}">
                            @error('shoppee')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    {{-- Tags --}}
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Tags
                            (pisahkan dengan koma)</label>
                        <input type="text" name="tags" placeholder="Contoh: keripik, pisang, manis"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20 placeholder-gray-300"
                            value="{{ old('tags', is_array($product->tags) ? implode(', ', $product->tags) : $product->tags) }}">
                        @error('tags')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Spesifikasi Produk --}}
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Berat
                                Produk</label>
                            <input type="text" name="weight" placeholder="Contoh: 250g, 1 kg"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20 placeholder-gray-300"
                                value="{{ old('weight', $product->weight) }}">
                            @error('weight')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Jenis
                                Produk</label>
                            <input type="text" name="type" placeholder="Contoh: Makanan, Minuman"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20 placeholder-gray-300"
                                value="{{ old('type', $product->type) }}">
                            @error('type')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-3">
                        <div>
                            <label
                                class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Kemasan</label>
                            <input type="text" name="packaging" placeholder="Contoh: Pouch, Botol"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20 placeholder-gray-300"
                                value="{{ old('packaging', $product->packaging) }}">
                            @error('packaging')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Daya
                                Tahan</label>
                            <input type="text" name="shelf_life" placeholder="Contoh: 6 bulan"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20 placeholder-gray-300"
                                value="{{ old('shelf_life', $product->shelf_life) }}">
                            @error('shelf_life')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label
                                class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Produksi</label>
                            <input type="text" name="production" placeholder="Contoh: Setiap Hari"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20 placeholder-gray-300"
                                value="{{ old('production', $product->production) }}">
                            @error('production')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    {{-- Hidden fields --}}
                    <input type="hidden" name="seller"
                        value="{{ old('seller', $product->seller ?? Auth::user()->name) }}">
                </div>
            </div>

            {{-- Actions --}}
            <div class="mt-6 flex justify-end gap-3 border-t border-gray-100 pt-4">
                <a href="{{ route('admin.products.index') }}"
                    class="px-5 py-2.5 rounded-lg border border-gray-200 text-sm font-semibold text-gray-600 hover:bg-gray-50 transition-colors">
                    Batal
                </a>
                <button type="submit"
                    class="flex items-center gap-2 bg-[#1a5c2a] hover:bg-[#154a22] text-white text-sm font-semibold px-6 py-2.5 rounded-lg transition-colors shadow-sm">
                    <i class='bx bx-check'></i> Update Produk
                </button>
            </div>
        </div>
    </form>

    <script>
        // Preview gambar utama
        function previewMainImage(event) {
            const file = event.target.files[0];
            if (!file) return;
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran foto produk maksimal 2MB (batasan server). Silakan pilih foto lain.');
                event.target.value = '';
                return;
            }
            const reader = new FileReader();
            reader.onload = function (e) {
                const img = document.getElementById('mainImagePreviewImg');
                img.src = e.target.result;
                img.classList.remove('hidden');
                document.getElementById('mainImagePreview').classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }
    </script>

</x-admin-panel>