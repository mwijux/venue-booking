<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())
                          ->with('venue')
                          ->latest()
                          ->paginate(10);
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $venues = Venue::where('is_active', true)->orderBy('name')->get();
        return view('bookings.create', compact('venues'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'venue_id'      => ['required', 'exists:venues,id'],
            'booking_date'  => ['required', 'date', 'after_or_equal:today'],
            'start_time'    => ['required', 'date_format:H:i'],
            'end_time'      => ['required', 'date_format:H:i', 'after:start_time'],
            'purpose'       => ['nullable', 'string', 'max:500'],
        ]);

        if (!Booking::isVenueAvailable(
            $request->venue_id,
            $request->booking_date,
            $request->start_time,
            $request->end_time
        )) {
            return back()->with('error', 'This venue is already booked for the selected time. Please choose another slot.')
                         ->withInput();
        }

        Booking::create([
            'user_id'       => Auth::id(),
            'venue_id'      => $request->venue_id,
            'booking_date'  => $request->booking_date,
            'start_time'    => $request->start_time,
            'end_time'      => $request->end_time,
            'purpose'       => $request->purpose,
            'status'        => 'confirmed',
        ]);

        return redirect()->route('bookings.index')
                         ->with('success', 'Your booking has been confirmed.');
    }

    public function show(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }
        return view('bookings.show', compact('booking'));
    }

    public function destroy(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }
        $booking->update(['status' => 'cancelled']);

        return redirect()->route('bookings.index')
                         ->with('success', 'Your booking has been cancelled.');
    }
}
