<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\Venue;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;   // <--- HII ILIKOSEKANA

class ExportController extends Controller
{
    // ==================== USERS ====================
    public function users($type)
    {
        $users = User::where('role', '!=', 'admin')->latest()->get();

        if ($type === 'csv') {
            return $this->exportCsv('users_report.csv', 
                ['ID', 'Name', 'Email', 'Phone', 'Role', 'Status', 'Created At'],
                $users->map(fn($u) => [
                    $u->id,
                    $u->first_name . ' ' . $u->last_name,
                    $u->email,
                    $u->phone_number,
                    $u->role,
                    $u->status,
                    $u->created_at->format('d/m/Y')
                ])->toArray()
            );
        }

        if ($type === 'pdf') {
            $pdf = Pdf::loadView('admin.exports.users', compact('users'));
            return $pdf->download('users_report.pdf');
        }

        abort(404);
    }

    // ==================== BOOKINGS ====================
    public function bookings($type)
    {
        $bookings = Booking::with(['user', 'venue'])->latest()->get();

        if ($type === 'csv') {
            return $this->exportCsv('bookings_report.csv',
                ['ID', 'User', 'Venue', 'Date', 'Time', 'Purpose', 'Status'],
                $bookings->map(fn($b) => [
                    $b->id,
                    $b->user->first_name . ' ' . $b->user->last_name,
                    $b->venue->name,
                    $b->booking_date->format('d/m/Y'),
                    $b->start_time . ' - ' . $b->end_time,
                    Str::limit($b->purpose ?? 'None', 30),
                    $b->status
                ])->toArray()
            );
        }

        if ($type === 'pdf') {
            $pdf = Pdf::loadView('admin.exports.bookings', compact('bookings'));
            return $pdf->download('bookings_report.pdf');
        }

        abort(404);
    }

    // ==================== VENUES ====================
    public function venues($type)
    {
        $venues = Venue::latest()->get();

        if ($type === 'csv') {
            return $this->exportCsv('venues_report.csv',
                ['ID', 'Name', 'Location', 'Capacity', 'Status'],
                $venues->map(fn($v) => [
                    $v->id,
                    $v->name,
                    $v->location,
                    $v->capacity,
                    $v->is_active ? 'Active' : 'Inactive'
                ])->toArray()
            );
        }

        if ($type === 'pdf') {
            $pdf = Pdf::loadView('admin.exports.venues', compact('venues'));
            return $pdf->download('venues_report.pdf');
        }

        abort(404);
    }

    // ==================== HELPER ====================
    private function exportCsv($filename, $headers, $rows)
    {
        return response()->streamDownload(function () use ($headers, $rows) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF)); // UTF-8 BOM
            fputcsv($file, $headers);
            foreach ($rows as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        }, $filename, [
            'Content-Type' => 'text/csv',
        ]);
    }
}
