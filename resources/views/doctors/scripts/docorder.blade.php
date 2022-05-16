<script>
	var docorder = {!! json_encode($docorder->toArray()) !!};
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
    $('#docorder_form').on('submit',function(e){
		e.preventDefault();
        $(".loading").show();
        var labreq = $("#labrequestcodes").val();
        var img = $("#imagingrequestcodes").val();
		$('#docorder_form').ajaxSubmit({
            url:  "{{ url('/docorder-store') }}",
            type: "POST",
            data: {
            	labrequestcodes: labreq,
				imagingrequestcodes: img
            },
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
	});

	function getData(id) {
		$("#myModalLabel").html('Update Doctor Order');
		$("#deleteBtn").removeClass("hide");
		$("#id").val(id);
		const edit = [];
    	$.each(docorder, function(key, value) {
	        if(value.id == id) {
	        	edit.push(value);
	        }
	    });
	    if(edit.length > 0) {
	    	var labreq = edit[0].labrequestcodes.split(',');
	    	var img = edit[0].imagingrequestcodes.split(',');
	    	$('#patientid').val(edit[0].patientid).change();
	    	$('#labrequestcodes').val(labreq).change();
	    	$('#imagingrequestcodes').val(img).change();
	    	$('textarea[name=alertdescription]').append(edit[0].alertdescription);
	    	$('textarea[name=treatmentplan]').append(edit[0].treatmentplan);
	    	$('textarea[name=remarks]').append(edit[0].remarks);
	    }
	}

	$('#docorder_modal').on('hidden.bs.modal', function () {
		$("#deleteBtn").addClass("hide");
		$("#myModalLabel").html('Add Doctor Order');
		$('#patientid').val('').change();
    	$('#labrequestcodes').val([]).change();
    	$('#imagingrequestcodes').val([]).change();
    	$('textarea[name=alertdescription]').append('');
    	$('textarea[name=treatmentplan]').append('');
    	$('textarea[name=remarks]').append('');
	});

	$( "#deleteBtn" ).click(function() {
		toDelete = 'yes';
        var id = $("#id").val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:  "{{ url('/docorder-delete') }}/"+id,
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
	});
</script>