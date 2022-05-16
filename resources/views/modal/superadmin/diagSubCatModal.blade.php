<div class="modal fade" id="main_cat_modal" role="dialog" aria-labelledby="users_modal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add Diagnosis</h4>
      </div>
      <div class="modal-body">
      	<form id="sub_cat_form" method="POST">
      		{{ csrf_field() }}
          <div class="text-right">
            <button id="deleteBtn" type="submit" class="btnSave btn btn-danger hide"><i class="fas fa-trash"></i> Delete</button>
          </div>
          <input type="hidden" class="form-control" value="" autofocus="" name="sub_id" id="sub_id">
          <div class="form-group">
            <label>Diagnosis Main Category:</label>
            <select class="select2" name="diagmcat" id="diagmcat" required>
                <option>Select Main Category Code</option>
                @foreach($maincats as $row)
                    <option value="{{ $row->diagcat }}">{{ $row->diagcat }}</option>
                @endforeach
            </select>
          </div>
      		<div class="form-group">
              <label>Diagnosis Sub Category Code:</label>
              <input type="text" class="form-control" value="" name="diagsubcat">
          </div>
          <div class="form-group">
              <label>Diagnosis Sub Category Description:</label>
              <input type="text" class="form-control" value="" name="diagscatdesc">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;Close</button>
        <button type="submit" class="btnSave btn btn-success"><i class="fas fa-check"></i> Save</button>
  	</form>
      </div>
    </div>
  </div>
</div>