@extends('layouts.admin')

@section('content')

<div style="margin-bottom: 25px;">
    <h1 style="font-size: 24px; font-weight: 700; color: var(--text-primary); margin: 0;">Hariri Venue: {{ $venue->name }}</h1>
    <p style="color: var(--text-secondary); font-size: 14px; margin-top: 5px;">Badilisha taarifa za venue hii.</p>
</div>

<div class="table-card" style="max-width: 700px;">
    <div style="padding: 30px;">
        <form action="{{ route('admin.venues.update', $venue) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Jina la Venue</label>
                <input type="text" name="name" value="{{ old('name', $venue->name) }}" class="form-control" required>
                @error('name')
                    <p style="color: var(--btn-danger); font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Mahali (Location)</label>
                <input type="text" name="location" value="{{ old('location', $venue->location) }}" class="form-control" required>
                @error('location')
                    <p style="color: var(--btn-danger); font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Uwezo (Capacity)</label>
                <input type="number" name="capacity" value="{{ old('capacity', $venue->capacity) }}" class="form-control" min="1" required>
                @error('capacity')
                    <p style="color: var(--btn-danger); font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Maelezo (Description)</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description', $venue->description) }}</textarea>
                @error('description')
                    <p style="color: var(--btn-danger); font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                    <input type="checkbox" name="is_active" value="1" {{ $venue->is_active ? 'checked' : '' }}
                           style="width: 18px; height: 18px; accent-color: var(--btn-primary);">
                    <span style="font-size: 14px;">Venue inatumika (Active)</span>
                </label>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 25px;">
                <a href="{{ route('admin.venues.index') }}" class="btn btn-outline btn-lg">Ghairi</a>
                <button type="submit" class="btn btn-warning btn-lg">Hifadhi Mabadiliko</button>
            </div>
        </form>
    </div>
</div>

@endsection