<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Home -> Dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Product CRUD + Features
Route::resource('products', ProductController::class);
Route::patch('/products/{product}/toggle-status', [ProductController::class, 'toggleStatus'])
    ->name('products.toggleStatus');
Route::post('/products/bulk-delete', [ProductController::class, 'bulkDestroy'])
    ->name('products.bulkDestroy');
Route::post('/products/bulk-status', [ProductController::class, 'bulkStatus'])
    ->name('products.bulkStatus');
Route::get('/products/export', [ProductController::class, 'export'])
    ->name('products.export');

// Category CRUD
Route::resource('categories', CategoryController::class);
Route::patch('/categories/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])
    ->name('categories.toggleStatus');

// Test
Route::get('/test', function () {
    return "Blueprint Working!";
});

// Breeze auth
require __DIR__.'/auth.php';
