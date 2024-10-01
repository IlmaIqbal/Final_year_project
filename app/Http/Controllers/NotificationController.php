<?php

namespace App\Http\Controllers;

use App\Models\Email_Notification;
use App\Models\Notification;
use App\Models\User;
use App\Models\Venue;
use App\Notifications\CustomNotification;
use App\Notifications\EmailNotification;
use App\Notifications\UnavailableNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification as FacadesNotification;
use Illuminate\Support\Str;


class NotificationController extends Controller
{
    /**
     * Retrieve all notifications for the currently authenticated user.
     */

    public function index()
    {
        $notifications =  auth()->user()->notifications;

        return view('notifications.index', compact('notifications'));
    }

    public function notifyAdmin(Request $request)
    {
        $admin = User::where('role', '=', 'admin')->first();


        if ($admin) {
            $user = auth()->user();
            $venue = $request->input('venue'); // Ensure you pass correct venue data

            $startDate = Carbon::createFromFormat('Y-m-d H:i A', $request->start_date)->format('Y-m-d H:i:s');
            $endDate = Carbon::createFromFormat('Y-m-d H:i A', $request->end_date)->format('Y-m-d H:i:s');

            // Create a new notification entry in the database
            $admin->notifications()->create([
                'id' => Str::uuid()->toString(),
                'type' => 'venue_request', // Provide a suitable type
                'name' => $user->name,
                'email' => $user->email,
                'venue_name' => $venue['name'],
                'address' => $venue['location'],
                'data' => ['message' => 'A new venue request has been made.'],
                'start_date' =>  $startDate,
                'end_date' =>  $endDate,

            ]);


            // Send the notification

            // Optionally, redirect with a success message
            return redirect()->back()->with('status', 'Admin notified successfully!');
        } else {
            return redirect()->back()->with('error', 'Admin not found.');
        }
    }

    /**
     * Mark a specific notification as read.
     */
    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->find($id);

        if ($notification) {
            $notification->markAsRead();
        }

        return redirect()->back(); // Redirect to the previous page
    }

    public function send_email(Request $request, $id)
    {

        $emails = Notification::find($id);
        $details = [];

        $emails->notify(new EmailNotification($details));

        return redirect()->back();
    }
    public function unavailable_venue(Request $request, $id)
    {

        $emails = Notification::find($id);
        $data = [];

        $emails->notify(new UnavailableNotification($data));

        return redirect()->back();
    }
}
