<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/user/edit', [App\Http\Controllers\UserController::class, 'edit']);
Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update']);
Route::get('/user/{id}/delete', [App\Http\Controllers\UserController::class, 'destroy']);
Route::get('/user/new', [App\Http\Controllers\UserController::class, 'new']);
Route::post('/user/create', [App\Http\Controllers\UserController::class, 'create']);
Route::get('/users', [App\Http\Controllers\UserController::class, 'index']);
Route::get('/password/edit', [App\Http\Controllers\UserController::class, 'EditPassword']);
Route::post('/password/update', [App\Http\Controllers\UserController::class, 'UpdatePassword']);

// Dollar Rates
Route::get('/dollar_rate/edit', [App\Http\Controllers\DollarRateController::class, 'edit']);
Route::post('/dollar_rate/update', [App\Http\Controllers\DollarRateController::class, 'update']);
Route::post('/dollar_rate/usage', [App\Http\Controllers\DollarRateController::class, 'usage']);


// Admin CRM
Route::get('/app', [App\Http\Controllers\AdminController::class, 'index']);

// Backups
Route::get('/backup', [App\Http\Controllers\BackupController::class, 'index']);
// Export
Route::get('/backup/export/categories', [App\Http\Controllers\BackupController::class, 'ExportCategories']);
Route::get('/backup/export/products', [App\Http\Controllers\BackupController::class, 'ExportProducts']);
Route::get('/backup/export/users', [App\Http\Controllers\BackupController::class, 'ExportUsers']);
Route::get('/backup/export/logs', [App\Http\Controllers\BackupController::class, 'ExportLogs']);
Route::get('/backup/export/reports', [App\Http\Controllers\BackupController::class, 'ExportReports']);
Route::get('/backup/export/orders', [App\Http\Controllers\BackupController::class, 'ExportOrders']);
// Import
Route::post('/backup/import/categories', [App\Http\Controllers\BackupController::class, 'ImportCategories']);
Route::post('/backup/import/products', [App\Http\Controllers\BackupController::class, 'ImportProducts']);
Route::post('/backup/import/users', [App\Http\Controllers\BackupController::class, 'ImportUsers']);
Route::post('/backup/import/logs', [App\Http\Controllers\BackupController::class, 'ImportLogs']);
Route::post('/backup/import/reports', [App\Http\Controllers\BackupController::class, 'ImportReports']);
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
Route::get('/product/new', [App\Http\Controllers\ProductController::class, 'new']);
Route::post('/product/create', [App\Http\Controllers\ProductController::class, 'create']);
Route::get('/product/{id}/edit', [App\Http\Controllers\ProductController::class, 'edit']);
Route::post('/product/{id}/update', [App\Http\Controllers\ProductController::class, 'update']);
Route::get('/product/{id}/destroy', [App\Http\Controllers\ProductController::class, 'destroy']);
Route::get('/products', [App\Http\Controllers\ProductController::class, 'index']);

// Social Media
Route::get('/social_media', [App\Http\Controllers\SocialMediaController::class, 'index']);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');