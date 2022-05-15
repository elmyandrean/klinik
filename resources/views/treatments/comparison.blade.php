@extends('template')

@section('content')
<div class="container pt-3">
    @if($message = Session::get('success'))
    <div class="alert alert-success" role="alert">
        <strong>Success!</strong> {{ $message }}
    </div>
    @endif

    @include('_partials._navmenu_patient')

    <div class="card"">
        <div class="card-body">
            {{ $patient->name .' ( '.($patient->gender == 'L' ? 'Male' : 'Female').' ) '. date('d-m-Y', strtotime($patient->birth_date)) }}
        </div>
    </div>

    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row" style="min-height: 125px;">
                        <div class="col-3 border-end">
                            <h5>Treatment Info</h5>
                            <div style="overflow-y:scroll; height: 140px;">
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
                        <div class="col-3 border-end">
                            <h5><i class="fa-regular fa-clock"></i> Date</h5>
                            <ul style="overflow-y:scroll; height: 140px;">
                                @foreach($patient->treatments as $treatment)
                                <li class="clickable-list" onclick="getDataTreatment({{ $treatment->id }})"><i class="fa-solid fa-folder pe-2"></i> <span class="text-shadow-hover">{{ date('d-m-Y', strtotime($treatment->created_at)) }}</span></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-6">
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

    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="text-center mt-2">
                    <button class="btn btn-light" id="selectorBoxLeftImage" onclick="selectBoxImage('left')">Select Left Image</button>
                    <button class="btn btn-light" id="selectorBoxRightImage" onclick="selectBoxImage('right')">Select Right Image</button>
                </div>
                <div class="card-body" id="foto_user" style="min-height: 400px;">
                  <div class="row">
                      <div class="col-md-6 text-center">
                        <div class="before-retake" id="leftImage">
                          <img src="{{ url('images/show_image.png') }}" alt="Left Image" height="390">
                        </div>
                      </div>
                      <div class="col-md-6 text-center">
                        <div class="before-retake" id="rightImage">
                          <img src="{{ url('images/show_image.png') }}" alt="Right Image" height="390">
                        </div>
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("scripts")
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
  var selectedBoxImage = "";

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
        photos_html += "<img src=\"{{ url('/') }}/upload_images/"+rslt.name+"\" alt=\"photos\" height=\"85px\" class=\"px-2 result-image\" id=\""+rslt.id+"\">";
        photos_html += "<div class=\"text-center mt-1\"><button class=\"btn btn-sm btn-secondary\" type=\"button\" onclick=\"selectImage("+rslt.id+")\">Select</button></div>"
        photos_html += "</div>";
      })
      $("#photos").html(photos_html);
    });
  }

  function selectBoxImage(value){
    if(value == "right"){
      $("#selectorBoxRightImage").removeClass("btn-light");
      $("#selectorBoxRightImage").addClass("btn-primary");
      $("#selectorBoxLeftImage").removeClass("btn-primary");
      $("#selectorBoxLeftImage").addClass("btn-light");
      selectedBoxImage = "R"
    } else {
      $("#selectorBoxLeftImage").removeClass("btn-light");
      $("#selectorBoxLeftImage").addClass("btn-primary");
      $("#selectorBoxRightImage").removeClass("btn-primary");
      $("#selectorBoxRightImage").addClass("btn-light");
      selectedBoxImage = "L"
    }

    console.log(selectedBoxImage);
  }

  function selectImage(id){
    if(selectedBoxImage == "") {
      Swal.fire({
        title: 'Failed!',
        text: "Silahkan memilih box panel untuk menampilkan gambar terlebih dahulu.",
        icon: 'error'
      });

      return true;
    }

    var url = $("#"+id).attr("src");
    var html = "";
    console.log(selectedBoxImage);
    if(selectedBoxImage == "L"){
      html += "<img src=\""+url+"\" alt=\"Left Image\" height=\"390\">";
      $("#leftImage").html(html);
    } else if(selectedBoxImage == "R") {
      html += "<img src=\""+url+"\" alt=\"Right Image\" height=\"390\">";
      $("#rightImage").html(html);
    }
  }
</script>
@endsection