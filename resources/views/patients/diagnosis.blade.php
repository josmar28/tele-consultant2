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
        <li class="breadcrumb-item"><a href="{{ url('/patient/clinical').'/'.$patient->id }}">Clinical History & Physical Exam</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/patient/covid').'/'.$patient->id }}">Covid 19 Screening</a></li>
        <li class="breadcrumb-item active">Diagnosis/Assessment</li>
        <li class="breadcrumb-item active"><a href="{{ url('/patient/plan').'/'.$patient->id }}">Plan of Management</a></li>
      </ol>
    </nav>
    <div class="box box-success">
        <div class="box-header with-border">
        <form id="diag_form" method="POST">
            <div class="pull-right">
                <button title="save" type="submit" class="btnSave btn btn-success hide"><i class="far fa-save"></i></button>
                <h4 id="btnEdit" title="Edit Facility" onclick="enableView()"><a href="javascript:void(0)"><i class="far fa-edit"></i></a></h4>
            </div>
            <h3 class="text-success">Diagnosis/Assessment</h3>
            <h4 class="text-primary">Patient: {{ $patient->lname }}, {{ $patient->fname }} {{ $patient->mname }}</h4>
        </div>
        <div id="formEdit" class="box-body disAble">
            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
            <input type="hidden" name="id" value="@if($patient->diagassess){{ $patient->diagassess->id }} @endif">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Summary of Assessment Findings:</label>
                            <textarea class="form-control" name="summary_assess" rows="2" required>@if($patient->diagassess) {{ $patient->diagassess->summary_assess }} @endif</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Diagnosis:</label>
                            <textarea class="form-control" name="diagnosis" rows="2" required>@if($patient->diagassess) {{ $patient->diagassess->diagnosis }} @endif</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <hr>
                        <label>Clinical Classification:</label>
                        <label class="radio-inline"><input type="radio" name="clinical_classification" value="1" required @if($patient->diagassess)@if($patient->diagassess->clinical_classification == 1)checked @endif @endif>Covid-19 Case</label>
                        <label class="radio-inline"><input type="radio" name="clinical_classification" value="0"  @if($patient->diagassess)@if($patient->diagassess->clinical_classification == 0)checked @endif @endif>Non-Covid-19 Case</label>
                    </div>
                    <div class="col-md-12 ifCovid hide">
                        <br>
                        <label>If Covid-19 Case:</label>
                        <label class="radio-inline"><input type="radio" name="if_covid" value="1" required @if($patient->diagassess)@if($patient->diagassess->if_covid == 1)checked @endif @endif>Suspected Cases</label>
                        <label class="radio-inline"><input type="radio" name="if_covid" value="0"  @if($patient->diagassess)@if($patient->diagassess->if_covid == 0)checked @endif @endif>Probable Case</label>
                        <label class="radio-inline"><input type="radio" name="if_covid" value="2"  @if($patient->diagassess)@if($patient->diagassess->if_covid == 2)checked @endif @endif>Confirmed Case</label>
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

