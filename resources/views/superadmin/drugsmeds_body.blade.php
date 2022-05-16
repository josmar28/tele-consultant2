<?php
$number = App\DrugsMeds::select('drugcode')->orderby('id','desc')->first();
if(isset($number)){
$str = ltrim($number->drugcode, '0');
$inc = $str + 1;
$leadz = str_pad($inc, 6, '0', STR_PAD_LEFT);
}
$val = '000001';
$one = '1';

$fac_id = Session::get('auth')->facility_id;
?>

<form action="{{ asset('drugsmeds/drugsmeds/add') }}" method="POST">
      		{{ csrf_field() }}
          <input type="hidden" class="form-control" value="@if(isset($data->id)){{ $data->id }}@endif" autofocus="" name="id">
          <input type="hidden" class="form-control" value="1" autofocus="" name="void">
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
              <label>Drugs/Meds Code:</label>
                @if(isset($data->drugcode))
                <input type="text" class="form-control" value="{{$data->drugcode}}" disabled>
              <input type="hidden" class="form-control" value="{{$data->drugcode}}" name="drugcode">
                @else
              <input type="text" class="form-control" value="@if(isset($number)){{ $leadz }}@else{{$val}}@endif" disabled>
              <input type="hidden" class="form-control" value="@if(isset($number)){{ $leadz }}@else{{$val}}@endif" name="drugcode">
                @endif
            </div>
          <div class="form-group">
              <label>Drugs/Meds Description:</label>
              <input type="text" class="form-control" value="@if(isset($data->drugdescription)){{ $data->drugdescription }}@endif" name="drugdescription" required>
          </div>
    <div class="form-group">
        <label>Drugs/Meds Sub Category:</label>
        <!-- <input type="text" class="form-control" value="@if(isset($data->diagmaincat)){{ $data->diagmaincat }}@endif" name="diagmaincat"> -->
        <select name="subcat_id" class="form-control" required>
           <option value="">Select Sub Category</option>
           <?php
            $subcat = App\DrugsMedsSubcat::all()
            ->where('isactive',1);
           ?>
             @foreach($subcat as $row)
          <option @if(isset($data->subcat_id)) {{ ($data->subcat_id == $row->id ? 'selected' : '') }}@endif value="{{ $row->id }}"> {{ $row->subcat_name }}</option>
              @endforeach
         </select>
    </div>
    <div class="form-group">
        <label>Drugs/Meds Unit of Measure:</label>
        <!-- <input type="text" class="form-control" value="@if(isset($data->diagmaincat)){{ $data->diagmaincat }}@endif" name="diagmaincat"> -->
        <select name="unitofmes_id" class="form-control" required>
           <option value="">Select Unit of Measure</option>
           <?php
            $unitofmes = App\UnitofMes::all()
            ->where('isactive',1);
           ?>
             @foreach($unitofmes as $row)
          <option @if(isset($data->unitofmes_id)) {{ ($data->unitofmes_id == $row->id ? 'selected' : '') }}@endif value="{{ $row->id }}"> {{ $row->unit_name }}</option>
              @endforeach
         </select>
    </div>
      <div class="modal-footer">
        @if(isset($data->id))
        <a data-id ="@if(isset($data->id)){{ $data->id }}@endif" data-toggle="modal" class="btn btn-danger btn-sm btn-flat btn_drugremove">
                 <i class="fa fa-trash"></i> Remove
        </a>
        @endif
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;Close</button>
        <button type="submit" class="btnSave btn btn-success"><i class="fas fa-check"></i> Save</button>
  	</form>
      </div>
    <script>
   $('.btn_drugremove').click(function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $('#drugRemove').data('id',id).modal('show');
        });

    $('.drugRemoveConfirm').click(function (){
        var json;
        var id = $('#drugRemove').data('id');
        var url = "<?php echo asset('drugsmeds/drugsmeds/delete') ?>";
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