<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Venues Report</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2 { text-align: center; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #333; color: white; }
    </style>
</head>
<body>
    <h2>Taarifa za Venues</h2>
    <p>Tarehe: {{ date('d/m/Y') }}</p>
    <table>
        <thead>
            <tr>
                <th>ID</th><th>Jina</th><th>Mahali</th><th>Uwezo</th><th>Hali</th>
            </tr>
        </thead>
        <tbody>
            @foreach($venues as $venue)
            <tr>
                <td>{{ $venue->id }}</td>
                <td>{{ $venue->name }}</td>
                <td>{{ $venue->location }}</td>
                <td>{{ $venue->capacity }}</td>
                <td>{{ $venue->is_active ? 'Active' : 'Inactive' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>