<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;


class DashboardController extends Controller
{
    public function index(){
      $patients = Patient::paginate(10);
      return view('dashboard.index', [
        'patients' => $patients,
      ]);
    }
}
