<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
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
        $type = $request->input('type', 'daily');
        $orders = Order::query();

        if ($type === 'daily' && $request->filled('date')) {
            $orders->whereDate('created_at', $request->date);
        } elseif ($type === 'monthly' && $request->filled('month')) {
            $date = Carbon::parse($request->month);
            $orders->whereMonth('created_at', $date->month)->whereYear('created_at', $date->year);
        } elseif ($type === 'yearly' && $request->filled('year')) {
            $orders->whereYear('created_at', $request->year);
        }

        $orders = $orders->get();

        $selectedType = $request->input('category'); // optional category filter
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
}
