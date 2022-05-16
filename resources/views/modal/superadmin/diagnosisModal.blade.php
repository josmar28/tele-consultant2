<div class="modal fade" id="diagnosis_modal" role="dialog" aria-labelledby="users_modal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add Diagnosis</h4>
      </div>
      <div class="modal-body">
      	<form id="diagnosis_form" method="POST">
      		{{ csrf_field() }}
          <div class="text-right">
            <button id="deleteBtn" type="submit" class="btnSave btn btn-danger hide"><i class="fas fa-trash"></i> Delete</button>
          </div>
          <input type="hidden" class="form-control" value="" autofocus="" name="diagnosis_id" id="diagnosis_id">
      		<div class="form-group">
              <label>Daignosis Code:</label>
              <input type="text" class="form-control" value="" autofocus="" name="diagcode" required="">
          </div>
          <div class="form-group">
              <label>Diagnosis Description:</label>
              <input type="text" class="form-control" value="" name="diagdesc">
          </div>
          <div class="form-group">
            <label>Diagnosis Main Category:</label>
            <select class="select2" name="diagmaincat" id="diagmaincat" required>
                <option>Select Main Category</option>
                @foreach($maincats as $row)
                    <option value="{{ $row->diagcat }}">{{ $row->diagcat }}</option>
                @endforeach
            </select>
          </div>
          <div class="form-group hide" id="divCat">
            <label>Diagnosis Category:</label>
            <select class="select2" name="diagcategory" id="diagcategory" required>
                <option>Select Category</option>
            </select>
          </div>
          <div class="form-group">
              <label>Diagnosis Sub Category:</label>
              <input type="text" class="form-control" value="" name="diagsubcat" required="">
          </div>
          <div class="form-group">
              <small class="text-success">Diagnosis Priority:</small><br>
                <label><input type="radio" id ="diagpriority" name="diagpriority" value="Y" required>Y</label>
                <label><input type="radio" id ="diagpriority" name="diagpriority" value="N" required="" />N</label>
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