@extends('template')

@section('content')
<div class="container pt-3">
  @if($message = Session::get('success'))
  <div class="alert alert-success" role="alert">
    <strong>Success!</strong> {{ $message }}
  </div>
  @endif

    <div class="card"">
        <div class="card-body">
            {{ $patient->name .' ( '.($patient->gender == 'L' ? 'Male' : 'Female').' ) '. date('d-m-Y', strtotime($patient->birth_date)) }}
        </div>
    </div>

    <div class="row pt-3">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Treatment Info
                </div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td width="30%">Treatment</td>
                                <td>:</td>
                                <td><span id="treatment"></span></td>
                            </tr>
                            <tr>
                                <td>Diagnosis</td>
                                <td>:</td>
                                <td><span id="diagnosis"></span></td>
                            </tr>
                            <tr>
                                <td>Notes</td>
                                <td>:</td>
                                <td><span id="notes"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body" id="foto_user" style="min-height: 400px;">
                  <div class="row">
                      <div class="col-md-6 text-center">
                        <h5 class="text-center mb-3">Before Retake</h5>
                        <div class="before-retake" id="beforeRetake"></div>
                      </div>
                      <div class="col-md-6">
                        <div class="after-retake text-center" id="afterRetake">
                            <h5 class="mb-3">Preview Retake</h5>
                        </div>
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row" style="min-height: 125px;">
                        <div class="col-4 border-end">
                            <h5><i class="fa-regular fa-clock"></i> Date</h5>
                            <ul style="overflow-y:scroll; height: 95px;">
                                @foreach($patient->treatments as $treatment)
                                <li class="clickable-list" onclick="getDataTreatment({{ $treatment->id }})"><i class="fa-solid fa-folder pe-2"></i> <span class="text-shadow-hover">{{ date('d-m-Y', strtotime($treatment->created_at)) }}</span></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-8">
                            <h5>Photos</h5>
                            <div class="row">
                                <div id="photos" class="d-flex align-items-center">
                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ url('libs/webcamjs/webcam.min.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
  function getDataTreatment(id){
    $(".clickable-list").removeClass("active");
    $(event.currentTarget).addClass('active');

    $("#photos").html("Waiting...")
    loadDataFoto(id);
  }

  function loadDataFoto(id) {
    $.get('{{ url('patients/treatments') }}/'+id, function(data, status){
      data = JSON.parse(data);
      $('#treatment').html(data.action.name);
      $('#diagnosis').html(data.diagnose.name);
      $('#notes').html(data.notes);

      var photos_html = "";
      var photos = data.photos;
      photos.forEach(function(rslt){
        photos_html += "<div class=\"photo-images\">";
        photos_html += "<img src=\"{{ url('/') }}/upload_images/"+rslt.name+"\" alt=\"photos\" height=\"85px\" class=\"px-2\">";
        photos_html += "<div class=\"text-center mt-1\"><button class=\"btn btn-sm btn-secondary\" type=\"button\" onclick=\"retakeFoto("+rslt.id+")\"><i class=\"fa-solid fa-camera\"></i> Retake</button></div>"
        photos_html += "</div>";
      })
      $("#photos").html(photos_html);
    });
  }

  function retakeFoto(id){
    $.get('{{ url('patients/photos') }}/'+id, function(data, status){
      data = JSON.parse(data);

      beforeRetake = "";
      beforeRetake += "<img src=\"{{ url('upload_images') }}/"+data.name+"\" class=\"pt-3\" alt=\"Before Retake\" height=\"265\">";
      $('#beforeRetake').html(beforeRetake);

      afterRetake = "";
      afterRetake += 
      afterRetake += "<h5 class=\"text-center mb-3\">Preview Retake</h5><div id=\"video-webcam\" class=\"m-auto pt-3\"></div>";
      afterRetake += "<button class=\"btn btn-secondary mt-4\" type=\"button\"  onclick=\"previewRetake("+data.id+")\"><i class=\"fas fa-camera\"></i> Take a Picture</button>";
      $("#afterRetake").html(afterRetake);
    
      Webcam.attach('#video-webcam');
    });
  }

  Webcam.set({
    width: 332,
    height: 250,
    image_format: 'jpeg',
    jpeg_quality: 90
  });

  function previewRetake(id) {
    Webcam.snap( function(data_uri) {
        var previewRetake = "";
        previewRetake += "<h5 class=\"mb-3\">Result Retake</h5>";
        previewRetake += "<img src=\""+data_uri+"\" alt=\"Result Retake\" id=\"resultRetake\" class=\"pt-3\">";
        previewRetake += "<button class=\"btn btn-secondary me-2 mt-2\" type=\"button\" onclick=\"saveSnap("+id+")\">Save Image</button><button class=\"btn btn-light border mt-2\" type=\"button\">Retake Image</button></div>"
        $('#afterRetake').html(previewRetake);
    });
  }

  function saveSnap(id){
    var photo = document.getElementById("resultRetake").src;
    Webcam.upload(photo, "{{ route('photos.update_image') }}?id="+id, function(code, data){
      if(code == 200){
        Swal.fire({
          title: 'Success!',
          text: data,
          icon: 'success',
          confirmButtonText: 'Ok'
        }).then((result) => {
          if(result.isConfirmed){
            location.reload();
          }
        });
      } else {
        alert("failed");
      }
    })
  }
</script>
@endsection