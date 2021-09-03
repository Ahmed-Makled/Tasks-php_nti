<?php

use App\Http\Controllers\apis\productsApiController;
use App\Http\Controllers\apis\userApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::get('products/all', productsApiController::class, 'index');

Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
    Route::get('all', [productsApiController::class, 'index'])->name('index');
    Route::get('create', [productsApiController::class, 'create'])->name('create');
    Route::get('edit/{id}', [productsApiController::class, 'edit'])->name('edit');
    Route::post('store', [productsApiController::class, 'store'])->name('store');
    Route::post('update}', [productsApiController::class, 'update'])->name('update');
    Route::delete('destroy/{id}', [productsApiController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('register', [userApiController::class, 'register']);
    Route::post('login', [userApiController::class, 'login']);

    Route::group(['middleware' => 'ApiAuth'], function () {
        Route::post('send-code', [userApiController::class, 'sendCode']);
        Route::post('verify-code', [userApiController::class, 'verifyCode']);
    });

    Route::group(['middleware' => 'ApiVerified'], function () {
        Route::post('logout', [userApiController::class, 'logout']);
        Route::get('profile', [userApiController::class, 'profile']);
        Route::post('update-profile', [userApiController::class, 'updateProfile']);
    });
});