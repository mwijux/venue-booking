<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'VenueBook') }} - Venue Booking System</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>
<body class="welcome-body">

    <!-- ============================================
         NAVIGATION BAR
         ============================================ -->
    <nav class="welcome-nav">
        <div class="welcome-nav-container">

            <!-- Logo Section -->
            <a href="/" class="welcome-logo">
                {{-- 
                    LOGO: Badilisha src hapa chini kuwa path ya logo yako
                    Mfano: <img src="{{ asset('images/logo.png') }}" alt="Logo">
                    Kama huna logo, emoji itatumika
                --}}
                <img src="{{ asset('images/logo.png') }}" alt="VenueBook Logo" style="height: 80px;"> 
                <div>
                    <span class="welcome-logo-text"> VenueBook</span>
                    <span class="welcome-logo-sub">Venue Booking System</span>
                </div>
            </a>

            <!-- Navigation Links -->
            <div class="welcome-nav-links">
                @auth
                    <a href="{{ route('dashboard') }}" class="welcome-nav-btn">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="welcome-nav-link">Login</a>
                    <a href="{{ route('register') }}" class="welcome-nav-btn">Register</a>
                @endauth
            </div>

        </div>
    </nav>

    <!-- ============================================
         HERO SECTION
         Sehemu kuu ya kukaribisha wageni
         ============================================ -->
    <section class="welcome-hero">
        <div class="welcome-hero-content">
            <h1 class="welcome-hero-title">Easy Venue Booking System</h1>
            <p class="welcome-hero-subtitle">
                Find and reserve a venue quickly and securely. 
                Book halls, classrooms and other meeting spaces within your campus.
            </p>
            <div class="welcome-hero-buttons">
                @auth
                    <a href="{{ route('dashboard') }}" class="welcome-hero-btn-primary">
                        Go to Dashboard →
                    </a>
                @else
                    <a href="{{ route('register') }}" class="welcome-hero-btn-primary">
                        Start now - Free
                    </a>
                    <a href="{{ route('login') }}" class="welcome-hero-btn-outline">
                        I have Account - Login
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <!-- ============================================
         STATS BAR
         Takwimu fupi za mfumo
         ============================================ -->
    <section class="welcome-stats">
        <div class="welcome-stats-container">
            <div class="welcome-stat-card stat-1">
                <div class="welcome-stat-icon">⚡</div>
                <div class="welcome-stat-title">Faster</div>
                <div class="welcome-stat-number">30s</div>
                <div style="font-size: 12px; opacity: 0.8; margin-top: 4px;">venue booking process</div>
            </div>
            <div class="welcome-stat-card stat-2">
                <div class="welcome-stat-icon">🔒</div>
                <div class="welcome-stat-title">securely</div>
                <div class="welcome-stat-number">100%</div>
                <div style="font-size: 12px; opacity: 0.8; margin-top: 4px;">Your data is safe</div>
            </div>
            <div class="welcome-stat-card stat-3">
                <div class="welcome-stat-icon">📱</div>
                <div class="welcome-stat-title">Anywhere</div>
                <div class="welcome-stat-number">24/7</div>
                <div style="font-size: 12px; opacity: 0.8; margin-top: 4px;">Availability at any time</div>
            </div>
        </div>
    </section>

    <!-- ============================================
         FEATURES SECTION
         Vipengele vya mfumo
         ============================================ -->
    <section class="welcome-features">
        <div class="welcome-section-container">
            <h2 class="welcome-section-title">Why Use This System?</h2>
            <p class="welcome-section-subtitle">
                Our system is designed to simplify the 
                venue booking process in a modern and secure way.
            </p>

            <div class="welcome-features-grid">

                <!-- Feature 1 -->
                <div class="welcome-feature-card">
                    <div class="welcome-feature-icon">📅</div>
                    <h3 class="welcome-feature-title">Book Easily</h3>
                    <p class="welcome-feature-desc">
                        Choose a venue, date and time. The system will automatically show you 
                        available spaces without any hassle.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="welcome-feature-card">
                    <div class="welcome-feature-icon">⚡</div>
                    <h3 class="welcome-feature-title">No Conflicts</h3>
                    <p class="welcome-feature-desc">
                        The system automatically checks if the venue is available 
                        before confirming your booking.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="welcome-feature-card">
                    <div class="welcome-feature-icon">📊</div>
                    <h3 class="welcome-feature-title">Reports and Calendars</h3>
                    <p class="welcome-feature-desc">
                        View bookings on the calendar. Easily download CSV and PDF reports.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="welcome-feature-card">
                    <div class="welcome-feature-icon">👥</div>
                    <h3 class="welcome-feature-title">Many Types of Users</h3>
                    <p class="welcome-feature-desc">
                        Students, lecturers and visitors can use this system in a simple and secure way.
                    </p>
                </div>

                <!-- Feature 5 -->
                <div class="welcome-feature-card">
                    <div class="welcome-feature-icon">🔐</div>
                    <h3 class="welcome-feature-title">High Security</h3>
                    <p class="welcome-feature-desc">
                        Your data is protected by a modern 
                        security system. Passwords are encrypted.
                    </p>
                </div>

                <!-- Feature 6 -->
                <div class="welcome-feature-card">
                    <div class="welcome-feature-icon">📱</div>
                    <h3 class="welcome-feature-title">Works Anywhere</h3>
                    <p class="welcome-feature-desc">
                        The system works on computers, phones and 
                        tablets. Book a venue wherever you are.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- ============================================
         HOW IT WORKS
         Hatua 4 za kutumia mfumo
         ============================================ -->
    <section class="welcome-steps">
        <div class="welcome-section-container">
            <h2 class="welcome-section-title">How It Works</h2>
            <p class="welcome-section-subtitle">
                Just 4 easy steps to find the venue you want.
            </p>

            <div class="welcome-steps-grid">

                <!-- Step 1 -->
                <div class="welcome-step">
                    <div class="welcome-step-number">1</div>
                    <h3 class="welcome-step-title">Sign up</h3>
                    <p class="welcome-step-desc">
                        Create your account as a student, lecturer or guest.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="welcome-step">
                    <div class="welcome-step-number">2</div>
                    <h3 class="welcome-step-title">Sign In</h3>
                    <p class="welcome-step-desc">
                        Log in to your account with your email and password.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="welcome-step">
                    <div class="welcome-step-number">3</div>
                    <h3 class="welcome-step-title">Select Venue</h3>
                    <p class="welcome-step-desc">
                        Check out the available venues and choose the one that suits you.
                    </p>
                </div>

                <!-- Step 4 -->
                <div class="welcome-step">
                    <div class="welcome-step-number">4</div>
                    <h3 class="welcome-step-title">Confirm it</h3>
                    <p class="welcome-step-desc">
                        Your booking will be confirmed automatically!
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- ============================================
         CTA SECTION
         Wito wa mwisho wa kuchukua hatua
         ============================================ -->
    <section class="welcome-cta">
        <h2 class="welcome-cta-title">Ready to Book a Venue?</h2>
        <p class="welcome-cta-subtitle">
            Register now and start using our modern venue booking system.
        </p>
        <div class="welcome-hero-buttons">
            @auth
                <a href="{{ route('dashboard') }}" class="welcome-hero-btn-primary">
                    Go To Dashboard →
                </a>
            @else
                <a href="{{ route('register') }}" class="welcome-hero-btn-primary">
                    Register Now - Free
                </a>
                <a href="{{ route('login') }}" class="welcome-hero-btn-outline">
                    I have an account - Login
                </a>
            @endauth
        </div>
    </section>

    <!-- ============================================
         FOOTER
         Sehemu ya chini ya ukurasa
         ============================================ -->
    <footer class="welcome-footer">
        <div class="welcome-footer-container">

            <!-- Brand -->
            <div class="welcome-footer-brand">
                <h3>VenueBook</h3>
                <p>
                    A modern venue booking system within the university.
                    <p>Designed to simplify the process of finding and reserving a venue.<p>
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="welcome-footer-title">Links</h4>
                <ul class="welcome-footer-links">
                    <li><a href="{{ route('login') }}">Sign in</a></li>
                    <li><a href="{{ route('register') }}">Sign up</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="welcome-footer-title">Contact</h4>
                <ul class="welcome-footer-links">
                    <li><a href="#">📧 antidiusm.mwijage23@mustudent.ac.tz</a></li>
                    <li><a href="#">📞 +255 629 514 035</a></li>
                    <li><a href="#">📍 Morogoro, Tanzania</a></li>
                </ul>
            </div>

        </div>

        <!-- Copyright -->
        <div class="welcome-footer-bottom">
            &copy; {{ date('Y') }} VenueBook. All rights reserved.
        </div>
    </footer>

</body>
</html>