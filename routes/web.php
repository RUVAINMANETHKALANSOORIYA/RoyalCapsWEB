<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomizationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserDashboardController;   
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\DeliveryDetailsController;
use App\Http\Controllers\AdminDashboardController;


Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Route::get('/products', function () {
//     return view('pages.products');
// })->name('products');

//products routes
// Route::prefix('products')->group(function () {
//     Route::get('/', [ProductController::class, 'index']); // List products
//     Route::post('/', [ProductController::class, 'store']); // Create a product
//     Route::get('/{id}', [ProductController::class, 'show']); // Get a single product
//     Route::put('/{id}', [ProductController::class, 'update']); // Update a product
//     Route::delete('/{id}', [ProductController::class, 'destroy']); // Delete a product
// });

// Route for the customization page
Route::view('/customization', 'customization')->name('customization');

Route::view('/about-us', 'about-us')->name('about-us');


Route::get('/profile', [ProfileController::class, 'show'])->name('profile');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/admin/dashboard', [LoginController::class, 'index']);

Route::delete('/admin/users/{id}', [DashboardController::class, 'destroy'])
    ->name('admin.users.destroy');


// ✅ Correct Route for Dashboard
Route::get('/admin/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth']) // Ensure only authenticated users can access
    ->name('admin.dashboard');

    Route::delete('/admin/customizations/{id}', [CustomizationController::class, 'destroy'])
    ->middleware(['auth', 'admin'])
    ->name('admin.customizations.destroy');

    // Route::delete('/admin/users/{id}', [DashboardController::class, 'destroy'])
    // ->middleware(['auth', 'admin'])
    // ->name('admin.users.destroy');

// Route::get('/profile', [ProfileController::class, 'edit'])->name('web.profile'); // Named 'web.profile'
// Route::patch('/profile', [ProfileController::class, 'update'])->name('web.profile.update');
// Route::delete('/profile', [ProfileController::class, 'destroy'])->name('web.profile.destroy');


Route::get('/customization/form', function () {
    return view('pages.CustomizationForm');
})->name('customization.form');

Route::get('/customization', function () {
    return view('pages.customization');
})->name('customization');

// Route::post('/admin/products', [ProductController::class, 'store'])
//     ->middleware(['auth', 'admin']) // ✅ Correct way to apply middleware
//     ->name('admin.products.store');

// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
//     Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
// });

Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    

// Route::get('/products', [ProductController::class, 'view'])->name('products');


Route::post('/customization/submit', function (\Illuminate\Http\Request $request) {
    // Handle the form data here (e.g., save to database or process further).
    return back()->with('success', 'Your customization request has been submitted!');
})->name('customization.submit');

Route::post('/customization', [CustomizationController::class, 'store'])->name('customization.submit');

//About us route
Route::get('/about-us', function () {
    return view('pages.AboutUs');
})->name('about-us');

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::Get('/dashboard', function(){
    return view('dashboard');
})->middleware(['auth','verified'])->name('dashboard');


Route::post('/admin/customizations/{id}/accept', [CustomizationController::class, 'accept'])->name('admin.customizations.accept');
Route::post('/admin/customizations/{id}/reject', [CustomizationController::class, 'reject'])->name('admin.customizations.reject');

Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');

// Route to display all products
Route::get('/products', [ProductController::class, 'view'])->name('products');

// Route to store a new product
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');

// Route to show a single product detail page
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');


Route::post('/checkout', [OrderController::class, 'store'])->name('orders.store');


Route::get('/checkout', function () {
    return view('pages.checkout');
})->name('checkout');

Route::patch('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');

Route::get('/cart', [CartController::class, 'view'])->name('cart.view');

// Add to Cart Route
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
// Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');

// View Cart (Checkout Page)
Route::get('/checkout', [CartController::class, 'showCart'])->name('cart.view');

Route::post('/checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

//Cart routes
Route::get('/cart', [CartController::class, 'view'])->name('cart.view');
Route::get('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');

//Delivery details routes
Route::post('/delivery-details/store', [DeliveryDetailsController::class, 'store'])->name('delivery_details.store');
Route::get('/admin/delivery-details', [DeliveryDetailsController::class, 'index'])->middleware('auth')->name('admin.delivery_details');
Route::patch('/delivery-details/update/{id}', [DeliveryDetailsController::class, 'updateStatus'])->middleware('auth')->name('delivery_details.update');

// Route::get('admin.dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
Route::patch('/admin/delivery/update/{id}', [DeliveryDetailsController::class, 'update'])->name('admin.delivery.update');

Route::post('/delivery-details/store', [DeliveryDetailsController::class, 'store'])->name('delivery_details.store');

Route::get('/admin/delivery-details', [DeliveryDetailsController::class, 'index'])->middleware('auth')->name('admin.delivery_details');

Route::post('/admin/products/store', [ProductController::class, 'store'])->name('products.store');
Route::post('/admin/products/store', [ProductController::class, 'store'])->name('products.store');

//checkout routes
Route::get('/payment', [CheckoutController::class, 'index'])->name('checkout');
Route::get('/payment', function() {
    return view('pages.payment');
})->name('payment');

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    ->name('admin.dashboard');

//cash on delivery routes
Route::get('/cash-on-delivery', function() {
    return view('pages.cash_on_delivery');
})->name('cash_on_delivery');

// Route::get('/checkout', [StripeController::class, 'checkout'])->name('checkout');
// Route::get('/session', [StripeController::class, 'session'])->name('session');

Route::get('/cart', [CartController::class, 'view'])->name('cart.view');
// Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');

// //chekout process
// Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
// Route::get('/order-confirmation', function () {
//     return view('pages.orderconfirm');
// })->name('order.confirmation');

// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::get('/dashboard', [UserDashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// Route::get('/', [StripeController::class, 'index'])->name('index');
Route::get('/payment-blade', [StripeController::class, 'index'])->name('index');
Route::post('/checkout', [StripeController::class, 'checkout'])->name('payment.details');
Route::get('/success', [StripeController::class, 'success'])->name('success');


Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    ->name('admin.dashboard');

    // ✅ Product Routes for Edit & Delete
Route::patch('/admin/products/{id}', [ProductController::class, 'update'])->name('admin.products.update');
Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');




// Update Product
Route::put('/admin/products/{id}', [ProductController::class, 'update'])
    ->name('admin.products.update');

// Delete Product
Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])
    ->name('admin.products.destroy');

Route::get('/order-confirm', function () {
    return view('pages.orderconfirm');
})->name('order.confirm');

Route::get('/dashboard', [UserDashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');


    
  
// Authentication Routes
require __DIR__.'/auth.php';
