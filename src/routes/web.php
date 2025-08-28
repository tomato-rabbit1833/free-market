<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;

Route::get('/', [ItemController::class, 'index'])->name('items.index');
Route::get('/item/{id}', [ItemController::class, 'show'])->name('items.show');
Route::get('/purchase/{id}', [PurchaseController::class, 'show'])->name('purchase.show');
Route::post('/purchase/{id}', [PurchaseController::class, 'store'])->name('purchase.store');
Route::get('/purchase/complete', [PurchaseController::class, 'complete'])->name('purchase.complete');
Route::get('/items', [ItemController::class, 'index'])->name('items.index');

Route::middleware(['auth'])->group(function () {
    // プロフィール表示と編集
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // マイリスト
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/{id}', [WishlistController::class, 'store'])->name('wishlist.store');
Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');


    // ★マイリスト追加・削除
    Route::post('/wishlist/{id}', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');

    // 商品出品
    Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
    Route::post('/items', [ItemController::class, 'store'])->name('items.store');

    // 購入完了ページ（念のため1つに統一）
    Route::get('/purchase/complete', [PurchaseController::class, 'complete'])->name('purchase.complete');

    Route::post('/like/{id}', [LikeController::class, 'store'])->name('like.store');
Route::delete('/like/{id}', [LikeController::class, 'destroy'])->name('like.destroy');

Route::post('/item/{id}/comment', [CommentController::class, 'store'])->middleware('auth')->name('comment.store');
});
