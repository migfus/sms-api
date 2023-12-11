<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Info;
use App\Models\Education;

class GeneratePdsController extends Controller
{
  public function index(Request $req) {
    if(!$req->user()->can('index profile')) {
      return $this->G_UnauthorizedResponse();
    }

    $infoID = $req->user()->info->id;

    $personal = Info::
      where('id', $infoID)
      ->with(['civil_status', 'blood_type', 'mobile_numbers'])
      ->first();
    $user = $req->user();
    $educations = Education::
      where('info_id', $infoID)
      ->with('education_level')
      ->orderBy('from', 'ASC')
      ->get();


    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => [
        'personal' => $personal,
        'user' => $user,
        'educations' => $educations
      ],
    ], 200);
  }
}
