<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Models\Booking;
use App\Models\Cart;
use App\Models\Event;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $id = Auth::user()->id;
        $cart = Cart::where('user_id', '=', $id)->get();
        return view('user.payment', compact('cart'));
    }


    public function store_order()
    {
        $user = Auth::user();

        $userid = $user->id;

        $data = Cart::where('user_id', '=', $userid)->get();


        foreach ($data as $data) {

            $order = new Order;

            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address1 = $data->address1;
            $order->address2 = $data->address2;
            $order->user_id = $data->user_id;
            $order->image = $data->image;
            $order->product_name = $data->product_name;
            $order->quantity = $data->quantity;
            $order->price = $data->price;
            $order->product_id = $data->product_id;
            $order->payment = 'Paid';
            $order->delivery = 'Processing';

            $order->save();

            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }

        return redirect()->route('user.home')->with('success', 'Thanks for Payment.');
    }

    public function storeEventData(Request $request)
    {
        $eventData = $request->input('eventData');

        try {
            Booking::create([
                'user_id' => auth()->id(),
                'user_name' => auth()->user()->name,
                'user_email' => auth()->user()->email,
                'customer_name' => $eventData['customer_name'],
                'customer_email' => $eventData['customer_email'],
                'phone_no' => $eventData['phone_no'],
                'event_type' => $eventData['event_type'],
                'guest_no' => $eventData['guest_no'],
                'start_date' => $eventData['start_date'],
                'end_date' => $eventData['end_date'],
                'venue_id' => $eventData['venue_id'],
                'venue_name' => $eventData['venue_name'],
                'venue_location' => $eventData['venue_location'],
                'venue_price' => $eventData['venue_price'],
                'catering_id' => $eventData['catering_id'],
                'catering_name' => $eventData['catering_name'],
                'catering_price' => $eventData['catering_price'],
                'decoration_id' => $eventData['decoration_id'],
                'decoration_name' => $eventData['decoration_name'],
                'decoration_price' => $eventData['decoration_price'],
                'entertainment_id' => $eventData['entertainment_id'],
                'entertainment_name' => $eventData['entertainment_name'],
                'entertainment_price' => $eventData['entertainment_price'],
                'total_price' => $eventData['venue_price']
                    + $eventData['catering_price']
                    + $eventData['decoration_price']
                    + $eventData['entertainment_price'],
                'status' => 'Pending',
            ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function storeAdminData(Request $request)
    {
        $eventData = $request->input('eventData');

        try {
            Booking::create([
                'user_id' => auth()->id(),
                'user_name' => auth()->user()->name,
                'user_email' => auth()->user()->email,
                'customer_name' => $eventData['customer_name'],
                'customer_email' => $eventData['customer_email'],
                'phone_no' => $eventData['phone_no'],
                'event_type' => $eventData['event_type'],
                'guest_no' => $eventData['guest_no'],
                'start_date' => $eventData['start_date'],
                'end_date' => $eventData['end_date'],
                'venue_id' => $eventData['venue_id'],
                'venue_name' => $eventData['venue_name'],
                'venue_location' => $eventData['venue_location'],
                'venue_price' => $eventData['venue_price'],
                'catering_id' => $eventData['catering_id'],
                'catering_name' => $eventData['catering_name'],
                'catering_price' => $eventData['catering_price'],
                'decoration_id' => $eventData['decoration_id'],
                'decoration_name' => $eventData['decoration_name'],
                'decoration_price' => $eventData['decoration_price'],
                'entertainment_id' => $eventData['entertainment_id'],
                'entertainment_name' => $eventData['entertainment_name'],
                'entertainment_price' => $eventData['entertainment_price'],
                'total_price' => $eventData['venue_price']
                    + $eventData['catering_price']
                    + $eventData['decoration_price']
                    + $eventData['entertainment_price'],
                'status' => 'Pending',

            ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function confirmPayment($orderId)
    {
        $order = Order::findOrFail($orderId)->first();

        if ($order->issue_status !== 'Issued') {
            return redirect()->back()->with('error', 'Item not issued yet!');
        }

        $order->update([
            'payment' => 'Paid',
            'paid_at' => now(),
            'paid_by' => auth()->user()->id, // Paid by whom
        ]);

        return redirect()->route('cashier.invoice', $order->id)->with('success', 'Payment confirmed!');
    }

    public function payments()
    {
        $orders = Order::where('payment', 'Paid')->orderBy('created_at', 'desc')->paginate(10);

        return view('cashier.payment', compact('orders'));
    }

    public function pending()
    {
        $orders = Order::where('payment', 'Pending')->orderBy('created_at', 'desc')->paginate(10);

        return view('cashier.ongoing', compact('orders'));
    }
    public function invoice(Order $order)
    {
        // Ensure the order exists
        if (!$order) {
            return redirect()->route('cashier.pending')->with('error', 'Order not found.');
        }

        // Fetch order items
        $orderItems = json_decode($order->items, true); // Ensure it's an array

        return view('cashier.invoice', compact('order', 'orderItems'));
    }

    public function handleReturn(Request $request)
    {
        $orderId = $request->query('order_id'); // or $request->order_id

        // Example: process the order ID
        return "Returned order ID: " . $orderId;
    }
}
