<x-admin-panel>

    {{-- Breadcrumb --}}
    <div class="mb-1">
        <nav class="text-xs text-gray-400 flex items-center gap-1.5">
            <a href="{{ route('admin.products.index') }}" class="hover:text-gray-600">Produk</a>
            <i class='bx bx-chevron-right'></i>
            <span class="text-gray-600 font-medium">Tambah Produk Baru</span>
        </nav>
    </div>

    {{-- Page Title --}}
    <div class="mb-6">
        <h1 class="text-xl font-bold text-gray-800">Tambah Produk Baru</h1>
        <p class="text-sm text-gray-500 mt-0.5">Lengkapi informasi produk sesuai standar kualitas BojongStore.</p>
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

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex flex-col lg:flex-row gap-6">

                {{-- LEFT: Image Upload --}}
                <div class="lg:w-5/12 flex-shrink-0">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Foto Produk <span class="text-red-500">*</span></p>

                    {{-- Main Image --}}
                    <label for="mainImageInput"
                        class="block w-full aspect-square border-2 border-dashed border-gray-200 rounded-xl bg-gray-50 hover:bg-gray-100 cursor-pointer transition-colors relative overflow-hidden">
                        <div id="mainImagePreview"
                            class="w-full h-full flex flex-col items-center justify-center text-gray-400 gap-2">
                            <i class='bx bx-upload text-4xl'></i>
                            <span class="text-sm font-medium">Pilih Foto Utama</span>
                            <span class="text-[10px] text-center text-gray-400 px-4">Format JPG, PNG atau
                                WEBP.<br>Rekomendasi 1200×1600px (Maks. 5MB).</span>
                        </div>
                        <img id="mainImagePreviewImg" src="" alt=""
                            class="hidden absolute inset-0 w-full h-full object-cover">
                        <input type="file" id="mainImageInput" name="image" accept="image/*" class="hidden" required
                            onchange="previewMainImage(event)">
                    </label>

                    {{-- Extra slots --}}
                    <div class="grid grid-cols-3 gap-2 mt-3">
                        @for($i = 0; $i < 3; $i++)
                            <label
                                class="aspect-square border-2 border-dashed border-gray-200 rounded-xl bg-gray-50 hover:bg-gray-100 cursor-pointer flex items-center justify-center transition-colors">
                                <i class='bx bx-plus text-gray-300 text-2xl'></i>
                            </label>
                        @endfor
                    </div>
                </div>

                {{-- RIGHT: Form Fields --}}
                <div class="flex-1 space-y-4">
                    {{-- Nama Produk --}}
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Nama Produk <span class="text-red-500">*</span></label>
                        <input type="text" name="name" placeholder="Contoh: Kripik Pisang Madu Organik"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20 placeholder-gray-300"
                            value="{{ old('name') }}" required>
                        @error('name')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Harga & Kategori --}}
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Harga (RP) <span class="text-red-500">*</span></label>
                            <input type="number" name="price" placeholder="0" min="0"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20"
                                value="{{ old('price') }}" required>
                            @error('price')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Kategori <span class="text-red-500">*</span></label>
                            <select name="category_id"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20"
                                required>
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
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Deskripsi Produk <span class="text-red-500">*</span></label>
                        <textarea name="description" rows="4"
                            placeholder="Jelaskan detail produk, bahan, dan keunggulan..."
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
                            <div class="w-11 h-6 bg-gray-200 peer-checked:bg-[#1a5c2a] rounded-full transition-colors mb-0"></div>
                            <div class="absolute left-0.5 top-0.5 w-5 h-5 bg-white rounded-full shadow transition-transform peer-checked:translate-x-5"></div>
                        </label>
                    </div>

                    {{-- Kontak & Sosial --}}
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Nomor WhatsApp</label>
                            <input type="text" name="whatsapp" placeholder="Contoh: 628123456789"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20 placeholder-gray-300"
                                value="{{ old('whatsapp') }}">
                            @error('whatsapp')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Link Shopee</label>
                            <input type="url" name="shoppee" placeholder="Contoh: https://shopee.co.id/..."
                                class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20 placeholder-gray-300"
                                value="{{ old('shoppee') }}">
                            @error('shoppee')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    {{-- Tags --}}
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Tags (pisahkan dengan koma)</label>
                        <input type="text" name="tags" placeholder="Contoh: keripik, pisang, manis"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20 placeholder-gray-300"
                            value="{{ old('tags') }}">
                        @error('tags')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Spesifikasi Produk --}}
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Berat Produk</label>
                            <input type="text" name="weight" placeholder="Contoh: 250g, 1 kg"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20 placeholder-gray-300"
                                value="{{ old('weight') }}">
                            @error('weight')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Jenis Produk</label>
                            <input type="text" name="type" placeholder="Contoh: Makanan, Minuman"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20 placeholder-gray-300"
                                value="{{ old('type') }}">
                            @error('type')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-3">
                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Kemasan</label>
                            <input type="text" name="packaging" placeholder="Contoh: Pouch, Botol"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20 placeholder-gray-300"
                                value="{{ old('packaging') }}">
                            @error('packaging')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Daya Tahan</label>
                            <input type="text" name="shelf_life" placeholder="Contoh: 6 bulan"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20 placeholder-gray-300"
                                value="{{ old('shelf_life') }}">
                            @error('shelf_life')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Produksi</label>
                            <input type="text" name="production" placeholder="Contoh: Setiap Hari"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20 placeholder-gray-300"
                                value="{{ old('production') }}">
                            @error('production')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    {{-- Hidden fields --}}
                    <input type="hidden" name="seller" value="{{ Auth::user()->name }}">
                </div>
            </div>

            {{-- Actions --}}
            <div class="mt-6 flex justify-end gap-3 border-t border-gray-100 pt-4">
                <a href="{{ route('admin.products.index') }}"
                    class="px-5 py-2.5 rounded-lg border border-gray-200 text-sm font-semibold text-gray-600 hover:bg-gray-50 transition-colors">
                    Batal
                </a>
                <button type="submit" id="submitBtn"
                    class="flex items-center gap-2 bg-[#1a5c2a] hover:bg-[#154a22] text-white text-sm font-semibold px-6 py-2.5 rounded-lg transition-colors shadow-sm">
                    <i class='bx bx-check' id="submitIcon"></i>
                    <span id="submitText">Simpan Produk</span>
                </button>
            </div>
        </div>
    </form>

    {{-- Loading overlay --}}
    <div id="uploadOverlay" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center">
        <div class="bg-white rounded-2xl p-8 text-center shadow-2xl max-w-xs w-full mx-4">
            <svg class="animate-spin h-10 w-10 text-[#1a5c2a] mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.568 3 7.291l3-2z"></path>
            </svg>
            <p class="font-semibold text-gray-800 text-base">Menyimpan produk...</p>
            <p class="text-sm text-gray-500 mt-1">Sedang mengunggah foto ke server</p>
        </div>
    </div>

    <script>
        document.querySelector('form').addEventListener('submit', function () {
            document.getElementById('uploadOverlay').classList.remove('hidden');
            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            document.getElementById('submitIcon').className = '';
            document.getElementById('submitText').textContent = 'Menyimpan...';
        });

        // Preview gambar utama
        function previewMainImage(event) {
            const file = event.target.files[0];
            if (!file) return;
            if (file.size > 5 * 1024 * 1024) {
                alert('Ukuran foto produk maksimal 5MB. Silakan pilih foto lain.');
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