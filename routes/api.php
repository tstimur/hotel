<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Route::get('/v1/guests', [\App\Http\Controllers\Api\v1\GuestController::class, 'index']);

Route::prefix('v1')->group(function () {
    Route::apiResource('guests', \App\Http\Controllers\Api\v1\GuestController::class);
});
