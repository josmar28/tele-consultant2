<script>
	var telecat = {!! json_encode($doccat->toArray()) !!};
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
	$('#tele_form').on('submit',function(e){
		e.preventDefault();
		$(".loading").show();
		var id = $("#doctorcat_id").val();
		if(toDelete) {
			$('#tele_form').ajaxSubmit({
	            url:  "{{ url('/doctor-category-delete') }}/"+id,
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
			$('#tele_form').ajaxSubmit({
	            url:  "{{ url('/doctor-category-store') }}",
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

	function getData(ele) {
		$("#myModalLabel").html('Update Tele Category');
    	$("#doctorcat_id").val($(ele).data('id'));
    	const edit = [];
    	$.each(telecat, function(key, value) {
	        if(value.id == $(ele).data('id')) {
	        	edit.push(value);
	        }
	    });

	    $("input[name=category_name]").val(edit[0].category_name);
	    $("#deleteBtn").removeClass("hide");
	}
	$('#province_modal').on('hidden.bs.modal', function () {
		$("#myModalLabel").html('Add Tele Category');
		$("input[name=category_name]").val('');
	    $("#doctorcat_id").val('');
	    $("#deleteBtn").addClass("hide");
	});
</script>