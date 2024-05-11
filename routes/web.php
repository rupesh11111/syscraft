<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DatatableController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;

// Login routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Registration routes
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

Route::group(['middleware' => [AuthMiddleware::class]], function () {
    Route::get('/', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('profile', [AuthController::class, 'profile'])->name('profile');
    Route::get('editProfile', [AuthController::class, 'editProfile'])->name('editProfile');
    Route::post('updateProfile/{id}', [AuthController::class, 'updateProfile'])->name('updateProfile');

    Route::get('customers', [DatatableController::class, 'customers'])->name('customers');
    Route::get('vendors', [DatatableController::class, 'vendors'])->name('vendors');
    Route::get('products', [DatatableController::class, 'products'])->name('products');
    Route::get('orders', [DatatableController::class, 'orders'])->name('orders');
    Route::get('transactions', [DatatableController::class, 'transactions'])->name('transactions');

    Route::post('orders/{id}', [OrderController::class, 'store'])->name('orders.store');

    Route::post('addToCart', [CartController::class, 'addToCart'])->name('addToCart');
    Route::get('cart', [CartController::class, 'index'])->name('cart');
    Route::delete('cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('stripe', [StripePaymentController::class, 'index']);
    Route::post('stripe', [StripePaymentController::class, 'stripe'])->name('stripe.post');
});
