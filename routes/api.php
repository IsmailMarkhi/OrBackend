<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;

Route::put('/orders/{id}/status', [OrderController::class,'updateStatus']);
Route::get('/orders', [OrderController::class,'index']);
Route::post('/orders', [OrderController::class,'store']);
Route::get('/orders/{id}', [OrderController::class,'show']);
Route::delete('/orders/{id}', [OrderController::class,'destroy']);
Route::put('/orders/{id}', [OrderController::class,'update']);
Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);