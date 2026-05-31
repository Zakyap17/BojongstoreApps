<x-admin-panel>
    <div class="mb-4">
        <nav class="text-xs text-gray-400 flex items-center gap-1.5">
            <a href="{{ route('admin.umkm.index') }}" class="hover:text-gray-600">UMKM</a>
            <i class='bx bx-chevron-right'></i>
            <span class="text-gray-600 font-medium">Edit {{ $umkm->name }}</span>
        </nav>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-7 max-w-2xl">
        <h1 class="text-xl font-bold text-gray-900 mb-6">Edit Data UMKM</h1>

        <form action="{{ route('admin.umkm.update', $umkm->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Nama UMKM</label>
                    <input type="text" name="name" value="{{ old('name', $umkm->name) }}"
                           class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Kategori</label>
                        <select name="category" class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20" required>
                            @foreach(['Kuliner','Kriya','Kesehatan','Fashion','Pertanian'] as $cat)
                                <option value="{{ $cat }}" {{ old('category', $umkm->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Status</label>
                        <select name="status" class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20" required>
                            <option value="menunggu" {{ old('status', $umkm->status) == 'menunggu' ? 'selected' : '' }}>Menunggu Review</option>
                            <option value="terverifikasi" {{ old('status', $umkm->status) == 'terverifikasi' ? 'selected' : '' }}>Terverifikasi</option>
                            <option value="ditolak" {{ old('status', $umkm->status) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Alamat</label>
                    <input type="text" name="address" value="{{ old('address', $umkm->address) }}"
                           class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Kelurahan</label>
                        <input type="text" name="kelurahan" value="{{ old('kelurahan', $umkm->kelurahan) }}"
                               class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Pemilik</label>
                        <input type="text" name="owner" value="{{ old('owner', $umkm->owner) }}"
                               class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">No. Telepon</label>
                        <input type="text" name="phone" value="{{ old('phone', $umkm->phone) }}"
                               class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Email</label>
                        <input type="email" name="email" value="{{ old('email', $umkm->email) }}"
                               class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20">
                    </div>
                </div>
                <div>
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Deskripsi</label>
                    <textarea name="description" rows="3"
                              class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20 resize-none">{{ old('description', $umkm->description) }}</textarea>
                </div>
            </div>

            <div class="flex gap-3 mt-7 pt-6 border-t border-gray-100">
                <button type="submit"
                        class="flex items-center gap-2 bg-[#1a5c2a] hover:bg-[#154a22] text-white text-sm font-semibold px-5 py-2.5 rounded-lg transition-colors">
                    <i class='bx bx-check'></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.umkm.index') }}"
                   class="px-5 py-2.5 text-sm font-medium text-gray-600 hover:text-gray-800 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-admin-panel>
