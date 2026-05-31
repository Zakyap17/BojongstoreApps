<?php
include 'includes/db.php';

echo "=== BojongStore Registration Test ===\n\n";

// Test 1: Database connection
echo "1. Database Connection: ";
if ($pdo) {
    echo "✓ CONNECTED\n";
} else {
    echo "✗ FAILED\n";
    exit;
}

// Test 2: Check if users table exists
echo "2. Users Table: ";
try {
    $result = $pdo->query("SHOW TABLES LIKE 'users'");
    if ($result->rowCount() > 0) {
        echo "✓ EXISTS\n";
    } else {
        echo "✗ NOT FOUND\n";
    }
} catch (Exception $e) {
    echo "✗ ERROR: " . $e->getMessage() . "\n";
}

// Test 3: Check table structure
echo "3. Table Structure: ";
try {
    $result = $pdo->query("DESCRIBE users");
    $columns = $result->fetchAll(PDO::FETCH_COLUMN);
    echo "✓ " . count($columns) . " columns\n";
    foreach ($columns as $col) {
        echo "   - $col\n";
    }
} catch (Exception $e) {
    echo "✗ ERROR: " . $e->getMessage() . "\n";
}

// Test 4: Try to insert test user
echo "\n4. Test Registration Insert: ";
try {
    $test_email = 'test_' . time() . '@bojongstore.test';
    $test_password = password_hash('TestPassword123!', PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare('INSERT INTO users (nama, email, telepon, password, created_at) VALUES (?, ?, ?, ?, NOW())');
    $result = $stmt->execute(['Test User', $test_email, '081234567890', $test_password]);
    
    if ($result) {
        echo "✓ SUCCESS\n";
        echo "   Test user created: $test_email\n";
    } else {
        echo "✗ FAILED\n";
    }
} catch (Exception $e) {
    echo "✗ ERROR: " . $e->getMessage() . "\n";
}

// Test 5: Security functions
echo "\n5. Security Functions: ";
if (function_exists('generateCSRFToken')) {
    echo "✓ CSRF Working\n";
} else {
    echo "✗ CSRF Not Loaded\n";
}

echo "\n=== All Tests Complete ===\n";
?>
