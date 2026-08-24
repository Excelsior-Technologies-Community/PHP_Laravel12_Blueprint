<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController as ApiProductController;
use App\Http\Controllers\Api\CategoryController as ApiCategoryController;

Route::name('api.')->group(function () {

    Route::get('/products', [ApiProductController::class, 'index'])->name('products.index');
    Route::post('/products', [ApiProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}', [ApiProductController::class, 'show'])->name('products.show');
    Route::put('/products/{product}', [ApiProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ApiProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/categories', [ApiCategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [ApiCategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}', [ApiCategoryController::class, 'show'])->name('categories.show');
    Route::put('/categories/{category}', [ApiCategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [ApiCategoryController::class, 'destroy'])->name('categories.destroy');
});
