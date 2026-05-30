@extends('layouts.admin')

@section('content')

<div style="margin-bottom: 25px;">
    <h1 style="font-size: 24px; font-weight: 700; color: var(--text-primary); margin: 0;"> Admin Dashboard Overview</h1>
    <p style="color: var(--text-secondary); font-size: 14px; margin-top: 5px;">Welcome back! Here is what's happening in your system.</p>
</div>

{{-- Statistics Cards --}}
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px;">

    {{-- Total Users --}}
    <div style="background: #ffffff; border: 1px solid #e8e8e8; border-radius: 12px; padding: 25px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); transition: all 0.3s ease; cursor: pointer;"
         onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 30px rgba(0,0,0,0.1)';"
         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(0,0,0,0.06)';">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 15px;">
            <div style="width: 50px; height: 50px; border-radius: 12px; background: #eef2ff; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                
            </div>
            <span style="font-size: 28px; font-weight: 800; color: #4f46e5;">{{ $stats['total_users'] }}</span>
        </div>
        <h3 style="font-size: 14px; font-weight: 600; color: #1e1b4b; margin-bottom: 4px;">Total Users</h3>
        <p style="font-size: 12px; color: #6b7280;">
            Students: {{ $stats['total_students'] }} · Lecturers: {{ $stats['total_lecturers'] }} · Guests: {{ $stats['total_guests'] }}
        </p>
    </div>

    {{-- Total Venues --}}
    <div style="background: #ffffff; border: 1px solid #e8e8e8; border-radius: 12px; padding: 25px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); transition: all 0.3s ease; cursor: pointer;"
         onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 30px rgba(0,0,0,0.1)';"
         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(0,0,0,0.06)';">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 15px;">
            <div style="width: 50px; height: 50px; border-radius: 12px; background: #fdf2f8; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                
            </div>
            <span style="font-size: 28px; font-weight: 800; color: #000000;">{{ $stats['total_venues'] }}</span>
        </div>
        <h3 style="font-size: 14px; font-weight: 600; color: #000000; margin-bottom: 4px;">Total Venues</h3>
        <p style="font-size: 12px; color: #6b7280;">
            Active: {{ $stats['active_venues'] }}
        </p>
    </div>

    {{-- Total Bookings --}}
    <div style="background: #ffffff; border: 1px solid #e8e8e8; border-radius: 12px; padding: 25px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); transition: all 0.3s ease; cursor: pointer;"
         onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 30px rgba(0,0,0,0.1)';"
         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(0,0,0,0.06)';">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 15px;">
            <div style="width: 50px; height: 50px; border-radius: 12px; background: #ecfdf5; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                
            </div>
            <span style="font-size: 28px; font-weight: 800; color: #059669;">{{ $stats['total_bookings'] }}</span>
        </div>
        <h3 style="font-size: 14px; font-weight: 600; color: #064e3b; margin-bottom: 4px;">Total Bookings</h3>
        <p style="font-size: 12px; color: #6b7280;">
            Confirmed: {{ $stats['confirmed_bookings'] }}
        </p>
    </div>

    {{-- Pending Requests --}}
        <div style="background: #ffffff; border: 1px solid #e8e8e8; border-radius: 12px; padding: 25px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); transition: all 0.3s ease; cursor: pointer;"
             onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 30px rgba(0,0,0,0.1)';"
             onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(0,0,0,0.06)';">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 15px;">
                <div style="width: 50px; height: 50px; border-radius: 12px; background: #fff7ed; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                    
                </div>
                <span style="font-size: 28px; font-weight: 800; color: #ea580c;">{{ $stats['pending_guests'] }}</span>
            </div>
            <h3 style="font-size: 14px; font-weight: 600; color: #7c2d12; margin-bottom: 4px;">Pending Requests</h3>
            <p style="font-size: 12px; color: #6b7280;">
                @if($stats['pending_guests'] > 0)
                    Click to view →
                @else
                    No pending requests
                @endif
            </p>
        </div>
    

    {{-- Today's Bookings --}}
    <div style="background: #ffffff; border: 1px solid #e8e8e8; border-radius: 12px; padding: 25px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); transition: all 0.3s ease; cursor: pointer;"
         onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 30px rgba(0,0,0,0.1)';"
         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(0,0,0,0.06)';">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 15px;">
            <div style="width: 50px; height: 50px; border-radius: 12px; background: #eff6ff; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                
            </div>
            <span style="font-size: 28px; font-weight: 800; color: #2563eb;">{{ $stats['today_bookings'] }}</span>
        </div>
        <h3 style="font-size: 14px; font-weight: 600; color: #1e3a5f; margin-bottom: 4px;">Today's Bookings</h3>
        <p style="font-size: 12px; color: #6b7280;">
            {{ now()->format('d M Y') }}
        </p>
    </div>

</div>

{{-- Recent Bookings Table --}}
<div class="table-card">
    <div class="table-header">
        <h3> Recent Bookings</h3>
        <a href="{{ route('admin.bookings.index') }}" class="btn btn-primary btn-lg">View All →</a>
    </div>
    <table class="data-table">
        <thead>
            <tr>
                <th>S/N</th>
                <th>User</th>
                <th>Role</th>
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
                <td style="font-weight: 600;">{{ $booking->user->first_name }} {{ $booking->user->last_name }}</td>
                <td><span class="badge badge-{{ $booking->user->role }}">{{ ucfirst($booking->user->role) }}</span></td>
                <td>{{ $booking->venue->name }}</td>
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
                <td colspan="8" style="text-align: center; padding: 40px; color: var(--text-secondary);">
                    Hakuna bookings bado.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection