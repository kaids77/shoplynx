@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="section-title">Transaction History</h2>

        <!-- Statistics Cards -->
        <div class="transaction-stats">
            <div class="stat-card stat-primary">
                <div class="stat-content">
                    <h3>₱{{ number_format($stats['total_spent'], 2) }}</h3>
                    <p>Total Spent</p>
                </div>
            </div>
            <div class="stat-card stat-success">
                <div class="stat-content">
                    <h3>{{ $stats['total_transactions'] }}</h3>
                    <p>Total Transactions</p>
                </div>
            </div>
            <div class="stat-card stat-warning">
                <div class="stat-content">
                    <h3>₱{{ number_format($stats['pending_amount'], 2) }}</h3>
                    <p>Pending Amount</p>
                </div>
            </div>
            <div class="stat-card stat-info">
                <div class="stat-content">
                    <h3>₱{{ number_format($stats['total_refunded'], 2) }}</h3>
                    <p>Total Refunded</p>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="transaction-filters">
            <form method="GET" action="{{ route('transactions.index') }}" class="filter-form">
                <div class="filter-group">
                    <label for="type">Type</label>
                    <select name="type" id="type" class="filter-select">
                        <option value="all" {{ request('type') == 'all' ? 'selected' : '' }}>All Types</option>
                        <option value="payment" {{ request('type') == 'payment' ? 'selected' : '' }}>Payment</option>
                        <option value="refund" {{ request('type') == 'refund' ? 'selected' : '' }}>Refund</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="filter-select">
                        <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                        <option value="refunded" {{ request('status') == 'refunded' ? 'selected' : '' }}>Refunded</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="date_from">From Date</label>
                    <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}" class="filter-input">
                </div>

                <div class="filter-group">
                    <label for="date_to">To Date</label>
                    <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}" class="filter-input">
                </div>

                <div class="filter-actions">
                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                    <a href="{{ route('transactions.index') }}" class="btn btn-outline">Clear</a>
                </div>
            </form>
        </div>

        <!-- Transactions List -->
        @if($transactions->count() > 0)
            <div class="transactions-container">
                @foreach($transactions as $transaction)
                    <div class="transaction-card">
                        <div class="transaction-header">
                            <div class="transaction-info">
                                <h3>{{ $transaction->reference_number }}</h3>
                                <p class="transaction-date">{{ $transaction->created_at->format('F d, Y h:i A') }}</p>
                            </div>
                            <div class="transaction-badges">
                                <span class="badge badge-{{ $transaction->transaction_type }}">
                                    {{ ucfirst($transaction->transaction_type) }}
                                </span>
                                <span class="badge badge-{{ $transaction->status }}">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </div>
                        </div>

                        <div class="transaction-details">
                            <div class="detail-row">
                                <span class="detail-label">Order ID:</span>
                                <span class="detail-value">
                                    <a href="{{ route('orders.index') }}" class="order-link">#{{ $transaction->order_id }}</a>
                                </span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Payment Method:</span>
                                <span class="detail-value">{{ ucfirst(str_replace('_', ' ', $transaction->payment_method)) }}</span>
                            </div>
                            @if($transaction->description)
                                <div class="detail-row">
                                    <span class="detail-label">Description:</span>
                                    <span class="detail-value">{{ $transaction->description }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Products List -->
                        @if($transaction->order && $transaction->order->items->count() > 0)
                            <div class="transaction-products">
                                <h4>Products:</h4>
                                <ul class="products-list">
                                    @foreach($transaction->order->items as $item)
                                        <li class="product-item">
                                            <span class="product-name">{{ $item->product->name }}</span>
                                            <span class="product-quantity">x{{ $item->quantity }}</span>
                                            <span class="product-price">₱{{ number_format($item->price * $item->quantity, 2) }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="transaction-amount {{ $transaction->transaction_type == 'refund' ? 'refund-amount' : '' }}">
                            <span class="amount-label">Amount:</span>
                            <span class="amount-value">
                                {{ $transaction->transaction_type == 'refund' ? '+' : '-' }}₱{{ number_format($transaction->amount, 2) }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pagination-container">
                {{ $transactions->links() }}
            </div>
        @else
            <div class="empty-state">
                <h3>No Transactions Found</h3>
                <p>You don't have any transactions yet or no transactions match your filters.</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">Start Shopping</a>
            </div>
        @endif
    </div>
@endsection