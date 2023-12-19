<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/test', function() {
  return response()->json(['test' => 'test']);
});

Route::controller(\App\Http\Controllers\AuthController::class)->group(function () {
  Route::post('/login', 'Login');
  Route::post('/register', 'Register');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
});
