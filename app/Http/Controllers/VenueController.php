<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $venues = Venue::all();
        return view('venues.index', compact('venues'));
    }

    public function customer_index()
    {
        $venues = Venue::where('active', true)->get();
        return view('customers.customerVenue', compact('venues'));
    }

    public function customer_select()
    {
        $venues = Venue::where('active', true)->get();
        return view('user.venue_select', compact('venues'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('venues.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'description' => 'nullable',
            'capacity' => 'required|integer',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        $venueData = $request->all();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/images/venue');
            $venueData['image'] = basename($path);
        }


        Venue::create($venueData);

        return redirect()->route('venues.index')->with('success', 'Venue created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Venue $venue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venue $venue)
    {
        return view('venues.edit', compact('venue'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venue $venue)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'description' => 'nullable',
            'capacity' => 'required|integer',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $venueData = $request->all();

        if ($request->hasFile('image')) {
            if ($venue->image) {
                Storage::delete('public/images/venue' . $venue->image);
            }
            $path = $request->file('image')->store('public/images/venue');
            $venueData['image'] = basename($path);
        }

        $venue->update($venueData);

        return redirect()->route('venues.index')->with('success', 'Venue Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venue $venue)
    {
        $venue->update(['active' => false]);
        return redirect()->route('venues.index')->with('success', 'Venue Disabled.');
    }

    public function enable(Venue $venue)
    {
        $venue->update(['active' => true]);
        return redirect()->route('venues.index')->with('success', 'Venue Enabled.');
    }
}
