<?php

namespace App\Http\Controllers\public;

use Illuminate\Http\Request;

use App\Models\EducationLevel;

class EducationLevelController extends Controller
{
  public function index() {
    $level = \App\Models\EducationLevel::orderBy('id', 'ASC')->get();

    return response()->json($level);
  }
}
