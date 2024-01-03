<?php

use App\Http\Controllers\Admin\AdminFactorController;
use Illuminate\Support\Facades\Route;
Route::middleware(['auth' , 'Admin_role'])->prefix('admin')->group(function () {

    Route::get('/factors', [AdminFactorController::class, 'index'])->name('admin_factors.index');
    Route::get('/factors/create', [AdminFactorController::class, 'create'])->name('admin_factors.create');
    Route::post('/factors', [AdminFactorController::class, 'store'])->name('admin_factors.store');
    Route::get('/factors/{id}/edit', [AdminFactorController::class, 'edit'])->name('admin_factors.edit');
    Route::get('/factors/{id}', [AdminFactorController::class, 'update'])->name('admin_factors.update');
    Route::get('/factors/{id}/delete', [AdminFactorController::class, 'destroy'])->name('admin_factors.destroy');
    Route::post('/factors/update_status/{id}', [AdminFactorController::class, 'update_status'])->name('admin_factors.update_status');

});
?>
