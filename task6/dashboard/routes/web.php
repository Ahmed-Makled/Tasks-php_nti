<?php

use App\Http\Controllers\backend\indexController;
use App\Http\Controllers\backend\productController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

Route::get('/', [indexController::class, 'index']);

Route::get('/', [indexController::class, 'index']);
Route::get('products/all', [productController::class, 'index'])->name('products.index');
Route::get('products/create', [productController::class, 'create'])->name('products.create');
Route::get('products/edit/{id}', [productController::class, 'edit'])->name('products.edit');
Route::post('products/store', [ProductController::class, 'store'])->name('products.store');
Route::put('products/update/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('products/destroy/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

Route::group(['prefix' => 'dashboard'], function () {
    Auth::routes(['verify' => true,]);
    Route::group(['middleware' => 'verified'], function () {
        Route::get('/', [indexController::class, 'dashboard'])->name('dashboard');
        Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
            Route::get('all', [ProductController::class, 'index'])->name('index');
            // Route::get('create', [ProductController::class, 'create'])->name('create')->middleware('password.confirm');
            Route::get('create', [ProductController::class, 'create'])->name('create');
            Route::get('edit/{id}', [ProductController::class, 'edit'])->name('edit');
            Route::post('store', [ProductController::class, 'store'])->name('store');
            Route::put('update/{product_id}', [ProductController::class, 'update'])->name('update');
            Route::delete('destroy/{id}', [ProductController::class, 'destroy'])->name('destroy');
        });
    });
});
// Auth::routes(['verify' => true]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');