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
          <form action="{{ route('treatments.store') }}" method="POST">
            @csrf
            @error('photos')
            <div class="alert alert-danger" role="alert">
              {{ $message }}
            </div>
            @enderror

            <div class="row">
              <input type="hidden" name="patient_id" value="{{ $patient->id }}">
              <div class="col-md-4">
                <div class="mb-3 row">
                  <label for="treatment" class="col-sm-4 col-form-label @error('treatment') is-invalid @enderror">Treatment</label>
                  <div class="col-sm-8">
                    <select name="treatment" id="treatment" class="form-select">
                      <option selected disabled>- Pilih Treatment -</option>
                      @foreach($actions as $action)
                      <option value="{{ $action->id }}" {{ old('treatment') == $action->id ? "selected" : "" }}>{{ $action->name }}</option>
                      @endforeach
                    </select>
                    @error('treatment') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="diagnosis" class="col-sm-4 col-form-label">Diagnosis</label>
                  <div class="col-sm-8">
                    <select name="diagnosis" id="diagnosis" class="form-select @error('diagnosis') is-invalid @enderror">
                      <option selected disabled>- Pilih Diagnosis -</option>
                      @foreach($diagnosis as $diagnose)
                      <option value="{{ $diagnose->id }}" {{ old("diagnosis") == $diagnose->id ? "selected" : "" }}>{{ $diagnose->name }}</option>
                      @endforeach
                    </select>
                    @error('diagnosis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="patien_id" class="col-sm-4 col-form-label">Notes</label>
                  <div class="col-sm-8">
                    <textarea name="notes" id="notes" rows="5" class="form-control @error('notes') is-invalid @enderror"></textarea>
                    @error('notes') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div>
                </div>
                <div class="mb-3 row">
                  <div class="offset-md-4 col-md-9">
                    <button class="btn btn-primary" type="submit">Save</button>
                  </div>
                </div>
              </div>
              <div class="col-md-8 d-flex flex-column align-items-center">
                <div id="video-webcam" class="mb-3"></div>
                <div class="text-center">
                  <button class="btn btn-secondary" onclick="take_snapshot()" type="button">Take Snapshot</button>
                </div>
                <div class="pt-3">
                  <div id="my_result" class="d-flex" height="85px">
                    @if(count($photos) > 0)
                      @foreach($photos as $photo)
                      <div class="text-center">
                      <img src="{{ url("upload_images/".$photo->name) }}" height="50" class="px-2">
                      <div class="pt-1"><button class="btn btn-danger btn-sm" type="button" onclick="deleteImage('{{ $photo->id }}')">X</button></div>
                      </div>
                      @endforeach
                    @else
                      <div class="text-center">
                        <h5>Belum ada gambar</h5>
                      </div>
                    @endif
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
    width: 640,
    height: 360,
    image_format: 'jpeg',
    jpeg_quality: 90
  });
  Webcam.attach('#video-webcam');
  function take_snapshot() {
    Webcam.snap( function(data_uri) {
      saveSnap(data_uri);
    });
  }

  function saveSnap(data){
    $('#my_result').text('Waiting...');
    Webcam.upload(data, "{{ route('photos.upload_images').'?patient_id='.$patient->id }}", function(code1, data1){
      if(code1 == 200){
        loadImage();
      } else {
        alert("failed");
      }
    })
  }

  function loadImage(){
    $.ajax({
      method: 'GET',
      url: "{{ route('photos.get_photo_no_threatment') }}",
      success: function(result){
        var result = JSON.parse(result);
        var image = "";

        if(result.length > 0){
          result.forEach(function(data){
            image += '<div class="text-center">'
            image += '<img src="{{ url("upload_images") }}/'+data.name+'" height="80" class="px-2">';
            image += '<div class="pt-1"><button class="btn btn-danger btn-sm" type="button" onclick="deleteImage('+data.id+')">X</button></div>'
            image += '</div>'
          });
          $('#my_result').html(image);
        } else {
          $('#my_result').html('<div class="text-center"><h5>Belum ada gambar</h5></div>')
        }
      }
    });
  }

  function deleteImage(id){
    $('#my_result').text('Waiting...');
    $.ajax({
      method: 'post',
      url: "{{ route('photos.delete_image') }}",
      data: {
        _method: 'DELETE',
        id: id,
      },
      success: function(result){
        loadImage();
      }
    })
  }
</script>
@endsection