<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name1',
        'name',
        'description',
        'price',
        'image'
    ];

    public function carts()
{
    return $this->hasMany(Cart::class);
}
}
