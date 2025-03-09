<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\StoreRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StoreController extends Controller
{

    public function store(StoreRequest $request){

        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

        $user = User::where('email',$data['email'])->first();

        if($user) return response(['message'=>'Пользователь с таким именем уже существует']);

        $user = User::create([
            'email'=>$data['email'],
            'name'=>$data['name'],
            'password'=>$data['password'],
            ]
        );

       $token = auth()->tokenById($user->id);

       return response(['access_token'=>$token]);
    }
}
