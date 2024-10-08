<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

class CartService
{
    public function addToCart($userId, $productId, $quantity = 1)
    {
        $product = Product::find($productId);
        $cart = Cart::firstOrCreate(['user_id' => $userId]);
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $product->price
            ]);
        }

        return $cart;
    }
    public function removeItem($cartId, $productId)
    {
        $cart = Cart::find($cartId);

        if (!$cart) {
            return false;
        }

        $cartItem = CartItem::where('cart_id', $cartId)
            ->where('product_id', $productId)
            ->first();

        if (!$cartItem) {
            return false;
        }

        $cartItem->delete();

        return true;
    }

    public function incrementItemQuantity($cartId, $productId, $quantity = 1)
    {
        $cartItem = CartItem::where('cart_id', $cartId)
            ->where('product_id', $productId)
            ->first();

        if (!$cartItem) {
            return false;
        }
        $product = Product::find($productId);
        $cartItem->quantity += $quantity;
        $cartItem->price =  $cartItem->quantity * $product->price;
        $cartItem->save();

        return true;
    }

    public function decrementItemQuantity($cartId, $productId, $quantity = 1)
    {
        $cartItem = CartItem::where('cart_id', $cartId)
            ->where('product_id', $productId)
            ->first();

        if (!$cartItem) {
            return false;
        }

        if ($cartItem->quantity <= $quantity) {
            $cartItem->delete();
        } else {
            $product = Product::find($productId);
            $cartItem->quantity -= $quantity;
            $cartItem->price =  $cartItem->quantity * $product->price;
            $cartItem->save();
        }

        return true;
    }
}