<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use App\Models\Banner;
use App\Models\Config;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\ProductCategory;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use FacebookAds\Object\ServerSide\Event;
use FacebookAds\Object\ServerSide\UserData;
use Esign\ConversionsApi\Facades\ConversionsApi;

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


        // Meta Conversion API - Page View Event
        $userData = (new UserData())
            ->setClientIpAddress(request()->ip()) // Get User IP
            ->setClientUserAgent(request()->header('User-Agent')) // Get User Browser Info
            ->setEmail(auth()->check() ? auth()->user()->email : null) // Add email if logged in
            ->setPhone(auth()->check() ? auth()->user()->phone : null);

        $eventId = Str::uuid(); // Generate a unique event ID

        $event = (new Event())
            ->setEventName('PageView')
            ->setEventTime(time())
            ->setUserData($userData)
            ->setEventSourceUrl(url()->current())
            ->setEventId($eventId);

        ConversionsApi::addEvent($event);
        ConversionsApi::sendEvents();

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
