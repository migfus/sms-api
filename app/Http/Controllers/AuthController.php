<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Info;
use App\Models\MobileNumber;

use App\Mail\ForgotPasswordMail;

class AuthController extends Controller
{
  public function Login(Request $req) {
    $val = Validator::make($req->all(), [
      'email' => 'required|email',
      'password' => 'required|min:8',
    ]);

    if($val->fails()) {
      return $this->G_ValidatorFailResponse($val);
    }

    $user = User::where('email', $req->email)
      ->with(['info'])
      ->first();
    if(!$user || !Hash::check($req->password, $user->password)) {
      return response()->json(['status' => false, 'message' => 'Invalid Credentials!'], 401);
    }

    $permissions = $user->getAllPermissions()->pluck('name');

    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => [
        'auth' => $user,
        'ip'   => $_SERVER['REMOTE_ADDR'],
        'token'=> $user->createToken('token idk wv')->plainTextToken,
        'permissions' => $permissions,
      ]
    ], 200);
  }

  public function Logout(Request $req) {
    $req->user()->currentAccessToken()->delete();

    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => true
    ], 200);
  }

  public function Register(Request $req) {
    $val = Validator::make($req->all(), [
      'last_name' => 'required',
      'first_name' => 'required',
      'mid_name' => 'required',
      'ext_name' => 'required',

      'college_id' => 'required', // main
      'department_id' => 'required', // sub of college
      'position' => 'required',
    ]);

    if($val->fails()) {
      return $this->G_ValidatorFailResponse($val);
    }



    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => true,
    ], 200);
  }
}
