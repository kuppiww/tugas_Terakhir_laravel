<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', [ProductController::class, 'index']);

Route::get('/listproduk', [ProductController::class, 'lihatproduk']);

Route::get('/listproduk/input', [ProductController::class, 'input'])->name('listproduk.input');

Route::post('/listproduk', [ProductController::class, 'barang'])->name('listproduk.barang');

Route::get('/listproduk/listproduk', [ProductController::class, 'listproduk'])->name('listproduk.listproduk');

Route::get('/listproduk/index', [ProductController::class, 'index'])->name('listproduk.index');

Route::get('/listproduk/lihatproduk', [ProductController::class, 'lihatproduk'])->name('listproduk.lihatproduk');

Route::put('/listproduk/{product}', [ProductController::class, 'update'])->name('listproduk.update');

Route::get('/listproduk/{product}/formedit', [ProductController::class, 'formedit'])->name('listproduk.formedit');

Route::get('/listproduk', [ProductController::class, 'listproduk'])->name('listproduk');

Route::delete('/listproduk/{id}', [ProductController::class, 'delete'])->name('listproduk.delete');

Route::get('/listproduk/profile', [ProductController::class, 'userProfile'])->name('listproduk.userProfile');

Route::get('/listproduk/profile1', [ProductController::class, 'Profile'])->name('listproduk.Profile');




Route::get('/listproduk/merchant', [ProductController::class, 'merchant'])->name('listproduk.merchant');

Route::get('/merchant/input2', [ProductController::class, 'input2'])->name('merchant.input2');

Route::post('/merchant', [ProductController::class, 'barang'])->name('merchant.barang');

Route::get('/merchant/listproduk', [ProductController::class, 'listproduk'])->name('merchant.listproduk');

Route::get('/merchant/lihatproduk', [ProductController::class, 'lihatproduk'])->name('merchant.lihatproduk');

Route::put('/merchant/{product}', [ProductController::class, 'update'])->name('merchant.update');
