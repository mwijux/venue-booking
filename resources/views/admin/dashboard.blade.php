@extends('layouts.admin')

@section('content')

{{-- Page Header --}}
<div class="dashboard-header">
    <h1> Admin Dashboard Overview to see what's happening in your system.</h1>
    <p>. </p>
</div>

{{-- Statistics Cards --}}
<div class="dashboard-stats">

    {{-- Total Users --}}
    <div class="dashboard-card">
        <div class="dashboard-card-top">
            <div class="user-action-card-icon">
                <x-icon name="users" class="icon-lg" />
            </div>
            <span class="dashboard-card-number users">{{ $stats['total_users'] }}</span>
        </div>
        <h3 class="dashboard-card-title users">Total Users</h3>
        <p class="dashboard-card-info">
            Students: {{ $stats['total_students'] }} · Lecturers: {{ $stats['total_lecturers'] }} · Guests: {{ $stats['total_guests'] }}
        </p>
    </div>

    {{-- Total Venues --}}
    <div class="dashboard-card">
        <div class="dashboard-card-top">
            <div class="user-action-card-icon">
                <x-icon name="building" class="icon-lg" />
            </div>
            <span class="dashboard-card-number venues">{{ $stats['total_venues'] }}</span>
        </div>
        <h3 class="dashboard-card-title venues">Total Venues</h3>
        <p class="dashboard-card-info">Active: {{ $stats['active_venues'] }}</p>
    </div>

    {{-- Total Bookings --}}
    <div class="dashboard-card">
        <div class="dashboard-card-top">
            <div class="user-action-card-icon">
                <x-icon name="calendar" class="icon-lg" />
            </div>
            <span class="dashboard-card-number bookings">{{ $stats['total_bookings'] }}</span>
        </div>
        <h3 class="dashboard-card-title bookings">Total Bookings</h3>
        <p class="dashboard-card-info">Confirmed: {{ $stats['confirmed_bookings'] }}</p>
    </div>

    {{-- Pending Requests --}}
    <div class="dashboard-card" onclick="window.location='{{ route('admin.users.index', ['status' => 'pending']) }}'">
        <div class="dashboard-card-top">
            <div class="user-action-card-icon">
                <x-icon name="user" class="icon-lg" />
            </div>
            <span class="dashboard-card-number pending">{{ $stats['pending_guests'] }}</span>
        </div>
        <h3 class="dashboard-card-title pending">Pending Requests</h3>
        <p class="dashboard-card-info">
            @if($stats['pending_guests'] > 0)
                <a href="{{ route('admin.users.index', ['status' => 'pending']) }}">Click to view →</a>
            @else
                No pending requests
            @endif
        </p>
    </div>

    {{-- Today's Bookings --}}
    <div class="dashboard-card">
        <div class="dashboard-card-top">
            <div class="user-action-card-icon">
                <x-icon name="calendar" class="icon-lg" />
            </div>
            <span class="dashboard-card-number today">{{ $stats['today_bookings'] }}</span>
        </div>
        <h3 class="dashboard-card-title today">Today's Bookings</h3>
        <p class="dashboard-card-info">{{ now()->format('d M Y') }}</p>
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
                <td class="font-semibold">{{ $booking->user->first_name }} {{ $booking->user->last_name }}</td>
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
                <td colspan="8" class="empty-table-message">Hakuna bookings bado.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection