<?php
namespace App\Http\Controllers\Api\Wishlist;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;

class IndexController extends Controller
{
    public function index(){
        return json_encode(auth()->user()->likedProducts);
    }

}
