<?php

namespace App\Http\Controllers;

use App\Models\Cart as ModelsCart;
use App\Models\Gift;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        // $id = Auth::user()->id;
        // $cart = ModelsCart::where('user_id', '=', $id)->get();
        $cartItems = Cart::instance('cart')->content();
        return view('cart', compact('cartItems'));
    }

    public function remove_cart($id)
    {
        $cart = ModelsCart::find($id);

        $cart->delete();

        return redirect()->back();
    }

    public function getCartCount()
    {
        $userId = Auth::id(); // Get the currently authenticated user's ID
        $cartCount = ModelsCart::where()->sum('quantity'); // Count items for that user

        return $cartCount;
    }

    public function addCartAjax(Request $request)
    {
        $userId = Auth::id();
        $id = $request->id;
        $quantity = $request->quantity;

        // Fetch the gift item
        $gift = Gift::find($id);

        if (!$gift) {
            return response()->json(['success' => false, 'message' => 'Gift not found']);
        }

        // Retrieve or initialize cart in session
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
            $cart[$id]['price'] = $cart[$id]['quantity'] * $gift->price;
        } else {
            $cart[$id] = [
                "id" => $gift->id,
                "product_name" => $gift->name,
                "quantity" => $quantity,
                "price" => $gift->price * $quantity,
                "image" => $gift->image
            ];
        }

        session()->put('cart', $cart);

        // Respond with updated cart data
        return response()->json([
            'success' => true,
            'name' => $gift->name,
            'cart' => array_values($cart)
        ]);
    }
}
