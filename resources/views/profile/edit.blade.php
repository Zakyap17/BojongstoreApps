@extends('layouts.landing')

@section('content')

<style>
    :root {
        --green: #2e7d32;
        --green-light: #e8f5e9;
        --green-dark: #1b5e20;
        --text-dark: #1a1a2e;
        --text-muted: #6b7280;
        --border: #e5e7eb;
        --bg: #f5f6f0;
        --white: #ffffff;
        --radius: 12px;
    }

    .profile-page {
        min-height: 100vh;
        background: var(--bg);
        padding: 48px 24px 80px;
        font-family: 'Inter', sans-serif;
    }

    .profile-container {
        max-width: 860px;
        margin: 0 auto;
    }

    .profile-card {
        background: var(--white);
        border-radius: var(--radius);
        padding: 36px 40px;
        box-shadow: 0 1px 6px rgba(0,0,0,0.06);
    }

    /* Avatar Row */
    .profile-avatar-row {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 32px;
    }

    .avatar-wrap {
        position: relative;
        width: 88px;
        height: 88px;
    }

    .avatar-circle {
        width: 88px;
        height: 88px;
        border-radius: 50%;
        background: #dce8da;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border: 3px solid #c8dcc5;
    }

    .avatar-circle img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .avatar-circle svg {
        color: #4a6741;
    }

    .avatar-cam-btn {
        position: absolute;
        bottom: 2px;
        right: 2px;
        width: 26px;
        height: 26px;
        background: white;
        border: 1.5px solid var(--border);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: var(--text-muted);
        transition: all 0.2s;
    }

    .avatar-cam-btn:hover {
        border-color: var(--green);
        color: var(--green);
    }

    .btn-edit-profile {
        background: var(--green);
        color: white;
        border: none;
        padding: 10px 24px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
        font-family: inherit;
    }

    .btn-edit-profile:hover {
        background: var(--green-dark);
    }

    /* Form Grid */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px 28px;
    }

    .form-field {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .form-field.full-width {
        grid-column: 1 / -1;
    }

    .form-field label {
        font-size: 13px;
        font-weight: 600;
        color: var(--text-dark);
    }

    .form-field input,
    .form-field select {
        padding: 11px 14px;
        border: 1.5px solid var(--border);
        border-radius: 8px;
        font-size: 14px;
        font-family: inherit;
        color: var(--text-dark);
        background: var(--bg);
        outline: none;
        transition: border-color 0.2s;
    }

    .form-field input:focus,
    .form-field select:focus {
        border-color: var(--green);
        background: white;
    }

    .form-field input[readonly],
    .form-field input:disabled {
        background: #f0f0f0;
        color: var(--text-muted);
        cursor: not-allowed;
    }

    .password-wrap {
        position: relative;
    }

    .password-wrap input {
        width: 100%;
        box-sizing: border-box;
        padding-right: 44px;
    }

    .toggle-pw {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        padding: 0;
    }

    .toggle-pw:hover {
        color: var(--green);
    }

    /* Action Buttons */
    .form-actions {
        margin-top: 28px;
        display: flex;
        gap: 12px;
        justify-content: flex-end;
    }

    .btn-save {
        background: var(--green);
        color: white;
        border: none;
        padding: 11px 32px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
        font-family: inherit;
    }

    .btn-save:hover {
        background: var(--green-dark);
    }

    .btn-cancel {
        background: white;
        color: var(--text-dark);
        border: 1.5px solid var(--border);
        padding: 11px 32px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        font-family: inherit;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }

    .btn-cancel:hover {
        border-color: var(--green);
        color: var(--green);
    }

    /* Danger Zone */
    .danger-zone {
        margin-top: 24px;
        padding: 20px 24px;
        border: 1.5px solid #fee2e2;
        border-radius: 10px;
        background: #fff9f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .danger-zone-text h4 {
        font-size: 14px;
        font-weight: 700;
        color: #b91c1c;
        margin-bottom: 4px;
    }

    .danger-zone-text p {
        font-size: 13px;
        color: var(--text-muted);
        margin: 0;
    }

    .btn-danger {
        background: #dc2626;
        color: white;
        border: none;
        padding: 9px 20px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        font-family: inherit;
        transition: background 0.2s;
        flex-shrink: 0;
    }

    .btn-danger:hover {
        background: #b91c1c;
    }

    /* Alert */
    .alert-success {
        background: #dcfce7;
        border: 1px solid #bbf7d0;
        color: #166534;
        padding: 12px 16px;
        border-radius: 8px;
        font-size: 13.5px;
        font-weight: 500;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .alert-error {
        background: #fee2e2;
        border: 1px solid #fecaca;
        color: #b91c1c;
        padding: 12px 16px;
        border-radius: 8px;
        font-size: 13px;
        margin-bottom: 20px;
    }

    /* Modal */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.4);
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: center;
        display: none;
    }

    .modal-overlay.active { display: flex; }

    .modal-box {
        background: white;
        border-radius: 12px;
        padding: 32px;
        max-width: 420px;
        width: 90%;
        box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    }

    .modal-box h3 {
        font-size: 18px;
        font-weight: 700;
        color: #b91c1c;
        margin-bottom: 8px;
    }

    .modal-box p {
        font-size: 13.5px;
        color: var(--text-muted);
        margin-bottom: 20px;
        line-height: 1.6;
    }

    .modal-actions {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
    }

    @media (max-width: 640px) {
        .form-grid { grid-template-columns: 1fr; }
        .profile-card { padding: 24px 20px; }
        .form-actions { flex-direction: column; }
        .danger-zone { flex-direction: column; gap: 12px; align-items: flex-start; }
    }
</style>

<div class="profile-page">
    <div class="profile-container">

        {{-- Success / Error Messages --}}
        @if(session('status') === 'profile-updated')
            <div class="alert-success">
                ✅ Profil berhasil diperbarui!
            </div>
        @endif

        @if($errors->any())
            <div class="alert-error">
                @foreach($errors->all() as $error)
                    <div>• {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="profile-card">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')

                {{-- Avatar + Edit Button --}}
                <div class="profile-avatar-row">
                    <div class="avatar-wrap">
                        <div class="avatar-circle">
                            @if($user->avatar)
                                <img src="{{ $user->avatar }}" alt="{{ $user->name }}">
                            @else
                                <svg width="42" height="42" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                            @endif
                        </div>
                        <button type="button" class="avatar-cam-btn" title="Ubah foto">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
                                <circle cx="12" cy="13" r="4"/>
                            </svg>
                        </button>
                    </div>

                    <button type="submit" class="btn-edit-profile">Edit Profile</button>
                </div>

                {{-- Form Fields --}}
                <div class="form-grid">
                    <div class="form-field">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="form-field">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div class="form-field">
                        <label for="telepon">No. Telepon</label>
                        <input type="tel" id="telepon" name="telepon" value="{{ old('telepon', $user->telepon) }}" placeholder="+62 8xxx-xxxx-xxxx">
                    </div>

                    <div class="form-field">
                        <label for="password">Password</label>
                        <div class="password-wrap">
                            <input type="password" id="password" name="password" placeholder="••••••••••••" autocomplete="new-password">
                            <button type="button" class="toggle-pw" onclick="togglePassword()" title="Tampilkan password">
                                <svg id="pw-eye" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="form-field">
                        <label for="negara">Negara</label>
                        <input type="text" id="negara" name="negara" value="{{ old('negara', $user->negara ?? 'Indonesia') }}" placeholder="Indonesia">
                    </div>
                </div>

            </form>
        </div>

        {{-- Danger Zone --}}
        <div class="danger-zone">
            <div class="danger-zone-text">
                <h4>Hapus Akun</h4>
                <p>Setelah dihapus, semua data akun Anda akan hilang secara permanen.</p>
            </div>
            <button type="button" class="btn-danger" onclick="document.getElementById('deleteModal').classList.add('active')">
                Hapus Akun
            </button>
        </div>

    </div>
</div>

{{-- Delete Account Modal --}}
<div class="modal-overlay" id="deleteModal">
    <div class="modal-box">
        <h3>⚠️ Hapus Akun</h3>
        <p>Apakah Anda yakin ingin menghapus akun secara permanen? Tindakan ini tidak dapat dibatalkan.</p>
        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('DELETE')
            @if(!$user->provider)
            <div class="form-field" style="margin-bottom: 16px;">
                <label for="delete-password">Konfirmasi Password</label>
                <input type="password" id="delete-password" name="password" placeholder="Masukkan password Anda" required>
            </div>
            @endif
            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="document.getElementById('deleteModal').classList.remove('active')">Batal</button>
                <button type="submit" class="btn-danger">Ya, Hapus Akun</button>
            </div>
        </form>
    </div>
</div>

<script>
    function togglePassword() {
        const pw = document.getElementById('password');
        pw.type = pw.type === 'password' ? 'text' : 'password';
    }

    // Close modal on overlay click
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) this.classList.remove('active');
    });
</script>

@endsection
