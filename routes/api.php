<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/test', function() {
  return response()->json(['test' => 'test']);
});

Route::controller(\App\Http\Controllers\AuthController::class)->group(function () {
  Route::post('/login', 'Login');
  Route::post('/register', 'Register');
  Route::post('/forgot', 'Forgot');
  Route::post('/recovery-confirm', 'ConfirmRecovery');
  Route::post('/change-password-recovery', 'ChangePasswordRecovery');
});

// NOTE PUBLICS API
Route::group(['prefix' => 'public', 'as' => 'public.'], function() {
  Route::get('/address',     [\App\Http\Controllers\AddressPublicController::class, 'index']);
  Route::apiResource('/post', \App\Http\Controllers\PostPublicController::class)
    ->only(['index', 'show']);
  Route::apiResource('/job',  \App\Http\Controllers\JobPublicController::class)
    ->only(['index', 'show']);
  Route::apiResource('/faq',  \App\Http\Controllers\FAQPublicController::class)
    ->only(['index', 'show']);
  Route::apiResource('/event',\App\Http\Controllers\EventPublicController::class)
    ->only(['index', 'show']);
    Route::get('/event/count',[\App\Http\Controllers\EventPublicController::class, 'getCount']);
});


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);

    // NOTE PROFILE API
    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function() {
      Route::apiResource('/personal',      \App\Http\Controllers\PersonalController::class)
        ->only(['index']);

      Route::apiResource('/education',     \App\Http\Controllers\EducationController::class)
        ->only(['index']);
      Route::apiResource('/eligibility',   \App\Http\Controllers\EligibilityController::class)
        ->only(['index']);
      Route::apiResource('/experience',    \App\Http\Controllers\ExperienceController::class)
        ->only(['index']);
      Route::apiResource('/mobile-number', \App\Http\Controllers\MobileNumberController::class)
        ->only(['index']);
      Route::apiResource('/seminar',       \App\Http\Controllers\SeminarController::class)
        ->only(['index']);
      Route::apiResource('/skill',         \App\Http\Controllers\SkillController::class)
        ->only(['index']);
      Route::apiResource('/voluntary',     \App\Http\Controllers\VoluntaryController::class)
        ->only(['index']);
      Route::apiResource('/document', \App\Http\Controllers\DocumentAuthController::class)
        ->only(['index', 'destroy', 'store']);
    });

  Route::apiResource('/users', \App\Http\Controllers\UserController::class)
    ->only(['index', 'destroy']);
});
