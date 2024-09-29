<?php

namespace App\Livewire\Frontend;

use App\Helpers\CookieSD;
use App\Models\Campaign;
use App\Models\Product as ModelsProduct;
use App\Models\ProductCategory;
use Livewire\Component;


class Product extends Component
{
    public function addToCart($productId, $qnt)
    {
        if (ModelsProduct::find($productId)->stock_status == 0) {
            return back();
        }
        $quantity = $qnt ? $qnt : 1;
        CookieSD::addToCookie($productId, $quantity);

        // Push data to the GTM data layer
        $this->pushToDataLayer($productId, $quantity);

        // Emit an event to notify other components
        $this->dispatch('post-created');
    }

    private function pushToDataLayer($productId, $quantity)
    {
        $product = ModelsProduct::find($productId);

        // Push product data to the GTM data layer
        $dataLayer = [
            'event' => 'addToCart',
            'ecommerce' => [
                'currencyCode' => 'BDT', // Replace with your currency code
                'add' => [
                    'products' => [
                        [
                            'name' => $product->name,
                            'id' => $product->id,
                            'price' => $product->price,
                            'brand' => $product->brand,
                            'category' => $product->category,
                            'quantity' => $quantity,
                        ],
                    ],
                ],
            ],
        ];

        // Encode data layer array to JSON
        $dataLayerJson = json_encode($dataLayer, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        // Push the data layer script to the browser
        $this->dispatchBrowserEvent('pushToDataLayer', ['dataLayer' => $dataLayerJson]);
    }

    public function render()
    {
        $latest     = ModelsProduct::where('status', 'active')->latest()->get()->take(8);
        $featured   = ModelsProduct::where('status', 'active')->where('featured', 1)->latest()->get()->take(8);
        $popular    = ModelsProduct::where('status', 'active')->where('popular', 1)->latest()->get()->take(8);
        $category   = ProductCategory::all();
        return view('livewire..frontend.product', [
            'latests'       => $latest,
            'featureds'     => $featured,
            'populars'      => $popular,
            'categories'    => $category,
        ]);
    }
}
