<?php

namespace App\Livewire\Frontend;

use App\Models\Order;
use Livewire\Component;
use App\Models\Shipping;
use App\Helpers\CookieSD;
use App\Models\Campaign;
use App\Models\Inventory;
use Livewire\Attributes\On;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;


class Checkout extends Component
{
    public $shipping_id = null;
    public $message = null;
    public $shipping_fee = null;
    public $discount = null;
    public $total = 0;
    public $camp_id = null;
    public $camp_discount = null;

    #[Validate('required')]
    public $shippingPrice = null;

    #[Validate('required|string|min:4')]
    public $name = '';

    #[Validate('required|string|min:11|max:11')]
    public $number = '';

    // #[Validate('required|email')]
    public $email = '';

    #[Validate('required')]
    public $address = '';

    #[On('post-created')]
    public function updatePostList()
    {
    }
    public function increment($id)
    {

        try {
            CookieSD::increment($id);
            $this->dispatch('post-created');
        } catch (\Exception $e) {
            $this->addError('err', $e->getMessage());
        }
    }

    public function decrement($id)
    {
        CookieSD::decrement($id);
        $this->dispatch('post-created');
    }

    public function remove($id)
    {
        CookieSD::removeFromCookie($id);
        $this->dispatch('post-created');
        $this->emitSelf('$refresh');
    }

    public function save()
    {
        //dd(Auth::check() ?? Auth::user()->id);
        $this->validate();
        // if ($this->shippingPrice == 0) {
        //     return back();
        // }

        if (CookieSD::data()['total'] == 0) {
            $this->addError('cart', 'Cart is empty');
            return;
        }

        //getting cookie data
        $cookieData = CookieSD::data();
        $shipping_charge = Shipping::find($this->shipping_id);

        $orderID = str_pad(Order::max('id') + 1, 5, '0', STR_PAD_LEFT);


        try {
            DB::beginTransaction();

            $order = new Order();
            if (Auth::check()) {
                $order->user_id         = Auth::user()->id;
            }
            $order->order_id            = $orderID;
            $order->order_id            = $orderID;
            $order->coupon_id           = $this->camp_id;
            $order->coupon_amount       = $this->coupon_amount;
            $order->name                = $this->name;
            $order->number              = $this->number;
            $order->email               = $this->email;
            $order->address             = $this->address;
            $order->client_message      = $this->message;
            $order->shipping_charge     = $shipping_charge ? $shipping_charge->price : 0;
            $order->price               = $cookieData['price'] + $this->shippingPrice;
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

            $this->name = '';
            $this->number = '';
            $this->address = '';
            $this->shippingPrice = 0;
            Cookie::queue(Cookie::forget('product_data'));
            $this->dispatch('post-created');

            DB::commit();
            Cookie::queue(Cookie::make('order', true, 60));

            $ids = [];
            foreach ($cookieData['products'] as $value) {
                $ids[] = $value['id'];
            }

            return redirect()->route('thankyou')->with([
                'data' => $cookieData,
                'ids' => json_encode($ids),
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            $this->addError('cart', 'try again later');
            return;
        }
    }

    public function ship($id, $ship)
    {
        $this->shipping_id = $id;
        if ($ship == 1) {
            $this->shippingPrice = 0;
        } else {
            $shipping = Shipping::find($id);
            $this->shippingPrice = $shipping->price;
        }
    }

    public function mount()
    {
        $this->name = Auth::check() ? Auth::user()->name : '';
        $this->email = Auth::check() ? Auth::user()->email : '';
        $this->number = Auth::check() ? Auth::user()->number : '';

        $product = CookieSD::data();

        $totalPrice = $product['price'];
        $campaign = Campaign::first();

        if ($campaign) {
            if ($campaign->sp_type == 'Fixed') {
                $this->total = $totalPrice - $campaign->s_price;
            } elseif ($campaign->sp_type == 'Percent') {
                $this->total = $totalPrice - ($totalPrice * $campaign->s_price / 100);
            }
            //assign camp id
            $this->camp_id = $campaign->id;

            //assign discount price
            $this->camp_discount = $totalPrice - $this->total;
        }

        $this->total += $this->shippingPrice;
    }

    public function render()
    {
        $product = CookieSD::data();
        $shipping = Shipping::all();

        // $this->total = $product['price'] + $this->shippingPrice;

        return view('livewire.frontend.checkout', [
            'products'  => $product,
            'shippings' => $shipping,
            // 'total'     => $product['price'] + $this->shippingPrice,
        ]);
    }
}
