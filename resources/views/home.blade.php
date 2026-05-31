@extends('layouts.landing')

@section('content')
  <!-- ===== HERO ===== -->
  <section class="hero" id="hero">
    <div class="hero-container">

      <!-- Left: Copy -->
      <div class="hero-content">
        <h1>
          Dukung <span class="highlight-italic">UMKM</span><br>
          <span class="highlight-italic">Lokal </span> Tumbuh<br>
          Lebih Jauh
        </h1>
        <p>
          Temukan berbagai produk unggulan dari usaha lokal,
          mulai dari makanan, hingga kebutuhan sehari-hari semua
          dalam satu platform digital!
        </p>
        <a href="{{ route('katalog') }}" class="btn btn-primary" id="btnMulaiBelanja"
          style="padding:12px 26px;font-size:14px;border-radius:10px;">
          Mulai Belanja
        </a>

        <!-- Stats -->
        <div class="hero-stats">
          <div class="stat-avatars">
            <div class="avatar" style="background:#ffccbc;color:#bf360c;">J</div>
            <div class="avatar" style="background:#c8e6c9;color:#1b5e20;">T</div>
            <div class="avatar" style="background:#bbdefb;color:#0d47a1;">P</div>
            <div class="avatar-plus">+20</div>
          </div>
          <div class="stat-info">
            <strong>20+ UMKM</strong>
            Telah Bergabung &amp; Berkembang
          </div>
        </div>
      </div><!-- /.hero-content -->

      <!-- Right: Avatars Visual -->
      <div class="hero-visual">
        <div class="hero-char char-girl">
          <img src="{{ asset('images/char2.png') }}" alt="UMKM Seller">
        </div>
        <div class="hero-char char-mustache">
          <img src="{{ asset('images/char1.png') }}" alt="UMKM Seller">
        </div>
        <div class="hero-char char-dark">
          <img src="{{ asset('images/char_dark.png') }}" alt="UMKM Seller">
        </div>

        <!-- Floating Badge -->
        @if($mostViewedProduct)
          <div class="hero-floating-badge" id="heroBadge">
            <div class="badge-icon">
              <img src="{{ asset('images/logo_pot.png') }}" alt="BojongStore">
            </div>
            <div class="badge-text">
              <strong>Produk Terpopuler</strong>
              {{ $mostViewedProduct->name }}, telah dilihat sebanyak {{ $mostViewedProduct->views }} kali
            </div>
          </div>
        @endif
      </div><!-- /.hero-visual -->
    </div><!-- /.hero-container -->
  </section>

  <!-- ===== TESTIMONI ===== -->
  <section class="section testimonials" id="testimonials">
    <div class="section-container">
      <div class="section-header">
        <h2 class="section-title">Cerita Sukses <span class="highlight-italic">Mitra Kami</span></h2>
        <p class="section-sub">Bukan sekedar Tumpukan tapi ini adalah cerita yang terjadi beneran!</p>
      </div>

      <div class="testi-grid">
        <!-- Card 1 -->
        <div class="testi-card blue-card">
          <p class="testi-text">
            "Dulu jualan cuma di sekitar rumah. Setelah masuk BojongStore, produk saya lebih mudah ditemukan, dan banyak
            yang langsung order lewat WhatsApp. Sekarang pesanan datang dari luar daerah."
          </p>
          <div class="testi-author">
            <div class="author-avatar">
              <img src="{{ asset('images/ibu_ani_avatar.png') }}" alt="Ibu Ani">
            </div>
            <div>
              <div class="author-name">Ibu Ani</div>
              <div class="author-role">Pemilik Cimol Bojot</div>
            </div>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="testi-card yellow-card">
          <p class="testi-text">
            "Awalnya bingung promosi online. Lewat BojongStore, pembeli bisa lihat produk lalu langsung checkout via
            Shopee. Jadi lebih praktis dan penjualan ikut meningkat."
          </p>
          <div class="testi-author">
            <div class="author-avatar">
              <img src="{{ asset('images/pak_budi_avatar.png') }}" alt="Pak Budi">
            </div>
            <div>
              <div class="author-name">Pak Budi</div>
              <div class="author-role">Penjual Rendang Kemasan</div>
            </div>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="testi-card gray-card">
          <p class="testi-text">
            "Sebelumnya hanya dijual ke lingkungan sekitar. Setelah masuk BojongStore, produk saya punya etalase digital
            dan banyak pembeli order lewat WhatsApp."
          </p>
          <div class="testi-author">
            <div class="author-avatar">
              <img src="{{ asset('images/mas_danu_avatar.png') }}" alt="Mas Danu">
            </div>
            <div>
              <div class="author-name">Mas Danu</div>
              <div class="author-role">Penjual Basreng Kemasan</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== ABOUT ===== -->
  <section class="section about" id="about">
    <div class="about-card-container">
      <span class="about-subtitle">MENGENAL KAMI</span>
      <h2 class="about-title">Tentang BojongStore</h2>

      <p class="about-desc">
        BojongStore adalah platform digital yang dikembangkan mahasiswa untuk membantu UMKM di Bojongsoang mempromosikan
        produk mereka secara lebih luas. Website ini menyediakan katalog digital berisi informasi produk lengkap dan
        tampilan menarik, sehingga memudahkan pengguna dalam mencari dan memilih produk.
      </p>

      <p class="about-desc">
        Selain itu, BojongStore menawarkan kemudahan transaksi melalui WhatsApp atau marketplace seperti Shopee. Platform
        ini tidak hanya menjadi media promosi, tetapi juga menjembatani UMKM dengan pasar yang lebih luas, guna
        meningkatkan visibilitas, penjualan, dan pertumbuhan ekonomi lokal.
      </p>

      <div class="about-badges">
        <!-- Badge 1 -->
        <div class="about-badge-item">
          <div class="badge-icon-wrap bg-green">
            <i data-lucide="handshake" width="20" height="20"></i>
          </div>
          <span class="badge-label">Mendukung UMKM Lokal</span>
        </div>

        <!-- Badge 2 -->
        <div class="about-badge-item">
          <div class="badge-icon-wrap bg-blue">
            <i data-lucide="monitor-smartphone" width="20" height="20"></i>
          </div>
          <span class="badge-label">Digitalisasi Usaha</span>
        </div>

        <!-- Badge 3 -->
        <div class="about-badge-item">
          <div class="badge-icon-wrap bg-yellow">
            <i data-lucide="trending-up" width="20" height="20"></i>
          </div>
          <span class="badge-label">Pertumbuhan Ekonomi</span>
        </div>
      </div>

      <div class="about-divider"></div>

      <p class="about-footer-text">
        "Dikembangkan oleh tim mahasiswa Telkom University sebagai bagian dari proyek pengembangan perangkat lunak."
      </p>
    </div>
  </section>
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
            <input type="text" id="helpContact" class="help-input" placeholder="Contoh: 0812xxxx atau email@mail.com"
              required>
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