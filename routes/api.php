<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\DeliveryDetailsApiController;


// Public Routes
Route::post('/register', [AuthController::class, 'register'])->name('api.register');
Route::post('/login', [AuthController::class, 'login'])->name('api.login');

// Protected Routes (Require Authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');
    Route::get('/user', [AuthController::class, 'profile'])->name('api.profile');
});


// Get all products
Route::get('/products', [ProductApiController::class, 'index']);

// Get products by category (Men or Women)
Route::get('/products/category/{category}', [ProductApiController::class, 'getByCategory']);

// Get a specific product by ID
Route::get('/products/{id}', [ProductApiController::class, 'show']);


Route::get('/delivery', [DeliveryDetailsApiController::class, 'index']); // Get user delivery details
Route::post('/delivery/store', [DeliveryDetailsApiController::class, 'store']); // Store delivery details





// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Api\AuthController;



// API Public Routes
// Route::post('/register', [AuthController::class, 'register'])->name('api.register');
// Route::post('/login', [AuthController::class, 'login'])->name('api.login');

// Route::middleware('auth:sanctum')->group(function () {
//     // API Authenticated Routes
//     Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');
// });

// Example route to fetch authenticated user
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
