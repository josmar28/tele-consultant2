<script>
	var provinces = {!! json_encode($provinces->toArray()) !!};
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
	$('#province_form').on('submit',function(e){
		e.preventDefault();
		$(".loading").show();
		var id = $("#province_id").val();
		if(toDelete) {
			$('#province_form').ajaxSubmit({
	            url:  "{{ url('/province-delete') }}/"+id,
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
			$('#province_form').ajaxSubmit({
	            url:  "{{ url('/province-store') }}",
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

	function getDataFromProvince(ele) {
		$("#myModalLabel").html('Update Province');
    	$("#province_id").val($(ele).data('id'));
    	const edit = [];
    	$.each(provinces, function(key, value) {
	        if(value.id == $(ele).data('id')) {
	        	edit.push(value);
	        }
	    });

	    $("input[name=prov_name]").val(edit[0].prov_name);
	    $("input[name=prov_psgc]").val(edit[0].prov_psgc);
	    $("#deleteBtn").removeClass("hide");
	}
	$('#province_modal').on('hidden.bs.modal', function () {
		$("#myModalLabel").html('Add Province');
		$("input[name=prov_name]").val('');
	    $("input[name=prov_psgc]").val('');
	    $("#province_id").val('');
	    $("#deleteBtn").addClass("hide");
	});
</script>