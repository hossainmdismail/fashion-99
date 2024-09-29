<?php

namespace App\Livewire\Frontend;

use App\Models\Banner;
use App\Models\Product;
use Livewire\Component;
use App\Models\Campaign;

class HeaderAds extends Component
{


    public function render()
    {
        $banner = Banner::all();
        // $header_one = Campaign::where('image_type', 'vertical')->first();
        // $header_two = Campaign::where('image_type', 'horizontal')->first();
        $lowPriceProduct = Product::where('status', 1)->orderBy('price')->get()->take(5);
        return view('livewire..frontend.header-ads', [
            'banners'       => $banner,
            'products'      => $lowPriceProduct,
            // 'header_one'    => $header_one,
            // 'header_two'    => $header_two,
        ]);
    }
}