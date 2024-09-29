<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable =[
        'status',
        'message',
    ];

    function products()
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }

    function shipping()
    {
        return $this->belongsTo(Shipping::class, 'shipping_id');
    }

    function payment(){
        return $this->hasMany(OrderPayment::class, 'order_id');
    }

    function totalPayment(){
        // Sum the 'qnt' values from the related 'ProductQuantity' records
        return $this->payment()->sum('price');
    }
}
