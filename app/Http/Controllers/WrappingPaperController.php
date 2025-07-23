<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Wrapping_paper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class WrappingPaperController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wrapping_papers = Wrapping_paper::latest()->paginate(5);

        return view('wrapping.wrapping', compact('wrapping_papers'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function customer_box()
    {
        $boxes = Wrapping_paper::where('active', true)->get(); // Assuming you have a gift model
        return view('user.products.wrapping_paper', compact('boxes'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('wrapping.wrapping_store');
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
            $destinationPath = 'image/wrapping_paper/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }

        Wrapping_paper::create($input);

        return redirect()->route('wrapping.wrapping')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Wrapping_paper $wrapping_paper)
    {
        return view('wrapping.wrapping_show', compact('wrapping_paper'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wrapping_paper $wrapping_paper)
    {
        return view('wrapping.wrapping_edit', compact('wrapping_paper'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wrapping_paper $wrapping_paper)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'quantity' => 'required',
            'price' => 'required'
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'image/wrapping_paper';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        } else {
            unset($input['image']);
        }

        $wrapping_paper->update($input);

        return redirect()->route('wrapping.wrapping')
            ->with('success', 'Wrapping Paper updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wrapping_paper $wrapping_paper)
    {
        $wrapping_paper->update(['active' => false]);
        return redirect()->route('wrapping.wrapping');
    }

    public function wrappingEnable(Wrapping_paper $wrapping_paper)
    {
        $wrapping_paper->update(['active' => true]);
        return redirect()->route('wrapping.wrapping');
        Log::info('Re-enabled wrapping paper and redirected!');
    }

    /**    
     *  search the specified resource from storage.
     */
    public function search(Request $request)
    {
        $search = $request->search;

        $wrapping_papers = Wrapping_paper::where(function ($query) use ($search) {

            $query->where('name', 'like', "%$search%")
                ->orWhere('detail', 'like', "%$search%")
                ->orWhere('quantity', 'like', "%$search%")
                ->orWhere('price', 'like', "%$search%");
        })->paginate(10);

        return view('products.wrapping', compact('wrapping_papers', 'search'));
    }

    public function add_cart_wrapping(Request $request, $id)
    {
        $user = Auth::user();

        $product_wrapping = Wrapping_paper::find($id);

        $cart = new Cart;

        $cart->name = $user->name;
        $cart->email = $user->email;
        $cart->phone = $user->phone;
        $cart->address1 = $user->address1;
        $cart->address2 = $user->address2;
        $cart->user_id = $user->id;

        $cart->product_name = $product_wrapping->name;
        $cart->image = $product_wrapping->image;
        $cart->price = $product_wrapping->price * $request->quantity;
        $cart->product_id = $product_wrapping->id;

        $cart->quantity = $request->quantity;

        $cart->save();

        return redirect()->back();
    }
}
