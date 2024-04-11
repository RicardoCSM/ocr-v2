<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Controllers\LoginController;
use Modules\Auth\Controllers\LogoutController;
use Modules\Auth\Controllers\RegisterController;
use Modules\Auth\Controllers\UserController;

Route::post('auth/login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('register', [RegisterController::class, 'register'])->middleware('role:admin');
        Route::post('logout', [LogoutController::class, 'logout']);
    });

    Route::prefix('users')->middleware('role:admin')->group(function () {
        Route::get('/', [UserController::class, 'index'])->middleware('role:admin');

        Route::prefix('{id}')->group(function () {
            Route::get('/', [UserController::class, 'show']);
            Route::put('/', [UserController::class, 'update']);
            Route::delete('/', [UserController::class, 'destroy']);
        });
    });
});
