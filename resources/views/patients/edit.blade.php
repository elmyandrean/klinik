@section('title', 'Edit Patient')

@extends('template')

@section('content')
<div class="container pt-3">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          Edit Patient
        </div>
        <div class="card-body">
          <form action="{{ route('patients.update', $patient->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3 row">
              <label for="name" class="col-sm-3 col-md-2 col-form-label">Name <span class="text-danger">*</span></label>
              <div class="col-9 col-lg-5">
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $patient->name }}" autofocus>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>
            <div class="mb-3 row align-items-center">
              <label for="gender" class="col-sm-3 col-md-2 col-form-label">Gender <span class="text-danger">*</span></label>
              <div class="col-9 col-lg-5">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="genderL" value="L" {{ $patient->gender == 'L' ? 'checked' : '' }}>
                  <label class="form-check-label" for="genderL">Laki-laki</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="genderP" value="P" {{ $patient->gender == 'P' ? 'checked' : '' }}>
                  <label class="form-check-label" for="genderP">Perempuan</label>
                </div>
                @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>
            <div class="mb-3 row">
              <label for="birthDate" class="col-sm-3 col-md-2 col-form-label">Birth Date <span class="text-danger">*</span></label>
              <div class="col-9 col-lg-5">
                <input type="date" name="birth_date" id="birthDate" class="form-control @error('birth_date') is-invalid @enderror" value="{{ $patient->birth_date }}">
                @error('birth_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>
            <div class="mb-3 row">
              <label for="personal_id" class="col-sm-3 col-md-2 col-form-label">Personal ID</label>
              <div class="col-9 col-lg-5">
                <input type="text" name="personal_id" id="personal_id" class="form-control @error('personal_id') is-invalid @enderror" value="{{ $patient->personal_id }}">
                @error('personal_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>
            <div class="mb-3 row">
              <label for="phone" class="col-sm-3 col-md-2 col-form-label">Phone</label>
              <div class="col-9 col-lg-5">
                <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ $patient->phone }}">
                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>
            <div class="mb-3 row">
              <label for="email" class="col-sm-3 col-md-2 col-form-label">Email</label>
              <div class="col-9 col-lg-5">
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $patient->email }}">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>
            <div class="mb-3 row">
              <label for="address" class="col-sm-3 col-md-2 col-form-label">Address</label>
              <div class="col-9 col-lg-5">
                <textarea name="address" id="address" cols="10" class="form-control @error('address') is-invalid @enderror">{{ $patient->address }}</textarea>
                @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
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