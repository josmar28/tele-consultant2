<script>
var activeForm = '';
var activebtn = '';
var signature = "{!! $signature !!}";
var api_key = "{!! $api_key !!}";
var meetnum = "{!! $meetnum !!}";
var passw = "{!! $passw !!}";
var username = "{!! $username !!}";
var meeting_id = $('input[name="meeting_id"]').val();
var patient_id = $('input[name="patient_id"]').val();
var demographic_id = $('input[name="demographic_id"]').val();
var clinical_id = $('input[name="clinical_id"]').val();
var covidassess_id = $('input[name="covidassess_id"]').val();
var covidscreen_id = $('input[name="covidscreen_id"]').val();
var diagassess_id = $('input[name="diagassess_id"]').val();
var planmanage_id = $('input[name="planmanage_id"]').val();
var phy_id = $('input[name="phy_id"]').val();
var case_no = $('input[name="case_no"]').val();
const col = document.getElementsByClassName("main-layout");
function closeNav(ele, btn) {
    if(ele && btn) {
      document.getElementById(ele).style.width = "0";
      activeForm = '';
      $("."+btn).addClass('hide');
      activebtn = '';
      if(col.length > 0) {
        col[0].style.marginLeft = "0";
      }
    }
}
$( function() {
    $( "#demoDiv").resizable();
    $( "#cliDiv").resizable();
    $( "#covDiv").resizable();
    $( "#diagDiv").resizable();
    $( "#planDiv").resizable();
});
ZoomMtg.preLoadWasm();
ZoomMtg.prepareWebSDK();
ZoomMtg.i18n.load('en-US');
ZoomMtg.i18n.reload('en-US');
ZoomMtg.setZoomJSLib('https://source.zoom.us/2.2.0/lib', '/av'); 
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip(); 
    window.onbeforeunload = function() {
        return "Are you sure you want to leave?";
    }
    var date = new Date();
    var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
    $('.daterange').daterangepicker({
        "singleDatePicker": true
    });
    $(".select2").select2();
    var leaveUrl = "{{ url('thank-you-page') }}";
    ZoomMtg.init({
      leaveUrl: leaveUrl,
      success: (success) => {
        ZoomMtg.join({
            signature: signature,
            apiKey: api_key,
            meetingNumber: meetnum,
            userName: username,
            passWord: passw,
            success: (success) => {
                console.log(success)
            },
            error: (error) => {
                console.log(error)
            }
        })
      },
      error: (error) => {
        console.log(error)
      }
    });
});
$("#myBtn").click(function(){
    $(".btnDemo").fadeToggle();
    $(".btnClinical").fadeToggle("slow");
    $(".btnCovid").fadeToggle(500);
    $(".btnDiagnosis").fadeToggle(1000);
    $(".btnPlan").fadeToggle(1500);
});
function showForm(ele, btn) {
    document.getElementById(ele).style.width = "650px";
    if(col.length > 0) {
        col[0].style.marginLeft = "650px";
    }if(ele == 'cliDiv') {
        var conjunctiva = '{!! $conjunctiva !!}';
        var neck = '{!! $neck !!}';
        var breast = '{!! $breast !!}';
        var thorax = '{!! $thorax !!}';
        var abdomen = '{!! $abdomen !!}';
        var genitals = '{!! $genitals !!}';
        var extremities = '{!! $extremities !!}';
        $("#conjunctiva").val(conjunctiva.split(',')).trigger('change');
        $("#neck").val(neck.split(',')).trigger('change');
        $("#breast").val(breast.split(',')).trigger('change');
        $("#thorax").val(thorax.split(',')).trigger('change');
        $("#abdomen").val(abdomen.split(',')).trigger('change');
        $("#genitals").val(genitals.split(',')).trigger('change');
        $("#extremities").val(extremities.split(',')).trigger('change');
    }
    $("."+btn).removeClass('hide');
    $("#myBtn").click();
    closeNav(activeForm, activebtn);
    activeForm = ele;
    activebtn = btn;
}
$('input[type=radio][name=is_patient_accompanied]').change(function() {
    if (this.value == 1) {
        $('#companion').removeClass('hide');
    }
    else if (this.value == 0) {
        $('#companion').addClass('hide');
    }
});
</script>
<script>
	var canvas = document.getElementById('signature-pad') ? document.getElementById('signature-pad') : '';
	var signaturePad = document.getElementById('signature-pad') ? new SignaturePad(canvas) : '';
	context = document.getElementById('signature-pad') ? canvas.getContext('2d') : '';
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
	$(document).ready(function() {
        $('.daterange').daterangepicker({
            "singleDatePicker": true
        });
        $('input[type=radio][name=known_covid_case]').change();
        $('input[type=radio][name=history_illness]').change();
        $('input[type=radio][name=xray]').change();
        $('input[type=radio][name=pregnant]').change();
        $('input[name="clinical_classification"]').change();
        make_base(document.getElementById('signature-pad'));
    });
    function make_base(is)
	{
		<?php
		$sign = '';
		if($patient->planmanage) {
			$sign = asset('public/signatures/'.$patient->planmanage->signature);
		}
		?>
		if(is) {
		  var url = '<?php echo $sign ?>';
		  base_image = new Image();
		  base_image.src = url;
		  base_image.onload = function(){
		    context.drawImage(base_image, 0, 0);
		  }
		}
	}
	function enableView() {
		$('#formEdit').removeClass('disAble');
		$( 'textarea[name="reason_consult"]' ).focus();
		$( 'textarea[name="summary_assess"]' ).focus();
		$( '.btnSave' ).removeClass('hide');
		$( '#btnEdit' ).addClass('hide');
		$( '.btnAddrow' ).removeClass('hide');
		$( '.inputRows' ).removeClass('form-group').addClass('input-group');
		$( '.btnRemoveRow' ).removeClass('hide');
		$( '.btnAddrowScrum' ).removeClass('hide');
		$( '.btnAddrowSwab' ).removeClass('hide');
		$( '.btnAddrowother' ).removeClass('hide');
		$( '.actionsignature' ).removeClass('hide');
	}
	$('#demographic_form').on('submit',function(e){
		e.preventDefault();
		$(".loading").show();
		$('#demographic_form').ajaxSubmit({
			url:  "{{ url('/demographic-store') }}",
            type: "POST",
            data: {
                meeting_id: meeting_id,
            	meeting_id: meeting_id,
            	id: demographic_id,
            	case_no: case_no
            },
            success: function(data){
                Lobibox.notify('success', {
	                title: "",
	                msg: "Successfully save Demographic profile",
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
	$('#clinical_form').on('submit',function(e){
		e.preventDefault();
		$(".loading").show();
		$('#clinical_form').ajaxSubmit({
			url:  "{{ url('/clinical-store') }}",
            type: "POST",
            data: {
            	meeting_id: meeting_id,
            	id: clinical_id
            },
            success: function(data){
                $( "#physical_form" ).submit();
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
    $('#physical_form').on('submit',function(e){
        e.preventDefault();
        var conjunctiva = $("#conjunctiva")
              .map(function(){return $(this).val();}).get().join(',');
        var neck = $("#neck")
              .map(function(){return $(this).val();}).get().join(',');
        var breast = $("#breast")
              .map(function(){return $(this).val();}).get().join(',');
        var thorax = $("#thorax")
              .map(function(){return $(this).val();}).get().join(',');
        var abdomen = $("#abdomen")
              .map(function(){return $(this).val();}).get().join(',');
        var genitals = $("#genitals")
              .map(function(){return $(this).val();}).get().join(',');
        var extremities = $("#extremities")
              .map(function(){return $(this).val();}).get().join(',');
        $('#physical_form').ajaxSubmit({
            url:  "{{ url('/physical-exam-store') }}",
            type: "POST",
            data: {
                meeting_id: meeting_id,
                id: phy_id,
                conjunctiva: conjunctiva,
                neck: neck,
                breast: breast,
                thorax: thorax,
                abdomen: abdomen,
                genitals: genitals,
                extremities: extremities
            },
            success: function(data){
                Lobibox.notify('success', {
                    title: "",
                    msg: "Successfully save clinical history and physical examination",
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
	$('#covid_form').on('submit',function(e){
		e.preventDefault();
		var values = $("input[name='list_name_occasion[]']")
              .map(function(){return $(this).val();}).get();
        var scrum = $("input[name='scrum[]']")
              .map(function(){return $(this).val();}).get();
        var oro_naso_swab = $("input[name='oro_naso_swab[]']")
              .map(function(){return $(this).val();}).get();
        var spe_others = $("input[name='spe_others[]']")
              .map(function(){return $(this).val();}).get();
		$(".loading").show();
		$('#covid_form').ajaxSubmit({
			url:  "{{ url('/covid-store') }}",
            type: "POST",
            data: {
            	list_name_occa: values ? values : '',
            	meeting_id: meeting_id,
            	id: covidscreen_id 
            },
            success: function(data){
                $('#assess_form').ajaxSubmit({
					url:  "{{ url('/assess-store') }}",
		            type: "POST",
		            data: {
		            	meeting_id: meeting_id,
		            	scrumee: scrum,
		            	oro_naso_swabee: oro_naso_swab ? oro_naso_swab : '',
		            	spe_othersee: spe_others ? spe_others : ''
		            },
		            success: function(data){
		                Lobibox.notify('success', {
			                title: "",
			                msg: "Successfully save Covid-19 Screening",
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
	$( window ).scroll(function() {
	  if($(window).scrollTop() > 310) {
		  	$( '#tabMenu' ).addClass('tab-scroll');
	  }
	  if($(window).scrollTop() > 290) {
	  	$( '.btnSave' ).addClass('btnSaveMove');
	  } else {
	  	$( '.btnSave' ).removeClass('btnSaveMove');
	  	$( '#tabMenu' ).removeClass('tab-scroll');
	  }
	});
	$('input[type=radio][name=known_covid_case]').change(function() {
	    if ($("input[name='known_covid_case']:checked").val() == 1) {
	        $('input[name="date_contact_known_covid_case"]').prop("disabled", false);
	    }
	    else {
	    	$('input[name="date_contact_known_covid_case"]').val('');
	        $('input[name="date_contact_known_covid_case"]').prop("disabled", true);
	    }
	});
	$(".btnAddrow").click(function () {
        var html = '';
        html += '<div class="col-md-6">';
        html += '<div class="inputRow input-group">';
        html += '<input type="text" name="list_name_occasion[]" class="form-control" placeholder="e.g John Doe - 1234567890">';
        html += '<div class="input-group-btn">';
        html += '<button class="btnRemoveRow btn btn-danger" type="button">Remove</button>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '<br>';

        $('#nameContact').append(html);
    });
    $(document).on('click', '.btnRemoveRow', function () {
        $(this).closest('.inputRow').remove();
    });
    $(".checkbox").change(function() {
	    if(this.checked) {
	        this.value = 1;
	    } else {
	    	this.value = 0;
	    }
	});
	$('input[name="history_illness"]').change(function() {
	    if(this.value > 0) {
	    	$('.formHi').removeClass('hide');
	    } else {
	    	$('.formHi').addClass('hide');
	    }
	});
	$('input[name="xray"]').change(function() {
	    if(this.value > 0) {
	    	$('.formX').removeClass('hide');
	    } else {
	    	$('.formX').addClass('hide');
	    }
	});
	$('input[name="pregnant"]').change(function() {
	    if(this.value > 0) {
	    	$('.formlmp').removeClass('hide');
	    } else {
	    	$('.formlmp').addClass('hide');
	    }
	});
	
	$(".btnAddrowScrum").click(function () {
        var html = '';
        html += '<div class="inputRow col-md-3">';
        html += '<div class="input-group">';
        html += '<input type="text" name="scrum[]" class="form-control" placeholder="___/___/____">';
        html += '<div class="input-group-btn">';
        html += '<button class="btnRemoveRow btn btn-danger" type="button">Remove</button>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '<br>';

        $('#scrumRow').append(html);
    });
    $(".btnAddrowSwab").click(function () {
        var html = '';
        html += '<div class="inputRow col-md-3">';
        html += '<div class="input-group">';
        html += '<input type="text" name="oro_naso_swab[]" class="form-control" placeholder="___/___/____">';
        html += '<div class="input-group-btn">';
        html += '<button class="btnRemoveRow btn btn-danger" type="button">Remove</button>';
        html += '</div>';
        html += '</div>';
        html += '</div>';

        $('#swabRow').append(html);
    });
    $(".btnAddrowother").click(function () {
        var html = '';
        html += '<div class="inputRow col-md-3">';
        html += '<div class="input-group">';
        html += '<input type="text" name="spe_others[]" class="form-control" placeholder="___/___/____">';
        html += '<div class="input-group-btn">';
        html += '<button class="btnRemoveRow btn btn-danger" type="button">Remove</button>'; 	
        html += '</div>';
        html += '</div>';
        html += '</div>';

        $('#otherRow').append(html);
    });

    $('input[name="clinical_classification"]').change(function() {
	    if($("input[name='clinical_classification']:checked").val() == 1) {
	    	$('.ifCovid').removeClass('hide');
	    } else {
	    	$('.ifCovid').addClass('hide');
	    }
	});
	$('#diag_form').on('submit',function(e){
		e.preventDefault();
		$(".loading").show();
		$('#diag_form').ajaxSubmit({
			url:  "{{ url('/diagnosis-store') }}",
            type: "POST",
            data: {
            	id: diagassess_id,
            	patient_id: patient_id
            },
            success: function(data){
               Lobibox.notify('success', {
	                title: "",
	                msg: "Successfully save diagnosis/assessment",
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
	var clear = document.getElementById('clear') ? document.getElementById('clear') : '';
	var draw = document.getElementById('draw') ? document.getElementById('draw') : '';
	var erase = document.getElementById('erase') ? document.getElementById('erase') : '';
	if(clear) {
		clear.addEventListener('click', function () {
		  signaturePad.clear();
		});
	}
	if(draw) {
		draw.addEventListener('click', function () {
		  var ctx = canvas.getContext('2d');
		  ctx.globalCompositeOperation = 'source-over'; // default value
		});
	}
	if(erase) {
		erase.addEventListener('click', function () {
		  var ctx = canvas.getContext('2d');
		  ctx.globalCompositeOperation = 'destination-out';
		});
	}

	$('#plan_form').on('submit',function(e){
		e.preventDefault();
		$(".loading").show();
		$('#plan_form').ajaxSubmit({
			url:  "{{ url('/plan-store') }}",
            type: "POST",
            data: {
            	signature: signaturePad.toDataURL('image/png'),
            	id: planmanage_id,
            	patient_id: patient_id
            },
            success: function(data){
                Lobibox.notify('success', {
	                title: "",
	                msg: "Successfully save plan of management",
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
	$('.btnSaveall').on('click',function(e){
		alert('yehey')
	});
</script>