<?php
namespace App\Http\Controllers\Api\Wishlist;

use App\Http\Controllers\Controller;
use App\Models\Product;

class StoreController extends Controller
{
    public function store(Product $product){
        auth()->user()->likedProducts()->toggle($product->id);
    }

}
