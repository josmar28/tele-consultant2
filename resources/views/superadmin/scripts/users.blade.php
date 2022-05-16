<script>    
    var users = {!! json_encode($users->toArray()) !!};
    var processOne;
    var processTwo;
    var invalid;
    var Deactivate;
    var isToupdate;
    var existUsername;
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
    @if(Session::get('deactivate'))
        Lobibox.notify('error', {
            title: "",
            msg: "<?php echo Session::get('deactivate'); ?>",
            size: 'mini',
            rounded: true
        });
        <?php
            Session::put("deactivate",false);
        ?>
    @endif
    $( "#username" ).keyup(function() {
	    invalid = 0;
    	$.each(users, function(key, value) {
	        if(value.username == $("#username").val()) {
	        	invalid++;
	        }
	    });
	    if(existUsername) {
            $(".username-has-error").addClass("hide");
            processOne = 'success';
        } else if(invalid > 0) {
	    	$(".username-has-error").removeClass("hide");
		    $('.btnSave').prop('disabled', true);
		    processOne = '';
	    } else {
	    	$(".username-has-error").addClass("hide");
	    	$('.btnSave').prop('disabled', false);
	    	$('#username').css("border","");
	    	processOne = 'success';
	    }
	});
	$( '#deactBtn, #actBtn' ).click(function() {
		Deactivate = 'yes';
		var id = $("#user_id").val();
		if(Deactivate) {
			$(".loading").show();
			$.ajax({
				headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url:  "{{ url('/user-deactivate') }}/"+id,
	            type: "POST",
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
		}
	});
	$('#password2').keyup(function() {
		if($(this).val() != $('#password1').val()) {
			$(".password-has-error").removeClass("hide");
			$(".password-has-match").addClass("hide");
			$('.btnSave').prop('disabled', true);
			processTwo = '';
		} else {
			$(".password-has-error").addClass("hide");
			$(".password-has-match").removeClass("hide");
			$('.btnSave').prop('disabled', false);
			$('#password2').css("border","");
			processTwo = 'success';
		}
	});
	$("#container").removeClass("container");
    $("#container").addClass("container-fluid");
    $('#user_form').on('submit',function(e){
		e.preventDefault();
		if(!$('.username-has-error').hasClass("hide")) {
			$("#username").focus();
			$('#username').css("border","red solid 3px");
		} else if (!$('.password-has-error').hasClass("hide")) {
			$("#password2").focus();
			$('#password2').css("border","red solid 3px");
		} else if(!$('.username-has-error').hasClass("hide") &&
				!$('.password-has-error').hasClass("hide")) {
			$('#username').css("border","red solid 3px");
			$('#password2').css("border","red solid 3px");
		}
		else if(processOne && processTwo && invalid == 0) {
			$(".loading").show();
			$('#user_form').ajaxSubmit({
	            url:  "{{ url('/user-store') }}",
	            type: "POST",
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
		}
	});
	function getDataFromUser(el) {
		$("#myModalLabel").html('Update User');
		$("#user_id").val($(el).data('id'));
		const edit = [];
    	$.each(users, function(key, value) {
	        if(value.id == $(el).data('id')) {
	        	edit.push(value);
	        }
	    });
	    if(edit[0].status=='active') {
	    	$("#deactBtn").removeClass("hide")
	    } else  {
			$("#actBtn").removeClass("hide");
	    }
	    $("input[name=fname]").val(edit[0].fname);
	    $("input[name=mname]").val(edit[0].mname);
	    $("input[name=lname]").val(edit[0].lname);
	    $("input[name=contact]").val(edit[0].contact);
	    $("input[name=email]").val(edit[0].email);
	    if($('[name=facility_id]').is(":visible") && $('[name=level]').is(":visible")) {
		    $("[name=facility_id]").select2().select2('val', edit[0].facility_id);
		    $("[name=level]").select2().select2('val', edit[0].level);
	    }
	    $("input[name=designation]").val(edit[0].designation);
	    $("input[name=username]").val(edit[0].username);
	    $('input[name=password]').attr('required',false);
	    $('input[name=confirm]').attr('required',false);
	    isToupdate = edit[0].doctor_id;
	    processOne = 'success';
	    processTwo = 'success';
	    invalid = 0;
	    existUsername = edit[0].username;

	}

	$('#users_modal').on('hidden.bs.modal', function () {
		$("#myModalLabel").html('Add User');
		$("#user_id").val('');
		$("input[name=fname]").val('');
	    $("input[name=mname]").val('');
	    $("input[name=lname]").val('');
	    $("input[name=contact]").val('');
	    $("input[name=email]").val('');
	    if($('[name=facility_id]').is(":visible") && $('[name=level]').is(":visible")) {
		    $("[name=facility_id]").select2().select2('val', '');
		    $("[name=level]").select2().select2('val', '');
	    }
	    $("input[name=designation]").val('');
	    $("input[name=username]").val('');
	    $("#deactBtn").addClass("hide");
	    $("#doctorID").addClass("hide");
	    isToupdate = '';
	    $('#level').empty();
	    $("input[name=username]").prop('readonly', false);
	    $("input[name=username]").removeClass('disAble');
	    $('input[name=password]').attr('required',true);
	    $('input[name=confirm]').attr('required',true);
	    processOne = '';
	    processTwo = '';
	    invalid = '';
	    existUsername = '';
	})

	$('#level').change(function() {
		var level = this.value
		var id = $("[name=facility_id]").val();
		if(level == 'patient') {
			$(".loading").show();
			$.ajax({
	            url: "doctor-option/"+id+"",
	            method: 'GET',
	            success: function(result) {
	            	$('#doctor').empty();
	            	if(!isToupdate) {
			            $("#doctor").append('<option selected>Select Doctor</option>').change();
	            	}
	                if(result.doctors.length <= 0) {
	                	Lobibox.notify('error', {
				            title: "",
				            msg: "No doctors found in this facility.",
				            size: 'mini',
				            rounded: true
				        });
	                	$('#doctorID').addClass('hide');
	                }else {
	                    $.each(result.doctors,function(key,value){
	                        $('#doctor').append($("<option/>", {
	                           value: value.id,
	                           text: 'Dr.' + value.fname + ' ' + value.mname + ' ' +value.lname
	                        }));
	                    	if(value.id == isToupdate) {
	                    		var name = 'Dr.' + value.fname + ' ' + value.mname + ' ' +value.lname;
	                    		var option = $("<option selected='selected'></option>").val(isToupdate).text(name);
						  		$("#doctor").append(option).change();
	                    	}
	                    });
					  	$('#doctorID').removeClass('hide');
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
		} else {
			$('#doctorID').addClass('hide');
			$('#doctor').empty();
		}
	});

	$('#facility').change(function() {
		var val = this.value
		var op = $("<option selected='selected'></option>").val('').text('Select Level');
		var option = $("<option></option>").val('admin').text('Admin');
		var option1 = $("<option></option>").val('doctor').text('Doctor');
		// var option2 = $("<option></option>").val('patient').text('Patient');
		if(val) {
			$('#level').empty();
			$("#level").append(op);
			$("#level").append(option);
			$("#level").append(option1);
			// $("#level").append(option2);
		} else {
			$('#level').empty();
			$("#level").append(op);
			$("#level").append(option);
			$("#level").append(option1);
		}
	});


</script>