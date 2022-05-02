<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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

    public function store(Request $request) {
      $validator = Validator::make($request->all(), [
          'name' => 'required|min:5',
      ]);

      if($validator->fails()){
          return back()->withErrors($validator)->withInput();
      }

      $validated = $validator->safe()->all();

      Action::insert($validated);

      return redirect()->route('actions.index');
    }
}
