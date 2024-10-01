<?php

namespace App\Http\Controllers;

use App\Models\Entertainment;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EntertainmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entertainments = Entertainment::all();
        return view('services.entertainment.index', compact('entertainments'));
    }

    public function entertainment_index()
    {
        $entertainments = Entertainment::where('active', true)->get();
        return view('customers.services.entertainment', compact('entertainments'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('services.entertainment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $serviceData = $request->all();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/images');
            $serviceData['image'] = basename($path);
        }

        Entertainment::create($serviceData);

        return redirect()->route('services.entertainment.index')->with('success', 'Service Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entertainment $entertainment)
    {
        return view('services.entertainment.edit', compact('entertainment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Entertainment $entertainment)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $serviceData = $request->all();

        if ($request->hasFile('image')) {
            if ($entertainment->image) {
                Storage::delete('public/images/' . $entertainment->image);
            }
            $path = $request->file('image')->store('public/images');
            $serviceData['image'] = basename($path);
        }

        $entertainment->update($serviceData);

        return redirect()->route('services.entertainment.index')->with('success', 'Services Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function disable(Entertainment $entertainment)
    {
        $entertainment->update(['active' => false]);
        return redirect()->route('services.entertainment.index')->with('success', 'Services Disabled');
    }
    public function enable(Entertainment $entertainment)
    {
        $entertainment->update(['active' => true]);
        return redirect()->route('services.entertainment.index')->with('success', 'Services Enabled');
    }

    public function select(Event $event)
    {
        $entertainments = Entertainment::all();
        return view('invitation.select', compact('event', 'entertainments'));
    }

    public function store_entertainment(Request $request, Event $event)
    {
        $event->entertainments()->attach($request->entertainment_id);
        return redirect("/events/{$event->id}/payment");
    }
}
