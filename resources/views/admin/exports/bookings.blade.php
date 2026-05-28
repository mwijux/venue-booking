<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bookings Report</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2 { text-align: center; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #333; color: white; }
    </style>
</head>
<body>
    <h2>Taarifa za Bookings</h2>
    <p>Tarehe: {{ date('d/m/Y') }}</p>
    <table>
        <thead>
            <tr>
                <th>ID</th><th>User</th><th>Venue</th><th>Date</th><th>Time</th><th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->id }}</td>
                <td>{{ $booking->user->first_name }} {{ $booking->user->last_name }}</td>
                <td>{{ $booking->venue->name }}</td>
                <td>{{ $booking->booking_date->format('d/m/Y') }}</td>
                <td>{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                <td>{{ $booking->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>