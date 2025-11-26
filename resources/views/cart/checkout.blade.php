@extends('layouts.app')

@section('content')
    <div class="container" style="padding: 4rem 0;">
        <h1 class="mb-4">Checkout</h1>
        <div class="grid" style="grid-template-columns: 2fr 1fr; gap: 2rem;">
            <div class="card">
                <h3 class="mb-4">Shipping Details</h3>
                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="shipping_address">Shipping Address</label>
                        <textarea name="shipping_address" id="shipping_address" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="payment_method">Payment Method</label>
                        <select name="payment_method" id="payment_method" required>
                            <option value="gcash">GCash</option>
                            <option value="paypal">PayPal</option>
                            <option value="cod">Cash on Delivery</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Place Order</button>
                </form>
            </div>
            <div class="card">
                <h3 class="mb-4">Order Summary</h3>
                @php $total = 0 @endphp
                @foreach($cart as $id => $details)
                    @php $total += $details['price'] * $details['quantity'] @endphp
                    <div class="flex justify-between mb-2">
                        <span>{{ $details['name'] }} x {{ $details['quantity'] }}</span>
                        <span>₱{{ $details['price'] * $details['quantity'] }}</span>
                    </div>
                @endforeach
                <div style="border-top: 1px solid var(--border); margin-top: 1rem; padding-top: 1rem;">
                    <div class="flex justify-between" style="font-weight: 700; font-size: 1.2rem;">
                        <span>Total</span>
                        <span>₱{{ $total }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection