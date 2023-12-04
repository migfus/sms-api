<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\File;

class FilesController extends Controller
{
  public function index(Request $req) {
    if(!$req->user()->can('index profile')) {
      return $this->G_UnauthorizedResponse();
    }

    $educ = File::
      where('info_id', $req->user()->info->id)
      ->where(function ($q) use($req){
        $q->where('filename', 'LIKE', '%'.$req->search.'%');
      })
      ->orderBy('created_at', 'DESC')
      ->get();

    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => $educ,
    ], 200);
  }

}
