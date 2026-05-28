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
            <input type="text" id="searchInput" placeholder="Search bookings..." onkeyup="searchTable()">
        </div>

        <div style="display: flex; gap: 10px; align-items: center;">
            <a href="{{ route('admin.exports.bookings', 'csv') }}" class="btn btn-success">⬇ CSV</a>
            <a href="{{ route('admin.exports.bookings', 'pdf') }}" class="btn btn-danger">⬇ PDF</a>
            <a href="{{ route('admin.bookings.calendar') }}" class="btn btn-primary btn-lg">Calendar View</a>
        </div>
    </div>

    {{-- Table --}}
    <table class="data-table" id="bookingsTable">
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
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $booking)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td style="font-weight: 600;">{{ $booking->user->first_name }} {{ $booking->user->last_name }}</td>
                <td><span class="badge badge-{{ $booking->user->role }}">{{ ucfirst($booking->user->role) }}</span></td>
                <td>{{ $booking->venue->name }}</td>
                <td>{{ $booking->booking_date->format('d M Y') }}</td>
                <td>{{ date('h:i A', strtotime($booking->start_time)) }} - {{ date('h:i A', strtotime($booking->end_time)) }}</td>
                <td>{{ Str::limit($booking->purpose ?? 'N/A', 25) }}</td>
                <td>
                    @if($booking->status === 'confirmed')
                        <span class="badge badge-confirmed">Confirmed</span>
                    @else
                        <span class="badge badge-cancelled">Cancelled</span>
                    @endif
                </td>
                <td>
                    <div style="display: flex; gap: 5px; align-items: center;">
                        @if($booking->status === 'confirmed')
                            <form action="{{ route('admin.bookings.cancel', $booking) }}" method="POST" style="display:inline;"
                                  onsubmit="return confirm('Una uhakika unataka kughairi booking hii?')">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn btn-warning">Cancel</button>
                            </form>
                        @else
                            <span style="color: var(--text-secondary); font-size: 12px;">Cancelled</span>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" style="text-align: center; padding: 40px; color: var(--text-secondary);">
                    Hakuna bookings zilizopatikana.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="custom-pagination">
        {{ $bookings->links() }}
    </div>
</div>

{{-- Search Script --}}
<script>
function searchTable() {
    var input = document.getElementById("searchInput").value.toUpperCase();
    var table = document.getElementById("bookingsTable");
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