<?php

namespace App\Http\Controllers\public;

use Illuminate\Http\Request;

use App\Models\SeminarType;

class SeminarTypePublicController extends Controller
{
    public function index() {
      $seminar_type = SeminarType::orderBy('name', 'ASC')->get();

      return response()->json($seminar_type);
    }
}
