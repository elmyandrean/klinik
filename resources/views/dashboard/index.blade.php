@section('title', 'Dashboard')

@extends('template')

@section('content')
<section class="section-search-patient pt-4">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="card">
          <div class="card-header fw-bold">Search Patient</div>
          <div class="card-body">
            <form action="#" method="POST">
              @csrf
              <div class="mb-3 row">
                <label for="patien_id" class="col-sm-3 col-form-label">Patient ID</label>
                <div class="col-sm-9">
                  <input type="text" name="patient_id" id="patient_id" class="form-control">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="name" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-9">
                  <input type="text" name="name" id="name" class="form-control">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="visit_date" class="col-sm-3 col-form-label">Visit Date</label>
                <div class="col-sm-9">
                  <input type="text" name="visit_date" id="visit_date" class="form-control">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="registration_date" class="col-sm-3 col-form-label">Reg. Date</label>
                <div class="col-sm-9">
                  <input type="text" name="registration_date" id="registration_date" class="form-control">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="shot_date" class="col-sm-3 col-form-label">Shot Date</label>
                <div class="col-sm-9">
                  <input type="text" name="shot_date" id="shot_date" class="form-control">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="personal_id" class="col-sm-3 col-form-label">Personal ID</label>
                <div class="col-sm-9">
                  <input type="text" name="personal_id" id="personal_id" class="form-control">
                </div>
              </div>
              <div class="mb-3 row">
                <div class="offset-sm-3 col-sm-9">
                  <button class="btn btn-primary" type="submit">Search</button>
                  <button class="btn btn-secondary text-white">Cancel</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="section-data-patient mt-4">
  <div class="container">
    <div class="card">
      <div class="card-body">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Personal ID</th>
              <th>Name</th>
              <th>Gender</th>
              <th>Date of Birth</th>
              <th>Treatmen / Notes</th>
              <th>Checkin Today</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="6" class="text-center">Data Belum Ada</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
@endsection