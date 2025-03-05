<?php
namespace App\Http\Controllers\Api\Category\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Category\Product\IndexRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;

class IndexController extends Controller
{
    public function index(Category $category,IndexRequest $request)
    {
        $data = $request->validated();
        $products = $category->products()->paginate(1,['*'],'page',$data['page']);
        if(!empty($products)) {
            foreach ($products as $product){
                $product['countLikes'] = count($product->likedUsers);
                $product['categoryTitle'] = $category->title;
            }

        }

        return json_encode($products);
    }

}
