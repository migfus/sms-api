<?php

namespace App\Http\Controllers\public;

use Illuminate\Http\Request;

use App\Models\FAQ;

class FAQPublicController extends Controller
{
  public function index(Request $req) {
    if($req->search) {
      $data = FAQ::whereNotNull('approved_user_id')->where('question', 'LIKE', '%'.$req->search.'%')->orderBy('points', 'DESC')->limit(4)->get();
    }
    else {
      $data = FAQ::whereNotNull('approved_user_id')->orderBy('points', 'DESC')->limit(4)->get();
    }

    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => $data,
    ], 200);
  }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
