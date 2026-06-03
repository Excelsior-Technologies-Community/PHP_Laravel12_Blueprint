<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    // LIST + SEARCH
    public function index(Request $request): View
    {
        $query = Product::with('category');

        // Search
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Min Price
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        // Max Price
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->orderBy('id', 'asc')
            ->paginate(4)
            ->withQueryString();

        return view('product.index', compact('products'));
    }

    // CREATE FORM
    public function create(): View
    {
        $categories = Category::all();
        return view('product.create', compact('categories'));
    }

    // STORE
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable'
        ]);

        Product::create($request->all());

        return redirect()->route('products.index');
    }

    // EDIT FORM
    public function edit(Product $product): View
    {
        $categories = Category::all();
        return view('product.edit', compact('product', 'categories'));
    }

    // UPDATE
    public function update(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable'
        ]);

        $product->update($request->all());

        return redirect()->route('products.index');
    }

    public function toggleStatus(Product $product)
    {
        $product->status = !$product->status;
        $product->save();

        return redirect()->back()->with(
            'success',
            $product->status
            ? 'Product activated successfully.'
            : 'Product deactivated successfully.'
        );
    }

    // 🗑 DELETE
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('products.index');
    }
}