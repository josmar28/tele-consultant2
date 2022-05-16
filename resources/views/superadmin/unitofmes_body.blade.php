<form action="{{ asset('drugsmeds/unitofmes/add') }}" method="POST">
      		{{ csrf_field() }}
          <div class="text-right">
            <button id="deleteBtn" type="submit" class="btnSave btn btn-danger hide"><i class="fas fa-trash"></i> Delete</button>
          </div>
          <input type="hidden" class="form-control" value="@if(isset($data->id)){{ $data->id }}@endif" autofocus="" name="id">
          <input type="hidden" class="form-control" value="1" autofocus="" name="isactive">
      		<div class="form-group">
              <label>Unit of Measure Code:</label>
              <input type="text" class="form-control" value="@if(isset($data->unit_code)){{ $data->unit_code }}@endif" name="unit_code">
          </div>
          <div class="form-group">
              <label>Unit of Measure Name:</label>
              <input type="text" class="form-control" value="@if(isset($data->unit_name)){{ $data->unit_name }}@endif" name="unit_name">
          </div>
      </div>
      <div class="modal-footer">
        @if(isset($data->id))
        <a data-id ="@if(isset($data->id)){{ $data->id }}@endif" data-toggle="modal" class="btn btn-danger btn-sm btn-flat btn_removeunit">
                 <i class="fa fa-trash"></i> Remove
        </a>
        @endif
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;Close</button>
        <button type="submit" class="btnSave btn btn-success"><i class="fas fa-check"></i> Save</button>
  	</form>

    <script>
   $('.btn_removeunit').click(function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $('#unitofmesRemove').data('id',id).modal('show');
        });

    $('.confirmRemoveUnit').click(function (){
        var json;
        var id = $('#unitofmesRemove').data('id');
        var url = "<?php echo asset('drugmeds/unitofmes/delete') ?>";
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