<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use App\Models\Campaign;
use App\Models\ProductCategory;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;

class HomeController extends Controller
{
    public function index()
    {
        return view('backend.index');
    }

    public function campaign($id)
    {
        $campaign = Campaign::find($id);
        $products = $campaign->products;

        $category = ProductCategory::get();

        return view('frontend.campaign', [
            'products'      => $products,
            'campaign'      => $campaign,
            'categories'    => $category,
        ]);
    }

    public function aboutus()
    {
        $slug = 'default';
        $theme = Theme::where('default', true)->first();
        if ($theme) {
            $slug = $theme->slug;
        }

        SEOMeta::setTitle('About');
        SEOMeta::addMeta('title', 'Elevate Your Intimate Style: Discover Poddoja\'s Exquisite Lingerie Collection');
        SEOTools::setDescription('Immerse yourself in the world of Poddoja, where luxury meets comfort in every stitch. Explore our curated selection of premium lingerie, meticulously crafted to enhance your confidence and style.');
        SEOMeta::addKeyword('Luxury Lingerie, Premium Intimate Apparel, Comfortable Underwear');
        return view("themes.$slug.pages.about");
    }

    public function contact()
    {
        $slug = 'default';
        $theme = Theme::where('default', true)->first();
        if ($theme) {
            $slug = $theme->slug;
        }

        return view("themes.$slug.pages.contact");
    }

    public function privacy()
    {
        $slug = 'default';
        $theme = Theme::where('default', true)->first();
        if ($theme) {
            $slug = $theme->slug;
        }
        SEOMeta::setTitle('Policy');
        SEOMeta::addMeta('title', 'Privacy Policy | Poddoja: Your Ultimate Lingerie Destination');
        SEOTools::setDescription('At Poddoja, we value your privacy. Learn more about how we protect your personal information while providing you with the finest lingerie selections. Shop confidently at Poddoja.');
        SEOMeta::addKeyword('Privacy Policy, Lingerie Privacy, Confidentiality, Secure Shopping');

        return view("themes.$slug.pages.privacy");
    }
}
