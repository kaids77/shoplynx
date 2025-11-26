@extends('layouts.app')

@section('content')
    <div class="hero" style="padding: 4rem 0;">
        <div class="container">
            <h1>New Arrivals</h1>
            <p>Check out our latest collection.</p>
        </div>
    </div>

    <div class="container">
        <div class="products-grid">
            @foreach($featuredProducts as $product)
                <div class="product-card">
                    <div class="product-image">
                        @if($product->image_path)
                            <img src="{{ asset('images/' . $product->image_path) }}" alt="{{ $product->name }}">
                        @else
                            <div
                                style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: #f0f0f0;">
                                No Image
                            </div>
                        @endif
                    </div>
                    <div class="product-info">
                        <h3>{{ $product->name }}</h3>
                        <p class="product-price">₱{{ number_format($product->price, 2) }}</p>
                        <div class="product-actions">
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline btn-sm">View</a>
                            <a href="{{ route('cart.add', $product->id) }}" class="btn btn-primary btn-sm">Add to Cart</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mb-4">
            <a href="{{ route('products.index') }}" class="btn btn-outline">View All Products</a>
        </div>
    </div>
@endsection