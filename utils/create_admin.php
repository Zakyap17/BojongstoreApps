<?php
include 'includes/db.php';

if ($pdo) {
    try {
        // Create admin account with password: Admin123!
        $email = 'admin@bojongstore.local';
        $password = 'Admin123!';
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        
        // Check if admin exists
        $check = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $check->execute([$email]);
        
        if ($check->fetch()) {
            echo "❌ Admin account already exists\n\n";
            echo "Email: {$email}\n";
            echo "Password: Admin123!\n";
        } else {
            // Insert new admin
            $stmt = $pdo->prepare('INSERT INTO users (nama, email, telepon, password) VALUES (?, ?, ?, ?)');
            $stmt->execute(['Admin BojongStore', $email, '081234567890', $hashed]);
            
            echo "✅ Admin account created successfully!\n\n";
            echo "=== Login Credentials ===\n";
            echo "Email: {$email}\n";
            echo "Password: {$password}\n\n";
            echo "Now you can login at: http://localhost:8000/login.php\n";
        }
        
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo 'Database not connected';
}
?>
