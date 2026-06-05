@extends('layouts.admin')

@section('content')

{{-- Success Message --}}
@if(session('success'))
    <div style="background: #e8f5e9; border-left: 4px solid #2e7d32; color: #2e7d32; padding: 12px 18px; border-radius: 0 8px 8px 0; margin-bottom: 20px; font-weight: 500;">
        ✅ {{ session('success') }}
    </div>
@endif

<div class="table-card">
    {{-- Search & Filter --}}
    <div class="table-controls">
        <div class="search-box">
            <svg class="search-icon" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" id="searchInput" placeholder="Search users..." onkeyup="searchTable()">
        </div>

        <div style="display: flex; gap: 10px; align-items: center;">
            <select class="filter-select" onchange="window.location.href=this.value">
                <option value="{{ route('admin.users.index') }}" {{ !request('role') && !request('status') ? 'selected' : '' }}>All Users</option>
                <option value="{{ route('admin.users.index', ['role' => 'student']) }}" {{ request('role') === 'student' ? 'selected' : '' }}>Students</option>
                <option value="{{ route('admin.users.index', ['role' => 'lecturer']) }}" {{ request('role') === 'lecturer' ? 'selected' : '' }}>Lecturers</option>
                <option value="{{ route('admin.users.index', ['role' => 'guest']) }}" {{ request('role') === 'guest' ? 'selected' : '' }}>Guests</option>
                <option value="{{ route('admin.users.index', ['status' => 'pending']) }}" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending Approval</option>
            </select>

            <a href="{{ route('admin.exports.users', 'csv') }}" class="btn btn-success">⬇ CSV</a>
            <a href="{{ route('admin.exports.users', 'pdf') }}" class="btn btn-danger">⬇ PDF</a>
        </div>
    </div>

    {{-- Table --}}
    <table class="data-table" id="usersTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Role</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td style="font-weight: 600;">{{ $user->first_name }} {{ $user->last_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone_number }}</td>
                <td><span class="badge badge-{{ $user->role }}">{{ ucfirst($user->role) }}</span></td>
                <td>
                    @if($user->status === 'active')
                        <span class="badge badge-active">Active</span>
                    @else
                        <span class="badge badge-pending">Pending</span>
                    @endif
                </td>
                <td>
                    <div style="display: flex; gap: 5px; align-items: center;">
                        <a href="{{ route('admin.users.show', $user) }}" class="btn btn-info">View</a>

                        @if($user->status === 'pending')
                            <form action="{{ route('admin.users.approve', $user) }}" method="POST" style="display:inline;">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn btn-success">Approve</button>
                            </form>
                        @else
                            <form action="{{ route('admin.users.suspend', $user) }}" method="POST" style="display:inline;">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn btn-warning">Suspend</button>
                            </form>
                        @endif

                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;"
                              onsubmit="return confirm('Una uhakika?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-delete">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 40px; color: var(--text-secondary);">
                    No users found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="custom-pagination">
        {{ $users->links() }}
    </div>
</div>

{{-- Search Script --}}
<script>
function searchTable() {
    var input = document.getElementById("searchInput").value.toUpperCase();
    var table = document.getElementById("usersTable");
    var rows = table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");

    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName("td");
        var found = false;
        for (var j = 0; j < cells.length; j++) {
            if (cells[j].textContent.toUpperCase().indexOf(input) > -1) {
                found = true;
                break;
            }
        }
        rows[i].style.display = found ? "" : "none";
    }
}
</script>

@endsection