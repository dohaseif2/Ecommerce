@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container my-4">
    <h3 class="mb-4">Order Details</h3>

    <!-- Order Details Table -->
    <table class="table table-bordered">
        <tr>
            <th>Order ID</th>
            <td>{{ $order->id }}</td>
        </tr>
        <tr>
            <th>User Name</th>
            <td>{{ $order->user->name }}</td>
        </tr>
        <tr>
            <th>Total Price</th>
            <td>${{ number_format($order->total_price, 2) }}</td>
        </tr>
        <tr>
            <th>Order Date</th>
            <td>{{ $order->created_at->format('Y-m-d H:i:s') }}</td>
        </tr>
    </table>

    <!-- Order Items Table -->
    <h4 class="mt-4">Order Items</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->price, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
