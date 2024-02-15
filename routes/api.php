<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\NewsletterController;

Route::prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/', [UserController::class, 'store']);
});

Route::prefix('newsletter')->group(function () {
    Route::get('/', [NewsletterController::class, 'index']);
    Route::post('/', [NewsletterController::class, 'store']);
});
