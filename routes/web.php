<?php

use App\Http\Livewire\CreateProduct;
use App\Http\Livewire\EditProduct;
use App\Http\Livewire\ShowProducts;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/edit/{product}', EditProduct::class);

Route::get('/create', CreateProduct::class);

Route::get('/products', ShowProducts::class);
