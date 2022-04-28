@extends('template')

@section('content')
<div class="container pt-3">
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
                <div class="card-body d-flex justify-content-center align-items-center" style="height: 400px;">
                    <div class="text-center" id="foto_user">Foto User</div>
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
                                <div id="photos" class="d-flex align-items-center"></div>
                                
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
<script type="text/javascript">
  function getDataTreatment(id){
    $("#photos").html("Waiting...")

    $.get('{{ url('patients/treatments') }}/'+id, function(data, status){
      data = JSON.parse(data);
      $('#treatment').html(data.treatment);
      $('#diagnosis').html(data.diagnosis);
      $('#notes').html(data.notes);

      var photos_html = "";
      var photos = data.photos;
      photos.forEach(function(rslt){
        photos_html += "<div class=\"photo-images\">";
        photos_html += "<img src=\"{{ url('/') }}/upload_images/"+rslt.name+"\" alt=\"photos\" height=\"85px\" class=\"px-2\">";
        photos_html += "<div class=\"text-center mt-1\"><button class=\"btn btn-sm btn-secondary\" type=\"button\"><i class=\"fa-solid fa-camera\"></i> Retake</button></div>"
        photos_html += "</div>";
      })
      $("#photos").html(photos_html);
    });
  }
</script>
@endsection