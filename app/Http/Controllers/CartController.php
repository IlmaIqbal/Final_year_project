<?php

namespace App\Http\Controllers;

use App\Models\Cart as ModelsCart;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $cart = ModelsCart::where('user_id', '=', $id)->get();
        $cartItems = Cart::instance('cart')->content();
        return view('cart', compact('cartItems', 'cart'));
    }

    public function remove_cart($id)
    {
        $cart = ModelsCart::find($id);

        $cart->delete();

        return redirect()->back();
    }
}
