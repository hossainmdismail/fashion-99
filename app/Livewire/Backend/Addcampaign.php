<?php

namespace App\Livewire\Backend;

use App\Models\Campaign_product;
use App\Models\Product;
use Livewire\Component;

class Addcampaign extends Component
{
    public $search = '';
    public $check = [];
    public $id;
    public $showModal = false;

    public function save(){
        if ($this->check) {
            foreach ($this->check as $value) {
                $old = Campaign_product::where('product_id',$value)->where('campaign_id',$this->id)->count();
                if ($old == 0) {
                    $campaign = new Campaign_product();
                    $campaign->campaign_id = $this->id;
                    $campaign->product_id = $value;
                    $campaign->save();
                }
            }
            return back();
        }
    }

    public function render()
    {
        $requests   = Product::query()
                    ->where(function ($query) {
                        $query->where('name', 'like', '%' . $this->search . '%');
                    });

        $data = $requests->paginate(5);
        return view('livewire.backend.addcampaign',[
            'requests' => $data
        ]);
    }
}
