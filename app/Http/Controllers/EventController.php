<?php

namespace App\Http\Controllers;

use App\Models\BookEvent;
use App\Models\Booking;
use App\Models\Decoration;
use App\Models\Entertainment;
use App\Models\Event;
use App\Models\Notification;
use App\Models\Service;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::with('venue')->get();
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $venues = Venue::all();
        $services = Service::all();
        return view('events.create', compact('venues', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'customer_name' => 'required',
            'customer_email' => 'required',
            'description' => 'nullable',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'guest_no' => 'required',
            'event_type' => 'required',
            'venue_id' => 'required|exists:venues,id',
            'services' => 'required|array',
            'services.*' => 'exists:services,id',
            'venue_price' => 'required|numeric',
        ]);

        // Create the event
        $event = Event::create($request->except('services'));

        // Attach the selected services to the event
        $event->services()->sync($request->services);

        session([
            'event_data' => $request->all(),
            'venue_price' => $request->venue_price
        ]);

        return redirect()->route('events.service_selection');
    }

    public function showServiceSelection()
    {
        $services = Service::all();
        return view('events.service_selection', compact('services'));
    }

    public function showPaymentPage(Request $request)
    {
        // Retrieve data from the session
        // $eventData = session('event_data');
        // $venuePrice = session('venue_price');

        // Retrieve data from the request
        // $selectedServices = json_decode($request->input('selected_services'), true);
        // $totalServicePrice = $request->input('total_service_price');

        // Check if all required data is present
        // if (!$eventData || !$venuePrice || !$selectedServices || !$totalServicePrice) {
        //     return redirect()->route('events.create')->withErrors('Some required data is missing.');
        // }

        // Calculate the total price
        // $totalPrice = $venuePrice + $totalServicePrice;

        // Pass data to the view
        // return view('events.payment', compact('eventData', 'selectedServices', 'totalPrice'));
    }

    public function redirectToPayment(Request $request)
    {
        // Assuming you already have the data from the previous steps
        // $eventData = $request->session()->get('event_data');
        // $venuePrice = $request->session()->get('venue_price');
        // $selectedServices = json_decode($request->input('selected_services'), true);
        // $totalServicePrice = $request->input('total_service_price');

        // Validate the data
        // if (!$eventData || !$venuePrice || !$selectedServices || !$totalServicePrice) {
        //     return redirect()->route('events.create')->withErrors('Some required data is missing.');
        // }

        // Store the data into the session
        // $request->session()->put('selected_services', $selectedServices);
        // $request->session()->put('total_service_price', $totalServicePrice);

        // Redirect to the payment page
        // return redirect()->route('events.payment');
    }
    /** 
     * Approved notification to front-office 
     */

    public function approve(Event $event)
    {
        $event->update(['status' => 'approved']);
        // Notify the front officer
        Notification::create([
            'event_id' => $event->id,
            'user_id' => Auth::id(),
            'message' => 'Event approved'
        ]);

        return redirect()->route('events.index')->with('success', 'Event approved successfully.');
    }

    /**
     * Rejected notification for front-office
     */

    public function reject(Event $event)
    {
        $event->update(['status' => 'rejected']);
        // Notify the front officer
        Notification::create([
            'event_id' => $event->id,
            'user_id' => Auth::id(),
            'message' => 'Event rejected'
        ]);

        return redirect()->route('events.index')->with('success', 'Event rejected successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return view('events.show', compact('events'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $venues = Venue::all();
        $services = Service::all();
        $selectedServices = $event->services->pluck('id')->toArray();
        return view('events.edit', compact('event', 'venues'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required',
            'customer_name' => 'required',
            'customer_email' => 'required',
            'description' => 'nullable',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'guest_no' => 'required',
            'event_type' => 'required',
            'venue_id' => 'required|exists:venues,id',
            'services' => 'required|array',
        ]);

        // Update the event without the services
        $event->update($request->except('services'));

        // Attach the services to the event
        $event->services()->sync($request->services);

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index');
    }




    public function showEventBooking()
    {
        $venues = Venue::where('active', true)->get();
        $caterings = Service::where('active', true)->get();
        $decorations = Decoration::where('active', true)->get();
        $entertainments = Entertainment::where('active', true)->get();
        $user = Auth::user();

        return view('user.event_book', [
            'venues' => $venues,
            'caterings' => $caterings,
            'decorations' => $decorations,
            'entertainments' => $entertainments,
            'user' => $user,
        ]);
    }

    public function add_booking(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'venue_id' => 'required|exists:venues,id',
            'service_id' => 'required|exists:services,id', // Assuming Service is your Catering model
            'decoration_id' => 'required|exists:decorations,id',
            'entertainment_id' => 'required|exists:entertainments,id',
            'event_type' => 'required|string',
            'guest_no' => 'required|integer|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);


        $venues = Venue::find($request->venue_id);
        $catering = Service::find($request->service_id); // Assuming Service is your Catering model
        $decoration = Decoration::find($request->decoration_id);
        $entertainment = Entertainment::find($request->entertainment_id);


        $event_books = new Booking;

        $event_books->name = $user->name;
        $event_books->email = $user->email;
        $event_books->user_id = $user->id;
        $event_books->phone = $user->phone;

        $event_books->event_type = $request->event_type;
        $event_books->guest_no = $request->guest_no;
        $event_books->start_date = $request->start_date;
        $event_books->end_date = $request->end_date;

        $event_books->venue_id = $venues->id;
        $event_books->venue_name = $venues->name;
        $event_books->location = $venues->location;
        $event_books->venue_price = $venues->price;

        $event_books->catering_service_id = $catering->id;
        $event_books->catering_name = $catering->name;
        $event_books->catering_price = $catering->price;

        $event_books->decoration_id = $decoration->id;
        $event_books->decoration_name = $decoration->name;
        $event_books->decoration_price = $decoration->price;

        $event_books->entertainment_id = $entertainment->id;
        $event_books->entertainment_name = $entertainment->name;
        $event_books->entertainment_price = $entertainment->price;

        $event_books->save();

        return redirect()->back();
    }

    public function showBookingForm()
    {
        return view('customer_bookings.bookings');
    }
    public function event_payment()
    {
        return view('customer_bookings.payment');
    }

    public function payment()
    {
        return view('customer_bookings.bill');
    }
}
