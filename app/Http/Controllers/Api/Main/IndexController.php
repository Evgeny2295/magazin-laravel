<?php
namespace App\Http\Controllers\Api\Main;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Admin\Category;

class IndexController extends Controller
{
    public function indexAction()
    {
        $categories = Category::all();

        return CategoryResource::collection($categories);
    }

}
