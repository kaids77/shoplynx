@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="section-title">Account Settings</h2>
    
    <div class="profile-container">
        <!-- Profile Image -->
        <div class="settings-card">
            <div class="profile-image-container">
                @if(Auth::user()->profile_image)
                    <img src="{{ asset('images/profiles/' . Auth::user()->profile_image) }}" alt="Profile" class="profile-image">
                @else
                    <img src="{{ asset('images/default-avatar.png') }}" alt="Profile" class="profile-image">
                @endif
            </div>
            
            <h3>Profile Picture</h3>
            <form action="{{ route('profile.image') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="profile_image">Upload New Picture</label>
                    <input type="file" name="profile_image" id="profile_image" class="form-control" accept="image/*">
                    @error('profile_image')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update Picture</button>
            </form>
        </div>

        <!-- Profile Information -->
        <div class="settings-card mt-4">
            <h3>Profile Information</h3>
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
                    @error('name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
        </div>

        <!-- Change Password Section -->
        <div class="settings-card mt-4">
            <h3>Security</h3>
            <button type="button" id="changePasswordBtn" class="btn btn-outline" onclick="togglePasswordForm()">Change Password</button>
            
            <div id="passwordForm" style="display: none; margin-top: 1.5rem;">
                <form action="{{ route('profile.password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" name="current_password" id="current_password" class="form-control" required>
                        @error('current_password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" name="new_password" id="new_password" class="form-control" required>
                        @error('new_password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="new_password_confirmation">Confirm New Password</label>
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Password</button>
                    <button type="button" class="btn btn-outline" onclick="togglePasswordForm()">Cancel</button>
                </form>
            </div>
        </div>

        <!-- Logout Section -->
        <div class="settings-card mt-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>
</div>

<script>
function togglePasswordForm() {
    const form = document.getElementById('passwordForm');
    const btn = document.getElementById('changePasswordBtn');
    if (form.style.display === 'none') {
        form.style.display = 'block';
        btn.style.display = 'none';
    } else {
        form.style.display = 'none';
        btn.style.display = 'inline-block';
    }
}
</script>
@endsection