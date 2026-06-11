<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvitationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invitations = invitation::all();
        return view('services.invitation.index', compact('invitations'));
    }

    public function invitation_index()
    {
        $invitations = invitation::all();
        return view('customers.services.invitation', compact('invitations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('services.invitation.create');
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

        invitation::create($serviceData);

        return redirect()->route('services.invitation.index')->with('success', 'Service Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invitation $invitation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invitation $invitation)
    {
        return view('services.invitation.edit', compact('invitation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invitation $invitation)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $serviceData = $request->all();

        if ($request->hasFile('image')) {
            if ($invitation->image) {
                Storage::delete('public/images/' . $invitation->image);
            }
            $path = $request->file('image')->store('public/images');
            $serviceData['image'] = basename($path);
        }

        $invitation->update($serviceData);

        return redirect()->route('services.invitation.index')->with('success', 'Services Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function disable(Invitation $invitation)
    {

        $invitation->update(['active' => false]);
        return redirect()->route('services.invitation.index')->with('success', 'Services Disabled');
    }

    public function enable(Invitation $invitation)
    {
        $invitation->update(['active' => true]);
        return redirect()->route('services.invitation.index')->with('success', 'Services Enabled');
    }

    public function select(Event $event)
    {
        $invitationCards = Invitation::all();
        return view('invitation.select', compact('event', 'invitationCards'));
    }

    public function store_invitation(Request $request, Event $event)
    {
        $event->invitationCards()->attach($request->invitation_id);
        return redirect("/events/{$event->id}/entertainment");
    }
}
