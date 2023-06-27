<?php

namespace App\Http\Controllers;

use App\Models\Job;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobPublicController extends Controller
{
  // NOTE INDEX
  public function index(Request $req) {
    $val = Validator::make($req->all(), [
      'search' => '',
      // 'departments' => 'required',
      // 'status' => 'required',
      // 'type' => 'required',
    ]);

    if($val->fails()) {
      return $this->G_ValidatorFailResponse($val);
    }

    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => $this->searchQuery($req),
    ]);
  }

  private function searchQuery($req) {
    $data = Job::where('title', 'LIKE', '%'.$req->search.'%')->with(['JobStatus', 'JobType', 'JobDepartment', 'JobLocation'])->get();
    return $data;
  }

  // NOTE SHOW
  public function show(string $id) {
      //
  }
}
