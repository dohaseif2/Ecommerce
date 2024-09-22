<?php

namespace App\Services;

use App\Events\OrderCreated;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Notifications\CreatedOrder;
use GuzzleHttp\Promise\Create;

class OrderService
{
    public function index()
    {
        return Order::with('user')->get();
    }
    public function createOrder($userId, $cartItems)
    {
        $totalPrice = 0;

        foreach ($cartItems as $item) {
            $totalPrice += $item->price * $item->quantity;
        }

        $order = Order::create([
            'user_id' => $userId,
            'total_price' => $totalPrice,
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ]);
        }
        $user_order = User::where('id', '=', $userId)->first();

        $users = User::where('role', '=', 'admin')->get();
        foreach ($users as $user) {
            $user->notify(new CreatedOrder($user_order, $order));
        }

        event(new  OrderCreated($order));

        return $order;
    }
    public function getOrderById($id)
    {
        return Order::with('user', 'orderItems')->findOrFail($id);
    }
}