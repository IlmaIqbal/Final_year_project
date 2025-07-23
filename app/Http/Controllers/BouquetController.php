<?php

namespace App\Http\Controllers;

use App\Models\Bouquet;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BouquetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bouquets = Bouquet::latest()->paginate(5);

        return view('bouquet.bouquet', compact('bouquets'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function customer_bouquet()
    {
        $bouquets = Bouquet::where('active', true)->get(); // Assuming you have a bouquet model
        return view('user.products.bouquet', compact('bouquets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bouquet.bouquet_store');
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


        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'image/bouquet/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }

        Bouquet::create($input);

        return redirect()->route('bouquet.bouquet')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bouquet $bouquet)
    {
        return view('bouquet.bouquet_show', compact('bouquet'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bouquet $bouquet)
    {
        return view('bouquet.bouquet_edit', compact('bouquet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bouquet $bouquet)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'quantity' => 'required',
            'price' => 'required'
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'image/bouquet';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        } else {
            unset($input['image']);
        }

        $bouquet->update($input);

        return redirect()->route('bouquet.bouquet')
            ->with('success', 'Bouquet updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function bouquetDestroy(Bouquet $bouquet)
    {
        $bouquet->update(['active' => false]);
        return redirect()->route('bouquet.bouquet');
    }

    public function bouquetEnable(Bouquet $bouquet)
    {
        $bouquet->update(['active' => true]);
        return redirect()->route('bouquet.bouquet');
    }

    public function search(Request $request)
    {
        $search = $request->search;

        $bouquets = Bouquet::where(function ($query) use ($search) {

            $query->where('name', 'like', "%$search%")
                ->orWhere('detail', 'like', "%$search%")
                ->orWhere('quantity', 'like', "%$search%")
                ->orWhere('price', 'like', "%$search%");
        })->paginate(10);

        return view('bouquet.bouquet', compact('bouquets', 'search'));
    }
    public function add_cart_bouquet(Request $request, $id)
    {
        $user = Auth::user();

        $product_bouquet = Bouquet::find($id);

        $cart = new Cart;

        $cart->name = $user->name;
        $cart->email = $user->email;
        $cart->phone = $user->phone;
        $cart->address1 = $user->address1;
        $cart->address2 = $user->address2;
        $cart->user_id = $user->id;

        $cart->product_name = $product_bouquet->name;
        $cart->image = $product_bouquet->image;
        $cart->price = $product_bouquet->price * $request->quantity;
        $cart->product_id = $product_bouquet->id;

        $cart->quantity = $request->quantity;

        $cart->save();

        return redirect()->back();
    }
}
