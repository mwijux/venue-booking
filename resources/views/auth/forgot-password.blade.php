<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password - {{ config('app.name', 'VenueBook') }}</title>
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
            <a href="{{ route('login') }}" class="auth-nav-link">Login</a>
            <a href="{{ route('register') }}" class="auth-nav-link">Register</a>
        </div>
    </nav>

    <!-- Forgot Password Form -->
    <div class="auth-container">
        <div class="auth-card">

            <!-- Header -->
            <div class="auth-header">
                <div class="auth-header-icon">🔑</div>
                <h1 class="auth-header-title">Forgot Password?</h1>
                <p class="auth-header-subtitle">Enter your registered email and we will send link to change password</p>
            </div>

            <!-- Form -->
            <div class="auth-body-content">

                <!-- Status Messages -->
                @if(session('status'))
                    <div class="auth-alert auth-alert-success">
                        ✅ {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email -->
                    <div class="auth-form-group">
                        <label class="auth-label">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="auth-input" placeholder="Enter your registered email" required autofocus>
                        @error('email')
                            <p class="auth-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="auth-btn">
                         Send link to change Password
                    </button>
                </form>

                <!-- Divider -->
                <div class="auth-divider">
                    <span>au</span>
                </div>

                <!-- Back to Login -->
                <div style="text-align: center;">
                    <a href="{{ route('login') }}" class="auth-forgot-link" style="font-size: 14px;">
                        ← Return to Login page
                    </a>
                </div>
            </div>

            <!-- Footer -->
            <div class="auth-footer">
                <p class="auth-footer-text">
                    Don't have account? 
                    <a href="{{ route('register') }}" class="auth-footer-link">Register Here</a>
                </p>
            </div>

        </div>
    </div>

</body>
</html>