<?php
include '../includes/db.php';
include '../includes/header.php';
$kategori = $_GET['kategori'] ?? '';
$query    = $_GET['q'] ?? '';

// Dummy produk data
$produk = [
  ['id'=>1,'nama'=>'Kangkung Organik','harga'=>5000,'kategori'=>'sayuran','image'=>'../assets/images/Grocery Iteam 1.png','toko'=>'Bu Ani'],
  ['id'=>2,'nama'=>'Bayam Hijau Segar','harga'=>4000,'kategori'=>'sayuran','image'=>'../assets/images/Grocery Iteam 1.png','toko'=>'Pak Sari'],
  ['id'=>3,'nama'=>'Jeruk Mandarin','harga'=>15000,'kategori'=>'buah','image'=>'../assets/images/Grocery Iteam 1.png','toko'=>'Pak Rudi'],
  ['id'=>4,'nama'=>'Pisang Kepok','harga'=>8000,'kategori'=>'buah','image'=>'../assets/images/Grocery Iteam 1.png','toko'=>'Bu Lastri'],
  ['id'=>5,'nama'=>'Tempe Goreng','harga'=>7000,'kategori'=>'makanan','image'=>'../assets/images/Grocery Iteam 1.png','toko'=>'Bu Santi'],
  ['id'=>6,'nama'=>'Keripik Singkong','harga'=>10000,'kategori'=>'makanan','image'=>'../assets/images/Grocery Iteam 1.png','toko'=>'Mba Rina'],
  ['id'=>7,'nama'=>'Jus Alpukat','harga'=>12000,'kategori'=>'minuman','image'=>'../assets/images/Grocery Iteam 1.png','toko'=>'Mba Desy'],
  ['id'=>8,'nama'=>'Es Teh Manis','harga'=>5000,'kategori'=>'minuman','image'=>'../assets/images/Grocery Iteam 1.png','toko'=>'Pak Budi'],
  ['id'=>9,'nama'=>'Brokoli Segar','harga'=>6000,'kategori'=>'sayuran','image'=>'../assets/images/Grocery Iteam 1.png','toko'=>'Pak Sari'],
  ['id'=>10,'nama'=>'Tomat Merah','harga'=>5500,'kategori'=>'sayuran','image'=>'../assets/images/Grocery Iteam 1.png','toko'=>'Bu Ani'],
  ['id'=>11,'nama'=>'Apel Fuji','harga'=>18000,'kategori'=>'buah','image'=>'../assets/images/Grocery Iteam 1.png','toko'=>'Pak Rudi'],
  ['id'=>12,'nama'=>'Mangga Harum','harga'=>12000,'kategori'=>'buah','image'=>'../assets/images/Grocery Iteam 1.png','toko'=>'Mba Rina'],
];

// Filter
$filtered = array_filter($produk, function($p) use ($kategori, $query) {
  $matchKat = $kategori ? $p['kategori'] === $kategori : true;
  $matchQ   = $query    ? stripos($p['nama'], $query) !== false : true;
  return $matchKat && $matchQ;
});
?>

<style>
/* Hero Banner */
.produk-hero {
  background: linear-gradient(135deg, #2d5016 0%, #3d6b1f 100%);
  color: white;
  padding: 50px 40px;
  margin-bottom: 50px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 40px;
}

.produk-hero-content h1 {
  font-size: 28px;
  font-weight: 800;
  margin-bottom: 12px;
  line-height: 1.3;
}

.produk-hero-content p {
  font-size: 14px;
  margin-bottom: 20px;
  opacity: 0.95;
}

.produk-hero-content .btn {
  display: inline-block;
  padding: 10px 24px;
  background: white;
  color: var(--green-primary);
  border-radius: 6px;
  font-weight: 600;
  cursor: pointer;
  text-decoration: none;
  transition: all 0.3s;
}

.produk-hero-content .btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

.produk-hero-image {
  flex: 1;
  text-align: center;
}

.produk-hero-image img {
  max-width: 100%;
  height: auto;
  max-height: 250px;
}

/* Main Content */
.produk-page {
  padding: 0 40px;
  max-width: 1200px;
  margin: 0 auto;
}

/* Category Pills */
.kategori-section h2 {
  font-size: 18px;
  font-weight: 800;
  margin-bottom: 24px;
}

.kategori-pills {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 16px;
  margin-bottom: 50px;
}

.kategori-pill {
  border: 1.5px solid var(--border);
  border-radius: 12px;
  padding: 24px 16px;
  text-align: center;
  cursor: pointer;
  transition: all 0.3s;
  background: white;
  text-decoration: none;
  color: inherit;
}

.kategori-pill:hover {
  border-color: var(--green-primary);
  box-shadow: 0 4px 12px rgba(45, 80, 22, 0.1);
}

.kategori-pill-icon {
  font-size: 36px;
  margin-bottom: 12px;
}

.kategori-pill-name {
  font-weight: 600;
  font-size: 14px;
  color: var(--text-dark);
}

/* Produk Section */
.produk-section h2 {
  font-size: 18px;
  font-weight: 800;
  margin-bottom: 24px;
}

.produk-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 20px;
  margin-bottom: 50px;
}

.produk-card {
  border: 1px solid var(--border);
  border-radius: 12px;
  overflow: hidden;
  transition: all 0.3s;
  background: white;
  text-decoration: none;
  color: inherit;
}

.produk-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 16px rgba(0,0,0,0.1);
}

.produk-card .prod-thumb {
  height: 160px;
  background: var(--bg-light);
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
}

.produk-card .prod-thumb img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.produk-card .prod-info {
  padding: 16px;
}

.produk-card .prod-name {
  font-weight: 700;
  font-size: 14px;
  margin-bottom: 4px;
  color: var(--text-dark);
}

.produk-card .prod-toko {
  font-size: 12px;
  color: var(--text-gray);
  margin-bottom: 10px;
}

.produk-card .prod-price {
  font-size: 15px;
  font-weight: 800;
  color: var(--green-primary);
  margin-bottom: 12px;
}

.produk-card .prod-btn {
  display: block;
  text-align: center;
  padding: 8px 12px;
  background: var(--green-primary);
  color: white;
  border-radius: 6px;
  font-weight: 600;
  font-size: 12px;
  cursor: pointer;
  transition: all 0.2s;
  text-decoration: none;
}

.produk-card .prod-btn:hover {
  background: #2d5016;
}

.no-result {
  text-align: center;
  padding: 60px 20px;
  color: var(--text-gray);
}

.no-result .icon {
  font-size: 48px;
  margin-bottom: 12px;
}

@media (max-width: 1024px) {
  .produk-grid,
  .kategori-pills {
    grid-template-columns: repeat(3, 1fr);
  }
  
  .produk-hero {
    flex-direction: column;
    text-align: center;
  }
}

@media (max-width: 768px) {
  .produk-grid,
  .kategori-pills {
    grid-template-columns: repeat(2, 1fr);
  }
}
</style>

<!-- Hero Banner -->
<div class="produk-hero">
  <div class="produk-hero-content">
    <h1>PRODUK TERBARU, LANGSUNG DARI JANTUNG DESA</h1>
    <p>Belanja produk segar berkualitas tinggi langsung dari petani dan pengrajin lokal. Dukung UMKM sambil menikmati kesegaran terjamin!</p>
    <a href="#semua-produk" class="btn">LIHAT SEMUA PRODUK</a>
  </div>
  <div class="produk-hero-image">
    <img src="../assets/images/Grocery Iteam 1.png" alt="Produk Segar">
  </div>
</div>

<div class="produk-page">
  <!-- Kategori Pills -->
  <div class="kategori-section">
    <h2>Kategori Pilihan</h2>
    <div class="kategori-pills">
      <a href="produk.php" class="kategori-pill">
        <div class="kategori-pill-icon">🥬</div>
        <div class="kategori-pill-name">Sayuran</div>
      </a>
      <a href="produk.php?kategori=buah" class="kategori-pill">
        <div class="kategori-pill-icon">🍊</div>
        <div class="kategori-pill-name">Buah</div>
      </a>
      <a href="produk.php?kategori=makanan" class="kategori-pill">
        <div class="kategori-pill-icon">🍲</div>
        <div class="kategori-pill-name">Makanan</div>
      </a>
      <a href="produk.php?kategori=minuman" class="kategori-pill">
        <div class="kategori-pill-icon">🥤</div>
        <div class="kategori-pill-name">Minuman</div>
      </a>
    </div>
  </div>

  <!-- Semua Produk -->
  <div class="produk-section" id="semua-produk">
    <h2>SEMUA PRODUK</h2>
    
    <?php if (empty($filtered)): ?>
      <div class="no-result">
        <div class="icon">🔍</div>
        <p>Produk tidak ditemukan. Coba kategori atau kata kunci lain.</p>
      </div>
    <?php else: ?>
      <div class="produk-grid">
        <?php foreach ($filtered as $p): ?>
          <div class="produk-card">
            <div class="prod-thumb">
              <img src="<?= htmlspecialchars($p['image']) ?>" alt="<?= htmlspecialchars($p['nama']) ?>">
            </div>
            <div class="prod-info">
              <div class="prod-name"><?= htmlspecialchars($p['nama']) ?></div>
              <div class="prod-toko">by <?= htmlspecialchars($p['toko']) ?></div>
              <div class="prod-price">Rp <?= number_format($p['harga'],0,',','.') ?>/kg</div>
              <a href="detail-produk.php?id=<?= $p['id'] ?>" class="prod-btn">Lihat Produk</a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<?php include '../includes/footer.php'; ?>


