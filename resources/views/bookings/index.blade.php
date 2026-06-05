@extends('layouts.user')

@section('content')

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
            <a href="{{ route('bookings.create') }}" class="btn btn-primary btn-lg">+ Book New Venue</a>
        </div>
    </div>

    {{-- Table --}}
    <table class="data-table" id="bookingsTable">
        <thead>
            <tr>
                <th>S/N</th>
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
                <td style="font-weight: 600;">{{ $booking->venue->name }}</td>
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
                <td>
                    <div style="display: flex; gap: 5px; align-items: center;">
                        @if($booking->status === 'confirmed')
                            <form action="{{ route('bookings.destroy', $booking) }}" method="POST" style="display:inline;"
                                  onsubmit="return confirm('WARNING! Are you sure you want to cancel this booking?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-delete">Cancel</button>
                            </form>
                        @else
                            <span style="color: var(--text-secondary); font-size: 12px;">Cancelled</span>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center; padding: 40px; color: var(--text-secondary);">
                    <div>
                        <p style="font-size: 40px; margin-bottom: 10px;">icon</p>
                        <p style="font-weight: 600; font-size: 16px; margin-bottom: 5px;">You haven't made any bookings yet.</p>
                        <p style="font-size: 13px;">Click the "Book New Venue" button to get started..</p>
                    </div>
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