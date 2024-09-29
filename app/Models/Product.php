<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'qnt',
    ];


    function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }
    function images()
    {
        return $this->hasMany(ProductPhoto::class, 'product_id');
    }


    function services()
    {
        return $this->hasMany(ProductService::class, 'product_id');
    }

    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class, 'campaign_products', 'product_id', 'campaign_id');
    }

    public function getFinalPriceAttribute()
    {
        return $this->price - ($this->price * $this->discount / 100);
    }

    public function getFinalPrice()
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

    public function attributes()
    {
        return $this->hasMany(Inventory::class, 'product_id');
    }

    public function uniqueAttributes()
    {
        // Subquery to get distinct color_ids with corresponding minimum IDs
        $distinctColorIds = $this->attributes()
            ->selectRaw('MIN(id) as id')
            ->groupBy('color_id')
            ->pluck('id');

        // Main query to get all attribute details for the distinct IDs
        return $this->attributes()
            ->whereIn('id', $distinctColorIds)
            ->get();
    }


    public function stock()
    {
        // Sum the 'qnt' values from the related 'ProductQuantity' records
        return $this->attributes()->sum('qnt');
    }

    public function getUniqueColors()
    {
        // Retrieve unique colors associated with the product
        return Color::whereIn('id', $this->attributes()->select('color_id')->groupBy('color_id'))->get();
    }

    public function getSizesByColor(int $color_id)
    {
        // Retrieve inventories for the product
        $inventories = $this->attributes()->where('color_id', $color_id)->get();

        // Extract unique size IDs from the filtered inventories
        $sizeIds = $inventories->pluck('size_id')->unique()->toArray();

        // Retrieve sizes based on the extracted size IDs
        return Size::whereIn('id', $sizeIds)->get();
        // return $inventories;
    }

    public function comments()
    {
        return $this->hasMany(Comments::class, 'product_id');
    }

    public function getRating()
    {
        $ratingSum = $this->comments()->sum('rating');
        $ratingCount = $this->comments()->count();

        // Prevent division by zero
        if ($ratingCount === 0) {
            return 0;
        }

        return ($ratingSum / ($ratingCount * 5)) * 100;
    }
}
