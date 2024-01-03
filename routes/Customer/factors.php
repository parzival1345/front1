<?php

use App\Http\Controllers\Buyer\CustomerFactorController;
use Illuminate\Support\Facades\Route;
Route::middleware(['auth','Customer_role'])->prefix('customer')->group(function () {

    Route::get('/factors', [CustomerFactorController::class, 'index'])->name('customer_factors.index');
    Route::get('/factors/create/{id}', [CustomerFactorController::class, 'create'])->name('customer_factors.create');
    Route::post('/factors', [CustomerFactorController::class, 'store'])->name('customer_factors.store');
    Route::get('/factors/{id}/edit', [CustomerFactorController::class, 'edit'])->name('customer_factors.edit');
    Route::get('/factors/{id}', [CustomerFactorController::class, 'update'])->name('customer_factors.update');
    Route::get('/factors/{id}/delete', [CustomerFactorController::class, 'destroy'])->name('customer_factors.destroy');
    Route::post('/factors/update_status/{id}', [CustomerFactorController::class, 'update_status'])->name('customer_factors.update_status');

});
?>
