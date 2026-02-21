<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::latest()->get();
        return view('admin.locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.locations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:locations,name',
            'code' => 'nullable|string|max:50|unique:locations,code',
            'description' => 'nullable|string',
        ]);

        $location = Location::create($request->only('name', 'code', 'description'));

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Lokasi berhasil ditambahkan.',
                'location' => $location,
                'update_url' => route('locations.update', $location->id),
                'delete_url' => route('locations.destroy', $location->id),
            ]);
        }
        return redirect()->route('locations.index')->with('success', 'Lokasi berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        return view('admin.locations.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:locations,name,' . $location->id,
            'code' => 'nullable|string|max:50|unique:locations,code,' . $location->id,
            'description' => 'nullable|string',
        ]);

        $location->update($request->only('name', 'code', 'description'));

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Lokasi berhasil diperbarui.',
                'location' => $location,
            ]);
        }
        return redirect()->route('locations.index')->with('success', 'Lokasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->route('locations.index')->with('success', 'Lokasi berhasil dihapus.');
    }
}
