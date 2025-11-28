<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Shoplynx</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
    <script src="{{ asset('js/cart.js') }}" defer></script>
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <a href="{{ route('home') }}" class="logo">
                    <img src="{{ asset('images/logo.png') }}" alt="ShopLynx" class="logo-img">
                </a>
                <ul class="nav-links">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('products.index') }}">Products</a></li>
                    <li><a href="{{ route('about') }}">About</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
                <div class="nav-actions">
                    @auth
                        <a href="{{ route('cart.index') }}" class="btn btn-outline cart-btn">
                            🛒 Cart
                            @if(Auth::user()->cartItems()->count() > 0)
                                <span class="cart-badge">{{ Auth::user()->cartItems()->count() }}</span>
                            @endif
                        </a>
                        <a href="{{ route('orders.index') }}" class="btn btn-outline">My Orders</a>
                        <a href="{{ route('transactions.index') }}" class="btn btn-outline">Transactions</a>
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline">Admin</a>
                        @endif
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary">Settings</a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-primary">Get Started</a>
                    @endauth
                </div>
            </nav>
        </div>
    </header>

    <main>
        @if(session('success'))
            <div class="container mt-4">
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="container mt-4">
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} Shoplynx. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>