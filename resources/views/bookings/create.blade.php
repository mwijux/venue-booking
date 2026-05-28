@extends('layouts.user')

@section('content')

<div style="text-align: center; margin-bottom: 25px;">
    <h1 style="font-size: 24px; font-weight: 700; color: var(--text-primary); margin: 0;">Book Venue</h1>
    <p style="color: var(--text-secondary); font-size: 14px; margin-top: 5px;">Fill out this form to reserve a spot at the venue you want.</p>
</div>

@if(session('error'))
    <div style="max-width: 600px; margin: 0 auto 20px auto; background: #ffebee; border-left: 4px solid #c62828; color: #c62828; padding: 12px 18px; border-radius: 0 8px 8px 0; font-weight: 500;">
        ❌ {{ session('error') }}
    </div>
@endif

<div class="table-card" style="max-width: 600px; margin: 0 auto;">
    <div style="padding: 30px;">
        <form action="{{ route('bookings.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Select Venue</label>
                <select name="venue_id" class="form-control" required>
                    <option value="">-- Select venue --</option>
                    @foreach($venues as $venue)
                        <option value="{{ $venue->id }}" {{ old('venue_id') == $venue->id ? 'selected' : '' }}>
                            {{ $venue->name }} ({{ $venue->location }}, {{ $venue->capacity }} watu)
                        </option>
                    @endforeach
                </select>
                @error('venue_id')
                    <p style="color: #c62828; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Booking date</label>
                <input type="date" name="booking_date" value="{{ old('booking_date') }}" class="form-control" min="{{ date('Y-m-d') }}" required>
                @error('booking_date')
                    <p style="color: #c62828; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                @enderror
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div class="form-group">
                    <label>Start Time</label>
                    <input type="time" name="start_time" value="{{ old('start_time') }}" class="form-control" required>
                    @error('start_time')
                        <p style="color: #c62828; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>End Time</label>
                    <input type="time" name="end_time" value="{{ old('end_time') }}" class="form-control" required>
                    @error('end_time')
                        <p style="color: #c62828; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label>Purpose of Booking</label>
                <textarea name="purpose" class="form-control" rows="3" placeholder="Example: For Test,Lecture, Seminar...">{{ old('purpose') }}</textarea>
                @error('purpose')
                    <p style="color: #c62828; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                @enderror
            </div>

            <div style="display: flex; justify-content: center; gap: 12px; margin-top: 25px;">
                <a href="{{ route('dashboard') }}" class="btn btn-outline btn-lg">Cancel</a>
                <button type="submit" class="btn btn-primary btn-lg">Save Booking</button>
            </div>
        </form>
    </div>
</div>

@endsection