<?php

use Illuminate\Support\Facades\Route;

// Route::get('{any}', function () {
//   return view('vue-app');
// })->where('any', '.*');

Route::get('{any}', [\App\Http\Controllers\FactsController::class, 'index'])->where('any', '.*');
