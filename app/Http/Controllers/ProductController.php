<?php

namespace App\Http\Controllers;

use App\Helpers\CookieSD;
use App\Models\Config;
use App\Models\Product;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;

class ProductController extends Controller
{
    public function single($slugs)
    {

        $product = Product::where('slugs', $slugs)->first();
        $config = Config::first();
        $relatedProduct = null;
        if ($product->category) {
            $relatedProduct = Product::where('category_id', $product->category->id)->get();
        }

        if ($product) {
            SEOMeta::setTitle('Product');
            SEOMeta::addMeta('title', $product->seo_title);
            SEOTools::setDescription($product->seo_description);
            SEOMeta::addKeyword($product->seo_tags);
        }
        if ($config) {
            SEOMeta::setCanonical($config->url . request()->getPathInfo());
        }

        return view('frontend.productView', [
            'product' => $product,
            'related' => $relatedProduct,
            'config'  => $config,

        ]);
    }

    public function cart(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'qnt'   => 'required',
            'id'    => 'required',
            'btn'   => 'required',
        ]);

        try {
            CookieSD::addToCookie($request->id, $request->qnt);
        } catch (\Exception $e) {
            // Catch the exception and redirect back with a warning message
            return back()->with('err', 'Warning: ' . $e->getMessage());
        }

        // Facebook Pixel events
        if ($request->btn == 'cart' || $request->btn == 'buy') {
            $product = Product::find($request->id);


            if ($request->btn == 'buy') {
                return redirect()->route('checkout')->with(['add', $product]);
            }

            return back()->with(['add' => $product, 'qnt' => $request->qnt]);
        }
    }
}
