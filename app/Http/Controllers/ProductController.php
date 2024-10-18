<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use App\Models\Config;
use App\Models\Product;
use App\Helpers\CookieSD;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;

class ProductController extends Controller
{
    public function single($slugs)
    {
        $themeSlug = 'default';
        $theme = Theme::where('default', true)->first();
        if ($theme) {
            $themeSlug = $theme->slug;
        }

        $product = Product::where('slugs', $slugs)->first();

        if ($product) {
            $config = Config::first();
            $relatedProduct = null;
            if ($product->category) {
                $relatedProduct = Product::where('category_id', $product->category->id)->get();
            }

            $availableColors = [];
            if ($product->attributes->isNotEmpty()) {
                $availableColors = $product->attributes->groupBy('color_id')->map(function ($items) {
                    // Get the first item in the group to fetch color and image details
                    $color = $items->first()->color;
                    $colorImage = $items->first()->image ?? 'path_to_default_image.jpg'; // Provide default image if null

                    return [
                        'id' => $color->id,              // Color ID
                        'name' => $color->name,          // Color name
                        'code' => $color->code,          // Color code (for display)
                        'image' => $colorImage,          // Image for the color
                        'inventory_id' => $items->first()->id,  // Inventory ID for the first color-size combination
                        'sizes' => $items->map(function ($item) {
                            return [
                                'inventory_id' => $item->id,       // Specific Inventory ID for this size
                                'size_id' => $item->size->id ?? null,
                                'size_name' => $item->size->name ?? 'N/A',
                                'stock' => $item->qnt,            // Stock for this color-size combination
                            ];
                        }),
                    ];
                })->values(); // Use values() to get a numeric array

                // Convert collection to array to ensure it's usable in JSON
                $availableColors = $availableColors->toArray();
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

            return view("themes.$themeSlug.pages.product", [
                'product' => $product,
                'related' => $relatedProduct,
                'availableColors' => $availableColors,  // Pass colors and sizes to the view
                'config'  => $config,
            ]);
        }

        return abort(404, 'Product not found');
    }

    public function cart(Request $request)
    {
        $request->validate([
            'quantity'      => 'required',
            'inventory_id'  => 'required',
        ]);

        try {
            CookieSD::addToCookie($request->inventory_id, $request->quantity);
        } catch (\Exception $e) {
            return back()->with('err', 'Warning: ' . $e->getMessage());
        }

        return back()->with('succ', 'Product is added to your cart');
    }

    public function cartitems()
    {
        $slug = 'default';
        $theme = Theme::where('default', true)->first();
        if ($theme) {
            $slug = $theme->slug;
        }

        $cartData = CookieSD::data();
        $products = $cartData['products'] ?? [];

        return response()->json([
            'html' => view("themes.$slug.component.cart-productlist", compact('products'))->render(),
            'total' => $cartData['total'] ?? 0,
            'totalPrice' => $cartData['price'],
        ]);
    }
}
