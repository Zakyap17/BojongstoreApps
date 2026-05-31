<?php
include '../includes/db.php';

$loginError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $pdo) {
    // Verify CSRF token
    if (!verifyCSRFToken($_POST['csrf_token'] ?? '')) {
        $loginError = 'Validasi keamanan gagal. Silakan coba lagi.';
    } elseif (!checkRateLimit('login', 5, 300)) {
        $loginError = 'Terlalu banyak percobaan. Silakan coba lagi dalam beberapa menit.';
    } else {
        $email    = sanitizeInput($_POST['email'] ?? '', 'email');
        $password = $_POST['password'] ?? '';

        // Validation
        if (empty($email) || empty($password)) {
            $loginError = 'Email dan password harus diisi.';
        } elseif (!validateEmail($email)) {
            $loginError = 'Format email tidak valid.';
        } else {
            try {
                $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
                $stmt->execute([$email]);
                $u = $stmt->fetch();

                if ($u && password_verify($password, $u['password'])) {
                    $_SESSION['user_id'] = $u['id'];
                    $_SESSION['user_name'] = $u['nama'];
                    $_SESSION['user_role'] = $u['role'];
                    regenerateSessionID();
                    
                    // Redirect admin to dashboard, others to index
                    if ($u['role'] === 'admin') {
                        header('Location: admin/dashboard.php');
                    } else {
                        header('Location: ../index.php');
                    }
                    exit;
                } else {
                    $loginError = 'Email atau password salah.';
                }
            } catch (PDOException $e) {
                $loginError = 'Terjadi kesalahan. Silakan coba lagi.';
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
  <title>Masuk - BojongStore</title>
  <meta name="description" content="Masuk ke akun BojongStore Anda.">
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
      <h1>Selamat Datang!</h1>
      
      <?php if ($loginError): ?>
        <?= getErrorHTML($loginError) ?>
      <?php endif; ?>
      
      <form method="POST" action="login.php">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken) ?>">
        <div class="form-group">
          <label for="loginEmail">Email</label>
          <input type="email" id="loginEmail" name="email" placeholder="Masukkan email anda" required>
        </div>
        
        <div class="form-group">
          <label for="loginPassword">Password</label>
          <input type="password" id="loginPassword" name="password" placeholder="Buat password anda" required>
        </div>
        
        <button type="submit" class="btn-submit">Masuk</button>
      </form>
      
      <div class="auth-divider">Atau lanjutkan dengan</div>
      
      <div class="social-login">
        <a href="#" class="social-btn" title="Login dengan Facebook">f</a>
        <a href="#" class="social-btn" title="Login dengan Google">G</a>
      </div>
      
      <div class="auth-footer-link">
        Belum punya akun? <a href="register.php">Buat akun</a>
      </div>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>

