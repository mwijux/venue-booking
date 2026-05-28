<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password - {{ config('app.name', 'VenueBook') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
</head>
<body class="auth-body">

    <!-- Navbar -->
    <nav class="auth-nav">
        <a href="/" class="auth-nav-logo">
            <span class="auth-nav-logo-text"> VenueBook</span>
        </a>
        <div class="auth-nav-links">
            <a href="{{ route('login') }}" class="auth-nav-link">Login</a>
            <a href="{{ route('register') }}" class="auth-nav-link">Register</a>
        </div>
    </nav>

    <!-- Reset Password Form -->
    <div class="auth-container">
        <div class="auth-card">

            <!-- Header -->
            <div class="auth-header">
                <div class="auth-header-icon">🔒</div>
                <h1 class="auth-header-title">Enter new Password</h1>
                <p class="auth-header-subtitle">Enter new password for your account</p>
            </div>

            <!-- Form -->
            <div class="auth-body-content">

                <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email -->
                    <div class="auth-form-group">
                        <label class="auth-label">Email</label>
                        <input type="email" name="email" value="{{ old('email', $request->email) }}" class="auth-input" required autofocus>
                        @error('email')
                            <p class="auth-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- New Password -->
                    <div class="auth-form-group">
                        <label class="auth-label">New Password</label>
                        <input type="password" name="password" class="auth-input" placeholder="enter new password" required>
                        <p class="auth-password-hint">Atleast 8 Characters</p>
                        @error('password')
                            <p class="auth-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="auth-form-group">
                        <label class="auth-label">confirm new Password</label>
                        <input type="password" name="password_confirmation" class="auth-input" placeholder="re-write new password " required>
                        @error('password_confirmation')
                            <p class="auth-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="auth-btn">
                         change Password
                    </button>
                </form>
            </div>

            <!-- Footer -->
            <div class="auth-footer">
                <p class="auth-footer-text">
                    do you remmember password? 
                    <a href="{{ route('login') }}" class="auth-footer-link">enter here</a>
                </p>
            </div>

        </div>
    </div>

</body>
</html>