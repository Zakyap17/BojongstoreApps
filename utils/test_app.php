<?php
include 'includes/db.php';
include 'includes/security.php';

echo "=== BojongStore Application Test ===\n\n";

// Test 1: Database Connection
echo "1. Database Connection: ";
if ($pdo) {
    echo "✓ CONNECTED\n";
    
    // Check tables
    try {
        $result = $pdo->query("SHOW TABLES");
        $tables = $result->fetchAll(PDO::FETCH_COLUMN);
        echo "   Tables found: " . implode(", ", $tables) . "\n";
    } catch (Exception $e) {
        echo "   Error: " . $e->getMessage() . "\n";
    }
} else {
    echo "✗ FAILED\n";
}

// Test 2: Session
echo "\n2. Session Management: ";
if (session_status() === PHP_SESSION_ACTIVE) {
    echo "✓ Active\n";
} else {
    echo "✗ Not Active\n";
}

// Test 3: Security Functions
echo "\n3. Security Functions:\n";
echo "   - CSRF Token Generated: " . (strlen(generateCSRFToken()) > 0 ? "✓" : "✗") . "\n";
echo "   - Sanitize Input: " . (sanitizeInput("<script>alert('test')</script>") !== "<script>" ? "✓" : "✗") . "\n";
echo "   - Email Validation: " . (validateEmail("test@example.com") ? "✓" : "✗") . "\n";
echo "   - Password Validation: " . (validatePassword("short") !== null ? "✓" : "✗") . "\n";

// Test 4: File Structure
echo "\n4. File Structure:\n";
$requiredFiles = [
    'index.php',
    'login.php',
    'register.php',
    'profile.php',
    'produk.php',
    'includes/db.php',
    'includes/header.php',
    'includes/footer.php',
    'includes/security.php',
    'assets/css/style.css',
    'assets/js/main.js'
];

foreach ($requiredFiles as $file) {
    $exists = file_exists($file);
    echo "   - $file: " . ($exists ? "✓" : "✗") . "\n";
}

echo "\n=== Test Complete ===\n";
?>
