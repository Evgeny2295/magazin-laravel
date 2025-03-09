<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
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
Route::get('/',[\App\Http\Controllers\MainController::class,'index'])->name('main.index');

Route::prefix('admin')->group(function(){
    Route::middleware([])->group(function(){ //Временно убрал middleware admin
        Route::get('/', [\App\Http\Controllers\Admin\Main\IndexController::class, 'index'])->name('admin.main.index');
        Route::get('/orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.orders.index');
        Route::get('/orders/{order}/edit', [\App\Http\Controllers\Admin\OrderController::class, 'edit'])->name('admin.orders.edit');
        Route::patch('/orders/{order}/update', [\App\Http\Controllers\Admin\OrderController::class, 'update'])->name('admin.orders.update');

        Route::resources(
            [
                'categories' => \App\Http\Controllers\Admin\CategoryController::class,
                'users' => \App\Http\Controllers\Admin\UserController::class,
                'products' => \App\Http\Controllers\Admin\ProductController::class,
            ]
        );
    });
});


Auth::routes(['verify'=>true]);


