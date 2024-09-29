<?php

namespace App\Livewire\Frontend;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Helpers\CookieSD;
use App\Models\Campaign;
use Livewire\Component;
use Livewire\WithPagination;

class Categoryproduct extends Component
{
    use WithPagination;


    public  $slugs;
    public $paginateCount;

    public function pageFilter($count)
    {
        $this->paginateCount = $count;
    }

    public function addToCart($productId, $qnt = null)
    {
        if (Product::find($productId)->stock_status == 0) {
            return back();
        }
        $quantity = $qnt ? $qnt : 1;
        CookieSD::addToCookie($productId, $quantity);
        // Emit an event to notify other components
        $this->dispatch('post-created');
    }

    public function render()
    {
        $category = ProductCategory::all(); //Getting Category
        $featured   = Product::where('featured', 1)->latest()->get()->take(4);
        $cate = ProductCategory::select('id', 'slugs')->where('slugs', $this->slugs)->first(); //Getting Category ID
        // $ads = Campaign::where('image_type','horizontal')->first();

        $product = Product::query();
        $products = $product->where('category_id', $cate->id)->paginate($this->paginateCount != null ? $this->paginateCount : 10);

        return view('livewire.frontend.categoryproduct', [
            'slugs'         => $this->slugs,
            'products'      => $products,
            'categories'    => $category,
            'featured'      => $featured,
            // 'horizontal'    => $ads,
        ]);
    }
}
