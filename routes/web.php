<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdvertiseController;
use App\Http\Controllers\Admin\MenuController;
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

//advertise
Route::resource('admin/advertise',AdvertiseController::class);
Route::get('admin/advertise/single-delete/{id}', [AdvertiseController::class, 'destroy']);
Route::post('admin/advertise/update-publish/{publish}', [AdvertiseController::class,'postUpdatePublish']);
Route::post('admin/advertise/bulk_delete', [AdvertiseController::class,'bulkDelete']);

//Navbar
Route::post('admin/nav/sub/{id}', [MenuController::class,'category'])->name('admin.nav.sub');

Route::post('admin/nav/update-publish/{publish}', [MenuController::class,'postUpdatePublish'])->name('admin.nav.update.publish');

Route::post('admin/nav/change-type-create', [MenuController::class,'changeTypeCreate'])->name('admin.nav.changeTypeCreate');

Route::post('admin/nav/{id}/change-type-update',[MenuController::class,'changeTypeUpdate'])->name('admin.nav.changeTypeUpdate');

Route::post('admin/nav/search-by-title-create',[MenuController::class,'postSearchByTitleCreate']);

Route::post('admin/nav/{id}/search-by-title-update',[MenuController::class,'postSearchByTitleUpdate'])->name('admin.nav.postSearchByTitleUpdate');

Route::get('admin/nav/single-delete/{id}', [MenuController::class,'destroy']);
Route::post('admin/nav/bulk-delete', [MenuController::class,'bulkDelete'])->name('admin.nav.bulkDelete');

Route::resource('admin/nav', MenuController::class,['except'=> ['show','destroy']]);


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',
])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

});
