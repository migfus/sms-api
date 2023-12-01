<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\WorkStatus;

class WorkStatusPublicController extends Controller
{
  public function index() {
    $workStatus = WorkStatus::orderBy('name', 'ASC')->get();

    return response()->json($workStatus);
  }
}
