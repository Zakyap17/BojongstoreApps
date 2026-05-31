<?php
// BojongStore - Halaman Beranda
include 'includes/db.php';
include 'includes/header.php';
?>

<!-- ===== HERO ===== -->
<section class="hero" id="hero">
  <div class="hero-container">

    <!-- Left: Copy -->
    <div class="hero-content">
      <h1>
        Dukung <span class="highlight-italic">UMKM</span><br>
        <span class="highlight-italic">Lokal</span> Tumbuh<br>
        Lebih Jauh
      </h1>
      <p>
        Temukan berbagai produk unggulan dan selalu usaha lokal,
        mulai dari makanan, hingga kebutuhan sehari-hari semua
        dalam satu platform digital!
      </p>
      <a href="pages/produk.php" class="btn btn-primary" id="btnMulaiBelanja" style="padding:12px 26px;font-size:14px;border-radius:10px;">
        Mulai Belanja
      </a>

      <!-- Stats -->
      <div class="hero-stats">
        <div class="stat-avatars">
          <div class="avatar" style="background:#ffccbc;color:#bf360c;">R</div>
          <div class="avatar" style="background:#c8e6c9;color:#1b5e20;">S</div>
          <div class="avatar" style="background:#bbdefb;color:#0d47a1;">D</div>
          <div class="avatar-plus">+20</div>
        </div>
        <div class="stat-info">
          <strong>20+ UMKM</strong>
          Telah Bergabung & Berkembang
        </div>
      </div>
    </div><!-- /.hero-content -->

    <!-- Right: Avatars Visual (triangular stagger layout) -->
    <div class="hero-visual">

      <!-- Avatar: Girl with black hair (top-left, largest) -->
      <div class="hero-char char-girl">
        <img src="assets/images/char2.png" alt="UMKM Seller">
      </div>

      <!-- Avatar: Mustache man (top-right) -->
      <div class="hero-char char-mustache">
        <img src="assets/images/char1.png" alt="UMKM Seller">
      </div>

      <!-- Avatar: Dark skin man (bottom-center) -->
      <div class="hero-char char-dark">
        <img src="assets/images/char_dark.png" alt="UMKM Seller">
      </div>

      <!-- Floating Badge -->
      <div class="hero-floating-badge" id="heroBadge">
        <div class="badge-icon">
          <img src="assets/images/logo_pot.png" alt="BojongStore" style="width:24px;height:24px;object-fit:contain;">
        </div>
        <div class="badge-text">
          <strong>Produk Terlaris</strong>
          Rendang Kemasan, baru saja terjual 42 menit lalu!
        </div>
      </div>

    </div><!-- /.hero-visual -->
  </div><!-- /.hero-container -->
</section><!-- /.hero -->


<!-- ===== KATEGORI PILIHAN ===== -->
<section class="section categories" id="kategori">
  <div class="section-container">
    <div class="section-header">
      <div>
        <h2 class="section-title">Kategori Pilihan</h2>
        <p class="section-sub">Temukan kebutuhan dari berbagai jenis pilihan</p>
      </div>
      <a href="pages/produk.php" class="see-all">
        Lihat Semua
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M5 12h14M12 5l7 7-7 7"/>
        </svg>
      </a>
    </div>

    <div class="category-grid">

      <!-- Sayuran -->
      <a href="pages/produk.php?kategori=sayuran" class="category-card" id="catSayuran">
        <div class="cat-icon green">🥬</div>
        <div class="cat-name">Sayuran</div>
        <div class="cat-count">Hijau & Organik</div>
      </a>

      <!-- Buah -->
      <a href="pages/produk.php?kategori=buah" class="category-card" id="catBuah">
        <div class="cat-icon orange">🍊</div>
        <div class="cat-name">Buah</div>
        <div class="cat-count">Lokal & Segar</div>
      </a>

      <!-- Makanan -->
      <a href="pages/produk.php?kategori=makanan" class="category-card" id="catMakanan">
        <div class="cat-icon brown">🍲</div>
        <div class="cat-name">Makanan</div>
        <div class="cat-count">Produk olahan</div>
      </a>

      <!-- Minuman -->
      <a href="pages/produk.php?kategori=minuman" class="category-card" id="catMinuman">
        <div class="cat-icon blue">🥤</div>
        <div class="cat-name">Minuman</div>
        <div class="cat-count">Antar</div>
      </a>

    </div>
  </div>
</section><!-- /.categories -->


<!-- ===== TESTIMONI ===== -->
<section class="section testimonials" id="testimonials">
  <div class="section-container">
    <div class="section-header">
      <h2 class="section-title">Cerita Sukses <span class="highlight-italic">Mitra Kami</span></h2>
      <p class="section-sub">Bukan sekedar Tumpukan tapi ini adalah cerita yang terjadi beneran!</p>
    </div>

    <div class="testi-grid">

      <!-- Testi 1 -->
      <div class="testi-card" id="testi1">
        <div class="testi-quote">"</div>
        <p class="testi-text">
          "Dulu jualan cuma di sekitar rumah. Sejak masuk BojongStore, produk saya sudah mulai ditemukan, dan banyak yang tanya-tanya order lewat WhatsApp. Sekarang pelanggan datang dari luar daerah!"
        </p>
        <div class="testi-author">
          <div class="author-avatar" style="background:#c8e6c9;color:#2e7d32;">IJ</div>
          <div>
            <div class="author-name">Ibu Ani</div>
            <div class="author-role">Penjual Sayuran Organik</div>
          </div>
        </div>
      </div>

      <!-- Testi 2 -->
      <div class="testi-card featured" id="testi2">
        <div class="testi-quote">"</div>
        <p class="testi-text">
          "Awalnya bingung promosi online. Lewat BojongStore, pembeli bisa lihat foto produk lengkap dan langsung checkout via Shopee. Jadi lebih praktis dan penjualan ikut meningkat."
        </p>
        <div class="testi-author">
          <div class="author-avatar" style="background:#ffe0b2;color:#e65100;">PR</div>
          <div>
            <div class="author-name">Pak Rudi</div>
            <div class="author-role">Pedagang Buah Lokal</div>
          </div>
        </div>
      </div>

      <!-- Testi 3 -->
      <div class="testi-card" id="testi3">
        <div class="testi-quote">"</div>
        <p class="testi-text">
          "Sebelumnya nanya daftar ke penjual langsung. Sekarang produk saya lebih dikenal di lingkungan sekitar. Selain masuk BojongStore, produk saya punya visibilitas digital dan banyak pembeli order lewat WhatsApp."
        </p>
        <div class="testi-author">
          <div class="author-avatar" style="background:#e3f2fd;color:#1565c0;">MD</div>
          <div>
            <div class="author-name">Mba Desy</div>
            <div class="author-role">Pemilik Usaha Minuman Sehat</div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section><!-- /.testimonials -->


<!-- ===== TENTANG KAMI ===== -->
<section class="about" id="tentang">
  <div class="about-container">

    <div class="about-label">MENGENAL KAMI</div>
    <h2 class="about-title">Tentang BojongStore</h2>

    <p class="about-text">
      BojongStore adalah platform digital yang dikembangkan mahasiswa untuk membantu UMKM di Bojongsoang mempromosikan produk mereka secara lebih luas. Website ini menyediakan katalog digital berisi informasi produk, lengkap dan harga, sehingga memudahkan pengguna dalam mencari dan memilih produk.
    </p>
    <p class="about-text">
      Selain itu, BojongStore memantau platform ini juga menyediakan eksport ke Shopee atau WhatsApp. Platform ini lebih bersifat media promosi, tetapi juga membantu UMKM dengan pasar yang lebih luas, guna meningkatkan visibility, penjualan, dan pertumbuhan ekonomi lokal.
    </p>

    <div class="about-features">
      <div class="feature-item" id="feat1">
        <div class="feat-icon green-bg">🏪</div>
        <div>
          <div class="feat-title">Membantu UMKM Lokal</div>
          <div class="feat-desc">Kami membangun ekosistem yang mendukung seluruh proses pertumbuhan dan penjualan UMKM</div>
        </div>
      </div>
      <div class="feature-item" id="feat2">
        <div class="feat-icon orange-bg">📱</div>
        <div>
          <div class="feat-title">Dig.Solusian Lokal</div>
          <div class="feat-desc">Platform digital yang menjembatani UMKM dan konsumen secara mudah dan efisien</div>
        </div>
      </div>
      <div class="feature-item" id="feat3">
        <div class="feat-icon yellow-bg">💡</div>
        <div>
          <div class="feat-title">Pertumbuhan Ekonomi</div>
          <div class="feat-desc">Bersama mendorong pertumbuhan ekonomi lokal demi kesejahteraan masyarakat setempat</div>
        </div>
      </div>
    </div>

    <div class="about-quote">
      "Kami hadir untuk memperluas jangkauan dan mempromosikan usaha yang ada, agar semakin banyak orang yang mengetahui dan membeli produk UMKM lokal."
    </div>

  </div>
</section><!-- /.about -->


<?php include 'includes/footer.php'; ?>


