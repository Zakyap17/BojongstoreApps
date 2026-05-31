<?php
/**
 * Diagnostic Script - Fix Database Connection Issues
 */

echo "╔═══════════════════════════════════════════════════════════╗\n";
echo "║         BojongStore - Database Diagnostic Tool          ║\n";
echo "╚═══════════════════════════════════════════════════════════╝\n\n";

// Step 1: Check PHP PDO Support
echo "1️⃣  Checking PHP PDO Support...\n";
if (extension_loaded('pdo')) {
    echo "   ✅ PDO Extension: Loaded\n";
} else {
    echo "   ❌ PDO Extension: NOT loaded\n";
    echo "   ⚠️  Please enable PDO in php.ini\n";
}

// Step 2: Check PDO MySQL Driver
echo "\n2️⃣  Checking PDO MySQL Driver...\n";
if (extension_loaded('pdo_mysql')) {
    echo "   ✅ PDO MySQL: Available\n";
} else {
    echo "   ❌ PDO MySQL: NOT available\n";
    echo "   ⚠️  Please enable pdo_mysql in php.ini\n";
}

// Step 3: List all available PDO drivers
echo "\n3️⃣  Available PDO Drivers:\n";
$drivers = PDO::getAvailableDrivers();
foreach ($drivers as $driver) {
    echo "   ✅ $driver\n";
}

// Step 4: Check MySQL Connection
echo "\n4️⃣  Attempting MySQL Connection...\n";

$connection_attempts = [
    [
        'host' => 'localhost',
        'port' => 3306,
        'desc' => 'localhost:3306'
    ],
    [
        'host' => '127.0.0.1',
        'port' => 3306,
        'desc' => '127.0.0.1:3306'
    ],
    [
        'host' => 'mysql',
        'port' => 3306,
        'desc' => 'mysql:3306'
    ]
];

$connected = false;

foreach ($connection_attempts as $attempt) {
    echo "   Trying {$attempt['desc']}...\n";
    try {
        $dsn = "mysql:host={$attempt['host']};port={$attempt['port']};charset=utf8mb4";
        $pdo = new PDO($dsn, 'root', '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_TIMEOUT => 5
        ]);
        echo "   ✅ Connected to MySQL at {$attempt['desc']}\n";
        $connected = true;
        break;
    } catch (PDOException $e) {
        echo "   ❌ Failed: " . $e->getMessage() . "\n";
    }
}

if (!$connected) {
    echo "\n⚠️  SOLUTION:\n";
    echo "   1. Make sure XAMPP is running\n";
    echo "   2. Start MySQL service in XAMPP Control Panel\n";
    echo "   3. Verify MySQL is listening on port 3306\n";
    echo "   4. Try again\n\n";
    exit(1);
}

// Step 5: Try to connect to bojongstore database
echo "\n5️⃣  Connecting to 'bojongstore' database...\n";
try {
    $dsn = "mysql:host=localhost;dbname=bojongstore;charset=utf8mb4";
    $pdo = new PDO($dsn, 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    echo "   ✅ Connected to bojongstore database\n";
    
    // Check users table
    $count = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
    echo "   ✅ Users table exists with $count records\n";
} catch (PDOException $e) {
    echo "   ❌ Failed: " . $e->getMessage() . "\n";
    echo "\n⚠️  SOLUTION:\n";
    echo "   The database 'bojongstore' doesn't exist yet.\n";
    echo "   Please run: php setup_database.php\n\n";
    exit(1);
}

// Step 6: PHP Configuration
echo "\n6️⃣  PHP Configuration:\n";
echo "   PHP Version: " . phpversion() . "\n";
echo "   PHP INI: " . php_ini_loaded_file() . "\n";
echo "   Max Execution: " . ini_get('max_execution_time') . "s\n";
echo "   Memory Limit: " . ini_get('memory_limit') . "\n";

// Success
echo "\n╔═══════════════════════════════════════════════════════════╗\n";
echo "║               ✅ ALL SYSTEMS OPERATIONAL              ║\n";
echo "╠═══════════════════════════════════════════════════════════╣\n";
echo "║  Database Connection: ✅ WORKING                         ║\n";
echo "║  PDO Drivers: ✅ AVAILABLE                               ║\n";
echo "║  bojongstore Database: ✅ EXISTS                         ║\n";
echo "║  Users Table: ✅ EXISTS                                  ║\n";
echo "╚═══════════════════════════════════════════════════════════╝\n\n";

echo "🚀 Your website should now work!\n";
echo "   Homepage: http://localhost/BojongStore/\n";
echo "   Login: http://localhost/BojongStore/login.php\n";
?>
