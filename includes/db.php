<?php
// BojongStore - Database Connection
// Initialize session with security settings
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_httponly' => true,
        'cookie_secure' => false, // Set to true if using HTTPS
        'cookie_samesite' => 'Strict',
    ]);
}

// Include security helpers
require_once __DIR__ . '/security.php';

$host = 'localhost';
$db   = 'bojongstore';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

// Try multiple connection attempts
$pdo = null;
$lastError = null;

// Attempt 1: localhost
try {
    $dsn = "mysql:host=$host;port=3306;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    $lastError = $e;
    
    // Attempt 2: 127.0.0.1
    try {
        $dsn = "mysql:host=127.0.0.1;port=3306;dbname=$db;charset=$charset";
        $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e2) {
        $lastError = $e2;
        $pdo = null;
    }
}

if (!$pdo) {
    // Connection failed - show helpful error
    $error_message = $lastError ? htmlspecialchars($lastError->getMessage()) : 'Koneksi tidak berhasil';
    
    die('<div style="font-family:Arial,sans-serif;background:#fdecea;color:#c0392b;border:2px solid #f5c6cb;border-radius:8px;padding:20px 24px;margin:40px auto;max-width:600px;">
        <strong style="font-size:16px;">❌ Koneksi Database Gagal</strong><br><br>
        <code style="background:#fff;padding:10px;border:1px solid #f5c6cb;border-radius:4px;display:block;margin:10px 0;font-size:12px;overflow-x:auto;">' . $error_message . '</code><br><br>
        <strong>Solusi:</strong><br>
        1. Pastikan XAMPP MySQL sudah <strong>berjalan</strong><br>
        2. Buka XAMPP Control Panel dan klik "Start" untuk MySQL<br>
        3. Tunggu status MySQL berubah menjadi <strong>Running (green)</strong><br>
        4. Refresh halaman ini<br><br>
        <strong>Atau jalankan setup:</strong><br>
        Buka terminal dan ketik:<br>
        <code style="background:#fff;padding:10px;border:1px solid #f5c6cb;border-radius:4px;display:block;margin:10px 0;">php setup_database.php</code><br><br>
        <strong>Informasi Debug:</strong><br>
        Host: ' . $host . '<br>
        Database: ' . $db . '<br>
        Port: 3306<br>
    </div>');
}
?>
