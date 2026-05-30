@extends('layouts.user')

@section('content')

@if(session('status'))
    <div style="background: #e8f5e9; border-left: 4px solid #2e7d32; color: #2e7d32; padding: 12px 18px; border-radius: 0 8px 8px 0; margin-bottom: 20px; font-weight: 500;">
         {{ session('status') }}
    </div>
@endif

<div style="margin-bottom: 25px;">
    <h1 style="font-size: 24px; font-weight: 700; color: var(--text-primary); margin: 0;"> Dashboard</h1>
    <p style="color: var(--text-secondary); font-size: 14px; margin-top: 5px;">Welcome to the venue booking system. Choose what you want to do.</p>
</div>

{{-- Quick Action Cards --}}
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px;">

    {{-- Book Venue --}}
    <div style="background: #ffffff; border: 1px solid #e8e8e8; border-radius: 12px; padding: 25px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); transition: all 0.3s ease; cursor: pointer;"
         onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 30px rgba(0,0,0,0.1)';"
         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(0,0,0,0.06)';"
         onclick="window.location='{{ route('bookings.create') }}'">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 15px;">
            <div style="width: 50px; height: 50px; border-radius: 12px; background: #eff6ff; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                
            </div>
        </div>
        <h3 style="font-size: 16px; font-weight: 700; color: #1e3a5f; margin-bottom: 6px;">Book Venue</h3>
        <p style="font-size: 13px; color: #6b7280; line-height: 1.5;">Choose a venue, date and time that suits you.</p>
    </div>

    {{-- Booking Zangu --}}
    <div style="background: #ffffff; border: 1px solid #e8e8e8; border-radius: 12px; padding: 25px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); transition: all 0.3s ease; cursor: pointer;"
         onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 30px rgba(0,0,0,0.1)';"
         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(0,0,0,0.06)';"
         onclick="window.location='{{ route('bookings.index') }}'">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 15px;">
            <div style="width: 50px; height: 50px; border-radius: 12px; background: #eef2ff; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                
            </div>
        </div>
        <h3 style="font-size: 16px; font-weight: 700; color: #1e1b4b; margin-bottom: 6px;"> My Booking</h3>
        <p style="font-size: 13px; color: #6b7280; line-height: 1.5;">View, manage or cancel your bookings</p>
    </div>

</div>

{{-- Recent Bookings Table --}}
<div class="table-card">
    <div class="table-header">
        <h3> My Recent Bookings</h3>
        <a href="{{ route('bookings.index') }}" class="btn btn-primary btn-lg">View All →</a>
    </div>
    <table class="data-table">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Venue</th>
                <th>Date</th>
                <th>Time</th>
                <th>Purpose</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentBookings as $booking)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td style="font-weight: 600;">{{ $booking->venue->name }}</td>
                <td>{{ $booking->booking_date->format('d M Y') }}</td>
                <td>{{ date('h:i A', strtotime($booking->start_time)) }} - {{ date('h:i A', strtotime($booking->end_time)) }}</td>
                <td>{{ Str::limit($booking->purpose ?? 'N/A', 30) }}</td>
                <td>
                    @if($booking->status === 'confirmed')
                        <span class="badge badge-confirmed">Confirmed</span>
                    @else
                        <span class="badge badge-cancelled">Cancelled</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 40px; color: var(--text-secondary);">
                    <div>
                        <p style="font-size: 35px; margin-bottom: 10px;">📅</p>
                        <p style="font-weight: 600; font-size: 15px; margin-bottom: 5px;">You haven't made any bookings yet.</p>
                        <p style="font-size: 13px;">Click on the "Book Venue" card to get started..</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection