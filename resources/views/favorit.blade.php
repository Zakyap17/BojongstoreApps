<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Favorit Saya - BojongStore</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo_tree.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo_tree.png') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
    <header>
        <div class="container">
            <div class="header-left">
                <div class="logo-wrapper">
                    <span class="logo-text">BOJONGSTORE</span>
                    <img src="{{ asset('images/logo.png') }}" width="36" height="36" alt="Logo" class="logo-img">
                </div>
                <nav class="nav-links">
                    <a href="/" class="nav-link">Beranda</a>
                    <a href="#" class="nav-link active">Produk</a>
                </nav>
            </div>
            <div class="search-bar">
                <form action="/search" method="GET" style="display:flex;align-items:center;width:100%">
                    <i data-lucide="search" class="search-icon" width="18" height="18"></i>
                    <input type="text" name="q" placeholder="Cari produk..." value="{{ request('q') }}">
                <input type="text" placeholder="Cari produk...">
                </form>
            </div>
            <div class="header-actions">
                <a href="/favorit" class="action-btn-bookmark active"><i data-lucide="bookmark" width="28" height="28"></i></a>
                <a href="#" class="action-btn-user"><i data-lucide="user" width="20" height="20"></i></a>
            </div>
        </div>
    </header>

    <main style="padding-top: 40px;">
        <div class="container">
            <div class="breadcrumb" style="margin-bottom: 30px; font-size: 14px; color: #64748b;">
                <a href="/" style="text-decoration: none; color: inherit;">Beranda</a> <span style="margin: 0 8px;">&rsaquo;</span>
                <a href="#" style="text-decoration: none; color: inherit;">Produk</a> <span style="margin: 0 8px;">&rsaquo;</span>
                <a href="#" style="text-decoration: none; color: inherit;">Produk Unggulan</a> <span style="margin: 0 8px;">&rsaquo;</span>
                <a href="/favorit" style="text-decoration: none; color: inherit;">Produk Favorit</a>
            </div>

            <div class="favorites-intro" style="margin-bottom: 40px;">
                <h1 style="font-size: 32px; font-weight: 800; margin-bottom: 8px;">Produk Favorit Saya</h1>
                <p style="color: #64748b; font-size: 16px;">Daftar produk yang telah Anda simpan untuk dilihat kembali</p>
            </div>

            <div class="favorites-controls" style="display: flex; justify-content: flex-end; align-items: center; gap: 16px; margin-bottom: 30px;">
                <button style="background: #f1f5f9; border: none; padding: 10px; border-radius: 8px; cursor: pointer;">
                    <i data-lucide="sliders-horizontal" width="20" height="20"></i>
                </button>
                <button style="background: #f1f5f9; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; gap: 8px; font-weight: 600;">
                    Terbaru <i data-lucide="chevron-down" width="16" height="16"></i>
                </button>
            </div>

            <div class="favorites-grid" id="favoritesGrid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 30px; margin-bottom: 80px;">
                <!-- Dynamically rendered via JS -->
            </div>
        </div>
    </main>

    <script>
        const allProducts = @json($products);

        function renderFavorites() {
            const grid = document.getElementById('favoritesGrid');
            const favoriteProducts = allProducts.filter(p => localStorage.getItem(`fav_product_${p.slug}`) === 'true');
            
            if (favoriteProducts.length === 0) {
                grid.innerHTML = `
                    <div style="grid-column: 1 / -1; text-align: center; padding: 60px 0;">
                        <div style="background: #f8fafc; width: 120px; height: 120px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px;">
                            <i data-lucide="bookmark-x" width="56" height="56" style="color: #94a3b8;"></i>
                        </div>
                        <h3 style="font-size: 24px; font-weight: 700; margin-bottom: 12px; color: #1e293b;">Belum Ada Produk Favorit</h3>
                        <p style="color: #64748b; margin-bottom: 32px; font-size: 16px;">Produk yang Anda tandai sebagai favorit akan muncul di halaman ini.</p>
                        <a href="/" style="display: inline-block; padding: 14px 36px; background: #0a4d2e; color: #fff; text-decoration: none; border-radius: 50px; font-weight: 700; transition: all 0.3s; box-shadow: 0 4px 6px -1px rgba(10, 77, 46, 0.2);">Jelajahi Produk</a>
                    </div>
                `;
            } else {
                grid.innerHTML = favoriteProducts.map(product => {
                    const averageRating = product.reviews_avg_rating ? parseFloat(product.reviews_avg_rating) : 0;
                    const reviewCount = product.reviews_count || 0;
                    const roundedRating = Math.round(averageRating);
                    const starsHTML = Array(5).fill(0).map((_, i) => `<i data-lucide="star" fill="${i < roundedRating ? '#fbbf24' : 'none'}" width="14" height="14" style="color: ${i < roundedRating ? '#fbbf24' : '#e2e8f0'}"></i>`).join('');

                    return `
                        <div class="product-card-fav" style="background: #fff; border: 1.5px solid #e2e8f0; border-radius: 12px; padding: 20px; position: relative; display: flex; flex-direction: column;">
                            <div class="product-image-container" style="position: relative; background: #f8fafc; border-radius: 8px; margin-bottom: 20px; padding: 20px; text-align: center;">
                                <img src="${product.image_url}" alt="${product.name}" style="width: 100%; height: 180px; object-fit: contain;">
                                <div class="btn-fav-circle active" style="cursor: pointer;" onclick="toggleFav('${product.slug}')">
                                    <i data-lucide="bookmark" fill="currentColor" width="28" height="28"></i>
                                </div>
                            </div>
                            <div class="product-info-fav" style="text-align: center; display: flex; flex-direction: column; flex: 1;">
                                <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 8px;">${product.name}</h3>
                                <p style="color: #64748b; font-size: 14px; margin-bottom: 8px;">${product.weight}</p>
                                <div class="product-rating-card" style="display: flex; align-items: center; justify-content: center; gap: 4px; margin-bottom: 12px;">
                                    <div class="stars" style="display: flex; gap: 2px; color: #fbbf24;">
                                        ${starsHTML}
                                    </div>
                                    <span style="font-size: 12px; color: #71717a;">(${reviewCount})</span>
                                </div>
                                <div class="price" style="font-size: 20px; font-weight: 800; margin-bottom: 20px; margin-top: auto;">Rp ${new Intl.NumberFormat('id-ID').format(product.price)}</div>
                                <a href="/produk/${product.slug}" style="display: block; width: 100%; padding: 12px; background: #0a4d2e; color: #fff; text-decoration: none; border-radius: 8px; font-weight: 700; transition: background 0.3s;">Lihat Detail</a>
                            </div>
                        </div>
                    `;
                }).join('');

            }
            lucide.createIcons();
        }

        function toggleFav(slug) {
            localStorage.removeItem(`fav_product_${slug}`);
            renderFavorites();
        }

        document.addEventListener('DOMContentLoaded', renderFavorites);
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
                <p>Terima kasih atas laporan Anda. Tim kami akan segera menindaklanjuti keluhan Anda melalui kontak yang tersedia.</p>
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
</body>
</html>
