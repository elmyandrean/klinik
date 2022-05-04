<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Diagnose;

class DiagnosesController extends Controller
{
    public function index() {
      $diagnoses = Diagnose::where('status', '=', true)->paginate(24);
      return view('diagnoses.index', [
        'diagnoses' => $diagnoses,
      ]);
    }

    public function create(){
      return view('diagnoses.create');
    }

    public function store(Request $request){
      $validator = Validator::make($request->all(), [
        'name' => 'required|min:5',
      ]);

      if($validator->fails()){
          return back()->withErrors($validator)->withInput();
      }

      $validated = $validator->safe()->all();

      Diagnose::insert($validated);

      return redirect()->route('diagnoses.index');
    }

    public function edit($id) {
      $diagnose = Diagnose::findOrFail($id);

      return view('diagnoses.edit', [
        'diagnose' => $diagnose
      ]);
    }

    public function update(Request $request, $id) {
      $validator = Validator::make($request->all(), [
        'name' => 'required|min:5',
      ]);

      if($validator->fails()){
          return back()->withErrors($validator)->withInput();
      }

      $validated = $validator->safe()->all();

      Diagnose::where('id', $id)->update($validated);

      return redirect()->route('diagnoses.index');
    }

    public function destroy($id) {
      Diagnose::where('id', $id)->update(['status' => 0]);

      return redirect()->route('diagnoses.index');
    }
}
