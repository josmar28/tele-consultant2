<?php
    $user = Session::get('auth');
    $t = '';
    $dept_desc = '';
    if($user->level=='doctor')
    {
        $t='Dr.';
    }else if($user->level=='patient'){
        $dept_desc = ' / Patient';
    }
?>

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
    <link href="{{ asset('public/assets/fontawesome/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/fontawesome/css/fontawesome.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/fontawesome/css/brands.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/fontawesome/css/solid.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/fontawesome/css/v5-font-face.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/fontawesome/css/v4-font-face.css') }}" rel="stylesheet">
    <link href="{{ asset('public/plugin/select2/select2.min.css') }}" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/bootstrap-theme.min.css') }}" rel="stylesheet">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('public/plugin/Ionicons/css/ionicons.min.css') }}">

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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-countdown/2.0.2/jquery.countdown.css" rel="stylesheet"/>
    <link href="{{ asset('public/plugin/fullcalendar/main.css') }}" rel="stylesheet">
    <title>
        @yield('title','Home')
    </title>

    @yield('css')
    <style>
        body {
            background: url('{{ asset('public/img/backdrop.png') }}'), -webkit-gradient(radial, center center, 0, center center, 460, from(#ccc), to(#ddd));
        }
        .loading {
            background: rgba(255, 255, 255, 0.6) url('{{ asset('public/img/spin.gif')}}') no-repeat center;
            position:fixed;
            width:100%;
            height:100%;
            top:0px;
            left:0px;
            z-index:999999999;
            display: none;
        }

        #loading {
          position: fixed;
          top: 0; left: 0; z-index: 9999;
          width: 100vw; height: 100vh;
          background: rgb(89,171,145,0.3);
          opacity: 0.5;
          transition: opacity 0.2s;
        }

        #loading svg {
          position: absolute;
          top: 30%; left: 50%;
          transform: translate(-50%);
        }

        #myBtn {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 30px;
            z-index: 99;
            font-size: 18px;
            border: none;
            outline: none;
            background-color: rgba(38, 125, 61, 0.92);
            color: white;
            cursor: pointer;
            padding: 15px;
            border-radius: 4px;
        }
        #myBtn:hover {
            background-color: #555;
        }
        .select2 {
            width:100%!important;
        }
        #munMenu {
            max-height: 280px;
            overflow-y: auto;
        }
        .required-field:after {
            color: red;
            content:"*";
        }
        #notificationBar {
            width: 450px;
            height: 400px;
            overflow: auto;
            overflow-x: hidden;
        }
        .chip {
          display: inline-block;
          padding: 0 25px;
          height: 40px;
          font-size: 12px;
          line-height: 40px;
          border-radius: 25px;
          background-color: #f1f1f1;
          cursor: pointer;
          box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);
        }
        .chip:hover {
            background: #999;
            color: white;
        }
        .actColor {
            background: #e08e0b;
            color: white
        }
        .disAble {
            pointer-events: none;
        }
        /* width */
        ::-webkit-scrollbar {
          width: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
          background: #eee; 
        }
         
        /* Handle */
        ::-webkit-scrollbar-thumb {
          background: #ccc; 
          border-radius: 10px;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
          background: #555; 
        }
    </style>
</head>

<body>

<!-- Fixed navbar -->

<nav class="navbar navbar-default fixed-top" >
    <div class="header" style="background-color:#2F4054;padding:10px;">
        <div>
            <div class="col-md-6">
                <div class="pull-left">
                    <span class="title-info">Welcome,</span> <span class="title-desc">{{ $t }} {{ $user->fname }} {{ $user->lname }} {{ $dept_desc }}</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="pull-right">
                    @if($user->level != 'superadmin' && $user->level != 'patient')
                    <span class="title-info">Facility:</span> <span class="title-desc">{{ $user->facility->facilityname }}</span>
                    @endif
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="header" style="background-color:#59ab91;padding:10px;">
        <div class="container">
            <img src="{{ asset('public/img/header.png') }}" class="img-responsive" />
        </div>
    </div>
    <div class="container-fluid" >
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse" style="font-size: 13px;">
            <ul class="nav navbar-nav">
                @if($user->level=='superadmin')
                <li><a href="{{ asset('superadmin') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-book"></i>&nbsp; Library <i class="fas fa-caret-down"></i></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-submenu">
                            <a href="{{ asset('/diagnosis') }}" class="dropdown-toggle" aria-haspopup="true" aria-expanded="false"> <span class="nav-label"><i class="fas fa-chart-line"></i>&nbsp; Diagnosis</span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ asset('/diagnosis-main-category') }}"><i class="fas fa-th-large"></i>&nbsp; Main Category</a></li>
                                <li><a href="{{ asset('/diagnosis-sub-category') }}"><i class="fas fa-th"></i>&nbsp; Sub Category</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a href="{{ asset('/drugsmeds') }}" class="dropdown-toggle" aria-haspopup="true" aria-expanded="false"> <span class="nav-label"><i class="fas fa-pills"></i>&nbsp; Drugs/Meds</span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ asset('drugsmeds/unitofmes') }}"><i class="fas fa-balance-scale-right"></i>&nbsp; Unit of Measure</a></li>
                                <li><a href="{{ asset('drugsmeds/subcategory') }}"><i class="fas fa-th"></i>&nbsp; Sub Category</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu"><a href="#"><i class="fas fa-chart-area"></i>&nbsp; Demographic</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ asset('provinces') }}"><i class="fa fa-hospital-o"></i>&nbsp; Province</a></li>
                                <li class="dropdown-submenu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="nav-label"><i class="fa fa-hospital-o"></i>&nbsp;&nbsp;&nbsp; Municipality</span></a>
                                    <ul class="dropdown-menu" id="munMenu">
                                        @foreach(\App\Province::where('reg_psgc', '120000000')->get() as $prov)
                                            <li><a href="{{ url('municipality').'/'.$prov->prov_psgc.'/'.$prov->prov_name }}">{{ $prov->prov_name }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><a href="{{ asset('document/type') }}"><i class="fa fa-file-word"></i>Document Type</a></li>
                        <li><a href="{{ asset('superadmin/lab_request') }}"><i class="fa fa-vial"></i>Lab Request</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cogs"></i>&nbsp; Manage <i class="fas fa-caret-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ asset('/users') }}"><i class="fas fa-users"></i>&nbsp; Users</a></li>
                        <li><a href="#"><i class="fas fa-list-ul"></i>&nbsp; Role/Permission</a></li>
                        <li><a href="{{ asset('facilities') }}"><i class="fas fa-hospital-alt"></i>&nbsp;&nbsp;Facilities</a></li>
                        <li><a href="{{ asset('doctor-category') }}"><i class="fas fa-stream"></i>&nbsp;&nbsp;Doctor Category</a></li>
                        <li><a href="{{ asset('superadmin/feedback') }}"><i class="fas fa-list"></i>&nbsp;&nbsp;Feedback List</a></li>
                    </ul>                       
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="far fa-newspaper"></i> Reports <i class="fas fa-caret-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="far fa-file"></i>&nbsp; Monitoring Report</a></li>
                        <li><a href="{{ asset('audit-trail') }}"><i class="fas fa-user-clock"></i>&nbsp; User Logs</a></li>
                        <li><a href="{{ asset('superadim/audit-trail') }}"><i class="fa-solid fa-arrows-rotate"></i>&nbsp; Audit Trail</a></li>
                        <li><a href="{{ asset('feedback') }}"><i class="fas fa-comments"></i>&nbsp; Feedback</a></li>
                    </ul>
                </li>
                @endif
                <!-- for admin -->
                @if($user->level=='admin')
                <li><a href="{{ asset('admin') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cogs"></i>&nbsp; Manage <i class="fas fa-caret-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ asset('/admin-doctors') }}"><i class="fas fa-user-md"></i>&nbsp; Doctors</a></li>
                        <li><a href="{{ asset('/admin-facility') }}"><i class="fas fa-hospital"></i>&nbsp; Facility</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cogs"></i>&nbsp; Settings <i class="fas fa-caret-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="fas fa-key"></i> Change Password</a></li>
                        <li><a class="refTok" href="https://zoom.us/oauth/authorize?response_type=code&client_id={{env('ZOOM_CLIENT_ID')}}&redirect_uri={{env('ZOOM_REDIRECT_URL')}}" target="_blank"><label class="countdowntoken"></label><i data-toggle="tooltip" title="Access token is use to generate zoom meeting informations like meeting link, meeting id, password etc. Click to Refresh Token" class="fa-solid fa-circle-question"></i></a></li>
                    </ul>
                </li>
                @endif
                <!-- for doctors -->
                @if($user->level=='doctor')
                <li><a href="{{ asset('doctor') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                <li><a href="{{ asset('/teleconsultation') }}"><i class="fas fa-video"></i> Teleconsultation</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-list-alt"></i>&nbsp; Management <i class="fas fa-caret-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ asset('doctor/patient/list') }}"><i class="fas fa-head-side-mask"></i>&nbsp; Patients</a></li>
                    <li><a href="{{ asset('doctor/prescription') }}"><i class="fas fa-prescription"></i>&nbsp; Prescription</a></li>
                    <!-- <li><a href="{{ asset('doctor/order') }}"><i class="fas fa-notes-medical"></i>&nbsp; Doctor Orders</a></li> -->
                        <li><a href="{{ asset('feedback/view') }}"><i class="fas fa-list"></i> Feedback List</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-paste"></i>&nbsp; Reports <i class="fas fa-caret-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="fas fa-notes-medical"></i>&nbsp;Doctor Orders</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cogs"></i>&nbsp; Settings <i class="fas fa-caret-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="fas fa-key"></i> Change Password</a></li>
                    </ul>
                </li>
                @endif
                @if($user->level=='patient')
                <li><a href="{{ asset('patient') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                <li><a href="{{ asset('/teleconsultation') }}"><i class="fas fa-video"></i> Teleconsultation</a></li>
                <li><a href="#"><i class="fas fa-notes-medical"></i> Medical Records & Attachments</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cogs"></i>&nbsp; Settings <i class="fas fa-caret-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="fas fa-key"></i> Change Password</a></li>
                    </ul>
                </li>
                @endif
                <!-- For doctors and rhu -->
                @if($user->level=='doctor' || $user->level=='admin')
                <li><a href="{{ asset('doctor/issuesconcern') }}"><i class="fas fa-notes-medical"></i> Issues and Concern</a>
                </li>
                <li>
                  <a href="#feedbackModal" data-toggle="modal" data-link="{{ asset('feedback') }}" id="feedback" title="Write a feedback" data-trigger="focus" data-container="body"  data-placement="top" data-content="Help us improve our system by just sending feedback.">
                        <i class="fa fa-sign-out"></i> Feedback
                    </a>
                </li>
              
                @endif
                <li><a href="{{ asset('logout') }}"><i class="fas fa-sign-out-alt"></i> Log out</a></li>
            </ul>
            @if($user->level=='doctor')
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                  <a title="Notification" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-bell"></i> <span class="badge" id="totalReq"></span></a>
                  <ul id="notificationBar" class="dropdown-menu notify-drop" onclick="event.stopPropagation()">
                    <div class="notify-drop-title">
                        <div class="row text-center">
                            <div class="col-md-12">
                                <div id="chipCon" class="chip actColor">
                                  Consultation(<b id="totReqTel"></b>)
                                </div>
                                <div id="chipPat" class="chip">
                                  Patient(<b id="totReqPat"></b>)
                                </div>
                                <div id="chipReq" class="chip">
                                  Accepted<b id="totRequest"></b>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="drop-content">
                        <div id="contentCon" class="row" style="margin: 10px;">
                        </div>
                        <div id="contentPat" class="row hide" style="margin: 10px;">
                        </div>
                        <div id="contentReq" class="row hide" style="margin: 10px;">
                        </div>
                    </div>
                  </ul>
                </li>
            </ul>
            @endif
        </div><!--/.nav-collapse -->
    </div>
</nav>
<div id="app">
    <main class="py-4">
        @include('modal.others.layoutModal')
        @include('modal.others.notifModal')
        @yield('content')
        <div class="loading"></div>
    </main>
</div>

<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-arrow-up"></i></button>
<footer class="footer">
    <div class="container">
        <p class="pull-right">All Rights Reserved {{ date("Y") }} | Version 1.0</p>
    </div>
</footer>
<div class="modal fade" id="webex_modal" role="dialog" aria-labelledby="webex_modal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <form id="webex_form" method="POST">
        {{ csrf_field() }}
        <small>Get your personal access webex token </small><a href="https://developer.webex.com/docs/getting-started" target="_blank">here</a><br>
        <div class="form-group">
            <label>Your Personal Access Token:</label>
            <input type="password" class="form-control" value="" name="webextoken" placeholder="Paste here..." required>
        </div>
        <small style="color: red;">Note: Please change your webex token every 12 hours.</small>
      <div class="modal-footer">
        <button type="submit" class="btnSaveWebex btn btn-success"><i class="fas fa-check"></i> Save</button>
    </form>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
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
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
<script src="https://cdn.rawgit.com/hilios/jQuery.countdown/2.2.0/dist/jquery.countdown.min.js"></script>
<script src="{{ asset('public/plugin/fullcalendar/main.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
@yield('js')
@include('others.scripts.app')
@include('others.scripts.notifscrpt')
</body>
</html>