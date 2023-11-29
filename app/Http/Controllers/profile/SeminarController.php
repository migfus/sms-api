<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Seminar;

class SeminarController extends Controller
{
    public function index(Request $req) {
      if(!$req->user()->can('index profile')) {
        return $this->G_UnauthorizedResponse();
      }

      $seminars = Seminar::where('info_id', $req->user()->info->id)
        ->with(['seminar_type'])
        ->orderBy('created_at', 'DESC')
        ->get();

      return response()->json([
        ...$this->G_ReturnDefault(),
        'data' => $seminars,
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
        'seminar_type_id' => 'required',
        'sponsor' => 'required',
      ]);

      if($val->fails()) {
        return $this->G_ValidatorFailResponse($val);
      }

      $seminar = Seminar::create([
        'info_id' => $req->user()->info->id,
        'name' => $req->name,
        'from' => $req->from,
        'to' => $req->to,
        'hours' => $req->hours,
        'seminar_type_id' => $req->seminar_type_id,
        'sponsor' => $req->sponsor,
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
        'seminar_type_id' => 'required',
        'sponsor' => 'required',
      ]);

      if($val->fails()) {
        return $this->G_ValidatorFailResponse($val);
      }

      $seminar = Seminar::where('id', $id)->where('info_id', $req->user()->info->id)
        ->update([
          'info_id' => $req->user()->info->id,
          'name' => $req->name,
          'from' => $req->from,
          'to' => $req->to,
          'hours' => $req->hours,
          'seminar_type_id' => $req->seminar_type_id,
          'sponsor' => $req->sponsor,
        ]);

      if(!$seminar) {
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

      $seminar = Seminar::where('info_id', $req->user()->info->id)->where('id', $id)->delete();

      if(!$seminar) {
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
