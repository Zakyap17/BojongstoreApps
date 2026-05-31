<?php
include '../includes/db.php';
include '../includes/header.php';

// Handle contact form submission
$successMsg = '';
$errorMsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subjek = trim($_POST['subjek'] ?? '');
    $pesan = trim($_POST['pesan'] ?? '');

    if (empty($nama) || empty($email) || empty($subjek) || empty($pesan)) {
        $errorMsg = 'Semua field harus diisi.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg = 'Email tidak valid.';
    } else {
        // In production, send email or save to database
        // For now, just show success message
        $successMsg = 'Terima kasih! Pesan Anda telah diterima. Kami akan segera menghubungi Anda.';
    }
}
?>

<style>
.kontak-page {
    padding: 60px 40px;
    max-width: 900px;
    margin: 0 auto;
}

.kontak-page h1 {
    font-size: 32px;
    font-weight: 800;
    margin-bottom: 12px;
    color: var(--text-dark);
}

.kontak-page .sub {
    font-size: 15px;
    color: var(--text-gray);
    margin-bottom: 48px;
    line-height: 1.5;
}

.kontak-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    margin-bottom: 40px;
}

.kontak-info {
    display: flex;
    flex-direction: column;
    gap: 32px;
}

.info-item {
    display: flex;
    gap: 16px;
}

.info-icon {
    width: 44px;
    height: 44px;
    background: var(--green-bg);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--green-primary);
    font-size: 20px;
    flex-shrink: 0;
}

.info-content h3 {
    font-size: 15px;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 4px;
}

.info-content p {
    font-size: 14px;
    color: var(--text-gray);
    line-height: 1.6;
}

.info-content a {
    color: var(--green-primary);
    text-decoration: none;
    font-weight: 600;
}

.info-content a:hover {
    text-decoration: underline;
}

/* ---- Form ---- */
.kontak-form-wrapper {
    background: var(--bg-light);
    border-radius: 16px;
    padding: 32px;
}

.kontak-form-wrapper h2 {
    font-size: 20px;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 24px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 8px;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 12px 15px;
    border: 1.5px solid var(--border);
    border-radius: 8px;
    font-size: 14px;
    font-family: inherit;
    outline: none;
    transition: border-color 0.25s;
    background: white;
    color: var(--text-dark);
}

.form-group input:focus,
.form-group textarea:focus {
    border-color: var(--green-primary);
    box-shadow: 0 0 0 3px rgba(58,125,68,0.1);
}

.form-group textarea {
    resize: vertical;
    min-height: 120px;
}

.form-group input::placeholder,
.form-group textarea::placeholder {
    color: var(--text-light);
}

.btn-submit {
    width: 100%;
    padding: 13px 20px;
    background: var(--green-primary);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.25s;
    font-family: inherit;
}

.btn-submit:hover {
    background: #2d6335;
    transform: translateY(-2px);
    box-shadow: 0 4px 14px rgba(58,125,68,0.35);
}

/* ---- Alerts ---- */
.alert {
    padding: 14px 16px;
    border-radius: 8px;
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
}

.alert.success {
    background: #d4edda;
    color: #2d6335;
    border: 1px solid #b2dfdb;
}

.alert.error {
    background: #fdecea;
    color: #c0392b;
    border: 1px solid #f5c6cb;
}

/* Responsive */
@media (max-width: 768px) {
    .kontak-page { padding: 40px 20px; }
    .kontak-grid { grid-template-columns: 1fr; gap: 40px; }
    .kontak-form-wrapper { padding: 24px; }
}
</style>

<div class="kontak-page">
    <h1>Hubungi Kami</h1>
    <p class="sub">Ada pertanyaan atau saran untuk BojongStore? Jangan ragu untuk menghubungi kami. Tim kami siap membantu Anda kapan saja.</p>

    <div class="kontak-grid">
        <!-- Info Section -->
        <div class="kontak-info">
            <div class="info-item">
                <div class="info-icon">📍</div>
                <div class="info-content">
                    <h3>Lokasi</h3>
                    <p>Bojongsoang, Bandung<br>Jawa Barat, Indonesia</p>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon">📞</div>
                <div class="info-content">
                    <h3>Telepon</h3>
                    <p>
                        <a href="tel:+6281312821849">+62 813-1282-1849</a>
                    </p>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon">✉️</div>
                <div class="info-content">
                    <h3>Email</h3>
                    <p>
                        <a href="mailto:info@bojongstore.id">info@bojongstore.id</a>
                    </p>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon">🕐</div>
                <div class="info-content">
                    <h3>Jam Operasional</h3>
                    <p>Senin - Jumat: 08:00 - 17:00<br>Sabtu: 09:00 - 15:00<br>Minggu: Tutup</p>
                </div>
            </div>
        </div>

        <!-- Form Section -->
        <div class="kontak-form-wrapper">
            <h2>Kirim Pesan</h2>

            <?php if ($successMsg): ?>
                <div class="alert success">
                    ✓ <?= htmlspecialchars($successMsg) ?>
                </div>
            <?php endif; ?>

            <?php if ($errorMsg): ?>
                <div class="alert error">
                    ✕ <?= htmlspecialchars($errorMsg) ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="kontak.php">
                <div class="form-group">
                    <label for="kontakNama">Nama Lengkap</label>
                    <input type="text" id="kontakNama" name="nama" placeholder="Masukkan nama Anda" required>
                </div>

                <div class="form-group">
                    <label for="kontakEmail">Email</label>
                    <input type="email" id="kontakEmail" name="email" placeholder="Masukkan email Anda" required>
                </div>

                <div class="form-group">
                    <label for="kontakSubjek">Subjek</label>
                    <input type="text" id="kontakSubjek" name="subjek" placeholder="Masukkan subjek pesan" required>
                </div>

                <div class="form-group">
                    <label for="kontakPesan">Pesan</label>
                    <textarea id="kontakPesan" name="pesan" placeholder="Tuliskan pesan Anda di sini..." required></textarea>
                </div>

                <button type="submit" class="btn-submit">Kirim Pesan</button>
            </form>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>

