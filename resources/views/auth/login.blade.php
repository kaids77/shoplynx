@extends('layouts.app')

@section('content')
    <div class="auth-container">
        <div class="auth-card">
            <h2>Sign In</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control" required autofocus>
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-auth">Login</button>
            </form>
            <p class="auth-footer">Don't have an account? <a href="{{ route('register') }}">Sign up</a></p>
        </div>
    </div>
@endsection