<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\ProductGridController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;
require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';

// Trang chính
Route::get('/', function () {
    return view('welcome');
});

// Định nghĩa route cho xác thực
Auth::routes();

// Route cho trang home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// Product route for showing product details
Route::get('products/{id}', [ProductDetailController::class, 'show'])->name('product.show');
Route::post('products/{product}/review', [ReviewController::class, 'submitReview'])
    ->name('review.store')
    ->middleware('auth'); // Chỉ cho phép người dùng đã đăng nhập gửi đánh giá


// Route cho grid sản phẩm
Route::get('/products', [ProductGridController::class, 'index'])->name('products.grid');

//Route cho cart
Route::post('cart/add/{id}', [CartController::class, 'add'])->name('cart.add')->middleware('auth');
Route::get('/cart/view', [CartController::class, 'view']);
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');


//route cho wishlist
Route::post('wishlist/add/{id}', [WishlistController::class, 'add'])->name('wishlist.add');

//route cho blog
Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');


// Route user:
Route::prefix('users')->name('users.')->group(function () {
    // Hiển thị danh sách người dùng (Nếu cần)
    Route::get('/', [UserController::class, 'index'])->name('index');

    // Hiển thị thông tin người dùng
    Route::get('{id}', [UserController::class, 'show'])->name('show');
});
Route::get('/orders/{id}', [OrderController::class, 'showOrderDetails'])->name('orders.show');
Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');




// Route cập nhật địa chỉ người dùng
Route::put('/account/update-address', [UserController::class, 'updateAddress'])->name('update.address');
Route::put('/account/update-profile', [UserController::class, 'updateProfile'])->name('update.profile');

Route::prefix('users')->name('users.')->group(function () {
    // Hiển thị danh sách người dùng (Nếu cần)
    Route::get('/', [UserController::class, 'index'])->name('index');

    // Hiển thị thông tin người dùng
    Route::get('{id}', [UserController::class, 'show'])->name('show');

    // Cập nhật địa chỉ người dùng
    Route::put('update-address', [UserController::class, 'updateAddress'])->name('update.address');

    // Cập nhật thông tin cá nhân người dùng
    Route::put('update-profile', [UserController::class, 'updateProfile'])->name('update.profile');
});



// route checkout:
// Route hiển thị giỏ hàng
Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout');

// Route xử lý thanh toán và tạo đơn hàng
Route::post('checkout', [CheckoutController::class, 'create'])->name('checkout.create');

// Route hiển thị trang thành công sau khi thanh toán
Route::get('checkout/success/{order}', function ($order) {
    return view('checkout-success', compact('order'));
})->name('checkout.success');

// Route Category
Route::get('/shop', [CategoryController::class, 'index'])->name('shop.index');
