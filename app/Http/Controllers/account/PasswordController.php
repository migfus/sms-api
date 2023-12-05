<?php

namespace App\Http\Controllers\account;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

class PasswordController extends Controller
{
  public function store(Request $req) {
    if(!$req->user()->can('update profile')) {
      return $this->G_UnauthorizedResponse();
    }

    $val = Validator::make($req->all(), [
      'pass' => 'required|min:8',
      'old_pass' => 'required|min:8',
    ]);

    if($val->fails()) {
      return $this->G_ValidatorFailResponse($val);
    }

    $user = User::
      where('id', $req->user()->id)
      ->first();

    if(!Hash::check($req->old_pass, $user->password)) {
      return response()->json([
        ...$this->G_ReturnDefault(),
        'data' => false,
      ], 200);
    }

    User::
      where('id', $req->user()->id)
      ->update([
        'password' => Hash::make($req->pass)
      ]);

    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => true,
    ], 200);
  }
}
