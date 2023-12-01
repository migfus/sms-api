<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Skill;

class SkillController extends Controller
{
  public function index(Request $req) {
    if(!$req->user()->can('index profile')) {
      return $this->G_UnauthorizedResponse();
    }

    $skills = Skill::where('info_id', $req->user()->info->id)
      ->where('name', 'LIKE', '%'.$req->search.'%')
      ->orderBy('created_at', 'DESC')
      ->get();

    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => $skills,
    ], 200);
  }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req) {
      if(!$req->user()->can('update profile')) {
        return $this->G_UnauthorizedResponse();
      }

      $val = Validator::make($req->all(), [
        'name' => 'required',
      ]);

      if($val->fails()) {
        return $this->G_ValidatorFailResponse($val);
      }

      $skill = Skill::create([
        'info_id' => $req->user()->info->id,
        'name' => $req->name,
        'recognition' => $req->recognition ?? null,
      ]);

      return response()->json([
        ...$this->G_ReturnDefault(),
        'data' => true,
      ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, string $id) {
      if(!$req->user()->can('update profile')) {
        return $this->G_UnauthorizedResponse();
      }

      $val = Validator::make($req->all(), [
        'name' => 'required',
      ]);

      if($val->fails()) {
        return $this->G_ValidatorFailResponse($val);
      }

      $skill = Skill::where('id', $id)->where('info_id', $req->user()->info->id)
        ->update([
          'name' => $req->name,
          'recognition' => $req->recognition,
        ]);

      if(!$skill) {
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $req, string $id) {
      if(!$req->user()->can('update profile')) {
        return $this->G_UnauthorizedResponse();
      }

      $skill = Skill::where('info_id', $req->user()->info->id)->where('id', $id)->delete();

      if(!$skill) {
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
