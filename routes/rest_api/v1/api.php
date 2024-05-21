<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('/tenant/auth')->group(function () {

});


Route::get('/users', [UserController::class, 'index']);
Route::get('/', [UserController::class, 'index']);
Route::get('/users/phone/{phone}', [UserController::class, 'getUserByPhone']);
Route::get('/users/search/{search}', [UserController::class, 'searchUserByPhoneOrAddress']);
