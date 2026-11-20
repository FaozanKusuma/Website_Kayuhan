<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Schedule;
use Illuminate\Http\Request;

class AdminLocationController extends Controller
{
    public function index()
    {
        $locations = Location::latest()->get();
        $schedules = Schedule::all();
        return view('admin.locations.index', compact('locations', 'schedules'));
    }

    public function edit(Location $location)
    {
        $locations = Location::latest()->get();
        $schedules = Schedule::all();
        return view('admin.locations.index', compact('locations', 'schedules', 'location'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'address'  => 'required|string',
            'maps_url' => 'nullable|string',
        ]);

        Location::create($validated);

        return redirect()->route('admin.locations.index')->with('success', 'Lokasi berhasil ditambahkan!');
    }

    public function update(Request $request, Location $location)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'address'  => 'required|string',
            'maps_url' => 'nullable|string',
        ]);

        $location->update($validated);

        return redirect()->route('admin.locations.index')->with('success', 'Data lokasi diperbarui!');
    }

    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->route('admin.locations.index')->with('success', 'Lokasi berhasil dihapus!');
    }

    public function storeSchedule(Request $request)
    {
        $validated = $request->validate([
            'day'   => 'required|string|max:255',
            'hours' => 'required|string|max:255',
        ]);

        Schedule::create($validated);

        return redirect()->route('admin.locations.index')->with('success', 'Jadwal operasional ditambahkan!');
    }

    public function destroySchedule(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('admin.locations.index')->with('success', 'Jadwal berhasil dihapus!');
    }
}