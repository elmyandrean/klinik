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
                            <ul>
                                @foreach($patient->treatments as $treatment)
                                <li class="clickable-list">{{ date('d-m-Y', strtotime($treatment->created_at)) }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-8">
                            <h5>Photos</h5>
                            <div class="row">
                                <div id="photos"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection