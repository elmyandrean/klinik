<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use DB;


class DashboardController extends Controller
{
  
  public function index(Request $request){
    $where = [];
    
    if(isset($request->name)){
      $where[] = ['patients.name', 'like', '%'.$request->name.'%'];
    }

    if(isset($request->visit_date)){
      $where[] = ['treatments.created_at', 'like', $request->visit_date.'%'];
    }

    if(isset($request->registration_date)){
      $where[] = ['patients.created_at', 'like', $request->registration_date.'%'];
    }

    if(isset($request->shot_date)){
      $where[] = ['photos.updated_at', 'like', $request->shot_date.'%'];
    }

    if(isset($request->personal_id)){
      $where[] = ['patients.personal_id', 'like', '%'.$request->personal_id.'%'];
    }
    
    $patients = Patient::select('patients.id', 'patients.name', 'patients.gender', 'patients.birth_date', 'patients.personal_id', 'patients.created_at')
      ->where($where)
      ->join('treatments', 'patients.id', '=', 'treatments.patient_id')
      ->join('photos', 'treatments.id', '=', 'photos.treatment_id')
      ->distinct()
      ->paginate(10)->withQueryString();

    return view('dashboard.index', [
      'patients' => $patients,
    ]);
  }
}
