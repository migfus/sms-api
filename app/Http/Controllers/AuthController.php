<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Person;

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

    $user = User::where('email', $req->email)->with('person')->first();
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

  public function Register(Request $req) {
    $val = Validator::make($req->all(), [
      'email' => 'required|email',
      'password' => 'required|min:8',
    ]);

    if($val->fails()) {
      return $this->G_ValidatorFailResponse($val);
    }

    $person = Person::create([
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

    $user = User::create([
      'person_id' => $person->id,
      'email' => $req->email,
      'password' => Hash::make($req->password),
      'avatar' => 'https://static.vecteezy.com/system/resources/thumbnails/002/002/403/small/man-with-beard-avatar-character-isolated-icon-free-vector.jpg'
    ])->assignRole('applicant');


    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => $user,
    ], 200);
  }
}
