<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
          'name' => 'required|min:5',
          'gender' => 'required',
          'birth_date' => 'required|date',
          'personal_id' => 'nullable|digits_between:12,20',
          'phone' => 'nullable|digits_between:10,20',
          'email' => 'nullable|email',
          'address' => 'nullable',
      ]);

      if($validator->fails()){
          return back()->withErrors($validator)->withInput();
      }

      $validated = $validator->safe()->all();

      Patient::insert($validated);

      return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = Patient::find($id);

        return view('patients.edit', ['patient' => $patient]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $validator = Validator::make($request->all(), [
        'name' => 'required|min:5',
        'gender' => 'required',
        'birth_date' => 'required|date',
        'personal_id' => 'nullable|digits_between:12,20',
        'phone' => 'nullable|digits_between:10,20',
        'email' => 'nullable|email',
        'address' => 'nullable',
      ]);

      if($validator->fails()){
        return back()->withErrors($validator)->withInput();
      }

      $validated = $validator->safe()->all();

      Patient::where('id', $id)->update($validated);

      return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
