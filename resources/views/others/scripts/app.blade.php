<script>
    var loc = '';
    var interval;
    $('.searchPat').on('keyup',function(){
        var searchTerm = $(this).val().toLowerCase();
        $('#patientTable tbody tr').each(function(){
            var lineStr = $(this).text().toLowerCase();
            if(lineStr.indexOf(searchTerm) === -1){
                $(this).hide();
            }else{
                $(this).show();
            }
        });
    });

    function seturl(set) {
        loc = set
    }
    function gourl(id) {
        var url = "{{ url('patient') }}"+"/"+loc+"/"+id;
        $.ajax({
            url: url,
            type: 'GET',
            async: false,
            success: function(data){
                window.location.href = url;
            },
            error : function(data){
                Lobibox.notify('error', {
                    title: "",
                    msg: "Something Went Wrong. Please Try again.",
                    size: 'mini',
                    rounded: true
                });
            }
        });
    }
    var active = "{{Session::get('auth')->level}}";
    if(active == 'admin') {
        var last_update = "<?php 
            $token = \App\ZoomToken::where('facility_id',$user->facility_id)->first() ?
                                \App\ZoomToken::where('facility_id',$user->facility_id)->first()->updated_at
                                : 'none';
            echo $token;
            ?>";
        var zoomtoken = last_update == 'none' ? '' : new Date(last_update);
        var expirewill = last_update != 'none' ? zoomtoken.setHours(zoomtoken.getHours() + 1) : '';
        $('.countdowntoken').countdown(expirewill, function(event) {
            if(event.strftime('%H:%M:%S') == '00:00:00') {
                if(last_update == 'none') {
                    $(this).html('Facility don\'t have access token.');
                } else {
                  $(this).html('Your access token was expired.');
                }
            } else {
                $(this).html('Zoom Token validation left: '+ event.strftime('%M:%S'));
                $('#acceptBtn').prop("disabled", false);
            }
        });
        function refreshToken() {
            var url = "{{ url('/refresh-token') }}";
            $.ajax({
                url: url,
                type: 'GET',
                async: false,
                success : function(data){
                    var val = JSON.parse(data);
                    if(val.updated_at != last_update) {
                        last_update = val.updated_at;
                        zoomtoken = new Date(last_update);
                        expirewill = zoomtoken.setHours(zoomtoken.getHours() + 1);
                        $('.countdowntoken').countdown(expirewill, function(event) {
                            if(event.strftime('%H:%M:%S') == '00:00:00') {
                              $(this).html('Your access token is expired.');
                              $('.refTok').html('Refresh your token here');
                              $('#acceptBtn').prop("disabled", true);
                            } else {
                                $(this).html('Your access token will expire in '+ event.strftime('%H:%M:%S'));
                                $('#acceptBtn').prop("disabled", false);
                            }
                        });
                        clearInterval(interval);
                    }
                }
            });
        }
        $('.refTok').on('click',function () {
            interval = setInterval(refreshToken, 5000);
        });
    }
    $(document).ready(function() {
        $(".select2").select2();
        $('[data-toggle="tooltip"]').tooltip();   
    });
    function refreshPage(){
        <?php
            use Illuminate\Support\Facades\Route;
            $current_route = Route::getFacadeRoot()->current()->uri();
        ?>
        $('.loading').show();
        window.location.replace("<?php echo asset($current_route) ?>");
    }

    function loadPage(){
        $('.loading').show();
    }
    //Get the button
    var mybutton = document.getElementById("myBtn");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        $('body,html').animate({
            scrollTop : 0 // Scroll to top of body
        }, 500);
    }

    $('#webex_form').on('submit',function(e){
        e.preventDefault();
        $('.btnSaveWebex').html('<i class="fa fa-spinner fa-spin"></i> Saving...');
        $('#webex_form').ajaxSubmit({
            url:  "{{ url('/webex-token') }}",
            type: "POST",
            success: function(data){
                setTimeout(function(){
                    window.location.reload(false);
                },500);
            },
        });
    });
    $('#feedback').click(function(){
            var url = $(this).data('link');
            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    $('.feedback_body').html(data);
                }
            });
        });


        @if(Session::get('feedback_add'))
        Lobibox.notify('success', {
            title: "",
            msg: "Successfully added Feedback",
            size: 'mini',
            rounded: true
        });
        <?php
            Session::put("feedback_add",false);
        ?>
    @endif
</script>