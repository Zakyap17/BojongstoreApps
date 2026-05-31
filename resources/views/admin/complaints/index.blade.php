<x-admin-panel>
    {{-- Breadcrumb --}}
    <div class="mb-1">
        <nav class="text-xs text-gray-400 flex items-center gap-1.5">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-600 transition">Dashboard</a>
            <i class='bx bx-chevron-right'></i>
            <span class="text-gray-600 font-medium">Manajemen Keluhan</span>
        </nav>
    </div>

    <div class="mb-6 flex justify-between items-end">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Manajemen Keluhan</h1>
            <p class="text-sm text-gray-500 mt-1">Daftar laporan dan keluhan yang dikirimkan oleh pengguna melalui Pusat
                Bantuan.</p>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="bg-gray-50/80 text-gray-700 text-xs uppercase font-semibold">
                    <tr>
                        <th class="px-6 py-4 border-b border-gray-100">Tanggal</th>
                        <th class="px-6 py-4 border-b border-gray-100">Pelapor</th>
                        <th class="px-6 py-4 border-b border-gray-100">Kategori</th>
                        <th class="px-6 py-4 border-b border-gray-100 w-1/3">Pesan Detail</th>
                        <th class="px-6 py-4 border-b border-gray-100 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($complaints as $complaint)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-gray-900 font-medium">{{ $complaint->created_at->format('d M Y') }}</span>
                                <div class="text-xs text-gray-400 mt-0.5">{{ $complaint->created_at->format('H:i') }} WIB
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-900">{{ $complaint->name }}</div>
                                <div class="text-xs text-gray-500 flex items-center gap-1 mt-1">
                                    <i class='bx bx-envelope'></i> {{ $complaint->contact }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-3 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-600 border border-blue-100">
                                    {{ $complaint->category }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-gray-700 text-sm leading-relaxed line-clamp-2"
                                    title="{{ $complaint->message }}">
                                    {{ $complaint->message }}
                                </p>
                            </td>
                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                <form action="{{ route('admin.complaints.destroy', $complaint->id) }}" method="POST"
                                    class="inline-block confirm-delete"
                                    data-message="Data keluhan ini akan dihapus secara permanen dari sistem.">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-8 h-8 rounded-lg bg-red-50 text-red-600 hover:bg-red-500 hover:text-white transition flex items-center justify-center border border-red-100"
                                        title="Hapus Keluhan">
                                        <i class='bx bx-trash text-base'></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <div
                                        class="w-20 h-20 bg-gradient-to-br from-green-50 to-green-100 rounded-full flex items-center justify-center mb-4 shadow-inner border border-green-200/50">
                                        <i class='bx bx-check-shield text-4xl text-green-500'></i>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-800 mb-1">Tidak Ada Keluhan</h3>
                                    <p class="text-sm text-gray-500 max-w-sm mx-auto">Semua layanan berjalan lancar. Belum
                                        ada laporan keluhan yang masuk saat ini dari pengguna.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($complaints->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $complaints->links() }}
            </div>
        @endif
    </div>
</x-admin-panel>