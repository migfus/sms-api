<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Experience;

class ExperienceController extends Controller
{
  public function index(Request $req) {
    if(!$req->user()->can('index profile')) {
      return $this->G_UnauthorizedResponse();
    }

    $experience = Experience::where('info_id', $req->user()->info->id)
      ->with(['work_status'])
      ->where('position', 'LIKE', '%'.$req->search.'%')
      ->orderBy('from', 'DESC')
      ->get();

    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => $experience,
    ], 200);
  }

  public function store(Request $req) {
    if(!$req->user()->can('update profile')) {
      return $this->G_UnauthorizedResponse();
    }

    $val = Validator::make($req->all(), [
      'position' => 'required',
      'company' => 'required',
      'from' => 'required',
      'salary' => 'required',
      'salary_type_id'=> 'required',
      'work_status_id'=> 'required',
      'is_government'=> 'required',
    ]);

    if($val->fails()) {
      return $this->G_ValidatorFailResponse($val);
    }

    Experience::create([
      'info_id' => $req->user()->info->id,
      'position' => $req->position,
      'company' => $req->company,
      'from' => $req->from,
      'salary' => $req->salary,
      'salary_type_id'=> $req->salary_type_id,
      'work_status_id'=> $req->work_status_id,
      'is_government'=> $req->is_government ? true : false,
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
      'position' => 'required',
      'company' => 'required',
      'from' => 'required',
      'salary' => 'required',
      'salary_type_id'=> 'required',
      'work_status_id'=> 'required',
      'is_government'=> 'required',
    ]);

    if($val->fails()) {
      return $this->G_ValidatorFailResponse($val);
    }

    $exp = Experience::where('id', $id)->where('info_id', $req->user()->info->id)
      ->update([
        'position' => $req->position,
        'company' => $req->company,
        'from' => $req->from,
        'to' => $req->to ?? null,
        'salary' => $req->salary,
        'sg' => $req->sg ?? null,
        'salary_type_id'=> $req->salary_type_id,
        'work_status_id'=> $req->work_status_id,
        'is_government'=> $req->is_government ? true : false,
      ]);

    if(!$exp) {
      return response()->json([
        ...$this->G_ReturnDefault(),
        'data' => false,
      ], 200);
    }

    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => true,
    ], 200);
  }

  public function destroy(Request $req, string $id) {
    if(!$req->user()->can('update profile')) {
      return $this->G_UnauthorizedResponse();
    }

    $exp = Experience::where('info_id', $req->user()->info->id)->where('id', $id)->delete();

    if(!$exp) {
      return response()->json([
        ...$this->G_ReturnDefault(),
        'data' => false,
      ], 200);
    }

    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => true,
    ], 200);
  }
}
