<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'color_id',
        'size_id',
        'sku',
        'image',
        'stock_price',
        'price',
        's_price',
        'sp_type',
        'total_qnt',
        'qnt',
    ];

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // public function getFinalPrice()
    // {
    //     $totalDiscount = null;

    //     // Calculate discount based on special price type
    //     if ($this->sp_type == 'Percent') {
    //         $totalDiscount = $this->price - ($this->price * $this->s_price / 100);
    //     } elseif ($this->sp_type == 'Fixed') {
    //         $totalDiscount = $this->price - $this->s_price;
    //     }
    //     return $totalDiscount;
    // }
    public static function getSizesByColorId($colorId)
    {
        return Size::whereIn('id', static::where('color_id', $colorId)->pluck('size_id'))->get();
    }
}
