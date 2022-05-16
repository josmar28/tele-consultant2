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
    .signature-pad {
      border-style: ridge;
    }
</style>
<div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/patient/clinical').'/'.$patient->id }}">Clinical History & Physical Exam</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/patient/covid').'/'.$patient->id }}">Covid 19 Screening</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/patient/diagnosis').'/'.$patient->id }}">Diagnosis/Assessment</a></li>
        <li class="breadcrumb-item active">Plan of Management</li>
      </ol>
    </nav>
    <div class="box box-success">
        <div class="box-header with-border">
        <form id="plan_form" method="POST">
            <div class="pull-right">
                <button title="save" type="submit" class="btnSave btn btn-success hide"><i class="far fa-save"></i></button>
                <h4 id="btnEdit" title="Edit Facility" onclick="enableView()"><a href="javascript:void(0)"><i class="far fa-edit"></i></a></h4>
            </div>
            <h3 class="text-success">Plan of Management</h3>
            <h4 class="text-primary">Patient: {{ $patient->lname }}, {{ $patient->fname }} {{ $patient->mname }}</h4>
        </div>
        <div id="formEdit" class="box-body disAble">
            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
            <input type="hidden" name="signaturephy" value="@if($patient->planmanage){{ $patient->planmanage->signature }} @endif">
            <input type="hidden" name="id" value="@if($patient->planmanage){{ $patient->planmanage->id }} @endif">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Plan of Management:</label>
                            <textarea class="form-control" name="plan_management" rows="2" required>@if($patient->planmanage) {{ $patient->planmanage->plan_management }} @endif</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Prescription:</label>
                            <textarea class="form-control" name="prescription" rows="2" required>@if($patient->planmanage) {{ $patient->planmanage->prescription }} @endif</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Referral:</label>
                            <textarea class="form-control" name="referral" rows="2" required>@if($patient->planmanage) {{ $patient->planmanage->referral }} @endif</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Disposition:</label>
                            <textarea class="form-control" name="disposition" rows="2" required>@if($patient->planmanage) {{ $patient->planmanage->disposition }} @endif</textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <canvas id="signature-pad" class="signature-pad " width=340 height=100></canvas>
                        <div class="actionsignature hide text-right">
                            <button type="button" id="draw">Sign</button>
                            <button type="button" id="erase">Erase</button>
                            <button type="button" id="clear">Clear</button>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control text-center" value="@if($patient->planmanage){{$patient->planmanage->name_physician}} @endif" name="name_physician">
                            <div class="text-center"><p>Name & Signature of Physician</p></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>License #:</label>
                            <textarea class="form-control" name="license_no" rows="2" required>@if($patient->planmanage) {{ $patient->planmanage->license_no }} @endif</textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Professional Tax Receipt:</label>
                            <textarea class="form-control" name="prof_tax_receipt" rows="2" required>@if($patient->planmanage) {{ $patient->planmanage->prof_tax_receipt }} @endif</textarea>
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

