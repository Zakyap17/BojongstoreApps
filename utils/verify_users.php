<?php
// Verify all users in database
$pdo = new PDO('mysql:host=localhost;dbname=bojongstore;charset=utf8mb4', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

echo "✅ Users in database:\n";
$result = $pdo->query('SELECT id, nama, email, created_at FROM users ORDER BY id')->fetchAll();
foreach ($result as $user) {
    echo "   ID: " . $user['id'] . " | Name: " . $user['nama'] . " | Email: " . $user['email'] . "\n";
}
echo "\n✅ Total: " . count($result) . " users\n";

// Also test password verification
echo "\n✅ Testing password verification:\n";
$stmt = $pdo->prepare('SELECT password FROM users WHERE email = ?');
$stmt->execute(['admin@bojongstore.test']);
$row = $stmt->fetch();
if ($row && password_verify('admin123', $row['password'])) {
    echo "   ✓ admin123 password verified for admin@bojongstore.test\n";
} else {
    echo "   ✗ Password verification failed\n";
}

echo "\n✅ Database verification complete!\n";
?>
