<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Voluntary;

class VoluntaryController extends Controller
{
  public function index(Request $req) {
    if(!$req->user()->can('index profile')) {
      return $this->G_UnauthorizedResponse();
    }

    $voluntary = Voluntary::where('info_id', $req->user()->info->id)
      ->orderBy('created_at', 'DESC')
      ->get();

    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => $voluntary,
    ], 200);
  }

  public function store(Request $req) {
    if(!$req->user()->can('update profile')) {
      return $this->G_UnauthorizedResponse();
    }

    $val = Validator::make($req->all(), [
      'name' => 'required',
      'from' => 'required|date',
      'to' => 'required|date',
      'hours' => 'required|min:1',
      'position' => 'required',
    ]);

    if($val->fails()) {
      return $this->G_ValidatorFailResponse($val);
    }

    $voluntary = Voluntary::create([
      'info_id' => $req->user()->info->id,
      'name' => $req->name,
      'from' => $req->from,
      'to' => $req->to,
      'hours' => $req->hours,
      'position' => $req->position,
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

  public function update(Request $req, string $id) {
    if(!$req->user()->can('update profile')) {
      return $this->G_UnauthorizedResponse();
    }

    $val = Validator::make($req->all(), [
      'name' => 'required',
      'from' => 'required|date',
      'to' => 'required|date',
      'hours' => 'required|min:1',
      'position' => 'required',
    ]);

    if($val->fails()) {
      return $this->G_ValidatorFailResponse($val);
    }

    $voluntary = Voluntary::where('id', $id)->where('info_id', $req->user()->info->id)
      ->update([
      'info_id' => $req->user()->info->id,
      'name' => $req->name,
      'from' => $req->from,
      'to' => $req->to,
      'hours' => $req->hours,
      'position' => $req->position,
    ]);

    if(!$voluntary) {
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

    $voluntary = Voluntary::where('info_id', $req->user()->info->id)->where('id', $id)->delete();

    if(!$voluntary) {
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
