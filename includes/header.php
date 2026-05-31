<?php
// BojongStore - Header Include
// Determine path prefix based on directory
$current_dir = basename(dirname($_SERVER['PHP_SELF']));
$path_prefix = ($current_dir == 'pages') ? '../' : '';
$link_prefix = ($current_dir == 'pages') ? '' : 'pages/';

// Fetch user data if logged in
$user = null;
if (isset($_SESSION['user_id']) && function_exists('get_defined_vars')) {
    global $pdo;
    if ($pdo) {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$_SESSION['user_id']]);
        $user = $stmt->fetch();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) : 'BojongStore - Dukung UMKM Lokal Tumbuh Lebih Jauh' ?></title>
  <meta name="description" content="<?= isset($pageDescription) ? htmlspecialchars($pageDescription) : 'BojongStore adalah platform digital yang dikembangkan mahasiswa untuk membantu UMKM di Bojongsoang. Temukan berbagai produk unggulan dari sekitar anda.' ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= $path_prefix ?>assets/css/style.css">
  <script src="https://unpkg.com/lucide@latest"></script>
  <?php if (!empty($extraStyles)): ?>
  <style><?= $extraStyles ?></style>
  <?php endif; ?>
</head>
<body>

<!-- ===== HEADER ===== -->
<header>
    <div class="container">
        <div class="header-left">
            <a href="<?= $path_prefix ?>index.php" class="logo-wrapper">
                <span class="logo-text">BOJONGSTORE</span>
                <img src="<?= $path_prefix ?>assets/images/logo_tree.png" width="36" height="36" alt="Logo" class="logo-img">
            </a>
            <nav class="nav-links">
                <a href="<?= $path_prefix ?>index.php" class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : '' ?>">Beranda</a>
                <a href="<?= $link_prefix ?>produk.php" class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'produk.php') ? 'active' : '' ?>">Produk</a>
            </nav>
        </div>
        
        <div class="search-bar">
            <span class="search-icon">
              <i data-lucide="search" width="18" height="18"></i>
            </span>
            <input type="text" id="searchInput" placeholder="Cari produk...">
        </div>

        <div class="header-actions">
            <?php if (isset($_SESSION['user_id'])): ?>
                <!-- Bookmark -->
                <a href="<?= $path_prefix ?>favorit.php" class="action-btn-bookmark" title="Favorit">
                    <i data-lucide="bookmark" width="22" height="22" style="fill:var(--green-primary);stroke:var(--green-primary);"></i>
                </a>

                <!-- User dropdown -->
                <div class="user-dropdown-wrap" id="userDropdownWrap">
                    <button class="action-btn-user" id="userDropdownBtn" title="Akun Saya" type="button">
                        <?php if (!empty($user['foto'])): ?>
                            <img src="<?= $path_prefix ?><?= htmlspecialchars($user['foto']) ?>" alt="Avatar" class="user-avatar-img">
                        <?php else: ?>
                            <i data-lucide="user" width="18" height="18"></i>
                        <?php endif; ?>
                    </button>
                    <div class="user-dropdown-menu" id="userDropdownMenu">
                        <a href="<?= $link_prefix ?>profile.php" class="user-dropdown-item">
                            <i data-lucide="user" width="15" height="15"></i>
                            Profil Saya
                        </a>
                        <div class="user-dropdown-divider"></div>
                        <a href="<?= $link_prefix ?>logout.php" class="user-dropdown-item user-dropdown-item--danger">
                            <i data-lucide="log-out" width="15" height="15"></i>
                            Logout
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <!-- User belum login -->
                <div class="auth-btns">
                    <a href="<?= $link_prefix ?>login.php" class="header-btn header-btn-login">Masuk</a>
                    <a href="<?= $link_prefix ?>register.php" class="header-btn header-btn-signup">Daftar</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</header>

<script>
    lucide.createIcons();

    // ── User Dropdown Toggle ──
    const dropWrap  = document.getElementById('userDropdownWrap');
    const dropBtn   = document.getElementById('userDropdownBtn');
    const dropMenu  = document.getElementById('userDropdownMenu');

    if (dropBtn && dropMenu) {
        dropBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            dropWrap.classList.toggle('open');
        });
        document.addEventListener('click', () => {
            dropWrap.classList.remove('open');
        });
        dropMenu.addEventListener('click', (e) => e.stopPropagation());
    }
</script>

