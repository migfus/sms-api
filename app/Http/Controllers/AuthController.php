<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Info;

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
      ->first()
      ->makeHidden('email_verified_at', 'created_at', 'updated_at');
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
      'email' => 'required|email|unique:users',
      'password' => 'required|min:8',

      'last_name' => 'required',
      'first_name' => 'required',
      'civil_status_id' => 'required',
      'birth_day' => 'required',
      'birth_place_id' => 'required',
      'blood_type_id' => 'required',

      'height' => 'required',
      'weight' => 'required',
      'address_id' => 'required',
      'address' => 'required',
    ]);

    if($val->fails()) {
      return $this->G_ValidatorFailResponse($val);
    }

    $user = User::create([
      'email' => $req->email,
      'password' => Hash::make($req->password),
      'avatar' => 'https://static.vecteezy.com/system/resources/thumbnails/002/002/403/small/man-with-beard-avatar-character-isolated-icon-free-vector.jpg'
    ])->assignRole('applicant');

    $info = Info::create([
      'user_id' => $user->id,
      'last_name' => $req->last_name,
      'first_name' => $req->first_name,
      'mid_name' => $req->mid_name == '' ? null : $req->mid_name,
      'ext_name' => $req->ext_name == '' ? null : $req->ext_name,
      'civil_status_id' => $req->civil_status_id,
      'birth_day' => $req->birth_day,
      'birth_place_id' => $req->birth_place_id,
      'blood_type_id' => $req->blood_type_id,
      'sex' => $req->sex ? true : false,
      'height' => $req->height,
      'weight' => $req->weight,
      'address_id' => $req->address_id,
      'address' => $req->address,
    ]);

    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => true,
    ], 200);
  }

  public function Forgot(Request $req) {
    $val = Validator::make($req->all(), [
      'email' => 'required|email|exists:users,email',
    ]);

    if($val->fails()) {
      return $this->G_ValidatorFailResponse($val);
    }

    $code = rand(0, 9999);
    User::where('email', $req->email)->update(['remember_token' => $code]);

    Mail::to($req->email)->send(new ForgotPasswordMail($req->email, $code));

    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => true,
    ], 200);
  }

  public function Recovery(Request $req) {
    $val = Validator::make($req->all(), [
      'code' => 'required',
      'password' => 'required',
    ]);

    if($val->fails()) {
      return $this->G_ValidatorFailResponse($val);
    }

    $user = User::where('remember_token', $req->code)
      ->update([
        'password' => Hash::make($req->password),
        'email_verified_at' => Carbon::now(),
        'remember_token' => null
      ]);



    if(!$user) {
      return response()->json([
        ...$this->G_ReturnDefault(),
        'data' => false,
      ], 200);
    }

    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => true,
    ], 200);

    return response()->json([
      ...$this->G_ReturnDefault()
    ]);
  }
}
