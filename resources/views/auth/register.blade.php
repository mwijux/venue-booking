<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jisajili - {{ config('app.name', 'VenueBook') }}</title>
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
            <a href="{{ route('register') }}" class="auth-nav-link active">Register</a>
        </div>
    </nav>

    <!-- Register Form -->
    <div class="auth-container">
        <div class="auth-card wide">

            <!-- Header -->
            <div class="auth-header">
                <h1 class="auth-header-title">Create Account</h1>
                <p class="auth-header-subtitle">Register to start using the venue booking system</p>
            </div>

            <!-- Form -->
            <div class="auth-body-content">

                @if(session('status'))
                    <div class="auth-alert auth-alert-success">
                        ✅ {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- First Name & Last Name -->
                    <div class="auth-form-row">
                        <div class="auth-form-group">
                            <label class="auth-label">First Name</label>
                            <input type="text" name="first_name" value="{{ old('first_name') }}" class="auth-input" placeholder="Example: Antidius" required>
                            @error('first_name')
                                <p class="auth-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="auth-form-group">
                            <label class="auth-label">Last Name</label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}" class="auth-input" placeholder="Example: Mwijage" required>
                            @error('last_name')
                                <p class="auth-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Email & Phone -->
                    <div class="auth-form-row">
                        <div class="auth-form-group">
                            <label class="auth-label"> Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="auth-input" placeholder="example@email.com" required>
                            @error('email')
                                <p class="auth-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="auth-form-group">
                            <label class="auth-label">Phone Number</label>
                            <input type="text" name="phone_number" value="{{ old('phone_number') }}" class="auth-input" placeholder="07XXXXXXXX" maxlength="10" required>
                            @error('phone_number')
                                <p class="auth-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Role Selection -->
                    <div class="auth-form-group">
                        <label class="auth-label">Register As?</label>
                        <select name="role" id="roleSelect" class="auth-select" onchange="toggleConditionalFields()" required>
                            <option value="">-- Select Account Type --</option>
                            <option value="student" {{ old('role') === 'student' ? 'selected' : '' }}> Student</option>
                            <option value="lecturer" {{ old('role') === 'lecturer' ? 'selected' : '' }}> Lecturer</option>
                            <option value="guest" {{ old('role') === 'guest' ? 'selected' : '' }}> From Other Institution (Guest)</option>
                        </select>
                        @error('role')
                            <p class="auth-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Conditional: Student Reg Number -->
                    <div class="auth-conditional" id="studentField">
                        <label class="auth-conditional-label"> Registration Number</label>
                        <input type="text" name="reg_number" value="{{ old('reg_number') }}" class="auth-input" placeholder="Example: 14320004/T.23">
                        @error('reg_number')
                            <p class="auth-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Conditional: Lecturer Staff ID -->
                    <div class="auth-conditional" id="lecturerField">
                        <label class="auth-conditional-label">Staff ID/Check number</label>
                        <input type="text" name="staff_id" value="{{ old('staff_id') }}" class="auth-input" placeholder="Example: 113188121">
                        @error('staff_id')
                            <p class="auth-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Conditional: Guest Organisation -->
                    <div class="auth-conditional" id="guestField">
                        <label class="auth-conditional-label"> Institution/Organisation name</label>
                        <input type="text" name="organisation" value="{{ old('organisation') }}" class="auth-input" placeholder="Example: Wizara ya Elimu">
                        @error('organisation')
                            <p class="auth-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="auth-form-row">
                        <div class="auth-form-group">
                            <label class="auth-label">Password</label>
                            <input type="password" name="password" class="auth-input" placeholder="••••••••" required>
                            <p class="auth-password-hint">Atleast 8 character</p>
                            @error('password')
                                <p class="auth-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="auth-form-group">
                            <label class="auth-label">Confirm Pasword</label>
                            <input type="password" name="password_confirmation" class="auth-input" placeholder="••••••••" required>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="auth-btn">
                        Register
                    </button>
                </form>
            </div>

            <!-- Footer -->
            <div class="auth-footer">
                <p class="auth-footer-text">
                    Already Have an Account? 
                    <a href="{{ route('login') }}" class="auth-footer-link">Login Here</a>
                </p>
            </div>

        </div>
    </div>

    <!-- JavaScript: Kuonyesha/kuficha fields kulingana na role -->
    <script>
        function toggleConditionalFields() {
            var role = document.getElementById('roleSelect').value;

            // Ficha fields zote kwanza
            document.getElementById('studentField').classList.remove('show');
            document.getElementById('lecturerField').classList.remove('show');
            document.getElementById('guestField').classList.remove('show');

            // Onyesha field inayofaa kulingana na role
            if (role === 'student') {
                document.getElementById('studentField').classList.add('show');
            } else if (role === 'lecturer') {
                document.getElementById('lecturerField').classList.add('show');
            } else if (role === 'guest') {
                document.getElementById('guestField').classList.add('show');
            }
        }

        // Ikiwa kuna old value (baada ya validation error), onyesha field husika
        document.addEventListener('DOMContentLoaded', function() {
            toggleConditionalFields();
        });
    </script>

</body>
</html>