<?php

namespace App\Http\Controllers;

use App\Helpers\CookieSD;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    function thankyou()
    {
        $dd = CookieSD::data()['products'];
        dd($dd);
        return view('frontend.thankyou');
    }
}
