<?php
namespace App\Http\Controllers\Api\Personal;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Personal\UpdatedRequest;

class UpdateController extends Controller
{
    public function update(UpdatedRequest $request){

        $data = $request->validated();

        $id = auth()->user()->update($data);

        return $id;
    }
}
