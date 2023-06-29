<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\JobPublicController;
use App\Http\Controllers\FAQPublicController;
use App\Http\Controllers\EventPublicController;

Route::apiResource('/test', TestController::class)->only(['index']);

Route::controller(AuthController::class)->group(function () {
  Route::post('/login', 'Login');
  Route::post('/register', 'Register');
  Route::post('/recovery', 'Recovery');
  Route::post('/recovery-confirm', 'ConfirmRecovery');
  Route::post('/change-password-recovery', 'ChangePasswordRecovery');
});

// NOTE PUBLICS API
Route::apiResource('/address', AddressPublicController::class)->only(['index']);
Route::apiResource('/post', PostPublicController::class)->only(['index', 'show']);
Route::apiResource('/job-public', JobPublicController::class)->only(['index']);
Route::apiResource('/faq-public', FAQPublicController::class)->only(['index']);
Route::apiResource('/event-public', EventPublicController::class)->only(['index']);
  Route::get('/event-public/count', [EventPublicController::class, 'getCount']);

Route::middleware('auth:sanctum')->group(function () {
});
