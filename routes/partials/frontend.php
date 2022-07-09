<?php

use App\Http\Controllers\FrontendController;

Route::get('/',[FrontendController::class, 'index'])->name('index');

// Shop
Route::prefix('shop')->group(function () {
    Route::get('/',[FrontendController::class, 'shop'])->name('shop');
    Route::get('/{permalink}',[FrontendController::class, 'shopDetail'])->name('shop.detail');
    Route::get('category/{permalink}',[FrontendController::class, 'categoryItem'])->name('category.item');
});

// About Us
Route::get('/about-us',[FrontendController::class, 'about'])->name('about');

// About Us
Route::get('/contact-us',[FrontendController::class, 'contact'])->name('contact');

// Add to Cart
Route::get('cart', [FrontendController::class, 'cart'])->name('cart');

Route::get('add-to-cart/{id}', [FrontendController::class, 'addToCart'])->name('add.to.cart');

Route::get('buy-now/{id}', [FrontendController::class, 'buyNow'])->name('buy.now');

Route::patch('update-cart', [FrontendController::class, 'update'])->name('update.cart');

Route::delete('remove-from-cart', [FrontendController::class, 'remove'])->name('remove.from.cart');
// End Add to Cart

// Checkout
Route::get('checkout', [FrontendController::class, 'checkout'])->name('checkout');
// Customer
Route::group(['prefix' => 'dashboard', 'middleware' => ['customer','auth']], function () {
    Route::get('/my-account',[FrontendController::class, 'myAccount'])->name('my.account');
});