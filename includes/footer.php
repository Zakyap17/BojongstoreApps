<?php
// BojongStore - Footer Include
$current_dir = basename(dirname($_SERVER['PHP_SELF']));
$path_prefix = ($current_dir == 'pages') ? '../' : '';
$link_prefix = ($current_dir == 'pages') ? '' : 'pages/';
?>

<!-- ===== FOOTER ===== -->
<footer class="footer" id="footer">
  <div class="footer-container">
    <div class="footer-grid">

      <!-- Brand -->
      <div class="footer-brand">
        <div class="brand-name">
          <div class="brand-icon" style="width:24px;height:24px;display:flex;align-items:center;justify-content:center;">
            <img src="<?= $path_prefix ?>assets/images/logo_tree.png" alt="BojongStore Logo" style="width:22px;height:22px;object-fit:contain;">
          </div>
          BojongStore
        </div>
        <p class="brand-desc">
          BojongStore adalah platform digital yang dikembangkan mahasiswa untuk membantu UMKM di Bojongsoang mempromosikan produk mereka secara lebih luas.
        </p>
      </div>

      <!-- Kategori -->
      <div class="footer-col">
        <h4>Kategori</h4>
        <ul>
          <li><a href="<?= $link_prefix ?>produk.php?kategori=sayuran">Sayuran Segar</a></li>
          <li><a href="<?= $link_prefix ?>produk.php?kategori=buah">Buah Tropis</a></li>
          <li><a href="<?= $link_prefix ?>produk.php?kategori=makanan">Makanan Olahan</a></li>
          <li><a href="<?= $link_prefix ?>produk.php?kategori=minuman">Minuman</a></li>
        </ul>
      </div>

      <!-- Bantuan -->
      <div class="footer-col footer-bantuan">
        <h4>Bantuan</h4>
        <p>Jika ada pertanyaan atau kendala, silakan hubungi kami kapan saja. Kami siap membantu!</p>
        <a href="<?= $link_prefix ?>kontak.php" class="btn btn-primary" id="btnKontak" style="border-radius:8px;padding:9px 20px;font-size:13px;display:inline-flex;width:fit-content;">Kontak</a>
      </div>

    </div>

    <hr class="footer-divider">

    <div class="footer-bottom">
      <p>© 2024 BojongStore. dibuat oleh, dengan ❤️ untuk UMKM</p>
    </div>
  </div>
</footer>

<script src="<?= $path_prefix ?>assets/js/main.js"></script>
</body>
</html>
