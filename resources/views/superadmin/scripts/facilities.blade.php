<script>
	var facilities = {!! json_encode($facilities->toArray()) !!};
	var editMunCode;
	var editMunName;
	var editBrgyCode;
	var editBrgyName;
	var toDelete;
	$('#province').on('change', function() {
		var id = this.value;
		if(id) {
			$.ajax({
	            url: "facilities/"+id+"/municipality",
	            method: 'GET',
	            success: function(result) {
	            	$('#municipality').empty();
				  	if(editMunCode && editMunName) {
				  		var option = $("<option selected='selected'></option>").val(editMunCode).text(editMunName);
				  		$("#municipality").append(option).change();
				  	} else {
			            $("#municipality").append('<option selected>Select Municipality</option>').change();
				  	}
	                if(result.municipal.length <= 0) {
	                	$('#divMun').addClass('hide');
	                }else {
	                    $.each(result.municipal,function(key,value){
	                        $('#municipality').append($("<option/>", {
	                           value: value.muni_psgc,
	                           text: value.muni_name
	                        }));
	                    });
					  	$('#divMun').removeClass('hide');
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
	$('#municipality').on('change', function() {
		var id = this.value;
		$.ajax({
            url: "facilities/"+id+"/barangay",
            method: 'GET',
            success: function(result) {
            	$('#barangay').empty();
            	if(editBrgyCode && editBrgyName) {
			  		var option = $("<option selected='selected'></option>").val(editBrgyCode).text(editBrgyName);
			  		$("#barangay").append(option).change();
			  	} else {
	                $("#barangay").append('<option selected>Select Barangay</option>').change();
	            }
                if(result.barangay.length <= 0) {
                	$('#divBrgy').addClass('hide');
                }else {
                    $.each(result.barangay,function(key,value){
                        $('#barangay').append($("<option/>", {
                           value: value.brg_psgc,
                           text: value.brg_name
                        }));
                    });
				  	$('#divBrgy').removeClass('hide');
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
	});
	$( "#deleteBtn" ).click(function() {
		toDelete = 'yes';
	});
	$('#facility_form').on('submit',function(e){
		e.preventDefault();
		$(".loading").show();
		if(toDelete) {
			var id = $("#facility_id").val();
			$('#facility_form').ajaxSubmit({
	            url:  "{{ url('/facility-delete') }}/"+id,
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
			$('#facility_form').ajaxSubmit({
	            url:  "{{ url('/facility-store') }}",
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
	$("#container").removeClass("container");
    $("#container").addClass("container-fluid");
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
    function getDataFromFacility(ele) {
    	$("#myModalLabel").html('Update Facility');
    	$("#facility_id").val($(ele).data('id'));
		const edit = [];
    	$.each(facilities, function(key, value) {
	        if(value.id == $(ele).data('id')) {
	        	edit.push(value);
	        }
	    });
    	editMunCode = edit[0].muni_psgc;
    	editMunName = edit[0].muncity;
    	editBrgyCode = edit[0].brgy_psgc;
    	editBrgyName = edit[0].barangay;
	    $("input[name=facilityname]").val(edit[0].facilityname);
	    $("input[name=fshortcode]").val(edit[0].fshortcode);
	    $("input[name=oldfacilityname]").val(edit[0].oldfacilityname);
	    $("[name=prov_psgc]").select2().select2('val', edit[0].prov_psgc);
	    $("input[name=streetname]").val(edit[0].streetname);
	    $("input[name=landlineno]").val(edit[0].landlineno);
	    $("input[name=faxnumber]").val(edit[0].faxnumber);
	    $("input[name=emailaddress]").val(edit[0].emailaddress);
	    $("input[name=officialwebsiteurl]").val(edit[0].officialwebsiteurl);
	    $("input[name=facilityhead_lname]").val(edit[0].facilityhead_lname);
	    $("input[name=facilityhead_fname]").val(edit[0].facilityhead_fname);
	    $("input[name=facilityhead_mi]").val(edit[0].facilityhead_mi);
	    $("input[name=facilityhead_position]").val(edit[0].facilityhead_position);
	    $("input[name=facilityhead_fname]").val(edit[0].facilityhead_fname);
	    $("input[name=ownership]").val(edit[0].ownership);
	    $("[name=status]").select2().select2('val', edit[0].status);
	    $("[name=hosp_licensestatus]").select2().select2('val', edit[0].hosp_licensestatus);
	    $("[name=hosp_servcapability]").select2().select2('val', edit[0].hosp_servcapability);
	    $("input[name=hosp_bedcapacity]").val(edit[0].hosp_bedcapacity);
	    $("input[name=latitude]").val(edit[0].latitude);
	    $("input[name=longitude]").val(edit[0].longitude);
	    $("input[name=remarks]").val(edit[0].remarks);
		$("#deleteBtn").removeClass("hide");
    }
    $('#facility_modal').on('hidden.bs.modal', function () {
    	$("#myModalLabel").html('Add Facility');
    	editMunCode = '';
    	editMunName = '';
    	editBrgyCode = '';
    	editBrgyName = '';
    	$("#facility_id").val('');
	    $("input[name=facilityname]").val('');
	    $("input[name=fshortcode]").val('');
	    $("input[name=oldfacilityname]").val('');
	    $("[name=prov_psgc]").select2().select2('val', '');
	    $("input[name=streetname]").val('');
	    $("input[name=landlineno]").val('');
	    $("input[name=faxnumber]").val('');
	    $("input[name=emailaddress]").val('');
	    $("input[name=officialwebsiteurl]").val('');
	    $("input[name=facilityhead_lname]").val('');
	    $("input[name=facilityhead_fname]").val('');
	    $("input[name=facilityhead_mi]").val('');
	    $("input[name=facilityhead_position]").val('');
	    $("input[name=facilityhead_fname]").val('');
	    $("[name=status]").select2().select2('val', '');
	    $("[name=hosp_licensestatus]").select2().select2('val', '');
	    $("[name=hosp_servcapability]").select2().select2('val', '');
	    $("input[name=hosp_bedcapacity]").val('');
	    $("input[name=latitude]").val('');
	    $("input[name=longitude]").val('');
	    $("input[name=remarks]").val('');
	    $('#divMun').addClass('hide');
		$('#divBrgy').addClass('hide');
		$("#deleteBtn").addClass("hide");
		$("input[name=ownership]").val('');
    });
</script>