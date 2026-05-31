<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - BojongStore</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo_tree.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo_tree.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --green-primary: #2e7d32;
            --text-dark: #333;
            --text-light: #999;
            --border: #eee;
            --radius-sm: 8px;
        }

        body,
        html {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
        }

        .auth-container {
            height: 100vh;
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
            height: 100vh;
        }

        .auth-image-section img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .auth-form-section {
            background: #f8f8f8;
            padding: 40px 50px;
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
            margin-bottom: 25px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-dark);
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px 15px;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            font-size: 14px;
            outline: none;
            transition: border-color 0.3s;
            background: white;
            box-sizing: border-box;
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
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .btn-submit:hover {
            background: #235d25;
        }

        .auth-divider {
            display: flex;
            align-items: center;
            margin: 10px 0;
            color: var(--text-light);
            font-size: 12px;
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
            justify-content: center;
            margin-top: 15px;
        }

        .social-btn-g {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 11px 20px;
            border-radius: var(--radius-sm);
            border: 1.5px solid var(--border);
            background: white;
            cursor: pointer;
            transition: all 0.3s;
            color: var(--text-dark);
            text-decoration: none;
            font-family: 'Inter', sans-serif;
        }

        .social-btn-g:hover {
            border-color: #4285F4;
            background: #f8f9ff;
            box-shadow: 0 2px 8px rgba(66,133,244,0.15);
        }

        .auth-footer-link {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: #666;
        }

        .auth-footer-link a {
            color: var(--green-primary);
            font-weight: 600;
            text-decoration: none;
        }

        .error-msg {
            background: #ffebee;
            color: #c62828;
            padding: 10px;
            border-radius: 4px;
            font-size: 13px;
            margin-bottom: 20px;
            list-style: none;
            padding-left: 10px;
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
            }
        }
    </style>
</head>

<body>
    <div class="auth-container">
        <div class="auth-image-section">
            <img src="{{ asset('images/auth_bg.png') }}" alt="BojongStore">
        </div>

        <div class="auth-form-section">
            <div class="auth-form-wrapper">
                <h1>Buat Akun Kamu</h1>

                @if ($errors->any())
                    <div class="error-msg">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}"
                            placeholder="Masukkan nama anda" required autofocus />
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                            placeholder="Masukkan alamat email" required />
                    </div>

                    <div class="form-group">
                        <label for="telepon">No. Telepon</label>
                        <input id="telepon" type="tel" name="telepon" value="{{ old('telepon') }}"
                            placeholder="Masukkan nomor telepon" required />
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" placeholder="Buat password anda"
                            required />
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation"
                            placeholder="Konfirmasi password anda" required />
                    </div>

                    <button type="submit" class="btn-submit">Buat Akun</button>
                </form>

                <div class="auth-divider">Atau lanjutkan dengan</div>

                <div class="social-login">
                    <a href="{{ route('social.redirect', 'google') }}" class="social-btn social-btn-g" title="Login dengan Google">
                        <svg width="20" height="20" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                        <span style="margin-left: 8px; font-size: 14px; font-weight: 600;">Masuk dengan Google</span>
                    </a>
                </div>

                <div class="auth-footer-link">
                    Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>