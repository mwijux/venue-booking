<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'VenueBook') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="app-shell">
        <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

        <aside class="sidebar-user" id="sidebar">
            <div class="sidebar-brand">
                <img src="{{ asset('images/logo.png') }}" alt="VenueBook Logo" class="brand-logo">
                <div class="brand-caption">Venue Booking System</div>
            </div>

            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <x-icon name="home" /> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('bookings.create') }}" class="{{ request()->routeIs('bookings.create') ? 'active' : '' }}">
                        <x-icon name="calendar" /> Book Venue
                    </a>
                </li>
                <li>
                    <a href="{{ route('bookings.index') }}" class="{{ request()->routeIs('bookings.index') || request()->routeIs('bookings.show') ? 'active' : '' }}">
                        <x-icon name="clipboard" /> My Bookings
                    </a>
                </li>
            </ul>
        </aside>

        <main class="main-wrapper" id="mainWrapper">
            <div class="user-top-bar">
                <div class="top-bar-group">
                    <button class="sidebar-toggle" onclick="toggleSidebar()" title="Toggle sidebar" type="button">
                        <x-icon name="menu" />
                    </button>
                    <span class="welcome-text">Hi, {{ Auth::user()->first_name }}!</span>
                </div>

                <div class="user-dropdown" id="userDropdown">
                    <button class="user-dropdown-btn" onclick="toggleUserDropdown()" type="button">
                        <div class="user-avatar">
                            {{ strtoupper(substr(Auth::user()->first_name, 0, 1)) }}{{ strtoupper(substr(Auth::user()->last_name, 0, 1)) }}
                        </div>
                        <div class="user-meta">
                            <div class="user-meta-name">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
                            <div class="user-meta-role">{{ Auth::user()->role }}</div>
                        </div>
                        <x-icon name="chevron-down" class="icon-sm" />
                    </button>

                    <div class="user-dropdown-menu" id="userDropdownMenu">
                        <div class="dropdown-header">
                            <div class="dd-name">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
                            <div class="dd-email">{{ Auth::user()->email }}</div>
                            <span class="dd-role">{{ Auth::user()->role }}</span>
                        </div>

                        <a href="{{ route('profile.edit') }}">
                            <x-icon name="user" /> My Profile
                        </a>

                        <div class="dropdown-divider"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="logout-btn">
                                <x-icon name="logout" /> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="user-content-area">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            var mainWrapper = document.getElementById('mainWrapper');
            var overlay = document.getElementById('sidebarOverlay');

            if (window.innerWidth > 768) {
                sidebar.classList.toggle('collapsed');
                mainWrapper.classList.toggle('expanded');
            } else {
                sidebar.classList.toggle('mobile-open');
                overlay.classList.toggle('show');
            }
        }

        function toggleUserDropdown() {
            document.getElementById('userDropdownMenu').classList.toggle('show');
        }

        document.addEventListener('click', function(event) {
            var dropdown = document.getElementById('userDropdown');
            var menu = document.getElementById('userDropdownMenu');

            if (dropdown && !dropdown.contains(event.target)) {
                menu.classList.remove('show');
            }
        });

        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                document.getElementById('sidebarOverlay').classList.remove('show');
                document.getElementById('sidebar').classList.remove('mobile-open');
            }
        });
    </script>
</body>
</html>
