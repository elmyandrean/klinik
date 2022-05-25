@extends('template')

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<style>
    .dropzone {
        border: none;
    }

    .dz-message {
        margin: 0 !important;
    }

    .dropzoneDragArea {
        background-color: #fbfdff;
        border: 1px dashed #c0ccda;
        border-radius: 6px;
        text-align: center;
        margin-bottom: 15px;
        cursor: pointer;
        min-height: 170px;
    }
    .dropzone{
        box-shadow: 0px 2px 20px 0px #f2f2f2;
        border-radius: 10px;
    }

    .dz-progress {
        display: none !important;
    }

    .dz-details {
        display: none !important;
    }

    .dz-preview:hover .dz-image img{
        transform: scale(1, 1) !important;
        filter: blur(0) !important;
    }
</style>
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
                                <input type="date" name="treatment_date" id="treatment_date" class="form-control">
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
                            <label for="treatment_photo" class="col-12 col-form-label">Upload Photo (Click or Drop the Image on the box)</label>
                            <div class="col-12">
                                <div id="dropzoneDragArea" class="dz-default dz-message dropzoneDragArea dropzone-previews"></div>
                            </div>
                  		</div>
                  		<div class="form-group">
	        				<button type="submit" class="btn btn-md btn-primary">create</button>
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
    Dropzone.autoDiscover = false;
// Dropzone.options.demoform = false;	
let token = $('meta[name="csrf-token"]').attr('content');
$(function() {
var myDropzone = new Dropzone("div#dropzoneDragArea", { 
	paramName: "file",
	url: "{{ url('/patients/import/photo') }}",
	previewsContainer: 'div.dropzone-previews',
	addRemoveLinks: true,
	autoProcessQueue: false,
	uploadMultiple: false,
	parallelUploads: 5,
	maxFiles: 5,
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
	    				// fetch the useid 
	    				var userid = result.user_id;
						$("#userid").val(userid); // inseting userid into hidden input field
	    				//process the queue
	    				myDropzone.processQueue();
	    			}else{
	    				console.log("error");
	    			}
	    		}
	    	});
	    });
	    //Gets triggered when we submit the image.
	    this.on('sending', function(file, xhr, formData){
	    //fetch the user id from hidden input field and send that userid with our image
	      let userid = document.getElementById('userid').value;
		   formData.append('userid', userid);
		});
		
	    this.on("success", function (file, response) {
            //reset the form
            $('#demoform')[0].reset();
            //reset dropzone
            $('.dropzone-previews').empty();
        });
        this.on("queuecomplete", function () {
		
        });
		
        // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
	    // of the sending event because uploadMultiple is set to true.
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