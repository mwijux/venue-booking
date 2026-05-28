<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name'   => ['required', 'string', 'max:100'],
            'last_name'    => ['required', 'string', 'max:100'],
            'email'        => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone_number' => ['required', 'digits:10', 'unique:'.User::class],
            'password'     => ['required', 'confirmed', Rules\Password::defaults()],
            'role'         => ['required', 'in:student,lecturer,guest'],
            'reg_number'   => ['required_if:role,student', 'nullable', 'string', 'max:100', 'unique:users,reg_number'],
            'staff_id'     => ['required_if:role,lecturer', 'nullable', 'string', 'max:100', 'unique:users,staff_id'],
            'organisation' => ['required_if:role,guest', 'nullable', 'string', 'max:255'],
        ]);

        // 🔄 Title Case Formatting (majina & taasisi)
        $firstName    = Str::title(strtolower($request->first_name));
        $lastName     = Str::title(strtolower($request->last_name));
        $organisation = $request->organisation ? Str::title(strtolower($request->organisation)) : null;
    
        // IDs usually look better in UPPERCASE, but unaweza kubadilisha kama unataka Title Case pia
        $regNumber = $request->reg_number ? strtoupper($request->reg_number) : null;
        $staffId   = $request->staff_id ? strtoupper($request->staff_id) : null;

        $user = User::create([
            'first_name'   => $firstName,
            'last_name'    => $lastName,
            'email'        => strtolower($request->email),
            'phone_number' => $request->phone_number,
            'password'     => Hash::make($request->password),
            'role'         => $request->role,
            'reg_number'   => $regNumber,
            'staff_id'     => $staffId,
            'organisation' => $organisation,
            'status'       => $request->role === 'guest' ? 'pending' : 'active',
        ]);

        event(new Registered($user));

        // 🛑 Kama ni Guest mpya, usimlogin. Mpeleke login na ujumbe.
        if ($user->status === 'pending') {
            return redirect()->route('login')
                ->with('status', 'Usajili umekamilika! Akaunti yako inasubiri kuidhinishwa na Admin. Tafadhali subiri.');
        }

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
