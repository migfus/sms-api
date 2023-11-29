<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\MobileNumber;

class MobileNumberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req) {
      if(!$req->user()->can('index profile')) {
        return $this->G_UnauthorizedResponse();
      }

      $mobiles = MobileNumber::where('info_id', $req->user()->info->id)->get();

      // $mobiles = $req->user()->info->id;

      return response()->json([
        ...$this->G_ReturnDefault(),
        'data' => $mobiles,
      ], 200);
    }


    public function store(Request $req) {
      if(!$req->user()->can('update profile')) {
        return $this->G_UnauthorizedResponse();
      }

      $val = Validator::make($req->all(), [
        'number' => 'required|numeric',
      ]);

      if($val->fails()) {
        return $this->G_ValidatorFailResponse($val);
      }

      $mobiles = MobileNumber::create([
        'info_id' => $req->user()->info->id,
        'allow_notify' => 1,
        'number' => $req->number,
      ]);

      return response()->json([
        ...$this->G_ReturnDefault(),
        'data' => $mobiles,
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
        'number' => 'required|numeric',
      ]);

      if($val->fails()) {
        return $this->G_ValidatorFailResponse($val);
      }

      $mobiles = MobileNumber::where('id', $id)->where('info_id', $req->user()->info->id)
        ->update([
          'number' => $req->number,
        ]);

      if(!$mobiles) {
        return response()->json([
          ...$this->G_ReturnDefault(),
          'data' => false,
        ], 200);
      }

      return response()->json([
        ...$this->G_ReturnDefault(),
        'data' => $mobiles,
      ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $req, string $id) {
      if(!$req->user()->can('update profile')) {
        return $this->G_UnauthorizedResponse();
      }

      $mobiles = MobileNumber::where('info_id', $req->user()->info->id)->where('id', $id)->delete();

      if(!$mobiles) {
        return response()->json([
          ...$this->G_ReturnDefault(),
          'data' => false,
        ], 200);
      }

      return response()->json([
        ...$this->G_ReturnDefault(),
        'data' => $mobiles,
      ], 200);
    }
}
