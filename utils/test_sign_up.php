<?php
include 'includes/db.php';

// Enable detailed error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "=== Manual Registration Test ===\n\n";

// Simulate POST request
$_SERVER['REQUEST_METHOD'] = 'POST';

// Generate CSRF token
$csrfToken = generateCSRFToken();

// Simulate form data
$test_data = array(
    'nama' => 'Test User Registration',
    'email' => 'testuser_' . time() . '@bojongstore.test',
    'telepon' => '081234567890',
    'password' => 'TestPassword123!',
    'konfirm_password' => 'TestPassword123!',
    'csrf_token' => $csrfToken
);

echo "Test Data:\n";
echo "  Name: " . $test_data['nama'] . "\n";
echo "  Email: " . $test_data['email'] . "\n";
echo "  Phone: " . $test_data['telepon'] . "\n";
echo "  Password: " . str_repeat('*', strlen($test_data['password'])) . "\n\n";

// Simulate POST
$_POST = $test_data;

// Run validation
$regError = '';
$regSuccess = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $pdo) {
    // Verify CSRF token
    if (!verifyCSRFToken($_POST['csrf_token'] ?? '')) {
        $regError = 'Validasi keamanan gagal. Silakan coba lagi.';
    } elseif (!checkRateLimit('register', 5, 300)) {
        $regError = 'Terlalu banyak percobaan. Silakan coba lagi dalam beberapa menit.';
    } else {
        $nama     = sanitizeInput($_POST['nama'] ?? '', 'html');
        $email    = sanitizeInput($_POST['email'] ?? '', 'email');
        $telepon  = sanitizeInput($_POST['telepon'] ?? '', 'text');
        $password = $_POST['password'] ?? '';
        $konfirmPassword = $_POST['konfirm_password'] ?? '';

        echo "After Sanitization:\n";
        echo "  Name: $nama\n";
        echo "  Email: $email\n";
        echo "  Phone: $telepon\n\n";

        // Validation
        if (empty($nama) || empty($email) || empty($telepon) || empty($password) || empty($konfirmPassword)) {
            $regError = 'Semua field harus diisi.';
        } elseif (!validateEmail($email)) {
            $regError = 'Format email tidak valid.';
        } elseif ($phoneError = validatePhoneNumber($telepon)) {
            $regError = $phoneError;
        } elseif ($passwordError = validatePassword($password)) {
            $regError = $passwordError;
        } elseif ($password !== $konfirmPassword) {
            $regError = 'Password dan konfirmasi password tidak sesuai.';
        } else {
            // Check if email exists
            try {
                $check = $pdo->prepare('SELECT id FROM users WHERE email = ?');
                $check->execute([$email]);
                if ($check->fetch()) {
                    $regError = 'Email sudah terdaftar. Silakan gunakan email lain.';
                } else {
                    try {
                        $hashed = password_hash($password, PASSWORD_DEFAULT);
                        $stmt = $pdo->prepare('INSERT INTO users (nama, email, telepon, password, created_at) VALUES (?, ?, ?, ?, NOW())');
                        $stmt->execute([$nama, $email, $telepon, $hashed]);
                        
                        $user_id = $pdo->lastInsertId();
                        $regSuccess = 'Pendaftaran berhasil!';
                        
                        echo "✅ SUCCESS!\n\n";
                        echo "User registered:\n";
                        echo "  ID: $user_id\n";
                        echo "  Name: $nama\n";
                        echo "  Email: $email\n";
                        echo "  Phone: $telepon\n";
                        
                    } catch (PDOException $e) {
                        $regError = 'Terjadi kesalahan saat mendaftar. Silakan coba lagi. Error: ' . $e->getMessage();
                    }
                }
            } catch (PDOException $e) {
                $regError = 'Terjadi kesalahan database. Silakan coba lagi. Error: ' . $e->getMessage();
            }
        }
    }
}

if ($regError) {
    echo "❌ ERROR: $regError\n";
}

if ($regSuccess) {
    echo "✅ SUCCESS: $regSuccess\n";
}

echo "\n=== Test Complete ===\n";
?>
