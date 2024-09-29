<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;

class ShopController extends Controller
{
    public function shop(){
        $config = Config::first();
        SEOMeta::setTitle('Category');
        SEOMeta::addMeta('title', 'Online Shopping in Bangladesh | Familly Bazar');
        SEOTools::setDescription('Discover a world of convenience with online shopping at Familly Bazar in Bangladesh. Explore a diverse range of products, enjoy secure transactions, and doorstep delivery. Start your online shopping journey today');
        SEOMeta::addKeyword('Online Shopping Bangladesh');
        if ($config) {
            SEOMeta::setCanonical($config->url . request()->getPathInfo());
        }
        return view('frontend.shop');
    }
}
