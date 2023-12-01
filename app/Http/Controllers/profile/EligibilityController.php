<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Eligibility;

class EligibilityController extends Controller
{
  public function index(Request $req) {
    if(!$req->user()->can('index profile')) {
      return $this->G_UnauthorizedResponse();
    }

    $elig = Eligibility::where('info_id', $req->user()->info->id)
      // ->with(['work_status'])
      ->where('name', 'LIKE', '%'.$req->search.'%')
      ->orderBy('exam_date', 'DESC')
      ->get();

    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => $elig,
    ], 200);
  }

  public function destroy(Request $req, string $id) {
    if(!$req->user()->can('update profile')) {
      return $this->G_UnauthorizedResponse();
    }

    $exp = Eligibility::where('info_id', $req->user()->info->id)->where('id', $id)->delete();

    if(!$exp) {
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
      'name' => 'required',
      'address_id' => 'required',
      'rating' => 'required',
      'exam_date' => 'required',
      'validity_date' => 'required',
      'number' => 'required'
    ]);

    if($val->fails()) {
      return $this->G_ValidatorFailResponse($val);
    }

    Eligibility::create([
      'info_id' => $req->user()->info->id,
      'name' => $req->name,
      'address_id' => $req->address_id,
      'rating' => $req->rating,
      'exam_date' => $req->exam_date,
      'validity_date' => $req->validity_date,
      'number' => $req->number,
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
      'name' => 'required',
      'address_id' => 'required',
      'rating' => 'required',
      'exam_date' => 'required',
      'validity_date' => 'required',
      'number' => 'required'
    ]);

    if($val->fails()) {
      return $this->G_ValidatorFailResponse($val);
    }

    Eligibility::where('id', $id)->where('info_id', $req->user()->info->id)
      ->update([
        'info_id' => $req->user()->info->id,
        'name' => $req->name,
        'address_id' => $req->address_id,
        'rating' => $req->rating,
        'exam_date' => $req->exam_date,
        'validity_date' => $req->validity_date,
        'number' => $req->number,
      ]);

    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => true,
    ], 200);
  }
}
