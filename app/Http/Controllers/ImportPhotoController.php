<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Treatment;
use App\Models\Diagnose;
use App\Models\Photo;

class ImportPhotoController extends Controller
{
    public function store_data(Request $request){
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|min:5',
        // ]);
  
        // if($validator->fails()){
        //     return back()->withErrors($validator)->withInput();
        // }

        if($request->treatment_id != ""){
            $treatment = Treatment::findOrFail($request->treatment_id);

            return response()->json(['status' => "success", 'treatment_id' => $treatment->id], 200);
          } else {
            $treatment = new Treatment;
            $treatment->action_id = $request->treatment_name;
            $treatment->diagnose_id = $request->treatment_diagnose;
            $treatment->notes = $request->treatment_notes;
            $treatment->patient_id = $request->patient_id;
            $treatment->created_at = $request->treatment_date;
            $treatment->save();

            return response()->json(['status' => "success", 'treatment_id' => $treatment->id], 200);
        }
    }
    
    public function store_photo(Request $request){
      if($request->treatment_photo){
        $patient_id = $request->patient_id;

        $filename = 'pic_'.rand().'_'.date('YmdHis').'.'.$request->treatment_photo->extension();
        $filepath = public_path('upload_images/');

        if(move_uploaded_file($_FILES['treatment_photo']['tmp_name'],$filepath.$filename)){
          $photo = new Photo;
          $photo->name = $filename;
          $photo->treatment_id = $request->treatment_id;
          $photo->save();

          return response()->json(['status' => "success", 'photo' => $photo], 200);
          return json_encode($photo, 200);
        }

        return json_encode('Something wrong when process upload images', 500);

      }
    }
}
