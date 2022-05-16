<script>
    var patients = {!! json_encode($patients->toArray()) !!};
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
    $(document).ready(function() {
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
        $('#consolidate_date_range_req').daterangepicker({
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
       $('.clockpicker').clockpicker({
            twelvehour: true,
            afterDone: function() {
                validateTIme();
            }
       });
    });
    $('.daterange').on('apply.daterangepicker', function(ev, picker) {
      validateTIme();
    });

    $( ".selectFacility" ).change(function() {
        var id = $(this).val();
        var url = "{{ url('/get-doctors-facility') }}";
        $.ajax({
            async: true,
            url: url,
            type: 'GET',
            data: {
                fac_id: id
            },
            success : function(data){
                $('.selectDoctor').empty();
                var val = JSON.parse(data);
                $(".selectDoctor").append('<option selected>Select Doctor</option>').change();
                $.each(val,function(key,value){
                    $('.selectDoctor').append($("<option/>", {
                       value: value.id,
                       text: value.lname + ', ' + value.fname + ' ' + value.mname
                    }));
                });
                $('#scheduleMeeting').removeClass('hide');
            }
        });
    });

	function getMeeting(id) {
        var url = "{{ url('/admin-meeting-info') }}";
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
                $('#info_meeting_modal').modal('show'); 
                $('#myInfoLabel').html(val['title']);
                $('#meetlink').html(val['web_link']);
                $('#meetnumber').html(val['meeting_number']);
                $('#patientName').val(val['lname']+", "+val['fname']+" "+val['mname']);
                $('#docName').val(val['doclname']+", "+val['docfname']+" "+val['docmname']);
                $('#meetPass').html(val['password']);
                $('#meetKey').html(val['host_key']);
                $('.btnMeeting').val(val['meetID']);
            }
        });
    }
    function startMeeting(id) {
        var url = "{{ url('/join-meeting') }}";
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

    $('#schedule_form').on('submit',function(e){
        e.preventDefault();
        $('.btnSave').html('<i class="fa fa-spinner fa-spin"></i> Saving...');
        $(".loading").show();
        $('#schedule_form').ajaxSubmit({
            url:  "{{ url('/admin-sched-pending') }}",
            type: "GET",
            success: function(data){
                setTimeout(function(){
                    window.location.reload(false);
                },500);
            },
            error: function (data) {
                $('.btnSave').html('<i class="fas fa-check"></i> Save');
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

    $( ".btnMeeting" ).click(function() {
        startMeeting($(this).attr("value"));
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
        console.log('issue');
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

    $('#tele_form').on('submit',function(e){
        e.preventDefault();
        $('.btnSavePend').html('<i class="fa fa-spinner fa-spin"></i> Saving...');
        $(".loading").show();
        $('#tele_form').ajaxSubmit({
            url:  "{{ url('/doctor-sched-pending') }}",
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
</script>