<?php

use App\Http\Controllers\Api\RegisterController;
use Illuminate\Support\Facades\Route;
Route::middleware(['auth' , 'Admin_role'])->prefix('admin')->group(function () {

    Route::post('/users/accept/{id}', [RegisterController::class, 'accept'])->name('users.accept');
    Route::post('/users/reject/{id}', [RegisterController::class, 'reject'])->name('users.reject');

});
?>
