<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Theme;
use App\Models\Shipping;
use App\Helpers\CookieSD;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Cookie;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $slug = 'default';
        $theme = Theme::where('default', true)->first();
        if ($theme) {
            $slug = $theme->slug;
        }
        $shipping = Shipping::get();

        if (CookieSD::data()['total'] == 0) {
            return redirect()->route('shop');
        }
        return view("themes.$slug.pages.checkout", [
            'shippings' => $shipping
        ]);
    }

    public function checkoutitems()
    {
        $slug = 'default';
        $theme = Theme::where('default', true)->first();
        if ($theme) {
            $slug = $theme->slug;
        }
        $cartData = CookieSD::data();
        $products = $cartData['products'] ?? [];

        return response()->json([
            'html' => view("themes.$slug.component.checkout-item-list", compact('products'))->render(),
            'total' => $cartData['total'] ?? 0,
            'totalPrice' => $cartData['price'],
        ]);
    }

    public function checkoutconfirm(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'number'    => ['required', 'regex:/^01[3-9]\d{8}$/'],
            'shipping'  => 'required',
            'address'   => 'required',
            'email'     => 'nullable|email',
        ], [
            'number.regex' => 'Please enter a valid Bangladeshi phone number.'
        ]);

        $user = User::where('number', $request->number)->orWhere('email', $request->email)->first();
        $shipping = Shipping::find($request->shipping);
        $cookieData = CookieSD::data();

        $orderID = str_pad(Order::max('id') + 1, 5, '0', STR_PAD_LEFT);
        $userId = null;


        if (!$user) {
            $userCreated = self::createUser($request);
            if (!$userCreated) {
                return back()->with('err', 'User not created!');
            }
            $userId = $userCreated->id;
        } else {
            $userId = $user->id;
        }
        if (!$shipping) {
            return back()->with('err', 'Shipping not created!');
        }

        try {
            $order = new Order();
            $order->user_id            = $userId;
            $order->order_id            = $orderID;
            $order->client_message      = $request->message;
            $order->shipping_charge     = $shipping->price;
            $order->price               = $cookieData['price'] + $shipping->price;
            $order->order_status        = 'pending';
            $order->payment_status      = 'processing';
            $order->save();

            foreach ($cookieData['products'] as $value) {
                $product = Inventory::find($value['id']);
                $product->qnt = $product->qnt - $value['quantity'];
                $product->save();

                $order_product = new OrderProduct();
                $order_product->order_id    = $order->id;
                $order_product->product_id  = $value['id'];
                $order_product->price       = $value['price'];
                $order_product->qnt         = $value['quantity'];
                $order_product->save();
            }

            Cookie::queue(Cookie::forget('product_data'));

            return redirect()->route('thankyou', $order->order_id)->with('order_id', $order->order_id);
        } catch (\Throwable $th) {
            return back()->with('err', "Try again latter: $th");
        }
    }

    private function createUser($request)
    {
        $newUser = new User();
        $newUser->name = $request->name;
        $newUser->number = $request->number;
        $newUser->email = $request->email;
        $newUser->address = $request->address;
        $newUser->password = '12345678';
        $newUser->save();
        if ($newUser) {
            return $newUser;
        } else {
            return null;
        }
    }
}
