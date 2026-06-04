<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class AdminHomeController extends Controller
{
    public function index()
    {
        $stats = [
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', Order::STATUS_PENDING)->count(),
            'total_revenue' => Order::where('status', Order::STATUS_DELIVERED)->sum('total'),
            'total_products' => Product::count(),
            'out_of_stock' => Product::where('stock', '<=', 0)->count(),
            'total_users' => User::count(),
        ];

        $recentOrders = Order::with('user')->latest()->take(5)->get();
        $latestProducts = Product::with('category')->latest()->take(5)->get();

        // 6-Month sales trends (Delivered orders)
        $salesLabels = [];
        $salesData = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $salesLabels[] = $date->translatedFormat('F Y');
            $salesData[] = (float) Order::where('status', Order::STATUS_DELIVERED)
                ->whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->sum('total');
        }

        // Product category counts (only categories with products)
        $categoryData = Category::withCount('products')
            ->having('products_count', '>', 0)
            ->get();
        $categoryLabels = $categoryData->pluck('title')->toArray();
        $categoryCounts = $categoryData->pluck('products_count')->toArray();

        return view('admin.index', compact(
            'stats',
            'recentOrders',
            'latestProducts',
            'salesLabels',
            'salesData',
            'categoryLabels',
            'categoryCounts'
        ));
    }
}
