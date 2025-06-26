<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// routes/web.php or routes/admin.php
Route::resource('admin/category', \App\Http\Controllers\Admin\CategoryController::class);
Route::get('admin/category/child/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'child']);
Route::get('admin/category/single-delete/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'destroy']);
Route::post('admin/category/update-publish/{publish}', [\App\Http\Controllers\Admin\CategoryController::class, 'postUpdatePublish']);
Route::post('admin/category/bulk_delete', [\App\Http\Controllers\Admin\CategoryController::class, 'bulkDelete']);


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',
])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

});
