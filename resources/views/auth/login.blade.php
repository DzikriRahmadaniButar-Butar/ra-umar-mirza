@extends('layouts.guest')

@section('content')
<style>
    html, body {
        margin: 0;
        padding: 0;
        height: 100%;
        overflow: hidden; /* cegah scroll vertikal */
    }

    .login-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: linear-gradient(135deg, #009018 0%, #1900ff 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        padding: 0;
        margin: 0;
        overflow: hidden;
    }

    .login-container::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
        background-size: 50px 50px;
        animation: float 20s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }

    .login-card {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 28px;
        width: 100%;
        max-width: 380px;
        box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        position: relative;
        z-index: 10;
        animation: slideUp 0.8s ease-out;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .login-header {
        text-align: center;
        margin-bottom: 24px;
    }

    .logo-container {
        margin-bottom: 16px;
    }

    .logo {
        width: 120px;
        height: 120px;
        object-fit: cover;
        display: block;
        margin-left: auto;
        margin-right: auto;
        animation: none !important; /* matikan animasi */
    }

    .login-title {
        font-size: 26px;
        font-weight: 700;
        color: white;
        margin-bottom: 6px;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .login-subtitle {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.8);
        font-weight: 400;
    }

    .form-group {
        margin-bottom: 18px;
        position: relative;
    }

    .form-label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: white;
        margin-bottom: 6px;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }

    .form-input {
        width: 100%;
        padding: 14px 50px 14px 16px;
        background: rgba(255, 255, 255, 0.1);
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        color: white;
        font-size: 15px;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .form-input::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    .form-input:focus {
        outline: none;
        border-color: rgba(255, 255, 255, 0.6);
        background: rgba(255, 255, 255, 0.2);
        box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.1);
        transform: translateY(-2px);
    }

    .input-icon {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(255, 255, 255, 0.7);
        font-size: 18px;
        pointer-events: none;
    }

    .password-container {
        position: relative;
    }

    .password-toggle {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: rgba(255, 255, 255, 0.7);
        cursor: pointer;
        font-size: 18px;
        padding: 4px;
        transition: color 0.3s ease;
    }

    .password-toggle:hover {
        color: white;
    }

    .error-message {
        color: #ff6b6b;
        font-size: 12px;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 4px;
        animation: shake 0.5s ease-in-out;
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }

    .success-message {
        color: #4ecdc4;
        font-size: 13px;
        margin-bottom: 12px;
        padding: 10px 14px;
        background: rgba(78, 205, 196, 0.1);
        border-radius: 8px;
        border: 1px solid rgba(78, 205, 196, 0.3);
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .login-button {
        width: 100%;
        padding: 14px;
        background: linear-gradient(135deg, #ff6b6b 0%, #ff8e8e 100%);
        border: none;
        border-radius: 10px;
        color: white;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 6px 20px rgba(255, 107, 107, 0.3);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: relative;
        overflow: hidden;
    }

    .login-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }

    .login-button:hover::before {
        left: 100%;
    }

    .login-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 32px rgba(255, 107, 107, 0.4);
    }

    .login-button:active {
        transform: translateY(0);
    }

    .floating-shapes {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 1;
    }

    .shape {
        position: absolute;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        animation: floatShapes 15s infinite linear;
    }

    .shape:nth-child(1) {
        width: 80px;
        height: 80px;
        top: 10%;
        left: 10%;
        animation-delay: 0s;
    }

    .shape:nth-child(2) {
        width: 120px;
        height: 120px;
        top: 20%;
        right: 10%;
        animation-delay: -5s;
    }

    .shape:nth-child(3) {
        width: 60px;
        height: 60px;
        bottom: 20%;
        left: 20%;
        animation-delay: -10s;
    }

    .shape:nth-child(4) {
        width: 90px;
        height: 90px;
        bottom: 10%;
        right: 20%;
        animation-delay: -7s;
    }

    @keyframes floatShapes {
        0%, 100% {
            transform: translateY(0px) rotate(0deg);
            opacity: 0.5;
        }
        50% {
            transform: translateY(-30px) rotate(180deg);
            opacity: 0.8;
        }
    }
</style>

<div class="login-container">
    
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    
    <div class="login-card">
        <!-- Tombol Kembali -->
        <div class="mb-4 text-left">
            <a href="{{ url('/') }}" class="inline-block px-4 py-2 text-sm font-semibold text-white bg-transparent border border-white rounded hover:bg-white hover:text-blue-700 transition">
                ← Kembali
            </a>
        </div>
        <div class="login-header">
            <div class="logo-container">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
            </div>
            <h1 class="login-title">Selamat Datang</h1>
            <p class="login-subtitle">Silakan masuk ke akun Anda</p>
        </div>

        @if (session('status'))
            <div class="success-message">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Email/Username</label>
                <div style="position: relative;">
                    <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email/username Anda" required autofocus autocomplete="username" />
                    <span class="input-icon">📧</span>
                </div>
                @error('email')
                    <div class="error-message">⚠️ {{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Kata Sandi</label>
                <div class="password-container">
                    <input id="password" class="form-input" type="password" name="password" placeholder="Masukkan kata sandi Anda" required autocomplete="current-password" />
                    <button type="button" class="password-toggle" onclick="togglePassword()">👁️</button>
                </div>
                @error('password')
                    <div class="error-message">⚠️ {{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="login-button">Masuk</button>
        </form>
    </div>
</div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleButton = document.querySelector('.password-toggle');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleButton.textContent = '🙈';
    } else {
        passwordInput.type = 'password';
        toggleButton.textContent = '👁️';
    }
}

document.querySelectorAll('.form-input').forEach(input => {
    input.addEventListener('focus', function() {
        this.style.transform = 'translateY(-2px)';
    });
    input.addEventListener('blur', function() {
        this.style.transform = 'translateY(0)';
    });
});

document.querySelector('form').addEventListener('submit', function() {
    const button = document.querySelector('.login-button');
    button.textContent = 'Memproses...';
    button.style.background = 'linear-gradient(135deg, #4ecdc4 0%, #44a08d 100%)';
    button.disabled = true;
});
</script>
@endsection
