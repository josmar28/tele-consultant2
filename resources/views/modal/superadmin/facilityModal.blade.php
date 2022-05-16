<div class="modal fade" id="facility_modal" role="dialog" aria-labelledby="users_modal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add Facility</h4>
      </div>
      <div class="modal-body">
      	<form id="facility_form" method="POST">
      		{{ csrf_field() }}
          <div class="text-right">
            <button id="deleteBtn" type="submit" class="btnSave btn btn-danger hide"><i class="fas fa-trash"></i> Delete</button>
          </div>
      		<div class="form-group">
		        <input type="hidden" class="form-control" value="" name="facility_id" id="facility_id">
            <label>Facility Name:</label>
		        <input type="text" class="form-control" value="" autofocus="" name="facilityname" required="">
		    </div>
		    <div class="form-group">
		        <label>Facility Code:</label>
		        <input type="text" class="form-control" value="" name="fshortcode" required="">
		    </div>
		    <div class="form-group">
		        <label>Abbr:</label>
		        <input type="text" class="form-control" value="" name="oldfacilityname">
		    </div>
        <hr>
		    <div class="form-group">
		    	<label>Province:</label>
		    	<select class="select2" name="prov_psgc" id="province" required>
              <option>Select Province</option>
              @foreach($province as $row)
                  <option value="{{ $row->prov_psgc }}">{{ $row->prov_name }}</option>
              @endforeach
          </select>
		    </div>
        <div class="form-group hide" id="divMun">
          <label>Municipality:</label>
          <select class="select2" name="muni_psgc" id="municipality" required>
              <option>Select Municipality</option>
          </select>
        </div>
        <div class="form-group hide" id="divBrgy">
          <label>Barangay:</label>
          <select class="select2" name="brgy_psgc" id="barangay" required>
              <option value="">Select Barangay</option>
          </select>
        </div>
         <div class="form-group">
            <label>Address:</label>
            <input type="text" class="form-control" value="" name="streetname" required>
        </div>
         <div class="form-group">
            <label>Contact:</label>
            <input type="text" class="form-control" value="" name="landlineno" required>
        </div>
        <hr>
        <div class="form-group">
            <label>Fax Number:</label>
            <input type="text" class="form-control" value="" name="faxnumber">
        </div>
         <div class="form-group">
            <label>Email:</label>
            <input type="text" class="form-control" value="" name="emailaddress">
        </div>
        <div class="form-group">
            <label>Official Website URL:</label>
            <input type="text" class="form-control" value="" name="officialwebsiteurl">
        </div>
        <hr>
         <div class="form-group">
            <label>Facility Head:</label>
            <div class="row">
              <div class="col-md-4">
                <input type="text" class="form-control" value="" name="facilityhead_lname" placeholder="Last name">
              </div>
              <div class="col-md-4">
                <input type="text" class="form-control" value="" name="facilityhead_fname" placeholder="First name">
              </div>
              <div class="col-md-4">
                <input type="text" class="form-control" value="" name="facilityhead_mi" placeholder="Middle name">
              </div>
            </div>
        </div>
        <div class="form-group">
            <label>Position:</label>
            <input type="text" class="form-control" value="" name="facilityhead_position">
        </div>
        <hr>
        <div class="form-group">
            <label>Ownership:</label>
            <input type="text" class="form-control" value="" name="ownership">
        </div>
        <div class="form-group">
            <label>Status:</label>
            <select class="form-control" name="status">
                <option value="1" selected="">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
        <div class="form-group">
            <label>Hospital License Status:</label>
            <select class="form-control" name="hosp_licensestatus" required>
              <option value="" selected>Select License Status</option>
                <option value="With License">With License</option>
                <option value="Without License">Without License</option>
                <option value="N/A">N/A</option>
            </select>
        </div>
        <div class="form-group">
            <label>Service Capability:</label>
            <select class="form-control" name="hosp_servcapability" required>
              <option value="" selected>Select Service Capability</option>
                <option value="Level 1">Level 1</option>
                <option value="Level 2">Level 2</option>
                <option value="Level 3">Level 3</option>
                <option value="Level 4">Level 4</option>
                <option value="Infirmary">Infirmary</option>
            </select>
        </div>
        <div class="form-group">
            <label>Bed Capacity:</label>
            <input type="text" class="form-control" value="" name="hosp_bedcapacity">
        </div>
        <div class="form-group">
            <label>Latitude:</label>
            <input type="text" class="form-control" value="" name="latitude">
        </div>
        <div class="form-group">
            <label>Longitude:</label>
            <input type="text" class="form-control" value="" name="longitude">
        </div>
        <hr>
        <div class="form-group">
            <label>Remarks:</label>
          <textarea class="form-control" rows="2" name="remarks"></textarea>
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