<script>
  var barangays = {!! json_encode($barangays->toArray()) !!};
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
	$('#brgy_form').on('submit',function(e){
		e.preventDefault();
		$(".loading").show();
		var id = $("#brgy_id").val();
		if(toDelete) {
			$('#brgy_form').ajaxSubmit({
	            url:  "{{ url('/barangay-delete') }}/"+id,
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
			$('#brgy_form').ajaxSubmit({
	            url:  "{{ url('/barangay-store') }}",
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

	function getDataFromBrgy(ele) {
		$("#myModalLabel").html('Update Barangay');
    	$("#brgy_id").val($(ele).data('id'));
    	const edit = [];
    	$.each(barangays, function(key, value) {
	        if(value.id == $(ele).data('id')) {
	        	edit.push(value);
	        }
	    });
	    $("input[name=brg_name]").val(edit[0].brg_name);
	    $("input[name=brg_psgc]").val(edit[0].brg_psgc);
	    $("#deleteBtn").removeClass("hide");
	}
	$('#brgy_modal').on('hidden.bs.modal', function () {
		$("#myModalLabel").html('Add Barangay');
		$("input[name=brg_name]").val('');
	    $("input[name=brg_psgc]").val('');
	    $("#deleteBtn").removeClass("hide");
	});
</script>
