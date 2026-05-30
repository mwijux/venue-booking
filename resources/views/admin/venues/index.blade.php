@extends('layouts.admin')

@section('content')

{{-- Success Message --}}
@if(session('success'))
    <div style="background: #e8f5e9; border-left: 4px solid #2e7d32; color: #2e7d32; padding: 12px 18px; border-radius: 0 8px 8px 0; margin-bottom: 20px; font-weight: 500;">
        ✅ {{ session('success') }}
    </div>
@endif

<div class="table-card">
    {{-- Search & Controls --}}
    <div class="table-controls">
        <div class="search-box">
            <svg class="search-icon" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" id="searchInput" placeholder="Search venues..." onkeyup="searchTable()">
        </div>

        <div style="display: flex; gap: 10px; align-items: center;">
            <a href="{{ route('admin.exports.venues', 'csv') }}" class="btn btn-success">⬇ CSV</a>
            <a href="{{ route('admin.exports.venues', 'pdf') }}" class="btn btn-danger">⬇ PDF</a>
            <a href="{{ route('admin.venues.create') }}" class="btn btn-primary btn-lg">+ Add Venue</a>
        </div>
    </div>

    {{-- Table --}}
    <table class="data-table" id="venuesTable">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Venue Name</th>
                <th>Location</th>
                <th>Capacity</th>
                <th>Description</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($venues as $venue)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td style="font-weight: 600;">{{ $venue->name }}</td>
                <td>{{ $venue->location }}</td>
                <td>{{ $venue->capacity }} people</td>
                <td>{{ Str::limit($venue->description ?? 'No description available', 25) }}</td>
                <td>
                    @if($venue->is_active)
                        <span class="badge badge-active">Active</span>
                    @else
                        <span class="badge badge-cancelled">Inactive</span>
                    @endif
                </td>
                <td>
                    <div style="display: flex; gap: 5px; align-items: center;">
                        <a href="{{ route('admin.venues.show', $venue) }}" class="btn btn-info">View</a>
                        <a href="{{ route('admin.venues.edit', $venue) }}" class="btn btn-edit">Edit</a>
                        <form action="{{ route('admin.venues.destroy', $venue) }}" method="POST" style="display:inline;"
                              onsubmit="return confirm('are you sure you want to delete this venue?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-delete">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center; padding: 40px; color: var(--text-secondary);">
                    NO registered venues.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="custom-pagination">
        {{ $venues->links() }}
    </div>
</div>

{{-- Search Script --}}
<script>
function searchTable() {
    var input = document.getElementById("searchInput").value.toUpperCase();
    var table = document.getElementById("venuesTable");
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