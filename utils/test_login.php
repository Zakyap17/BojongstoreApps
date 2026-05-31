<?php
include 'includes/db.php';

// Simulasi login untuk testing
if ($_GET['action'] === 'test_login') {
    $_SESSION['user_id'] = 1;
    $_SESSION['user_name'] = 'Test User';
    session_write_close();
    header('Location: index.php');
    exit;
}

// Simulasi logout untuk testing
if ($_GET['action'] === 'test_logout') {
    session_destroy();
    session_write_close();
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Testing</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .test-box { background: #f0f0f0; padding: 20px; margin: 10px 0; border-radius: 8px; }
        a { color: #3a7d44; text-decoration: none; padding: 10px 20px; background: #e8f5e9; border-radius: 4px; display: inline-block; margin: 5px; }
    </style>
</head>
<body>
    <h1>Session Testing</h1>
    
    <div class="test-box">
        <h3>Current Session Status:</h3>
        <p><strong>Session ID:</strong> <?= session_id() ?></p>
        <p><strong>User ID:</strong> <?= $_SESSION['user_id'] ?? 'TIDAK ADA' ?></p>
        <p><strong>User Name:</strong> <?= $_SESSION['user_name'] ?? 'TIDAK ADA' ?></p>
    </div>

    <div class="test-box">
        <h3>Test Links:</h3>
        <a href="?action=test_login">Test Login (Set Session)</a>
        <a href="?action=test_logout">Test Logout (Destroy Session)</a>
        <a href="index.php">Go to Home</a>
    </div>

    <div class="test-box">
        <h3>Debug Info:</h3>
        <pre><?php var_dump($_SESSION); ?></pre>
    </div>
</body>
</html>
