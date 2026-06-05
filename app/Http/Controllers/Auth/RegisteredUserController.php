<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\GuestPendingApprovalNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->merge([
            'first_name' => Str::upper(Str::squish($request->input('first_name', ''))),
            'last_name' => Str::upper(Str::squish($request->input('last_name', ''))),
            'email' => Str::lower(trim($request->input('email', ''))),
            'phone_number' => trim($request->input('phone_number', '')),
            'reg_number' => $request->filled('reg_number') ? Str::upper(Str::squish($request->input('reg_number'))) : null,
            'staff_id' => $request->filled('staff_id') ? Str::upper(Str::squish($request->input('staff_id'))) : null,
            'organisation' => $request->filled('organisation') ? Str::title(Str::lower(Str::squish($request->input('organisation')))) : null,
        ]);

        $request->validate([
            'first_name' => ['required', 'string', 'min:3', 'max:100', 'regex:/^[\pL\s]+$/u'],
            'last_name' => ['required', 'string', 'min:3', 'max:100', 'regex:/^[\pL\s]+$/u'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone_number' => ['required', 'digits:10', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:student,lecturer,guest'],
            'reg_number' => ['required_if:role,student', 'nullable', 'string', 'max:100', 'unique:users,reg_number'],
            'staff_id' => ['required_if:role,lecturer', 'nullable', 'string', 'max:100', 'unique:users,staff_id'],
            'organisation' => ['required_if:role,guest', 'nullable', 'string', 'max:255'],
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'reg_number' => $request->reg_number,
            'staff_id' => $request->staff_id,
            'organisation' => $request->organisation,
            'status' => $request->role === 'guest' ? 'pending' : 'active',
        ]);

        event(new Registered($user));

        if ($user->status === 'pending') {
            $admins = User::where('role', 'admin')->where('status', 'active')->get();
            Notification::send($admins, new GuestPendingApprovalNotification($user));

            return redirect()->route('login')
                ->with('status', 'Registration complete. Your account is waiting for admin approval.');
        }

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
