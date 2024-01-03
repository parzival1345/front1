<?php

use App\Http\Controllers\Admin\AdminUserController;
use Illuminate\Support\Facades\Route;
Route::middleware(['auth' , 'Admin_role'])->prefix('admin')->group(function () {

    Route::get('/users/filter', [AdminUserController::class, 'filter'])->name('admin_users.filter');

});
?>
