<?php

namespace App\Livewire\Frontend;

use App\Models\Product;
use Livewire\Component;

class Search extends Component
{
    public $search;




    public function render()
    {
        return view('livewire.frontend.search', [
            'products' => Product::where('name', 'like', '%' . $this->search . '%')->get()->take(5),
        ]);
    }
}