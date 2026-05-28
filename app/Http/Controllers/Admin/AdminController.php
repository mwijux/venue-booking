<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Venue;
use App\Models\Booking;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users'        => User::where('role', '!=', 'admin')->count(),
            'total_students'     => User::where('role', 'student')->count(),
            'total_lecturers'    => User::where('role', 'lecturer')->count(),
            'total_guests'       => User::where('role', 'guest')->count(),
            'pending_guests'     => User::where('role', 'guest')->where('status', 'pending')->count(),
            'total_venues'       => Venue::count(),
            'active_venues'      => Venue::where('is_active', true)->count(),
            'total_bookings'     => Booking::count(),
            'confirmed_bookings' => Booking::where('status', 'confirmed')->count(),
            'today_bookings'     => Booking::where('booking_date', today())->where('status', 'confirmed')->count(),
        ];

        $recentBookings = Booking::with(['user', 'venue'])
                                  ->latest()
                                  ->take(5)
                                  ->get();

        return view('admin.dashboard', compact('stats', 'recentBookings'));
    }
}