<?php
/**
 * Database Manager - Alternative to phpMyAdmin
 * Allows managing database without phpMyAdmin
 */

session_start();

// Check if MySQLi is available
if (!extension_loaded('mysqli')) {
    die('<div style="font-family:Arial;background:#fdecea;color:#c0392b;border:2px solid #f5c6cb;border-radius:8px;padding:20px;margin:40px auto;max-width:600px;">
        <strong>⚠️ MySQLi Extension Missing</strong><br><br>
        The MySQLi extension is not loaded. However, PDO MySQL should still work for BojongStore.<br><br>
        <strong>To enable MySQLi:</strong><br>
        1. Edit: C:\xampp\php\php.ini<br>
        2. Find: ;extension=mysqli<br>
        3. Remove semicolon: extension=mysqli<br>
        4. Save and restart Apache
    </div>');
}

try {
    $mysqli = new mysqli('localhost', 'root', '', 'bojongstore');
    
    if ($mysqli->connect_error) {
        die('Connection failed: ' . $mysqli->connect_error);
    }
    
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>BojongStore - Database Manager</title>
        <style>
            body { font-family: Arial; margin: 20px; background: #f5f5f5; }
            .container { max-width: 1000px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; }
            h1 { color: #3a7d44; }
            .success { background: #d4edda; border: 1px solid #b2dfdb; padding: 10px; border-radius: 4px; margin: 10px 0; color: #2d6335; }
            .error { background: #fdecea; border: 1px solid #f5c6cb; padding: 10px; border-radius: 4px; margin: 10px 0; color: #c0392b; }
            table { width: 100%; border-collapse: collapse; margin: 20px 0; }
            th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
            th { background: #3a7d44; color: white; }
            tr:hover { background: #f9f9f9; }
            .btn { padding: 8px 16px; background: #3a7d44; color: white; border: none; border-radius: 4px; cursor: pointer; }
            .btn:hover { background: #2d6335; }
            .stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; margin: 20px 0; }
            .stat-box { background: #e8f5e9; padding: 15px; border-radius: 4px; border-left: 4px solid #3a7d44; }
            .stat-box h3 { margin: 0; color: #3a7d44; }
            .stat-box p { margin: 5px 0; font-size: 24px; font-weight: bold; }
        </style>
    </head>
    <body>
        <div class='container'>
            <h1>🗄️ BojongStore - Database Manager</h1>
            
            <div class='success'>
                ✅ Connected to MySQL successfully!
            </div>
    ";
    
    // Database Info
    $result = $mysqli->query("SELECT COUNT(*) as total FROM users");
    $row = $result->fetch_assoc();
    $user_count = $row['total'];
    
    // Get database size
    $result = $mysqli->query("SELECT 
        ROUND(((data_length + index_length) / 1024 / 1024), 2) as size_mb
        FROM information_schema.TABLES 
        WHERE table_schema = 'bojongstore'");
    $row = $result->fetch_assoc();
    $db_size = $row['size_mb'] ?? 0;
    
    echo "
            <div class='stats'>
                <div class='stat-box'>
                    <h3>Total Users</h3>
                    <p>$user_count</p>
                </div>
                <div class='stat-box'>
                    <h3>Database</h3>
                    <p>bojongstore</p>
                </div>
                <div class='stat-box'>
                    <h3>Size</h3>
                    <p>{$db_size} MB</p>
                </div>
            </div>
    
            <h2>📊 Users in Database</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Country</th>
                    <th>Created</th>
                </tr>
    ";
    
    $result = $mysqli->query("SELECT * FROM users ORDER BY id");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $created = date('d-m-Y H:i', strtotime($row['created_at']));
            echo "
                <tr>
                    <td>{$row['id']}</td>
                    <td>{$row['nama']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['telepon']}</td>
                    <td>{$row['negara']}</td>
                    <td>$created</td>
                </tr>
            ";
        }
    }
    
    echo "
            </table>
            
            <h2>🔧 Database Tools</h2>
            <p>
                <button class='btn' onclick=\"location.href='verify_users.php'\">Verify Users</button>
                <button class='btn' onclick=\"location.href='diagnostic.php'\">Run Diagnostic</button>
                <button class='btn' onclick=\"location.href='system_test.php'\">System Test</button>
            </p>
            
            <h2>ℹ️ Database Info</h2>
            <p>
                <strong>Host:</strong> localhost<br>
                <strong>Database:</strong> bojongstore<br>
                <strong>Tables:</strong> 1 (users)<br>
                <strong>Records:</strong> $user_count<br>
                <strong>Charset:</strong> utf8mb4
            </p>
            
            <h2>🌐 Access Website</h2>
            <p>
                <a href='http://localhost/BojongStore/' style='text-decoration:none;'>
                    <button class='btn'>Go to Homepage</button>
                </a>
                <a href='http://localhost/BojongStore/login.php' style='text-decoration:none;'>
                    <button class='btn'>Go to Login</button>
                </a>
            </p>
        </div>
    </body>
    </html>
    ";
    
    $mysqli->close();
    
} catch (Exception $e) {
    die('<div style="font-family:Arial;background:#fdecea;color:#c0392b;border:2px solid #f5c6cb;border-radius:8px;padding:20px;margin:40px auto;max-width:600px;">
        <strong>❌ Error</strong><br><br>' . htmlspecialchars($e->getMessage()) . '
    </div>');
}
?>
