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
        'image',
        'stok'
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    // app/Models/Product.php
    public function isWishlistedBy(User $user)
    {
        // Menghindari error saat wishlist kosong atau null
        return optional($user->wishlist)->contains($this->id);
    }

    // app/Models/Product.php
    public function users()
    {
        return $this->belongsToMany(User::class, 'product_user');
    }



}
