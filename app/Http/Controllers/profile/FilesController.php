<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

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

  public function store(Request $req) {
    if(!$req->user()->can('update profile')) {
      return $this->G_UnauthorizedResponse();
    }

    $file = $req->file;
    $name = $file->hashName();
    $name = $file->getClientOriginalName();
    // dd($name);

    $stored = Storage::disk('public')->put('documents', $req->file);

    File::create([
      'info_id' => $req->user()->info->id,
      'filename' => $name,
      'url' => "/storage/".$stored,
      'size' => $file->getSize(),
    ]);

    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => $stored,
    ], 200);
  }

  public function destroy(Request $req, string $id) {
    if(!$req->user()->can('update profile')) {
      return $this->G_UnauthorizedResponse();
    }


    $file = File::
      where('info_id', $req->user()->info->id)
      ->where('id', $id)
      ->first();
    Storage::disk('public')->delete(str_replace('/storage', '', $file->url));
    $file->delete();

    if(!$file) {
      return response()->json([
        ...$this->G_ReturnDefault(),
        'data' => false,
      ], 200);
    }

    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => true,
    ]);
  }

}
