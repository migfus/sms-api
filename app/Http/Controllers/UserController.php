<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class UserController extends Controller
{
  public function index(Request $req) {
    if($req->user()->hasPermissionTo('index user')) {
      $val = Validator::make($req->all(), [
        'search' => '',
        'filter' => 'required',
        'dateStart' => 'array',
      ]);

      if($val->fails()) {
        return $this->G_ValidatorFailResponse($val);
      }

      $data;

      if(count($req->dateRange) > 1) {
        $data = User::with(['person'])
          ->where('created_at', '>=', Carbon::parse($req->dateRange[0]))
          ->where('created_at', '<=', Carbon::parse($req->dateRange[1]));
      }
      else {
        $data = User::with(['person']);
      }

      switch($req->filter) {
        case 'Email':
          $data->where('email', 'LIKE', '%'.$req->search.'%');
          break;
        default:
          $data->whereHas('person', function($q) use($req) {
            $q->where('last_name', 'LIKE', '%'.$req->search.'%')
              ->orWhere('first_name', 'LIKE', '%'.$req->search.'%');
          });
      }



      return response()->json([
        ...$this->G_ReturnDefault($req),
        'data' => $data->paginate(10),
      ]);
    }
    return $this->G_UnauthorizedResponse();
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
