<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'venue_id',
        'booking_date',
        'start_time',
        'end_time',
        'purpose',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'booking_date' => 'date',
    ];

    /**
     * Get the user that owns the booking.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the venue that is booked.
     */
    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    /**
     * Check if a venue is available for a given time slot.
     */
    public static function isVenueAvailable($venueId, $date, $startTime, $endTime, $excludeBookingId = null)
    {
        $query = self::where('venue_id', $venueId)
            ->where('booking_date', $date)
            ->where('status', 'confirmed')
            ->where(function ($q) use ($startTime, $endTime) {
                // Check for any overlap
                $q->where('start_time', '<', $endTime)
                  ->where('end_time', '>', $startTime);
            });

        // If we are updating a booking, we exclude its own ID from the check
        if ($excludeBookingId) {
            $query->where('id', '!=', $excludeBookingId);
        }

        return !$query->exists();
    }
}