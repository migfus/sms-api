<?php

namespace App\Http\Controllers\profile;

use Illuminate\Http\Request;



class PersonalController extends Controller
{
    public function index(Request $req) {
      return response()->json(['test']);
    }
}
