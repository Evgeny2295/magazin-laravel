<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\Product;

class IndexController extends Controller
{

    public function index()
    {
       $userId = auth()->user()->id;

        $orders = Orders::where('user_id',$userId)->get();

        foreach ($orders as $order) {
           $order->orderProducts = $order->getOrderProducts;
           foreach ($order->orderProducts as $orderProduct) {
               $orderProduct->title = Product::where('id',$orderProduct->product_id)->get()[0]['title'];
           }
        }
        return json_encode($orders);
    }
}
