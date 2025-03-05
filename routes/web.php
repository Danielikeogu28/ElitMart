<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\PaystackPaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductPageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductPageController::class, 'index'])->name('home');


Route::get('/about-page', [ProductPageController::class, 'about'])->name('about');
Route::get('/services-page', [ProductPageController::class, 'service'])->name('service');
Route::get('/shop-page', [ProductPageController::class, 'shop'])->name('shop');
Route::get('/portfolio-page', [ProductPageController::class, 'portfolio'])->name('portfolio');
Route::get('/blog-page', [ProductPageController::class, 'blog'])->name('blog');



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/product-details/{id}', [ProductPageController::class, 'show'])->name('detail');

    //cart
    Route::post('/add-to-cart/{id}', [CartController::class, 'cart'])->name('add-to-cart');
    //checkout
    Route::get('/cart-checkout', [CartController::class, 'checkout'])->name('cart-checkout');
    //delete
    Route::delete('/remove-cart/{id}', [CartController::class, 'destroy'])->name('remove-cart');
    //qty
    Route::post('/update-quantity', [CartController::class, 'updateQty'])->name('update-quantity');



    //paystack

    Route::post('/pay', [PaystackPaymentController::class, 'initializePayment'])->name('paystack.pay');
    Route::get('/payment/callback', [PaystackPaymentController::class, 'handleCallback'])->name('paystack.callback');
    Route::get('/payment/success', function () {
        return view('pages.payment_success');
    })->name('payment.success');
    Route::get('/payment/failed', function () {
        return view('pages.payment_failed');
    })->name('payment.failed');
});

require __DIR__ . '/auth.php';



//Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin-dashboard', [ProductController::class, 'index'])->name('dashboard');
    Route::resource('products', ProductController::class);
//});
