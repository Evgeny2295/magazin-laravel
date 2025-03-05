<?php
namespace App\Http\Controllers\Api\SearchProduct;

use App\Http\Controllers\Controller;

use App\Http\Requests\Api\SearchProduct\IndexRequest;
use App\Models\Product;


class IndexController extends Controller
{
    public function index(IndexRequest $request)
    {

        $data = $request->validated();

        $products = Product::where('title','LIKE',"%{$data['s']}%")->paginate(1,['*'],'page',$data['page']);

        foreach ($products as $product) {
            $product['count'] = count($product->likedUsers);
        }
        return json_encode($products);

    }

}
