<?php

namespace App\Http\Controllers;

use App\Models\Bouquet;
use App\Models\Gift;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Wrapping_paper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $layout = 'admin.navbar';
        } elseif (Auth::user()->role === 'product_manager') {
            $layout = 'productManager.nav_productManager';
        } elseif (Auth::user()->role === 'stock_keeper') {
            $layout = 'stockKeeper.nav_stockKeeper';
        } else {
            abort(403); // Forbidden
        }

        $products = Inventory::latest()->paginate(10);
        return view('inventory.index', compact('products', 'layout'))->with('i', (request()->input('page', 1) - 1) * 10);
    }
    public function stock_index()
    {
        if (Auth::user()->role === 'admin') {
            $layout = 'admin.navbar';
        } elseif (Auth::user()->role === 'product_manager') {
            $layout = 'productManager.nav_productManager';
        } elseif (Auth::user()->role === 'stock_keeper') {
            $layout = 'stockKeeper.nav_stockKeeper';
        } else {
            abort(403); // Forbidden
        }
        $products = Inventory::select('product_id')
            ->selectRaw('SUM(qty) as total_qty')
            ->selectRaw('SUM(issue_qty) as total_issued')
            ->groupBy('product_id')
            ->whereHas('product', function ($query) {
                $query->where('active', true);
            })
            ->with('product')
            ->get();

        return view('inventory.stock', compact('products', 'layout'));
    }

    public function create()
    {
        $layout = Auth::user()->role === 'admin' ? 'admin.navbar' : 'productManager.nav_productManager';

        $suppliers = Supplier::with('user')->get(); // assuming each supplier is linked to a user


        return view('inventory.create', compact('suppliers', 'layout'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role === 'admin') {
            $layout = 'admin.navbar';
        } elseif (Auth::user()->role === 'product_manager') {
            $layout = 'productManager.nav_productManager';
        } elseif (Auth::user()->role === 'stock_keeper') {
            $layout = 'stockKeeper.nav_stockKeeper';
        } else {
            abort(403); // Forbidden
        }
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'r_date'      => 'required|date',
            'p_price'     => 'required|numeric',
            'sell_price'  => 'required|numeric',
            'qty'         => 'required|integer',
            'discount'    => 'nullable|numeric',
            'product_type' => 'required|string',
            'product_id'    => 'required|exists:products,id',
        ]);

        Inventory::create([
            'product_id'   => $request->product_id,
            'product_type' => $request->product_type, // this must match the type of products selected
            'supplier_id'  => $request->supplier_id,
            'r_date'       => $request->r_date,
            'p_price'      => $request->p_price,
            'sell_price'   => $request->sell_price,
            'qty'          => $request->qty,
            'discount'     => $request->discount ?? 0,
        ]);


        return redirect()->route('inventory.index', compact('layout'))->with('success', 'Inventory created successfully.');
    }

    public function getProductsByType($type)
    {
        $products = Product::where('product_type', $type)->select('id', 'name')->get();
        return response()->json($products);
    }

    public function search(Request $request)
    {

        if (Auth::user()->role === 'admin') {
            $layout = 'admin.navbar';
        } elseif (Auth::user()->role === 'product_manager') {
            $layout = 'productManager.nav_productManager';
        } elseif (Auth::user()->role === 'stock_keeper') {
            $layout = 'stockKeeper.nav_stockKeeper';
        } else {
            abort(403); // Forbidden
        }

        $search = $request->search;
        $fromDate = $request->from_date;
        $toDate = $request->to_date;

        $query = Inventory::with('product', 'supplier');

        //Search Keyword
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('product', function ($q2) use ($search) {
                    $q2->where('name', 'like', "%$search%");
                })->orWhereHas('supplier', function ($q3) use ($search) {
                    $q3->where('name', 'like', "%$search%");
                });
            })->orWhere('sell_price', 'like', "%$search%")
                ->orWhere('p_price', 'like', "%$search%");
        }
        if (!empty($fromDate) && !empty($toDate)) {
            $query->whereBetween('r_date', [$fromDate, $toDate]);
        }

        $products = $query->paginate(10);

        return view('inventory.index', compact('products', 'search', 'fromDate', 'toDate', 'layout'));
    }
}
// $products = Inventory::select('product_id')
// ->selectRaw('SUM(qty) as total_qty')
// ->selectRaw('SUM(issue_qty) as total_issued')
// ->groupBy('product_id')
// ->whereHas('product', function ($query) {
//     $query->where('active', true);
// })
// ->with('product')
// ->get();