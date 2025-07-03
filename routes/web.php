<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdvertiseController;
use App\Http\Controllers\Admin\MenuController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



//advertise
Route::resource('admin/advertise',AdvertiseController::class);
Route::get('admin/advertise/single-delete/{id}', [AdvertiseController::class, 'destroy']);
Route::post('admin/advertise/update-publish/{publish}', [AdvertiseController::class,'postUpdatePublish']);
Route::post('admin/advertise/bulk_delete', [AdvertiseController::class,'bulkDelete']);

//Navbar
Route::get('admin/nav/sub/{id}', [MenuController::class,'category'])->name('admin.nav.sub');

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

    Route::get('admin/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('admin/admin', \App\Http\Controllers\Admin\AdminController::class);
    Route::get('admin/profile/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'getProfile']);
    Route::post('admin/admin/update-publish/{publish}', [\App\Http\Controllers\Admin\AdminController::class, 'postUpdatePublish']);
    Route::get('admin/admin/single-delete/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'destroy']);
    Route::post('admin/change-password', [\App\Http\Controllers\Admin\AdminController::class, 'changePassword'])->name('admin.change-password');

    // routes/web.php or routes/admin.php
    Route::resource('admin/category', \App\Http\Controllers\Admin\CategoryController::class);
    Route::get('admin/category/child/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'child']);
    Route::get('admin/category/single-delete/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'destroy']);
    Route::post('admin/category/update-publish/{publish}', [\App\Http\Controllers\Admin\CategoryController::class, 'postUpdatePublish']);
    Route::post('admin/category/bulk_delete', [\App\Http\Controllers\Admin\CategoryController::class, 'bulkDelete']);

    Route::resource('admin/news', \App\Http\Controllers\Admin\NewsController::class);
    Route::get('admin/news/single-delete/{id}', [\App\Http\Controllers\Admin\NewsController::class, 'destroy']);
    Route::post('admin/news/update-publish/{publish}', [\App\Http\Controllers\Admin\NewsController::class, 'postUpdatePublish']);
    Route::post('admin/news/bulk_delete', [\App\Http\Controllers\Admin\NewsController::class, 'bulkDelete']);

    Route::resource('admin/page', \App\Http\Controllers\Admin\PageController::class);
    Route::get('admin/page/single-delete/{id}', [\App\Http\Controllers\Admin\PageController::class, 'destroy']);
    Route::post('admin/page/update-publish/{publish}', [\App\Http\Controllers\Admin\PageController::class, 'postUpdatePublish']);
    Route::post('admin/page/bulk_delete', [\App\Http\Controllers\Admin\PageController::class, 'bulkDelete']);

    Route::resource('admin/social', \App\Http\Controllers\Admin\SocialController::class);
    Route::get('admin/social/single-delete/{id}', [\App\Http\Controllers\Admin\SocialController::class, 'destroy']);
    Route::post('admin/social/update-publish/{publish}', [\App\Http\Controllers\Admin\SocialController::class, 'postUpdatePublish']);
    Route::post('admin/social/bulk_delete', [\App\Http\Controllers\Admin\SocialController::class, 'bulkDelete']);

    Route::resource('admin/setting', \App\Http\Controllers\Admin\SettingController::class)
    ->except(['create', 'show', 'edit', 'destroy']);

    Route::get('admin/setting/{id}', [\App\Http\Controllers\Admin\SettingController::class, 'update']);


    //Routes for Role & Permissions
    Route::resource('admin/roles', \App\Http\Controllers\Role\RoleController::class);
    Route::get('admin/roles/delete/{id}', [\App\Http\Controllers\Role\RoleController::class, 'destroy']);
    Route::resource('admin/permission', \App\Http\Controllers\Role\PermissionController::class);
    Route::get('admin/permission/delete/{id}', [\App\Http\Controllers\Role\PermissionController::class, 'destroy']);



});
