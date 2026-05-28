@extends(auth()->user()->role === 'admin' ? 'layouts.admin' : 'layouts.user')

@section('content')

<div style="margin-bottom: 25px;">
    <h1 style="font-size: 24px; font-weight: 700; color: var(--text-primary); margin: 0;">My Profile</h1>
    <p style="color: var(--text-secondary); font-size: 14px; margin-top: 5px;">Edit your personal information and password.</p>
</div>

@if(session('status') === 'profile-updated')
    <div style="background: #e8f5e9; border-left: 4px solid #2e7d32; color: #2e7d32; padding: 12px 18px; border-radius: 0 8px 8px 0; margin-bottom: 20px; font-weight: 500;">
        ✅ Your information has been successfully updated!
    </div>
@endif

@if(session('status') === 'password-updated')
    <div style="background: #e8f5e9; border-left: 4px solid #2e7d32; color: #2e7d32; padding: 12px 18px; border-radius: 0 8px 8px 0; margin-bottom: 20px; font-weight: 500;">
        ✅ Your password has been changed successfully!
    </div>
@endif

<div style="display: grid; grid-template-columns: 1fr; gap: 25px; max-width: 800px;">

    {{-- SEHEMU 1: Taarifa za Mtumiaji --}}
    <div class="table-card">
        <div style="padding: 18px 24px; border-bottom: 1px solid #eee;">
            <h3 style="font-size: 16px; font-weight: 700; color: var(--text-primary); margin: 0;">My Information</h3>
        </div>
        <div style="padding: 25px;">
            <div style="display: flex; align-items: center; gap: 18px; margin-bottom: 25px; padding-bottom: 20px; border-bottom: 1px solid #f0f0f0;">
                <div style="width: 65px; height: 65px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 22px; flex-shrink: 0;">
                    {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}{{ strtoupper(substr(auth()->user()->last_name, 0, 1)) }}
                </div>
                <div>
                    <h2 style="font-size: 20px; font-weight: 700; color: var(--text-primary); margin: 0;">
                        {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                    </h2>
                    <div style="display: flex; gap: 8px; margin-top: 6px; flex-wrap: wrap;">
                        <span class="badge badge-{{ auth()->user()->role }}">{{ ucfirst(auth()->user()->role) }}</span>
                        @if(auth()->user()->status === 'active')
                            <span class="badge badge-active">Active</span>
                        @else
                            <span class="badge badge-pending">Pending</span>
                        @endif
                    </div>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div>
                    <p style="font-size: 11px; font-weight: 600; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Email</p>
                    <p style="font-size: 15px; color: var(--text-primary); font-weight: 500;">{{ auth()->user()->email }}</p>
                </div>
                <div>
                    <p style="font-size: 11px; font-weight: 600; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Phone Number</p>
                    <p style="font-size: 15px; color: var(--text-primary); font-weight: 500;">{{ auth()->user()->phone_number }}</p>
                </div>

                @if(auth()->user()->role === 'student' && auth()->user()->reg_number)
                <div>
                    <p style="font-size: 11px; font-weight: 600; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Reg Number</p>
                    <p style="font-size: 15px; color: var(--text-primary); font-weight: 500;">{{ auth()->user()->reg_number }}</p>
                </div>
                @elseif(auth()->user()->role === 'lecturer' && auth()->user()->staff_id)
                <div>
                    <p style="font-size: 11px; font-weight: 600; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Staff ID</p>
                    <p style="font-size: 15px; color: var(--text-primary); font-weight: 500;">{{ auth()->user()->staff_id }}</p>
                </div>
                @elseif(auth()->user()->role === 'guest' && auth()->user()->organisation)
                <div>
                    <p style="font-size: 11px; font-weight: 600; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Organisation</p>
                    <p style="font-size: 15px; color: var(--text-primary); font-weight: 500;">{{ auth()->user()->organisation }}</p>
                </div>
                @endif

                <div>
                    <p style="font-size: 11px; font-weight: 600; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Registration Date</p>
                    <p style="font-size: 15px; color: var(--text-primary); font-weight: 500;">{{ auth()->user()->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- SEHEMU 2: Badilisha Taarifa --}}
    <div class="table-card">
        <div style="padding: 18px 24px; border-bottom: 1px solid #eee;">
            <h3 style="font-size: 16px; font-weight: 700; color: var(--text-primary); margin: 0;">Change Information</h3>
        </div>
        <div style="padding: 25px;">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="first_name" value="{{ old('first_name', auth()->user()->first_name) }}" class="form-control" required>
                        @error('first_name')
                            <p style="color: #c62828; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="last_name" value="{{ old('last_name', auth()->user()->last_name) }}" class="form-control" required>
                        @error('last_name')
                            <p style="color: #c62828; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="form-control" required>
                    @error('email')
                        <p style="color: #c62828; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone_number" value="{{ old('phone_number', auth()->user()->phone_number) }}" class="form-control" maxlength="10" required>
                    @error('phone_number')
                        <p style="color: #c62828; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="display: flex; justify-content: flex-end; margin-top: 20px;">
                    <button type="submit" class="btn btn-primary btn-lg">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    {{-- SEHEMU 3: Badilisha Password --}}
    <div class="table-card">
        <div style="padding: 18px 24px; border-bottom: 1px solid #eee;">
            <h3 style="font-size: 16px; font-weight: 700; color: var(--text-primary); margin: 0;">Badilisha Password</h3>
        </div>
        <div style="padding: 25px;">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <div class="form-group">
                    <label>Password ya Sasa</label>
                    <input type="password" name="current_password" class="form-control" placeholder="Ingiza password ya sasa" required>
                    @error('current_password', 'updatePassword')
                        <p style="color: #c62828; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="form-group">
                        <label>Password Mpya</label>
                        <input type="password" name="password" class="form-control" placeholder="Ingiza password mpya" required>
                        @error('password', 'updatePassword')
                            <p style="color: #c62828; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Thibitisha Password Mpya</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Rudia password mpya" required>
                    </div>
                </div>

                <div style="display: flex; justify-content: flex-end; margin-top: 20px;">
                    <button type="submit" class="btn btn-warning btn-lg">Change Password</button>
                </div>
            </form>
        </div>
    </div>

    {{-- SEHEMU 4: Futa Akaunti (User wa kawaida tu) --}}
    @if(auth()->user()->role !== 'admin')
    <div class="table-card" style="border: 1px solid #ffcdd2;">
        <div style="padding: 18px 24px; border-bottom: 1px solid #ffcdd2; background: #fff5f5;">
            <h3 style="font-size: 16px; font-weight: 700; color: #c62828; margin: 0;">Danger - delete account</h3>
        </div>
        <div style="padding: 25px;">
            <p style="font-size: 14px; color: var(--text-secondary); margin-bottom: 20px; line-height: 1.6;">
                Ukifuta akaunti yako, data zako zote zitapotea na <strong>hazitaweza kurejeshwa</strong>.
            </p>

            <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('TAHADHARI! Una uhakika unataka kufuta akaunti yako?')">
                @csrf
                @method('delete')

                <div class="form-group">
                    <label style="color: #c62828;">Ingiza password yako kuthibitisha</label>
                    <input type="password" name="password" class="form-control" style="border-color: #ffcdd2; max-width: 400px;" placeholder="Password yako" required>
                    @error('password', 'userDeletion')
                        <p style="color: #c62828; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="margin-top: 15px;">
                    <button type="submit" class="btn btn-danger btn-lg">Futa Akaunti Yangu</button>
                </div>
            </form>
        </div>
    </div>
    @endif

</div>

@endsection