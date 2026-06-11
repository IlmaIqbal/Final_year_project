<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedBackController extends Controller
{
    public function create()
    {
        return view('user.feedBack');
    }

    public function store(Request $request)
    {

        // Validate the request
        $validatedData = $request->validate([
            'email' => 'required|email',
            'comment' => 'required|string',
        ]);

        Feed::create($validatedData);

        return redirect()->back()->with('success', 'Thank you for your feedback!');
    }

    public function view_admin()
    {
        $feedBacks = Feed::all();

        return view('admin.feeds', compact('feedBacks'));
    }
    public function rateProduct($orderId)
    {

        $orders = Order::find($orderId);

        $orderItems = json_decode($orders->items, true);

        return view('user.review', compact('orderItems', 'orders'))->with('success', 'Thank you for your feedback!');
    }

    public function add_rating(Request $request)
    {

        $order_id = $request->input('order_id');
        $product_id = $request->input('product_id');
        $star_rating = $request->input('product_rating');
        $comment = $request->input('review');

        Review::create([
            'user_id' => Auth::id(),
            'order_id' => $order_id,
            'product_id' => $product_id,
            'rating' => $star_rating,
            'comment' => $comment

        ]);

        return redirect()->route('user.order')->with('success', 'Successfully Rated!');
    }
}
