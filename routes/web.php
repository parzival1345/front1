<?php

use App\Http\Controllers\Admin\AdminFactorController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminUserController;
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
Route::post('/login', [LoginController::class, 'loginUser'])->name('loginUser');

Route::get('/logout', [LogoutController::class, 'logout'])->name('logoutUser');

Route::view('/register', 'authorize.register')->name('createUser');
Route::post('/register', [RegisterController::class, 'createUser'])->name('createUser');

Route::get('/reset', [ResetPassword::class, 'reset'])->name('resetPassword');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/workplace', function () {
        $count_user = \App\Models\User::count();
        $product_count = \App\Models\Product::count();
        $order_count = \App\Models\Order::count();
        $factor_count = \App\Models\Factor::count();
        return view('workplace', compact('count_user', 'product_count'
            , 'order_count', 'factor_count'));
    })->name('workplace');

//users
    Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware('role:admin');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create')->middleware('role:admin');
    Route::post('/users', [UserController::class, 'store'])->name('users.store')->middleware('role:admin');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('role:admin');
    Route::patch('/users/{id}', [UserController::class, 'update'])->name('users.update')->middleware('role:admin');
    Route::post('/users/{id}/delete', [UserController::class, 'destroy'])->name('users.destroy')->middleware('role:admin');

//products
    Route::get('/products', [ProductController::class, 'index'])->name('products.index')->middleware('role:admin,seller');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create')->middleware('role:admin,seller');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store')->middleware('role:admin,seller');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit')->middleware('role:admin,seller');
    Route::patch('/products/{id}', [ProductController::class, 'update'])->name('products.update')->middleware('role:admin,seller');
    Route::post('/products/{id}/delete', [ProductController::class, 'destroy'])->name('products.destroy')->middleware('role:admin,seller');
//orderController
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index')->middleware('role:admin,customer');
    Route::get('/orders/create_own/{id}', [OrderController::class, 'ownOrder'])->name('orders.ownOrder')->middleware('role:admin,customer');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create')->middleware('role:admin,customer');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store')->middleware('role:admin,customer');
    Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit')->middleware('role:admin,customer');
    Route::any('/orders/{id}', [OrderController::class, 'update'])->name('orders.update')->middleware('role:admin,customer');
    Route::post('/orders/{id}/delete', [OrderController::class, 'destroy'])->name('orders.destroy')->middleware('role:admin,customer');
//factorController
    Route::get('/factors', [FactorController::class, 'index'])->name('factors.index')->middleware('role:admin,customer');
    Route::get('/factors/create', [FactorController::class, 'create'])->name('factors.create')->middleware('role:admin,customer');
    Route::post('/factors', [FactorController::class, 'store'])->name('factors.store')->middleware('role:admin,customer');
    Route::get('/factors/{id}/edit', [FactorController::class, 'edit'])->name('factors.edit')->middleware('role:admin,customer');
    Route::any('/factors/{id}', [FactorController::class, 'update'])->name('factors.update')->middleware('role:admin,customer');
    Route::post('/factors/{id}/delete', [FactorController::class, 'destroy'])->name('factors.destroy')->middleware('role:admin,customer');
    Route::post('/factors/update_status/{id}', [FactorController::class, 'update_status'])->name('factors.update_status')->middleware('role:admin,customer');
//UserWait
    Route::post('/users/accept/{id}', [RegisterController::class, 'accept'])->name('users.accept');
    Route::post('/users/reject/{id}', [RegisterController::class, 'reject'])->name('users.reject');

Route::middleware(['auth' , 'role'])->prefix('admin')->group(function (){
//AdminUserRoutes
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin_users.index');
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('admin_users.create');
    Route::post('/users', [AdminUserController::class, 'store'])->name('admin_users.store');
    Route::get('/users/{id}/edit', [AdminUserController::class, 'edit'])->name('admin_users.edit');
    Route::get('/users{id}', [AdminUserController::class, 'update'])->name('admin_users.update');
    Route::get('/users/{id}/delete', [AdminUserController::class, 'destroy'])->name('admin_users.destroy');
//AdminProductRoutes
    Route::get('/products', [AdminProductController::class, 'index'])->name('admin_products.index');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('admin_products.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('admin_products.store');
    Route::get('/products/{id}/edit', [AdminProductController::class, 'edit'])->name('admin_products.edit');
    Route::get('/products/{id}', [AdminProductController::class, 'update'])->name('admin_products.update');
    Route::get('/products/{id}/delete', [AdminProductController::class, 'destroy'])->name('admin_products.destroy');
//AdminOrderRoutes
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin_orders.index');
    Route::get('/orders/create', [AdminOrderController::class, 'create'])->name('admin_orders.create');
    Route::post('/orders', [AdminOrderController::class, 'store'])->name('admin_orders.store');
    Route::get('/orders/{id}/edit', [AdminOrderController::class, 'edit'])->name('admin_orders.edit');
    Route::get('/orders/{id}', [AdminOrderController::class, 'update'])->name('admin_orders.update');
    Route::get('/orders/{id}/delete', [AdminOrderController::class, 'destroy'])->name('admin_orders.destroy');
//AdminFactorRoutes
    Route::get('/factors', [AdminFactorController::class, 'index'])->name('admin_factors.index');
    Route::get('/factors/create', [AdminFactorController::class, 'create'])->name('admin_factors.create');
    Route::post('/factors', [AdminFactorController::class, 'store'])->name('admin_factors.store');
    Route::get('/factors/{id}/edit', [AdminFactorController::class, 'edit'])->name('admin_factors.edit');
    Route::get('/factors/{id}', [AdminFactorController::class, 'update'])->name('admin_factors.update');
    Route::get('/factors/{id}/delete', [AdminFactorController::class, 'destroy'])->name('admin_factors.destroy');
    Route::post('/factors/update_status/{id}', [AdminFactorController::class, 'update_status'])->name('admin_factors.update_status');
});
});
