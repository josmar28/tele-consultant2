<script>
	var maincats = {!! json_encode($maincats->toArray()) !!};
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
	$('#main_cat_form').on('submit',function(e){
		e.preventDefault();
		$(".loading").show();
		if(toDelete) {
			var id = $("#main_id").val();
			$('#main_cat_form').ajaxSubmit({
	            url:  "{{ url('/main-cat-delete') }}/"+id,
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
			$('#main_cat_form').ajaxSubmit({
	            url:  "{{ url('/main-cat-store') }}",
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
    	$("#main_id").val($(ele).data('id'));
    	$("#deleteBtn").removeClass("hide");
    	const edit = [];
    	$.each(maincats, function(key, value) {
	        if(value.id == $(ele).data('id')) {
	        	edit.push(value);
	        }
	    });
	    $("input[name=diagcat]").val(edit[0].diagcat);
	    $("input[name=catdesc]").val(edit[0].catdesc);
	}
	$('#main_cat_modal').on('hidden.bs.modal', function () {
		$("#deleteBtn").addClass("hide");
		$("input[name=diagcat]").val('');
	    $("input[name=catdesc]").val('');
	});
</script>