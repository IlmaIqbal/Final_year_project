<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $layout = Auth::user()->role === 'admin' ? 'admin.navbar' : 'productManager.nav_productManager';

        $products = Product::latest()->paginate(5);

        return view('products.index', compact('products', 'layout'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }



    // customer interface
    public function customer_gift()
    {
        // $gifts = Product::where('active', true)
        //     ->where('product_type', 'gift')
        //     ->get(); // Assuming you have a gift model
        $gifts = Inventory::whereHas('product', function ($query) {
            $query->where('active', true)
                ->where('product_type', 'gift');
        })
            ->with('product') // optional, if you want to access product details
            ->get()
            ->groupBy('product_id');

        return view('user.products.gift', compact('gifts'));
    }

    public function customer_bouquet()
    {
        // $bouquets = Product::where('active', true)
        //     ->where('product_type', 'bouquet')
        //     ->get(); // Assuming you have a gift model
        $bouquets = Inventory::whereHas('product', function ($query) {
            $query->where('active', true)
                ->where('product_type', 'bouquet');
        })
            ->with('product')
            ->get();
        return view('user.products.bouquet', compact('bouquets'));
    }

    public function customer_wrapping()
    {
        // $boxes = Product::where('active', true)
        //     ->where('product_type', 'wrapping_paper')
        //     ->get(); // Assuming you have a gift model
        $boxes = Inventory::whereHas('product', function ($query) {
            $query->where('active', true)
                ->where('product_type', 'wrapping_paper');
        })
            ->with('product')
            ->get();
        return view('user.products.wrapping_paper', compact('boxes'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $layout = Auth::user()->role === 'admin' ? 'admin.navbar' : 'productManager.nav_productManager';

        return view('products.store', compact('layout'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $layout = Auth::user()->role === 'admin' ? 'admin.navbar' : 'productManager.nav_productManager';

        $request->validate([
            'product_type' => 'required',
            'name' => 'required',
            'detail' => 'required',
            'reorder_level' => 'required',
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

        Product::create($input);

        return redirect()->route('products.index', compact('layout'))
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $layout = Auth::user()->role === 'admin' ? 'admin.navbar' : 'productManager.nav_productManager';

        return view('products.show', compact('product', 'layout'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $layout = Auth::user()->role === 'admin' ? 'admin.navbar' : 'productManager.nav_productManager';

        return view('products.edit', compact('product', 'layout'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $layout = Auth::user()->role === 'admin' ? 'admin.navbar' : 'productManager.nav_productManager';

        $request->validate([
            'product_type' => 'required',
            'name' => 'required',
            'detail' => 'required',
            'reorder_level' => 'required',
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

        $product->update($input);

        return redirect()->route('products.index', compact('layout'))
            ->with('success', 'Product updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function product_destroy(Product $product)
    {

        $product->update(['active' => false]);
        return redirect()->route('products.index')->with('success', 'Product disable successfully');;
    }

    public function Enable(Product $product)
    {
        $product->update(['active' => true]);
        return redirect()->route('products.index')->with('success', 'Product enable successfully');;
    }

    public function search(Request $request)
    {
        $layout = Auth::user()->role === 'admin' ? 'admin.navbar' : 'productManager.nav_productManager';

        $search = $request->search;

        $product = Product::where(function ($query) use ($search) {

            $query->where('name', 'like', "%$search%")
                ->orWhere('detail', 'like', "%$search%")
                ->orWhere('product_type', 'like', "%$search%")
                ->orWhere('reorder_level', 'like', "%$search%");
        })->paginate(10);

        return view('products.index', compact('product', 'search', 'layout'));
    }

    public function add_cart_gift(Request $request, $id)
    {
        $user = Auth::user();

        $product_gift = Product::find($id);

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

    public function find_product()
    {
        $counts = [
            'gifts' => Inventory::whereHas(
                'product',
                function ($query) {
                    $query->where('active', true)
                        ->where('product_type', 'gift');
                }
            )
                ->select('product_id')
                ->distinct()
                ->count(),

            'bouquets' => Inventory::whereHas('product', function ($query) {
                $query->where('active', true)
                    ->where('product_type', 'bouquet');
            })->select('product_id')
                ->distinct()
                ->count(),

            'wrapping' => Inventory::whereHas('product', function ($query) {
                $query->where('active', true)
                    ->where('product_type', 'wrapping_paper');
            })->select('product_id')
                ->distinct()
                ->count(),


        ];
        return view('products.find_category', compact('counts'));
    }

    public function item_details($id)
    {

        $id = Inventory::where('id', $id)
            ->with(['product' => function ($query) {
                $query->where('active', true);
            }])
            ->get();
        return view('user.products.item-details', compact('id'));
    }

    public function showSimilarProduct($productId)
    {
        // Retrieve the selected product or fail with 404
        // $selectedProduct = Product::with('inventory')->findOrFail($productId);

        // Get the subcategory of the selected product
        // $subcategory = $selectedProduct->sub_category;

        // Fetch similar products from the same subcategory, excluding the selected product
        // $similarProducts = Product::with('inventory')
        //     ->where('sub_category', $subcategory)
        //     ->where('id', '!=', $productId)
        //     ->get();

        // Return the view with both selected product and similar products
        // return view('user.products.item-details', compact('selectedProduct', 'similarProducts'));
        $res = Product::where('sub_category', 'water bottle')

            ->get();

        dd($res);
    }
}
