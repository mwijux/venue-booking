@extends('layouts.admin')

@section('content')

<div style="margin-bottom: 25px;">
    <h1 style="font-size: 24px; font-weight: 700; color: var(--text-primary); margin: 0;">Register New Venue</h1>
    <p style="color: var(--text-secondary); font-size: 14px; margin-top: 5px;">Fill out this form to add a new venue to the system.</p>
</div>

<div class="table-card" style="max-width: 700px;">
    <div style="padding: 30px;">
        <form action="{{ route('admin.venues.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Venue Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Example: Hall A, LT 1" required>
                @error('name')
                    <p style="color: var(--btn-danger); font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Location</label>
                <input type="text" name="location" value="{{ old('location') }}" class="form-control" placeholder="Example: Building 3, Floor 2" required>
                @error('location')
                    <p style="color: var(--btn-danger); font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Capacity</label>
                <input type="number" name="capacity" value="{{ old('capacity') }}" class="form-control" placeholder="Example: 100" min="1" required>
                @error('capacity')
                    <p style="color: var(--btn-danger); font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Description - Optional</label>
                <textarea name="description" class="form-control" rows="4" placeholder="Description of this venue...">{{ old('description') }}</textarea>
                @error('description')
                    <p style="color: var(--btn-danger); font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                           style="width: 18px; height: 18px; accent-color: var(--btn-primary);">
                    <span style="font-size: 14px;">Active</span>
                </label>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 25px;">
                <a href="{{ route('admin.venues.index') }}" class="btn btn-outline btn-lg">Cancel</a>
                <button type="submit" class="btn btn-primary btn-lg">Save Venue</button>
            </div>
        </form>
    </div>
</div>

@endsection