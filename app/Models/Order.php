<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'message',
    ];

    function products()
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }

    function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    function shipping()
    {
        return $this->belongsTo(Shipping::class, 'shipping_id');
    }

    function payment()
    {
        return $this->hasMany(OrderPayment::class, 'order_id');
    }

    function health($userId)
    {
        // Total number of orders for the user
        $totalOrders = Order::where('user_id', $userId)->count();

        if ($totalOrders === 0) {
            // If no orders exist, return 100%
            return 100;
        }

        // Number of orders with 'cancel', 'damaged', or 'returned' status
        $problematicOrders = Order::where('user_id', $userId)
            ->whereIn('order_status', ['cancel', 'damage', 'return'])
            ->count();

        // Calculate the percentage of successful orders (those not cancelled, damaged, or returned)
        $successfulOrders = $totalOrders - $problematicOrders;
        $successPercentage = ($successfulOrders / $totalOrders) * 100;

        // Return the success percentage
        return round($successPercentage, 0); // Rounded to 2 decimal places if needed
    }

    function totalPayment()
    {
        // Sum the 'qnt' values from the related 'ProductQuantity' records
        return $this->payment()->sum('price');
    }
}
