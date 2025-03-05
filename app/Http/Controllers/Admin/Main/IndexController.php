<?php

namespace App\Http\Controllers\Admin\Main;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;

class IndexController extends \App\Http\Controllers\Controller
{
    public function index(){
        $cntUsers= Order::all()->count();
        $cntProducts = Product::all()->count();
        $cntOrders = Order::all()->count();
        return view('admin.main.index',compact('cntUsers','cntProducts','cntOrders'));
    }
}
