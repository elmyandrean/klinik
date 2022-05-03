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
}
