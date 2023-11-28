<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\File;

class DocumentAuthController extends Controller
{
  public function index(Request $req) {
    if($req->user()->hasPermissionTo('index profile')) {
      return response()->json([
        ...$this->G_ReturnDefault($req),
        'data' => File::where('info_id', $req->user()->info_id)->get(),
      ]);
    }
    return $this->G_UnauthorizedResponse();
  }

  public function destroy(string $id, Request $req) {
    if($req->user()->hasPermissionTo('removeFile profile')) {
      return response()->json([
        ...$this->G_ReturnDefault($req),
        'data' => File::where('info_id', $req->user()->info_id)->where('id', $id)->delete(),
      ]);
    }
    return $this->G_UnauthorizedResponse();
  }

  public function store(Request $request) {
    if($req->user()->hasPermissionTo('store profile')) {
      $data = File::create([
        'info_id' => $req->user()->info_id,
        'filename' => $req->filename,
        'url' => $req->url,
        'size' => $req->size,
      ]);

      return response()->json([
        ...$this->G_ReturnDefault($req),
        'data' => $data,
      ]);
    }
    return $this->G_UnauthorizedResponse();
  }
  private function Upload($data) {
    list($type, $image) = explode(';', $image);
    list(, $image) = explode(',', $image);

    $image = base64_decode($image);
    $imageName = time(). '.jpg';
    $location = '/uploads/'.$path.$imageName;
    file_put_contents('uploads/'.$path.$imageName, $image);

    return $location;
  }
}
