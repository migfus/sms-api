<?php
namespace App\Http\Controllers\profile;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Models\Info;
use App\Models\User;

class PersonalController extends Controller
{
  public function index(Request $req) {
    if(!$req->user()->can('index profile')) {
      return $this->G_UnauthorizedResponse();
    }

    $info = Info::where('user_id', $req->user()->id)->first();
    $info->avatar = $req->user()->avatar;

    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => $info,
    ], 200);
  }

  public function update(Request $req, $id) {
    if(!$req->user()->can('update profile'))
      return $this->G_UnauthorizedResponse();
    $user_id = $req->user()->id;

    $val = Validator::make($req->all(), [
      'last_name' => 'required',
      'first_name' => 'required',
      'civil_status_id' => 'required',
      'birth_day' => 'required',
      'birth_place_id' => 'required',
      'blood_type_id' => 'required',
      'sex' => 'required',
      'height' => 'required',
      'weight' => 'required',
      'address_id' => 'required',
      'address_barangay' => '',
      'address_street' => '',
      'address' => '',
    ]);

    if($val->fails()) {
      return $this->G_ValidatorFailResponse($val);
    }

    if(filter_var($req->avatar, FILTER_VALIDATE_URL) === false) {
      $user = User::
        where('id', $user_id)
        ->update([
          'avatar' => $this->G_AvatarUpload($req->avatar)
        ]);
    }

    $info = Info::where('user_id', $user_id)->where('id', $id)
      ->update([
        'last_name' => $req->last_name,
        'first_name' => $req->first_name,
        'mid_name' => $req->mid_name ?? null,
        'ext_name' => $req->ext_name ?? null,
        'civil_status_id' => $req->civil_status_id,
        'birth_day' => $req->birth_day,
        'birth_place_id' => $req->birth_place_id,
        'blood_type_id' => $req->blood_type_id,
        'sex' => $req->sex == 'true' ? true : false ,
        'height' => $req->height,
        'weight' => $req->weight,
        'address_id' => $req->address_id,
        'address_barangay' => $req->address_barangay,
        'address_street' => $req->address_street,
        'address' => $req->address,

        'gsis_id' => $req->gsis_id ?? null,
        'pagibig_id' => $req->pagibig_id ?? null,
        'philhealth_id' => $req->philhealth_id ?? null,
        'sss_id' => $req->sss_id ?? null,
        'tin_id' => $req->tin_id ?? null,
        'agency_id' => $req->agency_id ?? null,
      ]);

    if(!$info) {
      return response()->json([
        ...$this->G_ReturnDefault(),
        'data' => false,
      ], 200);
    }

    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => $info,
    ], 200);
  }
}
