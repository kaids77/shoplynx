<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;

// Landing Page
Route::get('/', [HomeController::class, 'index'])->name('landing');

// Auth Routes
Route::middleware(['guest', 'prevent-back-history'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// User Routes
Route::middleware(['auth', 'prevent-back-history'])->group(function () {
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::get('/about', [HomeController::class, 'about'])->name('about');
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/add-to-cart/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/update-cart', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/remove-from-cart', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [CartController::class, 'processCheckout'])->name('checkout.process');

    // Orders
    Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
    Route::put('/orders/{id}/cancel', [App\Http\Controllers\OrderController::class, 'cancel'])->name('orders.cancel');

    // Transactions
    Route::get('/transactions', [App\Http\Controllers\TransactionController::class, 'index'])->name('transactions.index');

    // Profile Settings
    Route::get('/profile/settings', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::put('/profile/image', [App\Http\Controllers\ProfileController::class, 'updateImage'])->name('profile.image');
});

// Admin Routes
Route::middleware(['auth', 'admin', 'prevent-back-history'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/products', [AdminController::class, 'products'])->name('products');
        Route::get('/products/create', [AdminController::class, 'createProduct'])->name('products.create');
        Route::post('/products', [AdminController::class, 'storeProduct'])->name('products.store');
        Route::get('/products/{product}/edit', [AdminController::class, 'editProduct'])->name('products.edit');
        Route::put('/products/{product}', [AdminController::class, 'updateProduct'])->name('products.update');
        Route::delete('/products/{product}', [AdminController::class, 'deleteProduct'])->name('products.delete');
        Route::get('/customers', [App\Http\Controllers\CustomerController::class, 'index'])->name('customers');

        // Admin Orders
        Route::get('/orders', [App\Http\Controllers\AdminOrderController::class, 'index'])->name('orders.index');
        Route::put('/orders/{order}/status', [App\Http\Controllers\AdminOrderController::class, 'updateStatus'])->name('orders.update-status');
    });
});
