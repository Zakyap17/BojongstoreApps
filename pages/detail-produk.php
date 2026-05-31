<?php
include '../includes/db.php';
include '../includes/header.php';

// Get product ID from URL
$product_id = $_GET['id'] ?? 1;

// Sample product data
$produk_data = [
  1 => [
    'id' => 1,
    'nama' => 'Rendang Daging Sapi Kemasan - 300g',
    'harga' => 95000,
    'kategori' => 'makanan',
    'toko' => 'Bu Santi',
    'image' => 'assets/images/Grocery Iteam 1.png',
    'rating' => 4.5,
    'deskripsi' => 'Rendang daging sapi khas Minangkabau dengan cita rasa autentik. Dibuat menggunakan bumbu tradisional pilihan yang memberikan kelezatan yang tak tertahankan. Sempurna untuk hidangan keluarga atau hadiah istimewa.',
    'detail' => 'Berat Bersih: 300 gram\nKomposisi: Daging sapi, kelapa, cabe, bawang merah, bawang putih, jahe, kunyit, garam, gula, dan minyak kelapa.\nUmur Simpan: 6 bulan\nPenyimpanan: Simpan di tempat sejuk dan kering. Setelah dibuka, habiskan dalam 3 hari.',
    'ukuran' => '300g',
    'stok' => 45
  ]
];

// Get current product or use sample
$produk = $produk_data[$product_id] ?? $produk_data[1];

// Sample comments
$comments = [
  [
    'nama' => 'Riky A',
    'rating' => 5,
    'tanggal' => 'Dibuat pada 16 April 2025',
    'komentar' => 'Rendang daging sapi ini sangat lezat dan authentic. Rasa bumbu yang kompleks terasa sempurna.',
    'user_id' => 1
  ],
  [
    'nama' => 'Ardi F',
    'rating' => 5,
    'tanggal' => 'Dibuat pada 10 April 2025',
    'komentar' => 'Produk berkualitas tinggi. Cocok banget buat pengambilan acara keluarga. Packaging rapi dan aman.',
    'user_id' => 2
  ],
  [
    'nama' => 'Fajar M',
    'rating' => 4,
    'tanggal' => 'Dibuat pada 5 April 2025',
    'komentar' => 'Rasa lumayan enak, meskipun sedikit agak pedas untuk ukuran sendiri.',
    'user_id' => 3
  ]
];

// Check if user is logged in
$is_logged_in = isset($_SESSION['user_id']);
$current_user_name = $_SESSION['user_name'] ?? '';
?>

<style>
/* Detail Page Styles */
.detail-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 40px;
}

.detail-breadcrumb {
  font-size: 12px;
  color: var(--text-gray);
  margin-bottom: 30px;
  display: flex;
  gap: 8px;
  align-items: center;
}

.detail-breadcrumb a {
  color: var(--text-gray);
  text-decoration: none;
}

.detail-breadcrumb a:hover {
  color: var(--text-dark);
}

.detail-main {
  display: grid;
  grid-template-columns: 380px 1fr;
  gap: 50px;
  margin-bottom: 60px;
  position: relative;
}

/* Product Image */
.detail-image {
  display: flex;
  align-items: center;
  justify-content: center;
  background: var(--bg-light);
  border-radius: 12px;
  height: 380px;
  position: relative;
  overflow: hidden;
}

.detail-image img {
  max-width: 90%;
  max-height: 90%;
  object-fit: contain;
}

.detail-image-badge {
  position: absolute;
  top: 16px;
  left: 16px;
  width: 48px;
  height: 48px;
  background: white;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
  color: var(--text-gray);
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  font-size: 20px;
}

/* Product Info */
.detail-info h1 {
  font-size: 24px;
  font-weight: 800;
  margin-bottom: 12px;
  color: var(--text-dark);
  line-height: 1.3;
}

.save-item-btn {
  position: absolute;
  top: -10px;
  left: 20px;
  background: none;
  border: none;
  cursor: pointer;
  padding: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 10;
}

.save-item-btn img {
  width: 48px;
  height: 48px;
}

.save-item-btn:hover {
  transform: scale(1.08);
  transition: transform 0.2s ease;
}

.detail-rating {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 16px;
  font-size: 14px;
}

.stars {
  color: #ffc107;
  font-size: 16px;
  letter-spacing: 2px;
}

.detail-price {
  font-size: 24px;
  font-weight: 800;
  color: var(--text-dark);
  margin-bottom: 20px;
}

.detail-divider {
  border-top: 1px solid var(--border);
  margin: 16px 0;
}

.detail-description {
  margin-bottom: 16px;
}

.detail-description-title {
  font-weight: 700;
  color: var(--text-dark);
  margin-bottom: 8px;
  font-size: 13px;
}

.detail-description-text {
  color: var(--text-gray);
  line-height: 1.5;
  font-size: 13px;
}

.detail-actions {
  display: flex;
  flex-direction: column;
  gap: 16px;
  margin-top: 24px;
  max-width: 360px;
}

.detail-actions button, .detail-actions a {
  padding: 16px 32px;
  border: none;
  border-radius: 24px;
  font-weight: 700;
  font-size: 16px;
  cursor: pointer;
  transition: all 0.3s;
  text-decoration: none;
  text-align: center;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 12px;
}

.btn-beli {
  background: #ff6b35;
  color: white;
}

.btn-beli:hover {
  background: #e55a28;
}

.btn-chat {
  background: var(--green-primary);
  color: white;
}

.btn-chat:hover {
  background: #2d5016;
}

/* Rating & Review Section */
.rating-section {
  margin-bottom: 40px;
}

.rating-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
  border-bottom: 2px solid var(--border);
  padding-bottom: 16px;
}

.rating-header h2 {
  font-size: 16px;
  font-weight: 800;
  color: var(--text-dark);
}

.rating-actions {
  display: flex;
  gap: 12px;
  align-items: center;
}

.rating-sort {
  padding: 8px 12px;
  border: 1px solid var(--border);
  border-radius: 6px;
  background: white;
  font-size: 13px;
  cursor: pointer;
  color: var(--text-gray);
}

.rating-sort:hover {
  background: var(--bg-light);
}

.rating-sort.btn-write {
  background: var(--text-dark);
  color: white;
  border: none;
  padding: 8px 16px;
}

.rating-sort.btn-write:hover {
  background: #1a1a1a;
}

.rating-count {
  font-size: 13px;
  color: var(--text-gray);
  font-weight: 600;
}

.rating-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 16px;
}

.rating-item {
  background: white;
  border-radius: 8px;
  padding: 16px;
}

.rating-item-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 12px;
}

.rating-item-left {
  display: flex;
  gap: 12px;
  flex: 1;
}

.rating-item-user {
  display: flex;
  flex-direction: column;
  gap: 4px;
}

.rating-item-name {
  font-weight: 700;
  color: var(--text-dark);
  font-size: 13px;
}

.rating-item-name-badge {
  font-size: 11px;
  color: var(--text-gray);
  margin-left: 4px;
}

.rating-item-date {
  font-size: 12px;
  color: var(--text-gray);
}

.rating-item-stars {
  color: #ffc107;
  font-size: 13px;
  letter-spacing: 1px;
}

.rating-item-menu {
  color: var(--text-gray);
  font-size: 18px;
  cursor: pointer;
}

.rating-item-text {
  color: var(--text-gray);
  font-size: 13px;
  line-height: 1.5;
  margin-bottom: 0;
}

/* Comment Form */
.comment-form-section {
  margin-bottom: 40px;
}

.comment-form-title {
  font-size: 16px;
  font-weight: 700;
  margin-bottom: 20px;
  color: var(--text-dark);
}

.comment-form-login-notice {
  background: white;
  border: 1px solid var(--border);
  border-radius: 8px;
  padding: 20px;
  text-align: center;
}

.comment-form-login-notice p {
  color: var(--text-gray);
  margin-bottom: 16px;
  font-size: 14px;
}

.comment-form-login-notice a {
  display: inline-block;
  padding: 10px 24px;
  background: var(--green-primary);
  color: white;
  border-radius: 6px;
  text-decoration: none;
  font-weight: 600;
  font-size: 14px;
  transition: all 0.3s;
}

.comment-form-login-notice a:hover {
  background: #2d5016;
}

.comment-form {
  background: white;
  border-radius: 8px;
  padding: 20px;
}

.form-group {
  margin-bottom: 16px;
}

.form-group label {
  display: block;
  font-weight: 600;
  margin-bottom: 8px;
  color: var(--text-dark);
  font-size: 14px;
}

.form-group input,
.form-group textarea,
.form-group select {
  width: 100%;
  padding: 10px 12px;
  border: 1px solid var(--border);
  border-radius: 6px;
  font-size: 14px;
  font-family: inherit;
  color: var(--text-dark);
}

.form-group textarea {
  resize: vertical;
  min-height: 100px;
}

.form-group input:focus,
.form-group textarea:focus,
.form-group select:focus {
  outline: none;
  border-color: var(--green-primary);
  box-shadow: 0 0 0 3px rgba(45, 80, 22, 0.1);
}

.star-rating {
  display: flex;
  gap: 8px;
  margin-bottom: 16px;
}

.star {
  font-size: 28px;
  cursor: pointer;
  transition: all 0.2s;
}

.star:hover {
  transform: scale(1.2);
}

.star.active {
  color: #ffc107;
}

.form-submit {
  background: var(--green-primary);
  color: white;
  padding: 12px 24px;
  border: none;
  border-radius: 6px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s;
  font-size: 14px;
}

.form-submit:hover {
  background: #2d5016;
}

@media (max-width: 1024px) {
  .detail-main {
    grid-template-columns: 1fr;
  }
  
  .rating-grid {
    grid-template-columns: 1fr;
  }
}

@media (max-width: 768px) {
  .detail-container {
    padding: 20px;
  }
  
  .detail-main {
    gap: 30px;
  }
  
  .detail-info h1 {
    font-size: 20px;
  }
}
</style>

<div class="detail-container">
  <!-- Breadcrumb -->
  <div class="detail-breadcrumb">
    <a href="index.php">Beranda</a>
    <span>></span>
    <a href="produk.php">Produk</a>
    <span>></span>
    <a href="produk.php?kategori=<?= htmlspecialchars($produk['kategori']) ?>"><?= ucfirst($produk['kategori']) ?></a>
    <span>></span>
    <span><?= htmlspecialchars($produk['nama']) ?></span>
  </div>

  <!-- Main Product Detail -->
  <div class="detail-main">
    <!-- Product Image -->
    <div class="detail-image">
      <button class="save-item-btn" title="Simpan Item">
        <img src="../assets/images/Container.png" alt="Simpan">
      </button>
      <div class="detail-image-badge">📌</div>
      <img src="<?= htmlspecialchars($produk['image']) ?>" alt="<?= htmlspecialchars($produk['nama']) ?>">
    </div>

    <!-- Product Info -->
    <div class="detail-info">
      <h1><?= htmlspecialchars($produk['nama']) ?></h1>
      
      <div class="detail-rating">
        <div class="stars">★★★★★</div>
        <span><?= $produk['rating'] ?>/5</span>
      </div>

      <div class="detail-price">Rp. <?= number_format($produk['harga'], 0, ',', '.') ?></div>

      <div class="detail-divider"></div>

      <div class="detail-description">
        <div class="detail-description-text"><?= nl2br(htmlspecialchars($produk['deskripsi'])) ?></div>
      </div>

      <div class="detail-description">
        <div class="detail-description-text"><?= nl2br(htmlspecialchars($produk['detail'])) ?></div>
      </div>

      <div class="detail-description">
        <div class="detail-description-title">Pilih Metode Pembelian</div>
      </div>

      <div class="detail-actions">
        <button class="btn-beli">
          <img src="../assets/images/Vector.png" alt="Shopee" style="width: 20px; height: 20px;">
          Beli Di Shopee
        </button>
        <a href="#" class="btn-chat">
          <img src="../assets/images/ic_baseline-whatsapp.png" alt="WhatsApp" style="width: 20px; height: 20px;">
          Chat Penjual
        </a>
      </div>
    </div>
  </div>

  <!-- Rating & Review Section -->
  <div class="rating-section">
    <div class="rating-header">
      <h2>Rating & Ulasan</h2>
      <div class="rating-actions">
        <span class="rating-count">Semua Ulasan (<?= count($comments) ?>)</span>
        <select class="rating-sort">
          <option>Terbaru</option>
          <option>Rating Tertinggi</option>
          <option>Rating Terendah</option>
        </select>
        <button class="rating-sort btn-write">Tulis Ulasan</button>
      </div>
    </div>

    <div class="rating-grid">
      <?php foreach ($comments as $comment): ?>
        <div class="rating-item">
          <div class="rating-item-header">
            <div class="rating-item-left">
              <div class="rating-item-user">
                <div class="rating-item-name">
                  <?= htmlspecialchars($comment['nama']) ?>
                  <span class="rating-item-name-badge">✓</span>
                </div>
                <div class="rating-item-date"><?= $comment['tanggal'] ?></div>
              </div>
            </div>
            <div class="rating-item-menu">···</div>
          </div>
          <div class="rating-item-stars"><?= str_repeat('★', $comment['rating']) ?><?= str_repeat('☆', 5 - $comment['rating']) ?></div>
          <div class="rating-item-text"><?= htmlspecialchars($comment['komentar']) ?></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Comment Form Section -->
  <div class="comment-form-section">
    <div class="comment-form-title">Berikan Ulasan Anda</div>
    
    <?php if (!$is_logged_in): ?>
      <div class="comment-form-login-notice">
        <p>Anda harus login terlebih dahulu untuk memberikan ulasan produk ini</p>
        <a href="login.php">Masuk Sekarang</a>
      </div>
    <?php else: ?>
      <form class="comment-form" method="POST" action="#">
        <div class="form-group">
          <label>Rating Produk</label>
          <div class="star-rating" id="starRating">
            <span class="star" data-value="1">★</span>
            <span class="star" data-value="2">★</span>
            <span class="star" data-value="3">★</span>
            <span class="star" data-value="4">★</span>
            <span class="star" data-value="5">★</span>
          </div>
          <input type="hidden" id="ratingValue" name="rating" value="0">
        </div>

        <div class="form-group">
          <label>Ulasan Anda</label>
          <textarea name="comment" placeholder="Bagikan pengalaman Anda dengan produk ini..." required></textarea>
        </div>

        <button type="submit" class="form-submit">Kirim Ulasan</button>
      </form>

      <script>
        const stars = document.querySelectorAll('#starRating .star');
        const ratingValue = document.getElementById('ratingValue');

        stars.forEach(star => {
          star.addEventListener('click', function() {
            const value = this.getAttribute('data-value');
            ratingValue.value = value;

            stars.forEach(s => s.classList.remove('active'));
            
            for (let i = 0; i < value; i++) {
              stars[i].classList.add('active');
            }
          });

          star.addEventListener('mouseover', function() {
            const value = this.getAttribute('data-value');
            stars.forEach(s => s.classList.remove('active'));
            
            for (let i = 0; i < value; i++) {
              stars[i].classList.add('active');
            }
          });
        });

        document.getElementById('starRating').addEventListener('mouseleave', function() {
          const currentValue = ratingValue.value;
          stars.forEach(s => s.classList.remove('active'));
          
          for (let i = 0; i < currentValue; i++) {
            stars[i].classList.add('active');
          }
        });
      </script>
    <?php endif; ?>
  </div>
</div>

<?php include '../includes/footer.php'; ?>


