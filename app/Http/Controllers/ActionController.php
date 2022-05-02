<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Action;

class ActionController extends Controller
{
    public function index(Request $request){
      $actions = Action::paginate(20);
      return view('actions.index', [
        'actions' => $actions,
      ]);
    }

    public function create() {
      return view('actions.create');
    }
}
