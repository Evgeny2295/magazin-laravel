<?php

namespace App\Http\Controllers;

class MainController extends Controller
{
    public function index(){
        return redirect()->route('admin.main.index');
    }
}
