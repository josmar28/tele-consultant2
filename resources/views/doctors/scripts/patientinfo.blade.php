<script>
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
    var meeting_id;
    var docorderid;
    var info;
    $(document).ready(function() {
        $('.daterange').daterangepicker({
            "singleDatePicker": true
        });
        $('.clockpicker').clockpicker({
            donetext: 'Done',
            twelvehour: true
       });
    });
    function enableView() {
        $('#patient_form').removeClass('disAble');
        $( '.btnSave' ).removeClass('hide');
        $( '#btnEdit' ).addClass('hide');
        $( 'input[name="fname"]' ).focus();
        $( '.reqField' ).addClass('required-field');
    }
    function telDetail(id, view, tab, docid, details) {
        info = details ? JSON.parse(details) : info;
        $('#chiefCom').html('Chief Complaint: ' + info['title']);
        $('#chiefDate').html('Date:' +moment(info['date_meeting']).format('MMMM D, YYYY'));
        $('#chiefTime').html('Time:' +moment(info['from_time'], "HH:mm:ss").format('h:mm A'));
        $('#chiefType').html('Type of Consultation: ' +info['pendmeet']['telecategory']['category_name']);
        docorderid = docid ? docid : docorderid;
        var url = "{{ url('/tele-details') }}";
        view = view ? view : 'demographic';
        tab = tab ? tab : 'patientTab';
        meeting_id = id ? id : meeting_id;
        var urlmet = "{{ url('/meeting-info') }}";
        $('#'+tab).html('loading...');
        $.ajax({
            async: true,
            url: urlmet,
            type: 'GET',
            data: {
                meet_id: meeting_id,
            },
            success : function(data){
                var val = JSON.parse(data);
                if(val) {
                    var time = moment(val['date_meeting']).format('MMMM D, YYYY')+' '+moment(val['from_time'], "HH:mm:ss").format('h:mm A')+' - '+moment(val['to_time'], "HH:mm:ss").format('h:mm A');
                    $('#caseNO').html(val['caseNO']);
                    $('input[name="dateandtime"]').val(time);
                }
            },
            error: function (data) {
                $('#'+tab).html('Something went wrong...');
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
                setTimeout(function(){
                    $('#'+tab).html(data);
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
            }
        });
    }
    $('#patient_form').on('submit',function(e){
        e.preventDefault();
        $('#patient_form').ajaxSubmit({
            url:  "{{ url('/patient-store') }}",
            type: "POST",
            data: {
                patient_id: $('#patient_id').val()
            },
            success: function(data){
                $('#patient_form').addClass('disAble');
                $( '.btnSave' ).addClass('hide');
                $( '#btnEdit' ).removeClass('hide');
                Lobibox.notify('success', {
                    title: "",
                    msg: "Successfully save patient profile",
                    size: 'normal',
                    rounded: true
                });
            },
            error: function (data) {
                $(".loading").hide();
                Lobibox.notify('error', {
                    title: "",
                    msg: "Something went wrong, Please try again.",
                    size: 'normal',
                    rounded: true
                });
            },
        });

    });

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

    function getDocorder() {
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
                    $("#labrequestcodeslab").select2({multiple:true,});
                    $("#labrequestcodeslab").select2({multiple:true,});
                    $("#labrequestcodeslab").val(labreq).trigger('change');
                    $("#imagingrequestcodeslab").select2().val(img).trigger('change');
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

    $(".revealICD").on( "click", function() {
            $('#icd_modal').modal('show');  
    });

    function icdPaging() {
        $('#diagPage .pagination a').on('click', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $('#icdTable').load(url + ' div#icdTable', null, icdPaging); // re-run on complete
        });
    }
    icdPaging();

    $('.searchicd').on('keyup',function(){
        var searchTerm = $(this).val().toLowerCase();
        $('#icdTable .conts').each(function(){
            var lineStr = $(this).text().toLowerCase();
            if(lineStr.indexOf(searchTerm) === -1){
                $(this).hide();
            }else{
                $(this).show();
            }
        });
    });

    function getICD(id,code,desc) {
        $('input[name="icd10"]').val(id);
        $('#icdDesc').val(code + ':' +desc);
        $('#icd_modal').modal('hide');  
    }

    $('#medhis_form').on('submit',function(e){
        e.preventDefault();
        var past_med_history = $("#past_med_history").val() ? $("#past_med_history").val().join(',') : '';
        var fam_history = $("#fam_history").val() ? $("#fam_history").val().join(',') : '';
        var date_surgical = moment($('#date_surgical').val(), 'MM/DD/YYYY').format('YYYY-MM-DD');
        var date_diagnosis = moment($('#date_diagnosis').val(), 'MM/DD/YYYY').format('YYYY-MM-DD');
        var time_diagnosis = moment($('#time_diagnosis').val(), 'HH:mm a').format('HH:mm:ss');
        $('#medhis_form').ajaxSubmit({
            url:  "{{ url('/medical-history-store') }}",
            type: "POST",
            data: {
                id: $('#medhisid').val(),
                patient_id: $('#patient_id').val(),
                past_med_history: past_med_history,
                fam_history: fam_history,
                date_surgical: date_surgical,
                date_diagnosis: date_diagnosis,
                time_diagnosis: time_diagnosis
            },
            success: function(data){
                setTimeout(function(){
                    window.location.reload(false);
                },500);
            },
            error: function (data) {
                $(".loading").hide();
                Lobibox.notify('error', {
                    title: "",
                    msg: "Something went wrong, Please try again.",
                    size: 'normal',
                    rounded: true
                });
            },
        });

    });

    function getData(id) {
        var url = "{{ url('/medical-history-info') }}";
        $.ajax({
            url: url,
            type: 'GET',
            async: false,
            data: {
                id: id
            },
            success : function(data){
                var diagnosis = data.diag ? data.diag.diagcode+':'+data.diag.diagdesc : '';
                var diag_date = moment(data.medhis.date_diagnosis, 'YYYY-MM-DD').format('MM/DD/YYYY');
                var time_diag = moment(data.medhis.time_diagnosis, 'HH:mm:ss').format('HH:mm a');
                var past_med = data.medhis.past_med_history ? data.medhis.past_med_history.split(',') : [];
                var date_surg = moment(data.medhis.date_surgical, 'YYYY-MM-DD').format('MM/DD/YYYY');
                var fam_his = data.medhis.fam_history ? data.medhis.fam_history.split(',') : [];
                $('textarea[name="history_present_illness"]').html(data.medhis.history_present_illness);
                $('textarea[name="present_med_fam_soc"]').html(data.medhis.present_med_fam_soc);
                $('#icdDesc').val(diagnosis);
                $('#date_diagnosis').val(diag_date!='Invalid date' ? diag_date : '');
                $('#time_diagnosis').val(time_diag!='Invalid date' ? time_diag : '');
                $('#past_med_history').val(past_med).change();
                $('input[name="past_specify"]').val(data.medhis.past_specify);
                $('textarea[name="past_surg_his_op"]').html(data.medhis.past_surg_his_op);
                $('#date_surgical').val(date_surg!='Invalid date' ? date_surg : '');
                $('#fam_history').val(fam_his).change();
                $('input[name="fam_specify"]').val(data.medhis.fam_specify);
                $("input[name=smoking][value='"+data.medhis.smoking+"']").prop("checked",true);
                $("input[name=alcohol][value='"+data.medhis.alcohol+"']").prop("checked",true);
                $("input[name=illicit_drug][value='"+data.medhis.illicit_drug+"']").prop("checked",true);
                $("input[name=oral_agents][value='"+data.medhis.oral_agents+"']").prop("checked",true);
                $("input[name=hyper_med][value='"+data.medhis.hyper_med+"']").prop("checked",true);

            }
        });
    }

    $('#medhis_modal').on('hidden.bs.modal', function () {
        $('textarea[name="history_present_illness"]').html('');
        $('textarea[name="present_med_fam_soc"]').html('');
        $('#icdDesc').val('');
        $('#date_diagnosis').val('');
        $('#time_diagnosis').val('');
        $('#past_med_history').val([]).change();
        $('input[name="past_specify"]').val('');
        $('textarea[name="past_surg_his_op"]').html('');
        $('#date_surgical').val('');
        $('#fam_history').val([]).change();
        $('input[name="fam_specify"]').val('');
        $("input[name=smoking][value='0']").prop("checked",true);
        $("input[name=alcohol][value='0']").prop("checked",true);
        $("input[name=illicit_drug][value='0']").prop("checked",true);
        $("input[name=oral_agents]").prop("checked",false);
        $("input[name=hyper_med]").prop("checked",false);
    });

</script>