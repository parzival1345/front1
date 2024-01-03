<?php

use App\Http\Controllers\Admin\AdminProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth' , 'Admin_role'])->prefix('admin')->group(function () {

    Route::get('/products/filter', [AdminProductController::class, 'filter'])->name('admin_products.filter');

});
