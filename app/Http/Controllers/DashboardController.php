<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;


class DashboardController extends Controller
{
    public function index(Request $request){
      $patients = Patient::where('name', 'like', '%'.$request->name.'%')
        ->orWhere('id', $request->patient_id)
        ->orWhere('personal_id', 'like', '%'.$request->personal_id.'%')
        ->paginate(10)->withQueryString();

        return view('dashboard.index', [
        'patients' => $patients,
      ]);
    }
}
