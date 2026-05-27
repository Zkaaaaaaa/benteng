<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // ── Stat cards ────────────────────────────────────────────
        $totalProducts      = Product::count();
        $totalCategories    = Category::count();
        $inStockCount       = Product::where('stock', '>', 0)->count();
        $outOfStockCount    = Product::where('stock', '<=', 0)->count();
        $totalStockValue    = Product::selectRaw('SUM(price * stock) as total')->value('total') ?? 0;
        $newProductsThisMonth = Product::whereMonth('created_at', now()->month)
                                       ->whereYear('created_at', now()->year)
                                       ->count();

        // ── Recent products (laatste 6) ───────────────────────────
        $recentProducts = Product::with('category')
            ->latest()
            ->take(6)
            ->get();

        // ── Low stock (≤ 5, inclusief uitverkocht) ────────────────
        $lowStockProducts = Product::with('category')
            ->where('stock', '<=', 5)
            ->orderBy('stock', 'asc')
            ->take(6)
            ->get();

        // ── Categories with product count ─────────────────────────
        $categories = Category::withCount('products')
            ->orderBy('products_count', 'desc')
            ->get();

        // ── Chart data: products per category ─────────────────────
        $categoryChartData = [
            'labels' => $categories->pluck('name')->toArray(),
            'values' => $categories->pluck('products_count')->toArray(),
        ];

        // ── Recent activity feed (optioneel: vervang door model) ──
        // Hier kun je een Activity/Log model koppelen.
        // Nu wordt een lege array meegegeven; het view toont dan
        // de fallback-placeholder activiteiten.
        $recentActivities = [];

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'inStockCount',
            'outOfStockCount',
            'totalStockValue',
            'newProductsThisMonth',
            'recentProducts',
            'lowStockProducts',
            'categories',
            'categoryChartData',
            'recentActivities',
        ));
    }
}