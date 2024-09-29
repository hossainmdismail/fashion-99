<?php

namespace App\Livewire\Backend;

use App\Models\Product;
use App\Models\ProductCategory;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    public $search,$status = null, $category = null;

    public function featured($id)
    {
        $product = Product::find($id);
        if ($product->featured == 1) {
            $product->featured = 0;
        } else {
            $product->featured = 1;
        }
        $product->save();
    }

    public function popular($id)
    {
        $product = Product::find($id);
        if ($product->popular == 1) {
            $product->popular = 0;
        } else {
            $product->popular = 1;
        }
        $product->save();
    }

    public function render()
    {

        $products = Product::where('name', 'like', '%' . $this->search . '%')
        ->when($this->status, function ($query) {
            $query->where('status', $this->status);
        }, function ($query) {
            $query->where('status', 'active');
        })
        ->when($this->category, function ($query) {
            $query->where('category_id', $this->category);
        })
        ->orderBy('id', 'DESC')
        ->paginate(10);


        $categories = ProductCategory::all();
        return view('livewire.backend.product-list', [
            'requests'      => $products,
            'categories'    => $categories
        ]);
    }
}
