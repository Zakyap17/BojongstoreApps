@extends('layouts.landing')

@section('content')
<style>
.kontak-page {
    padding: 60px 40px;
    max-width: 900px;
    margin: 80px auto 0;
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

@media (max-width: 768px) {
    .kontak-page { padding: 40px 20px; margin-top: 60px; }
    .kontak-grid { grid-template-columns: 1fr; gap: 40px; }
    .kontak-form-wrapper { padding: 24px; }
}
</style>

<div class="kontak-page">
    <h1>Hubungi Kami</h1>
    <p class="sub">Ada pertanyaan atau saran untuk BojongStore? Jangan ragu untuk menghubungi kami. Tim kami siap membantu Anda kapan saja.</p>

    <div class="kontak-grid">
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

        <div class="kontak-form-wrapper">
            <h2>Kirim Pesan</h2>

            @if (session('success'))
                <div class="alert success">
                    ✓ {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ url('/kontak') }}">
                @csrf
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
@endsection
