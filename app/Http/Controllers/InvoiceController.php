<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'event_type' => 'required|string',
            'guest_no' => 'required|integer|min=1',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'venue_name' => 'required|string',
            'venue_location' => 'required|string',
            'venue_price' => 'required|numeric',
            'catering_name' => 'nullable|string',
            'catering_price' => 'nullable|numeric',
            'decoration_name' => 'nullable|string',
            'decoration_price' => 'nullable|numeric',
            'entertainment_name' => 'nullable|string',
            'entertainment_price' => 'nullable|numeric',
        ]);

        // Save the data to the database
        $event = Booking::create($validated);

        // Flash the data to the session
        session()->flash('eventData', $validated);

        // Redirect to the invoice page or any other page
        return redirect()->route('invoice.show', ['id' => $event->id]);
    }

    public function downloadInvoice(Request $request)
    {
        $eventData = json_decode($request->eventData, true);

        $defaultValues = [
            'catering_name' => '',
            'catering_price' => 0,
            'decoration_name' => '',
            'decoration_price' => 0,
            'entertainment_name' => '',
            'entertainment_price' => 0,
        ];
        $eventData = array_merge($defaultValues, $eventData);

        $pdf = PDF::loadView('invoice', compact('eventData'));

        return $pdf->download('invoice.pdf');
    }
}
