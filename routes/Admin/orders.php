<?php

use App\Http\Controllers\Admin\AdminOrderController;
use Illuminate\Support\Facades\Route;
Route::middleware(['auth' , 'Admin_role'])->prefix('admin')->group(function () {

    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin_orders.index');
    Route::get('/orders/create', [AdminOrderController::class, 'create'])->name('admin_orders.create');
    Route::post('/orders', [AdminOrderController::class, 'store'])->name('admin_orders.store');
    Route::get('/orders/{id}/edit', [AdminOrderController::class, 'edit'])->name('admin_orders.edit');
    Route::get('/orders/{id}', [AdminOrderController::class, 'update'])->name('admin_orders.update');
    Route::get('/orders/{id}/delete', [AdminOrderController::class, 'destroy'])->name('admin_orders.destroy');

});
?>
