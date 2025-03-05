<?php
namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;

class IndexController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return json_encode(CategoryResource::collection($categories));
    }

}
