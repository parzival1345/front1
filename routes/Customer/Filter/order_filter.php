<?php

use App\Http\Controllers\Buyer\CustomerFactorController;
use App\Http\Controllers\Buyer\CustomerOrderController;
use Illuminate\Support\Facades\Route;
 Route::middleware(['auth' , 'Customer_role'])->prefix('customer')->group(function () {

     Route::get('/orders/filter' ,[CustomerOrderController::class , 'filter'])->name('customer_orders.filter');

 });
