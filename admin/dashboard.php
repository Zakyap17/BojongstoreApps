<?php
include '../includes/db.php';

// Check if admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: /login.php');
    exit;
}

// Get dashboard statistics
try {
    $total_products = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn() ?? 0;
    $total_reviews = $pdo->query("SELECT COUNT(*) FROM reviews")->fetchColumn() ?? 0;
    $total_umkm = $pdo->query("SELECT COUNT(DISTINCT seller_id) FROM products")->fetchColumn() ?? 0;
    
    // Get recent activities
    $activities = $pdo->query("
        SELECT * FROM activities 
        ORDER BY created_at DESC 
        LIMIT 6
    ")->fetchAll(PDO::FETCH_ASSOC) ?? [];
} catch (Exception $e) {
    $total_products = 0;
    $total_reviews = 0;
    $total_umkm = 0;
    $activities = [];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - BojongStore</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
        /* Admin Layout */
        .admin-layout {
            display: grid;
            grid-template-columns: 260px 1fr;
            min-height: 100vh;
            background: var(--bg-light);
        }

        .admin-sidebar {
            background: var(--white);
            border-right: 1px solid var(--border);
            padding: 24px 16px;
            overflow-y: auto;
            position: sticky;
            top: 0;
            height: 100vh;
        }

        .admin-sidebar-menu {
            list-style: none;
        }

        .menu-item {
            margin-bottom: 8px;
        }

        .menu-item a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: var(--text-gray);
            font-size: 14px;
            font-weight: 500;
            border-radius: var(--radius-sm);
            transition: all 0.2s;
        }

        .menu-item a:hover {
            background: var(--bg-light);
            color: var(--green-primary);
        }

        .menu-item a.active {
            background: var(--green-bg);
            color: var(--green-primary);
        }

        .menu-item a .icon {
            font-size: 18px;
            flex-shrink: 0;
        }

        .menu-label {
            padding: 12px 16px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--text-light);
            margin-top: 16px;
            margin-bottom: 8px;
        }

        .admin-content {
            display: flex;
            flex-direction: column;
        }

        .admin-main {
            padding: 32px;
            flex: 1;
        }

        /* Dashboard Header */
        .dashboard-header {
            margin-bottom: 32px;
        }

        .dashboard-header h1 {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .dashboard-header p {
            font-size: 14px;
            color: var(--text-gray);
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 24px;
            display: flex;
            align-items: center;
            gap: 16px;
            transition: all 0.3s;
        }

        .stat-card:hover {
            border-color: var(--green-primary);
            box-shadow: var(--shadow);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            flex-shrink: 0;
        }

        .stat-icon.green {
            background: var(--green-bg);
        }

        .stat-icon.blue {
            background: #dbeafe;
        }

        .stat-icon.yellow {
            background: #fef3c7;
        }

        .stat-content h3 {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--text-light);
            margin-bottom: 4px;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .stat-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            margin-left: 8px;
        }

        .stat-badge.positive {
            background: var(--green-badge);
            color: #2e7d32;
        }

        /* Content Grid */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        .dashboard-section {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 24px;
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .section-header h2 {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .section-header a {
            font-size: 13px;
            color: var(--green-primary);
            font-weight: 600;
            transition: all 0.2s;
        }

        .section-header a:hover {
            color: var(--text-dark);
        }

        /* Activity List */
        .activity-list {
            list-style: none;
        }

        .activity-item {
            display: flex;
            gap: 12px;
            padding: 16px 0;
            border-bottom: 1px solid var(--border);
            font-size: 13px;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
            background: var(--bg-light);
        }

        .activity-content h4 {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 4px;
        }

        .activity-content p {
            color: var(--text-gray);
            font-size: 12px;
        }

        /* Featured Section */
        .featured-image {
            width: 100%;
            height: 200px;
            border-radius: var(--radius);
            object-fit: cover;
            margin-top: 16px;
        }

        .featured-text {
            font-size: 18px;
            font-weight: 700;
            color: var(--white);
            position: absolute;
            bottom: 20px;
            left: 20px;
        }

        .featured-container {
            position: relative;
            background: linear-gradient(135deg, rgba(0,0,0,0.4) 0%, rgba(0,0,0,0.6) 100%);
            border-radius: var(--radius);
            overflow: hidden;
            aspect-ratio: 16/9;
            display: flex;
            align-items: flex-end;
        }

        .featured-container img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .featured-info {
            width: 100%;
            padding: 20px;
            color: white;
            font-size: 12px;
        }

        @media (max-width: 1200px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .admin-layout {
                grid-template-columns: 1fr;
            }

            .admin-sidebar {
                display: none;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .admin-main {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="admin-layout">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <ul class="admin-sidebar-menu">
                <li class="menu-item">
                    <a href="/admin/dashboard.php" class="active">
                        <span class="icon">📊</span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/admin/produk.php">
                        <span class="icon">📦</span>
                        <span>Produk</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/admin/umkm.php">
                        <span class="icon">🏪</span>
                        <span>UMKM</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/admin/review.php">
                        <span class="icon">⭐</span>
                        <span>Review</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/admin/konten.php">
                        <span class="icon">📝</span>
                        <span>Konten</span>
                    </a>
                </li>

                <div class="menu-label">Bantuan</div>
                <li class="menu-item">
                    <a href="/admin/support.php">
                        <span class="icon">💬</span>
                        <span>Bantuan Support</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/admin/keluar.php">
                        <span class="icon">🚪</span>
                        <span>Keluar</span>
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <div class="admin-content">
            <?php include 'navbar.php'; ?>

            <main class="admin-main">
                <!-- Dashboard Header -->
                <div class="dashboard-header">
                    <h1>Dashboard Admin</h1>
                    <p>Ringkasan pertumbuhan dan Aktifitas BojongStore !</p>
                </div>

                <!-- Stats Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon green">🎋</div>
                        <div class="stat-content">
                            <h3>Total Produk</h3>
                            <div class="stat-value"><?php echo number_format($total_products); ?></div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon blue">🏪</div>
                        <div class="stat-content">
                            <h3>UMKM BojongStore</h3>
                            <div class="stat-value"><?php echo number_format($total_umkm); ?></div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon yellow">⭐</div>
                        <div class="stat-content">
                            <h3>Total Review</h3>
                            <div class="stat-value"><?php echo number_format($total_reviews); ?></div>
                        </div>
                    </div>
                </div>

                <!-- Main Grid -->
                <div class="dashboard-grid">
                    <!-- Aktivitas Terbaru -->
                    <div class="dashboard-section">
                        <div class="section-header">
                            <h2>Aktivitas Terbaru</h2>
                            <a href="#semua">Lihat Semua</a>
                        </div>
                        <ul class="activity-list">
                            <li class="activity-item">
                                <div class="activity-icon">🏪</div>
                                <div class="activity-content">
                                    <h4>Admin menambahkan produk baru</h4>
                                    <p>Tadi pagi • Kategori Premium</p>
                                </div>
                            </li>
                            <li class="activity-item">
                                <div class="activity-icon">✅</div>
                                <div class="activity-content">
                                    <h4>Admin memperbarui UMKM Kemenkan Tari Mekar Waringi</h4>
                                    <p>25 menit yang lalu • Lokasi UMKM</p>
                                </div>
                            </li>
                            <li class="activity-item">
                                <div class="activity-icon">📢</div>
                                <div class="activity-content">
                                    <h4>Admin mengubah banner Promo Merdeka Sale 2024</h4>
                                    <p>2 jam yang lalu • Konten</p>
                                </div>
                            </li>
                            <li class="activity-item">
                                <div class="activity-icon">📝</div>
                                <div class="activity-content">
                                    <h4>Admin membuat panduan Digitalisasi Pasar Atsari Bojongsoang</h4>
                                    <p>Hari ini 10:45 • Konten</p>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Lihat Semua (Right Column) -->
                    <div class="dashboard-section">
                        <div class="section-header">
                            <h2>Lihat Semua</h2>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; margin-bottom: 24px;">
                            <a href="/admin/produk.php" class="action-btn" style="padding: 16px; text-align: center; border: 1px solid var(--border); border-radius: var(--radius-sm); transition: all 0.2s;">
                                <div style="font-size: 24px; margin-bottom: 8px;">📦</div>
                                <div style="font-size: 13px; font-weight: 600;">Tambah Produk</div>
                            </a>
                            <a href="/admin/umkm.php" class="action-btn" style="padding: 16px; text-align: center; border: 1px solid var(--border); border-radius: var(--radius-sm); transition: all 0.2s;">
                                <div style="font-size: 24px; margin-bottom: 8px;">🏪</div>
                                <div style="font-size: 13px; font-weight: 600;">Kelola UMKM</div>
                            </a>
                            <a href="/admin/konten.php" class="action-btn" style="padding: 16px; text-align: center; border: 1px solid var(--border); border-radius: var(--radius-sm); transition: all 0.2s;">
                                <div style="font-size: 24px; margin-bottom: 8px;">📝</div>
                                <div style="font-size: 13px; font-weight: 600;">Kelola Konten</div>
                            </a>
                            <a href="/admin/review.php" class="action-btn" style="padding: 16px; text-align: center; border: 1px solid var(--border); border-radius: var(--radius-sm); transition: all 0.2s;">
                                <div style="font-size: 24px; margin-bottom: 8px;">⭐</div>
                                <div style="font-size: 13px; font-weight: 600;">Review</div>
                            </a>
                        </div>

                        <!-- Featured Section -->
                        <div class="featured-container">
                            <img src="/assets/images/pasar-bojongsoang.jpg" alt="Pasar Kreaf Bojongsoang">
                            <div class="featured-info">
                                <div style="font-size: 16px; font-weight: 700; margin-bottom: 4px;">Pasar Kreaf Bojongsoang</div>
                                <div style="font-size: 12px; opacity: 0.9;">Lokasi premium di Kecil Puji</div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Hover effect for action buttons
        document.querySelectorAll('.action-btn').forEach(btn => {
            btn.addEventListener('mouseenter', function() {
                this.style.background = 'var(--bg-light)';
                this.style.borderColor = 'var(--green-primary)';
                this.style.color = 'var(--green-primary)';
            });
            btn.addEventListener('mouseleave', function() {
                this.style.background = 'transparent';
                this.style.borderColor = 'var(--border)';
                this.style.color = 'inherit';
            });
        });
    </script>
</body>
</html>
