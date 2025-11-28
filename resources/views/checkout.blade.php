@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="section-title">Checkout</h2>
        <div class="checkout-container">
            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Full Name:</label>
                    <p class="form-control-plaintext"
                        style="font-weight: 500; font-size: 1.1rem; padding: 0.375rem 0; border: 1px solid #dee2e6; padding-left: 1rem;">
                        {{ Auth::user()->name }}
                    </p>
                </div>
                <div class="form-group">
                    <label>Email Address:</label>
                    <p class="form-control-plaintext"
                        style="font-weight: 500; font-size: 1.1rem; padding: 0.375rem 0; border: 1px solid #dee2e6; padding-left: 1rem;">
                        {{ Auth::user()->email }}
                    </p>
                </div>
                <div class="form-group">
                    <label for="customer_phone">Phone Number (11 digits)</label>
                    <input type="tel" name="customer_phone" id="customer_phone" class="form-control" maxlength="11"
                        pattern="[0-9]{11}" placeholder="09XXXXXXXXX" required>
                </div>
                <div class="form-group">
                    <label for="shipping_address">Shipping Address</label>
                    <textarea name="shipping_address" id="shipping_address" class="form-control" rows="3"
                        required></textarea>
                </div>
                <div class="form-group">
                    <label for="payment_method">Payment Method</label>
                    <select name="payment_method" id="payment_method" class="form-control" required>
                        <option value="gcash">GCash</option>
                        <option value="paypal">PayPal</option>
                        <option value="cod">Cash on Delivery</option>
                        <option value="bank_transfer">Bank Transfer</option>
                    </select>
                </div>
                <div class="checkout-summary">
                    <h3>Order Summary</h3>
                    @php $total = 0 @endphp
                    @foreach($cartItems as $item)
                        @php $total += $item->product->price * $item->quantity @endphp
                        <div class="summary-item">
                            <span>{{ $item->product->name }} x {{ $item->quantity }}</span>
                            <span>₱{{ number_format($item->product->price * $item->quantity, 2) }}</span>
                        </div>
                    @endforeach
                    <div class="summary-total">
                        <strong>Total: ₱{{ number_format($total, 2) }}</strong>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-4">Place Order</button>
            </form>
        </div>
    </div>
@endsection