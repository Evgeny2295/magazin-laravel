<?php

namespace App\Http\Resources\Admin\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title'=>'hgjghj',
            'description'=>$this->description,
            'price'=>$this->price,
            'slug'=>$this->slug,
            'old_price'=>$this->old_price,
            'strength'=>$this->strength,
            'capacity'=>$this->capacity,
            'country'=>$this->country,
            'count'=>$this->count,
            'status'=>$this->status,
            'category_id'=>$this->category_id,
            'img'=>$this->img
        ];
    }
}
