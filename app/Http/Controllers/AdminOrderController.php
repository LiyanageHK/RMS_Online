<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('details');

        // Apply filters
        if ($request->payment_status) {
            $query->where('payment_status', $request->payment_status);
        }

        if ($request->order_status) {
            $query->where('order_status', $request->order_status);
        }

        if ($request->from_date && $request->to_date) {
            $query->whereBetween('created_at', [$request->from_date, $request->to_date]);
        }

        $orders = $query->get();
        $cancelledCount = $orders->where('order_status', 'Cancelled')->count();
        $otherCount = $orders->count() - $cancelledCount;
       $year = now()->year;

        $ordersByMonth = Order::select(
                DB::raw("MONTH(created_at) as month"),
                DB::raw("COUNT(*) as count")
            )
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->pluck('count', 'month');

        $labels = [];
        $monthlyOrders = [];

        for ($month = 1; $month <= 5; $month++) {
            $labels[] = Carbon::create()->month($month)->format('M');
            $monthlyOrders[] = $ordersByMonth[$month] ?? 0;
        }

        return view('admin.orders', compact('orders','cancelledCount','otherCount','labels','monthlyOrders'));
    }

    public function delete($id)
    {
        Order::findOrFail($id)->delete();
        return back()->with('success', 'Order deleted!');
    }

    public function deleteAll()
    {
        Order::truncate(); // Deletes all records
        return back()->with('success', 'All orders deleted!');
    }

    public function downloadPDF($id)
    {
        $order = Order::with('details')->findOrFail($id);

        return PDF::loadView('pdf.single-order', compact('order'))
            ->download('order_' . $order->id . '.pdf');
    }

    public function downloadAllPDF(Request $request)
    {
        $query = Order::with('details');

        // Filters
        if ($request->payment_status) {
            $query->where('payment_status', $request->payment_status);
        }

        if ($request->order_status) {
            $query->where('order_status', $request->order_status);
        }

        if ($request->from_date && $request->to_date) {
            $query->whereBetween('created_at', [$request->from_date, $request->to_date]);
        }

        $orders = $query->get();

        // Analytics for charts
        $cancelledCount = $orders->where('order_status', 'Cancelled')->count();
        $otherCount = $orders->count() - $cancelledCount;

        $year = now()->year;

        $ordersByMonth = Order::select(
                DB::raw("MONTH(created_at) as month"),
                DB::raw("COUNT(*) as count")
            )
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->pluck('count', 'month');

        $labels = [];
        $monthlyOrders = [];

        for ($month = 1; $month <= 5; $month++) {
            $labels[] = Carbon::create()->month($month)->format('M');
            $monthlyOrders[] = $ordersByMonth[$month] ?? 0;
        }

        return PDF::loadView('pdf.all-orders', compact(
            'orders',
            'cancelledCount',
            'otherCount',
            'labels',
            'monthlyOrders'
        ))->download('all_orders.pdf');
    }
}
