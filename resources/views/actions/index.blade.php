@section('title', 'Action / Treatment Management')

@extends('template')

@section('content')
<div class="container pt-3">
  <div class="d-flex align-items-center">
    <div class="title-content">
      <h4>Action / Treatment Management</h4>
    </div>
    <div class="button-action ms-auto">
      <a class="btn btn-primary" href="{{ route('actions.create') }}">Tambah Action / Treatment</a>
    </div>
  </div>
  <div class="action-content">
    <div class="row d-flex">
      <div class="col-md-3 pt-3">
        <div class="card">
          <div class="card-body d-flex">
            <div class="action-title">
              <h5>Action 1</h5>
              <small>15 Users</small>
            </div>
            <div class="action-button ms-auto align-self-end">
              <a href="#">Edit</a> / <a href="#">Delete</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection