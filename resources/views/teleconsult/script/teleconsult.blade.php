<script>
    var patients = {!! json_encode($patients->toArray()) !!};
    var docorder = {!! json_encode($docorder->toArray()) !!};
    var currentFile = null;
    var last_update = "{!! $zoomtoken !!}";
    var zoomtoken = last_update == 'none' ? '' : new Date(last_update);
    var expirewill = last_update != 'none' ? zoomtoken.setHours(zoomtoken.getHours() + 1) : '';
    var interval;
    Dropzone.autoDiscover = false,
    $("#labReqFile").dropzone({
      addRemoveLinks: true,
      maxFiles: 4,
      parallelUploads: 10000,
      uploadMultiple: true,
      autoProcessQueue: false,
      acceptedFiles: ".pdf,.jpg,.png",
      url: "{{asset('/lab-request-doctor-order')}}",
      dictDefaultMessage: 'Click or drop files here.',
      init: function() {
        var myDropzone = this;

        // Update selector to match your button
        $("#buttonLabReq").click(function (e) {
            e.preventDefault();
            myDropzone.processQueue();
        });

        this.on('sending', function(file, xhr, formData) {
            // Append all form inputs to the formData Dropzone will POST
            var data = $('#labrequest_form').serializeArray();
            $.each(data, function(key, el) {
                formData.append(el.name, el.value);
            });
        });
        this.on("success", function(file, responseText) {
            setTimeout(function(){
                window.location.reload(false);
            },500);
        });
      }   
    });
    $('.countdowntoken').countdown(expirewill, function(event) {
        if(event.strftime('%H:%M:%S') == '00:00:00') {
            if(last_update == 'none') {
                $(this).html('Facility don\'t have access token.');
                $('.refTok').html('Please Contact Administrator');      
                $('#acceptBtn').prop("disabled", true);
            } else {
              $(this).html('Access token was expired. Please contact administrator ');
              $('#acceptBtn').prop("disabled", true);
            }
        } else {
            $(this).html('Access token will expire in '+ event.strftime('%H:%M:%S'));
            $('#acceptBtn').prop("disabled", false);
        }
    });
	$(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();   
		var date = new Date();
		var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        $('#consolidate_date_range').daterangepicker({
            minDate: today,
        });
        $('#consolidate_date_range_past').daterangepicker({
            maxDate: today,
            ranges: {
               'Today': [moment(), moment()],
               'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
               'Last 7 Days': [moment().subtract(6, 'days'), moment()],
               'Last 30 Days': [moment().subtract(29, 'days'), moment()],
               'This Month': [moment().startOf('month'), moment().endOf('month')],
               'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        });
        $('.daterange').daterangepicker({
            minDate: today,
            "drops": "up",
            "singleDatePicker": true
        });
        $('#consolidate_date_range_req').daterangepicker();
       $('.clockpicker').clockpicker({
       		donetext: 'Done',
       		twelvehour: true,
            placement: 'top',
            align: 'left',
            afterDone: function() {
                validateTIme();
            }
       });
    });
    $('.daterange').on('apply.daterangepicker', function(ev, picker) {
      validateTIme();
    });
    @if(Session::get('action_made'))
        Lobibox.notify('success', {
            title: "",
            msg: "<?php echo Session::get('action_made'); ?>",
            size: 'mini',
            rounded: true
        });
        <?php
            Session::put("action_made",false);
        ?>
    @endif
    @if(Session::get('delete_action'))
        Lobibox.notify('error', {
            title: "",
            msg: "<?php echo Session::get('delete_action'); ?>",
            size: 'mini',
            rounded: true
        });
        <?php
            Session::put("delete_action",false);
        ?>
    @endif
    function validateTIme() {
        var url = "{{ url('/validate-datetime') }}";
        var date = $("input[name=date_from]").val();
        var time = $("input[name=time]").val();
        var doctor_id = $("select[name=doctor_id] option:checked").val();
        var duration = $("select[name=duration] option:checked").val();
        $.ajax({
            url: url,
            type: 'GET',
            async: false,
            data: {
                date: date,
                time: time,
                duration: duration,
                doctor_id: doctor_id
            },
            success : function(data){
                if(data == 'Not valid') {
                    Lobibox.notify('error', {
                        title: "Schedule",
                        msg: "Please set a schedule before 3 hours of Teleconsultation",
                        size: 'normal',
                        rounded: true
                    });
                    $("input[name=time]").val('');
                }
                else if(data > 0) {
                    Lobibox.notify('error', {
                        title: "Schedule",
                        msg: "Schedule is not available!",
                        size: 'normal',
                        rounded: true
                    });
                    $("input[name=time]").val('');
                }
            }
        });
    }
	$('.select_phic').on('change',function(){
        var status = $(this).val();
        if(status!='none'){
            $('.phicID').attr('disabled',false);
        }else{
            $('.phicID').val('').attr('disabled',true);
        }
    });
    $('#meeting_form').on('submit',function(e){
		e.preventDefault();
        $('.btnSave').html('<i class="fa fa-spinner fa-spin"></i> Saving...');
        $(".loading").show();
		$('#meeting_form').ajaxSubmit({
            url:  "{{ url('/add-meeting') }}",
            type: "GET",
            success: function(data){
                setTimeout(function(){
                    window.location.reload(false);
                },500);
            },
            error: function (data) {
                $(".loading").hide();
                $('.btnSave').html('<i class="fas fa-check"></i> Save');
                Lobibox.notify('error', {
                    title: "Schedule",
                    msg: "Something went wrong, Please try again.",
                    size: 'normal',
                    rounded: true
                });
            },
        });
	});

    function getMeeting(id, join) {
        var url = "{{ url('/meeting-info') }}";
        var tmp;
        $.ajax({
            async: true,
            url: url,
            type: 'GET',
            data: {
                meet_id: id
            },
            success : function(data){
                var val = JSON.parse(data);
                var today = moment(new Date());
                let diff = today.diff(moment(val['date_meeting']), 'days');
                if(val) {
                    var time = moment(val['date_meeting']).format('MMMM D, YYYY')+' '+moment(val['from_time'], "HH:mm:ss").format('h:mm A')+' - '+moment(val['to_time'], "HH:mm:ss").format('h:mm A');
                    var mname = val['mname'] ? val['mname'] : '';
                    $('#myrequest_modal').modal('hide');
                    $('#info_meeting_modal').modal('show'); 
                    $('#timeConsult').html('Date & Time: ' +time);
                    $('#myInfoLabel').html(val['title']);
                    $('#meetlink').html(val['web_link']);
                    $('#meetnumber').html(val['meeting_id']);
                    $('#patientName').val(val['lname']+", "+val['fname']+" "+mname);
                    $('#meetPass').html(val['password']);
                    $('#meetKey').html(val['host_key']);
                    $('.btnMeeting').val(val['meetID']);
                    if(diff >= 0) {
                         $('.btnMeeting').prop('disabled', true);
                         $('.btnMeeting').html('Consultation complete');
                    } else if(join == 'no') {
                        $('.btnMeeting').prop('disabled', false);;
                        $('.btnMeeting').html('<i class="fas fa-play-circle"></i> Start Consultation');
                    } else {
                         $('.btnMeeting').prop('disabled', false);;
                        $('.btnMeeting').html('<i class="fas fa-play-circle"></i> Join Consultation');
                    }
                }
            }
        });
    }

    function copyToClipboard(element) {
      var $temp = $("<input>");
      $("body").append($temp);
      $temp.val($(element).text()).select();
      document.execCommand("copy");
      $temp.remove();
      Lobibox.notify('success', {
            title: "",
            msg: "copy to clipboard success",
            size: 'mini',
            rounded: true
        });
    }

    function startMeeting(id) {
        var url = "{{ url('/start-meeting') }}";
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            async: false,
            url: url+"/"+id,
            type: 'GET',
            success : function(data){
                window.open(url+"/"+id,'_blank')
            }
        });
    }

    $( ".btnMeeting" ).click(function() {
        startMeeting($(this).attr("value"));
    });

    function getEmail(email, fname, mname, lname, id) {
        $('#myModalMeetingLabel').html('Schedule Teleconsultation for ' + fname +' ' + mname + ' ' + lname);
        $('input[name=email]').val(email);
        $('input[name=patient_id]').val(id);

    }

    $('#schedule_form').on('submit',function(e){
        e.preventDefault();
        $(".loading").show();
        $('#schedule_form').ajaxSubmit({
            url:  "{{ url('/sched-pending') }}",
            type: "GET",
            success: function(data){
                setTimeout(function(){
                    window.location.reload(false);
                },500);
            },
            error: function (data) {
                $(".loading").hide();
                Lobibox.notify('error', {
                    title: "Schedule",
                    msg: "Something went wrong, Please try again.",
                    size: 'normal',
                    rounded: true
                });
            },
        });
    });

    $('.selectDoctor').on('change',function(){
        var status = $(this).val();
        if(status > 0){
            $('#scheduleMeeting').removeClass('hide');
        }else{
            $('#scheduleMeeting').addClass('hide');
        }
    });

    function getSchedule(id, fname, mname, lname) {
        $('#myModalMeetingLabel').html('Update Schedule Teleconsultation for ' + fname +' ' + mname + ' ' + lname);
        var url = "{{ url('/admin-patient-meeting-info') }}";
        $.ajax({
            async: true,
            url: url,
            type: 'GET',
            data: {
                meet_id: id
            },
            success : function(data){
                var val = JSON.parse(data);
                $("[name=doctor_id]").select2().select2('val', val.doctor_id);
                $('[name=patient_id]').val(val.patient_id);
                $('[name=title]').val(val.title);
                $('[name=date_from]').val(val.datefrom);
                $('[name=time]').val(val.time);
                $('[name=duration]').val(val.duration);
                $('[name=email]').val(val.email);
                $("input[name=sendemail][value='"+val.sendemail+"']").prop("checked",true);
                $('[name=meeting_id]').val(val.id);
                if(val.meet_id) {
                    $('#saveBtn').addClass('hide');
                    $('#cancelBtn').addClass('hide');
                    $('#meetingInfo').addClass('disAble');
                }
            }
        });
    }

    $('#meeting_modal').on('hidden.bs.modal', function () {
        $("[name=doctor_id]").select2().select2('val', '');
        $('[name=patient_id]').val('');
        $('[name=title]').val('');
        $('[name=date_from]').val('');
        $('[name=time]').val('');
        $('[name=duration]').val('');
        $('[name=email]').val('');
        $("input[name=sendemail][value='true']").prop("checked",true);
        $('[name=meeting_id]').val('');
        $('#saveBtn').removeClass('hide');
        $('#cancelBtn').removeClass('hide');
        $('#meetingInfo').removeClass('disAble');
    });

    function infoMeeting(id, meet_id) {
        var url = "{{ url('/get-pending-meeting') }}";
        $.ajax({
            async: false,
            url: url+"/"+id,
            type: 'GET',
            success : function(data){
                var mname = data.mname ? data.mname : '';
                var patient = data.patient.fname + ' ' + mname + ' ' + data.patient.lname;
                var encoded = data.encoded.fname + ' ' + data.encoded.mname + ' ' + data.encoded.lname;
                var fac = data.encoded.facility.facilityname;
                var requestdate = moment(data.created_at).format('MMMM Do YYYY, h:mm:ss a');
                $('#req_meeting_id').val(data.id);
                $('#txtEncoded').html(encoded);
                $('#req_fac').html('Facility: ' + fac);
                $('#txtreqDate').html(requestdate);
                $('#req_patient').val(patient);
                $('#req_title').val(data.title);
                if(meet_id > 0) {
                    getMeeting(meet_id, 'no');
                } else {
                    $('#tele_request_modal').modal('show');
                }
            }
        });
    }
    var action;
    $( ".btnSave" ).click(function() {
        action = $(this).attr("value");
    });
    $('#accept_decline_form').on('submit',function(e){
        var url = "{{ url('/accept-decline-meeting') }}";
        var id = $('#req_meeting_id').val();
        e.preventDefault();
        $(".loading").show();
        $('#accept_decline_form').ajaxSubmit({
            url:  url+"/"+id,
            type: "POST",
            data: {
                action: action
            },
            success: function(data){
                // setTimeout(function(){
                //     window.location.reload(false);
                // },500);
            },
            error: function (data) {
                $('.btnSave').html('<i class="fas fa-check"></i> Save');
                $(".loading").hide();
                Lobibox.notify('error', {
                    title: "Schedule",
                    msg: "Something went wrong, Please try again.",
                    size: 'mini',
                    rounded: true
                });
            },
        });
    });
    $( ".selectFacility" ).change(function() {
        var id = $('.selectFacility').val();
        if(id > 0) {
            $('#catField').removeClass('hide');
        }
    });
    $( ".selectCat" ).change(function() {
        var id = $('.selectFacility').val();
        var cat_id = $(this).val();
        var url = "{{ url('/get-doctors-facility') }}";
        $.ajax({
            async: true,
            url: url,
            type: 'GET',
            data: {
                fac_id: id,
                cat_id: cat_id
            },
            success : function(data){
                $('.selectDoctor').empty();
                var val = JSON.parse(data);
                if(val.length > 0) {
                    $(".selectDoctor").append('<option selected>Select Doctor</option>').change();
                    $.each(val,function(key,value){
                        $('.selectDoctor').append($("<option/>", {
                           value: value.id,
                           text: value.lname + ', ' + value.fname + ' ' + value.mname
                        }));
                    });
                    $('#scheduleMeeting').removeClass('hide');
                } else {
                    Lobibox.notify('error', {
                        title: "Schedule",
                        msg: "No doctors found in this category",
                        size: 'normal',
                        rounded: true
                    });
                }
            }
        });
    });

    $('#tele_form').on('submit',function(e){
        e.preventDefault();
        $('.btnSavePend').html('<i class="fa fa-spinner fa-spin"></i> Saving...');
        // $(".loading").show();
        $('#tele_form').ajaxSubmit({
            url:  "{{ url('/sched-pending') }}",
            type: "GET",
            success: function(data){
                setTimeout(function(){
                    window.location.reload(false);
                },500);
            },
            error: function (data) {
                $('.btnSavePend').html('<i class="fas fa-check"></i> Save');
                $(".loading").hide();
                Lobibox.notify('error', {
                    title: "Schedule",
                    msg: "Something went wrong, Please try again.",
                    size: 'mini',
                    rounded: true
                });
            },
        });
    });

    $( "#patient_id" ).change(function() {
        var id = $(this).val();
        var email ='';
        const edit = [];
        $.each(patients, function(key, value) {
            if(value.id == id) {
                email = value.email
            }
        });
        $("input[name=email]").val(email);
    });
    
    $('body').on('click','.btn-issue-referred',function(){
        var meet_id = $(this).data('meet_id'); 
        var issue_from = $(this).data('issue_from');
        var user_facility_id = "<?php echo \Illuminate\Support\Facades\Session::get('auth')->facility_id; ?>";

        if(user_facility_id == issue_from)
        $(".issue_footer").remove();

        $('#issue_meeting_id').val(meet_id);
        $("#issue_and_concern_body").html("Loading....");
        var url = "<?php echo asset('issue/concern').'/'; ?>"+meet_id+"/"+issue_from; 
        $.get(url,function(data){
            setTimeout(function(){
                $("#issue_and_concern_body").html(data);
            },500);
        });
    });

    $('.btn-issue-incoming').on('click',function () {
        $(".issue_footer").remove();
        var meet_id = $(this).data('meet_id'); 
        var issue_from = $(this).data('issue_from');
        $("#issue_and_concern_body").html("Loading....");
        var url = "<?php echo asset('issue/concern').'/'; ?>"+meet_id+"/"+issue_from; 
        $.get(url,function(data){
            setTimeout(function(){
                $("#issue_and_concern_body").html(data);
            },500);
        });
    });

    $('#sendIssue').submit(function (e) {
        e.preventDefault();
        var issue_message = $("#issue_message").val();
        $("#issue_message").val('').attr('placeholder','Sending...');
        $.ajax({
            url: "{{ url('issue/concern/submit') }}",
            type: 'post',
            data: {
                _token : "{{ csrf_token() }}",
                issue: issue_message,
                meeting_id : $("#issue_meeting_id").val()
            },
            success: function(data) {
                $("#issue_and_concern_body").append(data);
                $("#message").val('').attr('placeholder','Type a message for your issue and concern regarding your referral..');
            }
        });
    });

    function getDataDocOrder(id, fname, mname, lname, meetid, patientid) {
        // $("#deleteBtn").removeClass("hide");
        $("#doctororder_id").val(id);
        $("#doctororder_meet_id").val(meetid);
        $("#patientid").val(patientid);
        $("#patient_name").val(fname + ' ' + mname + ' ' + lname);
        const edit = [];
        $.each(docorder, function(key, value) {
            if(value.id == id) {
                edit.push(value);
            }
        });
        if(edit.length > 0) {
            var labreq = edit[0].labrequestcodes.split(',');
            var img = edit[0].imagingrequestcodes.split(',');
            $('#patientid').val(edit[0].patientid).change();
            $('#labrequestcodes').val(labreq).change();
            $('#imagingrequestcodes').val(img).change();
            $('textarea[name=alertdescription]').append(edit[0].alertdescription);
            $('textarea[name=treatmentplan]').append(edit[0].treatmentplan);
            $('textarea[name=remarks]').append(edit[0].remarks);
        }
    }

    $('#docorder_modal').on('hidden.bs.modal', function () {
        // $("#deleteBtn").addClass("hide");
        $('#labrequestcodes').val([]).change();
        $('#imagingrequestcodes').val([]).change();
        $('textarea[name=alertdescription]').append('');
        $('textarea[name=treatmentplan]').append('');
        $('textarea[name=remarks]').append('');
    });

    $('#docorder_form').on('submit',function(e){
        e.preventDefault();
        $(".loading").show();
        var labreq = $("#labrequestcodes").val();
        var img = $("#imagingrequestcodes").val();
        $('#docorder_form').ajaxSubmit({
            url:  "{{ url('/docorder-store') }}",
            type: "POST",
            data: {
                labrequestcodes: labreq,
                imagingrequestcodes: img
            },
            success: function(data){
                setTimeout(function(){
                    window.location.reload(false);
                },500);
            },
            error : function(data){
                $(".loading").hide();
                Lobibox.notify('error', {
                    title: "",
                    msg: "Something Went Wrong. Please Try again.",
                    size: 'mini',
                    rounded: true
                });
            }
        });
    });

    function getDocorder(docorderid, fname, mname, lname, patid) {
        var url = "{{ url('/doctor-order-info') }}";
        $.ajax({
            async: true,
            url: url,
            type: 'GET',
            data: {
                docorderid: docorderid
            },
            success : function(data){
                var val = data.docorder;
                var labs = data.labreq;
                if(labs.length > 0) {
                    var html = '';
                    $.each( labs, function( key, value ) {
                        var files = "{{asset('public') }}"+"/"+ value.filepath;
                        html +='<a href="'+files+'" class="list-group-item">'+value.filename+'.'+value.extensionname+'</a>';
                    });
                    $('#listLabreq').html(html);
                }
                if(!val) {
                    Lobibox.notify('info', {
                    title: "",
                    msg: "Consultation doesn't have Doctor Order.",
                    size: 'mini',
                    rounded: true
                });
                } else {
                    var labreq = val.labrequestcodes.split(',');
                    var img = val.imagingrequestcodes.split(',');
                    $('#labrequestcodeslab').val(labreq).change();
                    $('#imagingrequestcodeslab').val(img).change();
                    $("#patient_name_lab").val(fname + ' ' + mname + ' ' + lname);
                    $("input[name=doctororder_id]").val(val.id);
                    $("input[name=doctororder_patient_id]").val(patid);
                    $('#labrequest_modal').modal('show');
                }

            },
            error : function(data){
                $(".loading").hide();
                Lobibox.notify('error', {
                    title: "",
                    msg: "Something Went Wrong. Please Try again.",
                    size: 'mini',
                    rounded: true
                });
            }
        });

    }

    function getattachment(docorderid) {
        var url = "{{ url('/doctor-order-info') }}";
        $.ajax({
            async: true,
            url: url,
            type: 'GET',
            data: {
                docorderid: docorderid
            },
            success : function(data){
                var val = data.docorder;
                var labs = data.labreq;
                if(labs.length > 0) {
                    var html = '';
                    $.each( labs, function( key, value ) {
                        var files = "{{asset('public') }}"+"/"+ value.filepath;
                        html +='<a href="'+files+'" class="list-group-item">'+value.filename+'.'+value.extensionname+'</a>';
                    });
                    $('#listAttachment').html(html);
                }
                else {
                    var html = '<div class="text-center list-group-item"><p>No attachments found.</p></div>'
                    $('#listAttachment').html(html);
                }

            },
            error : function(data){
                $(".loading").hide();
                Lobibox.notify('error', {
                    title: "",
                    msg: "Something Went Wrong. Please Try again.",
                    size: 'mini',
                    rounded: true
                });
            }
        });

    }
    var meeting_id;
    var docorderid;
    var backtb;
    var started;
    function telDetail(id, view, tab, docid, details, backtab) {
        backtb = backtab ? backtab : backtb;
        $(".btnBack").attr("href", backtb);
        $(".btnBack").removeClass('hide');
        info = details ? JSON.parse(details) : info;
        $('#chiefCom'+id).html('Chief Complaint: ' + info['title']);
        $('#chiefDate'+id).html('Date:' +moment(info['date_meeting']).format('MMMM D, YYYY'));
        $('#chiefTime'+id).html('Time:' +moment(info['from_time'], "HH:mm:ss").format('h:mm A'));
        $('#chiefType'+id).html('Type of Consultation: ' +info['pendmeet']['telecategory']['category_name']);
        docorderid = docid ? docid : docorderid;
        var url = "{{ url('/tele-details') }}";
        view = view ? view : 'demographic';
        tab = tab ? tab : 'patientTab';
        meeting_id = id ? id : meeting_id;
        var urlmet = "{{ url('/meeting-info') }}";
        $('#'+tab+id).html('loading...');
        $.ajax({
            async: true,
            url: urlmet,
            type: 'GET',
            data: {
                meet_id: meeting_id,
            },
            success : function(data){
                var val = JSON.parse(data);
                started = val['caseNO'];
                if(val) {
                    var time = moment(val['date_meeting']).format('MMMM D, YYYY')+' '+moment(val['from_time'], "HH:mm:ss").format('h:mm A')+' - '+moment(val['to_time'], "HH:mm:ss").format('h:mm A');
                    $('#caseNO'+id).html(val['caseNO'] ? 'Case no: '+ val['caseNO'] : '');
                    $('input[name="dateandtime"]').val(time);
                }
            },
            error: function (data) {
                $('#'+tab+id).html('Something went wrong...');
            },
        });
        $.ajax({
            async: true,
            url: url,
            type: 'GET',
            data: {
                meet_id: meeting_id,
                view: view,
                docorderid: docorderid
            },
            success : function(data){
                if(started) {
                    setTimeout(function(){
                        $('#'+tab+id).html(data);
                        make_base(document.getElementById('signature-pad'));
                        $('#companion').removeClass('hide');
                        $( '.btnAddrow' ).addClass('hide');
                        $( '.btnAddrowScrum' ).addClass('hide');
                        $( '.btnAddrowSwab' ).addClass('hide');
                        $( '.btnAddrowother' ).addClass('hide');
                        $('.ifCovid').removeClass('hide');
                        $( '.btnRemoveRow' ).addClass('hide');
                        $(".select2").select2();
                        if(tab == 'docTab') {
                            getDocorder();
                        }
                    },500);
                } else {
                    $('#'+tab+id).html('Consultation has not yet started.');
                }
            }
        });
    }
    function make_base(is)
    {
        if(is) {
          var signa = $('input[name="signaturephy"]').val();
          var canvas = document.getElementById('signature-pad');
          context = document.getElementById('signature-pad') ? canvas.getContext('2d') : '';
          base_image = new Image();
          base_image.src = signa;
          base_image.onload = function(){
            context.drawImage(base_image, 0, 0);
          }
        }
    }
    $('.btnBack').click(function(){
        $(this).addClass('hide');
    });

    function myreqPaging() {
        $('#pageMyReq .pagination a').on('click', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $('#myReqInfo').load(url + ' div#myReqInfo', null, myreqPaging); // re-run on complete
        });
    }
    myreqPaging();

</script>