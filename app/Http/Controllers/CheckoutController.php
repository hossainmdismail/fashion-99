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
use Esign\ConversionsApi\Facades\ConversionsApi;
use FacebookAds\Object\ServerSide\Event;
use FacebookAds\Object\ServerSide\UserData;
use FacebookAds\Object\ServerSide\CustomData;
use Illuminate\Support\Str;

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

        // Redirect to shop if no items in cart
        if (CookieSD::data()['total'] == 0) {
            return redirect()->route('shop');
        }

        // Fetch cart details
        $cartData = CookieSD::data(); // Assuming this fetches the cart details

        // Generate unique event ID for deduplication
        $eventId = Str::uuid();

        // Prepare user data for Meta Conversions API
        $userData = (new UserData())
            ->setClientIpAddress(request()->ip())
            ->setClientUserAgent(request()->header('User-Agent'))
            ->setEmail(auth()->check() ? auth()->user()->email : null);

        // Prepare custom data for Meta Conversions API
        $customData = (new CustomData())
            ->setContentIds(collect($cartData['products'])->pluck('id')->toArray()) // Pass product IDs
            ->setContentType('product')
            ->setValue($cartData['price']) // Total price of the cart
            ->setCurrency('BDT')
            ->setNumItems($cartData['total']); // Number of items in the cart

        // Create InitiateCheckout event for Meta Conversions API
        $event = (new Event())
            ->setEventName('InitiateCheckout')
            ->setEventTime(time())
            ->setUserData($userData)
            ->setCustomData($customData)
            ->setEventSourceUrl(url()->current())
            ->setEventId($eventId);

        // Send event to Meta Conversions API
        ConversionsApi::addEvent($event);
        ConversionsApi::sendEvents();

        // Prepare data for Meta Pixel
        $fbEvent = [
            'event' => 'InitiateCheckout',
            'data' => [
                'content_ids' => collect($cartData['products'])->pluck('id')->toArray(),
                'content_type' => 'product',
                'num_items' => $cartData['total'],
                'value' => $cartData['price'],
                'currency' => 'BDT',
            ],
        ];

        return view("themes.$slug.pages.checkout", [
            'shippings' => $shipping,
            'fbEvent' => $fbEvent,
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
            'name.required'     => 'নাম অবশ্যই প্রদান করতে হবে।',
            'name.string'       => 'নাম অবশ্যই একটি স্ট্রিং হতে হবে।',
            'name.max'          => 'নামের দৈর্ঘ্য সর্বাধিক ২৫৫ অক্ষর হতে পারে।',
            'number.required'   => 'ফোন নম্বর অবশ্যই প্রদান করতে হবে।',
            'number.regex'      => 'আপনার নাম্বার টি সঠিক হয়নি দয়া করে ১১টি ডিজিট দিন | 0191-2096479',
            'shipping.required' => 'শিপিং এর জন্য অবশ্যই একটি অপশন নির্বাচন করতে হবে।',
            'address.required'  => 'ঠিকানা অবশ্যই প্রদান করতে হবে।',
            'email.email'       => 'ইমেলটি একটি বৈধ ইমেল ঠিকানা হতে হবে।',
        ]);

        // $user = User::where('number', $request->number)->orWhere('email', $request->email)->first();
        $user = User::where('number', $request->number)->first();
        $shipping = Shipping::find($request->shipping);
        $cookieData = CookieSD::data();
        if ($cookieData['total'] == 0) {
            return redirect()->route('shop')->with('err', 'No items in cart!');
        }

        $orderID = str_pad(Order::max('id') + 1, 5, '0', STR_PAD_LEFT);
        $userId = null;


        if (!$user) {
            $userCreated = self::createUser($request);
            if (!$userCreated) {
                return back()->with('err', 'User not created!');
            }
            $userId = $userCreated->id;
        } else {
            if ($user->is_blocked == 1) {
                return abort(500, 'You are blocked');
            }
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


            // Prepare data for Meta Pixel before clearing the cookie
            $fbEvent = [
                'event' => 'Purchase',
                'data' => [
                    'content_ids' => collect($cookieData['products'])->pluck('id')->toArray(),
                    'content_type' => 'product_group',
                    'value' => $cookieData['price'] + $shipping->price,
                    'currency' => 'BDT',
                ],
            ];

            $eventId = Str::uuid();

            $userData = (new UserData())
                ->setClientIpAddress($request->ip())
                ->setClientUserAgent($request->header('User-Agent'))
                ->setEmail($request->email ?? null);

            $customData = (new CustomData())
                ->setContentIds(collect($cookieData['products'])->pluck('id')->toArray()) // Pass product IDs
                ->setContentType('product_group')
                ->setValue($cookieData['price'] + $shipping->price)
                ->setCurrency('BDT');

            $event = (new Event())
                ->setEventName('Purchase')
                ->setEventTime(time())
                ->setUserData($userData)
                ->setCustomData($customData)
                ->setEventSourceUrl(url()->current())
                ->setEventId($eventId);

            ConversionsApi::addEvent($event);
            ConversionsApi::sendEvents();

            Cookie::queue(Cookie::forget('product_data'));

            return redirect()->route('thankyou', $order->order_id)->with([
                'order_id' => $order->order_id,
                'fbEvent' => $fbEvent,
            ]);
        } catch (\Throwable $th) {
            return back()->with('err', "Try again latter");
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
