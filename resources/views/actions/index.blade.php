@section('title', 'Action / Treatment Management')

@extends('template')

@section('content')
<div class="container pt-4">
  <div class="d-flex align-items-center">
    <div class="title-content">
      <h4>Action / Treatment Management</h4>
    </div>
    <div class="button-action ms-auto">
      <button class="btn btn-primary">Tambah Action / Treatment</button>
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