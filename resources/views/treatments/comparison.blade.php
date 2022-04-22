@extends('template')

@section('styles')
<link rel="stylesheet" href="{{ url('css/zoom.css') }}">
@endsection

@section('content')
<div class="container pt-3">
  <div class="card">
    <div class="card-header">
      {{ $patient->name .' ( '.($patient->gender == 'L' ? 'Male' : 'Female').' ) '. date('d-m-Y', strtotime($patient->birth_date)) }}
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div class="img-preview d-flex justify-content-center align-items-center pb-3 img-magnifier-container" id="leftImagePreview" style="height: 400px">
            <h2>Gambar belum dipilih</h2>
          </div>
          <div class="row">
            <div class="mb-3">
              <label for="leftImage" class="form-label">Tanggal Treatment</label>
              <select name="left-image" id="leftImage" class="form-select" onchange="getPicture(this.value, 'left')">
                <option selected disabled>- Pilih Tanggal Treatment -</option>
                @foreach($treatments as $tl)
                <option value="{{ $tl->id }}">{{ date('d-m-Y', strtotime($tl->created_at)) }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3 d-flex align-items-center" id="leftListImage"></div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="img-preview d-flex justify-content-center align-items-center pb-3 img-magnifier-container" id="rightImagePreview" style="height: 400px">
            <h2>Gambar belum dipilih</h2>
          </div>
          <div class="row">
            <div class="mb-3">
              <label for="rightImage" class="form-label">Tanggal Treatment</label>
              <select name="right-image" id="rightImage" class="form-select" onchange="getPicture(this.value, 'right')">
                <option selected disabled>- Pilih Tanggal Treatment -</option>
                @foreach($treatments as $tl)
                <option value="{{ $tl->id }}">{{ date('d-m-Y', strtotime($tl->created_at)) }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3 d-flex align-items-center" id="rightListImage"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script src="{{ url('js/zoom.js') }}"></script>

<script type="text/javascript">
  function getPicture(value, position){
    $.ajax({
      url: "{{ url('patients/treatments/get_photos') }}?id="+value,
      method: "GET",
      success: function(response){
        var photos = JSON.parse(response);
        var html = "";
        photos.forEach(function(data){
          html += '<div class="pe-3">'
          html += '<img src="{{ url("upload_images") }}/'+data.name+'" height="70" class="image-thumbnail" onclick="showImage(\''+data.name+'\', \''+position+'\')">';
          html += '</div>'
        });

        $('#'+position+'ListImage').html(html);
      }
    })
  }

  function showImage(imgPath, position){
    var html = '<img src="{{ url("upload_images") }}/'+imgPath+'" style="height: 100%; width: auto;" id="myImage'+position+'">';
    $('#'+position+'ImagePreview').html(html);
    magnify("myImage"+position, 1.5, position);
  }

  var magnifier_left = document.getElementById('imgMagnifierGlassleft');
  var magnifier_right = document.getElementById('imgMagnifierGlassright');

  $('#myImageleft').mouseenter(function(){
    magnifier_left.style.display = "block";
  }).mouseleave(function(){
    magnifier_left.style.display = "none";
  })

  $('#myImageright').mouseenter(function(){
    magnifier_right.style.display = "block";
  }).mouseleave(function(){
    magnifier_right.style.display = "none";
  })
</script>
@endsection