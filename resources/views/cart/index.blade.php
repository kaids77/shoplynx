@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="section-title">Your Cart</h2>
    @if(session('cart'))
        <div class="cart-table-container">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0 @endphp
                    @foreach(session('cart') as $id => $details)
                        @php $total += $details['price'] * $details['quantity'] @endphp
                        <tr data-id="{{ $id }}">
                            <td data-th="Product">
                                <div class="row">
                                    <div class="col-sm-3 hidden-xs">
                                        @if($details['image_path'])
                                            <img src="{{ asset('images/' . $details['image_path']) }}" width="50" height="50" class="img-responsive" />
                                        @else
                                            <div style="width: 50px; height: 50px; background: #ddd;"></div>
                                        @endif
                                    </div>
                                    <div class="col-sm-9">
                                        <h4 class="nomargin">{{ $details['name'] }}</h4>
                                    </div>
                                </div>
                            </td>
                            <td data-th="Price">₱{{ number_format($details['price'], 2) }}</td>
                            <td data-th="Quantity">
                                <input type="number" value="{{ $details['quantity'] }}" min="1" class="form-control quantity update-cart" />
                            </td>
                            <td data-th="Subtotal" class="text-center">₱{{ number_format($details['price'] * $details['quantity'], 2) }}</td>
                            <td class="actions" data-th="">
                                <form action="{{ route('cart.remove') }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{ $id }}">
                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="text-right">
                            <h3><strong>Total: ₱{{ number_format($total, 2) }}</strong></h3>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-right">
                            <a href="{{ route('products.index') }}" class="btn btn-outline">Continue Shopping</a>
                            <a href="{{ route('checkout') }}" class="btn btn-primary">Checkout</a>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    @else
        <div class="empty-cart">
            <p>Your cart is empty.</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary">Start Shopping</a>
        </div>
    @endif
</div>
@endsection