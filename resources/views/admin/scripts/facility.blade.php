<script>
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
	function enableView() {
		$('#formEdit').removeClass('disAble');
		$( 'input[name="facilityname"]' ).focus();
		$( '.btnSave' ).removeClass('hide');
		$( '#btnEdit' ).addClass('hide');
	}

	$('#province').on('change', function() {
		var id = this.value;
		if(id) {
			$.ajax({
	            url: "facilities/"+id+"/municipality",
	            method: 'GET',
	            success: function(result) {
	            	$('#muni_psgc').empty();
				  	$.each(result.municipal,function(key,value){
                        $('#muni_psgc').append($("<option/>", {
                           value: value.muni_psgc,
                           text: value.muni_name
                        }));
                    });
	            }
	        });
		}
	});
	$('#muni_psgc').on('change', function() {
		var id = this.value;
		$.ajax({
            url: "facilities/"+id+"/barangay",
            method: 'GET',
            success: function(result) {
            	 $.each(result.barangay,function(key,value){
                    $('#barangay').append($("<option/>", {
                       value: value.brg_psgc,
                       text: value.brg_name
                    }));
                });
            }
        });
	});

	$('#facility_form').on('submit',function(e){
		e.preventDefault();
        $(".loading").show();
		$('#facility_form').ajaxSubmit({
            url:  "{{ url('/update-facility') }}",
            type: "POST",
            success: function(data){
                setTimeout(function(){
                    window.location.reload(false);
                },500);
            },
        });
	});

    $( window ).scroll(function() {
      if($(window).scrollTop() > 250) {
        $( '.btnSave' ).addClass('btnSaveMove');
      } else {
        $( '.btnSave' ).removeClass('btnSaveMove');
      }
    });
</script>