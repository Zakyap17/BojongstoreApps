<?php
/**
 * Admin Navbar Component - Matching index.php style
 * Used across all admin pages
 */

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: /login.php');
    exit;
}

// Fetch admin user data
global $pdo;
$admin_user = null;
if ($pdo) {
    $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
    $stmt->execute([$_SESSION['user_id']]);
    $admin_user = $stmt->fetch();
}
?>
<nav class="navbar" id="navbar-admin">
    <a href="/admin/dashboard.php" class="navbar-brand">
        <div class="brand-icon">
            <img src="/assets/images/logo_tree.png" alt="BojongStore Logo">
        </div>
        BOJONGSTORE
    </a>

    <nav class="navbar-nav">
        <a href="/admin/dashboard.php" class="active">Dashboard</a>
        <a href="/admin/produk.php">Produk</a>
        <a href="/admin/umkm.php">UMKM</a>
        <a href="/admin/review.php">Review</a>
        <a href="/admin/konten.php">Konten</a>
    </nav>

    <div class="navbar-search">
        <span class="search-icon">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
            </svg>
        </span>
        <input type="text" id="searchInput" placeholder="Cari di admin..." autocomplete="off">
    </div>

    <div class="navbar-actions">
        <!-- Admin User Section -->
        <div class="navbar-user-section">
            <!-- Notifications -->
            <a href="#" class="navbar-icon-btn" title="Notifikasi">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                </svg>
            </a>

            <!-- Settings -->
            <a href="#" class="navbar-icon-btn" title="Pengaturan">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="3"/><path d="M12 1v6m0 6v6M4.22 4.22l4.24 4.24m6.08 0l4.24-4.24M1 12h6m6 0h6m-1.78 7.78l-4.24-4.24m-6.08 0l-4.24 4.24"/>
                </svg>
            </a>

            <!-- Profile Avatar Button with Dropdown -->
            <div class="navbar-profile-dropdown">
                <a href="/profile.php" class="navbar-avatar-btn" title="Profil Admin">
                    <?php 
                    $fotoPath = !empty($admin_user['foto']) ? htmlspecialchars($admin_user['foto']) : 'assets/images/default-avatar.svg';
                    $userExists = isset($admin_user) && !empty($admin_user['foto']);
                    ?>
                    <?php if ($userExists && !empty($admin_user['foto'])): ?>
                        <img src="<?= $fotoPath ?>" alt="<?= htmlspecialchars($_SESSION['user_name']) ?>" class="avatar-image">
                    <?php else: ?>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="8" r="4"/><path d="M6 21v-2a4 4 0 014-4h4a4 4 0 014 4v2"/>
                        </svg>
                    <?php endif; ?>
                </a>

                <!-- Dropdown Menu -->
                <div class="navbar-dropdown-menu">
                    <div class="dropdown-header">
                        <div class="dropdown-user-info">
                            <strong><?php echo htmlspecialchars($_SESSION['user_name']); ?></strong>
                            <small>Admin</small>
                        </div>
                    </div>
                    <hr class="dropdown-divider">
                    <a href="/profile.php" class="dropdown-link">Profil Saya</a>
                    <a href="/settings.php" class="dropdown-link">Pengaturan</a>
                    <hr class="dropdown-divider">
                    <a href="/logout.php" class="dropdown-link logout">Keluar</a>
                </div>
            </div>
        </div>
    </div>
</nav>

<style>
/* Admin Navbar - Matches index.php style */
#navbar-admin {
    position: sticky;
    top: 0;
    z-index: 100;
    background: var(--white);
    border-bottom: 1px solid var(--border);
    padding: 0 40px;
    height: 60px;
    display: flex;
    align-items: center;
    gap: 32px;
    box-shadow: 0 1px 4px rgba(0,0,0,0.06);
}

/* Admin navbar brand */
#navbar-admin .navbar-brand {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 800;
    font-size: 16px;
    letter-spacing: -0.3px;
    color: var(--text-dark);
    flex-shrink: 0;
    text-decoration: none;
}

#navbar-admin .brand-icon {
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
}

#navbar-admin .brand-icon img {
    width: 24px;
    height: 24px;
    object-fit: contain;
}

/* Admin navbar nav */
#navbar-admin .navbar-nav {
    display: flex;
    gap: 0;
    align-items: center;
}

#navbar-admin .navbar-nav a {
    padding: 12px 16px;
    font-size: 13px;
    font-weight: 500;
    color: var(--text-gray);
    transition: all 0.2s;
    position: relative;
}

#navbar-admin .navbar-nav a:hover {
    color: var(--green-primary);
}

#navbar-admin .navbar-nav a.active {
    color: var(--green-primary);
}

#navbar-admin .navbar-nav a.active::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: var(--green-primary);
    border-radius: 3px 3px 0 0;
}

/* Admin navbar search */
#navbar-admin .navbar-search {
    position: relative;
    flex: 1;
    max-width: 300px;
}

#navbar-admin .navbar-search .search-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-light);
}

#navbar-admin .navbar-search input {
    width: 100%;
    padding: 8px 12px 8px 36px;
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    font-size: 13px;
    background: var(--bg-light);
    transition: all 0.2s;
}

#navbar-admin .navbar-search input:focus {
    outline: none;
    border-color: var(--green-primary);
    background: var(--white);
    box-shadow: 0 0 0 3px rgba(58, 125, 68, 0.1);
}

/* Admin navbar actions */
#navbar-admin .navbar-actions {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-left: auto;
}

#navbar-admin .navbar-user-section {
    display: flex;
    align-items: center;
    gap: 12px;
}

#navbar-admin .navbar-icon-btn {
    width: 40px;
    height: 40px;
    border: none;
    background: transparent;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-gray);
    transition: all 0.2s;
    border-radius: var(--radius-sm);
}

#navbar-admin .navbar-icon-btn:hover {
    color: var(--green-primary);
    background: var(--bg-light);
}

/* Profile Dropdown */
#navbar-admin .navbar-profile-dropdown {
    position: relative;
}

#navbar-admin .navbar-avatar-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border: none;
    background: transparent;
    cursor: pointer;
    border-radius: var(--radius-sm);
    color: var(--text-gray);
    transition: all 0.2s;
}

#navbar-admin .navbar-avatar-btn:hover {
    background: var(--bg-light);
}

#navbar-admin .avatar-image {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    object-fit: cover;
}

#navbar-admin .navbar-dropdown-menu {
    position: absolute;
    top: 100%;
    right: 0;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    min-width: 200px;
    margin-top: 8px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-8px);
    transition: all 0.2s;
    z-index: 1000;
}

#navbar-admin .navbar-profile-dropdown:hover .navbar-dropdown-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

#navbar-admin .dropdown-header {
    padding: 12px 16px;
}

#navbar-admin .dropdown-user-info {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

#navbar-admin .dropdown-user-info strong {
    font-size: 13px;
    color: var(--text-dark);
}

#navbar-admin .dropdown-user-info small {
    font-size: 11px;
    color: var(--text-gray);
}

#navbar-admin .dropdown-divider {
    margin: 8px 0;
    border: none;
    border-top: 1px solid var(--border);
}

#navbar-admin .dropdown-link {
    display: block;
    padding: 10px 16px;
    font-size: 13px;
    color: var(--text-dark);
    text-decoration: none;
    transition: all 0.2s;
}

#navbar-admin .dropdown-link:hover {
    background: var(--bg-light);
    color: var(--green-primary);
}

#navbar-admin .dropdown-link.logout:hover {
    background: #ffebee;
    color: #d32f2f;
}

@media (max-width: 968px) {
    #navbar-admin {
        padding: 0 24px;
        gap: 20px;
    }

    #navbar-admin .navbar-nav {
        gap: 0;
    }

    #navbar-admin .navbar-nav a {
        padding: 12px 12px;
        font-size: 12px;
    }

    #navbar-admin .navbar-search {
        max-width: 200px;
    }
}

@media (max-width: 768px) {
    #navbar-admin {
        padding: 0 16px;
        gap: 16px;
        height: auto;
        flex-wrap: wrap;
    }

    #navbar-admin .navbar-nav {
        display: none;
    }

    #navbar-admin .navbar-search {
        max-width: 150px;
        order: 3;
        flex-basis: 100%;
        margin: 8px 0 0 0;
    }

    #navbar-admin .navbar-actions {
        order: 2;
    }
}
</style>
