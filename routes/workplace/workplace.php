<?php

use Illuminate\Support\Facades\Route;
Route::prefix('/workplace')->group(function (){
    Route::get('/admin', function () {
        $role = auth()->user()->role;
        $count_user = \App\Models\User::count();
        $product_count = \App\Models\Product::count();
        $order_count = \App\Models\Order::count();
        $factor_count = \App\Models\Factor::count();
        return view('workplace', compact('count_user', 'product_count'
            , 'order_count', 'factor_count','role'));
    })->middleware(['auth' , 'Admin_role'])->name('admin.workplace');

    Route::get('/customer', function () {
        $role = auth()->user()->role;
        $count_user = \App\Models\User::count();
        $product_count = \App\Models\Product::count();
        $order_count = \App\Models\Order::count();
        $factor_count = \App\Models\Factor::count();
        return view('workplace', compact('count_user', 'product_count'
            , 'order_count', 'factor_count' , 'role'));
    })->middleware(['auth' , 'Customer_role'])->name('customer.workplace');

    Route::get('/seller', function () {
        $role = auth()->user()->role;
        $count_user = \App\Models\User::count();
        $product_count = \App\Models\Product::count();
        $order_count = \App\Models\Order::count();
        $factor_count = \App\Models\Factor::count();
        return view('workplace', compact('count_user', 'product_count'
            , 'order_count', 'factor_count' , 'role'));
    })->middleware(['auth' , 'Seller_role'])->name('seller.workplace');

});
