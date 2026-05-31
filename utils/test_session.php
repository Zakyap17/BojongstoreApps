<?php
include 'includes/db.php';

echo "=== SESSION DEBUG ===<br>";
echo "Session ID: " . session_id() . "<br>";
echo "Session Name: " . session_name() . "<br>";
echo "User ID dalam session: " . (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'TIDAK ADA') . "<br>";
echo "User Name dalam session: " . (isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'TIDAK ADA') . "<br>";
echo "<br><pre>";
var_dump($_SESSION);
echo "</pre>";

echo "<br>Session Save Path: " . ini_get('session.save_path') . "<br>";
echo "Session Cookie Lifetime: " . ini_get('session.cookie_lifetime') . "<br>";
echo "<br><a href='index.php'>Kembali ke Home</a>";
?>
