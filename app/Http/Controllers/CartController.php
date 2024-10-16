<?php

namespace App\Http\Controllers;

use App\Helpers\CookieSD;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function remove($inventoryId)
    {
        try {
            CookieSD::removeFromCookie($inventoryId);
        } catch (\Exception $e) {
            return back()->with('err', 'Warning: ' . $e->getMessage());
        }

        return back()->with('succ', 'Cart item remove!');
    }

    public function increment($inventoryId)
    {
        try {
            CookieSD::increment($inventoryId);
        } catch (\Exception $e) {
            return back()->with('err', 'Warning: ' . $e->getMessage());
        }

        return back()->with('succ', 'Cart item remove!');
    }
    public function decrement($inventoryId)
    {
        try {
            CookieSD::decrement($inventoryId);
        } catch (\Exception $e) {
            return back()->with('err', 'Warning: ' . $e->getMessage());
        }

        return back()->with('succ', 'Cart item remove!');
    }
}
