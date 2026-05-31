<x-admin-panel>
    <div class="mb-4">
        <nav class="text-xs text-gray-400 flex items-center gap-1.5">
            <a href="{{ route('admin.umkm.index') }}" class="hover:text-gray-600">UMKM</a>
            <i class='bx bx-chevron-right'></i>
            <span class="text-gray-600 font-medium">{{ $umkm->name }}</span>
        </nav>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-7 max-w-2xl">
        <div class="flex items-center gap-4 mb-6">
            <div class="w-14 h-14 rounded-xl flex items-center justify-center {{ $umkm->category_color }}">
                <i class='bx {{ $umkm->category_icon }} text-2xl'></i>
            </div>
            <div>
                <h1 class="text-xl font-bold text-gray-900">{{ $umkm->name }}</h1>
                <span class="text-sm font-semibold {{ $umkm->category_badge }}">{{ $umkm->category }}</span>
            </div>
            <div class="ml-auto">
                <span class="text-xs font-semibold px-3 py-1 rounded-full
                    {{ $umkm->status === 'terverifikasi' ? 'bg-green-100 text-green-700' : ($umkm->status === 'menunggu' ? 'bg-orange-100 text-orange-600' : 'bg-red-100 text-red-600') }}">
                    {{ ucfirst($umkm->status) }}
                </span>
            </div>
        </div>

        <div class="space-y-4 text-sm">
            <div class="grid grid-cols-2 gap-4">
                <div><p class="text-xs text-gray-400 font-semibold mb-1">PEMILIK</p><p class="text-gray-700">{{ $umkm->owner ?? '—' }}</p></div>
                <div><p class="text-xs text-gray-400 font-semibold mb-1">KELURAHAN</p><p class="text-gray-700">{{ $umkm->kelurahan ?? '—' }}</p></div>
                <div><p class="text-xs text-gray-400 font-semibold mb-1">NO. TELEPON</p><p class="text-gray-700">{{ $umkm->phone ?? '—' }}</p></div>
                <div><p class="text-xs text-gray-400 font-semibold mb-1">EMAIL</p><p class="text-gray-700">{{ $umkm->email ?? '—' }}</p></div>
            </div>
            <div><p class="text-xs text-gray-400 font-semibold mb-1">ALAMAT</p><p class="text-gray-700">{{ $umkm->address }}</p></div>
            <div><p class="text-xs text-gray-400 font-semibold mb-1">DESKRIPSI</p><p class="text-gray-700">{{ $umkm->description ?? '—' }}</p></div>
        </div>

        <div class="flex gap-3 mt-7 pt-6 border-t border-gray-100">
            <a href="{{ route('admin.umkm.edit', $umkm->id) }}"
               class="flex items-center gap-2 bg-[#1a5c2a] hover:bg-[#154a22] text-white text-sm font-semibold px-5 py-2.5 rounded-lg transition-colors">
                <i class='bx bx-edit'></i> Edit Data
            </a>
            <a href="{{ route('admin.umkm.index') }}"
               class="px-5 py-2.5 text-sm font-medium text-gray-600 hover:text-gray-800 transition-colors">
                ← Kembali
            </a>
        </div>
    </div>
</x-admin-panel>
