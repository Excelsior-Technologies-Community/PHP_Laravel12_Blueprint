<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): Response
    {
        $products = Product::all();

        return view('product.index', [
            'products' => $products,
        ]);
    }

    public function store(ProductStoreRequest $request): Response
    {
        $product = Product::create($request->validated());

        return redirect()->route('product.index');
    }
}
