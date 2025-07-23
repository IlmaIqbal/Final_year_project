<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    public function catering_index()
    {
        $services = Service::all();
        return view('customers.services.catering', compact('services'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store_catering(Request $request)
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

        Service::create($serviceData);

        return redirect()->route('services.index')->with('success', 'Service Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $serviceData = $request->all();

        if ($request->hasFile('image')) {
            if ($service->image) {
                Storage::delete('public/images/' . $service->image);
            }
            $path = $request->file('image')->store('public/images');
            $serviceData['image'] = basename($path);
        }

        $service->update($serviceData);

        return redirect()->route('services.index')->with('success', 'Services Updated Successfully');
    }

    /**
     * Enable and disable the specified resource from storage.
     */
    public function disable(Service $service)
    {
        $service->update(['active' => false]);
        return redirect()->route('services.index')->with('success', 'Services Disabled');
    }

    public function enable(Service $service)
    {
        $service->update(['active' => true]);
        return redirect()->route('services.index')->with('success', 'Services Enabled');
    }

    public function showServiceSelection()
    {
        $services = Service::all();
        return view('events.service_selection', compact('services'));
    }
}
