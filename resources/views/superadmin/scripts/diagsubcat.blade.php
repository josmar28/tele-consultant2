<script>
	var subcats = {!! json_encode($subcats->toArray()) !!};
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
	$('#sub_cat_form').on('submit',function(e){
		e.preventDefault();
		$(".loading").show();
		if(toDelete) {
			var id = $("#sub_id").val();
			$('#sub_cat_form').ajaxSubmit({
	            url:  "{{ url('/sub-cat-delete') }}/"+id,
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
			$('#sub_cat_form').ajaxSubmit({
	            url:  "{{ url('/sub-cat-store') }}",
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

	function getDataFromData(ele) {
		$("#myModalLabel").html('Update Diagnosis');
    	$("#sub_id").val($(ele).data('id'));
    	$("#deleteBtn").removeClass("hide");
    	const edit = [];
    	$.each(subcats, function(key, value) {
	        if(value.id == $(ele).data('id')) {
	        	edit.push(value);
	        }
	    });
	    $("input[name=diagsubcat]").val(edit[0].diagsubcat);
	    $("input[name=diagscatdesc]").val(edit[0].diagscatdesc);
	    $("[name=diagmcat]").select2().select2('val', edit[0].diagmcat);
	}
	$('#main_cat_modal').on('hidden.bs.modal', function () {
		$("#deleteBtn").addClass("hide");
		$("input[name=diagsubcat]").val('');
	    $("input[name=diagscatdesc]").val('');
	    $("[name=diagmcat]").select2().select2('val', '');
	});
</script>