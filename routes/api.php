<?php

use App\Http\Controllers\Api\Auth\AuthSessionController;
use App\Http\Controllers\Api\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware('guest')->group(function () {

    Route::post('register', [RegisterController::class, 'store']);

    Route::post('login', [AuthSessionController::class, 'store']);
});

Route::middleware('auth:sanctum')->group(function () {

    Route::post('logout', [AuthSessionController::class, 'destroy'])
        ->name('logout');
});
