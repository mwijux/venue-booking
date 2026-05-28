@extends('layouts.admin')

@section('content')

<div style="margin-bottom: 25px;">
    <h1 style="font-size: 24px; font-weight: 700; color: var(--text-primary); margin: 0;">Maelezo ya Venue</h1>
</div>

<div class="table-card" style="max-width: 700px;">
    <div style="padding: 30px;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div>
                <p style="font-size: 12px; font-weight: 600; color: var(--text-secondary); text-transform: uppercase; margin-bottom: 4px;">Jina la Venue</p>
                <p style="font-size: 16px; font-weight: 600; color: var(--text-primary);">{{ $venue->name }}</p>
            </div>
            <div>
                <p style="font-size: 12px; font-weight: 600; color: var(--text-secondary); text-transform: uppercase; margin-bottom: 4px;">Mahali</p>
                <p style="font-size: 16px; color: var(--text-primary);">{{ $venue->location }}</p>
            </div>
            <div>
                <p style="font-size: 12px; font-weight: 600; color: var(--text-secondary); text-transform: uppercase; margin-bottom: 4px;">Uwezo</p>
                <p style="font-size: 16px; color: var(--text-primary);">{{ $venue->capacity }} watu</p>
            </div>
            <div>
                <p style="font-size: 12px; font-weight: 600; color: var(--text-secondary); text-transform: uppercase; margin-bottom: 4px;">Hali</p>
                @if($venue->is_active)
                    <span class="badge badge-active">Active</span>
                @else
                    <span class="badge badge-cancelled">Inactive</span>
                @endif
            </div>
        </div>

        <div style="margin-top: 20px;">
            <p style="font-size: 12px; font-weight: 600; color: var(--text-secondary); text-transform: uppercase; margin-bottom: 4px;">Maelezo</p>
            <p style="font-size: 14px; color: var(--text-primary); line-height: 1.6;">{{ $venue->description ?? 'Hakuna maelezo' }}</p>
        </div>

        <div style="margin-top: 20px;">
            <p style="font-size: 12px; font-weight: 600; color: var(--text-secondary); text-transform: uppercase; margin-bottom: 4px;">Tarehe ya Kuongeza</p>
            <p style="font-size: 14px; color: var(--text-primary);">{{ $venue->created_at->format('d M Y, H:i') }}</p>
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 30px; border-top: 1px solid #eee; padding-top: 20px;">
            <a href="{{ route('admin.venues.index') }}" class="btn btn-outline btn-lg">← Rudi Nyuma</a>
            <a href="{{ route('admin.venues.edit', $venue) }}" class="btn btn-edit btn-lg">Hariri</a>
            <form action="{{ route('admin.venues.destroy', $venue) }}" method="POST" style="display:inline;"
                  onsubmit="return confirm('Una uhakika?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-delete btn-lg">Futa</button>
            </form>
        </div>
    </div>
</div>

@endsection