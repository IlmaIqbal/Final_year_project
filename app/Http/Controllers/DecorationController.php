<?php

namespace App\Http\Controllers;

use App\Models\Decoration;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DecorationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $decorations = Decoration::all();
        return view('services.decoration.index', compact('decorations'));
    }

    public function decoration_index()
    {
        $decorations = Decoration::where('active', true)->get();
        return view('customers.services.decoration', compact('decorations'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('services.decoration.create');
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

        Decoration::create($serviceData);

        return redirect()->route('services.decoration.index')->with('success', 'Service Created Successfully');
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
    public function edit(Decoration $decoration)
    {
        return view('services.decoration.edit', compact('decoration'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Decoration $decoration)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $serviceData = $request->all();

        if ($request->hasFile('image')) {
            if ($decoration->image) {
                Storage::delete('public/images/' . $decoration->image);
            }
            $path = $request->file('image')->store('public/images');
            $serviceData['image'] = basename($path);
        }

        $decoration->update($serviceData);

        return redirect()->route('services.decoration.index')->with('success', 'Services Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function disable(Decoration $decoration)
    {
        $decoration->update(['active' => false]);
        return redirect()->route('services.decoration.index')->with('success', 'Services Disabled');
    }
    public function enable(Decoration $decoration)
    {
        $decoration->update(['active' => true]);
        return redirect()->route('services.decoration.index')->with('success', 'Services Enabled');
    }

    public function select(Event $event)
    {
        $decorationServices = Decoration::all();
        return view('decoration.select', compact('event', 'decorationServices'));
    }

    public function store_decoration(Request $request, Event $event)
    {
        $event->decorationServices()->attach($request->decoration_id);
        return redirect("/events/{$event->id}/invitation");
    }
}
