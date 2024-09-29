<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $dates = ['start'];

    public function getStart()
    {
        return Carbon::parse($this->attributes['start'])->format('M d Y');
    }

    public function getEnd()
    {
        return Carbon::parse($this->attributes['end'])->format('M d Y');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'campaign_products', 'campaign_id', 'product_id');
    }

    public function getDiscount()
    {
        $totalDiscount = null;

        // Calculate discount based on special price type
        if ($this->sp_type == 'Percent') {
            $totalDiscount = $this->price - ($this->price * $this->s_price / 100);
        } elseif ($this->sp_type == 'Fixed') {
            $totalDiscount = $this->price - $this->s_price;
        }
        return $totalDiscount;
    }
}
