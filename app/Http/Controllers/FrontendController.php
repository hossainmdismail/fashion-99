<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\ProductCategory;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;

class FrontendController extends Controller
{
    //home
    function home()
    {
        //Meta SEO
        //SEOMeta::addMeta('title', 'Synex Digital | IT Solutions For Your Business Online Presence');
        $config = Config::first();
        SEOMeta::setTitle('Home');
        SEOTools::setDescription('Discover a wide range of stylish and comfortable lingerie options for women in Dhaka, Bangladesh. From bras to panties, Poddoja offers the perfect fit for every occasion. Shop now and enjoy fast delivery!');
        SEOMeta::addKeyword(['Stylish Lingerie, Comfortable Undergarments, Women\'s Fashion']);
        SEOMeta::setCanonical('https://poddoja.com' . request()->getPathInfo());
        $category = ProductCategory::all();
        if ($config) {
            SEOMeta::setCanonical($config->url . request()->getPathInfo());
        }

        // dd($header_one);
        return view('frontend.index', [
            'categories'    => $category,
        ]);
    }
}
