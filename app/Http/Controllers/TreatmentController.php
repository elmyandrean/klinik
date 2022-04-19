<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Treatment;
use App\Models\Photo;
use Illuminate\Support\Facades\Validator;

class TreatmentController extends Controller
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
    public function create(Request $request)
    {
      $patient = Patient::find($request->patient_id);
      $photos = Photo::where('treatment_id', NULL)->get();

      return view('treatments.create', [
        'patient' => $patient,
        'photos' => $photos,
      ]);
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
            'treatment' => 'required',
            'diagnosis' => 'nullable',
            'notes' => 'nullable',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $validated = $validator->safe()->all();
        $treatment = new Treatment;
        $treatment->patient_id = $request->patient_id;
        $treatment->treatment = $validated['treatment'];
        $treatment->diagnosis = $validated['diagnosis'];
        $treatment->notes = $validated['notes'];
        $treatment->save();

        Photo::where('treatment_id', NULL)->update(['treatment_id' => $treatment->id]);

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
        //
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
        //
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
