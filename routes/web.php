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
        Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware('role:admin');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create')->middleware('role:admin');
        Route::post('/users', [UserController::class, 'store'])->name('users.store')->middleware('role:admin');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('role:admin');
        Route::patch('/users/{id}', [UserController::class, 'update'])->name('users.update')->middleware('role:admin');
        Route::post('/users/{id}/delete', [UserController::class, 'destroy'])->name('users.destroy')->middleware('role:admin');
  });

//products
Route::middleware('auth:sanctum')->group(function () {
        Route::get('/products', [ProductController::class, 'index'])->name('products.index')->middleware('role:admin,seller');
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create')->middleware('role:admin,seller');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store')->middleware('role:admin,seller');
        Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit')->middleware('role:admin,seller');
        Route::patch('/products/{id}', [ProductController::class, 'update'])->name('products.update')->middleware('role:admin,seller');
        Route::post('/products/{id}/delete', [ProductController::class, 'destroy'])->name('products.destroy')->middleware('role:admin,seller');
});
//orderController
Route::middleware('auth:sanctum')->group(function () {
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index')->middleware('role:admin,customer');
        Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create')->middleware('role:admin,customer');
        Route::post('/orders', [OrderController::class, 'store'])->name('orders.store')->middleware('role:admin,customer');
        Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit')->middleware('role:admin,customer');
        Route::any('/orders/{id}', [OrderController::class, 'update'])->name('orders.update')->middleware('role:admin,customer');
        Route::post('/orders/{id}/delete', [OrderController::class, 'destroy'])->name('orders.destroy')->middleware('role:admin,customer');
});
//factorController
    Route::middleware('auth:sanctum')->group(function () {
            Route::get('/factors', [FactorController::class, 'index'])->name('factors.index')->middleware('role:admin,customer');
            Route::get('/factors/create', [FactorController::class, 'create'])->name('factors.create')->middleware('role:admin,customer');
            Route::post('/factors', [FactorController::class, 'store'])->name('factors.store')->middleware('role:admin,customer');
            Route::get('/factors/{id}/edit', [FactorController::class, 'edit'])->name('factors.edit')->middleware('role:admin,customer');
            Route::any('/factors/{id}', [FactorController::class, 'update'])->name('factors.update')->middleware('role:admin,customer');
            Route::post('/factors/{id}/delete', [FactorController::class, 'destroy'])->name('factors.destroy')->middleware('role:admin,customer');
            Route::post('/factors/update_status/{id}', [FactorController::class,'update_status'])->name('factors.update_status')->middleware('role:admin,customer');
    });
