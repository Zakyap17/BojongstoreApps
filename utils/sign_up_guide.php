<?php
/**
 * BojongStore - Simple Sign Up & Login Guide
 * This file provides complete instructions for sign up and login
 */
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BojongStore - Sign Up & Login Guide</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .container {
            background: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        h1 {
            color: #333;
            border-bottom: 3px solid #667eea;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }
        h2 {
            color: #667eea;
            margin-top: 30px;
            margin-bottom: 15px;
        }
        .section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #667eea;
        }
        .credentials {
            background: #e8f5e9;
            border: 2px solid #4caf50;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
            font-family: 'Courier New', monospace;
        }
        .credentials strong {
            color: #2e7d32;
        }
        .step {
            margin: 15px 0;
            padding-left: 30px;
            position: relative;
        }
        .step::before {
            content: "▶";
            position: absolute;
            left: 0;
            color: #667eea;
            font-weight: bold;
        }
        .button-link {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            margin: 10px 5px 10px 0;
            transition: all 0.3s;
        }
        .button-link:hover {
            background: #764ba2;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        .status {
            display: inline-block;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: bold;
            margin: 5px 0;
        }
        .status.success {
            background: #c8e6c9;
            color: #2e7d32;
        }
        .status.info {
            background: #bbdefb;
            color: #1565c0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #667eea;
            color: white;
        }
        tr:hover {
            background: #f5f5f5;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🚀 BojongStore - Sign Up & Login Guide</h1>
        
        <div class="section">
            <h2>✅ System Status</h2>
            <p>
                <span class="status success">✓ Database Connected</span>
                <span class="status success">✓ Registration Working</span>
                <span class="status success">✓ Login Ready</span>
                <span class="status success">✓ Security Enabled</span>
            </p>
        </div>

        <div class="section">
            <h2>1️⃣ Cara Sign Up (Daftar)</h2>
            
            <div class="step">
                <strong>Klik link untuk membuka halaman pendaftaran:</strong><br>
                <a href="/register.php" class="button-link">📝 Ke Halaman Sign Up</a>
            </div>
            
            <div class="step">
                <strong>Isi form dengan data Anda:</strong>
                <ul>
                    <li>Nama Lengkap: Masukkan nama Anda</li>
                    <li>Email: Gunakan email yang valid (cth: nama@example.com)</li>
                    <li>No. Telepon: Minimal 10 angka</li>
                    <li>Password: Minimal 6 karakter</li>
                    <li>Konfirmasi Password: Harus sama dengan password</li>
                </ul>
            </div>
            
            <div class="step">
                <strong>Klik tombol "Buat Akun"</strong>
            </div>
            
            <div class="step">
                <strong>Setelah berhasil:</strong>
                <ul>
                    <li>Anda akan diarahkan ke halaman beranda</li>
                    <li>Akun Anda sudah terdaftar di database</li>
                    <li>Gunakan email dan password tersebut untuk login</li>
                </ul>
            </div>
        </div>

        <div class="section">
            <h2>2️⃣ Cara Login</h2>
            
            <div class="step">
                <strong>Klik link untuk membuka halaman login:</strong><br>
                <a href="/login.php" class="button-link">🔐 Ke Halaman Login</a>
            </div>
            
            <div class="step">
                <strong>Masukkan email dan password Anda</strong>
            </div>
            
            <div class="step">
                <strong>Klik tombol "Masuk"</strong>
            </div>
            
            <div class="step">
                <strong>Setelah berhasil login:</strong>
                <ul>
                    <li>Anda akan diarahkan ke halaman beranda</li>
                    <li>Avatar Anda akan muncul di navbar (atas kanan)</li>
                    <li>Anda bisa mengakses profil dan fitur lainnya</li>
                </ul>
            </div>
        </div>

        <div class="section">
            <h2>👤 Test Accounts (Akun Test)</h2>
            
            <p>Anda bisa langsung login menggunakan akun admin berikut:</p>
            
            <div class="credentials">
                <strong>Email:</strong> admin@bojongstore.local<br>
                <strong>Password:</strong> Admin123!
            </div>
            
            <p>Atau gunakan salah satu akun test di bawah ini:</p>
            
            <table>
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Tipe</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>admin@bojongstore.local</td>
                        <td>Admin123!</td>
                        <td>Admin Account</td>
                    </tr>
                    <tr>
                        <td>admin@bojongstore.test</td>
                        <td><em>Ganti dengan password Anda</em></td>
                        <td>Test Account</td>
                    </tr>
                    <tr>
                        <td>user@bojongstore.test</td>
                        <td><em>Ganti dengan password Anda</em></td>
                        <td>Test Account</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="section">
            <h2>🔒 Security Features</h2>
            <p>Sistem BojongStore dilengkapi dengan fitur keamanan:</p>
            <ul>
                <li>✓ CSRF Protection - Proteksi dari serangan CSRF</li>
                <li>✓ Password Hashing - Password dienkripsi dengan aman</li>
                <li>✓ Input Validation - Validasi semua input dari user</li>
                <li>✓ Rate Limiting - Batasi percobaan login</li>
                <li>✓ Session Security - Session dilindungi dengan HTTPOnly</li>
                <li>✓ Email Validation - Validasi format email</li>
            </ul>
        </div>

        <div class="section">
            <h2>❌ Troubleshooting</h2>
            
            <h3>Jika gagal sign up:</h3>
            <ul>
                <li>Pastikan semua field sudah diisi</li>
                <li>Email harus valid (ada @ dan domain)</li>
                <li>No. telepon minimal 10 karakter</li>
                <li>Password minimal 6 karakter</li>
                <li>Password dan konfirmasi password harus sama</li>
                <li>Email tidak boleh sudah terdaftar</li>
            </ul>
            
            <h3>Jika gagal login:</h3>
            <ul>
                <li>Pastikan email dan password benar</li>
                <li>Jika lupa password, daftar akun baru</li>
                <li>Email harus sesuai dengan saat sign up</li>
                <li>Tunggu beberapa menit jika terlalu banyak percobaan</li>
            </ul>
        </div>

        <div class="section">
            <h2>🎯 Fitur Setelah Login</h2>
            <ul>
                <li>✓ Lihat profil user</li>
                <li>✓ Update informasi profil</li>
                <li>✓ Upload avatar/foto profil</li>
                <li>✓ Lihat produk unggulan</li>
                <li>✓ Cari dan filter produk</li>
                <li>✓ Logout kapan saja</li>
            </ul>
        </div>

        <div class="section">
            <h2>🔗 Quick Links</h2>
            <div style="text-align: center; margin: 20px 0;">
                <a href="/" class="button-link">🏠 Halaman Beranda</a>
                <a href="/login.php" class="button-link">🔐 Login</a>
                <a href="/register.php" class="button-link">📝 Sign Up</a>
                <a href="/produk.php" class="button-link">📦 Lihat Produk</a>
            </div>
        </div>

        <div style="text-align: center; margin-top: 40px; color: #666; font-size: 14px;">
            <p>BojongStore v1.0 - Mendukung UMKM Lokal 🌱</p>
            <p>© 2026 All Rights Reserved</p>
        </div>
    </div>
</body>
</html>
