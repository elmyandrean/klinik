@section('title', 'New Patient')

@extends('template')

@section('content')
<div class="container pt-3">
  <div class="row">
    <div class="col-7">
      <div class="card">
        <div class="card-header">
          Create New Diagnosis
        </div>
        <div class="card-body">
          <form action="{{ route('diagnoses.store') }}" method="POST">
            @csrf
            <div class="row">
              <div class="mb-3 row">
                <label for="name" class="col-2 col-form-label">Name <span class="text-danger">*</span></label>
                <div class="col-8">
                  <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" autofocus>
                  @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
              </div>
              <div class="mb-3 row">
                <div class="offset-sm-2 col-sm-8">
                  <button class="btn btn-primary" type="submit">Save</button>
                </div>
              </div>
            </div>    
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection