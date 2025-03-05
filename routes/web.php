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

Route::get('/admin', [\App\Http\Controllers\Admin\Main\IndexController::class, 'index'])->middleware('AdminMiddleware')->name('admin.main.index');
Route::get('/admin/orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.orders.index');
Route::get('/admin/orders/{order}/edit', [\App\Http\Controllers\Admin\OrderController::class, 'edit'])->name('admin.orders.edit');
Route::patch('/admin/orders/{order}/update', [\App\Http\Controllers\Admin\OrderController::class, 'update'])->name('admin.orders.update');

Route::resources(
    [
        'admin/categories' => \App\Http\Controllers\Admin\CategoryController::class,
        'admin/users' => \App\Http\Controllers\Admin\UserController::class,
        'admin/products' => \App\Http\Controllers\Admin\ProductController::class,
    ]
);


Auth::routes(['verify'=>true]);



