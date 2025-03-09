<?php

namespace App\Http\Controllers\Admin\Main;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class IndexController extends \App\Http\Controllers\Controller
{
    public function index(){
        $cntUsers= User::all()->count();

        $cntProducts = Product::all()->count();

        $cntOrders = Order::all()->count();

        return view('admin.main.index',compact('cntUsers','cntProducts','cntOrders'));
    }
}
