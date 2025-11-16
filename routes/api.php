<?php

use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/services', [ServiceController::class, 'index']);

Route::post('/bookings', [BookingController::class, 'store']);

