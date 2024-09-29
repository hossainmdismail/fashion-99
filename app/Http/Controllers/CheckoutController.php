<?php

namespace App\Http\Controllers;

use App\Helpers\CookieSD;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $val = CookieSD::data();
        // dd($val);
        $ids = [];
        foreach ($val['products'] as $value) {
            $ids[] =$value['id'];
        }

        return view('frontend.checkout',[
            'data' => $val,
            'ids' => json_encode($ids),
        ]);
    }
}