<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Treatment;
use App\Models\Diagnose;

class ImportPhotoController extends Controller
{
    public function store_data(Request $request){
        dd($request->treatment_date);
    }

    public function store_photo(Request $request){
        dd($request);
    }
}
