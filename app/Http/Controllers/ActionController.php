<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Action;

class ActionController extends Controller
{
    public function index(Request $request){
      $actions = Action::where('status', '=', true)->paginate(24);
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

    public function edit($id) {
      $action = Action::findOrFail($id);

      return view('actions.edit', [
        'action' => $action,
      ]);
    }

    public function update(Request $request, $id){
      $validator = Validator::make($request->all(), [
        'name' => 'required|min:5',
      ]);

      if($validator->fails()){
          return back()->withErrors($validator)->withInput();
      }

      $validated = $validator->safe()->all();

      Action::where('id', $id)->update($validated);

      return redirect()->route('actions.index');
    }

    public function destroy($id) {
      Action::where('id', $id)->update(['status' => 0]);

      return redirect()->route('actions.index');
    }
}
