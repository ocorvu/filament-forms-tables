<?php

use App\Http\Livewire\CategoryDetails;
use App\Http\Livewire\CreateCategory;
use App\Http\Livewire\CreateProduct;
use App\Http\Livewire\EditProduct;
use App\Http\Livewire\ProductDetails;
use App\Http\Livewire\ShowCategories;
use App\Http\Livewire\ShowProducts;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products/edit/{product}', EditProduct::class)->name('products.edit');

Route::get('/products/create', CreateProduct::class)->name('products.create');

Route::get('/products', ShowProducts::class)->name('products.show');

Route::get('/products/{product}', ProductDetails::class)->name('products.details');

Route::get('/categories', ShowCategories::class)->name('categories.show');

Route::get('/categories/create', CreateCategory::class)->name('categories.create');

Route::get('/categories/{category}', CategoryDetails::class)->name('categories.details');
