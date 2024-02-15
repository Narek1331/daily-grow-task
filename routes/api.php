<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\NewsletterController;
use App\Http\Controllers\API\AuthController;

Route::prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/', [UserController::class, 'store']);
});

Route::prefix('newsletter')->group(function () {
    Route::get('/', [NewsletterController::class, 'index']);
    Route::post('/', [NewsletterController::class, 'store']);
});

Route::group([
    'middleware' => 'auth:api',
], function ($router) {

    Route::group([
        'prefix' => 'auth'
    ], function ($router) {
    
        Route::post('login', [AuthController::class, 'login'])->withoutMiddleware(['auth:api']);
        Route::post('signup', [AuthController::class, 'signup'])->withoutMiddleware(['auth:api']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('me', [AuthController::class, 'me']);
    
    });

});
