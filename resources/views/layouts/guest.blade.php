<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Shoplynx') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <header>
        <div class="container">
            <nav>
                <a href="/" class="logo">SHOPLYNX.</a>
                <div class="nav-actions">
                    <a href="{{ route('login') }}" class="btn btn-outline">Sign In</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Sign Up</a>
                </div>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>