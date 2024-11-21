<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Config;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\Inventory;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function landingView($slug)
    {
        $product = Product::where('slugs', $slug)->first();

        if ($product) {
            $config = Config::first();
            $shipping = Shipping::get();
            $relatedProduct = null;
            if ($product->category) {
                $relatedProduct = Product::where('category_id', $product->category->id)->get();
            }

            $availableColors = [];
            if ($product->attributes->isNotEmpty()) {
                $availableColors = $product->attributes->groupBy('color_id')->map(function ($items) {
                    // Get the first item in the group to fetch color and image details
                    $color = $items->first()->color;
                    $colorImage = $items->first()->image ?? 'path_to_default_image.jpg'; // Provide default image if null

                    return [
                        'id' => $color->id,              // Color ID
                        'name' => $color->name,          // Color name
                        'code' => $color->code,          // Color code (for display)
                        'image' => $colorImage,          // Image for the color
                        'inventory_id' => $items->first()->id,  // Inventory ID for the first color-size combination
                        'sizes' => $items->map(function ($item) {
                            return [
                                'inventory_id' => $item->id,       // Specific Inventory ID for this size
                                'size_id' => $item->size->id ?? null,
                                'size_name' => $item->size->name ?? 'N/A',
                                'stock' => $item->qnt,            // Stock for this color-size combination
                            ];
                        }),
                    ];
                })->values(); // Use values() to get a numeric array

                // Convert collection to array to ensure it's usable in JSON
                $availableColors = $availableColors->toArray();
            }


            // Prepare data for Meta Pixel
            $fbEvent = [
                'event' => 'ViewContent',
                'data' => [
                    'content_ids' => $product->id,
                    'content_type' => $product->category ? $product->category->category_name : 'Unknown',
                    'value' => $product->getFinalPrice(), // Total value of all products in view
                    'currency' => 'BDT',
                ],
            ];

            return view('landing.pages.landing-1', [
                'product' => $product,
                'related' => $relatedProduct,
                'availableColors' => $availableColors,  // Pass colors and sizes to the view
                'config'  => $config,
                'shippings' => $shipping,
                'fbEvent' => $fbEvent,
            ]);
        }

        return abort(404, 'Product not found');
    }

    public function order(Request $request)
    {
        // dd($request->all());

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
            'number.regex'      => 'অনুগ্রহ করে একটি বৈধ বাংলাদেশের ফোন নম্বর দিন।',
            'shipping.required' => 'শিপিং এর জন্য অবশ্যই একটি অপশন নির্বাচন করতে হবে।',
            'address.required'  => 'ঠিকানা অবশ্যই প্রদান করতে হবে।',
            'email.email'       => 'ইমেলটি একটি বৈধ ইমেল ঠিকানা হতে হবে।',
        ]);

        //If product exists
        $inventory = Inventory::find($request->inventory_id); //Finding the inventory item by id

        //Checking in exists
        if ($inventory) {
            $user = User::where('number', $request->number)->orWhere('email', $request->email)->first();
            $shipping = Shipping::find($request->shipping); //Finding Shipping
            $orderID = str_pad(Order::max('id') + 1, 5, '0', STR_PAD_LEFT); //Auto create Order id
            $userId = null; //User id that is important

            //Create user if not exists
            if (!$user) {
                $userCreated = self::createUser($request);
                if (!$userCreated) {
                    return back()->with('err', 'User not created!'); //Return if user not created
                }
                $userId = $userCreated->id;
            } else {
                $userId = $user->id;
            }

            //Checking shipping charge
            if (!$shipping) {
                return back()->with('err', 'Shipping not created!');
            }

            if ($inventory->product) {
                //Create new order
                $order = new Order();
                $order->user_id            = $userId;
                $order->order_id            = $orderID;
                $order->client_message      = $request->message;
                $order->shipping_charge     = $shipping->price;
                $order->price               = ($inventory->product->getFinalPrice() * $request->quantity) + $shipping->price;
                $order->order_status        = 'pending';
                $order->payment_status      = 'processing';
                $order->save();

                //Manage Inventory
                $inventory->qnt = $inventory->qnt - $request->quantity;
                $inventory->save();

                // Create order product and quantity
                $order_product = new OrderProduct();
                $order_product->order_id    = $order->id;
                $order_product->product_id  = $inventory->product->id;
                $order_product->price       = $inventory->product->getFinalPrice();
                $order_product->qnt         = $request->quantity;
                $order_product->save();
            }
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
