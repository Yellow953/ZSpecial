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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');