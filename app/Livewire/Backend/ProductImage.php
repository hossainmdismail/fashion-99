<?php

namespace App\Livewire\Backend;

use App\Models\Product;
use App\Models\ProductPhoto;
use Livewire\Component;
use Photo;
use Livewire\WithFileUploads;

class ProductImage extends Component
{

    use WithFileUploads;

    public $product_id;
    public $image;

    public function imageDelete($id)
    {
        $image = ProductPhoto::find($id);
        Photo::delete('files/product', $image->image);
        $image->delete();
    }


    public function store()
    {
        if ($this->image != null) {
            Photo::upload($this->image, 'files/product',  $this->product_id . 'PRO', [440, 440]);
            ProductPhoto::insert([
                'product_id' => $this->product_id,
                'image'      => Photo::$name,
            ]);
        }

        $this->image = '';
    }


    public function render()
    {
        $product = Product::find($this->product_id);
        $image = $product->images;
        return view('livewire.backend.product-image', [
            'product_id'    => $this->product_id,
            'images'        => $image,
        ]);
    }
}
