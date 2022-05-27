@extends('template')

@section('title', 'Export Photo')

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
          <div class="card-body">
            <h5 class="text-center">Export Photo</h5>
            <form action="{{ route('exports.download') }}" method="POST" id="formExport">
              <div class="exported-photo row" style="min-height:300px" id="exportPhoto">
                
              </div>
              <div class="text-center pt-4">
                <button class="btn btn-secondary" type="submit">Export</button>
                <button class="btn btn-light border" type="button" onclick="clearData()">Clear Data</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

@section("scripts")
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
  $(document).ready(function(){
    loadExportFoto();
  })

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

  function selectImage(id){
    $.post('{{ url('patients/export/photo') }}/'+id, function(data, status){
      loadExportFoto();
    })
  }

  function loadExportFoto(){
    $.get('{{ url('patients/export/photo') }}', function(data, status){
      data = JSON.parse(data);

      var photos_html = "";
      data.forEach(function(rslt){
        photos_html += "<div class=\"col-3 pt-4 text-center\">";
        photos_html += "<img src=\"{{ url('/') }}/upload_images/"+rslt.name+"\" class=\"img-fluid\">";
        photos_html += "<input type=\"hidden\" name=\"data[]\" value=\""+rslt.name+"\">";
        photos_html += "<button class=\"btn btn-secondary mt-3\" type=\"button\" onclick=\"removePhoto('"+rslt.rowId+"')\">Remove</button>";
        photos_html += "</div>";
      })

      $("#exportPhoto").html(photos_html);
    })
  }

  function removePhoto(id){
    $.ajax({
      data : {_method : "DELETE"},
      method: "POST",
      url : "{{ url('patients/export/photo') }}/"+id,
      success : function(data){
        console.log(data);
        loadExportFoto();
      }
    })
  }

  function clearData() {
    $.post('{{ route('exports.clear') }}', function(data, status){
      loadExportFoto();
    })
  }
</script>
@endsection