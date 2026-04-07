<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $company->company_name ?? 'LAMDAKU' }} Admin - Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Login Page Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            overflow: hidden;
            position: relative;
        }

        /* Background Shapes */
        .bg-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
            animation: float 20s infinite ease-in-out;
        }

        .shape-1 {
            width: 300px;
            height: 300px;
            background: #fff;
            top: -150px;
            left: -150px;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 200px;
            height: 200px;
            background: #fff;
            top: 60%;
            right: -100px;
            animation-delay: -7s;
        }

        .shape-3 {
            width: 150px;
            height: 150px;
            background: #fff;
            bottom: 10%;
            left: 20%;
            animation-delay: -12s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
                opacity: 0.1;
            }
            33% {
                transform: translateY(-30px) rotate(120deg);
                opacity: 0.2;
            }
            66% {
                transform: translateY(-20px) rotate(240deg);
                opacity: 0.15;
            }
        }

        /* Particles */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            animation: particle-float 15s infinite linear;
        }

        .particle:nth-child(1) { left: 10%; animation-delay: 0s; }
        .particle:nth-child(2) { left: 20%; animation-delay: -2s; }
        .particle:nth-child(3) { left: 30%; animation-delay: -4s; }
        .particle:nth-child(4) { left: 40%; animation-delay: -6s; }
        .particle:nth-child(5) { left: 50%; animation-delay: -8s; }
        .particle:nth-child(6) { left: 60%; animation-delay: -10s; }
        .particle:nth-child(7) { left: 70%; animation-delay: -12s; }
        .particle:nth-child(8) { left: 80%; animation-delay: -14s; }
        .particle:nth-child(9) { left: 90%; animation-delay: -16s; }

        @keyframes particle-float {
            0% {
                transform: translateY(100vh) translateX(0px) scale(0);
                opacity: 0;
            }
            10% {
                opacity: 1;
                transform: translateY(90vh) translateX(10px) scale(1);
            }
            90% {
                opacity: 1;
                transform: translateY(10vh) translateX(-10px) scale(1);
            }
            100% {
                opacity: 0;
                transform: translateY(0vh) translateX(0px) scale(0);
            }
        }

        /* Main Container */
        .login-container {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            z-index: 2;
        }

        /* Production Mode Banner */
        .production-banner {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: linear-gradient(135deg, #059669, #047857);
            color: white;
            z-index: 1001;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            animation: slideDownBanner 0.5s ease-out;
        }

        @keyframes slideDownBanner {
            from {
                transform: translateY(-100%);
            }
            to {
                transform: translateY(0);
            }
        }

        .production-content {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 12px 20px;
            font-size: 14px;
            font-weight: 500;
        }

        .production-banner i {
            font-size: 16px;
        }

        .production-close {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            padding: 6px 8px;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s ease;
            margin-left: 12px;
        }

        .production-close:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        /* Login Card */
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.1),
                0 0 0 1px rgba(255, 255, 255, 0.2);
            padding: 40px;
            width: 100%;
            max-width: 480px;
            position: relative;
            animation: slideUp 0.8s ease-out;
            margin-top: 50px; /* Space for production banner */
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Header */
        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .logo i {
            font-size: 32px;
            color: #667eea;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .logo h1 {
            font-size: 28px;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .login-header h2 {
            font-size: 24px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .login-header p {
            color: #64748b;
            font-size: 14px;
            line-height: 1.5;
        }

        /* Form Styles */
        .login-form {
            margin-bottom: 30px;
        }

        .form-group {
            position: relative;
            margin-bottom: 24px;
        }

        .form-group label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 8px;
        }

        .form-group label i {
            font-size: 16px;
            color: #667eea;
        }

        .form-group input {
            width: 100%;
            padding: 16px 20px;
            border: 2px solid transparent;
            border-radius: 12px;
            background: rgba(248, 250, 252, 0.8);
            font-size: 16px;
            color: #1e293b;
            transition: all 0.3s ease;
            position: relative;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            transform: translateY(-1px);
        }

        .form-group input::placeholder {
            color: #94a3b8;
        }

        .input-underline {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            transition: width 0.3s ease;
        }

        .form-group input:focus + .input-underline {
            width: 100%;
        }

        /* Password Wrapper */
        .password-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        .toggle-password:hover {
            color: #667eea;
        }

        /* Form Options */
        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 32px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-size: 14px;
            color: #374151;
        }

        .remember-me input {
            display: none;
        }

        .checkmark {
            width: 20px;
            height: 20px;
            border: 2px solid #d1d5db;
            border-radius: 4px;
            position: relative;
            transition: all 0.3s ease;
        }

        .remember-me input:checked + .checkmark {
            background: #667eea;
            border-color: #667eea;
        }

        .remember-me input:checked + .checkmark::after {
            content: '';
            position: absolute;
            left: 6px;
            top: 2px;
            width: 6px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        .forgot-password {
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: #5a67d8;
        }

        /* Login Button */
        .login-btn {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .login-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .login-btn:hover::before {
            left: 100%;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .login-btn:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3), 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .login-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .btn-loader {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .login-btn.loading {
            pointer-events: none;
            opacity: 0.8;
        }

        .login-btn.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid transparent;
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Progress indicator for login */
        .login-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 0 0 12px 12px;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .login-btn.loading .login-progress {
            animation: progress 2s ease-in-out;
        }

        @keyframes progress {
            0% { transform: scaleX(0); }
            50% { transform: scaleX(0.7); }
            100% { transform: scaleX(1); }
        }

        /* Alert Messages */
        .alert-container {
            margin-top: 20px;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            color: #166534;
            border: 1px solid rgba(34, 197, 94, 0.2);
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            color: #991b1b;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .alert-warning {
            background: rgba(245, 158, 11, 0.1);
            color: #92400e;
            border: 1px solid rgba(245, 158, 11, 0.2);
        }

        /* Footer */
        .login-footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid rgba(226, 232, 240, 0.8);
        }

        .login-footer p {
            font-size: 12px;
            color: #64748b;
            margin-bottom: 8px;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .footer-links a {
            font-size: 12px;
            color: #667eea;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: #5a67d8;
        }

        /* Toast Notifications */
        .toast-container {
            position: fixed;
            top: 80px;
            right: 20px;
            z-index: 1002;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .toast {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            padding: 16px 20px;
            max-width: 400px;
            transform: translateX(100%);
            transition: transform 0.3s ease;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .toast.show {
            transform: translateX(0);
        }

        .toast-success {
            border-left: 4px solid #10b981;
        }

        .toast-error {
            border-left: 4px solid #ef4444;
        }

        .toast-warning {
            border-left: 4px solid #f59e0b;
        }

        .toast-info {
            border-left: 4px solid #3b82f6;
        }

        .toast-icon {
            font-size: 18px;
        }

        .toast-success .toast-icon {
            color: #10b981;
        }

        .toast-error .toast-icon {
            color: #ef4444;
        }

        .toast-warning .toast-icon {
            color: #f59e0b;
        }

        .toast-info .toast-icon {
            color: #3b82f6;
        }

        .toast-content {
            flex: 1;
        }

        .toast-title {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .toast-message {
            font-size: 14px;
            color: #64748b;
            line-height: 1.4;
        }

        .toast-close {
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .toast-close:hover {
            background: #f1f5f9;
            color: #64748b;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .login-card {
                padding: 30px 20px;
                margin: 20px 10px;
                margin-top: 70px;
            }

            .logo h1 {
                font-size: 24px;
            }

            .login-header h2 {
                font-size: 20px;
            }

            .form-group input {
                padding: 14px 16px;
                font-size: 16px; /* Prevent zoom on iOS */
            }

            .login-btn {
                padding: 14px;
                font-size: 16px;
            }

            .toast-container {
                right: 10px;
                left: 10px;
            }

            .toast {
                max-width: none;
            }

            .production-banner {
                padding: 8px 16px;
            }

            .production-content {
                font-size: 12px;
            }
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 25px 15px;
                border-radius: 16px;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-options {
                flex-direction: column;
                gap: 12px;
                align-items: flex-start;
                margin-bottom: 24px;
            }

            .footer-links {
                flex-direction: column;
                gap: 8px;
            }
        }

        /* High contrast mode support */
        @media (prefers-contrast: high) {
            .login-card {
                background: white;
                border: 2px solid #000;
            }

            .form-group input {
                background: white;
                border-color: #000;
            }
        }

        /* Reduced motion support */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            .login-card {
                background: rgba(30, 41, 59, 0.95);
                color: #e2e8f0;
            }

            .login-header h2 {
                color: #e2e8f0;
            }

            .login-header p {
                color: #94a3b8;
            }

            .form-group label {
                color: #e2e8f0;
            }

            .form-group input {
                background: rgba(51, 65, 85, 0.8);
                color: #e2e8f0;
                border-color: #475569;
            }

            .form-group input::placeholder {
                color: #64748b;
            }

            .remember-me {
                color: #e2e8f0;
            }

            .login-footer p {
                color: #94a3b8;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Production Mode Banner -->
        <div class="production-banner">
            <div class="production-content">
                <i class="fas fa-shield-alt"></i>
                <span>Mode Produksi - Sistem Login Laravel Backend</span>
                <button class="production-close" onclick="this.parentElement.parentElement.style.display='none'">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <!-- Background Elements -->
        <div class="bg-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>

        <!-- Login Card -->
        <div class="login-card">
            <!-- Logo Section -->            <div class="login-header">
                <div class="logo">
                    @if($company && $company->logo)
                        <img src="{{ asset('storage/logos/' . $company->logo) }}" 
                             alt="{{ $company->company_name }}" 
                             style="height: 64px; width: auto; max-width: 150px;">
                    @else
                        <i class="fas fa-shield-alt"></i>
                    @endif
                    <h1>{{ $company->company_name ?? 'LAMDAKU' }}</h1>
                </div>
                <h2>Admin Dashboard</h2>
                <p>Masuk ke panel administrasi untuk mengelola konten website</p>
            </div>

            <!-- Login Form -->
            <form class="login-form" id="loginForm" action="{{ route('admin.login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="username">
                        <i class="fas fa-user"></i>
                        Username
                    </label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        placeholder="Masukkan username"
                        value="{{ old('username') }}"
                        required
                        autocomplete="username"
                    >
                    <div class="input-underline"></div>
                </div>

                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-lock"></i>
                        Password
                    </label>
                    <div class="password-wrapper">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="Masukkan password"
                            required
                            autocomplete="current-password"
                        >
                        <button type="button" class="toggle-password" onclick="togglePassword()">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                    <div class="input-underline"></div>
                </div>

                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" id="rememberMe" name="remember">
                        <span class="checkmark"></span>
                        Ingat saya
                    </label>
                    <a href="#" class="forgot-password">Lupa password?</a>
                </div>

                <button type="submit" class="login-btn" id="loginBtn">
                    <span class="btn-text">Masuk ke Dashboard</span>
                    <div class="btn-loader" style="display: none;">
                        <i class="fas fa-spinner fa-spin"></i>
                    </div>
                    <div class="login-progress"></div>
                </button>

                <!-- Alert Messages -->
                <div class="alert-container" id="alertContainer">
                    @if($errors->any())
                        <div class="alert alert-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first() }}
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i>
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </form>

            <!-- Footer -->            <div class="login-footer">
                <p>&copy; 2025 {{ $company->company_name ?? 'LAMDAKU' }}. Semua hak dilindungi.</p>
                <div class="footer-links">
                    <a href="{{ url('/') }}">Kembali ke Website</a>
                    <a href="#" onclick="showAbout()">Tentang</a>
                </div>
            </div>
        </div>

        <!-- Particles -->
        <div class="particles">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container" id="toastContainer"></div>

    <script>
        // Enhanced login form functionality
        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.getElementById('loginForm');
            const loginBtn = document.getElementById('loginBtn');
            const btnText = document.querySelector('.btn-text');
            const btnLoader = document.querySelector('.btn-loader');

            // Form submission handler
            loginForm.addEventListener('submit', function(e) {
                // Show loading state
                setLoadingState(true);
                
                // Show success toast
                showToast('Memproses Login', 'Sedang memverifikasi kredensial...', 'info');
            });

            // Auto-focus username field
            const usernameField = document.getElementById('username');
            if (usernameField) {
                usernameField.focus();
            }

            // Input focus animations
            const inputs = document.querySelectorAll('input[type="text"], input[type="password"]');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentNode.classList.add('focused');
                });
                
                input.addEventListener('blur', function() {
                    if (!this.value) {
                        this.parentNode.classList.remove('focused');
                    }
                });
            });

            // Real-time validation
            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    clearFieldError(this);
                    
                    if (this.value) {
                        this.classList.add('valid');
                        showFieldSuccess(this);
                    } else {
                        this.classList.remove('valid');
                        clearFieldSuccess(this);
                    }
                });
            });
        });

        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.className = 'fas fa-eye-slash';
            } else {
                passwordInput.type = 'password';
                toggleIcon.className = 'fas fa-eye';
            }
        }

        // Set loading state
        function setLoadingState(isLoading) {
            const loginBtn = document.getElementById('loginBtn');
            const btnText = document.querySelector('.btn-text');
            const btnLoader = document.querySelector('.btn-loader');
            
            if (isLoading) {
                loginBtn.disabled = true;
                loginBtn.classList.add('loading');
                btnText.style.display = 'none';
                btnLoader.style.display = 'flex';
            } else {
                loginBtn.disabled = false;
                loginBtn.classList.remove('loading');
                btnText.style.display = 'block';
                btnLoader.style.display = 'none';
            }
        }

        // Enhanced toast notification system
        function showToast(title, message, type = 'info', duration = 5000) {
            const toastContainer = document.getElementById('toastContainer');
            
            const toast = document.createElement('div');
            toast.className = `toast toast-${type}`;
            
            toast.innerHTML = `
                <div class="toast-icon">
                    ${getToastIcon(type)}
                </div>
                <div class="toast-content">
                    <div class="toast-title">${title}</div>
                    <div class="toast-message">${message}</div>
                </div>
                <button class="toast-close" onclick="this.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            `;
            
            toastContainer.appendChild(toast);
            
            // Show toast
            setTimeout(() => {
                toast.classList.add('show');
            }, 100);
            
            // Auto remove
            setTimeout(() => {
                toast.remove();
            }, duration);
        }

        // Get toast icon based on type
        function getToastIcon(type) {
            const icons = {
                success: '<i class="fas fa-check-circle"></i>',
                error: '<i class="fas fa-exclamation-circle"></i>',
                warning: '<i class="fas fa-exclamation-triangle"></i>',
                info: '<i class="fas fa-info-circle"></i>'
            };
            return icons[type] || icons.info;
        }

        // Field validation functions
        function showFieldSuccess(input) {
            clearFieldSuccess(input);
            
            const successDiv = document.createElement('div');
            successDiv.className = 'field-success';
            successDiv.innerHTML = '<i class="fas fa-check-circle"></i> Valid';
            
            input.parentNode.appendChild(successDiv);
        }

        function clearFieldSuccess(input) {
            const existingSuccess = input.parentNode.querySelector('.field-success');
            if (existingSuccess) {
                existingSuccess.remove();
            }
        }

        function clearFieldError(input) {
            const existingError = input.parentNode.querySelector('.field-error');
            if (existingError) {
                existingError.remove();
            }
            input.classList.remove('error');
        }        // Show about modal (placeholder)
        function showAbout() {
            showToast('Tentang {{ $company->company_name ?? 'LAMDAKU' }}', '{{ $company->description ?? 'LAMDAKU adalah lembaga akreditasi terpercaya untuk klinik, laboratorium, dan puskesmas.' }}', 'info');
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Alt + L to focus login form
            if (e.altKey && e.key === 'l') {
                e.preventDefault();
                document.getElementById('username').focus();
            }
        });

        // Auto-fill detection
        window.addEventListener('load', function() {
            setTimeout(() => {
                const inputs = document.querySelectorAll('input');
                inputs.forEach(input => {
                    if (input.value) {
                        input.parentNode.classList.add('focused');
                        input.classList.add('valid');
                    }
                });
            }, 100);
        });

        // Show initial success message if there's session success
        @if(session('success'))
            window.addEventListener('load', function() {
                showToast('Berhasil!', '{{ session('success') }}', 'success');
            });
        @endif

        // Show initial error message if there are errors
        @if($errors->any())
            window.addEventListener('load', function() {
                showToast('Login Gagal', '{{ $errors->first() }}', 'error');
            });
        @endif
    </script>
</body>
</html>
