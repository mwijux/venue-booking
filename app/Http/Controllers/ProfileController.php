<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $request->merge([
            'first_name' => Str::upper(Str::squish($request->input('first_name', ''))),
            'last_name' => Str::upper(Str::squish($request->input('last_name', ''))),
            'email' => Str::lower(trim($request->input('email', ''))),
            'phone_number' => trim($request->input('phone_number', '')),
        ]);

        $request->validate([
            'first_name'    => ['required', 'string', 'min:3', 'max:255', 'regex:/^[\pL\s]+$/u'],
            'last_name'     => ['required', 'string', 'min:3', 'max:255', 'regex:/^[\pL\s]+$/u'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $request->user()->id],
            'phone_number'  => ['required', 'string', 'size:10', 'unique:users,phone_number,' . $request->user()->id],
        ]);

        $request->user()->fill([
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'email'         => $request->email,
            'phone_number'  => $request->phone_number,
        ]);

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
