<?php
include 'includes/db.php';

echo "=== Creating Missing Tables for Admin Dashboard ===\n\n";

try {
    // Create products table if not exists
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS products (
            id INT PRIMARY KEY AUTO_INCREMENT,
            seller_id INT NOT NULL,
            nama VARCHAR(255) NOT NULL,
            deskripsi TEXT,
            harga INT NOT NULL,
            gambar VARCHAR(255),
            kategori VARCHAR(100),
            rating DECIMAL(2,1) DEFAULT 0,
            stok INT DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (seller_id) REFERENCES users(id)
        )
    ");
    echo "✓ Products table created\n";

    // Create reviews table if not exists
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS reviews (
            id INT PRIMARY KEY AUTO_INCREMENT,
            product_id INT NOT NULL,
            user_id INT NOT NULL,
            rating INT NOT NULL,
            komentar TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (product_id) REFERENCES products(id),
            FOREIGN KEY (user_id) REFERENCES users(id)
        )
    ");
    echo "✓ Reviews table created\n";

    // Create activities table if not exists
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS activities (
            id INT PRIMARY KEY AUTO_INCREMENT,
            admin_id INT NOT NULL,
            tipe VARCHAR(100),
            deskripsi TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (admin_id) REFERENCES users(id)
        )
    ");
    echo "✓ Activities table created\n";

    // Check current data
    echo "\n=== Current Database Statistics ===\n";
    $products = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn() ?? 0;
    $reviews = $pdo->query("SELECT COUNT(*) FROM reviews")->fetchColumn() ?? 0;
    $users = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn() ?? 0;
    
    echo "Total Users: $users\n";
    echo "Total Products: $products\n";
    echo "Total Reviews: $reviews\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
