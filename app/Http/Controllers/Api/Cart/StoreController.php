<?php
namespace App\Http\Controllers\Api\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Cart\StoreRequest;
use App\Models\OrderProducts;
use App\Models\Order;
use Exception;
use Illuminate\Database\Events\TransactionBeginning;
use Illuminate\Support\Facades\DB;


class StoreController extends Controller
{
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $collection = collect($data['products']);

        $qty = $collection->pluck('qty')->sum();

        $total = $collection->pluck('price')->sum();

        try {
            DB::beginTransaction();
            $order_id = Order::create([
                'user_id'=>auth()->user()->id,
                'note'=>'fdfdf',
                'total'=>$total,
                'qty'=>$qty
            ]);

            foreach ($data['products'] as $product) {
                OrderProducts::create([
                    'order_id'=>$order_id->id,
                    'product_id'=>$product['productId'],
                    'qty'=>$product['qty'],
                    'price'=>$product['price'],
                    'sum'=>$product['price']*$product['qty'],
                ]);
            }
            DB::commit();

        }catch (Exception $e){
            DB::rollBack();

            return json_encode('Ошибка добавления');
        }



    }
}
