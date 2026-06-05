<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Orodha ya Users wote
    public function index(Request $request)
    {
        $query = User::where('role', '!=', 'admin');

        // Filter by role
        if ($request->has('role') && $request->role !== '') {
            $query->where('role', $request->role);
        }

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $users = $query->latest()->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    // Onyesha User mmoja
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    // Approve Guest User
    public function approve(User $user)
    {
        $user->update(['status' => 'active']);

        return redirect()->route('admin.users.index')
            ->with('success', "{$user->first_name} {$user->last_name}'s account has been approved.");
    }

    // Reject/Suspend User
    public function suspend(User $user)
    {
        $user->update(['status' => 'pending']);

        return redirect()->route('admin.users.index')
            ->with('success', "{$user->first_name} {$user->last_name}'s account has been suspended.");
    }

    // Futa User
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }
}
