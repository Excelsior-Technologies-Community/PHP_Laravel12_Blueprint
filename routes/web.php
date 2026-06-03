<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

// FULL PRODUCT CRUD ROUTE
Route::resource('products', ProductController::class);

Route::patch('/products/{product}/toggle-status', 
    [ProductController::class, 'toggleStatus']
)->name('products.toggleStatus');

Route::get('/test', function () {
    return "Blueprint Working!";
});
