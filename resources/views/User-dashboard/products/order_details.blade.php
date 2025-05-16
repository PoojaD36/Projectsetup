@extends('User-dashboard.layouts.layout')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Order Details #{{ $order->order_number }}</h2>
            
            <div class="card">
                <div class="card-header">
                    <h4>Order Information</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Order Date:</strong> {{ $order->created_at->format('M d, Y h:i A') }}</p>
                            <p><strong>Status:</strong> 
                                <span class="badge bg-{{ $order->status == 'completed' ? 'success' : 'warning' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Total Items:</strong> {{ $order->item_count }}</p>
                            <p><strong>Grand Total:</strong> ${{ number_format($order->grand_total, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h4>Order Items</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td>${{ number_format($item->price, 2) }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h4>Shipping Information</h4>
                </div>
                <div class="card-body">
                    <address>
                        {{ $order->first_name }} {{ $order->last_name }}<br>
                        {{ $order->address }}<br>
                        @if($order->address_2)
                            {{ $order->address_2 }}<br>
                        @endif
                        {{ $order->city }}, {{ $order->state }} {{ $order->zip_code }}<br>
                        {{ $order->country }}<br>
                        Phone: {{ $order->phone }}
                    </address>
                </div>
            </div>

            <a href="{{ route('order.history') }}" class="btn btn-secondary mt-3">
                Back to Order History
            </a>
        </div>
    </div>
</div>
@endsection