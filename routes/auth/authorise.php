<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\ResetPassword;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('loginUser');
});


Route::view('/login', 'authorize.login')->name('loginUser');
Route::post('/login', [LoginController::class, 'loginUser']);
Route::get('/logout', [LogoutController::class, 'logout'])->name('logoutUser');
Route::view('/register', 'authorize.register')->name('createUser');
Route::post('/register', [RegisterController::class, 'createUser'])->name('createUser');
Route::get('/reset', [ResetPassword::class, 'reset'])->name('resetPassword');
