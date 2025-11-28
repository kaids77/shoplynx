@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <!-- Search Bar -->
        <div class="products-search-container">
            <div class="products-search-wrapper">
                <input type="text" 
                       id="productSearch" 
                       placeholder="Search products..." 
                       class="products-search-input" 
                       value="{{ $searchTerm }}">
                <button type="button" id="searchBtn" class="products-search-btn">Search</button>
            </div>
        </div>

        @if($searchTerm)
            <h2 class="section-title">Search Results for "{{ $searchTerm }}"</h2>
            @if($products->count() > 0)
                <p class="search-count">Found {{ $products->count() }} product(s)</p>
            @endif
        @else
            <h2 class="section-title">Our Products</h2>
        @endif
        
        @if($products->count() > 0)
            <div class="products-grid">
                @foreach($products as $product)
                    <div class="product-card">
                        <div class="product-image">
                            @if($product->stock_quantity <= 0)
                                <div class="out-of-stock-badge">Out of Stock</div>
                            @elseif($product->stock_quantity < 5)
                                <div class="low-stock-badge">Only {{ $product->stock_quantity }} left!</div>
                            @endif
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
                            <p class="product-stock" style="font-size: 0.9rem; color: #666; margin-bottom: 1rem;">
                                Stock: {{ $product->stock_quantity }}
                            </p>
                            <div class="product-actions">
                                <a href="{{ route('products.show', $product) }}" class="btn btn-outline btn-sm">View</a>
                                @if($product->stock_quantity > 0)
                                    <a href="{{ route('cart.add', $product->id) }}" class="btn btn-primary btn-sm">Add to Cart</a>
                                @else
                                    <button class="btn btn-secondary btn-sm" disabled>Out of Stock</button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <p>No products found{{ $searchTerm ? ' matching your search' : '' }}.</p>
                @if($searchTerm)
                    <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">View All Products</a>
                @endif
            </div>
        @endif
    </div>

    <script>
        // Search functionality - only on button click or Enter key
        const searchInput = document.getElementById('productSearch');
        const searchBtn = document.getElementById('searchBtn');

        function performSearch() {
            const searchTerm = searchInput.value.trim();
            const url = new URL(window.location.href);
            
            if (searchTerm) {
                url.searchParams.set('search', searchTerm);
            } else {
                url.searchParams.delete('search');
            }
            
            window.location.href = url.toString();
        }

        // Search on Enter key press
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });

        // Search on button click
        searchBtn.addEventListener('click', performSearch);
    </script>
@endsection