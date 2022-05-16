<div class="modal fade" id="brgy_modal" role="dialog" aria-labelledby="users_modal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add Municipality</h4>
      </div>
      <div class="modal-body">
      	<form id="brgy_form" method="POST">
      		{{ csrf_field() }}
          <div class="text-right">
            <button id="deleteBtn" type="submit" class="btnSave btn btn-danger hide"><i class="fas fa-trash"></i> Delete</button>
          </div>
          <input type="hidden" name="prov_psgc" id="prov_psgc" value="{{ $province_id }}">
          <input type="hidden" class="form-control" value="{{ $muncity_id }}" autofocus="" name="muni_psgc" id="muni_psgc">
          <input type="hidden" class="form-control" autofocus="" name="brgy_id" id="brgy_id">
      		<div class="form-group">
              <label>Province Name:</label>
              <input type="text" class="form-control" value="{{ $province_name }}" autofocus="" name="prov_name" readonly>
          </div>
          <div class="form-group">
              <label>Municipality Name:</label>
              <input type="text" class="form-control" value="{{ $muncity_name }}" autofocus="" name="muni_name" readonly>
          </div>
          <hr>
          <div class="form-group">
              <label>Barangay Name:</label>
              <input type="text" class="form-control" value="" autofocus="" name="brg_name">
          </div>
          <div class="form-group">
              <label>Barangay Code:</label>
              <input type="number" class="form-control" value="" name="brg_psgc">
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