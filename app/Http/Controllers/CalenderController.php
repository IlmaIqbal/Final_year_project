<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class CalenderController extends Controller
{

    public function index()
    {
        $bookings = array();
        $events = Event::all();
        foreach ($events as $event) {
            $bookings[] = [
                'title' => $event->title,
                'start_date' => $event->start_date,
                'end_date' => $event->end_date,

            ];
        }
        return view('calendar', ['bookings' => $bookings]);
    }
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required|string'

    //     ]);
    //     $event = Event::create([
    //         'title' => $request->title,
    //         'start_date' => $request->start_date,
    //         'end_date' => $request->end_date,
    //     ]);

    //     return response()->json($event);
    // }
}
