<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Notifications\CashierNotification;
use App\Notifications\deliverNotification;
use App\Notifications\StockKeeperOrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function view_order()

    {
        $layout = Auth::user()->role === 'admin' ? 'admin.navbar' : 'productManager.nav_productManager';

        $orders = Order::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.order', compact('orders', 'layout'));
    }
    public function stockKeeper_view_order()

    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);
        return view('stockKeeper.order', compact('orders'));
    }

    public function delivered($id)
    {
        $order = Order::find($id);

        $order->delivery = "Delivered";

        $order->save();

        return redirect()->back();
    }

    public function confirmed($id)
    {
        $order = Order::find($id);

        $order->delivery = "Confirmed";

        $order->issue_status = "Ongoing";   // Set issue status

        $order->save();

        return redirect()->back();
    }

    public function customer_order()
    {
        $id = Auth::user()->id;

        $orders = Order::where('user_id', '=', $id)->orderBy('created_at', 'desc')->paginate(10);
        return view('user.order', compact('orders'));
    }

    public function deliver_order()
    {
        $id = Auth::user()->id;

        $orders = Order::where('deliver_by', '=', $id)->orderBy('created_at', 'desc')->paginate(10);
        return view('deliver.order', compact('orders'));
    }



    public function show_details($orderId)
    {
        // Retrieve order from the database
        $order = Order::find($orderId);

        // Check if order exists
        if (!$order) {
            return redirect()->route('user.home')->with('error', 'Order not found.');
        }

        // Decode order items safely
        $orderItem = $order->items ? json_decode($order->items, true) : [];

        return view('user.order-details', compact('order', 'orderItem'));
    }
    public function bank_recipe($orderId)
    {
        // Retrieve order from the database
        $order = Order::find($orderId);

        // Check if order exists
        if (!$order) {
            return redirect()->route('user.home')->with('error', 'Order not found.');
        }

        // Decode order items safely
        $orderItem = $order->items ? json_decode($order->items, true) : [];

        return view('user.bank_recipe', compact('order', 'orderItem'));
    }

    public function admin_order_details($orderId)
    {
        if (Auth::user()->role === 'admin') {
            $layout = 'admin.navbar';
        } elseif (Auth::user()->role === 'product_manager') {
            $layout = 'productManager.nav_productManager';
        } elseif (Auth::user()->role === 'stock_keeper') {
            $layout = 'stockKeeper.nav_stockKeeper';
        } elseif (Auth::user()->role === 'cashier') {
            $layout = 'cashier.nav_cashier';
        } else {
            abort(403); // Forbidden
        }
        // Retrieve order from the database
        $orders = Order::find($orderId);

        // Check if order exists
        if (!$orders) {
            return redirect()->route('admin.home')->with('error', 'Order not found.');
        }

        // Decode order items safely
        $orderItem = $orders->items ? json_decode($orders->items, true) : [];

        return view('admin.order-details', compact('orders', 'orderItem', 'layout'));
    }

    public function update_order_status(Request $request, $orderId)
    {
        $order = \App\Models\Order::findOrFail($orderId);

        if ($request->action === 'Confirmed') {

            $order->order_status = 'Confirmed';
            $order->issue_status = "Ongoing";   // Set issue status

            $order->confirmed_at = now();

            $items = json_decode($order->items, true);

            $order->save();
            // Notify all stock keepers
            $stockKeepers = User::where('role', 'stock_keeper')->get();
            foreach ($stockKeepers as $keeper) {
                $keeper->notify(new StockKeeperOrderNotification($order));
            }

            return redirect()->back()->with('success', '✅ Order successfully confirmed.');
        } elseif ($request->action === 'Delivered') {
            $order->delivery = 'Delivered';
            $order->delivered_at = now();
            $order->save();
            return redirect()->back()->with('success', '✅ Order successfully delivered.');
        }
        return redirect()->back();
    }



    public function invoice()
    {

        $id = Auth::user()->id;
        $items = Cart::where('user_id', '=', $id)->get();
        return view('emails.invoice', compact('items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'user_name' => 'required|string',
            'user_email' => 'required|email',
            'user_address' => 'required|string',
            'phone' => 'required|string',
            'billing_name' => 'required|string',
            'billing_email' => 'required|email',
            'billing_address' => 'required|string',
            'billing_phone' => 'required|string',
            'payment_method' => 'required|string',
            'items' => 'required|array',
            'items.*.id' => 'required|integer',
            'items.*.type' => 'required|string',
            'items.*.name' => 'required|string',
            'items.*.detail' => 'nullable|string',
            'items.*.image' => 'nullable|string',
            'items.*.price' => 'required|numeric',
            'items.*.quantity' => 'required|integer',
            'total_price' => 'required|numeric',
        ]);

        //Make sure user exists
        $user = User::find($validated['user_id']);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // 🛒 Create order with user data
        $order = Order::create([
            'user_id' => $user->id,
            'user_name' => $validated['user_name'],
            'user_email' => $validated['user_email'],
            'user_address' => $validated['user_address'],
            'phone' => $validated['phone'],
            'billing_name' => $validated['billing_name'],
            'billing_email' => $validated['billing_email'],
            'billing_address' => $validated['billing_address'],
            'billing_phone' => $validated['billing_phone'],
            'payment_method' => $validated['payment_method'],
            'items' => json_encode($validated['items']), // Store items as JSON
            'total_price' => $validated['total_price'],
            'delivery' => 'Processing',
            'issue_status' => 'Ongoing',
            'payment' => in_array($validated['payment_method'], ['CashOnDelivery', 'BankTransfer']) ? 'Pending' : 'Paid',


        ]);
        if ($request->input('payment_method') === 'OnlinePayment') {
            $order->paid_at = $request->input('paid_at');
        }
        $order->save();


        return response()->json(['success' => true, 'order_id' => $order->id]);
    }
    public function onlineConfirmation(Request $request)
    {
        $orderId = $request->query('order_id'); // fetch from ?order_id=...

        return view('user.online-confirmation', compact('orderId'));
    }

    public function show_invoice(Order $order)
    {
        // Ensure the order exists
        if (!$order) {
            return redirect()->route('user.home')->with('error', 'Order not found.');
        }

        // Fetch order items
        $orderItems = json_decode($order->items, true); // Ensure it's an array

        return view('user.order-confirmation', compact('order', 'orderItems'));
    }

    public function update_issue_status(Request $request, $orderId)
    {

        $order = Order::findOrFail($orderId);

        if ($request->action === 'Issued') {
            $order->issue_status = 'Issued';
            $order->issued_at = now();

            $items = json_decode($order->items, true);

            foreach ($items as $item) {
                $inventory = Inventory::find($item['id']);
                if (!$inventory) {
                    return redirect()->back()->with('error', "Inventory item not found.");
                }

                $available_qty = $inventory->qty - $inventory->issue_qty;

                if ($available_qty < $item['quantity']) {
                    return redirect()->back()->with('error', "❌ '{$item['name']}' is out of stock. Only $available_qty available.");
                }

                // Proceed to update issue_qty
                $inventory->issue_qty += $item['quantity'];
                $inventory->save();

                // Notify all Cashier
                $cashiers = User::where('role', 'cashier')->get();
                foreach ($cashiers as $cashier) {
                    $cashier->notify(new CashierNotification($order));
                }
                // Notify all deliver
                $delivers = User::where('role', 'deliver')->get();
                foreach ($delivers as $deliver) {
                    $deliver->notify(new deliverNotification($order));
                }
            }

            $order->save();
            return redirect()->back()->with('success', '✅ Order successfully confirmed.');
        }
    }

    public function update_delivery(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);


        $order->update([
            'delivery' => 'outForDelivery',
            'vehicle_no' => $request->vehicle_no,
            'estimate_date' => $request->estimate_date,
            'deliver_by' => auth()->user()->id, // deliver by whom
        ]);

        return redirect()->back()->with('success', 'Order Accepted!');
    }

    public function recipe_update(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);


        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        } else {
            unset($input['image']);
        }

        $order->update($input);


        return redirect()->back()->with('success', 'Successfully added!');
    }
    public function order_delivered(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        if ($request->action === 'Delivered') {
            $order->delivery = 'Delivered';
            $order->delivered_at = now();

            $order->save();
            return redirect()->back()->with('success', 'Order Delivered!');
        }
    }
}
