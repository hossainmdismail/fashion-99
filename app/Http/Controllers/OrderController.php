<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use App\Helpers\CookieSD;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    function thankyou($order_id)
    {
        if (session('order_id') != $order_id) {
            return redirect()->route('checkout')->with('error', 'Invalid access to thank you page.');
        }

        $order = Order::where('order_id', $order_id)->first();
        if ($order) {
            $slug = 'default';
            $theme = Theme::where('default', true)->first();
            if ($theme) {
                $slug = $theme->slug;
            }

            return view("themes.$slug.pages.thankyou", ['order' => $order]);
        } else {
            return abort(404);
        }
    }
}
