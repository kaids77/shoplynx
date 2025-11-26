@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="section-title">Our Products</h2>
        <div class="products-grid">
            @foreach($products as $product)
                <div class="product-card">
                    <div class="product-image">
                        @if($product->image_path)
                            <img src="{{ asset('images/' . $product->image_path) }}" alt="{{ $product->name }}">
                        @else
                            <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: #f0f0f0;">
                                No Image
                            </div>
                        @endif
                    </div>
                    <div class="product-info">
                        <h3>{{ $product->name }}</h3>
                        <p class="product-price">₱{{ number_format($product->price, 2) }}</p>
                        <div class="product-actions">
                            <a href="{{ route('products.show', $product) }}" class="btn btn-outline btn-sm">View</a>
                            <a href="{{ route('cart.add', $product->id) }}" class="btn btn-primary btn-sm">Add to Cart</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection