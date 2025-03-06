<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'products';
    protected $guarded = [];

    protected $withCount = ['likedUsers'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function likedUsers()
    {
        return $this->belongsToMany(User::class,'wishlists','product_id','user_id');
    }


}
