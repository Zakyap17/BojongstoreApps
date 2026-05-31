@extends('layouts.landing')

@push('styles')
<style>
    .dashboard-hero {
        background: linear-gradient(135deg, #0a4d2e 0%, #16a34a 100%);
        border-radius: 24px;
        padding: 60px 40px;
        color: white;
        margin-bottom: 40px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px -5px rgba(10, 77, 46, 0.3);
    }

    .dashboard-hero::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.05);
        pointer-events: none;
    }

    .dashboard-title {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 8px;
        letter-spacing: -0.5px;
    }

    .dashboard-subtitle {
        font-size: 16px;
        color: rgba(255, 255, 255, 0.85);
        max-width: 500px;
        line-height: 1.6;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
        margin-bottom: 60px;
    }

    .dashboard-card {
        background: white;
        border: 1px solid rgba(226, 232, 240, 0.8);
        border-radius: 20px;
        padding: 30px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        text-decoration: none;
        color: inherit;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        border-color: rgba(22, 163, 74, 0.3);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .card-icon-wrap {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 24px;
    }

    .icon-fav { background: #fef2f2; color: #ef4444; }
    .icon-catalog { background: #f0fdf4; color: #16a34a; }
    .icon-profile { background: #eff6ff; color: #3b82f6; }

    .card-title {
        font-size: 20px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 8px;
    }

    .card-description {
        font-size: 14px;
        color: #64748b;
        line-height: 1.5;
        margin-bottom: 20px;
    }

    .card-action-text {
        font-size: 14px;
        font-weight: 600;
        color: #16a34a;
        display: flex;
        align-items: center;
        gap: 6px;
        margin-top: auto;
    }
</style>
@endpush

@section('content')
<main style="padding-top: 40px; min-height: calc(100vh - 300px);">
    <div class="container">
        
        {{-- Hero Welcome --}}
        <div class="dashboard-hero">
            <h1 class="dashboard-title">Selamat Datang Kembali, {{ Auth::user()->name }}!</h1>
            <p class="dashboard-subtitle">Akses cepat ke koleksi produk favorit Anda, jelajahi katalog produk unggulan lokal, atau perbarui profil Anda di bawah ini.</p>
        </div>

        {{-- Actions Grid --}}
        <div class="dashboard-grid">
            
            {{-- Card Favorit --}}
            <a href="{{ route('favorit') }}" class="dashboard-card">
                <div class="card-icon-wrap icon-fav">
                    <i data-lucide="bookmark" width="28" height="28" fill="currentColor"></i>
                </div>
                <h3 class="card-title">Produk Favorit</h3>
                <p class="card-description">Lihat dan kelola produk pilihan yang telah Anda tandai sebagai favorit untuk pembelian cepat.</p>
                <div class="card-action-text">
                    Buka Favorit <i data-lucide="arrow-right" width="16" height="16"></i>
                </div>
            </a>

            {{-- Card Katalog --}}
            <a href="{{ route('produk') }}" class="dashboard-card">
                <div class="card-icon-wrap icon-catalog">
                    <i data-lucide="shopping-bag" width="28" height="28"></i>
                </div>
                <h3 class="card-title">Jelajahi Katalog</h3>
                <p class="card-description">Cari dan temukan produk berkualitas unggulan dari berbagai sektor UMKM lokal Bojongsoang.</p>
                <div class="card-action-text">
                    Buka Katalog <i data-lucide="arrow-right" width="16" height="16"></i>
                </div>
            </a>

            {{-- Card Profil --}}
            <a href="{{ route('profile.edit') }}" class="dashboard-card">
                <div class="card-icon-wrap icon-profile">
                    <i data-lucide="user-cog" width="28" height="28"></i>
                </div>
                <h3 class="card-title">Pengaturan Profil</h3>
                <p class="card-description">Perbarui informasi email, nomor telepon, foto profil, dan kata sandi keamanan akun Anda.</p>
                <div class="card-action-text">
                    Edit Profil <i data-lucide="arrow-right" width="16" height="16"></i>
                </div>
            </a>

        </div>

    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>
@endsection
