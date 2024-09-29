<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $order = Order::get()->take(12);
        return view('Frontend.profile', ['order' => $order]);
    }

    public function editOrder($id)
    {
        $order = Order::find($id);
        if ($order) {
            return view('frontend.order', ['order' => $order]);
        }
        return back();
    }

    public function update(Request $request)
    {
        //dd($request->shipping);
        if (count($request->id) === count($request->qnt)) {
            $proPrice = 0;
            $order = Order::find($request->order_id);
            if ($order) {
                foreach ($request->id as $key => $id) {
                    $old = OrderProduct::find($id);
                    $old->qnt = $request->qnt[$key];
                    $old->save();
                    $proPrice += $old->price * $request->qnt[$key];
                }
                $proPrice += $request->shipping;
                $order->price = $proPrice;
                $order->save();
                return back();
            }
        }
        return back()->with('err', 'Someting wrong with this action');
    }
}
