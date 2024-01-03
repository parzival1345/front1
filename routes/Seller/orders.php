<?php

use App\Http\Controllers\Seller\SellerProductController;
use Illuminate\Support\Facades\Route;
Route::middleware(['auth' , 'Seller_role'])->prefix('seller')->group(function () {

    Route::get('/products', [SellerProductController::class, 'index'])->name('seller_products.index');
    Route::get('/products/create', [SellerProductController::class, 'create'])->name('seller_products.create');
    Route::post('/products', [SellerProductController::class, 'store'])->name('seller_products.store');
    Route::get('/products/{id}/edit', [SellerProductController::class, 'edit'])->name('seller_products.edit');
    Route::any('/products/{id}', [SellerProductController::class, 'update'])->name('seller_products.update');
    Route::any('/products/{id}/delete', [SellerProductController::class, 'destroy'])->name('seller_products.destroy');

});
?>
