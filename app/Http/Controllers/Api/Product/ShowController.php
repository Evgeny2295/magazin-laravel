<?php
namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Admin\Category;
use App\Models\Product;


class ShowController extends Controller
{
    public function show(Product $product)
    {
        $product['count'] = count($product->likedUsers);
        return json_encode($product);
    }

}
