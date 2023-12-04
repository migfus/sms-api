<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FactsController extends Controller
{
  public function index() {
    $fact = 'Facts in the well';
    return view('vue-app', compact('fact'));
  }
}
