@extends('layouts.admin')

@section('content')

<div style="margin-bottom: 25px;">
    <h1 style="font-size: 24px; font-weight: 700; color: var(--text-primary); margin: 0;">User Details</h1>
</div>

<div class="table-card" style="max-width: 700px;">
    <div style="padding: 30px;">

        {{-- User Avatar --}}
        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 25px; padding-bottom: 20px; border-bottom: 1px solid #eee;">
            <div style="width: 60px; height: 60px; border-radius: 50%; background: var(--sidebar-bg); color: white; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 20px;">
                {{ strtoupper(substr($user->first_name, 0, 1)) }}{{ strtoupper(substr($user->last_name, 0, 1)) }}
            </div>
            <div>
                <h2 style="font-size: 20px; font-weight: 700; color: var(--text-primary); margin: 0;">{{ $user->first_name }} {{ $user->last_name }}</h2>
                <span class="badge badge-{{ $user->role }}" style="margin-top: 5px;">{{ ucfirst($user->role) }}</span>
                @if($user->status === 'active')
                    <span class="badge badge-active" style="margin-left: 5px;">Active</span>
                @else
                    <span class="badge badge-pending" style="margin-left: 5px;">Pending</span>
                @endif
            </div>
        </div>

        {{-- Details --}}
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div>
                <p style="font-size: 12px; font-weight: 600; color: var(--text-secondary); text-transform: uppercase; margin-bottom: 4px;">Email</p>
                <p style="font-size: 15px; color: var(--text-primary);">{{ $user->email }}</p>
            </div>
            <div>
                <p style="font-size: 12px; font-weight: 600; color: var(--text-secondary); text-transform: uppercase; margin-bottom: 4px;">Phone Number</p>
                <p style="font-size: 15px; color: var(--text-primary);">{{ $user->phone_number }}</p>
            </div>

            @if($user->role === 'student' && $user->reg_number)
            <div>
                <p style="font-size: 12px; font-weight: 600; color: var(--text-secondary); text-transform: uppercase; margin-bottom: 4px;">Registration Number</p>
                <p style="font-size: 15px; color: var(--text-primary);">{{ $user->reg_number }}</p>
            </div>
            @elseif($user->role === 'lecturer' && $user->staff_id)
            <div>
                <p style="font-size: 12px; font-weight: 600; color: var(--text-secondary); text-transform: uppercase; margin-bottom: 4px;">Staff ID</p>
                <p style="font-size: 15px; color: var(--text-primary);">{{ $user->staff_id }}</p>
            </div>
            @elseif($user->role === 'guest' && $user->organisation)
            <div>
                <p style="font-size: 12px; font-weight: 600; color: var(--text-secondary); text-transform: uppercase; margin-bottom: 4px;">Organisation</p>
                <p style="font-size: 15px; color: var(--text-primary);">{{ $user->organisation }}</p>
            </div>
            @endif

            <div>
                <p style="font-size: 12px; font-weight: 600; color: var(--text-secondary); text-transform: uppercase; margin-bottom: 4px;">Registration Date</p>
                <p style="font-size: 15px; color: var(--text-primary);">{{ $user->created_at->format('d M Y, H:i') }}</p>
            </div>
        </div>

        {{-- Actions --}}
        <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 30px; border-top: 1px solid #eee; padding-top: 20px;">
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline btn-lg">← Back</a>

            @if($user->status === 'pending')
                <form action="{{ route('admin.users.approve', $user) }}" method="POST" style="display:inline;">
                    @csrf @method('PATCH')
                    <button type="submit" class="btn btn-success btn-lg">✅ Approve</button>
                </form>
            @else
                <form action="{{ route('admin.users.suspend', $user) }}" method="POST" style="display:inline;">
                    @csrf @method('PATCH')
                    <button type="submit" class="btn btn-warning btn-lg">⏸️ Suspend</button>
                </form>
            @endif

            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;"
                  onsubmit="return confirm('Are you sure?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-delete btn-lg">Delete</button>
            </form>
        </div>
    </div>
</div>

@endsection