<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\ProductCategory;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;

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
        SEOMeta::setTitle('About');
        SEOMeta::addMeta('title', 'Elevate Your Intimate Style: Discover Poddoja\'s Exquisite Lingerie Collection');
        SEOTools::setDescription('Immerse yourself in the world of Poddoja, where luxury meets comfort in every stitch. Explore our curated selection of premium lingerie, meticulously crafted to enhance your confidence and style.');
        SEOMeta::addKeyword('Luxury Lingerie, Premium Intimate Apparel, Comfortable Underwear');
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function privacy()
    {
        SEOMeta::setTitle('Policy');
        SEOMeta::addMeta('title', 'Privacy Policy | Poddoja: Your Ultimate Lingerie Destination');
        SEOTools::setDescription('At Poddoja, we value your privacy. Learn more about how we protect your personal information while providing you with the finest lingerie selections. Shop confidently at Poddoja.');
        SEOMeta::addKeyword('Privacy Policy, Lingerie Privacy, Confidentiality, Secure Shopping');

        return view('frontend.privacy');
    }
}