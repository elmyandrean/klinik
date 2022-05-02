<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Action;

class ActionController extends Controller
{
    public function index(Request $request){
      $actions = Action::all();
      return view('actions.index', [
        'actions' => $actions,
      ]);
    }
}
