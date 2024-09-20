<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderService;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        $orders = $this->orderService->index();
        return view('orders.index', compact('orders'));
    }
    public function show($id)
    {
        $order = $this->orderService->getOrderById($id);
        return view('orders.show', compact('order'))->render();
    }
}
