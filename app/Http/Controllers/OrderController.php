<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\CartItem;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function create(Request $request)
    {
        $userId = auth()->id(); 
        $cartItems = CartItem::where('cart_id', $request->input('cart_id'))->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Cart is empty'], 400);
        }

        $order = $this->orderService->createOrder($userId, $cartItems);

        CartItem::where('cart_id', $request->input('cart_id'))->delete();

        return response()->json(['message'=>'Order created successfully',  new OrderResource($order) ], 201);
    }
}
