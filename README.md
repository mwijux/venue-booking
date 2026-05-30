#  VenueBooking System

A modern, full-featured **Online Venue Booking System** built with **Laravel 11** for educational institutions. The system allows students, lecturers, and external guests to book venues (halls, classrooms, meeting rooms) within a university campus.

![Laravel](https://img.shields.io/badge/Laravel-11-red?style=flat-square&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.3-blue?style=flat-square&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-Database-orange?style=flat-square&logo=mysql)
![Tailwind](https://img.shields.io/badge/Tailwind_CSS-Styling-06B6D4?style=flat-square&logo=tailwindcss)
![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)

---

##  Table of Contents

- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [User Roles](#-user-roles)
- [Screenshots](#-screenshots)
- [Requirements](#-requirements)
- [Installation](#-installation)
- [Configuration](#-configuration)
- [Database Schema](#-database-schema)
- [Project Structure](#-project-structure)
- [Usage Guide](#-usage-guide)
- [API Endpoints / Routes](#-routes)
- [Contributing](#-contributing)
- [Author](#-author)
- [License](#-license)

---

## ✨ Features

###  Authentication & Authorization
- User registration with role selection (Student, Lecturer, Guest)
- Secure login with hashed passwords
- Password reset via email (Gmail SMTP)
- Role-based access control (RBAC)
- Guest accounts require admin approval before access

###  User Management (Admin)
- View all registered users with filter tabs (All, Students, Lecturers, Guests, Pending)
- Search users in real-time
- Approve or suspend guest accounts
- Delete users
- View detailed user profiles
- Export user data to **CSV** and **PDF**

###  Venue Management (Admin)
- Add new venues with name, location, capacity, and description
- Edit and update venue details
- Activate/deactivate venues
- Delete venues
- Search venues
- Export venue data to **CSV** and **PDF**

###  Booking System
- Book available venues with date and time selection
- **Real-time availability check** - prevents double booking
- Auto-confirmation for Students and Lecturers
- View personal booking history
- Cancel own bookings
- Purpose/reason for booking

###  Admin Dashboard
- Statistics overview cards (Total Users, Venues, Bookings, Pending Requests, Today's Bookings)
- Recent bookings table
- Quick action links
- Real-time data counters

###  Calendar View (Admin)
- Interactive calendar powered by **FullCalendar.js**
- View all bookings on monthly, weekly, and daily views
- Color-coded events (green = confirmed, red = cancelled)
- Click events for booking details

###  Reports & Exports (Admin)
- Export Users to CSV and PDF
- Export Bookings to CSV and PDF
- Export Venues to CSV and PDF
- Professional PDF layout with tables

###  UI/UX
- Professional sidebar navigation for Admin and User
- Collapsible sidebar with toggle button
- User dropdown menu with profile and logout
- Responsive design (mobile-friendly)
- Custom CSS with easy-to-change color variables
- Clean, modern design with hover effects
- Professional welcome/landing page
- Styled login, register, and forgot password pages

###  Security
- CSRF protection on all forms
- Password hashing with bcrypt
- Role-based middleware protection
- Input validation on all forms
- SQL injection prevention via Eloquent ORM
- Title Case auto-formatting for names

---

##  Tech Stack

| Technology         |        Purpose  |
|--------------------|-----------------|
| **Laravel 11** | Backend PHP Framework |
| **Laravel Breeze** | Authentication Scaffolding |
| **MySQL** | Database |
| **Blade Templates** | Frontend Templating |
| **Tailwind CSS** | Utility-first CSS Framework |
| **Alpine.js** | Lightweight JS Framework |
| **FullCalendar.js** | Interactive Calendar |
| **DomPDF** | PDF Generation |
| **Custom CSS** | Additional Styling |
| **Laragon** | Local Development Environment |

---

##  User Roles

| Role | Registration | Booking Status | Access Level |
|------|-------------|----------------|-------------|
| **Admin** | Created via Seeder only | N/A | Full system access, CRUD operations, reports |
| **Student** | Self-registration (Reg Number required) | Auto-confirmed | Book venues, manage own bookings |
| **Lecturer** | Self-registration (Staff ID required) | Auto-confirmed | Book venues, manage own bookings |
| **Guest** | Self-registration (Organisation required) | Requires admin approval | Book venues after approval |

---

##  Screenshots

> Add your screenshots here. Place images in a `screenshots/` folder.

### Welcome Page
![Welcome Page](screenshots/welcome.png)

### Login Page
![Login](screenshots/login.png)

### Register Page
![Register](screenshots/register.png)

### Admin Dashboard
![Admin Dashboard](screenshots/admin-dashboard.png)

### Manage Users
![Manage Users](screenshots/manage-users.png)

### Manage Venues
![Manage Venues](screenshots/manage-venues.png)

### Manage Bookings
![Manage Bookings](screenshots/manage-bookings.png)

### Calendar View
![Calendar](screenshots/calendar.png)

### User Dashboard
![User Dashboard](screenshots/user-dashboard.png)

### Book Venue
![Book Venue](screenshots/book-venue.png)

### Profile Page
![Profile](screenshots/profile.png)

---

## Requirements

Before installation, make sure you have:

- **PHP** >= 8.2
- **Composer** >= 2.0
- **Node.js** >= 18.0 & **NPM**
- **MySQL** >= 8.0
- **Git**
- **Laragon** (recommended) or any local development environment

---

##  Installation

### Step 1: Clone the Repository

```bash
git clone https://github.com/mwijux/venue-booking-system.git
cd venue-booking-system

### Step 2: Install PHP Dependencies
composer install

### Step 3: Install Node Dependencies
npm install

### Step 4: Environment Setup
cp .env.example .env
php artisan key:generate

### Step 5: Configure Database
Open .env file and update database credentials:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=venue_booking
DB_USERNAME=root
DB_PASSWORD=

### Step 6: Create Database
Create a MySQL database named venue_booking:
mysql -u root -e "CREATE DATABASE venue_booking;"

### Step 7: Run Migrations
php artisan migrate

### Step 8: Seed Admin Account
php artisan db:seed --class=AdminSeeder

#Default Admin Credentials:
Email: admin@chuo.ac.tz
Password: password123
⚠️ Change the admin password immediately after first login!

### Step 9: Build Assets
npm run build

### Step 10: Start the Server
php artisan serve

#Visit: http://127.0.0.1:8000


### Configuration
Email Configuration (Gmail SMTP)
To enable password reset emails, update .env:

env

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS="your_email@gmail.com"
MAIL_FROM_NAME="VenueBooking System"
How to get Gmail App Password:

Go to Google Account Security
Enable 2-Step Verification
Go to App Passwords
Generate a new App Password for "Mail"
Use the 16-character password in MAIL_PASSWORD
Customizing Colors
All colors are customizable via CSS variables:

File	Purpose
public/css/custom.css	Admin panel colors (sidebar, tables, buttons)
public/css/user.css	User panel colors (sidebar, navigation)
public/css/welcome.css	Welcome/landing page colors
public/css/auth.css	Login, register, forgot password page colors

Example - Change admin sidebar color:
CSS

/* In public/css/custom.css */
:root {
    --sidebar-bg: #0d1b2a;        /* Sidebar background */
    --sidebar-active: #1b4965;    /* Active menu item */
    --sidebar-hover: #1b3a4b;     /* Hover effect */
}
### Database Schema
Users Table
Column	Type	Description
id	bigint	Primary key
first_name	string	User's first name (Title Case)
last_name	string	User's last name (Title Case)
email	string (unique)	User's email address
phone_number	string(10) (unique)	Phone number (10 digits)
password	string	Hashed password
role	enum	student, lecturer, guest, admin
reg_number	string (nullable, unique)	Student registration number
staff_id	string (nullable, unique)	Lecturer staff ID
organisation	string (nullable)	Guest's organisation name
status	enum	active, pending
timestamps		created_at, updated_at
Venues Table
Column	Type	Description
id	bigint	Primary key
name	string	Venue name
location	string	Venue location
capacity	integer	Maximum capacity
description	text (nullable)	Venue description
is_active	boolean	Whether venue is available
timestamps		created_at, updated_at
Bookings Table
Column	Type	Description
id	bigint	Primary key
user_id	foreignId	References users table
venue_id	foreignId	References venues table
booking_date	date	Date of booking
start_time	time	Start time
end_time	time	End time
purpose	text (nullable)	Purpose of booking
status	enum	confirmed, cancelled
timestamps		created_at, updated_at

### Project Structure
text

venue-booking-system/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   ├── AdminController.php      # Admin dashboard + stats
│   │   │   │   ├── BookingController.php     # Admin booking management
│   │   │   │   ├── ExportController.php      # CSV & PDF exports
│   │   │   │   ├── UserController.php        # User management (CRUD)
│   │   │   │   └── VenueController.php       # Venue management (CRUD)
│   │   │   ├── Auth/
│   │   │   │   ├── AuthenticatedSessionController.php
│   │   │   │   ├── RegisteredUserController.php
│   │   │   │   └── ...
│   │   │   ├── BookingController.php         # User booking operations
│   │   │   └── ProfileController.php         # Profile management
│   │   └── Middleware/
│   │       ├── CheckRole.php                 # Role-based access
│   │       └── EnsureAccountIsActive.php     # Guest approval check
│   └── Models/
│       ├── Booking.php                       # Booking model + availability check
│       ├── User.php                          # User model
│       └── Venue.php                         # Venue model
├── database/
│   ├── migrations/                           # Database schema
│   └── seeders/
│       └── AdminSeeder.php                   # Creates admin account
├── public/
│   ├── css/
│   │   ├── custom.css                        # Admin panel styles
│   │   ├── user.css                          # User panel styles
│   │   ├── welcome.css                       # Landing page styles
│   │   └── auth.css                          # Auth pages styles
│   └── images/
│       ├── logo.png                          # System logo
│       └── favicon.png                       # Browser tab icon
├── resources/views/
│   ├── admin/
│   │   ├── bookings/
│   │   │   ├── calendar.blade.php            # Calendar view
│   │   │   └── index.blade.php               # All bookings list
│   │   ├── exports/
│   │   │   ├── bookings.blade.php            # PDF template
│   │   │   ├── users.blade.php               # PDF template
│   │   │   └── venues.blade.php              # PDF template
│   │   ├── users/
│   │   │   ├── index.blade.php               # Users list
│   │   │   └── show.blade.php                # User details
│   │   ├── venues/
│   │   │   ├── create.blade.php              # Add venue form
│   │   │   ├── edit.blade.php                # Edit venue form
│   │   │   ├── index.blade.php               # Venues list
│   │   │   └── show.blade.php                # Venue details
│   │   └── dashboard.blade.php               # Admin dashboard
│   ├── auth/
│   │   ├── forgot-password.blade.php         # Forgot password
│   │   ├── login.blade.php                   # Login page
│   │   ├── register.blade.php                # Registration page
│   │   └── reset-password.blade.php          # Reset password
│   ├── bookings/
│   │   ├── create.blade.php                  # Book venue form
│   │   └── index.blade.php                   # User's bookings
│   ├── layouts/
│   │   ├── admin.blade.php                   # Admin layout (sidebar)
│   │   ├── app.blade.php                     # Base layout
│   │   └── user.blade.php                    # User layout (sidebar)
│   ├── profile/
│   │   └── edit.blade.php                    # Profile page
│   ├── dashboard.blade.php                   # User dashboard
│   └── welcome.blade.php                     # Landing page
├── routes/
│   └── web.php                               # All routes
├── .env                                      # Environment config
├── composer.json                             # PHP dependencies
├── package.json                              # Node dependencies
└── README.md                                 # This file

### Usage Guide
For Students / Lecturers
Register - Go to the registration page and select your role
Login - Use your email and password
Book Venue - Select a venue, date, and time
View Bookings - Check your booking history
Cancel Booking - Cancel any upcoming booking if needed
For Guests (External Users)
Register - Select "Guest" role and enter your organisation
Wait for Approval - Admin must approve your account
Login - Once approved, login and book venues
For Admins
Login - Use admin credentials
Dashboard - View system statistics
Manage Users - Approve guests, suspend or delete users
Manage Venues - Add, edit, or remove venues
Manage Bookings - View all bookings, cancel if needed
Calendar - Visual overview of all bookings
Export Reports - Download CSV or PDF reports

### Routes
Public Routes
Method	URI	Description
GET	/	Welcome/Landing page
GET	/login	Login page
GET	/register	Registration page
POST	/login	Process login
POST	/register	Process registration
GET	/forgot-password	Forgot password page
POST	/forgot-password	Send reset link
User Routes (Authenticated)
Method	URI	Description
GET	/dashboard	User dashboard
GET	/bookings	My bookings list
GET	/bookings/create	Book venue form
POST	/bookings	Store booking
DELETE	/bookings/{id}	Cancel booking
GET	/profile	Edit profile
Admin Routes (Admin Only)
Method	URI	Description
GET	/admin/dashboard	Admin dashboard
GET	/admin/users	All users
PATCH	/admin/users/{id}/approve	Approve user
PATCH	/admin/users/{id}/suspend	Suspend user
DELETE	/admin/users/{id}	Delete user
GET	/admin/venues	All venues
POST	/admin/venues	Create venue
PUT	/admin/venues/{id}	Update venue
DELETE	/admin/venues/{id}	Delete venue
GET	/admin/bookings	All bookings
GET	/admin/bookings/calendar	Calendar view
PATCH	/admin/bookings/{id}/cancel	Cancel booking
GET	/admin/exports/{type}/{format}	Export reports

### Contributing
Contributions are welcome! Here's how:

1. Fork the repository
2. Create a feature branch (git checkout -b feature/amazing-feature)
3. Commit your changes (git commit -m 'Add amazing feature')
4. Push to the branch (git push origin feature/amazing-feature)
5. Open a Pull Request

### Author
Antidius Mwijage

    @-GitHub: @mwijux
    @-Email: mwijux@gmail.com

### License
This project is licensed under the MIT License - see the LICENSE file for details.

### Acknowledgments
*Laravel - The PHP Framework
*Laravel Breeze - Authentication
*Tailwind CSS - Styling
*FullCalendar - Calendar Component
*DomPDF - PDF Generation
*Laragon - Development Environment

<p align="center"> Made with ❤️ for educational institutions in Tanzania 🇹🇿 </p> ```