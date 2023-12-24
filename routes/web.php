<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\ResetPassword;
use App\Http\Controllers\FactorController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('loginUser');
});

Route::view('/login', 'authorize.login')->name('loginUser');
Route::post('/login',[LoginController::class,'loginUser'])->name('loginUser');

Route::get('/logout' , [LogoutController::class,'logout'])->name('logoutUser');

Route::view('/register', 'authorize.register')->name('createUser');
Route::post('/register',[RegisterController::class,'createUser'])->name('createUser');

Route::get('/reset',[ResetPassword::class,'reset'])->name('resetPassword');

Route::middleware('auth:sanctum')->group(function (){
Route::get('/workplace', function () {
    $count_user = \App\Models\User::count();
    $product_count = \App\Models\Product::count();
    $order_count = \App\Models\Order::count();
    $factor_count = \App\Models\Factor::count();
    return view('workplace', compact('count_user','product_count'
    ,'order_count','factor_count'));
})->name('workplace');
});

//users
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::post('/users/{id}/delete', [UserController::class, 'destroy'])->name('users.destroy');
});

//products
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::patch('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::post('/products/{id}/delete', [ProductController::class, 'destroy'])->name('products.destroy');
});
//orderController
Route::middleware('auth:sanctum')->group(function () {
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');
Route::any('/orders/{id}', [OrderController::class, 'update'])->name('orders.update');
Route::post('/orders/{id}/delete', [OrderController::class, 'destroy'])->name('orders.destroy');
});
//factorController
    Route::middleware('auth:sanctum')->group(function () {
    Route::get('/factors', [FactorController::class, 'index'])->name('factors.index');
    Route::get('/factors/create', [FactorController::class, 'create'])->name('factors.create');
    Route::post('/factors', [FactorController::class, 'store'])->name('factors.store');
    Route::get('/factors/{id}/edit', [FactorController::class, 'edit'])->name('factors.edit');
    Route::any('/factors/{id}', [FactorController::class, 'update'])->name('factors.update');
    Route::post('/factors/{id}/delete', [FactorController::class, 'destroy'])->name('factors.destroy');
    Route::post('/factors/update_status/{id}', [FactorController::class,'update_status'])->name('factors.update_status');
    });
