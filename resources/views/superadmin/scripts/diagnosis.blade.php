<script>
	var diagnosis = {!! json_encode($diagnosis->toArray()) !!};
	var cat;
	var toDelete;
	var priority;
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
	$('#diagmaincat').on('change', function() {
		var id = this.value;
		if(id) {
			$(".loading").show();
			$.ajax({
	            url: "diagnosis/"+id+"/maincat",
	            method: 'GET',
	            success: function(result) {
	            	$(".loading").hide();
	            	$('#diagcategory').empty();
				  	if(cat) {
				  		var option = $("<option selected='selected'></option>").val(cat).text(cat);
				  		$("#diagcategory").append(option).change();
				  	} else {
			            $("#diagcategory").append('<option selected>Select Category</option>').change();
				  	}
	                if(result.subcats.length <= 0) {
	                	$('#divCat').addClass('hide');
	                }else {
	                    $.each(result.subcats,function(key,value){
	                        $('#diagcategory').append($("<option/>", {
	                           value: value.diagsubcat,
	                           text: value.diagsubcat
	                        }));
	                    });
					  	$('#divCat').removeClass('hide');
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
	});

	$( "#deleteBtn" ).click(function() {
		toDelete = 'yes';
	});
	$('#diagnosis_form').on('submit',function(e){
		e.preventDefault();
		$(".loading").show();
		if(toDelete) {
			var id = $("#diagnosis_id").val();
			$('#diagnosis_form').ajaxSubmit({
	            url:  "{{ url('/diagnosis-delete') }}/"+id,
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
		} else {
			$('#diagnosis_form').ajaxSubmit({
	            url:  "{{ url('/superadmin-diagnosis-store') }}",
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

	function getDataFromDiagnosis(ele) {
		$("#myModalLabel").html('Update Diagnosis');
    	$("#diagnosis_id").val($(ele).data('id'));
		const edit = [];
    	$.each(diagnosis, function(key, value) {
	        if(value.id == $(ele).data('id')) {
	        	edit.push(value);
	        }
	    });

	    cat = edit[0].diagcategory;
	    $("input[name=diagcode]").val(edit[0].diagcode);
	    $("input[name=diagdesc]").val(edit[0].diagdesc);
	    $("[name=diagmaincat]").select2().select2('val', edit[0].diagmaincat);
	    $("input[name=diagsubcat]").val(edit[0].diagsubcat);
	    priority = edit[0].diagpriority;
	    $("input[name=diagpriority][value=" + priority + "]").prop('checked', true);
	    $("#deleteBtn").removeClass("hide");
	}
	$('#diagnosis_modal').on('hidden.bs.modal', function () {
		$("input[name=diagcode]").val('');
	    $("input[name=diagdesc]").val('');
	    $("[name=diagmaincat]").select2().select2('val', '');
	    $("input[name=diagsubcat]").val('');
	    $("input[name=diagpriority][value=" + priority + "]").prop('checked', false);
	    $("#deleteBtn").addClass("hide");
	});
</script>