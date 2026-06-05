<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VenueController extends Controller
{
    public function index()
    {
        $venues = Venue::latest()->paginate(10);
        return view('admin.venues.index', compact('venues'));
    }

    public function create()
    {
        return view('admin.venues.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'location'    => ['required', 'string', 'max:255'],
            'capacity'    => ['required', 'integer', 'min:1'],
            'description' => ['nullable', 'string'],
            'is_active'   => ['nullable', 'boolean'],
        ]);

        Venue::create([
            'name'        => Str::title(strtolower($request->name)),
            'location'    => Str::title(strtolower($request->location)),
            'capacity'    => $request->capacity,
            'description' => $request->description,
            'is_active'   => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('admin.venues.index')
            ->with('success', 'Venue created successfully.');
    }

    public function show(Venue $venue)
    {
        return view('admin.venues.show', compact('venue'));
    }

    public function edit(Venue $venue)
    {
        return view('admin.venues.edit', compact('venue'));
    }

    public function update(Request $request, Venue $venue)
    {
        $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'location'    => ['required', 'string', 'max:255'],
            'capacity'    => ['required', 'integer', 'min:1'],
            'description' => ['nullable', 'string'],
            'is_active'   => ['nullable', 'boolean'],
        ]);

        $venue->update([
            'name'        => Str::title(strtolower($request->name)),
            'location'    => Str::title(strtolower($request->location)),
            'capacity'    => $request->capacity,
            'description' => $request->description,
            'is_active'   => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('admin.venues.index')
            ->with('success', 'Venue updated successfully.');
    }

    public function destroy(Venue $venue)
    {
        $venue->delete();
        return redirect()->route('admin.venues.index')
            ->with('success', 'Venue deleted successfully.');
    }
}
