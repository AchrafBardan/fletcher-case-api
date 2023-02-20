<?php

use App\Http\Controllers\Hotels\HotelController;
use Illuminate\Support\Facades\Route;

Route::prefix('hotels')->group(function () {
    Route::get('/', [HotelController::class, 'index']);
    Route::get('/{id}', [HotelController::class, 'show']);
});
