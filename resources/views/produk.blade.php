@extends('layouts.landing')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/produk.css') }}">
@endpush

@section('content')

    <section class="hero">
        <div class="container">
            <div class="hero-banner">
                <div class="hero-content">
                    <h1 style="color: white;">PRODUK TERBAIK, LANGSUNG DARI JANTUNG DESA.</h1>
                    <p style="color: white;">Lebih dari Sekedar Belanja. Setiap Produk Yang Anda Beli Membantu Pengrajin dan
                        Petani Lokal Kita untuk Terus Bertumbuh di Era Digital.</p>
                    <a href="{{ route('katalog') }}" class="btn-primary">BELANJA SEKARANG</a>
                </div>
                <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&q=80&w=800"
                    alt="Groceries" class="hero-image">
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>Kategori Pilihan</h2>
                <p>Temukan keajaiban lokal dalam berbagai varian.</p>
            </div>
            <div class="categories-grid">
                @foreach($categories as $category)
                    <a href="{{ route('katalog', ['category' => $category->id]) }}" class="category-card">
                        <div class="category-icon">
                            @php
                                $icons = [
                                    'Sayuran' => 'sayuranlogo.png',
                                    'Buah-buahan' => 'buahlogo.png',
                                    'Kerajinan Tangan' => 'kerajinanlogo.png',
                                    'Makanan Olahan' => 'makananlogo.png',
                                    'Minuman' => 'minumanlogo.png',
                                    'Jasa' => 'jasalogo.png',
                                ];
                                $icon = $icons[$category->name] ?? 'logo.png';
                            @endphp
                            <img src="{{ asset('images/' . $icon) }}" width="60" height="60" alt="{{ $category->name }}">
                        </div>
                        <h3>{{ $category->name }}</h3>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== PRODUK UNGGULAN ===== --}}
    <section class="products-section">
        <div class="container">
            <div class="section-title">
                <h2>Produk Unggulan</h2>
                <p>Pilihan terbaik yang paling diminati pelanggan kami.</p>
            </div>
            <div class="products-grid">
                @forelse($featuredProducts as $product)
                    <div class="product-card">
                        <div class="product-image-container">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-image">
                            <button class="wishlist-btn" data-slug="{{ $product->slug }}" data-product-id="{{ $product->id }}"><i data-lucide="bookmark" width="18" height="18"></i></button>
                            {{-- Badge "Unggulan" --}}
                            <span class="featured-badge">
                                <i data-lucide="star" width="12" height="12" fill="currentColor"></i>
                                Unggulan
                            </span>
                        </div>
                        <div class="product-title">{{ $product->name }}</div>
                        <div class="product-weight">{{ $product->weight }}</div>
                        <div class="product-rating-card"
                            style="display: flex; align-items: center; justify-content: center; gap: 4px; margin-bottom: 8px;">
                            <div class="stars" id="productAverageStars">
                                @php
                                    $averageRating = \App\Models\Review::where('product_id', $product->slug)->avg('rating') ?? 0;
                                    $reviewCount = \App\Models\Review::where('product_id', $product->slug)->count();
                                    $roundedRating = round($averageRating);
                                @endphp
                                @for ($i = 1; $i <= 5; $i++)
                                    <i data-lucide="star" fill="{{ $i <= $roundedRating ? '#fbbf24' : 'none' }}" width="16"
                                        height="16" style="color: {{ $i <= $roundedRating ? '#fbbf24' : '#e2e8f0' }}"></i>
                                @endfor
                            </div>
                            <span style="font-size: 12px; color: #71717a;">({{ $reviewCount }})</span>
                        </div>
                        <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        <a href="{{ route('product-detail', $product->slug) }}" class="btn-secondary"
                            style="text-decoration: none; text-align: center; display: block;">Lihat Detail</a>
                    </div>
                @empty
                    <p style="color: var(--text-muted); grid-column: 1 / -1; text-align: center; padding: 40px 0;">
                        Belum ada produk unggulan saat ini.
                    </p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ===== PRODUK KAMI ===== --}}
    @if($regularProducts->count() > 0)
        <section class="products-section produk-kami-section">
            <div class="container">
                <div class="section-title">
                    <h2>Produk Kami</h2>
                    <p>Semua produk berkualitas dari mitra UMKM lokal Bojongsoang.</p>
                </div>
                <div class="products-grid">
                    @foreach($regularProducts as $product)
                        <div class="product-card">
                            <div class="product-image-container">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-image">
                                <button class="wishlist-btn" data-slug="{{ $product->slug }}" data-product-id="{{ $product->id }}"><i data-lucide="bookmark" width="18" height="18"></i></button>
                            </div>
                            <div class="product-title">{{ $product->name }}</div>
                            <div class="product-weight">{{ $product->weight }}</div>
                            <div class="product-rating-card"
                                style="display: flex; align-items: center; justify-content: center; gap: 4px; margin-bottom: 8px;">
                                <div class="stars" style="display: flex; gap: 2px; color: #fbbf24;">
                                    @php
                                        $averageRating = $product->reviews_avg_rating ?? 0;
                                        $reviewCount = $product->reviews_count ?? 0;
                                        $roundedRating = round($averageRating);
                                    @endphp
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i data-lucide="star" fill="{{ $i <= $roundedRating ? '#fbbf24' : 'none' }}" width="14"
                                            height="14" style="color: {{ $i <= $roundedRating ? '#fbbf24' : '#e2e8f0' }}"></i>
                                    @endfor
                                </div>
                                <span style="font-size: 12px; color: #71717a;">({{ $reviewCount }})</span>
                            </div>
                            <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                            <a href="{{ route('product-detail', $product->slug) }}" class="btn-secondary"
                                style="text-decoration: none; text-align: center; display: block;">Lihat Detail</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif


    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-info">
                    <div class="logo-wrapper footer-logo">
                        <span class="logo-text footer-logo-text">BojongStore</span>
                    </div>
                    <p class="footer-desc">Mendukung keberlanjutan ekonomi lokal Indonesia melalui digitalisasi UMKM
                        dengan cara yang elegan dan efisien.</p>
                </div>
                <div class="footer-column">
                    <h4 class="footer-title">Kategori</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('katalog', ['category' => 1]) }}">Sayuran</a></li>
                        <li><a href="{{ route('katalog', ['category' => 2]) }}">Buah-buahan</a></li>
                        <li><a href="{{ route('katalog', ['category' => 2]) }}">Kerajinan Tangan</a></li>
                        <li><a href="{{ route('katalog', ['category' => 4]) }}">Makanan Olahan</a></li>
                        <li><a href="{{ route('katalog', ['category' => 5]) }}">Minuman</a></li>
                        <li><a href="{{ route('katalog', ['category' => 6]) }}">Jasa</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4 class="footer-title">Bantuan</h4>
                    <p class="footer-desc" style="margin-bottom: 16px;">Jika Anda mengalami kendala, silahkan hubungi
                        kami dengan mudah melalui tombol di bawah.</p>
                    <button class="btn-footer" id="openHelpBtn">Bantuan</button>
                </div>
            </div>
            <div class="footer-bottom">
                &copy; 2026 BojongStore. Mendukung UMKM Lokal Indonesia.
            </div>
        </div>
    </footer>

    <!-- Help Center Modal -->
    <div class="help-modal-overlay" id="helpModal">
        <div class="help-modal-content">
            <button class="btn-help-close" id="closeHelpModal">
                <i data-lucide="x" width="18" height="18"></i>
            </button>

            <div id="helpFormState">
                <div class="help-modal-header">
                    <i data-lucide="help-circle" width="32" height="32"></i>
                    <h2>Pusat Bantuan</h2>
                    <p>Punya keluhan atau pertanyaan? Kami siap membantu Anda.</p>
                </div>

                <form id="complaintForm">
                    <div class="help-form-group">
                        <label for="helpName">Nama Lengkap</label>
                        <input type="text" id="helpName" class="help-input" placeholder="Masukkan nama Anda" required>
                    </div>
                    <div class="help-form-group">
                        <label for="helpContact">Email / WhatsApp</label>
                        <input type="text" id="helpContact" class="help-input"
                            placeholder="Contoh: 0812xxxx atau email@mail.com" required>
                    </div>
                    <div class="help-form-group">
                        <label for="helpCategory">Kategori Keluhan</label>
                        <select id="helpCategory" class="help-select" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Produk">Masalah Produk</option>
                            <option value="Pengiriman">Masalah Pengiriman</option>
                            <option value="Pembayaran">Masalah Pembayaran</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="help-form-group">
                        <label for="helpMessage">Detail Keluhan</label>
                        <textarea id="helpMessage" class="help-textarea" placeholder="Ceritakan kendala yang Anda alami..."
                            required></textarea>
                    </div>
                    <button type="submit" class="btn-help-submit">
                        <span>Kirim Keluhan</span>
                        <i data-lucide="send" width="18" height="18"></i>
                    </button>
                </form>
            </div>

            <div id="helpSuccessState" class="success-state">
                <i data-lucide="check-circle" width="64" height="64"></i>
                <h2>Berhasil Terkirim!</h2>
                <p>Terima kasih atas laporan Anda. Tim kami akan segera menindaklanjuti keluhan Anda melalui kontak yang
                    tersedia.</p>
                <button class="btn-help-submit" style="margin-top: 32px;" onclick="closeHelpModal()">Tutup</button>
            </div>
        </div>
    </div>

    <script>
        const isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
        const csrfToken = '{{ csrf_token() }}';

        // Initialize state from DB if logged in
        async function initWishlist() {
            if (!isLoggedIn) return;
            try {
                const res = await fetch('/api/favorites', { headers: { 'Accept': 'application/json' } });
                const data = await res.json();
                const favoriteIds = new Set(data.favorites.map(String));
                document.querySelectorAll('.wishlist-btn').forEach(btn => {
                    const pid = btn.getAttribute('data-product-id');
                    if (pid && favoriteIds.has(pid)) {
                        btn.classList.add('active');
                        const icon = btn.querySelector('svg') || btn.querySelector('i');
                        if (icon) icon.setAttribute('fill', 'currentColor');
                    }
                });
            } catch(e) { console.error(e); }
        }

        // Wishlist Toggle via API
        document.querySelectorAll('.wishlist-btn').forEach(btn => {
            btn.addEventListener('click', async (e) => {
                e.preventDefault();
                if (!isLoggedIn) {
                    window.location.href = '{{ route('login') }}';
                    return;
                }
                const productId = btn.getAttribute('data-product-id');
                if (!productId) return;
                try {
                    const res = await fetch(`/api/favorites/${productId}`, {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
                    });
                    const data = await res.json();
                    btn.classList.toggle('active', data.status === 'added');
                    const icon = btn.querySelector('svg') || btn.querySelector('i');
                    if (icon) icon.setAttribute('fill', data.status === 'added' ? 'currentColor' : 'none');
                } catch(err) { console.error(err); }
            });
        });

        document.addEventListener('DOMContentLoaded', initWishlist);

        // Help Modal
        const helpModal = document.getElementById('helpModal');
        const openHelpBtn = document.getElementById('openHelpBtn');
        const closeHelpBtn = document.getElementById('closeHelpModal');
        const complaintForm = document.getElementById('complaintForm');
        const helpFormState = document.getElementById('helpFormState');
        const helpSuccessState = document.getElementById('helpSuccessState');

        function openHelpModal() {
            helpModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeHelpModal() {
            helpModal.classList.remove('active');
            document.body.style.overflow = 'auto';
            setTimeout(() => {
                helpFormState.style.display = 'block';
                helpSuccessState.style.display = 'none';
                const submitBtn = complaintForm.querySelector('button[type="submit"]');
                submitBtn.innerHTML = '<span>Kirim Keluhan</span><i data-lucide="send" width="18" height="18"></i>';
                submitBtn.disabled = false;
                complaintForm.reset();
                lucide.createIcons();
            }, 300);
        }

        if (openHelpBtn) openHelpBtn.addEventListener('click', openHelpModal);
        if (closeHelpBtn) closeHelpBtn.addEventListener('click', closeHelpModal);
        helpModal.addEventListener('click', (e) => { if (e.target === helpModal) closeHelpModal(); });

        complaintForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const submitBtn = complaintForm.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<span>Mengirim...</span>';
            submitBtn.disabled = true;

            const name = document.getElementById('helpName').value;
            const contact = document.getElementById('helpContact').value;
            const category = document.getElementById('helpCategory').value;
            const message = document.getElementById('helpMessage').value;

            fetch('/help-complaints', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ name, contact, category, message })
            })
                .then(res => {
                    if (!res.ok) throw new Error('Gagal mengirim');
                    return res.json();
                })
                .then(data => {
                    helpFormState.style.display = 'none';
                    helpSuccessState.style.display = 'block';
                    lucide.createIcons();
                })
                .catch(err => {
                    console.error(err);
                    alert('Gagal mengirim keluhan. Silakan coba lagi.');
                    submitBtn.innerHTML = '<span>Kirim Keluhan</span><i data-lucide="send" width="18" height="18"></i>';
                    submitBtn.disabled = false;
                    lucide.createIcons();
                });
        });
    </script>

@endsection