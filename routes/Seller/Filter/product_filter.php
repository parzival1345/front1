<?php

use App\Http\Controllers\Seller\SellerFactorController;
use Illuminate\Support\Facades\Route;
 Route::middleware(['auth' , 'Seller_role'])->prefix('seller')->group(function () {

     Route::get('/products/filter' , [SellerFactorController::class , 'filter'])->name('seller_products.filter');
 });
