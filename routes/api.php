<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Api routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/categories',[\App\Http\Controllers\Api\Category\IndexController::class,'index']);
Route::get('/categories/{category}/products',[\App\Http\Controllers\Api\Category\Product\IndexController::class,'index']);
Route::get('/search_product',[\App\Http\Controllers\Api\SearchProduct\IndexController::class,'index']);
Route::get('/product/{product}',[\App\Http\Controllers\Api\Product\ShowController::class,'show']);

Route::prefix('/users')->group(function (){
    Route::post('/',[\App\Http\Controllers\Api\User\StoreController::class,'store']);
    Route::get('/',[\App\Http\Controllers\Api\User\IndexController::class,'index']);
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class,'login']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);

    Route::get('personal',[\App\Http\Controllers\Api\Personal\IndexController::class,'index'])->middleware('jwt.auth');
    Route::patch('personal',[\App\Http\Controllers\Api\Personal\UpdateController::class,'update'])->middleware('jwt.auth');

    Route::get('wishlist',[\App\Http\Controllers\Api\Wishlist\IndexController::class,'index'])->middleware('jwt.auth');
    Route::post('wishlist/{product}',[\App\Http\Controllers\Api\Wishlist\StoreController::class,'store'])->middleware('jwt.auth');

    Route::post('cart',[\App\Http\Controllers\Api\Cart\StoreController::class,'store'])->middleware('jwt.auth');
    Route::get('orders',[\App\Http\Controllers\Api\Order\IndexController::class,'index'])->middleware('jwt.auth');

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
