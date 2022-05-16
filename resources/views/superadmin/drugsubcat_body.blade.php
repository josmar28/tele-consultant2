<form action="{{ asset('drugsmeds/subcat/add') }}" method="POST">
      		{{ csrf_field() }}
          <input type="hidden" class="form-control" value="@if(isset($data->id)){{ $data->id }}@endif" autofocus="" name="id">
          <input type="hidden" class="form-control" value="1" autofocus="" name="isactive">
      		<div class="form-group">
              <label>Sub Category Code:</label>
              <input type="text" class="form-control" value="@if(isset($data->subcat_code)){{ $data->subcat_code }}@endif" name="subcat_code">
          </div>
          <div class="form-group">
              <label>Sub Category Name:</label>
              <input type="text" class="form-control" value="@if(isset($data->subcat_name)){{ $data->subcat_name }}@endif" name="subcat_name">
          </div>
      </div>
      <div class="modal-footer">
        @if(isset($data->id))
        <a data-id ="@if(isset($data->id)){{ $data->id }}@endif" data-toggle="modal" class="btn btn-danger btn-sm btn-flat btn_subremove">
                 <i class="fa fa-trash"></i> Remove
        </a>
        @endif
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;Close</button>
        <button type="submit" class="btnSave btn btn-success"><i class="fas fa-check"></i> Save</button>
     </div>
   </form>

    <script>
   $('.btn_subremove').click(function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $('#subcatRemove').data('id',id).modal('show');
        });

    $('.subcatRemoveConfirm').click(function (){
        var json;
        var id = $('#subcatRemove').data('id');
        var url = "<?php echo asset('drugsmeds/subcat/delete') ?>";
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