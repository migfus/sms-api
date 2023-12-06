<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Info;
use App\Models\Education;
use App\Models\Eligibility;
use App\Models\Experience;
use App\Models\Voluntary;
use App\Models\Seminar;

class ProfileSummaryController extends Controller
{
  public function index(Request $req) {
    $infoId = $req->user()->info->id;
    $personal = Info::
      where('user_id', $req->user()->id)
      ->with(['blood_type'])
      ->first();
    $education = Education::
      where('info_id', $infoId)
      ->with(['education_levels'])
      ->orderBy('from', 'DESC')
      ->first();
    $eligibility = Eligibility::
      where('info_id', $infoId)
      ->orderBy('exam_date', 'DESC')
      ->first();
    $experience = Experience::
      where('info_id', $infoId)
      ->with(['salary_type', 'work_status'])
      ->orderBy('from', 'DESC')
      ->first();
    $voluntary = Voluntary::
      where('info_id', $infoId)
      ->orderBy('from', 'DESC')
      ->first();
    $seminar = Seminar::
      where('info_id', $infoId)
      ->with(['seminar_type'])
      ->orderBy('from', 'DESC')
      ->first();


    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => [
        'personal'    => $personal,
        'education'   => $education,
        'eligibility' => $eligibility,
        'experience'  => $experience,
        'voluntary'   => $voluntary,
        'seminar'     => $seminar,
      ],
    ], 200);
  }
}
