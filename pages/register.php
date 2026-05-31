<?php
include '../includes/db.php';

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
                        
                        $_SESSION['user_id']   = $pdo->lastInsertId();
                        $_SESSION['user_name'] = $nama;
                        regenerateSessionID();
                        
                        header('Location: ../index.php');
                        exit;
                    } catch (PDOException $e) {
                        $regError = 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.';
                    }
                }
            } catch (PDOException $e) {
                $regError = 'Terjadi kesalahan database. Silakan coba lagi.';
            }
        }
    }
}

$csrfToken = generateCSRFToken();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar - BojongStore</title>
  <meta name="description" content="Buat akun BojongStore baru Anda.">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>




<style>
.auth-container {
  min-height: 100vh;
  display: grid;
  grid-template-columns: 1fr 1fr;
  overflow: hidden;
}

.auth-image-section {
  position: relative;
  background: linear-gradient(135deg, rgba(76, 175, 80, 0.3) 0%, rgba(56, 142, 60, 0.3) 100%);
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
}

.auth-image-section img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.auth-form-section {
  background: #f8f8f8;
  padding: 60px 50px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  overflow-y: auto;
  max-height: 100vh;
}

.auth-form-wrapper {
  width: 100%;
  max-width: 380px;
}

.auth-form-section h1 {
  font-size: 28px;
  font-weight: 700;
  color: var(--green-primary);
  margin-bottom: 30px;
  text-align: center;
  font-family: 'Inter', sans-serif;
}

.form-group {
  margin-bottom: 20px;
}

.form-group label {
  font-size: 13px;
  font-weight: 600;
  color: var(--text-dark);
  display: block;
  margin-bottom: 8px;
  font-family: 'Inter', sans-serif;
}

.form-group input {
  width: 100%;
  padding: 12px 15px;
  border: 1.5px solid var(--border);
  border-radius: var(--radius-sm);
  font-size: 14px;
  font-family: 'Inter', sans-serif;
  outline: none;
  transition: border-color 0.3s;
  background: white;
  color: var(--text-dark);
}

.form-group input::placeholder {
  color: var(--text-light);
}

.form-group input:focus {
  border-color: var(--green-primary);
}

.btn-submit {
  width: 100%;
  padding: 13px 20px;
  background: var(--green-primary);
  color: white;
  border: none;
  border-radius: var(--radius-sm);
  font-size: 15px;
  font-weight: 600;
  font-family: 'Inter', sans-serif;
  cursor: pointer;
  transition: background 0.3s;
  margin-top: 10px;
  margin-bottom: 20px;
}

.btn-submit:hover {
  background: #2d6335;
}

.auth-divider {
  display: flex;
  align-items: center;
  margin: 25px 0;
  color: var(--text-light);
  font-size: 12px;
  font-family: 'Inter', sans-serif;
}

.auth-divider::before,
.auth-divider::after {
  content: '';
  flex: 1;
  height: 1px;
  background: var(--border);
}

.auth-divider::before {
  margin-right: 12px;
}

.auth-divider::after {
  margin-left: 12px;
}

.social-login {
  display: flex;
  gap: 12px;
  justify-content: center;
  margin-top: 20px;
}

.social-btn {
  width: 45px;
  height: 45px;
  border-radius: 50%;
  border: 1.5px solid var(--border);
  background: white;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s;
  font-size: 18px;
  color: var(--text-dark);
  text-decoration: none;
  font-weight: 700;
  font-family: 'Inter', sans-serif;
}

.social-btn:hover {
  border-color: var(--green-primary);
  transform: scale(1.05);
}

.auth-footer-link {
  text-align: center;
  margin-top: 25px;
  font-size: 13px;
  color: var(--text-gray);
  font-family: 'Inter', sans-serif;
}

.auth-footer-link a {
  color: var(--green-primary);
  font-weight: 600;
  text-decoration: none;
}

.auth-footer-link a:hover {
  text-decoration: underline;
}

/* Responsive */
@media (max-width: 768px) {
  .auth-container {
    grid-template-columns: 1fr;
  }
  
  .auth-image-section {
    display: none;
  }
  
  .auth-form-section {
    padding: 40px 20px;
    min-height: auto;
  }
}
</style>

<div class="auth-container">
  <div class="auth-image-section">
    <img src="../assets/images/auth_bg.png" alt="BojongStore">
  </div>
  
  <div class="auth-form-section">
    <div class="auth-form-wrapper">
      <h1>Buat dan Daftar Akun Kamu</h1>
      
      <?php if ($regError): ?>
        <?= getErrorHTML($regError) ?>
      <?php endif; ?>
      
      <form method="POST" action="register.php">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken) ?>">
        <div class="form-group">
          <label for="regNama">Nama Lengkap</label>
          <input type="text" id="regNama" name="nama" placeholder="Masukkan nama anda" required>
        </div>
        
        <div class="form-group">
          <label for="regEmail">Email</label>
          <input type="email" id="regEmail" name="email" placeholder="Masukkan alamat email" required>
        </div>
        
        <div class="form-group">
          <label for="regPhone">No. Telepon</label>
          <input type="tel" id="regPhone" name="telepon" placeholder="Masukkan nomor telepon" required>
        </div>
        
        <div class="form-group">
          <label for="regPassword">Password</label>
          <input type="password" id="regPassword" name="password" placeholder="Buat password anda" required minlength="6">
        </div>
        
        <div class="form-group">
          <label for="regKonfirmPassword">Konfirmasi Password</label>
          <input type="password" id="regKonfirmPassword" name="konfirm_password" placeholder="Konfirmasi password anda" required minlength="6">
        </div>
        
        <button type="submit" class="btn-submit">Buat Akun</button>
      </form>
      
      <div class="auth-divider">Atau lanjutkan dengan</div>
      
      <div class="social-login">
        <a href="#" class="social-btn" title="Login dengan Facebook">f</a>
        <a href="#" class="social-btn" title="Login dengan Google">G</a>
      </div>
      
      <div class="auth-footer-link">
        Sudah punya akun? <a href="login.php">Masuk</a>
      </div>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>

