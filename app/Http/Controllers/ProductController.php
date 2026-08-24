<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Exports\ProductsExport;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    // LIST + SEARCH + FILTER + SORT
    public function index(Request $request): View
    {
        $query = Product::with('category');

        // Search
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Category Filter
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Status Filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Min Price
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        // Max Price
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Sort
        $sortBy = $request->get('sort_by', 'id');
        $sortDir = $request->get('sort_dir', 'asc');
        $allowedSort = ['id', 'name', 'price', 'created_at'];
        if (!in_array($sortBy, $allowedSort)) {
            $sortBy = 'id';
        }
        $sortDir = in_array(strtolower($sortDir), ['asc', 'desc']) ? strtolower($sortDir) : 'asc';
        $query->orderBy($sortBy, $sortDir);

        $products = $query->paginate(4)->withQueryString();

        return view('product.index', compact('products'));
    }

    // CREATE FORM
    public function create(): View
    {
        $categories = Category::all();
        return view('product.create', compact('categories'));
    }

    // STORE
    public function store(ProductStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    // EDIT FORM
    public function edit(Product $product): View
    {
        $categories = Category::all();
        return view('product.edit', compact('product', 'categories'));
    }

    // UPDATE
    public function update(ProductUpdateRequest $request, Product $product): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
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
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    // Bulk Actions
    public function bulkDestroy(Request $request): RedirectResponse
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:products,id',
        ]);

        Product::whereIn('id', $request->ids)->each(function ($product) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $product->delete();
        });

        return redirect()->route('products.index')->with('success', count($request->ids) . ' products deleted successfully.');
    }

    public function bulkStatus(Request $request): RedirectResponse
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:products,id',
            'status' => 'required|in:active,inactive',
        ]);

        $status = $request->status === 'active' ? true : false;
        Product::whereIn('id', $request->ids)->update(['status' => $status]);

        return redirect()->route('products.index')->with('success', count($request->ids) . ' products status updated successfully.');
    }

    // Export
    public function export(Request $request)
    {
        return Excel::download(new ProductsExport([
            'search' => $request->get('search'),
            'category_id' => $request->get('category_id'),
            'status' => $request->get('status'),
            'min_price' => $request->get('min_price'),
            'max_price' => $request->get('max_price'),
        ]), 'products.csv');
    }
}