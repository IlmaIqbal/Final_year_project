<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ReportController extends Controller
{
    public function saleReport(Request $request)
    {
        // Daily sales breakdown

        $dailySales = Order::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total_price) as total'),
        )->groupBy('date')->orderBy('date')->get();

        //Monthly sales breakdown
        $monthlySales = Order::select(
            DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
            DB::raw('SUM(total_price) as total')
        )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        //Yearly sales Report
        $yearlySales = Order::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('sum(total_price) as total')
        )->groupBy('year')
            ->orderBy('year')
            ->get();


        // Breakdown Category-wise Sales

        //Group sales totals by product_type
        $orders = DB::table('orders')->select('items')->get();

        $totals = [];

        foreach ($orders as $order) {
            $items = json_decode($order->items, true);

            foreach ($items ?? [] as $item) {
                $type = $item['type'] ?? 'Unknown';
                $price = (float)($item['price'] ?? 0);
                $qty = (int)($item['quantity'] ?? 1);
                $lineTotal = $price * $qty;

                $totals[$type] = ($totals[$type] ?? 0) + $lineTotal;
            }
        }

        $categorySales = collect($totals)->map(fn($total, $type) => [
            'product_type' => ucfirst($type),
            'total' => $total,
        ])->values();


        $orders = Order::all()->map(function ($order) {
            // Extract last part after the last comma
            $parts = explode(',', $order->user_address);
            $order->region = trim(end($parts)); // e.g., "Colombo 07"
            return $order;
        });

        $regionSales = $orders->groupBy('region')->map(function ($group) {
            return $group->sum('total_price');
        });


        return view('report.saleReport', compact(
            'dailySales',
            'monthlySales',
            'yearlySales',
            'categorySales',
            'regionSales',
        ));
    }


    private function generateReportData(Request $request)
    {
        // Get the report type from request (daily, monthly, yearly). Default is 'daily'.
        $type = $request->input('type', 'daily');

        // Start building a query to get orders
        $orders = Order::query();


        // Filter order base on type and date input
        if ($type === 'daily' && $request->filled('date')) {
            // Filter by date
            $orders->whereDate('created_at', $request->date);

            // Filter Order base on type and month Input 
        } elseif ($type === 'monthly' && $request->filled('month')) {
            // Parse month and year from input
            $date = Carbon::parse($request->month);
            // separating month and year
            $orders->whereMonth('created_at', $date->month)->whereYear('created_at', $date->year);

            // Filter Order base on type and year Input 
        } elseif ($type === 'yearly' && $request->filled('year')) {
            // get the year using created_at column
            $orders->whereYear('created_at', $request->year);
        }

        // Get all filtered orders from database
        $orders = $orders->get();

        // Get optional category filter (like gift, bouquet, etc.)
        $selectedType = $request->input('category'); // optional category filter
        // This will store the final report data
        $reportData = collect();

        foreach ($orders as $order) {
            $items = json_decode($order->items, true);

            foreach ($items as $item) {
                if ($selectedType && $item['type'] !== $selectedType) {
                    continue;
                }

                $label = match ($type) {
                    'daily' => $order->created_at->format('Y-m-d'),
                    'monthly' => $order->created_at->format('Y-m'),
                    'yearly' => $order->created_at->format('Y'),
                    'category' => $item['type'],
                    'region' => explode(',', $order->user_address)[count(explode(',', $order->user_address)) - 1] ?? 'Unknown',
                    default => 'Unknown',
                };

                $quantity = $item['quantity'];
                $revenue = $item['price'] * $quantity;

                if (!$reportData->has($label)) {
                    $reportData[$label] = ['quantity' => 0, 'revenue' => 0];
                }


                $existing = $reportData->get($label);
                $existing['quantity'] += $quantity;
                $existing['revenue'] += $revenue;
                $reportData->put($label, $existing);
            }
        }

        return [$reportData, $type];
    }

    public function viewFilteredReport(Request $request)
    {

        [$reportData, $type] = $this->generateReportData($request);
        return view('report.saleReportView', compact('reportData', 'type'));
    }

    public function downloadReport(Request $request)
    {
        [$reportData, $type] = $this->generateReportData($request);

        $pdf = Pdf::loadView('report.downloadSaleReport', compact('reportData', 'type'));
        return $pdf->download('Sales_Report.pdf');
    }

    public function inventoryReport()
    {
        $stocks = Inventory::select('product_id')
            ->selectRaw('SUM(qty) as total_qty')
            ->selectRaw('SUM(issue_qty) as total_issued')
            ->groupBy('product_id')
            ->whereHas('product')
            ->with('product')
            ->get();


        return [$stocks];
    }

    public function redirectToReport(Request $request)
    {
        $type = $request->input('type');

        if ($type === 'stockLevel') {
            return redirect()->route('report.inventoryReport.stockLevel');
        } elseif ($type === 'topSellProduct') {
            return redirect()->route('report.inventoryReport.topSellProduct');
        } elseif ($type === 'reorder') {
            return redirect()->route('report.inventoryReport.reorderReport');
        } else {
            return back()->with('error', 'Please Select report!');
        }
    }

    public function stockLevel(Request $request)
    {

        [$stocks] = $this->inventoryReport($request);

        return view('report.inventoryReport.stockLevel', compact('stocks'));
    }

    public function downloadInventoryReport(Request $request)
    {

        [$stocks] = $this->inventoryReport($request);

        $pdf = Pdf::loadView('report.inventoryReport.downloadInventoryReport', compact('stocks'));
        return $pdf->download('Stock_Level_Report.pdf');
    }

    public function topSellProduct(Request $request)
    {
        // Ensure the order exists
        [$stocks] = $this->inventoryReport($request);

        return view('report.inventoryReport.topSellProduct', compact('stocks'));
    }

    public function downloadTopSellProductReport(Request $request)
    {

        [$stocks] = $this->inventoryReport($request);

        $pdf = Pdf::loadView('report.inventoryReport.downloadTopSellProductReport', compact('stocks'));
        return $pdf->download('Top_Sell_Report.pdf');
    }

    public function reorder(Request $request)
    {
        // Ensure the order exists
        $stocks = Inventory::select('inventories.product_id')
            ->join('products', 'inventories.product_id', '=', 'products.id')
            ->selectRaw('SUM(qty) as total_qty')
            ->selectRaw('SUM(issue_qty) as total_issued')
            ->selectRaw('SUM(qty) - SUM(issue_qty) as available_qty')
            ->selectRaw('products.reorder_level as reorder_level')
            ->groupBy('inventories.product_id', 'products.reorder_level')
            ->havingRaw('available_qty < reorder_level')
            ->with('product')
            ->get();


        return view('report.inventoryReport.reorderReport', compact('stocks'));
    }

    public function downloadReorderReport(Request $request)
    {

        $stocks = Inventory::select('inventories.product_id')
            ->join('products', 'inventories.product_id', '=', 'products.id')
            ->selectRaw('SUM(qty) as total_qty')
            ->selectRaw('SUM(issue_qty) as total_issued')
            ->selectRaw('SUM(qty) - SUM(issue_qty) as available_qty')
            ->selectRaw('products.reorder_level as reorder_level')
            ->groupBy('inventories.product_id', 'products.reorder_level')
            ->havingRaw('available_qty < reorder_level')
            ->with('product')
            ->get();

        $pdf = Pdf::loadView('report.inventoryReport.downloadReorderReport', compact('stocks'));
        return $pdf->download('Reorder_Report.pdf');
    }
}
