<?php

use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VariantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;

Route::prefix('admin')->middleware(['auth', 'is_admin', 'verified'])->group(function () {
    // Dashboard Route
    Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.index');

    // Category Routes
    Route::resource('/categories', CategoryController::class);

    // Product Routes
    Route::resource('/products', ProductController::class)->names([
        'index' => 'admin.products.index',
        'create' => 'admin.products.create',
        'store' => 'admin.products.store',
        'show' => 'admin.products.show',
        'edit' => 'admin.products.edit',
        'update' => 'admin.products.update',
        'destroy' => 'admin.products.destroy',
    ]);

    // Variant Routes
    Route::resource('/variants', VariantController::class)->names([
        'edit' => 'admin.variants.edit',
        'update' => 'admin.variants.update',
        'destroy' => 'admin.variants.destroy',
    ]);

    // User Routes
    Route::resource('/users', UserController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'show' => 'admin.users.show',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);

    // Order Routes
    Route::resource('/orders', OrderController::class)->names([
        'index' => 'admin.orders.index',
        'create' => 'admin.orders.create',
        'store' => 'admin.orders.store',
        'show' => 'admin.orders.show',
        'edit' => 'admin.orders.edit',
        'update' => 'admin.orders.update',
        'destroy' => 'admin.orders.destroy',
    ]);

    // Banner Routes
    Route::get('banners', [BannerController::class, 'index'])->name('admin.banner.index');  // List all banners
    Route::get('banners/{id}/edit', [BannerController::class, 'edit'])->name('admin.banner.edit'); // Edit a banner
    Route::put('banners/{id}', [BannerController::class, 'update'])->name('admin.banner.update'); // Update banner
});
