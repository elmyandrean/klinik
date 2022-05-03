@section('title', 'Diagnosis Management')

@extends('template')

@section('content')
<div class="container pt-3">
  <div class="d-flex align-items-center">
    <div class="title-content">
      <h4>Diagnosis Management</h4>
    </div>
    <div class="button-action ms-auto">
      <a class="btn btn-primary" href="{{ route('diagnoses.create') }}">Tambah Diagnosis</a>
    </div>
  </div>
  <div class="action-content">
    <div class="row d-flex">
      @if(count($diagnoses) == 0)
      <div class="text-center mt-5">
        <h5>Data Diagnosis Belum Ada.</h5>
        <a href="{{ route('diagnoses.create') }}" class="btn btn-primary">Buat Diagnosis Baru</a>
      </div>

      @else
        @foreach($diagnoses as $diagnose)
        <div class="col-md-3 pt-3">
          <div class="card">
            <div class="card-body d-flex">
              <div class="diagnose-title">
                <h5>{{ $diagnose->name }}</h5>
                <small>{{ count($diagnose->treatment) }} Patient(s)</small>
              </div>
              <div class="diagnose-button ms-auto align-self-end">
                <a href="{{ route('diagnoses.edit', $diagnose->id) }}">Edit</a> / 
                <form action="{{ route('diagnoses.destroy', $diagnose->id) }}" method="POST" class="delete-form">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="delete-link">Delete</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        @endforeach

        @endif
      </div>
      <div class="pt-3">
        {{ $diagnoses->links() }}
      </div>
  </div>
</div>
@endsection