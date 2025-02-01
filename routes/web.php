<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomizationController;
use App\Http\Controllers\LoginController;


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


// ✅ Correct Route for Dashboard
Route::get('/admin/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth']) // Ensure only authenticated users can access
    ->name('admin.dashboard');

    Route::delete('/admin/customizations/{id}', [CustomizationController::class, 'destroy'])
    ->middleware(['auth', 'admin'])
    ->name('admin.customizations.destroy');

    Route::delete('/admin/users/{id}', [DashboardController::class, 'destroy'])
    ->middleware(['auth', 'admin'])
    ->name('admin.users.destroy');

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
    
Route::get('/products', [ProductController::class, 'view'])->name('products');

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

// Authentication Routes
require __DIR__.'/auth.php';
