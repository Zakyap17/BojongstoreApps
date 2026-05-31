@extends('layouts.landing')

@push('styles')
<style>
    /* Premium UI Styles for Favorites */
    .favorites-header {
        position: relative;
        margin-bottom: 40px;
        padding-bottom: 20px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .favorites-title {
        font-size: 36px;
        font-weight: 800;
        background: linear-gradient(135deg, #0a4d2e 0%, #16a34a 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 12px;
        letter-spacing: -0.5px;
    }
    
    .favorites-subtitle {
        color: #64748b;
        font-size: 16px;
        line-height: 1.6;
    }

    .product-card-fav {
        background: #ffffff;
        border: 1px solid rgba(226, 232, 240, 0.8);
        border-radius: 16px;
        padding: 20px;
        position: relative;
        display: flex;
        flex-direction: column;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
    }

    .product-card-fav:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px -15px rgba(22, 163, 74, 0.15);
        border-color: rgba(22, 163, 74, 0.3);
    }
    
    .product-card-fav::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; height: 4px;
        background: linear-gradient(90deg, #16a34a, #22c55e);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .product-card-fav:hover::before {
        opacity: 1;
    }

    .product-image-container-fav {
        position: relative;
        background: linear-gradient(to bottom right, #f8fafc, #f1f5f9);
        border-radius: 12px;
        margin-bottom: 20px;
        padding: 30px;
        text-align: center;
        transition: transform 0.4s ease;
    }
    
    .product-card-fav:hover .product-image-container-fav {
        transform: scale(1.02);
    }

    .product-image-container-fav img {
        width: 100%;
        height: 180px;
        object-fit: contain;
        filter: drop-shadow(0 10px 15px rgba(0,0,0,0.05));
        transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .product-card-fav:hover .product-image-container-fav img {
        transform: scale(1.08) rotate(-2deg);
    }

    .btn-remove-fav {
        position: absolute;
        top: 12px;
        right: 12px;
        width: 36px;
        height: 36px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(4px);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ef4444;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: all 0.2s ease;
        z-index: 10;
        border: 1px solid rgba(255,255,255,0.5);
    }
    
    .btn-remove-fav:hover {
        background: #fef2f2;
        transform: scale(1.1) rotate(5deg);
    }

    .product-info-fav h3 {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 6px;
        color: #1e293b;
        line-height: 1.3;
    }

    .price-fav {
        font-size: 22px;
        font-weight: 800;
        color: #0f172a;
        margin: auto 0 20px 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
    }
    
    .price-currency {
        font-size: 14px;
        color: #64748b;
        font-weight: 600;
    }

    .btn-detail-fav {
        display: block;
        width: 100%;
        padding: 14px;
        background: #f8fafc;
        color: #0f172a;
        text-decoration: none;
        border-radius: 10px;
        font-weight: 700;
        font-size: 15px;
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
    }
    
    .product-card-fav:hover .btn-detail-fav {
        background: #0a4d2e;
        color: #fff;
        border-color: #0a4d2e;
        box-shadow: 0 4px 12px rgba(10, 77, 46, 0.2);
    }

    /* Empty State */
    .empty-state-fav {
        background: linear-gradient(145deg, #ffffff, #f8fafc);
        border: 1px dashed #cbd5e1;
        border-radius: 24px;
        padding: 80px 20px;
        text-align: center;
        box-shadow: 0 10px 30px -10px rgba(0,0,0,0.02);
    }
    
    .empty-icon-wrap {
        width: 100px;
        height: 100px;
        background: #f1f5f9;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);
        color: #94a3b8;
    }
    
    /* Animation */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .fav-item-animate {
        animation: fadeInUp 0.5s ease backwards;
    }
</style>
@endpush

@section('content')
    <main style="padding-top: 40px;">
        <div class="container">
            <div class="breadcrumb" style="margin-bottom: 30px; font-size: 14px; color: #64748b;">
                <a href="/" style="text-decoration: none; color: inherit;">Beranda</a> <span
                    style="margin: 0 8px;">&rsaquo;</span>
                <a href="/produk" style="text-decoration: none; color: inherit;">Produk</a> <span
                    style="margin: 0 8px;">&rsaquo;</span>
                <a href="/favorit" style="text-decoration: none; color: inherit;">Produk Favorit</a>
            </div>

            <div class="favorites-header">
                <h1 class="favorites-title">Produk Favorit Saya</h1>
                <p class="favorites-subtitle">Koleksi produk pilihan yang telah Anda simpan. Pantau dan akses dengan cepat di sini.</p>
            </div>

            <div class="favorites-grid" id="favoritesGrid"
                style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 30px; margin-bottom: 80px;">

                @auth
                    @forelse($products as $product)
                        @php
                            $imageUrl = $product->image_url;
                            $avgRating = $product->reviews_avg_rating ? round($product->reviews_avg_rating) : 0;
                        @endphp
                        <div class="product-card-fav fav-item-animate" id="fav-card-{{ $product->id }}" style="animation-delay: {{ $loop->index * 0.1 }}s;">
                            <div class="product-image-container-fav">
                                <img src="{{ $imageUrl }}" alt="{{ $product->name }}">
                                <button class="btn-remove-fav" title="Hapus dari Favorit"
                                    onclick="toggleFav({{ $product->id }}, this)"
                                    data-product-id="{{ $product->id }}">
                                    <i data-lucide="bookmark-minus" width="20" height="20"></i>
                                </button>
                            </div>
                            <div class="product-info-fav" style="text-align: center; display: flex; flex-direction: column; flex: 1;">
                                <h3>{{ $product->name }}</h3>
                                <p style="color: #64748b; font-size: 14px; margin-bottom: 12px;">{{ $product->weight }}</p>
                                <div style="display: flex; align-items: center; justify-content: center; gap: 4px; margin-bottom: 16px; background: #f8fafc; padding: 6px 12px; border-radius: 20px; width: fit-content; margin-left: auto; margin-right: auto;">
                                    <div style="display: flex; gap: 2px; color: #fbbf24;">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i data-lucide="star" fill="{{ $i <= $avgRating ? '#fbbf24' : 'none' }}" width="14" height="14" style="color: {{ $i <= $avgRating ? '#fbbf24' : '#e2e8f0' }}"></i>
                                        @endfor
                                    </div>
                                    <span style="font-size: 12px; color: #64748b; font-weight: 600; margin-left: 4px;">({{ $product->reviews_count ?? 0 }})</span>
                                </div>
                                <div class="price-fav">
                                    <span class="price-currency">Rp</span>
                                    {{ number_format($product->price, 0, ',', '.') }}
                                </div>
                                <a href="{{ route('product-detail', $product->slug) }}" class="btn-detail-fav">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    @empty
                        <div style="grid-column: 1 / -1;" id="emptyState">
                            <div class="empty-state-fav">
                                <div class="empty-icon-wrap">
                                    <i data-lucide="heart-crack" width="48" height="48"></i>
                                </div>
                                <h3 style="font-size: 24px; font-weight: 800; margin-bottom: 12px; color: #0f172a;">Belum Ada Produk Favorit</h3>
                                <p style="color: #64748b; margin-bottom: 32px; font-size: 16px; max-width: 400px; margin-left: auto; margin-right: auto;">Anda belum menandai produk apapun sebagai favorit. Mulai jelajahi produk kami dan temukan yang Anda suka!</p>
                                <a href="{{ route('produk') }}" style="display: inline-flex; align-items: center; gap: 8px; padding: 14px 36px; background: #0a4d2e; color: #fff; text-decoration: none; border-radius: 50px; font-weight: 700; transition: all 0.3s; box-shadow: 0 8px 20px -6px rgba(10, 77, 46, 0.4);">
                                    <i data-lucide="shopping-bag" width="18" height="18"></i>
                                    Jelajahi Produk
                                </a>
                            </div>
                        </div>
                    @endforelse
                @else
                    {{-- Not logged in --}}
                    <div style="grid-column: 1 / -1;">
                        <div class="empty-state-fav">
                            <div class="empty-icon-wrap">
                                <i data-lucide="log-in" width="48" height="48"></i>
                            </div>
                            <h3 style="font-size: 24px; font-weight: 800; margin-bottom: 12px; color: #0f172a;">Silakan Login Terlebih Dahulu</h3>
                            <p style="color: #64748b; margin-bottom: 32px; font-size: 16px; max-width: 400px; margin-left: auto; margin-right: auto;">Login untuk menyimpan dan melihat produk favorit Anda secara permanen di semua perangkat.</p>
                            <a href="{{ route('login') }}" style="display: inline-flex; align-items: center; gap: 8px; padding: 14px 36px; background: #0a4d2e; color: #fff; text-decoration: none; border-radius: 50px; font-weight: 700; transition: all 0.3s; box-shadow: 0 8px 20px -6px rgba(10, 77, 46, 0.4);">
                                <i data-lucide="log-in" width="18" height="18"></i>
                                Masuk ke Akun
                            </a>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </main>

    <script>
        const csrfToken = '{{ csrf_token() }}';
        const isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};

        async function toggleFav(productId, btn) {
            if (!isLoggedIn) {
                window.location.href = '{{ route('login') }}';
                return;
            }
            btn.disabled = true;

            try {
                const res = await fetch(`/api/favorites/${productId}`, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
                });
                const data = await res.json();

                if (data.status === 'removed') {
                    // Animate card out then remove from DOM
                    const card = document.getElementById(`fav-card-${productId}`);
                    if (card) {
                        card.style.transition = 'all 0.4s ease';
                        card.style.opacity = '0';
                        card.style.transform = 'scale(0.85)';
                        setTimeout(() => {
                            card.remove();
                            // Show empty state if no cards left
                            const grid = document.getElementById('favoritesGrid');
                            if (grid && grid.querySelectorAll('.product-card-fav').length === 0) {
                                grid.innerHTML = `
                                    <div style="grid-column: 1 / -1;">
                                        <div class="empty-state-fav">
                                            <div class="empty-icon-wrap">
                                                <i data-lucide="heart-crack" width="48" height="48"></i>
                                            </div>
                                            <h3 style="font-size: 24px; font-weight: 800; margin-bottom: 12px; color: #0f172a;">Belum Ada Produk Favorit</h3>
                                            <p style="color: #64748b; margin-bottom: 32px; font-size: 16px; max-width: 400px; margin-left: auto; margin-right: auto;">Tambahkan produk ke favorit dari halaman katalog.</p>
                                            <a href="/produk" style="display: inline-flex; align-items: center; gap: 8px; padding: 14px 36px; background: #0a4d2e; color: #fff; text-decoration: none; border-radius: 50px; font-weight: 700;">
                                                Jelajahi Produk
                                            </a>
                                        </div>
                                    </div>`;
                                lucide.createIcons();
                            }
                        }, 400);
                    }
                }
            } catch (e) {
                console.error('Toggle favorite failed:', e);
                btn.disabled = false;
            }
        }

        document.addEventListener('DOMContentLoaded', () => lucide.createIcons());
    </script>

    <footer style="background: #f0f4f1; padding: 80px 0 40px; border-top: 1px solid #e2e8f0;">
        <div class="container">
            <div style="display: grid; grid-template-columns: 2fr 1fr 1.5fr; gap: 80px; margin-bottom: 60px;">
                <div>
                    <div class="logo-wrapper" style="margin-bottom: 20px;">
                        <span class="logo-text footer-logo-text" style="font-size: 20px;">BojongStore</span>
                    </div>
                       
                    <p style="color: #64748b; line-height: 1.6; max-width: 400px;">Mendukung keberlanjutan ekonomi lokal Indonesia melalui digitalisasi UMKM dengan cara yang elegan dan efisien.</p>
                </div>
                <div>

                                        <h4 class="footer-title" style="font-size: 18px; font-weight: 700; margin-bottom: 24px;">Kategori</h4>
                    <ul style="list-style: none; padding: 0; display: flex; flex-direction: column; gap: 12px;">
                        <li><a href="#" style="color: #64748b; text-decoration: none;">Sayuran Segar</a></li>
                        <li><a href="#" style="color: #64748b; text-decoration: none;">Buah Tropis</a></li>
                        <li><a href="#" style="color: #64748b; text-decoration: none;">Makanan Siap Saji</a></li>
                        <li><a href="#" style="color: #64748b; text-decoration: none;">Minuman</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="footer-title" style="font-size: 18px; font-weight: 700; margin-bottom: 24px;">Bantuan</h4>
                    <p style="color: #64748b; margin-bottom: 20px; line-height: 1.6;">Jika Anda mengalami kendala, silahkan hubungi kami dengan mudah melalui tombol di bawah.</p>
                    <button class="btn-footer" style="background: #0a4d2e; color: #fff; border: none; padding: 12px 28px; border-radius: 50px; font-weight: 700; cursor: pointer;">Bantuan</button>
                </div>
            </div>
            <div style="text-align: center; padding-top: 40px; border-top: 1px solid #e2e8f0; color: #94a3b8; font-size: 14px;">
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

                                                   <input type="text" id="helpContact" class="help-input" placeholder="Contoh: 0812xxxx atau email@mail.com" required>
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
         
                                          <textarea id="helpMessage" class="help-textarea" placeholder="Ceritakan kendala yang Anda alami..." required></textarea>
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
                   
                <p>Terima kasih atas laporan Anda. Tim kami akan segera m
                   enindaklanjuti keluhan Anda melalui kontak yang tersedia.</p>
                <button class="btn-help-submit" style="margin-top: 32px;" onclick="closeHelpModalAction()">Tutup</button>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

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
                if (submitBtn) {
                    submitBtn.innerHTML = '<span>Kirim Keluhan</span><i data-lucide="send" width="18" height="18"></i>';
                    submitBtn.disabled = false;
                }
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
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
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
