<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ingia - {{ config('app.name', 'VenueBook') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body class="auth-body">

    <!-- Navbar -->
    <nav class="auth-nav">
        <a href="/" class="auth-nav-logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 80px;">
            <span class="auth-nav-logo-text">VenueBook</span>
        </a>
        <div class="auth-nav-links">
            <a href="{{ route('login') }}" class="auth-nav-link active">Login</a>
            <a href="{{ route('register') }}" class="auth-nav-link">Register</a>
        </div>
    </nav>

    <!-- Login Form -->
    <div class="auth-container">
        <div class="auth-card">

            <!-- Header -->
            <div class="auth-header">
                <h1 class="auth-header-title">Welcome Back!</h1>
                <p class="auth-header-subtitle">Log into your Account to continue</p>
            </div>

            <!-- Form -->
            <div class="auth-body-content">

                <!-- Status Messages -->
                @if(session('status'))
                    <div class="auth-alert auth-alert-info">
                        ℹ️ {{ session('status') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="auth-alert auth-alert-error">
                        ❌ {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="auth-form-group">
                        <label class="auth-label">User name (Email)</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="auth-input" placeholder="example@email.com" required autofocus>
                        @error('email')
                            <p class="auth-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="auth-form-group">
                        <label class="auth-label">Password</label>
                        <input type="password" name="password" class="auth-input" placeholder="••••••••" required>
                        @error('password')
                            <p class="auth-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="auth-remember">
                        <label>
                            <input type="checkbox" name="remember">
                            Remmember Me
                        </label>
                        <a href="{{ route('password.request') }}" class="auth-forgot-link">Forgot password?</a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="auth-btn">
                         Login
                    </button>
                </form>
            </div>

            <!-- Footer -->
            <div class="auth-footer">
                <p class="auth-footer-text">
                    Idont have account? 
                    <a href="{{ route('register') }}" class="auth-footer-link">Register here</a>
                </p>
            </div>

        </div>
    </div>

</body>
</html>