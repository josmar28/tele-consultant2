<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('public/img/dohro12logo2.png') }}">
    <meta http-equiv="cache-control" content="max-age=0" />
    <title>DOH CHD XII – Tele Consultation System</title>
    <!-- <title>{{ (isset($title)) ? $title : 'Referral System'}}</title> -->
    <!-- SELECT 2 -->
    <link href="{{ asset('public/plugin/select2/select2.min.css') }}" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/bootstrap-theme.min.css') }}" rel="stylesheet">

    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('public/plugin/Ionicons/css/ionicons.min.css') }}">

    <!-- Font awesome -->
    <link href="{{ asset('public/assets/fontawesome/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/fontawesome/css/fontawesome.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/fontawesome/css/brands.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/fontawesome/css/solid.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/fontawesome/css/v5-font-face.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/fontawesome/css/v4-font-face.css') }}" rel="stylesheet">
    <link href="{{ asset('public/plugin/select2/select2.min.css') }}" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="{{ asset('public/assets/css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('public/assets/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/assets/css/AdminLTE.min.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('public/assets/css/bootstrap-clockpicker.min.css') }}">
    <link href="{{ asset('public/plugin/datepicker/datepicker3.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/plugin/Lobibox/lobibox.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('public/plugin/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    <link href="{{ asset('public/plugin/daterangepicker_old/daterangepicker-bs3.css') }}" rel="stylesheet">

    <link href="{{ asset('public/plugin/table-fixed-header/table-fixed-header.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css"/>
    <title>
        @yield('title','Home')
    </title>

    @yield('css')
    <style>
        #zmmtg-root {
            display: block;
            transition: margin-left .5s;
        }
        body {
            background: url('{{ asset('public/img/backdrop.png') }}'), -webkit-gradient(radial, center center, 0, center center, 460, from(#ccc), to(#ddd));
        }
        .btnPlan {
            display: none;
            position: fixed;
            bottom: 120px;
            right: 18px;
            z-index: 99;
            font-size: 12px;
            border: none;
            outline: none;
            color: white;
            cursor: pointer;
            padding: 15px;
            border-radius: 1px;
        }
        .btnDiagnosis {
            display: none;
            position: fixed;
            bottom: 180px;
            right: 18px;
            z-index: 99;
            font-size: 12px;
            border: none;
            outline: none;
            color: white;
            cursor: pointer;
            padding: 15px;
            border-radius: 1px;
        }
        .btnCovid {
            display: none;
            position: fixed;
            bottom: 240px;
            right: 18px;
            z-index: 99;
            font-size: 12px;
            border: none;
            outline: none;
            color: white;
            cursor: pointer;
            padding: 15px;
            border-radius: 1px;
        }
        .btnClinical {
            display: none;
            position: fixed;
            bottom: 300px;
            right: 18px;
            z-index: 99;
            font-size: 12px;
            border: none;
            outline: none;
            color: white;
            cursor: pointer;
            padding: 15px;
            border-radius: 1px;
        }
        .btnDemo {
            display: none;
            position: fixed;
            bottom: 360px;
            right: 18px;
            z-index: 99;
            font-size: 12px;
            border: none;
            outline: none;
            color: white;
            cursor: pointer;
            padding: 15px;
            border-radius: 1px;
        }
        #myBtn {
            position: fixed;
            bottom: 54px;
            right: 18px;
            z-index: 99;
            font-size: 18px;
            border: none;
            outline: none;
            background-color: rgba(38, 125, 61, 0.92);
            color: white;
            cursor: pointer;
            padding: 15px;
            border-radius: 1px;
        }
        .btnSaveClinical {
            position: fixed;
            bottom: 120px;
            right: 18px;
            z-index: 99;
            font-size: 18px;
            border: none;
            outline: none;
            background-color: rgba(38, 125, 61, 0.92);
            color: white;
            cursor: pointer;
            padding: 15px;
            border-radius: 1px;
        }
        .btnSaveCovid {
            position: fixed;
            bottom: 120px;
            right: 18px;
            z-index: 99;
            font-size: 18px;
            border: none;
            outline: none;
            background-color: rgba(38, 125, 61, 0.92);
            color: white;
            cursor: pointer;
            padding: 15px;
            border-radius: 1px;
        }
        .btnSaveDemo {
            position: fixed;
            bottom: 120px;
            right: 18px;
            z-index: 99;
            font-size: 18px;
            border: none;
            outline: none;
            background-color: rgba(38, 125, 61, 0.92);
            color: white;
            cursor: pointer;
            padding: 15px;
            border-radius: 1px;
        }
        .btnSaveCovid {
            position: fixed;
            bottom: 120px;
            right: 18px;
            z-index: 99;
            font-size: 18px;
            border: none;
            outline: none;
            background-color: rgba(38, 125, 61, 0.92);
            color: white;
            cursor: pointer;
            padding: 15px;
            border-radius: 1px;
        }
        .btnSaveDiag {
            position: fixed;
            bottom: 120px;
            right: 18px;
            z-index: 99;
            font-size: 18px;
            border: none;
            outline: none;
            background-color: rgba(38, 125, 61, 0.92);
            color: white;
            cursor: pointer;
            padding: 15px;
            border-radius: 1px;
        }
        .btnSavePlan {
            position: fixed;
            bottom: 120px;
            right: 18px;
            z-index: 99;
            font-size: 18px;
            border: none;
            outline: none;
            background-color: rgba(38, 125, 61, 0.92);
            color: white;
            cursor: pointer;
            padding: 15px;
            border-radius: 1px;
        }
        #myBtn:hover {
            background-color: #555;
        }
        .select2 {
            width:100%!important;
        }
        label {
            padding: 0px;
        }
        .form-group {
            margin-bottom: 10px;
        }
        .sidenav {
          height: 100%;
          width: 0;
          position: fixed;
          z-index: 1;
          top: 0;
          left: 0;
          background-color: #fff;
          overflow-x: hidden;
          transition: 0.5s;
          padding-top: 60px;
        }

        .sidenav a {
          padding: 8px 8px 8px 32px;
          text-decoration: none;
          font-size: 25px;
          color: #818181;
          display: block;
          transition: 0.3s;
        }

        .sidenav a:hover {
          color: #f1f1f1;
        }

        .sidenav .closebtn {
          position: absolute;
          top: 0;
          right: 5px;
          font-size: 36px;
          margin-left: 50px;
        }

        @media screen and (max-height: 450px) {
          .sidenav {padding-top: 15px;}
          .sidenav a {font-size: 18px;}
        }
        /* width */
        ::-webkit-scrollbar {
          width: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
          background: #f1f1f1; 
        }
         
        /* Handle */
        ::-webkit-scrollbar-thumb {
          background: #888;
          border-radius: 10px;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
          background: #555; 
        }
    </style>
</head>

<body>
@if($role > 0)
<button id="myBtn" title="Teleconsultation forms"><i class="fas fa-file"></i></button>
<button type="button" class="btnDemo btn btn-success" onclick="showForm('demoDiv', 'btnSaveDemo')"> Demographic Profille</button>
<button type="button" class="btnClinical btn btn-success" onclick="showForm('cliDiv', 'btnSaveClinical')"> Clinical History and Physical Examination</button>
<button type="button" class="btnCovid btn btn-success" onclick="showForm('covDiv', 'btnSaveCovid')"> Covid-19 Screening</button>
<button type="button" class="btnDiagnosis btn btn-success" onclick="showForm('diagDiv', 'btnSaveDiag')"> Diagnosis/Assessment</button>
<button type="button" class="btnPlan btn btn-success" onclick="showForm('planDiv', 'btnSavePlan')">Plan of Management</button>
@endif
<input type="hidden" name="patient_id" value="{{ $patient->id }}">
<input type="hidden" name="demographic_id" value="@if($patient->demoprof){{ $patient->demoprof->id }} @endif">
<input type="hidden" name="clinical_id" value="@if($patient->clinical){{ $patient->clinical->id }} @endif">
<input type="hidden" name="covidassess_id" value="@if($patient->covidassess){{ $patient->covidassess->id }} @endif">
<input type="hidden" name="covidscreen_id" value="@if($patient->covidscreen){{ $patient->covidscreen->id }} @endif">
<input type="hidden" name="diagassess_id" value="@if($patient->diagassess){{ $patient->diagassess->id }} @endif">
<input type="hidden" name="planmanage_id" value="@if($patient->planmanage){{ $patient->planmanage->id }} @endif">
<div id="demoDiv" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav('demoDiv', 'btnSaveDemo')">&times;</a>
  <div class="">
        <div class="box-header with-border" style="background-color: #00a65a; color: white;">
            <h4 style="">Demographic Profile</h4>
        </div>
        <div class="box-body">
            @include('forms.demographic')
        </div>
    </div>
    <div class="">
        <div class="box-header with-border" style="background-color: #00a65a; color: white;">
            <div class="row">
                <div class="col-md-6">
                    <h4 style="">Patient Profile</h4>
                </div>
                <div class="col-md-6 form-inline">
                    <div class="form-group">
                        <label>Case #:</label>
                        <input type="text" class="form-control" value="{{ $case_no }}" name="case_no" readonly>
                    </div>
                </div>
            </div>
        </div>
        @include('forms.patientprof')
    </div>
</div>
<div id="cliDiv" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav('cliDiv', 'btnSaveClinical')">&times;</a>
    <div class="">
        <div class="box-header with-border" style="background-color: #00a65a; color: white;">
            <h4 style="">Clinical History</h4>
        </div>
        <div class="box-body">
            @include('forms.clinical')
        </div>
    </div>
</div>
<div id="covDiv" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav('covDiv', 'btnSaveCovid')">&times;</a>
  @include('forms.covid')
</div>
<div id="diagDiv" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav('diagDiv', 'btnSaveDiag')">&times;</a>
  @include('forms.diagnosis')
</div>
<div id="planDiv" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav('planDiv', 'btnSavePlan')">&times;</a>
  @include('forms.plan')
</div>

<!-- For either view: import Web Meeting SDK JS dependencies -->
<script src="https://source.zoom.us/2.2.0/lib/vendor/react.min.js"></script>
<script src="https://source.zoom.us/2.2.0/lib/vendor/react-dom.min.js"></script>
<script src="https://source.zoom.us/2.2.0/lib/vendor/redux.min.js"></script>
<script src="https://source.zoom.us/2.2.0/lib/vendor/redux-thunk.min.js"></script>
<script src="https://source.zoom.us/2.2.0/lib/vendor/lodash.min.js"></script>
<!-- For Component View -->
<script src="https://source.zoom.us/2.2.0/zoom-meeting-embedded-2.2.0.min.js"></script>

<!-- For Client View -->
<script src="https://source.zoom.us/zoom-meeting-2.2.0.min.js"></script>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- <script crossorigin src="https://unpkg.com/webex@^1/umd/webex.min.js"></script> -->
<!-- <script src="{{ asset('resources/views/doctors/scripts/webex_function.js') }}"></script> -->
<script src="{{ asset('public/assets/js/jquery.min.js?v='.date('mdHis')) }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('public/plugin/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('public/assets/js/bootstrap-clockpicker.min.js') }}"></script>
<script src="{{ asset('public/assets/js/jquery.form.min.js') }}"></script>
<script src="{{ asset('public/assets/js/jquery-validate.js') }}"></script>
<script src="{{ asset('public/assets/js/bootstrap.min.js') }}"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="{{ asset('public/assets/js/ie10-viewport-bug-workaround.js') }}"></script>
<script src="{{ asset('public/assets/js/script.js') }}?v=1"></script>

<script src="{{ asset('public/plugin/Lobibox/Lobibox.js') }}?v=1"></script>
<script src="{{ asset('public/plugin/select2/select2.min.js') }}?v=1"></script>

<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('public/plugin/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}?v=1"></script>

<script src="{{ url('public/plugin/daterangepicker_old/moment.min.js') }}"></script>
<script src="{{ url('public/plugin/daterangepicker_old/daterangepicker.js') }}"></script>

<script src="{{ asset('public/assets/js/jquery.canvasjs.min.js') }}?v=1"></script>

<!-- TABLE-HEADER-FIXED -->
<script src="{{ asset('public/plugin/table-fixed-header/table-fixed-header.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
@include('others.scripts.form')
@yield('js')
</body>
</html>