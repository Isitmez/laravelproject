<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Login') }} — AzuraShop</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background: #0b0a0e;
            display: flex; align-items: center; justify-content: center; padding: 1.5rem;
            position: relative;
            overflow-x: hidden;
        }
        
        /* Decorative Background Glows */
        .bg-glow-1 {
            position: absolute; width: 350px; height: 350px;
            background: radial-gradient(circle, rgba(233, 69, 96, 0.14) 0%, transparent 70%);
            top: 10%; left: 15%; filter: blur(50px); pointer-events: none; z-index: 1;
        }
        .bg-glow-2 {
            position: absolute; width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.12) 0%, transparent 70%);
            bottom: 10%; right: 15%; filter: blur(50px); pointer-events: none; z-index: 1;
        }

        .auth-card {
            background: rgba(22, 21, 28, 0.65);
            backdrop-filter: blur(24px) saturate(120%);
            -webkit-backdrop-filter: blur(24px) saturate(120%);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px;
            padding: 2.5rem;
            width: 100%; max-width: 420px;
            box-shadow: 0 30px 60px rgba(0,0,0,0.45);
            position: relative;
            z-index: 5;
        }
        
        .brand { display: flex; align-items: center; gap: .75rem; margin-bottom: 1.8rem; }
        .brand-icon {
            width: 44px; height: 44px; background: #e94560;
            border-radius: 10px; display: flex; align-items: center; justify-content: center;
            font-size: 1.35rem; color: white;
            box-shadow: 0 4px 12px rgba(233, 69, 96, 0.3);
        }
        .brand-name { color: white; font-size: 1.35rem; font-weight: 700; letter-spacing: -0.3px; }
        .brand-name span { color: #e94560; }
        
        h2 { color: white; font-size: 1.45rem; font-weight: 700; margin-bottom: .4rem; letter-spacing: -0.2px; }
        p.subtitle { color: rgba(255,255,255,.55); margin-bottom: 2rem; font-size: .875rem; }
        
        .form-label { color: rgba(255,255,255,.8); font-size: .85rem; font-weight: 500; margin-bottom: .4rem; display: block; }
        
        /* Premium Input Fields */
        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            margin-bottom: 1.25rem;
        }
        .input-icon {
            position: absolute;
            left: 14px;
            color: rgba(255, 255, 255, 0.4);
            font-size: 0.95rem;
            pointer-events: none;
        }
        .form-control {
            width: 100%;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 8px;
            color: white;
            padding: 0.75rem 1rem 0.75rem 2.6rem;
            font-size: 0.875rem;
            font-family: inherit;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .form-control:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: #e94560;
            box-shadow: 0 0 0 3px rgba(233, 69, 96, 0.18);
            outline: none;
        }
        .form-control::placeholder { color: rgba(255, 255, 255, 0.25); }
        
        /* Password Toggle */
        .password-toggle-btn {
            position: absolute;
            right: 14px;
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.4);
            cursor: pointer;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4px;
            transition: color 0.2s;
        }
        .password-toggle-btn:hover {
            color: #ffffff;
        }
        .form-control.password-input {
            padding-right: 2.6rem;
        }
        
        .btn-login {
            background: #e94560;
            border: 1px solid #e94560;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            padding: 0.75rem;
            width: 100%;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            margin-top: 0.5rem;
            letter-spacing: 0.3px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .btn-login:hover {
            background: #d63350;
            border-color: #d63350;
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(233, 69, 96, 0.3);
        }
        
        .form-check {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 1.25rem;
        }
        .form-check-input {
            width: 16px;
            height: 16px;
            background-color: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 4px;
            appearance: none;
            -webkit-appearance: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            outline: none;
            transition: all 0.2s;
        }
        .form-check-input:checked {
            background-color: #e94560;
            border-color: #e94560;
        }
        .form-check-input:checked::before {
            content: "\F26E";
            font-family: "bootstrap-icons";
            color: white;
            font-size: 0.7rem;
            font-weight: 900;
        }
        .form-check-label {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.85rem;
            cursor: pointer;
            user-select: none;
        }
        .form-check-input:checked + .form-check-label {
            color: rgba(255, 255, 255, 0.85);
        }

        .link-register { color: #e94560; text-decoration: none; font-weight: 600; transition: color 0.2s; }
        .link-register:hover { color: #ff6b6b; }
        .register-text { text-align: center; color: rgba(255,255,255,.5); font-size: 0.85rem; margin-top: 1.5rem; }
        
        .alert-error {
            background: rgba(233,69,96,0.12); border: 1px solid rgba(233,69,96,0.25);
            border-radius: 8px; color: #ff9aa8; padding: 0.75rem 1rem; font-size: 0.85rem; margin-bottom: 1.25rem;
            display: flex; align-items: center; gap: 8px;
        }
        .alert-success {
            background: rgba(40,167,69,0.12); border: 1px solid rgba(40,167,69,0.25);
            border-radius: 8px; color: #7fff9a; padding: 0.75rem 1rem; font-size: 0.85rem; margin-bottom: 1.25rem;
            display: flex; align-items: center; gap: 8px;
        }
        
        .admin-hint {
            background: rgba(99, 102, 241, 0.05); border: 1px solid rgba(99, 102, 241, 0.12);
            border-radius: 8px; padding: 0.75rem 1rem; margin-top: 1.5rem; font-size: 0.78rem;
            color: rgba(255,255,255,0.45); line-height: 1.6;
        }
        .admin-hint strong { color: rgba(255,255,255,0.7); }
    </style>
</head>
<body>

<div class="bg-glow-1"></div>
<div class="bg-glow-2"></div>

<div class="auth-card">
    <div class="brand">
        <div class="brand-icon"><i class="bi bi-shop"></i></div>
        <div class="brand-name">Azura<span>Shop</span></div>
    </div>

    <h2>{{ __('Welcome back!') }}</h2>
    <p class="subtitle">{{ __('Login to your account') }}</p>

    @if($errors->any())
    <div class="alert-error">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <span>{{ $errors->first() }}</span>
    </div>
    @endif

    @if(session('success'))
    <div class="alert-success">
        <i class="bi bi-check-circle-fill"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <form action="{{ route('login.post') }}" method="POST">
        @csrf

        <div>
            <label class="form-label">{{ __('Email') }}</label>
            <div class="input-wrapper">
                <span class="input-icon"><i class="bi bi-envelope"></i></span>
                <input type="email" name="email" class="form-control"
                       value="{{ old('email') }}" placeholder="email@example.com" required autofocus>
            </div>
        </div>

        <div>
            <label class="form-label">{{ __('Password') }}</label>
            <div class="input-wrapper">
                <span class="input-icon"><i class="bi bi-lock"></i></span>
                <input type="password" name="password" id="passwordInput" class="form-control password-input"
                       placeholder="{{ __('Enter your password') }}" required>
                <button type="button" class="password-toggle-btn" onclick="togglePasswordVisibility('passwordInput', this)">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
        </div>

        <div class="form-check">
            <input type="checkbox" name="remember" class="form-check-input" id="remember">
            <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
        </div>

        <button type="submit" class="btn-login">
            <i class="bi bi-box-arrow-in-right"></i> {{ __('Login') }}
        </button>
    </form>

    <div class="register-text">
        {{ __("Don't have an account?") }} <a href="{{ route('register') }}" class="link-register">{{ __('Register') }}</a>
    </div>

    <div style="text-align: center; margin-top: 1.2rem;">
        <a href="{{ route('front.home') }}" style="color: rgba(255,255,255,0.4); text-decoration: none; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 6px; transition: color 0.2s;" onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='rgba(255,255,255,0.4)'">
            <i class="bi bi-arrow-left"></i> {{ __('Return to Home') }}
        </a>
    </div>

    <div class="admin-hint">
        <i class="bi bi-info-circle-fill me-1 text-primary"></i>
        <strong>Admin:</strong> admin@admin.com / admin123<br>
        <strong>{{ __('Customer') }}:</strong> user@user.com / user123
    </div>
</div>

<script>
    function togglePasswordVisibility(inputId, btn) {
        const input = document.getElementById(inputId);
        const icon = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.className = 'bi bi-eye-slash';
        } else {
            input.type = 'password';
            icon.className = 'bi bi-eye';
        }
    }
</script>
</body>
</html>
