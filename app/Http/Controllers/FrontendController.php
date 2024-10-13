<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Config;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Theme;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;

class FrontendController extends Controller
{
    function home()
    {
        $slug = 'default';
        $theme = Theme::where('default', true)->first();
        if ($theme) {
            $slug = $theme->slug;
        }

        $config = Config::first();
        SEOMeta::setTitle('Home');
        SEOTools::setDescription('Discover a wide range of stylish and comfortable lingerie options for women in Dhaka, Bangladesh. From bras to panties, Poddoja offers the perfect fit for every occasion. Shop now and enjoy fast delivery!');
        SEOMeta::addKeyword(['Stylish Lingerie, Comfortable Undergarments, Women\'s Fashion']);
        SEOMeta::setCanonical('https://synexdigital.com' . request()->getPathInfo());
        $category = ProductCategory::all();
        $banner = Banner::all();
        if ($config) {
            SEOMeta::setCanonical($config->url . request()->getPathInfo());
        }

        $latest    = Product::where('status', 'active')->latest()->get()->take(8);
        $featured  = Product::where('status', 'active')->where('featured', 1)->latest()->get()->take(8);
        $popular   = Product::where('status', 'active')->where('popular', 1)->latest()->get()->take(8);

        return view("themes.$slug.index", [
            'banners'       => $banner,
            'categories'    => $category,
            'config'        => $config,
            'latests'       => $latest,
            'featureds'     => $featured,
            'populars'      => $popular,
        ]);
    }
}
