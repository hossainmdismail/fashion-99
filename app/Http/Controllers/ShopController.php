<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use App\Models\Config;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;

class ShopController extends Controller
{
    public function shop(Request $request)
    {
        $themeSlug = 'default';
        $theme = Theme::where('default', true)->first();
        if ($theme) {
            $themeSlug = $theme->slug;
        }

        $category = ProductCategory::get();

        if ($category) {
            // Start building the query for the products in the category
            $query = Product::where('status', 'active');

            // Handle Search: Allow search based on 'name', 'description', or 'short_description'
            if ($request->has('search')) {
                $search = $request->input('search');
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhere('short_description', 'like', "%{$search}%");
                });
            }

            // Handle Sorting
            if ($request->has('sort')) {
                switch ($request->input('sort')) {
                    case '1': // Featured products first
                        $query->orderBy('featured', 'desc');
                        break;
                    case '2': // Best Selling (assuming 'popular' can be used for this)
                        $query->orderBy('popular', 'desc');
                        break;
                    case '3': // Alphabetically, A-Z
                        $query->orderBy('name', 'asc');
                        break;
                    case '4': // Alphabetically, Z-A
                        $query->orderBy('name', 'desc');
                        break;
                    case '5': // Price, low to high
                        $query->orderBy('price', 'asc');
                        break;
                    case '6': // Price, high to low
                        $query->orderBy('price', 'desc');
                        break;
                }
            }

            // Handle Category Filter: Filter products based on the selected category
            if ($request->has('category')) {
                $category = $request->input('category');
                $query->where('category_id', $category);  // Assuming 'category_id' in the 'products' table
            }

            // Fetch the products
            $products = $query->orderBy('id', 'desc')->paginate(12);

            // Check if it's an AJAX request and return the product list as HTML
            if ($request->ajax()) {
                return response()->json([
                    'html' => view("themes.$themeSlug.component.productlist", compact('products'))->render()
                ]);
            }

            // If it's a normal request, return the category view with products
            return view("themes.$themeSlug.pages.shop", [
                'products'   => $products,
                'categories' => $category,
            ]);
        }

        // If category not found, return a 404 error
        return abort(404, 'Category not found');
    }
}
