<div class="row mb-3">
  <div class="col-12">
    <a href="{{ route("patients.show", $patient->id) }}" class="btn {{ Route::currentRouteName() == "patients.show" ? "btn-primary" : "btn-light" }} border"><i class="fas fa-camera"></i> Retake</a>
    <a href="{{ route("treatments.comparison") }}?patient_id={{ $patient->id }}" class="btn {{ Route::currentRouteName() == "treatments.comparison" ? "btn-primary" : "btn-light" }} border"><i class="fas fa-code-compare"></i> Comparison</a>
    <a href="{{ route("patients.import")."?patient_id=".$patient->id }}" class="btn {{ Route::currentRouteName() == "patients.import" ? "btn-primary" : "btn-light" }} border"><i class="fas fa-upload"></i> Import</a>
    <a href="{{ route("patients.export")."?patient_id=".$patient->id }}" class="btn {{ Route::currentRouteName() == "patients.export" ? "btn-primary" : "btn-light" }} border"><i class="fas fa-download"></i> Export</a>
  </div>
</div>