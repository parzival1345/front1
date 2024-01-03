<?php

use App\Http\Controllers\Admin\AdminUserController;
use Illuminate\Support\Facades\Route;
Route::middleware(['auth' , 'Admin_role'])->prefix('admin')->group(function () {
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin_users.index');
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('admin_users.create');
    Route::post('/users', [AdminUserController::class, 'store'])->name('admin_users.store');
    Route::put('/users/{id}/edit', [AdminUserController::class, 'edit'])->name('admin_users.edit');
    Route::patch('/users/{id}', [AdminUserController::class, 'update'])->name('admin_users.update');
    Route::any('/users/{id}/delete', [AdminUserController::class, 'destroy'])->name('admin_users.destroy');
});
