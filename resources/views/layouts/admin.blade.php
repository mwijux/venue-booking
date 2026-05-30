<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - {{ config('app.name', 'VenueBook') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Sidebar Toggle Styles */
        .sidebar {
            transition: width 0.3s ease, transform 0.3s ease;
        }

        .sidebar.collapsed {
            width: 0;
            overflow: hidden;
            transform: translateX(-220px);
        }

        .main-content {
            transition: margin-left 0.3s ease;
        }

        .main-content.expanded {
            margin-left: 0;
        }

        /* Toggle Button */
        .sidebar-toggle {
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
            color: var(--text-primary);
        }

        .sidebar-toggle:hover {
            background: #f0f0f0;
        }

        /* User Dropdown */
        .user-dropdown {
            position: relative;
        }

        .user-dropdown-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background: white;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 14px;
            color: var(--text-primary);
        }

        .user-dropdown-btn:hover {
            background: #f5f5f5;
            border-color: #ccc;
        }

        .user-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: var(--sidebar-bg);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 13px;
        }

        .user-dropdown-menu {
            position: absolute;
            right: 0;
            top: 100%;
            margin-top: 8px;
            width: 220px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.12);
            border: 1px solid #e8e8e8;
            z-index: 100;
            display: none;
            overflow: hidden;
        }

        .user-dropdown-menu.show {
            display: block;
        }

        .user-dropdown-menu .dropdown-header {
            padding: 14px 16px;
            border-bottom: 1px solid #f0f0f0;
        }

        .user-dropdown-menu .dropdown-header .user-name {
            font-weight: 600;
            font-size: 14px;
            color: var(--text-primary);
        }

        .user-dropdown-menu .dropdown-header .user-email {
            font-size: 12px;
            color: var(--text-secondary);
            margin-top: 2px;
        }

        .user-dropdown-menu .dropdown-header .user-role {
            display: inline-block;
            margin-top: 6px;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            background: #e3f2fd;
            color: #1565c0;
            text-transform: capitalize;
        }

        .user-dropdown-menu a,
        .user-dropdown-menu button {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 16px;
            font-size: 13px;
            color: var(--text-primary);
            text-decoration: none;
            transition: background 0.15s;
            border: none;
            background: none;
            cursor: pointer;
            width: 100%;
            text-align: left;
        }

        .user-dropdown-menu a:hover,
        .user-dropdown-menu button:hover {
            background: #f5f7fa;
        }

        .user-dropdown-menu .dropdown-divider {
            height: 1px;
            background: #f0f0f0;
            margin: 0;
        }

        .user-dropdown-menu .logout-btn {
            color: #c62828;
        }

        .user-dropdown-menu .logout-btn:hover {
            background: #ffebee;
        }

        /* Overlay for mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.4);
            z-index: 35;
        }

        .sidebar-overlay.show {
            display: block;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-220px);
                z-index: 40;
            }

            .sidebar.mobile-open {
                transform: translateX(0);
                width: 220px;
            }

            .main-content {
                margin-left: 0 !important;
            }
        }
    </style>
</head>
<body style="font-family: var(--font-family); background: var(--body-bg); margin: 0;">

    {{-- Sidebar Overlay (Mobile) --}}
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    {{-- Sidebar --}}
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 80px; margin-bottom: 3px;">

        </div>
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="menu-icon"></span> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('admin.venues.create') }}" class="{{ request()->routeIs('admin.venues.create') ? 'active' : '' }}">
                    <span class="menu-icon"></span> Add Venue
                </a>
            </li>
            <li>
                <a href="{{ route('admin.venues.index') }}" class="{{ request()->routeIs('admin.venues.index') ? 'active' : '' }}">
                    <span class="menu-icon"></span> Manage Venues
                </a>
            </li>
            <li>
                <a href="{{ route('admin.bookings.index') }}" class="{{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">
                    <span class="menu-icon"></span> Manage Bookings
                </a>
            </li>
            <li>
                <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <span class="menu-icon"></span> Manage Users
                </a>
            </li>
            <li>
                <a href="{{ route('admin.bookings.calendar') }}" class="{{ request()->routeIs('admin.bookings.calendar') ? 'active' : '' }}">
                    <span class="menu-icon"></span> Calendar
                </a>
            </li>
        </ul>
    </aside>

    {{-- Main Content --}}
    <div class="main-content" id="mainContent">
        {{-- Top Bar --}}
        <div class="top-bar">
            <div style="display: flex; align-items: center; gap: 15px;">
                {{-- Sidebar Toggle Button --}}
                <button class="sidebar-toggle" onclick="toggleSidebar()" title="Toggle Sidebar">
                    <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <span class="welcome-text">Welcome, {{ Auth::user()->first_name }} </span>
            </div>

            <div style="display: flex; align-items: center; gap: 15px;">
                <span style="font-size: 13px; color: var(--text-secondary);">{{ now()->format('D, d M Y') }}</span>

                {{-- User Dropdown --}}
                <div class="user-dropdown" id="userDropdown">
                    <button class="user-dropdown-btn" onclick="toggleUserDropdown()">
                        <div class="user-avatar">
                            {{ strtoupper(substr(Auth::user()->first_name, 0, 1)) }}{{ strtoupper(substr(Auth::user()->last_name, 0, 1)) }}
                        </div>
                        <div style="text-align: left; line-height: 1.3;">
                            <div style="font-weight: 600; font-size: 13px;">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
                            <div style="font-size: 11px; color: var(--text-secondary);">{{ ucfirst(Auth::user()->role) }}</div>
                        </div>
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="opacity: 0.5;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    {{-- Dropdown Menu --}}
                    <div class="user-dropdown-menu" id="userDropdownMenu">
                        <div class="dropdown-header">
                            <div class="user-name">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
                            <div class="user-email">{{ Auth::user()->email }}</div>
                            <span class="user-role">{{ Auth::user()->role }}</span>
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

        {{-- Content --}}
        <div class="content-area">
            @yield('content')
        </div>
    </div>

    {{-- JavaScript --}}
    <script>
        // Sidebar Toggle
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            var mainContent = document.getElementById('mainContent');
            var overlay = document.getElementById('sidebarOverlay');

            // Desktop
            if (window.innerWidth > 768) {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
            } else {
                // Mobile
                sidebar.classList.toggle('mobile-open');
                overlay.classList.toggle('show');
            }
        }

        // User Dropdown Toggle
        function toggleUserDropdown() {
            var menu = document.getElementById('userDropdownMenu');
            menu.classList.toggle('show');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            var dropdown = document.getElementById('userDropdown');
            var menu = document.getElementById('userDropdownMenu');

            if (dropdown && !dropdown.contains(event.target)) {
                menu.classList.remove('show');
            }
        });

        // Close sidebar overlay on resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                document.getElementById('sidebarOverlay').classList.remove('show');
                document.getElementById('sidebar').classList.remove('mobile-open');
            }
        });
    </script>

</body>
</html>