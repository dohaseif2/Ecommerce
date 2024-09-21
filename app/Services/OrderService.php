<?php

namespace App\Services;

use App\Events\OrderCreated;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderItem;

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
        Notification::create([
            'user_id' => auth()->id(),
            'message' => "New order created: Order ID " . $order->id,
            'read' => false,
        ]);
        broadcast(new OrderCreated($order))->toOthers();
        
        return $order;
    }
    public function getOrderById($id)
    {
        return Order::with('user', 'orderItems')->findOrFail($id);
    }
}
