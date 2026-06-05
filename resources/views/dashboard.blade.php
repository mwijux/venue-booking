@extends('layouts.user')

@section('content')

@if(session('status'))
    <div class="alert alert-success">
        <x-icon name="check" /> {{ session('status') }}
    </div>
@endif

<div class="page-header">
    <div>
        <h1 class="page-title">Dashboard</h1>
        <p class="page-subtitle">Welcome to the venue booking system. Choose what you want to do.</p>
    </div>
</div>

<div class="user-action-cards">
    <a href="{{ route('bookings.create') }}" class="user-action-card">
        <div class="user-action-card-icon">
            <x-icon name="calendar" class="icon-lg" />
        </div>
        <h3>Book Venue</h3>
        <p>Choose a venue, date, and time that works for you.</p>
    </a>

    <a href="{{ route('bookings.index') }}" class="user-action-card">
        <div class="user-action-card-icon">
            <x-icon name="clipboard" class="icon-lg" />
        </div>
        <h3>My Bookings</h3>
        <p>View, manage, or cancel your bookings.</p>
    </a>

    <a href="{{ route('profile.edit') }}" class="user-action-card">
        <div class="user-action-card-icon">
            <x-icon name="user" class="icon-lg" />
        </div>
        <h3>My Profile</h3>
        <p>Update your profile information and password.</p>
    </a>
</div>

<div class="table-card">
    <div class="table-header">
        <h3>Recent Bookings</h3>
        <a href="{{ route('bookings.index') }}" class="btn btn-primary btn-lg">
            View All <x-icon name="arrow-right" class="icon-sm" />
        </a>
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
                    <td class="cell-strong">{{ $booking->venue->name }}</td>
                    <td>{{ $booking->booking_date->format('d M Y') }}</td>
                    <td>{{ date('h:i A', strtotime($booking->start_time)) }} - {{ date('h:i A', strtotime($booking->end_time)) }}</td>
                    <td>{{ Str::limit($booking->purpose ?? 'N/A', 30) }}</td>
                    <td>
                        <span class="badge badge-{{ $booking->status === 'confirmed' ? 'confirmed' : 'cancelled' }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="empty-cell">
                        <div class="empty-state">
                            <x-icon name="calendar" />
                            <div class="empty-state-title">No bookings yet</div>
                            <div class="empty-state-desc">Use the Book Venue card to create your first booking.</div>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
