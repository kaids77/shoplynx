@extends('layouts.app')

@section('content')
    <div class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1>Welcome to Shoplynx</h1>
                <p>Your premium destination for quality products. Experience the future of shopping with us.</p>
                @guest
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Get Started</a>
                    <a href="{{ route('login') }}" class="btn btn-outline btn-lg">Sign In</a>
                @else
                    <a href="{{ route('home') }}" class="btn btn-primary btn-lg">Go to Shop</a>
                @endguest
            </div>
        </div>
    </div>

    <div class="features-section">
        <div class="container">
            <div class="features-grid">
                <div class="feature-card">
                    <h3>Premium Quality</h3>
                    <p>We source only the finest materials for our products.</p>
                </div>
                <div class="feature-card">
                    <h3>Fast Shipping</h3>
                    <p>Get your orders delivered to your doorstep in no time.</p>
                </div>
                <div class="feature-card">
                    <h3>Secure Payment</h3>
                    <p>Your transactions are safe and encrypted.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <h2 class="section-title">Featured Products</h2>
        <div class="products-grid">
            @foreach($featuredProducts as $product)
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
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline btn-sm">View</a>
                            <a href="{{ route('cart.add', $product->id) }}" class="btn btn-primary btn-sm">Add to Cart</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection