<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Education;

class EducationController extends Controller
{

  public function index(Request $req) {
    if(!$req->user()->can('index profile')) {
      return $this->G_UnauthorizedResponse();
    }

    $educ = Education::
      where('info_id', $req->user()->info->id)
      ->with(['education_levels'])
      ->where(function ($q) use($req){
        $q->where('school', 'LIKE', '%'.$req->search.'%');
        $q->orWhere('degree', 'LIKE', '%'.$req->search.'%');
        $q->orWhere('scholarship', 'LIKE', '%'.$req->search.'%');
        $q->orWhere('honors', 'LIKE', '%'.$req->search.'%');
      })
      ->orderBy('from', 'DESC')
      ->get();

    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => $educ,
    ], 200);
  }

  public function destroy(Request $req, string $id) {
    if(!$req->user()->can('update profile')) {
      return $this->G_UnauthorizedResponse();
    }

    $educ = Education::where('info_id', $req->user()->info->id)->where('id', $id)->delete();

    if(!$educ) {
      return response()->json([
        ...$this->G_ReturnDefault(),
        'data' => false,
      ], 200);
    }

    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => true,
    ]);
  }

  public function store(Request $req) {
    if(!$req->user()->can('update profile')) {
      return $this->G_UnauthorizedResponse();
    }

    $val = Validator::make($req->all(), [
      'level' => 'required',
      'school' => 'required',
      'degree' => '',
      'from' => 'required|date',
      'to' => '',
      'scholarship' => '',
      'honors' => ''
    ]);

    if($val->fails()) {
      return $this->G_ValidatorFailResponse($val);
    }

    Education::create([
      'info_id' => $req->user()->info->id,
      'level' => $req->level,
      'school' => $req->school,
      'degree' => $req->degree ?? null,
      'from' => $req->from,
      'to' => $req->to ?? null,
      'scholarship' => $req->scholarship ?? null,
      'honors' => $req->honors ?? null,
    ]);

    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => true,
    ], 200);
  }

  public function update(Request $req, string $id) {
    if(!$req->user()->can('update profile')) {
      return $this->G_UnauthorizedResponse();
    }

    $val = Validator::make($req->all(), [
      'level' => 'required',
      'school' => 'required',
      'degree' => '',
      'from' => 'required|date',
      'to' => '',
      'scholarship' => '',
      'honors' => ''
    ]);

    if($val->fails()) {
      return $this->G_ValidatorFailResponse($val);
    }

    Education::
      where('id', $id)
      ->where('info_id', $req->user()->info->id)
      ->update([
        'info_id' => $req->user()->info->id,
        'level' => $req->level,
        'school' => $req->school,
        'degree' => $req->degree ?? null,
        'from' => $req->from,
        'to' => $req->to ?? null,
        'scholarship' => $req->scholarship ?? null,
        'honors' => $req->honors ?? null,
      ]);

    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => true,
    ], 200);
  }

}
