<?php

namespace App\Http\Controllers\public;

use App\Models\SalaryType;
use Illuminate\Http\Request;

class SalaryTypePublicController extends Controller
{
  public function index() {
    $workStatus = \App\Models\SalaryType::orderBy('name', 'ASC')->get();

    return response()->json($workStatus);
  }
}
