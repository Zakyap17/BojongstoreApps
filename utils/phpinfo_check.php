<?php
// Quick info check - remove this file after debugging
echo "<h3>PHP Version: " . phpversion() . "</h3>";
echo "<h3>PDO Drivers: " . implode(', ', PDO::getAvailableDrivers()) . "</h3>";
echo "<h3>MySQL enabled: " . (extension_loaded('pdo_mysql') ? 'YES ✅' : 'NO ❌') . "</h3>";

// Test DB connection
try {
    $pdo = new PDO('mysql:host=localhost;dbname=bojongstore;charset=utf8mb4', 'root', '');
    echo "<h3 style='color:green'>DB Connection: OK ✅</h3>";
    $cnt = $pdo->query('SELECT COUNT(*) as c FROM users')->fetch()['c'];
    echo "<p>Users count: $cnt</p>";
} catch (Exception $e) {
    echo "<h3 style='color:red'>DB Connection FAILED ❌<br>" . htmlspecialchars($e->getMessage()) . "</h3>";
}
