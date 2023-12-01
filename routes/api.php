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
  Route::post('/recovery', 'Recovery');
  Route::post('/change-password-recovery', 'ChangePasswordRecovery');
});

// NOTE PUBLICS API
Route::group(['prefix' => 'public', 'as' => 'public.'], function() {
  Route::get('/address',     [\App\Http\Controllers\public\AddressPublicController::class, 'index']);
  Route::apiResource('/post', \App\Http\Controllers\public\PostPublicController::class)
    ->only(['index', 'show']);
  Route::apiResource('/job',  \App\Http\Controllers\public\JobPublicController::class)
    ->only(['index']);
  Route::apiResource('/faq',  \App\Http\Controllers\public\FAQPublicController::class)
    ->only(['index']);
  Route::apiResource('/event',\App\Http\Controllers\public\EventPublicController::class)
    ->only(['index']);
    Route::get('/event/count',[\App\Http\Controllers\public\EventPublicController::class, 'getCount']);
  Route::apiResource('/seminar-type',\App\Http\Controllers\public\SeminarTypePublicController::class)
    ->only(['index']);
  Route::apiResource('/work-status', \App\Http\Controllers\public\WorkStatusPublicController::class)->only(['index']);
  Route::apiResource('/salary-type', \App\Http\Controllers\public\SalaryTypePublicController::class)->only(['index']);
});


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);

    // NOTE PROFILE API
    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function() {
      Route::apiResource('/personal',      \App\Http\Controllers\profile\PersonalController::class)
        ->only(['index', 'update']);
      Route::apiResource('/education',     \App\Http\Controllers\profile\EducationController::class)
        ->only(['index']);
      Route::apiResource('/eligibility',   \App\Http\Controllers\profile\EligibilityController::class)
        ->except(['show']);
      Route::apiResource('/experience',    \App\Http\Controllers\profile\ExperienceController::class)
        ->except(['show']);
      Route::apiResource('/mobile-number', \App\Http\Controllers\profile\MobileNumberController::class)
        ->except(['show']);
      Route::apiResource('/seminars',       \App\Http\Controllers\profile\SeminarController::class)
        ->except(['show']);
      Route::apiResource('/skills',         \App\Http\Controllers\profile\SkillController::class)
        ->except(['show']);
      Route::apiResource('/voluntaries',     \App\Http\Controllers\profile\VoluntaryController::class)
        ->except(['show']);
      Route::apiResource('/document', \App\Http\Controllers\DocumentAuthController::class)
        ->only(['index', 'destroy', 'store']);
    });

  Route::apiResource('/users', \App\Http\Controllers\UserController::class)
    ->only(['index', 'destroy']);
});
