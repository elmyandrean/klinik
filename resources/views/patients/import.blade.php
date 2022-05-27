@extends('template')

@section('title', 'Import Photo')

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endsection

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
                    <form action="{{ route('imports.data') }}" name="demoform" id="demoform" method="POST" class="dropzone" enctype="multipart/form-data">
						
						@csrf 
						<div class="mb-3 row">
                            <label for="treatment_date" class="col-2 col-form-label">Tanggal Treatment</label>
                            <div class="col-2">
                                <input type="date" name="treatment_date" id="treatment_date" class="form-control" onchange="checkTreatment(this.value)">
                                <input type="hidden" name="treatment_id" id="treatment_id">
                                <input type="hidden" name="patient_id" id="patient_id" value="{{ $patient->id }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="treatment_name" class="col-2 col-form-label">Treatment</label>
                            <div class="col-4">
                                <select name="treatment_name" id="treatment_name" class="form-select">
                                    <option selected disabled>Pilih Treatment</option>
                                    @foreach($actions as $action)
                                    <option value="{{ $action->id }}">{{ $action->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="treatment_diagnose" class="col-2 col-form-label">Diagnose</label>
                            <div class="col-4">
                                <select name="treatment_diagnose" id="treatment_diagnose" class="form-select">
                                    <option selected disabled>Pilih Diagnose</option>
                                    @foreach($diagnosis as $diagnose)
                                    <option value="{{ $diagnose->id }}">{{ $diagnose->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                          <label for="treatment_notes" class="col-2 col-form-label">Notes</label>
                          <div class="col-4">
                              <textarea name="treatment_notes" id="treatment_notes" rows="5" class="form-control"></textarea>
                          </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="treatment_photo" class="col-12 col-form-label">Upload Photo (Click or Drop the Image on the box)</label>
                        <div class="col-12">
                            <div id="dropzoneDragArea" class="dz-default dz-message dropzoneDragArea dropzone-previews"></div>
                        </div>
                  		</div>
                  		<div class="form-group">
	        				      <button type="submit" class="btn btn-md btn-primary">Import Data</button>
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
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script>
    function checkTreatment(date){
        $.ajax({
            url : '{{ route('treatments.get_by_date') }}',
            method : 'GET',
            data : {patient_id : {{ $patient->id }}, created_at : date},
            success : function(rslt){
                if(rslt != 'null'){
                    rslt = JSON.parse(rslt);
                    $("#treatment_diagnose").val(rslt.diagnose_id);
                    $("#treatment_name").val(rslt.action_id);
                    $("#treatment_notes").val(rslt.notes);
                    $("#treatment_id").val(rslt.id);
                } else {
                    $('#treatment_diagnose').prop('selectedIndex',0);
                    $('#treatment_name').prop('selectedIndex',0);
                    $("#treatment_notes").val("");
                    $("#treatment_id").val("");
                }
            }
        })
    }

    Dropzone.autoDiscover = false;
    // Dropzone.options.demoform = false;	
    let token = $('meta[name="csrf-token"]').attr('content');
    $(function() {
    var myDropzone = new Dropzone("div#dropzoneDragArea", { 
        paramName: "treatment_photo",
        url: "{{ route('imports.photo') }}",
        previewsContainer: 'div.dropzone-previews',
        addRemoveLinks: true,
        autoProcessQueue: false,
        uploadMultiple: false,
        parallelUploads: 5,
        maxFiles: 5,
        acceptedFiles: ".jpeg,.jpg",
        params: {
            _token: token
        },
        // The setting up of the dropzone
        init: function() {
            var myDropzone = this;
            //form submission code goes here
            $("form[name='demoform']").submit(function(event) {
                //Make sure that the form isn't actully being sent.
                event.preventDefault();
                URL = $("#demoform").attr('action');
                formData = $('#demoform').serialize();
                $.ajax({
                    type: 'POST',
                    url: URL,
                    data: formData,
                    success: function(result){
                        if(result.status == "success"){
                            console.log(result.treatment_id);
                            var treatment_id = result.treatment_id;
                            $("#treatment_id").val(treatment_id);
                            myDropzone.processQueue();
                        }else{
                            // console.log(result);
                        }
                    }
                });
            });
            //Gets triggered when we submit the image.
            this.on('sending', function(file, xhr, formData){
            //fetch the user id from hidden input field and send that userid with our image
            let treatment_id = document.getElementById('treatment_id').value;
              formData.append('treatment_id', treatment_id);
            });
            
            this.on("success", function (file, response) {
                $('#demoform')[0].reset();
                $('.dropzone-previews').empty();
                Swal.fire({
                  icon: 'success',
                  title: 'Yeay!',
                  text: 'You have success to import photo!',
                })
            });

            this.on("queuecomplete", function () {
              //
            });
            
            this.on("sendingmultiple", function() {
            // Gets triggered when the form is actually being sent.
            // Hide the success button or the complete form.
            });
            
            this.on("successmultiple", function(files, response) {
            // Gets triggered when the files have successfully been sent.
            // Redirect user or notify of success.
            });
            
            this.on("errormultiple", function(files, response) {
            // Gets triggered when there was an error sending the files.
            // Maybe show form again, and notify user of error
            });
        }
        });
    });
</script>
@endsection