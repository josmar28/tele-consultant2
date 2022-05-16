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
    .btnSaveMove {
        position: fixed;
        bottom: 30px;
        right: 92px;
        z-index: 99;
        animation-name: fadeInOpacity;
        animation-iteration-count: 1;
        animation-timing-function: ease-in;
        animation-duration: 0.5s;
    }
    @keyframes fadeInOpacity {
        0% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }
</style>
<div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active">Clinical History & Physical Exam</li>
        <li class="breadcrumb-item"><a href="{{ url('/patient/covid').'/'.$patient->id }}">Covid 19 Screening</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/patient/diagnosis').'/'.$patient->id }}">Diagnosis/Assessment</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/patient/plan').'/'.$patient->id }}">Plan of Management</a></li>
      </ol>
    </nav>
    <div class="box box-success">
        <div class="box-header with-border">
        <form id="clinical_form" method="POST">
            <div class="pull-right">
                <button title="save" type="submit" class="btnSave btn btn-success hide"><i class="far fa-save"></i></button>
                <h4 id="btnEdit" title="Edit Facility" onclick="enableView()"><a href="javascript:void(0)"><i class="far fa-edit"></i></a></h4>
            </div>
            <h3 class="text-success">Clinical History and Physical Exam</h3>
            <h4 class="text-primary">Patient: {{ $patient->lname }}, {{ $patient->fname }} {{ $patient->mname }}</h4>
        </div>
        <div id="formEdit" class="box-body disAble">
            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
            <input type="hidden" name="id" value="@if($patient->clinical){{ $patient->clinical->id }} @endif">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <h4>Clinical History</h4>
                        <div class="form-group">
                            <label>Reason for Teleconsultation:</label>
                            <textarea class="form-control" name="reason_consult" rows="2" required>@if($patient->clinical) {{ $patient->clinical->reason_consult }} @endif</textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Date of Onset of Illness:</label>
                            <input type="text" class="form-control daterange" value="{{ $date_onset_illness }}" name="date_onset_illness" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Name of Referral Health Facility <small>(if Applicable)</small>:</label>
                            <select name="facility_id" class="select2">
                                <option value="">Select Facility</option>
                                @foreach($facility as $row)
                                    <option value="{{ $row->id }}" @if($patient->clinical)@if($patient->clinical->facility_id == $row->id)selected @endif @endif>{{ $row->facilityname }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Date of Referral <small>(if Applicable)</small>:</label>
                            <input type="text" class="form-control daterange" value="{{ $date_referral }}" name="date_referral">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Known Medical Condition/s & Medical History:</label>
                            <textarea class="form-control" name="known_medical_history" rows="2" required>@if($patient->clinical) {{ $patient->clinical->known_medical_history }} @endif</textarea>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Current Medications:</label>
                            <input type="text" class="form-control" value="@if($patient->clinical){{$patient->clinical->current_medication}} @endif" name="current_medication" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Blood Type:</label>
                            <input type="text" class="form-control" value="@if($patient->clinical){{$patient->clinical->blood_type}} @endif" name="blood_type" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                    <hr>
                        <h4>Physical Examination(Inspection)</h4>
                        <div class="form-group">
                            <label>Clinical Status at the Time of Consult:</label>
                            <textarea class="form-control" name="clinical_status_time_consult" rows="2" required>@if($patient->clinical) {{ $patient->clinical->clinical_status_time_consult }} @endif</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Specific Findings:</label>
                            <textarea class="form-control" name="specific_findings" rows="2" required>@if($patient->clinical) {{ $patient->clinical->specific_findings }} @endif</textarea>
                        </div>
                    </div>
                </div>
        </form>
        </div>
    </div>
</div>
@endsection
@section('js')
    @include('admin.scripts.patient')
@endsection

