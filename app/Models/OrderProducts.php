<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'order_products';

    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
