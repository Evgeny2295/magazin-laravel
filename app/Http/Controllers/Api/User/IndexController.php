<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    public function index(){
        return json_encode(111);
    }
}
