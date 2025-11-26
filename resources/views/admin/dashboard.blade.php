@extends('layouts.admin')

@section('content')
    <div class="dashboard-container">
        <h1 class="mb-4">Dashboard</h1>
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Products</h3>
                <p class="stat-number">{{ $totalProducts }}</p>
            </div>
            <div class="stat-card">
                <h3>Total Orders</h3>
                <p class="stat-number">{{ $totalOrders }}</p>
            </div>
            <div class="stat-card">
                <h3>Total Customers</h3>
                <p class="stat-number">{{ $totalUsers }}</p>
            </div>
        </div>

        <div class="recent-orders mt-5">
            <h2>Recent Orders</h2>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Info</th>
                            <th>Products</th>
                            <th>Payment Method</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentOrders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>
                                    <strong>{{ $order->customer_name }}</strong><br>
                                    <small>{{ $order->customer_email }}</small><br>
                                    <small>{{ $order->customer_phone }}</small>
                                </td>
                                <td>
                                    @foreach($order->items as $item)
                                        <div>{{ $item->product->name }} (x{{ $item->quantity }})</div>
                                    @endforeach
                                </td>
                                <td>{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</td>
                                <td>₱{{ number_format($order->total_price, 2) }}</td>
                                <td><span class="badge badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span></td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection