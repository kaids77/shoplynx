<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Shoplynx</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <a href="{{ route('admin.dashboard') }}" class="logo">
                    <img src="{{ asset('images/logo.png') }}" alt="ShopLynx Admin" class="logo-img">
                </a>
                <ul class="nav-links">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.products') }}">Products</a></li>
                    <li><a href="{{ route('admin.orders.index') }}">Orders</a></li>
                    <li><a href="{{ route('admin.customers') }}">Customers</a></li>
                </ul>
                <div class="nav-actions">
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </nav>
        </div>
    </header>

    <main class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>