<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostPublicController extends Controller
{
  // NOTE INDEX
  public function index(Request $req) {
    if($req->isSummary) {
      return $this->IndexSummary($req);
    }
    else {
      return $this->IndexAll($req);
    }
  }

  private function IndexAll() {
    $data = Post::where('active', true)->with(['category', 'user'])->get();

    return response()->json(['data' => $data]);
  }

  private function IndexSummary() {
    $data = Post::where('active', true)->with(['category', 'user'])->limit(3)->get();

    return response()->json(['data' => $data]);
  }

  // NOTE SHOW
  public function show(Post $post) {
    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => $post->first(),
    ]);
  }


  public function store(Request $request) {
      //
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
      //
  }





  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Post $post)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Post $post)
  {
      //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Post $post)
  {
      //
  }
}
