<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalProducts = Product::count();
        $activeProducts = Product::where('status', true)->count();
        $inactiveProducts = Product::where('status', false)->count();
        $totalCategories = Category::count();
        $activeCategories = Category::where('status', true)->count();
        $totalRevenue = Product::where('status', true)->sum('price');

        $recentProducts = Product::with('category')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalProducts',
            'activeProducts',
            'inactiveProducts',
            'totalCategories',
            'activeCategories',
            'totalRevenue',
            'recentProducts'
        ));
    }
}
