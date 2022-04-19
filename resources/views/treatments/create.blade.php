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
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3 row">
                  <label for="treatment" class="col-sm-3 col-form-label">Treatment</label>
                  <div class="col-sm-8">
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
                  <label for="diagnosis" class="col-sm-3 col-form-label">Diagnosis</label>
                  <div class="col-sm-8">
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
                  <label for="patien_id" class="col-sm-3 col-form-label">Notes</label>
                  <div class="col-sm-8">
                    <textarea name="notes" id="notes" rows="5" class="form-control"></textarea>
                  </div>
                </div>
              </div>
              <div class="col-md-6 d-flex flex-column align-items-center">
                <div id="video-webcam" class="mb-3"></div>
                <div class="text-center">
                  <button class="btn btn-secondary" onclick="take_snapshot()">Take a picture</button>
                </div>
                <div id="my_result"></div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3 row">
                  <div class="offset-md-3 col-md-9">
                    <button class="btn btn-primary" type="submit">Save</button>
                  </div>
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

@section('scripts')
<script src="{{ url('libs/webcamjs/webcam.min.js') }}"></script>
<script language="JavaScript">
  Webcam.set({
    width: 320,
    height: 240,
    image_format: 'jpeg',
    jpeg_quality: 90
  });
  Webcam.attach('#video-webcam');
  function take_snapshot() {
    Webcam.snap( function(data_uri) {
      document.getElementById('my_result').innerHTML = '<img src="'+data_uri+'"/>';
    } );
  }
</script>
@endsection