<?php
namespace App\Http\Controllers\Api\Personal;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index(){
        return json_encode(auth()->user());
    }
}
