<script>
	var municipalities = {!! json_encode($municipalities->toArray()) !!};
	var toDelete;
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
    $( "#deleteBtn" ).click(function() {
		toDelete = 'yes';
	});
	$('#muni_form').on('submit',function(e){
		e.preventDefault();
		$(".loading").show();
		var id = $("#muni_id").val();
		if(toDelete) {
			$('#muni_form').ajaxSubmit({
	            url:  "{{ url('/municipality-delete') }}/"+id,
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
			$('#muni_form').ajaxSubmit({
	            url:  "{{ url('/municipality-store') }}",
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

	function getDataFromMunicipality(ele) {
		$("#myModalLabel").html('Update Municipality');
    	$("#muni_id").val($(ele).data('id'));
    	const edit = [];
    	$.each(municipalities, function(key, value) {
	        if(value.id == $(ele).data('id')) {
	        	edit.push(value);
	        }
	    });

	    $("input[name=muni_name]").val(edit[0].muni_name);
	    $("input[name=muni_psgc]").val(edit[0].muni_psgc);
	    $("input[name=zipcode]").val(edit[0].zipcode);
	    $("#deleteBtn").removeClass("hide");
	}

	$('#municipal_modal').on('hidden.bs.modal', function () {
		$("#myModalLabel").html('Add Municipality');
		$("input[name=muni_name]").val('');
	    $("input[name=muni_psgc]").val('');
	    $("input[name=zipcode]").val('');
	    $("#muni_id").val('');
	    $("#deleteBtn").addClass("hide");
	});
</script>