<?php
include 'includes/db.php';

echo "=== Adding Admin Role Support ===\n\n";

try {
    // Check if role column exists
    $result = $pdo->query("SHOW COLUMNS FROM users LIKE 'role'");
    if ($result->rowCount() == 0) {
        echo "Adding 'role' column to users table...\n";
        $pdo->exec("ALTER TABLE users ADD COLUMN role ENUM('user', 'admin', 'seller') DEFAULT 'user'");
        echo "✓ Column added\n\n";
    } else {
        echo "✓ Role column already exists\n\n";
    }
    
    // Set admin role for admin@bojongstore.local
    $stmt = $pdo->prepare("UPDATE users SET role = 'admin' WHERE email = 'admin@bojongstore.local'");
    $stmt->execute();
    echo "✓ Admin role assigned to admin@bojongstore.local\n\n";
    
    // Show current users and their roles
    echo "Current Users:\n";
    $result = $pdo->query("SELECT id, nama, email, role FROM users ORDER BY id");
    foreach ($result as $user) {
        echo "- {$user['id']} | {$user['nama']} | {$user['email']} | Role: {$user['role']}\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
