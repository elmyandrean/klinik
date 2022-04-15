<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class DashboardController extends Controller
{
    public function index(){
      $patients = Patient::all();
      return view('dashboard.index', [
        'patients' => $patients,
      ]);
    }
}
