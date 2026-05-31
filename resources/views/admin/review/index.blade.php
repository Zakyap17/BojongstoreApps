<x-admin-panel>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

        {{-- Total Ulasan --}}
        <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Total Ulasan</p>
            <div class="flex items-end gap-3">
                <p class="text-4xl font-bold text-gray-800">{{ number_format($total) }}</p>
                <span class="text-sm font-semibold text-[#1a5c2a] mb-1">↑ +12%</span>
            </div>
        </div>

        {{-- Rata-rata Rating --}}
        <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Rata-rata Rating</p>
            <div class="flex items-end gap-3">
                <p class="text-4xl font-bold text-gray-800">{{ $avg_rating }}</p>
                <i class='bx bxs-star text-yellow-400 text-2xl mb-1'></i>
            </div>
        </div>

        {{-- Performa Kepuasan --}}
        <div class="bg-[#1a5c2a] rounded-xl p-5 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-white/60 uppercase tracking-widest mb-2">Performa Kepuasan</p>
                <p class="text-lg font-bold text-white mb-1">Sangat Memuaskan</p>
                <p class="text-sm text-white/70">92% pengguna memberikan rating bintang 5 bulan ini.</p>
            </div>
            <div class="w-12 h-12 bg-white/15 rounded-full flex items-center justify-center flex-shrink-0 ml-4">
                <i class='bx bx-happy text-white text-2xl'></i>
            </div>
        </div>
    </div>

    {{-- Filter Bar --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm px-5 py-4 mb-5 flex flex-wrap items-center gap-3">
        <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Filter Rating:</span>
        <div class="flex flex-wrap items-center gap-2 flex-1">
            @foreach(['' => 'Semua', '5' => '5', '4' => '4', '3' => '3', '2' => '2', '1' => '1'] as $val => $label)
            <a href="{{ route('admin.review.index', array_merge(request()->query(), ['rating' => $val])) }}"
               class="flex items-center gap-1 px-4 py-1.5 rounded-full text-sm font-semibold transition-all
                      {{ (string)$rating === (string)$val ? 'bg-[#1a5c2a] text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                {{ $label }}
                @if($val !== '')
                    <i class='bx bxs-star text-xs {{ (string)$rating === (string)$val ? 'text-yellow-300' : 'text-yellow-400' }}'></i>
                @endif
            </a>
            @endforeach
        </div>
        {{-- Sort --}}
        <form method="GET" action="{{ route('admin.review.index') }}">
            @if($rating)<input type="hidden" name="rating" value="{{ $rating }}">@endif
            <select name="sort" onchange="this.form.submit()"
                    class="border border-gray-200 rounded-lg px-3 py-1.5 text-sm text-gray-600 focus:outline-none">
                <option value="latest" {{ $sort === 'latest' ? 'selected' : '' }}>Terbaru</option>
                <option value="oldest" {{ $sort === 'oldest' ? 'selected' : '' }}>Terlama</option>
            </select>
        </form>
    </div>

    {{-- Review Grid --}}
    <div class="space-y-4 mb-5">
        @php $chunks = $reviews->chunk(2); @endphp

        @foreach($chunks as $pair)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($pair as $review)
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
                {{-- Product Row --}}
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center flex-shrink-0 overflow-hidden">
                            @if($review->product_image)
                                <img src="{{ asset('storage/' . $review->product_image) }}" class="w-full h-full object-cover" alt="">
                            @else
                                <i class='bx bx-box text-gray-400 text-lg'></i>
                            @endif
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-800">{{ $review->product_name }}</p>
                            <p class="text-xs text-gray-400">UMKM: {{ $review->umkm_name ?? '—' }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="flex items-center gap-0.5 justify-end">
                            {!! $review->stars_html !!}
                        </div>
                        <p class="text-[11px] text-gray-400 mt-0.5 uppercase tracking-wide">{{ $review->created_at->diffForHumans() }}</p>
                    </div>
                </div>

                {{-- Reviewer --}}
                <div class="flex items-center gap-2 mb-3">
                    <div class="w-7 h-7 rounded-full bg-[#e8f5ec] flex items-center justify-center">
                        <span class="text-xs font-bold text-[#1a5c2a]">{{ $review->reviewer_initials }}</span>
                    </div>
                    <span class="text-sm font-semibold text-gray-800">{{ $review->reviewer_name }}</span>
                    @if($review->is_verified)
                    <span class="text-[11px] font-semibold text-[#1a5c2a] bg-[#e8f5ec] px-2 py-0.5 rounded-full">✓ Verified Buyer</span>
                    @endif
                </div>

                {{-- Content --}}
                <p class="text-sm text-gray-600 leading-relaxed italic mb-4">"{{ $review->content }}"</p>

                {{-- Actions --}}
                <div class="flex items-center justify-between pt-3 border-t border-gray-50">
                    <div class="flex gap-2">
                        <button class="text-xs font-semibold px-3 py-1.5 border border-gray-200 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors">Balas</button>
                        <button class="text-xs font-semibold px-3 py-1.5 border border-gray-200 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors">Laporkan</button>
                    </div>
                    <form action="{{ route('admin.review.destroy', $review->id) }}" method="POST"
                          onsubmit="return confirm('Hapus ulasan ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs text-red-400 hover:text-red-600 font-medium transition-colors">
                            <i class='bx bx-trash'></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach

        @if($reviews->isEmpty())
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm py-16 text-center text-gray-400">
            <i class='bx bx-star text-4xl mb-2 block'></i>
            <p class="text-sm">Belum ada ulasan untuk filter ini.</p>
        </div>
        @endif
    </div>

    {{-- Pagination --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm px-5 py-4 flex flex-col sm:flex-row items-center justify-between gap-3">
        <p class="text-xs text-gray-400">
            Menampilkan {{ $reviews->firstItem() ?? 0 }}–{{ $reviews->lastItem() ?? 0 }} dari {{ $reviews->total() }} ulasan
        </p>
        <div class="text-sm">{{ $reviews->links() }}</div>
    </div>

</x-admin-panel>
