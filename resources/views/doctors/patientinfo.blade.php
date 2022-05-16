@extends('layouts.app')

@section('content')
<style>
    label {
        padding: 0px;
    }
    .form-group {
        margin-bottom: 10px;
    }
    .disAble {
        pointer-events:none;
    }
    .image-center {
        width: 35%;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    .heading-info {
        font-weight: bold;
        background: white;
        margin-top: 20px;
        color: #c93600;
        padding: 3px 7px;
        border-top: 1px solid #c93600;
        border-bottom: 1px solid #c93600;
        width: 100%;
        margin-bottom: 20px;
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
<input type="hidden" id="patient_id" value="{{ $patient->id }}">
<div class="container-fluid">
    <div class="box box-success">
        <div class="row">
            <div class="col-md-3">
                @if($patient->sex=='Male')
                <img src="{{ asset('public/img/mans.png') }}" class="image-center" />
                @else
                <img src="{{ asset('public/img/womans.png') }}" class="image-center" />
                @endif
                <div><label class="heading-info">Patient Information</label></div>
                <div><label style="text-transform: uppercase;">{{$patient->lname}}, {{$patient->fname}} {{$patient->mname}}</label></div>
                <div style="margin-bottom: 6px;">{{\Carbon\Carbon::parse($patient->dob)->diff(\Carbon\Carbon::now())->format('%y years %m months old and %d day(s)')}}</div>
                <div>Birthdate: <label>{{\Carbon\Carbon::parse($patient->dob)->format('F d, Y')}}</label></div>
                <div>Sex: <label>{{$patient->sex}}</label></div>
                <div>Civil Status: <label>{{$patient->civil_status}}</label></div>
                <hr>
                <div>
                    <ul class="nav nav-pills nav-stacked" style="overflow: auto; height: 350px;">
                      <li><a data-toggle="tab" href="#tabspatientInfo"><img src="{{ asset('public/img/profile.png') }}"/>&nbsp;Profile</a></li>
                      <li class="active"><a data-toggle="tab" href="#tabsTele"><img src="{{ asset('public/img/tele.png') }}"/>&nbsp;Teleconsultations</a></li>
                      <li><a data-toggle="tab" href="#tabsMedHis"><img src="{{ asset('public/img/medhis.png') }}"/>&nbsp;Medical History</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="tab-content">
                    <div id="tabspatientInfo" class="tab-pane fade in">
                        <div class="pull-right">
                            <h4 id="btnEdit" title="Edit Facility" onclick="enableView()"><a href="javascript:void(0)"><i class="far fa-edit"></i></a></h4>
                        </div>
                        <h3>Patient Profile</h3>
                        @include('forms.patientprof')
                    </div>
                    <div id="tabsTele" class="tab-pane fade in active">
                        <h3>Teleconsultations</h3>
                        <br>
                        @include('doctors.tabs.consults')
                    </div>
                    <div id="tabsMedHis" class="tab-pane fade in">
                        <h3>Medical History</h3>
                        <br>
                        @include('doctors.tabs.medhis')
                    </div>
                    <div id="tabsTelDet" class="tab-pane fade in">
                        <h3>Teleconsultation Details</h3>
                        <div>
                          <h5 id="chiefCom" class="title-info update_info"></h5>
                          <b><small id="chiefDate"></small></b>
                          <br><b>
                              <small id="chiefTime"></small>
                          </b>
                          <p id="chiefType"></p>
                          <br>
                        </div>
                        @include('doctors.tabs.details')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
@include('doctors.scripts.patientinfo')
@endsection

