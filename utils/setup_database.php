<?php
/**
 * Database Setup Script
 * This script creates the bojongstore database and tables
 */

// Database credentials
$host = 'localhost';
$user = 'root';
$pass = '';

// First, connect without specifying a database to create one
try {
    $pdo = new PDO("mysql:host=$host;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    
    echo "✅ Connected to MySQL server\n";
    
    // Create database
    $pdo->exec("CREATE DATABASE IF NOT EXISTS bojongstore CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "✅ Database 'bojongstore' created/verified\n";
    
    // Now connect to the new database
    $pdo = new PDO("mysql:host=$host;dbname=bojongstore;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    
    echo "✅ Connected to 'bojongstore' database\n";
    
    // Create users table
    $sql = "
    CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nama VARCHAR(100) NOT NULL,
        email VARCHAR(150) NOT NULL UNIQUE,
        telepon VARCHAR(20) DEFAULT NULL,
        negara VARCHAR(100) DEFAULT 'Indonesia',
        password VARCHAR(255) NOT NULL,
        foto VARCHAR(255) DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ";
    
    $pdo->exec($sql);
    echo "✅ Table 'users' created/verified\n";
    
    // Add some sample users for testing (if table is empty)
    $count = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
    
    if ($count == 0) {
        echo "\n📝 Adding sample test users...\n";
        
        // Sample user 1
        $stmt = $pdo->prepare("INSERT INTO users (nama, email, telepon, negara, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            'Admin Test',
            'admin@bojongstore.test',
            '081234567890',
            'Indonesia',
            password_hash('admin123', PASSWORD_DEFAULT)
        ]);
        echo "✅ Added test user: admin@bojongstore.test (password: admin123)\n";
        
        // Sample user 2
        $stmt->execute([
            'User Test',
            'user@bojongstore.test',
            '082345678901',
            'Indonesia',
            password_hash('user123', PASSWORD_DEFAULT)
        ]);
        echo "✅ Added test user: user@bojongstore.test (password: user123)\n";
        
        // Sample user 3
        $stmt->execute([
            'Seller Test',
            'seller@bojongstore.test',
            '083456789012',
            'Indonesia',
            password_hash('seller123', PASSWORD_DEFAULT)
        ]);
        echo "✅ Added test user: seller@bojongstore.test (password: seller123)\n";
    } else {
        echo "\n📊 Database already has $count user(s)\n";
    }
    
    echo "\n✅ Database setup completed successfully!\n";
    echo "\n📖 Next steps:\n";
    echo "1. Visit http://localhost/BojongStore/login.php to login\n";
    echo "2. Or register a new account at http://localhost/BojongStore/register.php\n";
    echo "\n🔐 Test Credentials:\n";
    echo "   Email: admin@bojongstore.test\n";
    echo "   Password: admin123\n";
    
} catch (PDOException $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
    exit(1);
}
?>
