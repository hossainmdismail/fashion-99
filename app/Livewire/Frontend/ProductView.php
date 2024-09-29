<?php

namespace App\Livewire\Frontend;

use App\Models\Product;
use Livewire\Component;
use App\Helpers\CookieSD;
use App\Models\Color;

class ProductView extends Component
{
    public $id, $btn, $product, $sizes = [], $quantity = 1, $color_id, $size_id, $color_name, $stock = 0;

    protected $rules = [
        'quantity'  => 'required|numeric|min:1|max:100', // Example: min value is 1 and max value is 100
        'color_id'  => 'required',
        // 'size_id'   => 'required',
    ];

    public function addToCart()
    {
        $this->validate();

        $data = $this->product->attributes()->where('color_id', $this->color_id)->where('size_id', $this->size_id)->first();
        if ($data) {
            try {
                CookieSD::addToCookie($data->id, $this->quantity);
                $this->dispatch('post-created');
            } catch (\Exception $e) {
                $this->addError('err', $e->getMessage());
            }
        }
    }

    public function orderNow()
    {
        $this->addToCart();
        return redirect()->route('checkout');
    }

    public function mount()
    {
        // $this->name = Auth::user()->name;
        $this->product = Product::find($this->id);
        $data = $this->product->attributes()->first();
        if ($data) {
            // $this->sku = $data->sku;
        }
    }


    public function sizeByColor($id)
    {
        $this->color_id = $id;
        $colorNewName = Color::find($id);
        if ($colorNewName) {
            $this->color_name = $colorNewName->name;
        }
        $size = $this->product->getSizesByColor($id);
        $this->sizes = $size;
        $this->size_id = null;
        $data = $this->product->attributes()->first();
        // $this->sku = $data->sku;
        $this->stock = 0;
    }

    public function sizeAction($id)
    {
        $this->size_id = $id;
        $data = $this->product->attributes()->where('color_id', $this->color_id)->where('size_id', $id)->first();
        if ($data) {
            // $this->sku = $data->sku;
            $this->stock = $data->qnt;
        }
    }

    // public function orderNow($productId, $qnt = null)
    // {
    // }

    public function render()
    {
        return view('livewire.frontend.product-view', [
            'product' => $this->product,
            // 'related' => $relatedProduct
        ]);
    }
}
