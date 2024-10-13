<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use App\Models\Config;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;

class CategoryController extends Controller
{
    public function index(Request $request, $slugs)
    {
        $themeSlug = 'default';
        $theme = Theme::where('default', true)->first();
        if ($theme) {
            $themeSlug = $theme->slug;
        }

        $category = ProductCategory::where('slugs', $slugs)->first();

        if ($category) {
            $query = Product::where('category_id', $category->id);

            if ($request->has('search')) {
                $search = $request->input('search');
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhere('short_description', 'like', "%{$search}%");
                });
            }

            if ($request->has('sort')) {
                switch ($request->input('sort')) {
                    case '1':
                        $query->orderBy('featured', 'desc');
                        break;
                    case '2':
                        $query->orderBy('popular', 'desc');
                        break;
                    case '3':
                        $query->orderBy('name', 'asc');
                        break;
                    case '4':
                        $query->orderBy('name', 'desc');
                        break;
                    case '5':
                        $query->orderBy('price', 'asc');
                        break;
                    case '6':
                        $query->orderBy('price', 'desc');
                        break;
                }
            }

            $products = $query->where('status', 'active')->paginate(12);


            if ($request->ajax()) {
                return response()->json([
                    'html' => view("themes.$themeSlug.component.productlist", compact('products'))->render()
                ]);
            }

            // If it's a normal request, return the category view with products
            return view("themes.$themeSlug.pages.category", [
                'products' => $products,
                'category' => $category,
            ]);
        }

        // If category not found, return a 404 error
        return abort(404, 'Category not found');
    }



    // function index(Request $request, $slugs)
    // {
    //     $themeSlug = 'default';
    //     $theme = Theme::where('default', true)->first();
    //     if ($theme) {
    //         $themeSlug = $theme->slug;
    //     }

    //     $category = ProductCategory::where('slugs', $slugs)->first();

    //     $config = Config::first();
    //     if ($category) {
    //         SEOMeta::setTitle('Category');
    //         SEOMeta::addMeta('title', $category->seo_title ?? 'category');
    //         SEOTools::setDescription($category->seo_description ?? 'category');
    //         SEOMeta::addKeyword($category->seo_tags ?? 'category');

    //         $product = Product::where('category_id', $category->id)->get();
    //         if ($config) {
    //             SEOMeta::setCanonical($config->url . request()->getPathInfo());
    //         }


    //         return view("themes.$themeSlug.pages.category", [
    //             'products' => $product,
    //             'category' => $category,
    //         ]);
    //     } else {
    //         return abort(404, 'Category not found');
    //     }
    // }
}
