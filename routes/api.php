<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::name('user.')->prefix('user')->group(function () {
        Route::get('/me', [WalletController::class, 'me'])->name('me');
    });

    Route::name('transaction.')->prefix('transaction')->group(function () {
        Route::post('/', [TransactionController::class, 'depositAndWithdraw']);
        Route::post('/transfer', [TransactionController::class, 'transfer']);
        Route::get('/{transaction}', [TransactionController::class, 'show']);
    });

    Route::name('order.')->prefix('order')->group(function () {
        Route::post('/', [OrderController::class, 'create']);
        Route::get('/{order}', [TransactionController::class, 'show']);
        Route::put('/{order}', [TransactionController::class, 'show']);
    });
});
Route::post('/register', [Controller::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');





