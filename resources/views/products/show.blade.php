@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <a href="{{ route('products.index') }}" class="btn btn-outline back-button">← Back to Products</a>
    
    <div class="product-detail-container">
        <div class="product-detail-image-wrapper">
            @if($product->image_path)
                <img src="{{ asset('images/' . $product->image_path) }}" alt="{{ $product->name }}" class="product-detail-image">
            @else
                <div class="no-image-large">No Image</div>
            @endif
        </div>
        <div class="product-detail-info">
            <h1>{{ $product->name }}</h1>
            <p class="product-price-large">₱{{ number_format($product->price, 2) }}</p>
            <div class="product-description">
                <p>{{ $product->description }}</p>
            </div>
            <a href="{{ route('cart.add', $product->id) }}" class="btn btn-primary btn-lg mt-4">Add to Cart</a>
        </div>
    </div>
</div>
@endsection