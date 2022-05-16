<?php
    $user = Session::get('auth');
    $status = session::get('status');
?>
<form id="patient_form" method="POST">
 
    @if(isset($data->patient_id))
    <fieldset>
        <legend><i class="fa fa-pencil"></i> Update Patient</legend>
    </fieldset>
    @else
    <fieldset>
        <legend><i class="fa fa-pencil"></i> Add Patient</legend>
    </fieldset>
    @endif

    {{ csrf_field() }}
<div class="row">
     <div class="col-sm-6">
        <div class="form-group">
            <input type="hidden" name="patient_id" value="@if(isset($data->patient_id)){{ $data->patient_id }}@endif">
            <label>PhilHealth Status:</label>
            <select class="form-control" name="phic_status" required>
                <option
                <?php
                    if(isset($data->phic_status)){
                        if($data->phic_status == "None"){
                            echo 'selected';
                        }
                    }
                ?>
                >None</option>
                <option
                <?php
                    if(isset($data->phic_status)){
                        if($data->phic_status == "Member"){
                            echo 'selected';
                        }
                    }
                ?>
                >Member</option>
                <option
                <?php
                    if(isset($data->phic_status)){
                        if($data->phic_status == "Dependent"){
                            echo 'selected';
                        }
                    }
                ?>
                >Dependent</option>
            </select>
        </div>
     </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>PhilHealth ID:</label>
            <input type="text" class="form-control" value="@if(isset($data->phic_id)){{ $data->phic_id }}@endif" autofocus name="phic_id">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>First Name:</label>
            <input type="text" class="form-control" value="@if(isset($data->fname)){{ $data->fname }}@endif" name="fname" required>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Middle Name:</label>
            <input type="text" class="form-control" value="@if(isset($data->mname)){{ $data->mname }}@endif" name="mname">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>Last Name:</label>
            <input type="text" class="form-control" value="@if(isset($data->lname)){{ $data->lname }}@endif" name="lname" required>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Contact Number:</label>
            <input type="text" class="form-control" value="@if(isset($data->contact)){{ $data->contact }}@endif" name="contact" required>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>Birth Date:</label>
            <input type="date" class="form-control" value="@if(isset($data->dob)){{ $data->dob }}@endif" min="1910-05-11" max="{{ date('Y-m-d') }}" name="dob" required>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Sex:</label>
            <select class="form-control" name="sex" required>
                <option
                <?php
                    if(isset($data->sex)){
                        if($data->sex == 'Male'){
                            echo 'selected';
                        }
                    }
                ?>
                >Male
                </option>
                <option
                <?php
                    if(isset($data->sex)){
                        if($data->sex == 'Female'){
                            echo 'selected';
                        }
                    }
                ?>
                >Female</option>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>Civil Status:</label>
            <select class="form-control" name="civil_status" required>
                <option
                    <?php
                        if(isset($data->civil_status)){
                            if($data->civil_status == 'Single'){
                                echo 'selected';
                            }
                        }
                    ?>
                >Single</option>
                <option
                    <?php
                        if(isset($data->civil_status)){
                            if($data->civil_status == 'Married'){
                                echo 'selected';
                            }
                        }
                    ?>
                >Married</option>
                <option
                    <?php
                        if(isset($data->civil_status)){
                            if($data->civil_status == 'Divorced'){
                                echo 'selected';
                            }
                        }
                    ?>
                >Divorced</option>
                <option
                    <?php
                        if(isset($data->civil_status)){
                            if($data->civil_status == 'Separated'){
                                echo 'selected';
                            }
                        }
                    ?>
                >Separated</option>
                <option
                    <?php
                        if(isset($data->civil_status)){
                            if($data->civil_status == 'Widowed'){
                                echo 'selected';
                            }
                        }
                    ?>
                >Widowed</option>
            </select>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Municipality:</label>
            <select class="form-control muncity filter_muncity select2" name="muncity" required>
        <option value="">Select Municipal/City...</option>
              @foreach($municity as $m)
                <option value="{{ $m->m_id }}">{{ $m->muncity }}</option>
                 @endforeach 
             <option value="others">Others</option>
              </select>
          
        </div>
    </div>
</div>
    <div class="form-group barangay_holder">
        <label>Barangay:</label>
        <select class="form-control barangay select2" name="brgy" required>
            <option value="">Select Barangay...</option>
        </select>
    </div>
    <div class="has-group others_holder hide">
         <label>Complete Address :</label>
        <input type="text" name="address" class="form-control others" placeholder="Enter complete address..." />
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="button" value="true" id="saveBtn" name="patient_update_button" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Save</button>
    </div>
</form>

<script>
     $('.select_phic').on('change',function(){
        var status = $(this).val();
        if(status!='None'){
            $('.phicID').attr('disabled',false);
        }else{
            $('.phicID').val('').attr('disabled',true);
        }
    });

    var muncity_id = 0;
    $('.filter_muncity').on('change',function(){
        muncity_id = $(this).val();
        if(muncity_id!='others'){
            $('.filter_muncity').val(muncity_id);
            var brgy = getBarangay();
            $('.barangay').empty()
                .append($('<option>', {
                    value: '',
                    text : 'Select Barangay...'
                }));
            jQuery.each(brgy, function(i,val){
                $('.barangay').append($('<option>', {
                    value: val.brg_psgc,
                    text : val.brg_name
                }));

            });
            $('.barangay_holder').show();
            $('.barangay').attr('required',true);
            $('.others_holder').addClass('hide');
            $('.others').attr('required',false);
        }else{
            $('.barangay_holder').hide();
            $('.barangay').attr('required',false);
            $('.others_holder').removeClass('hide');
            $('.others').attr('required',true);
        }

    });

    function getBarangay()
    {
        $('.loading').show();
        var url = "{{ url('location/barangay') }}";
        var tmp;
        $.ajax({
            url: url+"/"+muncity_id,
            type: 'GET',
            async: false,
            success : function(data){
                tmp = data;
                setTimeout(function(){
                    $('.loading').hide();
                },500);
            }
        });
        return tmp;
    }
    $( "#saveBtn" ).click(function() {
        $('#patient_form').ajaxSubmit({
            url:  "{{ url('/patient-store') }}",
            type: "POST",
            success: function(data){
                setTimeout(function(){
                    window.location.reload(false);
                },500);
            },
        });
    });
</script>



