<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Campaign;

class FeaturesController extends Controller
{
    function features()
    {
        $category = ProductCategory::all(); //Getting Category
        $featured   = Product::where('featured', 1)->latest()->get()->take(4);
        $ads = Campaign::where('image_type', 'horizontal')->first();

        $product = Product::query();
        $products = $product->where('featured', 1)->paginate(12);

        return view('frontend.features', [
            'products'      => $products,
            'categories'    => $category,
            'featured'      => $featured,
            'horizontal'    => $ads,
        ]);
    }

    function hot()
    {
        $category = ProductCategory::all();
        $featured   = Product::where('featured', 1)->latest()->get()->take(4);
        $ads = Campaign::where('image_type', 'horizontal')->first();

        $product = Product::query();
        $products = $product->where('popular', 1)->paginate(12);

        return view('frontend.hot', [
            'products'      => $products,
            'categories'    => $category,
            'featured'      => $featured,
            'horizontal'    => $ads,
        ]);
    }
}
