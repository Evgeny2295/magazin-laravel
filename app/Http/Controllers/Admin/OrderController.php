<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Order\UpdateRequest;
use App\Http\Requests\Api\Personal\UpdatedRequest;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(){

        $orders = Order::paginate(5);

        return view('admin.orders.index',compact('orders'));

    }
    public function edit(Order $order){

        $orderProducts = $order->getOrderProducts;

        return view('admin.orders.edit',compact('order','orderProducts'));
    }

    public function update(UpdateRequest $request, Order $order){
        $data = $request->validated();

        $order->update($data);

        return redirect()->route('admin.orders.edit',compact('order'));
    }
}
