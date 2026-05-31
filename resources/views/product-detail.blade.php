@extends('layouts.landing')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/produk.css') }}">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
@endpush

@section('content')
    <div id="notification-container" class="notification-container"></div>

    <div style="padding-top: 0px;">
        <div class="container">
            <div class="breadcrumb">
                <a href="/">Beranda</a> <span style="margin: 0 4px;">&rsaquo;</span>
                <a href="/">Produk</a> <span style="margin: 0 4px;">&rsaquo;</span>
                <span style="color: #1a1a1a;">{{ $product->name }}</span>
            </div>

            <div class="product-detail-grid">
                <div class="product-gallery">
                    <div class="product-main-image">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                    </div>
                    <button class="btn-fav-circle">
                        <i data-lucide="bookmark" width="24" height="24"></i>
                    </button>
                </div>

                <div class="product-info-content">
                    <h1>{{ $product->name }}</h1>
                    <div class="product-rating-inline">
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
                        <span class="rating-value"
                            id="productAverageRatingValue">{{ $averageRating > 0 ? number_format($averageRating, 1) : '0' }}/5
                            ({{ $reviewCount }} Ulasan)</span>
                    </div>
                    <div class="product-price-large">Rp {{ number_format($product->price, 0, ',', '.') }}</div>

                    <div class="product-desc-text">
                        {{ $product->description }}
                    </div>

                    <div class="product-specs">
                        {{-- Nama toko / UMKM --}}
                        @php $shopName = $product->umkm?->name ?? $product->seller; @endphp
                        @if($shopName)
                        <div style="background:#f0fdf4;border-radius:8px;padding:8px 12px;margin-bottom:8px;display:flex;align-items:center;gap:8px;">
                            <span style="font-size:18px;">🏪</span>
                            <div>
                                <span style="font-size:11px;color:#6b7280;display:block;">Nama Toko</span>
                                <span style="font-size:14px;font-weight:700;color:#00923F;">{{ $shopName }}</span>
                                @if($product->umkm)
                                    <span style="font-size:11px;color:#6b7280;display:block;">{{ $product->umkm->category }} • {{ $product->umkm->kelurahan }}</span>
                                @endif
                            </div>
                        </div>
                        @endif
                        <div><span class="spec-label">Berat Bersih:</span> <span
                                class="spec-value">{{ $product->weight }}</span></div>
                        <div><span class="spec-label">Jenis:</span> <span class="spec-value">{{ $product->type }}</span>
                        </div>
                        <div><span class="spec-label">Kemasan:</span> <span
                                class="spec-value">{{ $product->packaging }}</span></div>
                        <div><span class="spec-label">Daya Tahan:</span> <span
                                class="spec-value">{{ $product->shelf_life }}</span></div>
                        <div><span class="spec-label">Produksi:</span> <span
                                class="spec-value">{{ $product->production }}</span></div>
                    </div>

                    <hr style="border: none; border-top: 1px solid #f1f5f9; margin-top: 0; margin-bottom: 24px;">

                    <div class="purchase-actions">
                        <p style="font-weight: 400; margin-bottom: 12px; font-size: 14px; color: #71717a;">Pilih Metode
                            Pembelian</p>
                        
                        @php
                            $whatsappUrl = '#';
                            if (!empty($product->whatsapp)) {
                                if (str_starts_with($product->whatsapp, 'http://') || str_starts_with($product->whatsapp, 'https://')) {
                                    $whatsappUrl = $product->whatsapp;
                                } else {
                                    $cleanNumber = preg_replace('/[^0-9]/', '', $product->whatsapp);
                                    if (str_starts_with($cleanNumber, '0')) {
                                        $cleanNumber = '62' . substr($cleanNumber, 1);
                                    }
                                    $whatsappUrl = 'https://wa.me/' . $cleanNumber . '?text=' . urlencode('Halo BojongStore, saya tertarik dengan produk ' . $product->name . '.');
                                }
                            } else {
                                $whatsappUrl = 'https://wa.me/628123456789?text=' . urlencode('Halo BojongStore, saya tertarik dengan produk ' . $product->name . '.');
                            }
                        @endphp

                        @if($product->shoppee)
                        <a href="{{ $product->shoppee }}" target="_blank"
                            class="btn-shopee">
                            <img src="https://api.iconify.design/simple-icons:shopee.svg?color=white" width="28" height="28"
                                alt="Shopee">
                            Beli Di Shopee
                        </a>
                        @endif
                        <a href="{{ $whatsappUrl }}"
                            target="_blank" class="btn-whatsapp">
                            <img src="https://api.iconify.design/simple-icons:whatsapp.svg?color=white" width="28"
                                height="28" alt="WhatsApp">
                            Chat Penjual
                        </a>
                    </div>
                    <hr style="border: none; border-top: 1px solid #f1f5f9; margin-top: 24px;">
                </div>
            </div>
        </div>

        <section class="reviews-section">
            <div class="container">
                <div class="reviews-tabs">
                    <a href="#" class="review-tab active">Rating & Ulasan</a>
                </div>

                <div class="reviews-header">
                    <h2 style="font-size: 24px; font-weight: 800;">Semua Ulasan <span id="reviewCount"
                            style="font-weight: 400; color: #94a3b8;">(0)</span></h2>
                    <div class="reviews-controls">
                        <div class="filter-wrapper" style="position: relative;">
                            <button class="btn-filter-icon" id="btnFilter"><i data-lucide="sliders-horizontal" width="18"
                                    height="18"></i></button>
                            <div class="filter-dropdown" id="filterDropdown">
                                <div class="filter-option active" data-rating="0">Semua Rating</div>
                                <div class="filter-option" data-rating="5">5 Bintang</div>
                                <div class="filter-option" data-rating="4">4 Bintang</div>
                                <div class="filter-option" data-rating="3">3 Bintang</div>
                                <div class="filter-option" data-rating="2">2 Bintang</div>
                                <div class="filter-option" data-rating="1">1 Bintang</div>
                            </div>
                        </div>
                        <div class="sort-wrapper" style="position: relative;">
                            <button class="btn-sort" id="btnSort">Terbaru <i data-lucide="chevron-down" width="16"
                                    height="16"></i></button>
                            <div class="filter-dropdown" id="sortDropdown">
                                <div class="sort-option active" data-sort="latest">Terbaru</div>
                                <div class="sort-option" data-sort="oldest">Terlama</div>
                            </div>
                        </div>
                        <button class="btn-write-review" id="openReviewModal">Beri Ulasan</button>
                    </div>
                </div>

                <div class="reviews-grid">
                    <!-- Ulasan dimuat secara dinamis -->
                </div>

                <button class="btn-load-more">Muat Lebih Banyak</button>
            </div>
        </section>
    </div>{{-- end padding-top wrapper --}}

    <!-- Review Modal -->
    <div class="modal-overlay" id="reviewModal">
        <div class="modal-content">
            <button class="btn-close-modal" id="closeReviewModal">
                <i data-lucide="x" width="24" height="24"></i>
            </button>
            <div class="modal-header">
                <h2>Berikan Ulasan Anda</h2>
            </div>
            <div class="user-info-modal">
                <div class="user-avatar">
                    <img src="https://api.iconify.design/noto:person-walking.svg" width="32" height="32" alt="User">
                </div>
                <span style="font-weight: 700; color: var(--text-dark);">Anda</span>
            </div>

            <span class="modal-label">Rating Produk</span>
            <div class="rating-input" id="starRating">
                <i data-lucide="star" class="star-input" data-value="1" width="32" height="32"></i>
                <i data-lucide="star" class="star-input" data-value="2" width="32" height="32"></i>
                <i data-lucide="star" class="star-input" data-value="3" width="32" height="32"></i>
                <i data-lucide="star" class="star-input" data-value="4" width="32" height="32"></i>
                <i data-lucide="star" class="star-input" data-value="5" width="32" height="32"></i>
            </div>

            <span class="modal-label">Ulasan Anda</span>
            <textarea id="reviewComment" class="textarea-review"
                placeholder="Bagikan pengalaman Anda tentang produk ini..."></textarea>

            <div class="modal-footer">
                <button class="btn-submit-review" id="submitReview">
                    Kirim Ulasan
                    <i data-lucide="send" width="18" height="18"></i>
                </button>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

        const product_id = '{{ $product->slug }}';
        const current_user_id = @json(auth()->id());
        let currentRating = 0;

        // Fetch Reviews on load
        let allReviews = [];
        let currentFilter = 0;
        let currentSort = 'latest';

        function fetchReviews() {
            fetch(`/api/reviews/${product_id}`)
                .then(res => res.json())
                .then(data => {
                    allReviews = data;
                    renderReviews();
                });
        }

        function renderReviews() {
            const grid = document.querySelector('.reviews-grid');
            const countSpan = document.getElementById('reviewCount');

            // Calculate average rating from allReviews (not filtered)
            const totalReviews = allReviews.length;
            const sumRating = allReviews.reduce((sum, r) => sum + r.rating, 0);
            const averageRating = totalReviews > 0 ? (sumRating / totalReviews) : 0;
            const roundedRating = Math.round(averageRating);

            // Update average rating stars in the top section
            const avgStarsContainer = document.getElementById('productAverageStars');
            const avgRatingTextSpan = document.getElementById('productAverageRatingValue');

            if (avgStarsContainer && avgRatingTextSpan) {
                let starsHTML = '';
                for (let i = 1; i <= 5; i++) {
                    starsHTML += `<i data-lucide="star" fill="${i <= roundedRating ? '#fbbf24' : 'none'}" width="16" height="16" style="color: ${i <= roundedRating ? '#fbbf24' : '#e2e8f0'}"></i>`;
                }
                avgStarsContainer.innerHTML = starsHTML;
                avgRatingTextSpan.textContent = `${averageRating > 0 ? averageRating.toFixed(1) : '0'}/5 (${totalReviews} Ulasan)`;
            }

            let filtered = currentFilter === 0
                ? [...allReviews]
                : allReviews.filter(r => r.rating === currentFilter);

            // Apply Sort
            filtered.sort((a, b) => {
                const dateA = new Date(a.created_at);
                const dateB = new Date(b.created_at);
                return currentSort === 'latest' ? dateB - dateA : dateA - dateB;
            });

            countSpan.textContent = `(${filtered.length})`;
            grid.innerHTML = '';

            if (filtered.length === 0) {
                grid.innerHTML = '<p style="grid-column: span 2; text-align: center; color: #94a3b8; padding: 40px;">Belum ada ulasan untuk rating ini.</p>';
                lucide.createIcons();
                return;
            }

            filtered.forEach(review => {
                const isOwnReview = current_user_id && review.user_id == current_user_id;
                const nameDisplay = isOwnReview ? `${review.user_name} ( Anda )` : review.user_name;

                const card = `
                                                    <div class="review-card">
                                                        <div class="review-card-header">
                                                            <div class="stars">
                                                                ${Array(5).fill(0).map((_, i) => `<i data-lucide="star" fill="${i < review.rating ? '#fbbf24' : 'none'}" width="14" height="14" style="color: ${i < review.rating ? '#fbbf24' : '#e2e8f0'}"></i>`).join('')}
                                                            </div>
                                                            ${isOwnReview ? `
                                                            <button class="btn-delete-review" data-id="${review.id}" style="background: none; border: none; color: #94a3b8; cursor: pointer; padding: 4px;">
                                                                <i data-lucide="trash-2" width="16" height="16"></i>
                                                            </button>
                                                            ` : ''}
                                                        </div>
                                                        <div class="reviewer-name" style="display: flex; align-items: center; gap: 6px;">
                                                            ${nameDisplay} 
                                                            <div style="background: #22c55e; width: 16px; height: 16px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                                <i data-lucide="check" style="color: white;" width="10" height="10" stroke-width="4"></i>
                                                            </div>
                                                        </div>
                                                        <p class="review-text">"${review.comment}"</p>
                                                        <div class="review-date">Ditulis pada ${new Date(review.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })}</div>
                                                    </div>
                                                `;
                grid.insertAdjacentHTML('beforeend', card);
            });
            lucide.createIcons();
        }

        fetchReviews();

        // Filter & Sort Logic
        const btnFilter = document.getElementById('btnFilter');
        const filterDropdown = document.getElementById('filterDropdown');
        const btnSort = document.getElementById('btnSort');
        const sortDropdown = document.getElementById('sortDropdown');

        function closeAllDropdowns() {
            filterDropdown.classList.remove('active');
            sortDropdown.classList.remove('active');
        }

        btnFilter.addEventListener('click', (e) => {
            e.stopPropagation();
            const wasActive = filterDropdown.classList.contains('active');
            closeAllDropdowns();
            if (!wasActive) filterDropdown.classList.add('active');
        });

        btnSort.addEventListener('click', (e) => {
            e.stopPropagation();
            const wasActive = sortDropdown.classList.contains('active');
            closeAllDropdowns();
            if (!wasActive) sortDropdown.classList.add('active');
        });

        document.querySelectorAll('.filter-option').forEach(option => {
            option.addEventListener('click', function () {
                document.querySelectorAll('.filter-option').forEach(opt => opt.classList.remove('active'));
                this.classList.add('active');
                currentFilter = parseInt(this.dataset.rating);
                renderReviews();
                closeAllDropdowns();
            });
        });

        document.querySelectorAll('.sort-option').forEach(option => {
            option.addEventListener('click', function () {
                document.querySelectorAll('.sort-option').forEach(opt => opt.classList.remove('active'));
                this.classList.add('active');
                currentSort = this.dataset.sort;
                btnSort.innerHTML = `${this.textContent} <i data-lucide="chevron-down" width="16" height="16"></i>`;
                lucide.createIcons();
                renderReviews();
                closeAllDropdowns();
            });
        });

        document.addEventListener('click', () => {
            closeAllDropdowns();
        });

        // Delete Review Logic
        document.addEventListener('click', (e) => {
            const deleteBtn = e.target.closest('.btn-delete-review');
            if (deleteBtn) {
                const id = deleteBtn.dataset.id;
                if (confirm('Apakah Anda yakin ingin menghapus ulasan ini?')) {
                    fetch(`/reviews/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            fetchReviews();
                        })
                        .catch(err => console.error(err));
                }
            }
        });

        // Modal Logic
        const openBtn = document.getElementById('openReviewModal');
        const closeBtn = document.getElementById('closeReviewModal');
        const modal = document.getElementById('reviewModal');

        openBtn.addEventListener('click', () => {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        });

        closeBtn.addEventListener('click', () => {
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        });

        // Star Rating Logic
        document.getElementById('starRating').addEventListener('click', (e) => {
            const star = e.target.closest('.star-input');
            if (!star) return;

            currentRating = star.getAttribute('data-value');
            const allStars = document.querySelectorAll('.star-input');
            allStars.forEach(s => {
                if (s.getAttribute('data-value') <= currentRating) {
                    s.classList.add('active');
                    s.setAttribute('fill', '#fbbf24');
                    s.style.color = '#fbbf24';
                } else {
                    s.classList.remove('active');
                    s.setAttribute('fill', 'none');
                    s.style.color = '#e2e8f0';
                }
            });
        });

        function showNotification() {
            const container = document.getElementById('notification-container');
            const toast = document.createElement('div');
            toast.className = 'toast';
            toast.innerHTML = `
                                                <div class="toast-icon">
                                                    <div style="background: #166534; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                                    </div>
                                                </div>
                                                <div class="toast-message">Ulasan mu berhasil terkirim !</div>
                                                <div class="toast-close"><i data-lucide="x" width="20" height="20"></i></div>
                                            `;
            container.appendChild(toast);
            lucide.createIcons();

            toast.querySelector('.toast-close').onclick = () => toast.remove();

            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(100%)';
                toast.style.transition = 'all 0.5s';
                setTimeout(() => toast.remove(), 500);
            }, 3000);
        }

        // Submit Review
        document.getElementById('submitReview').addEventListener('click', () => {
            const comment = document.getElementById('reviewComment').value;

            if (currentRating === 0 || !comment) {
                alert('Silakan pilih rating dan isi ulasan Anda.');
                return;
            }

            fetch('/reviews', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    rating: currentRating,
                    comment: comment,
                    product_id: product_id
                })
            })
                .then(res => res.json())
                .then(data => {
                    showNotification(); // Show the new toast
                    modal.classList.remove('active');
                    document.body.style.overflow = 'auto';
                    document.getElementById('reviewComment').value = '';
                    currentRating = 0;
                    document.querySelectorAll('.star-input').forEach(s => {
                        s.classList.remove('active');
                        s.setAttribute('fill', 'none');
                        s.style.color = '#e2e8f0';
                    });
                    fetchReviews();
                })
                .catch(err => {
                    console.error(err);
                    alert('Gagal mengirim ulasan.');
                });
        });
        function showFavNotification() {
            const container = document.getElementById('notification-container');
            const toast = document.createElement('div');
            toast.className = 'toast';
            toast.innerHTML = `
                                                <div class="toast-icon">
                                                    <div style="background: #166534; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                                    </div>
                                                </div>
                                                <div class="toast-message" style="display: flex; flex-direction: column; gap: 4px;">
                                                    <span style="font-weight: 700; color: #000; font-size: 15px;">Produk berhasil ditambahkan ke favorit</span>
                                                    <a href="/favorit" style="color: #166534; font-weight: 700; text-decoration: none; font-size: 14px;">Lihat Produk Favorit</a>
                                                </div>
                                                <div class="toast-close"><i data-lucide="x" width="20" height="20"></i></div>
                                            `;
            container.appendChild(toast);
            lucide.createIcons();

            toast.querySelector('.toast-close').onclick = () => toast.remove();

            setTimeout(() => {
                if (toast.parentElement) {
                    toast.style.opacity = '0';
                    toast.style.transform = 'translateX(100%)';
                    toast.style.transition = 'all 0.5s';
                    setTimeout(() => toast.remove(), 500);
                }
            }, 5000);
        }

        // Handle Initial Favorite State
        const mainFavBtn = document.querySelector('.btn-fav-circle');
        if (mainFavBtn) {
            const isFavorited = localStorage.getItem(`fav_product_${product_id}`);
            if (isFavorited === 'true') {
                mainFavBtn.classList.add('active');
                const icon = mainFavBtn.querySelector('svg') || mainFavBtn.querySelector('i');
                if (icon) icon.setAttribute('fill', 'currentColor');
            }
        }

        // Favorite Toggle Logic
        document.addEventListener('click', function (e) {
            const btn = e.target.closest('.btn-fav-circle');
            if (!btn) return;

            btn.classList.toggle('active');
            const icon = btn.querySelector('svg') || btn.querySelector('i');
            const isActive = btn.classList.contains('active');

            if (icon) {
                if (isActive) {
                    icon.setAttribute('fill', 'currentColor');
                    showFavNotification(); // Show notification when favorited
                    localStorage.setItem(`fav_product_${product_id}`, 'true');
                } else {
                    icon.setAttribute('fill', 'none');
                    localStorage.removeItem(`fav_product_${product_id}`);
                }
            }
        });
        // Help Modal Logic
        const helpModal = document.getElementById('helpModal');
        const helpBtn = document.querySelector('.btn-footer');
        const closeHelpBtn = document.getElementById('closeHelpModal');
        const complaintForm = document.getElementById('complaintForm');
        const helpFormState = document.getElementById('helpFormState');
        const helpSuccessState = document.getElementById('helpSuccessState');

        function openHelpModal() {
            helpModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeHelpModalAction() {
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

        if (helpBtn) {
            helpBtn.addEventListener('click', openHelpModal);
        }

        if (closeHelpBtn) {
            closeHelpBtn.addEventListener('click', closeHelpModalAction);
        }

        helpModal.addEventListener('click', (e) => {
            if (e.target === helpModal) closeHelpModalAction();
        });

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

@endsection