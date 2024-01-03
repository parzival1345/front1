<?php

use App\Http\Controllers\Buyer\CustomerOrderController;
use Illuminate\Support\Facades\Route;
Route::middleware(['auth','Customer_role'])->prefix('customer')->group(function () {

    Route::get('/orders', [CustomerOrderController::class, 'index'])->name('customer_orders.index');
    Route::get('/orders/create', [CustomerOrderController::class, 'create'])->name('customer_orders.create');
    Route::post('/orders', [CustomerOrderController::class, 'store'])->name('customer_orders.store');
    Route::get('/orders/{id}/edit', [CustomerOrderController::class, 'edit'])->name('customer_orders.edit');
    Route::get('/orders/{id}', [CustomerOrderController::class, 'update'])->name('customer_orders.update');
    Route::get('/orders/{id}/delete', [CustomerOrderController::class, 'destroy'])->name('customer_orders.destroy');

});
?>
