<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Reorder;
use App\Models\Supplier;
use App\Models\User;
use App\Notifications\ReorderRequestNotification;
use App\Notifications\SupplierReorderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class ReorderController extends Controller
{

    public function manager_index()
    {
        $reorders = Reorder::with('inventory', 'supplier.user')
            ->get();
        return view('productManager.reorder', compact('reorders'));
    }

    public function supplier_index()
    {
        $supplier = Supplier::where('user_id', auth()->id())->first();

        $reorders = Reorder::with('inventory', 'supplier.user')
            ->where('supplier_id', $supplier->id)
            ->where('status', 'Confirmed')
            ->get();
        return view('supplier.reorder', compact('reorders', 'supplier'));
    }

    public function create(Request $request, $inventoryId)
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
        $inventories = Inventory::where('product_id', $inventoryId)
            ->with('supplier.user')
            ->orderBy('p_price', 'asc')
            ->get();
        return view('reorders.create', compact('inventories', 'layout'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'inventory_id' => 'required|exists:inventories,id',
            'requested_qty' => 'required|integer|min:1',

        ]);

        $inventory = Inventory::with('supplier.user', 'product')->findOrFail($request->inventory_id);


        $reorder = Reorder::create([
            'inventory_id' => $request->inventory_id,
            'supplier_id' => $request->supplier_id,
            'requested_qty' => $request->requested_qty,
            'status' => 'Pending',
            'supplier_approved' => false,
        ]);

        if (!$inventory->supplier_id) {
            Log::error('Inventory has no supplier_id', ['inventory_id' => $inventory->id]);
            return back()->with('error', 'Selected inventory has no supplier assigned.');
        }

        // Send notification to productManager's user account
        $managers = User::where('role', 'product_manager')->get();
        foreach ($managers as $manager) {
            $manager->notify(new ReorderRequestNotification($reorder, $inventory));
        }
        return redirect()->route('inventory.stock')->with('success', 'Reorder request sent.');
    }

    public function sendToSupplier(Reorder $reorder)
    {

        // Checking weather notification already sent
        if ($reorder->status === 'Confirmed') {
            return back()->with('error', 'Reorder already sent to supplier!');
        }

        $reorder->update(
            [
                'status' => 'Confirmed',
                'Reorder_confirm_at' => now(),
            ]
        );

        // Notify the supplier
        if ($reorder->supplier && $reorder->supplier->user) {
            $reorder->supplier->user->notify(new SupplierReorderNotification($reorder));
        }

        $supplierEmail = $inventory->supplier->user->email ?? null;

        if ($supplierEmail) {
            Notification::route('mail', $supplierEmail)
                ->notify(new SupplierReorderNotification($reorder));
        }
        return back()->with('success', 'Reorder sent to supplier successfully.');
    }
    public function manager_reject($id)
    {

        $reorders = Reorder::findOrFail($id);
        $reorders->status = 'Rejected';
        $reorders->save();

        return redirect()->back()->with('error', 'Rejected reorder request!!');
    }

    public function supplier_approve($id)
    {
        $reorder = Reorder::find($id);
        $reorder->supplier_approved = 1; // 1 = approved
        $reorder->supplier_approved_at = now();
        $reorder->save();

        return back()->with('success', 'Reorder request approved.');
    }

    public function supplier_reject($id)
    {
        $reorder = Reorder::find($id);
        $reorder->supplier_approved = 2; // 2 = Rejected
        $reorder->supplier_approved_at = now();
        $reorder->save();

        return back()->with('error', 'Reorder rejected.');
    }
}