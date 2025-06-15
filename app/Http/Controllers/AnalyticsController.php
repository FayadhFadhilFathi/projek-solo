<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function dashboard()
    {
        // Data penjualan
        $todaySales = Order::whereDate('created_at', today())->sum('total_price');
        $weeklySales = Order::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->sum('total_price');
        $monthlySales = Order::whereMonth('created_at', now()->month)->sum('total_price');
        
        // Produk terlaris
        $bestSellingProducts = Product::withCount(['orders as total_orders' => function($query) {
                $query->where('status', 'paid');
            }])
            ->orderByDesc('total_orders')
            ->take(5)
            ->get();
        
        // Pelanggan aktif
        $activeCustomers = User::whereHas('orders', function($query) {
                $query->where('created_at', '>', now()->subMonth());
            })
            ->withCount(['orders as order_count' => function($query) {
                $query->where('status', 'paid');
            }])
            ->orderByDesc('order_count')
            ->take(5)
            ->get();
        
        // Data grafik penjualan bulanan
        $monthlySalesData = [];
        for ($i = 0; $i < 6; $i++) {
            $month = now()->subMonths($i);
            $total = Order::whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                ->sum('total_price');
            
            $monthlySalesData[] = [
                'month' => $month->format('M Y'),
                'total' => $total
            ];
        }
        
        $monthlySalesData = array_reverse($monthlySalesData);
        
        return view('admin.analytics.dashboard', compact(
            'todaySales',
            'weeklySales',
            'monthlySales',
            'bestSellingProducts',
            'activeCustomers',
            'monthlySalesData'
        ));
    }
}