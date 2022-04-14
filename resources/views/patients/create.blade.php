@section('title', 'New Patient')

@extends('template')

@section('content')
<div class="container pt-3">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          Create New Patient
        </div>
        <div class="card-body">
          <form action="{{ route('patients.store') }}" method="POST">
            @csrf
            <div class="mb-3 row">
              <label for="name" class="col-sm-3 col-md-2 col-form-label">Name <span class="text-danger">*</span></label>
              <div class="col-sm-5">
                <input type="text" name="name" id="name" class="form-control" autofocus required>
              </div>
            </div>
            <div class="mb-3 row align-items-center">
              <label for="gender" class="col-sm-3 col-md-2 col-form-label">Gender <span class="text-danger">*</span></label>
              <div class="col-sm-5">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="genderL" value="L" required>
                  <label class="form-check-label" for="genderL">Laki-laki</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="genderP" value="P" required>
                  <label class="form-check-label" for="genderP">Perempuan</label>
                </div>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="birthDate" class="col-sm-3 col-md-2 col-form-label">Birth Date <span class="text-danger">*</span></label>
              <div class="col-sm-5">
                <input type="date" name="birth_date" id="birthDate" class="form-control" required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="personal_id" class="col-sm-3 col-md-2 col-form-label">Personal ID</label>
              <div class="col-sm-5">
                <input type="text" name="personal_id" id="personal_id" class="form-control">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="phone" class="col-sm-3 col-md-2 col-form-label">Phone</label>
              <div class="col-sm-5">
                <input type="text" name="phone" id="phone" class="form-control">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="email" class="col-sm-3 col-md-2 col-form-label">Email</label>
              <div class="col-sm-5">
                <input type="email" name="email" id="email" class="form-control">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="address" class="col-sm-3 col-md-2 col-form-label">Address</label>
              <div class="col-sm-5">
                <textarea name="address" id="address" cols="10" class="form-control"></textarea>
              </div>
            </div>
            <div class="mb-3 row">
              <div class="offset-sm-3 offset-md-2 col-sm-9">
                <button class="btn btn-primary" type="submit">Save</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection