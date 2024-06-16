<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WishlistController;
use App\Http\Middleware\PreventBackHistory;

Route::get('/', [HomeController::class, 'home'])->name('home');


Route::get('/dashboard', [HomeController::class, 'login_home'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/transaction', [ProfileController::class]); # this
    Route::post('/transaction', [ProfileController::class]); # this
});

require __DIR__.'/auth.php';

Route::get('admin/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'admin', PreventBackHistory::class]);
Route::get('view_category', [AdminController::class, 'view_category'])->middleware(['auth', 'admin', PreventBackHistory::class]);

Route::get('/wishlist/update/{product_id}', [WishlistController::class, 'update_wishlist'])->name('wishlist.update');
