<x-admin-panel>

    {{-- Header Row --}}
    <div class="flex items-start justify-between mb-6">
        <div>
            <h1 class="text-lg font-bold text-[#1a5c2a]">Daftar Mitra UMKM</h1>
            <p class="text-sm text-gray-500 mt-0.5">Kelola seluruh mitra UMKM yang terdaftar di ekosistem BojongStore.</p>
        </div>
        <button onclick="document.getElementById('modalTambahUmkm').classList.remove('hidden')"
                class="flex items-center gap-2 bg-[#1a5c2a] hover:bg-[#154a22] text-white text-sm font-semibold px-5 py-2.5 rounded-lg transition-colors shadow-sm whitespace-nowrap">
            <i class='bx bx-plus text-lg'></i> Tambah UMKM
        </button>
    </div>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        {{-- Total UMKM --}}
        <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
            <div class="flex items-start justify-between mb-3">
                <div class="w-9 h-9 bg-[#e8f5ec] rounded-lg flex items-center justify-center">
                    <i class='bx bx-store text-lg text-[#1a5c2a]'></i>
                </div>
                <span class="text-xs font-semibold text-[#1a5c2a]">+12%</span>
            </div>
            <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold">Total UMKM</p>
            <p class="text-3xl font-bold text-gray-800 mt-1">{{ number_format($total) }}</p>
        </div>

        {{-- Terverifikasi --}}
        <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
            <div class="flex items-start justify-between mb-3">
                <div class="w-9 h-9 bg-blue-50 rounded-lg flex items-center justify-center">
                    <i class='bx bx-check-shield text-lg text-blue-500'></i>
                </div>
                <span class="text-xs font-semibold text-blue-500">Aktif</span>
            </div>
            <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold">Terverifikasi</p>
            <p class="text-3xl font-bold text-gray-800 mt-1">{{ number_format($terverifikasi) }}</p>
        </div>

        {{-- Menunggu Review --}}
        <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
            <div class="flex items-start justify-between mb-3">
                <div class="w-9 h-9 bg-orange-50 rounded-lg flex items-center justify-center">
                    <i class='bx bx-time text-lg text-orange-400'></i>
                </div>
                <span class="text-xs font-semibold text-orange-400">Baru</span>
            </div>
            <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold">Menunggu Review</p>
            <p class="text-3xl font-bold text-gray-800 mt-1">{{ number_format($menunggu) }}</p>
        </div>

        {{-- Cakupan Wilayah --}}
        <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
            <div class="w-9 h-9 bg-gray-100 rounded-lg flex items-center justify-center mb-3">
                <i class='bx bx-map text-lg text-gray-500'></i>
            </div>
            <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold">Cakupan Wilayah Bojongsoang</p>
            <p class="text-3xl font-bold text-gray-800 mt-1">{{ $wilayah }}</p>
            <p class="text-sm font-semibold text-gray-500">Desa/Kelurahan</p>
        </div>
    </div>

    {{-- Table Card --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">

        {{-- Column Headers --}}
        <div class="grid grid-cols-12 px-5 py-3 border-b border-gray-100">
            <div class="col-span-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Nama UMKM & Profil</div>
            <div class="col-span-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Alamat Operasional</div>
            <div class="col-span-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Deskripsi Singkat</div>
            <div class="col-span-2 text-xs font-bold text-gray-400 uppercase tracking-wider text-right">Aksi</div>
        </div>

        {{-- Rows --}}
        <div class="divide-y divide-gray-50">
            @forelse($umkms as $umkm)
            <div class="grid grid-cols-12 items-center px-5 py-4 hover:bg-gray-50/50 transition-colors">

                {{-- Nama & Profil --}}
                <div class="col-span-4 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 {{ $umkm->category_color }}">
                        <i class='bx {{ $umkm->category_icon }} text-lg'></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-800">{{ $umkm->name }}</p>
                        <p class="text-xs font-semibold {{ $umkm->category_badge }}">{{ $umkm->category }}</p>
                    </div>
                </div>

                {{-- Alamat --}}
                <div class="col-span-3">
                    <div class="flex items-start gap-1.5">
                        <i class='bx bx-map-pin text-gray-400 text-sm mt-0.5 flex-shrink-0'></i>
                        <p class="text-sm text-gray-600 leading-snug line-clamp-2">{{ $umkm->address }}</p>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="col-span-3">
                    <p class="text-sm text-gray-500 leading-snug line-clamp-2">{{ $umkm->description ?? $umkm->address }}</p>
                </div>

                {{-- Aksi Dropdown --}}
                <div class="col-span-2 flex justify-end" x-data="{ open: false }">
                    <div class="relative">
                        <button @click="open = !open" @click.outside="open = false"
                                class="flex items-center gap-1.5 px-3 py-1.5 border border-gray-200 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition-colors">
                            Aksi <i class='bx bx-chevron-down text-base'></i>
                        </button>
                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             class="absolute right-0 mt-1 w-36 bg-white rounded-xl shadow-lg border border-gray-100 py-1 z-50">
                            {{-- Lihat Detail --}}
                            <a href="{{ route('admin.umkm.show', $umkm->id) }}"
                               class="flex items-center gap-2.5 px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                <i class='bx bx-show text-base text-gray-500'></i> Lihat Detail
                            </a>
                            {{-- Edit --}}
                            <a href="{{ route('admin.umkm.edit', $umkm->id) }}"
                               class="flex items-center gap-2.5 px-3 py-2 text-sm text-[#1a5c2a] hover:bg-gray-50">
                                <i class='bx bx-edit text-base text-[#1a5c2a]'></i> Edit Data
                            </a>
                            {{-- Hapus --}}
                            <form action="{{ route('admin.umkm.destroy', $umkm->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus UMKM ini?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="flex items-center gap-2.5 px-3 py-2 text-sm text-red-500 hover:bg-red-50 w-full text-left">
                                    <i class='bx bx-trash text-base text-red-500'></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="py-16 text-center text-gray-400">
                <i class='bx bx-store text-4xl mb-2 block'></i>
                <p class="text-sm">Belum ada data UMKM. Tambah mitra pertama Anda!</p>
            </div>
            @endforelse
        </div>

        {{-- Pagination Footer --}}
        <div class="px-5 py-4 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-xs text-gray-400">
                Menampilkan {{ $umkms->firstItem() ?? 0 }}–{{ $umkms->lastItem() ?? 0 }} dari {{ $umkms->total() }} mitra
            </p>
            <div class="text-sm">{{ $umkms->links() }}</div>
        </div>
    </div>

    {{-- ===================== MODAL TAMBAH UMKM ===================== --}}
    <div id="modalTambahUmkm"
         class="hidden fixed inset-0 z-[200] bg-black/40 backdrop-blur-sm flex items-center justify-center px-4"
         onclick="if(event.target===this) this.classList.add('hidden')">

        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            {{-- Header --}}
            <div class="px-7 pt-7 pb-4 flex items-start justify-between border-b border-gray-100">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Tambah UMKM Baru</h2>
                    <p class="text-sm text-gray-500 mt-1">Daftarkan mitra UMKM baru ke dalam ekosistem BojongStore.</p>
                </div>
                <button onclick="document.getElementById('modalTambahUmkm').classList.add('hidden')"
                        class="text-gray-400 hover:text-gray-600 transition-colors ml-4">
                    <i class='bx bx-x text-2xl'></i>
                </button>
            </div>

            {{-- Form --}}
            <form action="{{ route('admin.umkm.store') }}" method="POST">
                @csrf
                <div class="px-7 py-6 space-y-4">

                    {{-- Nama --}}
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Nama UMKM</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Kripik Bojong Berkah"
                               class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20" required>
                        @error('name')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        {{-- Kategori --}}
                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Kategori</label>
                            <select name="category" class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20" required>
                                <option value="" disabled selected>Pilih Kategori</option>
                                @foreach(['Kuliner','Kriya','Kesehatan','Fashion','Pertanian'] as $cat)
                                    <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Status --}}
                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Status</label>
                            <select name="status" class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20" required>
                                <option value="menunggu" {{ old('status','menunggu') == 'menunggu' ? 'selected' : '' }}>Menunggu Review</option>
                                <option value="terverifikasi" {{ old('status') == 'terverifikasi' ? 'selected' : '' }}>Terverifikasi</option>
                                <option value="ditolak" {{ old('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>
                    </div>

                    {{-- Alamat --}}
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Alamat Operasional</label>
                        <input type="text" name="address" value="{{ old('address') }}" placeholder="Jl. Contoh No. 12, Kelurahan, Bojongsoang"
                               class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20" required>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        {{-- Kelurahan --}}
                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Kelurahan</label>
                            <input type="text" name="kelurahan" value="{{ old('kelurahan') }}" placeholder="Ciganitri"
                                   class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20">
                        </div>

                        {{-- Pemilik --}}
                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Nama Pemilik</label>
                            <input type="text" name="owner" value="{{ old('owner') }}" placeholder="Nama pemilik UMKM"
                                   class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        {{-- No. HP --}}
                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">No. Telepon</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="08xx-xxxx-xxxx"
                                   class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20">
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="email@umkm.com"
                                   class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20">
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1.5">Deskripsi Singkat</label>
                        <textarea name="description" rows="3" placeholder="Deskripsikan produk/layanan UMKM ini..."
                                  class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1a5c2a]/20 resize-none">{{ old('description') }}</textarea>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="px-7 py-4 border-t border-gray-100 flex justify-end gap-3">
                    <button type="button"
                            onclick="document.getElementById('modalTambahUmkm').classList.add('hidden')"
                            class="px-5 py-2.5 text-sm font-medium text-gray-600 hover:text-gray-800 transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                            class="flex items-center gap-2 bg-[#1a5c2a] hover:bg-[#154a22] text-white text-sm font-semibold px-6 py-2.5 rounded-lg transition-colors">
                        <i class='bx bx-check'></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Auto-open modal on validation error --}}
    @if($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('modalTambahUmkm').classList.remove('hidden');
        });
    </script>
    @endif

</x-admin-panel>
