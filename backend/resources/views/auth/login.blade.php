<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — AIDIA</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #f3f4f6; /* Abu-abu super muda */
            --card-bg: #ffffff;
            --text-main: #111827; /* Hitam pudar elegan */
            --text-muted: #6b7280; /* Abu-abu teks */
            --border-color: #e5e7eb;
            --input-bg: #f9fafb;
            --input-focus: #4b5563; /* Abu-abu gelap untuk border aktif */
            --btn-bg: #1f2937;
            --btn-hover: #111827;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background-color: var(--bg-color);
            color: var(--text-main);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            /* Pola titik samar di background */
            background-image: radial-gradient(#d1d5db 1px, transparent 1px);
            background-size: 24px 24px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }

        /* Card Form */
        .login-card {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
            border: 1px solid rgba(255, 255, 255, 0.5);
            animation: slideUp 0.4s ease-out forwards;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Logo Custom */
        .logo-container {
            display: flex;
            justify-content: center;
            margin-bottom: 32px;
        }
        .logo-box {
            width: 64px;
            height: 64px;
            background: var(--btn-bg);
            color: white;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 1px;
            box-shadow: 0 4px 10px rgba(31, 41, 55, 0.2);
        }

        /* Teks Header */
        .text-center { text-align: center; margin-bottom: 32px; }
        h1 { font-size: 24px; font-weight: 700; margin-bottom: 8px; letter-spacing: -0.5px; }
        p.subtitle { font-size: 14px; color: var(--text-muted); }

        /* Alert Error */
        .alert {
            background-color: #fef2f2;
            color: #b91c1c;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 24px;
            border: 1px solid #f87171;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Form Input */
        .form-group { margin-bottom: 20px; }
        
        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-main);
        }
        
        .form-control {
            width: 100%;
            padding: 12px 16px;
            background-color: var(--input-bg);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            font-size: 14px;
            font-family: inherit;
            color: var(--text-main);
            transition: all 0.2s ease;
        }
        
        .form-control::placeholder { color: #9ca3af; }
        
        /* Efek saat input diklik */
        .form-control:focus {
            outline: none;
            border-color: var(--input-focus);
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(75, 85, 99, 0.1);
        }

        /* Opsi Checkbox & Lupa Password */
        .options-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
            font-size: 13px;
        }
        
        .remember-label {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-muted);
            cursor: pointer;
            user-select: none;
            font-weight: 500;
        }
        
        .remember-label input[type="checkbox"] {
            width: 16px;
            height: 16px;
            border-radius: 4px;
            accent-color: var(--btn-bg);
            cursor: pointer;
        }
        
        .forgot-link {
            color: var(--text-main);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s;
        }
        .forgot-link:hover { text-decoration: underline; color: var(--btn-bg); }

        /* Tombol Utama */
        .btn-submit {
            width: 100%;
            padding: 14px;
            background-color: var(--btn-bg);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .btn-submit:hover {
            background-color: var(--btn-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        .btn-submit:active { transform: translateY(0); }

        /* Link Register */
        .footer-link {
            text-align: center;
            margin-top: 24px;
            font-size: 14px;
            color: var(--text-muted);
        }
        .footer-link a {
            color: var(--text-main);
            font-weight: 600;
            text-decoration: none;
        }
        .footer-link a:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <div class="login-wrapper">
        <div class="login-card">
            
            <div class="logo-container">
                <div class="logo-box">LOGO</div>
            </div>

            <div class="text-center">
                <h1>LOGIN</h1>
                <p class="subtitle">Silakan masukkan kredensial Admin</p>
            </div>

            @if(session('error'))
                <div class="alert">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                
                <div class="form-group">
                    <label for="email">Username</label>
                    <input type="text" id="email" name="email" class="form-control" placeholder="Masukkan username" value="{{ old('email') }}" required autofocus>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>

                <div class="options-row">
                    <label class="remember-label">
                        <input type="checkbox" name="remember"> Ingat saya
                    </label>
                    <a href="/forgot-password" class="forgot-link">Lupa Password?</a>
                </div>

                <button type="submit" class="btn-submit">Login</button>
            </form>
            
        </div>
    </div>

</body>
</html>