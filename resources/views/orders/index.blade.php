@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="section-title">My Orders</h2>

        @if($orders->count() > 0)
            <div class="orders-container">
                @foreach($orders as $order)
                    <div class="order-card">
                        <div class="order-header">
                            <div>
                                <h3>Order #{{ $order->id }}</h3>
                                <p class="order-date">{{ $order->created_at->format('F d, Y h:i A') }}</p>
                            </div>
                            <div>
                                <span class="badge badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
                            </div>
                        </div>

                        <div class="order-details">
                            <div class="order-info">
                                <p><strong>Customer:</strong> {{ $order->customer_name }}</p>
                                <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                                <p><strong>Phone:</strong> {{ $order->customer_phone }}</p>
                                <p><strong>Address:</strong> {{ $order->shipping_address }}</p>
                                <p><strong>Payment Method:</strong> {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</p>
                            </div>

                            <div class="order-items">
                                <h4>Items:</h4>
                                <ul>
                                    @foreach($order->items as $item)
                                        <li>{{ $item->product->name }} (x{{ $item->quantity }}) -
                                            ₱{{ number_format($item->price * $item->quantity, 2) }}</li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="order-total">
                                <h3>Total: ₱{{ number_format($order->total_price, 2) }}</h3>
                            </div>

                            {{-- Pending status with cancellation option --}}
                            @if($order->status === 'pending')
                                <div class="order-actions mt-3">
                                    <form action="{{ route('orders.cancel', $order->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to cancel this order?');">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-danger">Cancel Order</button>
                                    </form>
                                </div>
                            @endif

                            {{-- Shipped status --}}
                            @if($order->status === 'shipped')
                                <div class="order-actions mt-3">
                                    <p class="text-info" style="font-size: 0.9rem; margin-bottom: 0.5rem;">
                                        <strong>Order Shipped</strong>
                                    </p>
                                    <p class="text-muted" style="font-size: 0.85rem;">Your order is on the way.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center mt-5">
                <p>You haven't placed any orders yet.</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">Start Shopping</a>
            </div>
        @endif
    </div>
@endsection