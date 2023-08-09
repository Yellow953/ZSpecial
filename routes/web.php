<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::get('/user/edit', [App\Http\Controllers\UserController::class, 'edit']);
Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update']);
Route::get('/user/{id}/destroy', [App\Http\Controllers\UserController::class, 'destroy']);
Route::get('/user/new', [App\Http\Controllers\UserController::class, 'new']);
Route::post('/user/create', [App\Http\Controllers\UserController::class, 'create']);
Route::get('/users', [App\Http\Controllers\UserController::class, 'index']);
Route::get('/password/edit', [App\Http\Controllers\UserController::class, 'EditPassword']);
Route::post('/password/update', [App\Http\Controllers\UserController::class, 'UpdatePassword']);


// Admin CRM
Route::get('/app', [App\Http\Controllers\AdminController::class, 'index']);

// Dollar Rates
Route::get('/dollar_rate/edit', [App\Http\Controllers\DollarRateController::class, 'edit']);
Route::post('/dollar_rate/update', [App\Http\Controllers\DollarRateController::class, 'update']);
Route::post('/dollar_rate/usage', [App\Http\Controllers\DollarRateController::class, 'usage']);

// Backups
Route::get('/backup', [App\Http\Controllers\BackupController::class, 'index']);
// Export
Route::get('/backup/export/categories', [App\Http\Controllers\BackupController::class, 'ExportCategories']);
Route::get('/backup/export/products', [App\Http\Controllers\BackupController::class, 'ExportProducts']);
Route::get('/backup/export/users', [App\Http\Controllers\BackupController::class, 'ExportUsers']);
Route::get('/backup/export/logs', [App\Http\Controllers\BackupController::class, 'ExportLogs']);
Route::get('/backup/export/orders', [App\Http\Controllers\BackupController::class, 'ExportOrders']);
// Import
Route::post('/backup/import/categories', [App\Http\Controllers\BackupController::class, 'ImportCategories']);
Route::post('/backup/import/products', [App\Http\Controllers\BackupController::class, 'ImportProducts']);
Route::post('/backup/import/users', [App\Http\Controllers\BackupController::class, 'ImportUsers']);
Route::post('/backup/import/logs', [App\Http\Controllers\BackupController::class, 'ImportLogs']);
Route::post('/backup/import/orders', [App\Http\Controllers\BackupController::class, 'ImportOrders']);

// Logs
Route::get('/logs', [App\Http\Controllers\LogController::class, 'index']);

// Notifications
Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'index']);

// Categories
Route::get('/category/new', [App\Http\Controllers\CategoryController::class, 'new']);
Route::post('/category/create', [App\Http\Controllers\CategoryController::class, 'create']);
Route::get('/category/{id}/edit', [App\Http\Controllers\CategoryController::class, 'edit']);
Route::post('/category/{id}/update', [App\Http\Controllers\CategoryController::class, 'update']);
Route::get('/category/{id}/destroy', [App\Http\Controllers\CategoryController::class, 'destroy']);
Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index']);

// Products
Route::get('/product/search', [App\Http\Controllers\ProductController::class, 'search']);
Route::get('/product/new', [App\Http\Controllers\ProductController::class, 'new']);
Route::post('/product/create', [App\Http\Controllers\ProductController::class, 'create']);
Route::get('/product/{id}/edit', [App\Http\Controllers\ProductController::class, 'edit']);
Route::post('/product/{id}/update', [App\Http\Controllers\ProductController::class, 'update']);
Route::get('/product/{id}/import', [App\Http\Controllers\ProductController::class, 'import']);
Route::post('/product/{id}/save', [App\Http\Controllers\ProductController::class, 'save']);
Route::get('/product/{id}/destroy', [App\Http\Controllers\ProductController::class, 'destroy']);
Route::get('/products', [App\Http\Controllers\ProductController::class, 'index']);

// Orders
Route::get('/order/{id}/complete', [App\Http\Controllers\OrderController::class, 'complete']);
Route::get('/order/{id}/edit', [App\Http\Controllers\OrderController::class, 'edit']);
Route::post('/order/{id}/update', [App\Http\Controllers\OrderController::class, 'update']);
Route::get('/order/{id}/destroy', [App\Http\Controllers\OrderController::class, 'destroy']);
Route::get('/order/{id}/show', [App\Http\Controllers\OrderController::class, 'show']);
Route::get('/order/new', [App\Http\Controllers\OrderController::class, 'new']);
Route::post('/order/create', [App\Http\Controllers\OrderController::class, 'create']);
Route::post('/order/checkout', [App\Http\Controllers\HomeController::class, 'checkout']);
Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index']);

// Cart
Route::post('/cart/create', [App\Http\Controllers\CartController::class, 'create']);
Route::get('/cart/{id}/destroy', [App\Http\Controllers\CartController::class, 'destroy']);
Route::get('/carts', [App\Http\Controllers\CartController::class, 'index']);

// Promo
Route::post('/check_promo', [App\Http\Controllers\PromoController::class, 'check'])->name('check_promo');
Route::get('/promo/{id}/edit', [App\Http\Controllers\PromoController::class, 'edit']);
Route::post('/promo/{id}/update', [App\Http\Controllers\PromoController::class, 'update']);
Route::get('/promo/{id}/destroy', [App\Http\Controllers\PromoController::class, 'destroy']);
Route::get('/promo/{id}/show', [App\Http\Controllers\PromoController::class, 'show']);
Route::get('/promo/new', [App\Http\Controllers\PromoController::class, 'new']);
Route::post('/promo/create', [App\Http\Controllers\PromoController::class, 'create']);
Route::get('/promos', [App\Http\Controllers\PromoController::class, 'index']);

// Social Media
Route::post('/sm_post', [App\Http\Controllers\SocialMediaController::class, 'sm_post']);
Route::get('/social_media', [App\Http\Controllers\SocialMediaController::class, 'index']);

// Shop
Route::get('/shop', [App\Http\Controllers\HomeController::class, 'shop'])->name('shop');
// Cart
Route::get('/cart', [App\Http\Controllers\HomeController::class, 'cart'])->name('cart');

// Home
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');