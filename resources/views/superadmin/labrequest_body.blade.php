<?php
$rad = App\LabRequest::select('req_code')->where('req_code',"like","%RAD%")
->orderby('id','desc')->first();

$lab = App\LabRequest::select('req_code')->where('req_code',"like","%LAB%")
->orderby('id','desc')->first();

if(isset($rad))
{
$str1 = ltrim($rad->req_code, 'RAD');
$inc = $str1 + 1;
$leadz = str_pad($inc, 5, '0', STR_PAD_LEFT);
$rad_val = 'RAD'.$leadz;
}else
{
 $rad_val = 'RAD00001';
}
if (isset($lab))
{
    $strr1 = ltrim($lab->req_code, 'LAB');
    $incc = $strr1 + 1;
    $leadzz = str_pad($incc, 5, '0', STR_PAD_LEFT);
    $lab_val = 'LAB'.$leadzz;
}
else
{
 $lab_val= 'LAB00001';
}

$fac_id = Session::get('auth')->facility_id; 
?>
<form action="{{ asset('superadmin/lab_request/add') }}" method="POST">
      		{{ csrf_field() }}
          <input type="hidden" class="form-control" value="@if(isset($data->id)){{ $data->id }}@endif" autofocus="" name="id">
          <input type="hidden" class="form-control" value="1" autofocus="" name="isactive">
            <div class="form-group">
            <label>For General use:</label>
                    <label>
                        <input type="radio" id="isgeneral" name="isgeneral" value="1" @if(isset($data->isgeneral)) {{ ($data->isgeneral == "1") ? "checked" : "" }} @endif required/>Yes
                    </label>
                    <label>
                        <input type="radio" id="isgeneral" name="isgeneral" value="{{$fac_id}}"  @if(isset($data->isgeneral)) {{ ($data->isgeneral != "1") ? "checked" : "" }} @endif required />No
                    </label>
            </div>
            <div class="form-group">
            <label>Lab Request type:</label>
                    <label>
                        <input type="radio" class="req_type" name="req_type" value="LAB" @if(isset($data->req_type)) {{ ($data->req_type == "LAB") ? "checked" : "" }} @endif required />Laboratory
                    </label>
                    <label>
                        <input type="radio" class="req_type" name="req_type" value="RAD" @if(isset($data->req_type)) {{ ($data->req_type == "RAD") ? "checked" : "" }} @endif required />Imaging
                    </label>
            </div>
      		<div class="form-group">
              <label>Lab Request Code:</label>
                @if(isset($data->req_code)) 
                <input type="text" class="form-control" value="{{$data->req_code}}" disabled>
              <input type="hidden" class="form-control" value="{{$data->req_code}}" name="drugcode">
                @else
                <input type="text" class="form-control hide rad_val" value="@if(isset($rad_val)){{ $rad_val }}@endif" disabled>
                 <input type="hidden" class="form-control rad_val1" value="@if(isset($rad_val)){{ $rad_val }}@endif" name="req_code" disabled>
                 <input type="text" class="form-control hide lab_val" value="@if(isset($lab_val)){{ $lab_val }}@endif" disabled>
                 <input type="hidden" class="form-control lab_val1" value="@if(isset($lab_val)){{ $lab_val }}@endif" name="req_code" disabled>
                @endif
            </div>
          <div class="form-group">
              <label>Lab Request Description:</label>
              <input type="text" class="form-control" value="@if(isset($data->description)){{ $data->description }}@endif" name="description" required>
          </div>
    <div class="form-group">
        <label>Lab Request Unit of Measure:</label>
        <!-- <input type="text" class="form-control" value="@if(isset($data->diagmaincat)){{ $data->diagmaincat }}@endif" name="diagmaincat"> -->
        <select name="uom_id" class="form-control" required>
           <option value="">Select Unit of Measure</option>
           <?php
            $unitofmes = App\UnitofMes::all()
            ->where('isactive',1);
           ?>
             @foreach($unitofmes as $row)
          <option @if(isset($data->uom_id)) {{ ($data->uom_id == $row->id ? 'selected' : '') }}@endif value="{{ $row->id }}"> {{ $row->unit_name }}</option>
              @endforeach
         </select>
    </div>
      <div class="modal-footer">
        @if(isset($data->id))
        <a data-id ="@if(isset($data->id)){{ $data->id }}@endif" data-toggle="modal" class="btn btn-danger btn-sm btn-flat btn_requestremove">
                 <i class="fa fa-trash"></i> Remove
        </a>
        @endif
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;Close</button>
        <button type="submit" class="btnSave btn btn-success"><i class="fas fa-check"></i> Save</button>
  	</form>
      </div>
    <script>

    $('.req_type').click(function(){
        var val2 = $(this).val();
        var ini = '00001';
    if(val2 == 'LAB')
    {
        $('.rad_val').addClass('hide');
        $('.rad_val1').attr('disabled','disabled');
        $('.lab_val').removeClass('hide');
        $('.lab_val1').removeAttr("disabled");
    }else if (val2 == 'RAD')
    {
        $('.lab_val').addClass('hide');
        $('.lab_val1').attr('disabled','disabled');
        $('.rad_val').removeClass('hide');
        $('.rad_val1').removeAttr("disabled");
    }

    });    

   $('.btn_requestremove').click(function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $('#requestRemove').data('id',id).modal('show');
        });

    $('.confirmRemoveRequest').click(function (){
        var json;
        var id = $('#requestRemove').data('id');
        var url = "<?php echo asset('superadmin/lab_request/delete') ?>";
        json = {
                    "id" : id,
                    "_token" : "<?php echo csrf_token()?>"
                };
                $.ajax({
                url: url,
                data: json,
                type: 'POST',
                success: function(data){
                    Lobibox.notify('warning', {
                        msg: 'Removed successfully!'
                    });
                    setTimeout(function(){
                    location.reload();
                },1000);
                }
            });
    });
    </script>