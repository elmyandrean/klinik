<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Treatment;
use App\Models\Diagnose;

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
            echo "data tidak ada";
        }
    }
    
    public function store_photo(Request $request){
        dd($request->file('file'));
    }
}
