@extends('template')

@section('content')
<div class="container pt-3">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          {{ $patient->name .' ( '.($patient->gender == 'L' ? 'Male' : 'Female').' ) '. date('d-m-Y', strtotime($patient->birth_date)) }}
        </div>
        <div class="card-body">
          <form action="#" method="POST">
            @csrf
            <div class="mb-3 row">
              <label for="treatment" class="col-sm-2 col-form-label">Treatment</label>
              <div class="col-sm-5">
                <select name="treatment" id="treatment" class="form-select">
                  <option value="#">Treatment 1</option>
                  <option value="#">Treatment 1</option>
                  <option value="#">Treatment 1</option>
                  <option value="#">Treatment 1</option>
                  <option value="#">Treatment 1</option>
                </select>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="diagnosis" class="col-sm-2 col-form-label">Diagnosis</label>
              <div class="col-sm-5">
                <select name="diagnosis" id="diagnosis" class="form-select">
                  <option value="#">Diagnosis 1</option>
                  <option value="#">Diagnosis 1</option>
                  <option value="#">Diagnosis 1</option>
                  <option value="#">Diagnosis 1</option>
                  <option value="#">Diagnosis 1</option>
                </select>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="patien_id" class="col-sm-2 col-form-label">Notes</label>
              <div class="col-sm-5">
                <textarea name="notes" id="notes" rows="5" class="form-control"></textarea>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection