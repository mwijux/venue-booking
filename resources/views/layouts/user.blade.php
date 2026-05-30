<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'VenueBook') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="user-body">

    {{-- Sidebar Overlay --}}
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    {{-- Sidebar --}}
    <aside class="sidebar-user" id="sidebar">
        <div class="sidebar-brand">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 80px; margin-bottom: 1px;"><p>Venue Booking System</p>
        
        </div>

        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <span class="menu-icon"></span> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('bookings.create') }}" class="{{ request()->routeIs('bookings.create') ? 'active' : '' }}">
                    <span class="menu-icon"></span> Book Venue
                </a>
            </li>
            <li>
                <a href="{{ route('bookings.index') }}" class="{{ request()->routeIs('bookings.index') ? 'active' : '' }}">
                    <span class="menu-icon"></span> My Bookings
                </a>
            </li>
        </ul>
    </aside>

    {{-- Main Content --}}
    <div class="main-wrapper" id="mainWrapper">
        {{-- Top Bar --}}
        <div class="user-top-bar">
            <div style="display: flex; align-items: center; gap: 15px;">
                <button class="sidebar-toggle" onclick="toggleSidebar()" title="Toggle Sidebar">
                    <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <span class="welcome-text">Hi, {{ Auth::user()->first_name }}!</span>
            </div>

            <div style="display: flex; align-items: center;">
                <div class="user-dropdown" id="userDropdown">
                    <button class="user-dropdown-btn" onclick="toggleUserDropdown()">
                        <div class="user-avatar">
                            {{ strtoupper(substr(Auth::user()->first_name, 0, 1)) }}{{ strtoupper(substr(Auth::user()->last_name, 0, 1)) }}
                        </div>
                        <div style="text-align: left; line-height: 1.3;">
                            <div style="font-weight: 600; font-size: 13px;">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
                            <div style="font-size: 11px; color: #888;">{{ ucfirst(Auth::user()->role) }}</div>
                        </div>
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="opacity: 0.5;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div class="user-dropdown-menu" id="userDropdownMenu">
                        <div class="dropdown-header">
                            <div class="dd-name">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
                            <div class="dd-email">{{ Auth::user()->email }}</div>
                            <span class="dd-role">{{ Auth::user()->role }}</span>
                        </div>

                        <a href="{{ route('profile.edit') }}">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            My Profile
                        </a>

                        <div class="dropdown-divider"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="logout-btn">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Page Content --}}
        <div class="user-content-area">
            @yield('content')
        </div>
    </div>

    {{-- JavaScript --}}
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
            var menu = document.getElementById('userDropdownMenu');
            menu.classList.toggle('show');
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