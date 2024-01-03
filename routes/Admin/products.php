<?php

use App\Http\Controllers\Admin\AdminProductController;
use Illuminate\Support\Facades\Route;
Route::middleware(['auth' , 'Admin_role'])->prefix('admin')->group(function () {

    Route::get('/products', [AdminProductController::class, 'index'])->name('admin_products.index');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('admin_products.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('admin_products.store');
    Route::get('/products/{id}/edit', [AdminProductController::class, 'edit'])->name('admin_products.edit');
    Route::get('/products/{id}', [AdminProductController::class, 'update'])->name('admin_products.update');
    Route::get('/products/{id}/delete', [AdminProductController::class, 'destroy'])->name('admin_products.destroy');

});
?>
