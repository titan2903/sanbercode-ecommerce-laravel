<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderDetailController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/home', [AdminController::class, 'dashboard'])->name('admin.home');
        Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

        // Admin routes
        Route::get('/data', [AdminController::class, 'index']);
        Route::get('/create', [AdminController::class, 'create'])->name('admins.create');
        Route::post('/create', [AdminController::class, 'store']);

        // Product routes
        Route::get('/product', [ProductController::class, 'index']);
        Route::get('/product/{productId}', [ProductController::class, 'show'])->name('products.show');
        Route::get('/product-create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/product-create', [ProductController::class, 'store']);
        Route::delete('/product/{productId}', [ProductController::class, 'destroy'])->name('products.destroy');
        Route::get('/product/{productId}/edit', [ProductController::class, 'edit']);
        Route::put('/product/{productId}', [ProductController::class, 'update'])->name('products.update');

        // Product category routes
        Route::get('/product-category', [ProductCategoryController::class, 'index']);
        Route::get('/product-category-create', [ProductCategoryController::class, 'create'])->name('product_categories.create');
        Route::post('/product-category-create', [ProductCategoryController::class, 'store']);
        Route::delete('/product-category/{productCategoryId}', [ProductCategoryController::class, 'destroy'])->name('product_categories.destroy');
        Route::get('/product-category/{productCategoryId}', [ProductCategoryController::class, 'edit']);
        Route::put('/product-category/{productCategoryId}', [ProductCategoryController::class, 'update'])->name('product_categories.update');
    });
});


Route::get('/products', [ProductController::class, 'productCommerce'])->name('product.search');
Route::get('/', [HomeController::class, 'index']);

Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index']);
    Route::get('/product', [ProductController::class, 'index']);
    Route::post('/carts/add/{product_id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/carts/{product_id}', [CartController::class, 'destroy']);
    Route::get('/profile', [UserController::class, 'show']);
    Route::get('/profile/{user_id}', [UserController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{user_id}', [UserController::class, 'update'])->name('profile.update');
    Route::get('/carts', [CartController::class, 'index']);
    Route::get('/orders', [OrderController::class, 'index']);
    Route::post('/orders/{cart_id}', [OrderController::class, 'store']);
    Route::get('/order/detail/{order_id}/create', [OrderDetailController::class, 'create']);
    Route::post('/order/detail/{order_id}', [OrderDetailController::class, 'store'])->name('orderdetail.store');
    Route::get('/order/detail/{order_id}', [OrderDetailController::class, 'show'])->name('orderdetail.show');
});

Auth::routes();
