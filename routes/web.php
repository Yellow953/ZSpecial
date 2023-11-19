<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::get('/password/reset', 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/email', 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset/{token}', 'App\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/password/reset', 'App\Http\Controllers\Auth\ResetPasswordController@reset')->name('password.update');

// Download
Route::get('/download/refund_policy', [App\Http\Controllers\HomeController::class, 'download_refund_policy']);
Route::get('/download/shipping_policy', [App\Http\Controllers\HomeController::class, 'download_shipping_policy']);
Route::get('/download/privacy_policy', [App\Http\Controllers\HomeController::class, 'download_privacy_policy']);
Route::get('/download/terms_of_service', [App\Http\Controllers\HomeController::class, 'download_terms_of_service']);

// Shop
Route::get('/shop', [App\Http\Controllers\HomeController::class, 'shop'])->name('shop');

// Cart
Route::get('/cart', [App\Http\Controllers\CartController::class, 'cart'])->name('cart');
Route::get('/checkout', [App\Http\Controllers\CartController::class, 'checkout']);
Route::post('/checkout', [App\Http\Controllers\CartController::class, 'order']);

// Profile
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile']);
Route::post('/profile/save', [App\Http\Controllers\HomeController::class, 'save_profile']);
Route::get('/password/edit', [App\Http\Controllers\HomeController::class, 'EditPassword']);
Route::post('/password/update', [App\Http\Controllers\HomeController::class, 'UpdatePassword']);

Route::prefix('/users')->group(function () {
    Route::get('/{user}/edit', [App\Http\Controllers\UserController::class, 'edit']);
    Route::post('/{user}/update', [App\Http\Controllers\UserController::class, 'update']);
    Route::get('/{user}/destroy', [App\Http\Controllers\UserController::class, 'destroy']);
    Route::get('/new', [App\Http\Controllers\UserController::class, 'new']);
    Route::post('/create', [App\Http\Controllers\UserController::class, 'create']);
    Route::get('/', [App\Http\Controllers\UserController::class, 'index']);
});

// Currencies
Route::prefix('/currency')->group(function () {
    Route::get('/edit', [App\Http\Controllers\CurrencyController::class, 'edit']);
    Route::post('/update', [App\Http\Controllers\CurrencyController::class, 'update']);
    Route::post('/active', [App\Http\Controllers\CurrencyController::class, 'active']);
});

// Backups
Route::prefix('/backup')->group(function () {
    Route::get('/', [App\Http\Controllers\BackupController::class, 'index']);

    // Export
    Route::prefix('/export')->group(function () {
        Route::get('/categories', [App\Http\Controllers\BackupController::class, 'ExportCategories']);
        Route::get('/products', [App\Http\Controllers\BackupController::class, 'ExportProducts']);
        Route::get('/users', [App\Http\Controllers\BackupController::class, 'ExportUsers']);
        Route::get('/logs', [App\Http\Controllers\BackupController::class, 'ExportLogs']);
        Route::get('/orders', [App\Http\Controllers\BackupController::class, 'ExportOrders']);
    });

    // Import
    Route::prefix('/import')->group(function () {
        Route::post('/categories', [App\Http\Controllers\BackupController::class, 'ImportCategories']);
        Route::post('/products', [App\Http\Controllers\BackupController::class, 'ImportProducts']);
        Route::post('/users', [App\Http\Controllers\BackupController::class, 'ImportUsers']);
        Route::post('/logs', [App\Http\Controllers\BackupController::class, 'ImportLogs']);
        Route::post('/orders', [App\Http\Controllers\BackupController::class, 'ImportOrders']);
    });
});

// Categories
Route::prefix('/categories')->group(function () {
    Route::get('/new', [App\Http\Controllers\CategoryController::class, 'new']);
    Route::post('/create', [App\Http\Controllers\CategoryController::class, 'create']);
    Route::get('/{category}/edit', [App\Http\Controllers\CategoryController::class, 'edit']);
    Route::post('/{category}/update', [App\Http\Controllers\CategoryController::class, 'update']);
    Route::get('/{category}/destroy', [App\Http\Controllers\CategoryController::class, 'destroy']);
    Route::get('/{category}/switch', [App\Http\Controllers\CategoryController::class, 'switch']);
    Route::get('/', [App\Http\Controllers\CategoryController::class, 'index']);
});

// Products
Route::prefix('/products')->group(function () {
    Route::get('/search', [App\Http\Controllers\ProductController::class, 'search']);
    Route::get('/new', [App\Http\Controllers\ProductController::class, 'new']);
    Route::post('/create', [App\Http\Controllers\ProductController::class, 'create']);
    Route::get('/{product}/edit', [App\Http\Controllers\ProductController::class, 'edit']);
    Route::post('/{product}/update', [App\Http\Controllers\ProductController::class, 'update']);
    Route::get('/{product}/import', [App\Http\Controllers\ProductController::class, 'import']);
    Route::post('/{product}/save', [App\Http\Controllers\ProductController::class, 'save']);
    Route::get('/{product}/destroy', [App\Http\Controllers\ProductController::class, 'destroy']);
    Route::get('/{product}/secondary_images', [App\Http\Controllers\ProductController::class, 'secondary_images_index']);
    Route::get('/', [App\Http\Controllers\ProductController::class, 'index']);
});
Route::post('/secondary_image/create', [App\Http\Controllers\ProductController::class, 'secondary_images_create']);
Route::get('/secondary_image/{secondary_image}/destroy', [App\Http\Controllers\ProductController::class, 'secondary_images_destroy']);

// Orders
Route::prefix('/orders')->group(function () {
    Route::get('/{order}/complete', [App\Http\Controllers\OrderController::class, 'complete']);
    Route::get('/{order}/edit', [App\Http\Controllers\OrderController::class, 'edit']);
    Route::post('/{order}/update', [App\Http\Controllers\OrderController::class, 'update']);
    Route::get('/{order}/destroy', [App\Http\Controllers\OrderController::class, 'destroy']);
    Route::get('/{order}/show', [App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
    Route::get('/new', [App\Http\Controllers\OrderController::class, 'new']);
    Route::post('/create', [App\Http\Controllers\OrderController::class, 'create']);
    Route::post('/checkout', [App\Http\Controllers\HomeController::class, 'checkout']);
    Route::get('/', [App\Http\Controllers\OrderController::class, 'index']);
});

// Promo
Route::prefix('/promos')->group(function () {
    Route::get('/{promo}/edit', [App\Http\Controllers\PromoController::class, 'edit']);
    Route::post('/{promo}/update', [App\Http\Controllers\PromoController::class, 'update']);
    Route::get('/{promo}/destroy', [App\Http\Controllers\PromoController::class, 'destroy']);
    Route::get('/{promo}/show', [App\Http\Controllers\PromoController::class, 'show']);
    Route::get('/new', [App\Http\Controllers\PromoController::class, 'new']);
    Route::post('/create', [App\Http\Controllers\PromoController::class, 'create']);
    Route::post('/check', [App\Http\Controllers\PromoController::class, 'check'])->name('check_promo');
    Route::get('/', [App\Http\Controllers\PromoController::class, 'index']);
});

// Variables
Route::prefix('/variables')->group(function () {
    Route::get('new', [App\Http\Controllers\VariableController::class, 'new']);
    Route::post('create', [App\Http\Controllers\VariableController::class, 'create']);
    Route::get('{variable}/edit', [App\Http\Controllers\VariableController::class, 'edit']);
    Route::post('{variable}/update', [App\Http\Controllers\VariableController::class, 'update']);
    Route::get('{variable}/destroy', [App\Http\Controllers\VariableController::class, 'destroy']);
    Route::get('/', [App\Http\Controllers\VariableController::class, 'index']);
});

// Social Media
Route::post('/sm_post', [App\Http\Controllers\SocialMediaController::class, 'sm_post']);
Route::get('/social_media', [App\Http\Controllers\SocialMediaController::class, 'index']);

// Admin CRM
Route::get('/app', [App\Http\Controllers\AdminController::class, 'index']);

// Logs
Route::get('/logs', [App\Http\Controllers\LogController::class, 'index']);

// Notifications
Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'index']);

// logout
Route::get('/logout', [App\Http\Controllers\HomeController::class, 'custom_logout']);

// Home
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
