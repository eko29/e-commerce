<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;

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
    return view('content.home');
});
Route::get('/home', function () {
    return view('content.home');
});

Route::get('/product/detail/{token}', [ProductController::class, 'detail'])->name('product.detail');
Route::post('/register-new-member', [RegisterController::class, 'register'])->name('register.new');
Route::group(['middleware' => ['auth:web', 'verified']], function() {
    Route::get('/add-cart', [ProductController::class, 'addcart'])->name('product.addcart');
    Route::get('/add-cart/po', [ProductController::class,'po'])->name('produk.addcart.po');
});