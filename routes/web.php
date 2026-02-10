<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('products', App\Http\Controllers\ProductController::class)->only('index', 'store');


Route::resource('products', App\Http\Controllers\ProductController::class)->only('index', 'store');

Route::get('/test', function(){
    return "Blueprint Working!";
});
