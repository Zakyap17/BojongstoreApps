<?php
include 'includes/db.php';

if ($pdo) {
    try {
        echo "=== Registered Users in Database ===\n\n";
        
        $stmt = $pdo->query('SELECT id, nama, email FROM users LIMIT 20');
        $users = $stmt->fetchAll();
        
        if (empty($users)) {
            echo "❌ No users found in database.\n\n";
            echo "To create an admin account:\n";
            echo "1. Go to: http://localhost:8000/register.php\n";
            echo "2. Fill in the registration form\n";
            echo "3. Use that account to login\n";
        } else {
            foreach ($users as $user) {
                echo "ID: {$user['id']}\n";
                echo "Name: {$user['nama']}\n";
                echo "Email: {$user['email']}\n";
                echo "---\n";
            }
            echo "\n✅ Users found above.\n";
            echo "Password: Use the password you set during registration\n";
        }
        
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo 'Database not connected';
}
?>
