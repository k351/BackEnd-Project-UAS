<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home')->middleware(['check', 'prevent']);
Route::get('/status', [HomeController::class, 'status'])->name('status')->middleware('auth');
Route::get('/untimeout', [HomeController::class, 'untimeout'])->name('untimeout')->middleware('auth');
Route::get('/rekomendasi', [RekomendasiController::class, "index"])->name('recommendation.index');

Route::middleware(['auth', 'check'])->group(function () {
    Route::get('product_details/{id}/confirm', [TransactionController::class, 'index'])->name('transaction.index');
    Route::post('product_details/{id}/confirm', [TransactionController::class, 'confirm'])->name('transaction.confirm');
    Route::get('product_details/checkout', [TransactionController::class, 'checkout'])->name('transaction.checkout');
    Route::post('/checkout', [TransactionController::class, 'create'])->name('transaction.create');

    Route::get('cart', [CartController::class, 'index'])->name('cart.index');
    Route::put('cart', [CartController::class, 'update'])->name('cart.update');
    Route::get('delete_cart_item/{id}', [CartController::class, 'delete'])->name('cart.delete_cart_item');
    Route::post('cart', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/uncheck-all-items', [CartController::class, 'uncheckAllItems'])->name('cart.uncheck_all_items');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'admin', 'prevent'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('view_category', [AdminController::class, 'view_category']);
    Route::post('add_category', [AdminController::class, 'add_category']);
    Route::get('delete_category/{id}', [AdminController::class, 'delete_category']);
    Route::get('edit_category/{id}', [AdminController::class, 'edit_category']);
    Route::post('update_category/{id}', [AdminController::class, 'update_category']);

    Route::get('/admin/search', [AdminController::class, 'searchUsers'])->name('admin.search');
    Route::get('/admin/take_action/{id}', [AdminController::class, 'take_action'])->name('admin.take.action');
    Route::get('/admin/remove_action/{id}', [AdminController::class, 'remove_action'])->name('admin.remove.action');
    Route::post('/admin/timeout_ban/{id}', [AdminController::class, 'timeout_ban'])->name('admin.timeout.ban');
    Route::post('/admin/untimeout_unban/{id}', [AdminController::class, 'untimeout_unban'])->name('admin.untimeout.unban');
});

Route::middleware(['auth', 'prevent', 'check'])->group(function () {
    Route::get('/register-seller', [SellerController::class, 'create'])->name('create.seller');
    Route::post('/register-seller', [SellerController::class, 'registerSeller'])->name('register.seller');
});

Route::middleware(['auth', 'seller', 'prevent', 'check'])->group(function () {
    Route::get('seller/dashboard/', [SellerController::class, 'view_dashboard'])->name('create.seller_dashboard');
    Route::get('seller/view_product', [SellerController::class, 'view_product'])->name('view.product');
    Route::get('/seller/search', [SellerController::class, 'search'])->name('seller.search');
    Route::get('/seller/rating_search', [SellerController::class, 'rating_search'])->name('seller.rating.search');
    Route::post('add_product', [SellerController::class, 'upload_product'])->name('add_product');
    Route::post('upload_product', [SellerController::class, 'upload_product'])->name('upload_product');
    Route::get('get_review', [SellerController::class, 'get_Review'])->name('get.review');
    Route::middleware(['report'])->group(function () {
        Route::get('report_user/{id}/{rating_id}', [SellerController::class, 'report_user'])->name('report.user');
        Route::post('give_report/{id}/{rating_id}', [SellerController::class, 'give_report'])->name('give.report');
    });
    Route::middleware(['product'])->group(function () {
        Route::get('delete_product/{id}', [SellerController::class, 'delete_product'])->name('delete_product');
        Route::get('edit_product/{id}', [SellerController::class, 'edit_product'])->name('edit_product');
        Route::post('update_product/{id}', [SellerController::class, 'update_product'])->name('update_product');
    });
});

Route::get('/get-csrf-token', function () {
    return response()->json(['token' => csrf_token()]);
});

// Wishlist routes
Route::middleware(['auth', 'verified', 'check', 'prevent'])->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'show_wishlist'])->name('wishlist');
    Route::get('/wishlist/update/{product_id}', [WishlistController::class, 'update_wishlist'])->name('wishlist.update');
    Route::get('/wishlist/delete/{id}', [WishlistController::class, 'delete_wishlist'])->name('wishlist.delete');
    Route::post('/wishlist/move-to-cart', [WishlistController::class, 'WishlistToCart'])->name('wishlist.move_to_cart');
});

// Product detail, shop page, and product search routes
Route::get('product_details/{id}', [HomeController::class, 'product_details']);
Route::get('shop_page', [HomeController::class, 'shop_page']);
Route::get('product_search', [HomeController::class, 'product_search']);
Route::middleware(['auth', 'verified', 'check', 'prevent', 'topup'])->group(function(){
    Route::get('wallet_topup/{id}', [HomeController::class, 'wallet_topup']);
    Route::post('topping_up/{id}', [HomeController::class, 'topping_up']);
});

// Rating routes
Route::middleware(['auth', 'rating', 'check'])->group(function () {
    Route::get('/rate/{transaction_id}/{product_id}', [RatingController::class, 'rate'])->name('rating.form');
    Route::post('/rate/{transaction_id}/{product_id}', [RatingController::class, 'postRate'])->name('rating.store');
});
//History route
Route::get('/transaction/history', [TransactionController::class, 'history'])->middleware(['auth','check'])->name('transaction.history');
