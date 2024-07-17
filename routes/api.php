<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/register', [Controller::class, 'register']);
Route::get('/me', [WalletController::class, 'me']);
