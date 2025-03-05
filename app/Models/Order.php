<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderProducts;
class Order extends Model
{
    use HasFactory;
    protected $guarded = false;
    protected $table = 'orders';

    public function orderProducts()
    {
        return $this->hasMany(OrderProducts::class,'order_id','id');
    }
}
