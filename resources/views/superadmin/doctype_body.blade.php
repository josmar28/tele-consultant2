<form action="{{ asset('superadmin/doc_type/add') }}" method="POST">
      		{{ csrf_field() }}
          <div class="text-right">
            <button id="deleteBtn" type="submit" class="btnSave btn btn-danger hide"><i class="fas fa-trash"></i> Delete</button>
          </div>
          <input type="hidden" class="form-control" value="@if(isset($data->id)){{ $data->id }}@endif" autofocus="" name="id">
          <input type="hidden" class="form-control" value="1" autofocus="" name="isactive">
      		<div class="form-group">
              <label>Document Name:</label>
              <input type="text" class="form-control" value="@if(isset($data->doc_name)){{ $data->doc_name }}@endif" name="doc_name">
          </div>
      </div>
      <div class="modal-footer">
        @if(isset($data->id))
        <a data-id ="@if(isset($data->id)){{ $data->id }}@endif" data-toggle="modal" class="btn btn-danger btn-sm btn-flat btn_removedoctype">
                 <i class="fa fa-trash"></i> Remove
        </a>
        @endif
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;Close</button>
        <button type="submit" class="btnSave btn btn-success"><i class="fas fa-check"></i> Save</button>
  	</form>

    <script>
   $('.btn_removedoctype').click(function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $('#doctypeRemove').data('id',id).modal('show');
        });

    $('.confirmRemoveDoctype').click(function (){
        var json;
        var id = $('#doctypeRemove').data('id');
        var url = "<?php echo asset('superadmin/doc_type/delete') ?>";
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