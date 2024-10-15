<?php

namespace App\Helpers;

use App\Models\Inventory;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Request;

class CookieSD
{
    public static function getProductData(): array
    {
        $cookieValue = Request::cookie('product_data');
        $productData = json_decode($cookieValue, true) ?? [];

        // Filter out invalid or non-numeric entries
        $productData = array_filter($productData, function ($item) {
            return is_array($item) && isset($item['inventory_id']) && isset($item['quantity']) && is_numeric($item['inventory_id']) && is_numeric($item['quantity']);
        });

        return array_values($productData); // Reset array keys
    }


    public static function addToCookie(int $inventoryId, int $quantity): void
    {
        $productData = self::getProductData();

        $existingProductIndex = array_search($inventoryId, array_column($productData, 'inventory_id'));

        if ($existingProductIndex !== false) {
            $newQuantity = $productData[$existingProductIndex]['quantity'] + max(1, $quantity);

            if (!self::isQuantitySufficient($inventoryId, $newQuantity)) {
                throw new \Exception('Insufficient quantity for the product.');
            }

            $productData[$existingProductIndex]['quantity'] = $newQuantity;
        } else {
            if (!self::isQuantitySufficient($inventoryId, max(1, $quantity))) {
                throw new \Exception('Insufficient quantity for the product.');
            }

            $productData[] = ['inventory_id' => $inventoryId, 'quantity' => max(1, $quantity)];
        }

        $encodedProductData = json_encode(array_values($productData));
        //dd($encodedProductData);
        Cookie::queue(Cookie::forever('product_data', $encodedProductData));
    }

    public static function decrement(int $inventoryId): void
    {
        $productData = self::getProductData();

        // Find the index of the product in the array
        $existingProductIndex = array_search($inventoryId, array_column($productData, 'inventory_id'));

        if ($existingProductIndex !== false) {
            // If the product exists, reduce its quantity
            $newQuantity = max(1, $productData[$existingProductIndex]['quantity'] - 1);

            // Check if the new quantity is available
            if (!self::isQuantitySufficient($inventoryId, $newQuantity)) {
                throw new \Exception('Insufficient quantity available for the product.');
            }

            $productData[$existingProductIndex]['quantity'] = $newQuantity;

            // If the quantity becomes zero or negative, remove the product from the array
            if ($newQuantity <= 0) {
                unset($productData[$existingProductIndex]);
            }

            // Update the cookie with the modified product data
            $encodedProductData = json_encode($productData);
            Cookie::queue(Cookie::forever('product_data', $encodedProductData));
        }
    }

    public static function increment(int $inventoryId): void
    {
        $productData = self::getProductData();

        // Find the index of the product in the array
        $existingProductIndex = array_search($inventoryId, array_column($productData, 'inventory_id'));

        if ($existingProductIndex !== false) {
            // If the product exists, increment its quantity
            $newQuantity = $productData[$existingProductIndex]['quantity'] + 1;

            // Check if the new quantity is available
            if (!self::isQuantitySufficient($inventoryId, $newQuantity)) {
                throw new \Exception('Insufficient quantity available for the product.');
            }

            $productData[$existingProductIndex]['quantity'] = $newQuantity;

            // Update the cookie with the modified product data
            $encodedProductData = json_encode($productData);
            Cookie::queue(Cookie::forever('product_data', $encodedProductData));
        }
    }

    public static function data()
    {
        $cookie = self::getProductData();

        if (!empty($cookie)) {
            $inventoryIds = array_column($cookie, 'inventory_id');

            if (!empty($inventoryIds)) {
                $inventoryItems = Inventory::whereIn('id', $inventoryIds)->get();

                $productsWithData = collect($cookie)->map(function ($cookieItem) use ($inventoryItems) {
                    $inventoryItem = $inventoryItems->where('id', $cookieItem['inventory_id'])->first();
                    $quantity = max(1, $cookieItem['quantity']);

                    if ($inventoryItem) {
                        return [
                            'id'            => $inventoryItem->id,
                            'name'          => $inventoryItem->product ? $inventoryItem->product->name : 'Unknown',
                            'price'         => $inventoryItem->product ? $inventoryItem->product->getFinalPrice() : 0,
                            'color'         => $inventoryItem->color ? $inventoryItem->color->name : 'Unknown',
                            'size'          => $inventoryItem->size ? $inventoryItem->size->name : 'Unknown',
                            'quantity'      => $quantity,
                            'image'         => $inventoryItem->image,
                            'totalPrice'    => $inventoryItem->product->getFinalPrice() * $quantity,
                            'shipping'      => $inventoryItem->product->shipping_fee,
                            // Add other fields as needed
                        ];
                    }

                    return null; // Handle the case where the inventory item is not found
                })->filter();

                $totalPrice = $productsWithData->sum('totalPrice');

                return [
                    'products' => $productsWithData,
                    'price'    => $totalPrice,
                    'total'    => $productsWithData->count(),
                ];
            }
        }

        return [
            'products' => [],
            'price'    => 0.00,
            'total'    => 0,
        ];
    }

    public static function removeFromCookie(int $inventoryId): void
    {
        $productData = self::getProductData();

        // Filter out the product with the specified inventory ID
        $updatedProductData = array_filter($productData, function ($item) use ($inventoryId) {
            return $item['inventory_id'] !== $inventoryId;
        });

        // Update the cookie with the modified product data
        $encodedProductData = json_encode(array_values($updatedProductData)); // Reset array keys
        Cookie::queue(Cookie::forever('product_data', $encodedProductData));
    }

    private static function isQuantitySufficient(int $inventoryId, int $newQuantity): bool
    {
        $inventoryItem = Inventory::find($inventoryId);

        if (!$inventoryItem) {
            return false; // Handle the case where the inventory item is not found
        }

        return $inventoryItem->qnt >= $newQuantity;
    }
}
