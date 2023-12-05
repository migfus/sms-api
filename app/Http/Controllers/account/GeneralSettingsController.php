<?php

namespace App\Http\Controllers\account;

use Illuminate\Http\Request;

use App\Models\User;

class GeneralSettingsController extends Controller
{
  public function index(Request $req) {
    $user = $req->user();

    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => $user,
    ], 200);
  }


  public function store(Request $req) {
    $user = User::
      where('id', $req->user()->id)
      ->update([
        'notify_email_job' => $req->notify_email_job,
        'notify_email_news' => $req->notify_email_news,
        'notify_email_event' => $req->notify_email_event,

        'notify_sms_job' => $req->notify_sms_job,
        'notify_sms_news' => $req->notify_sms_news,
        'notify_sms_event' => $req->notify_sms_event,
      ]);

    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => true,
    ], 200);
  }
}
