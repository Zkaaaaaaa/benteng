<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        // ── Stat cards ────────────────────────────────────────────
        $totalProducts = Product::query()->count('*');
        $totalCategories = Category::query()->count('*');

        $startOfMonth = now()->startOfMonth();
        $newProductsThisMonth = Product::query()
            ->where('created_at', '>=', $startOfMonth)
            ->where('created_at', '<', $startOfMonth->copy()->addMonth())
            ->count('*');

        // ── Recent products (laatste 6) ───────────────────────────
        $recentProducts = Product::with('category')
            ->latest()
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
            'newProductsThisMonth',
            'recentProducts',
            'categories',
            'categoryChartData',
            'recentActivities',
        ));
    }
}