@extends('layouts.admin')

@section('content')

<div style="margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h1 style="font-size: 24px; font-weight: 700; color: var(--text-primary); margin: 0;">Booking Calendar</h1>
        <p style="color: var(--text-secondary); font-size: 14px; margin-top: 5px;">View all bookings on the calendar.</p>
    </div>
    <a href="{{ route('admin.bookings.index') }}" class="btn btn-primary btn-lg">← Return to List</a>
</div>

<div class="table-card">
    <div style="padding: 25px;">
        <div id="calendar"></div>
    </div>
</div>

<!-- FullCalendar -->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>

<style>
    #calendar {
        max-width: 100%;
        font-size: 13px;
    }

    .fc .fc-toolbar-title {
        font-size: 1.3em !important;
        font-weight: 700 !important;
        color: var(--text-primary) !important;
    }

    .fc .fc-button {
        background: var(--btn-primary) !important;
        border: none !important;
        font-size: 12px !important;
        padding: 6px 12px !important;
        border-radius: 6px !important;
    }

    .fc .fc-button:hover {
        opacity: 0.85 !important;
    }

    .fc .fc-button-active {
        background: var(--sidebar-bg) !important;
    }

    .fc .fc-daygrid-day {
        min-height: 70px !important;
    }

    .fc .fc-event {
        border-radius: 4px !important;
        padding: 2px 6px !important;
        font-size: 11px !important;
        border: none !important;
    }

    .fc .fc-col-header-cell {
        background: var(--table-header-bg) !important;
        color: white !important;
        padding: 10px !important;
        font-size: 12px !important;
        font-weight: 600 !important;
    }

    .fc .fc-daygrid-day-number {
        font-weight: 600 !important;
        color: var(--text-primary) !important;
    }

    .fc-theme-standard td, .fc-theme-standard th {
        border-color: #e8e8e8 !important;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 'auto',
        contentHeight: 550,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: [
            @foreach($bookings as $booking)
            {
                title: '{{ $booking->venue->name }} - {{ $booking->user->first_name }}',
                start: '{{ $booking->booking_date->format("Y-m-d") }}T{{ $booking->start_time }}',
                end: '{{ $booking->booking_date->format("Y-m-d") }}T{{ $booking->end_time }}',
                color: '{{ $booking->status === "confirmed" ? "#2e7d32" : "#c62828" }}',
                textColor: 'white'
            },
            @endforeach
        ],
        eventClick: function(info) {
            alert('Venue: ' + info.event.title + '\nMuda: ' + info.event.start.toLocaleString());
        }
    });
    calendar.render();
});
</script>

@endsection