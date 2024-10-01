<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Gift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gifts = Gift::latest()->paginate(5);

        return view('products.gift', compact('gifts'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    // customer interface
    public function customer_gift()
    {
        $gifts = Gift::where('active', true)->get(); // Assuming you have a gift model
        return view('user.products.gift', compact('gifts'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.gift_store');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category' => 'required',


        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }

        Gift::create($input);

        return redirect()->route('products.gift')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gift $gift)
    {
        return view('products.gift_show', compact('gift'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gift $gift)
    {
        return view('products.gift_edit', compact('gift'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gift $gift)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'category' => 'required'
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        } else {
            unset($input['image']);
        }

        $gift->update($input);

        return redirect()->route('products.gift')
            ->with('success', 'Gift updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gift $gift)
    {
        $gift->update(['active' => false]);
        return redirect()->route('products.gift');
    }

    public function enable(Gift $gift)
    {
        $gift->update(['active' => true]);
        return redirect()->route('products.gift');
    }

    public function search(Request $request)
    {
        $search = $request->search;

        $gifts = Gift::where(function ($query) use ($search) {

            $query->where('name', 'like', "%$search%")
                ->orWhere('detail', 'like', "%$search%")
                ->orWhere('quantity', 'like', "%$search%")
                ->orWhere('price', 'like', "%$search%");
        })->paginate(10);

        return view('products.gift', compact('gifts', 'search'));
    }

    public function add_cart_gift(Request $request, $id)
    {
        $user = Auth::user();

        $product_gift = Gift::find($id);

        $cart = new Cart;

        $cart->name = $user->name;
        $cart->email = $user->email;
        $cart->phone = $user->phone;
        $cart->address1 = $user->address1;
        $cart->address2 = $user->address2;
        $cart->user_id = $user->id;

        $cart->product_name = $product_gift->name;
        $cart->image = $product_gift->image;
        $cart->price = $product_gift->price * $request->quantity;
        $cart->product_id = $product_gift->id;

        $cart->quantity = $request->quantity;

        $cart->save();

        return redirect()->back();
    }
}
