<?php

namespace App\Livewire\Frontend;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Campaign;
use Livewire\Component;
use Livewire\WithPagination;

class Shop extends Component
{
    use WithPagination;

    public $paginateCount;

    public function pageFilter($count)
    {
        $this->paginateCount = $count;
    }

    public function render()
    {
        $category = ProductCategory::all(); //Getting Category
        $featured   = Product::where('featured', 1)->latest()->get()->take(4);
        // $cate = ProductCategory::select('id','slugs')->where('slugs',$this->slugs)->first(); //Getting Category ID
        // $ads = Campaign::where('image_type','horizontal')->first();

        $product = Product::query();
        $products = $product->latest()->paginate($this->paginateCount != null ? $this->paginateCount : 10);

        return view('livewire.frontend.shop', [
            'products'      => $products,
            'categories'    => $category,
            'featured'      => $featured,
            // 'horizontal'    => $ads,
        ]);
    }
}
