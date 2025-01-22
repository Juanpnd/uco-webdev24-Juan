<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $guarded = ['id']; // All fields are mass assignable except for 'id'

    protected $fillable = [
        'user_id',
       'address',
       'payment_method',
        'total',
        // ... add any other fields as needed
    ];
    public function product()
{
    return $this->belongsTo(Product::class);
}
}
