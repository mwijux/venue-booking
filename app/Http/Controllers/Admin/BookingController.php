<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'venue'])->latest()->paginate(15);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function calendar()
    {
        $bookings = Booking::with(['user', 'venue'])
                          ->where('status', 'confirmed')
                          ->get();
        return view('admin.bookings.calendar', compact('bookings'));
    }

    public function cancel(Booking $booking)
    {
        $booking->update(['status' => 'cancelled']);
        return redirect()->route('admin.bookings.index')
                         ->with('success', 'Booking has been cancelled.');
    }
}
