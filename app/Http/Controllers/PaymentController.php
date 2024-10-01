<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Models\Cart;
use App\Models\Event;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
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
}
