<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign_product;
use Illuminate\Http\Request;

class CampaignProduct extends Controller
{
    public function destroy(Request $request){
        $request->validate([
            'cam_id' => 'required',
            'pro_id' => 'required',
        ]);

        Campaign_product::where('campaign_id',$request->cam_id)->where('product_id',$request->pro_id)->delete();
        return back();
    }
}
