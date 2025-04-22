<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::post('/orders', [TransactionController::class, 'createOrder']);
Route::post('/orders/{orderId}/payment', [TransactionController::class, 'makePayment']);

