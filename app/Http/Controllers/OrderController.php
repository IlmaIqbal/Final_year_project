<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function view_order()

    {
        $orders = Order::all();
        return view('admin.order', compact('orders'));
    }

    public function delivered($id)
    {
        $order = Order::find($id);

        $order->delivery = "Delivered";

        $order->save();

        return redirect()->back();
    }

    public function customer_order()
    {
        $id = Auth::user()->id;

        $orders = Order::where('user_id', '=', $id)->get();
        return view('user.order', compact('orders'));
    }

    public function invoice()
    {

        $id = Auth::user()->id;
        $items = Cart::where('user_id', '=', $id)->get();
        return view('emails.invoice', compact('items'));
    }
}
