@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <h3 class="my-4"> Orders</h3>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Total Price</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>${{ number_format($order->total_price, 2) }}</td>
                    <td>{{ $order->created_at->format('Y-m-d H:i:s') }}</td>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">Details</a>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
