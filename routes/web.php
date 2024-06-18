<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\TransactionController;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/rekomendasi', 'RecommendationController@index')->name('recommendations.index');

Route::get('/dashboard', [HomeController::class, 'login_home'])->middleware(['auth', /*'verified'*/])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('product_details/{id}/confirm', [TransactionController::class, 'index'])->name('transaction.index');
    Route::post('product_details/{id}/confirm', [TransactionController::class, 'confirm'])->name('transaction.confirm');
    Route::get('product_details/{id}/checkout', [TransactionController::class, 'checkout'])->name('transaction.checkout');
    Route::post('product_details/{id}/checkout', [TransactionController::class, 'create'])->name('transaction.create');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'admin', 'prevent'])->group(function()
{
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('view_category', [AdminController::class, 'view_category']);
    Route::post('add_category', [AdminController::class, 'add_category']);
    Route::get('delete_category/{id}', [AdminController::class, 'delete_category']);
    Route::get('edit_category/{id}', [AdminController::class, 'edit_category']);
    Route::post('update_category/{id}', [AdminController::class, 'update_category']);
    Route::get('/admin/search', [AdminController::class, 'searchUsers'])->name('admin.search');
    Route::get('/admin/take_action/{id}', [AdminController::class, 'take_action'])->name('admin.take.action');
    Route::post('/admin/timeout_ban/{id}', [AdminController::class, 'timeout_ban'])->name('admin.timeout.ban');
});

Route::middleware(['auth', 'prevent'])->group(function () {
    Route::get('/register-seller', [SellerController::class, 'create'])->name('create.seller');
    Route::post('/register-seller', [SellerController::class, 'registerSeller'])->name('register.seller');
});

Route::middleware(['auth', 'seller', 'prevent'])->group(function () {
    Route::get('seller/dashboard/', [SellerController::class, 'view_dashboard'])->name('create.seller_dashboard');
    Route::get('seller/view_product', [SellerController::class, 'view_product'])->name('view.product');
    Route::post('add_product', [SellerController::class, 'upload_product'])->name('add_product');
    Route::post('upload_product', [SellerController::class, 'upload_product'])->name('upload_product');
    Route::middleware(['product'])->group(function(){
        Route::get('delete_product/{id}', [SellerController::class, 'delete_product'])->name('delete_product');
        Route::get('edit_product/{id}', [SellerController::class, 'edit_product'])->name('edit_product');
        Route::post('update_product/{id}', [SellerController::class, 'update_product'])->name('update_product');
    });
});

Route::get('/get-csrf-token', function () {
    return response()->json(['token' => csrf_token()]);
});

// fungsi wishlist
Route::get('/wishlist/', [WishlistController::class, 'show_wishlist'])->middleware(['auth','verified'])->name('wishlist');
Route::get('/wishlist/update/{product_id}', [WishlistController::class, 'update_wishlist'])->middleware(['auth', 'verified'])->name('wishlist.update');
Route::get('/wishlist/delete/{id}', [WishlistController::class, 'delete_wishlist'])->name('wishlist.delete');

//product detail
Route::get('product_details/{id}', [HomeController::class, 'product_details']);
Route::get('shop_page', [HomeController::class, 'shop_page']);
Route::get('product_search', [HomeController::class, 'product_search']);

Route::middleware(['auth', 'rating'])->group(function () {
    Route::get('/rate/{transaction_id}/{product_id}', [RatingController::class, 'rate'])->name('rating.form');
    Route::post('/rate', [RatingController::class, 'postRate'])->name('rating.store');
});

