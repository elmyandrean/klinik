<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Action;
use App\Models\Diagnose;
use App\Models\Patient;
use App\Models\Photo;
use App\Models\Treatment;
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
      $actions = Action::where('status', '=', true)->get();
      $diagnosis = Diagnose::where('status', '=', true)->get();

      return view('treatments.create', [
        'patient' => $patient,
        'photos' => $photos,
        'actions' => $actions,
        'diagnosis' => $diagnosis,
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

        $photo = Photo::where('treatment_id', NULL)->get();
        if(count($photo) == 0){
          return back()->withErrors(['photos' => 'Belum ada Foto untuk di upload.'])->withInput();
        }

        $validated = $validator->safe()->all();
        $treatment = new Treatment;
        $treatment->patient_id = $request->patient_id;
        $treatment->action_id = $validated['treatment'];
        $treatment->diagnose_id = $validated['diagnosis'];
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
      $treatment = Treatment::findOrFail($id);
      $treatment->photos = $treatment->photos()->get();
      $treatment->action = $treatment->action()->first();
      $treatment->diagnose = $treatment->diagnose()->first();

      // dd($treatment);

      return json_encode($treatment, 200);
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

    public function comparison(Request $request){
      $patient = Patient::findOrFail($request->patient_id);
      $treatments = Treatment::where('patient_id', $request->patient_id)->orderByDesc('created_at')->get();

      return view('treatments.comparison', [
        'treatments' => $treatments,
        'patient' => $patient,
      ]);
    }

    public function get_photos(Request $request){
      $treatments = Treatment::findOrFail($request->id);

      return json_encode($treatments->photos, 200);
    }
}
