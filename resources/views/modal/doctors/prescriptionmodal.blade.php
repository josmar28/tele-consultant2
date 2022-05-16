<div class="modal fade" id="prescription_modal" role="dialog" aria-labelledby="prescription_modal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add Prescription</h4>
      </div>
      <div class="modal-body">
      	<form id="prescription_form" method="POST">
      		{{ csrf_field() }}
          <div class="text-right">
            <button id="deleteBtn" type="submit" class="btnSave btn btn-danger hide"><i class="fas fa-trash"></i> Delete</button>
          </div>
          <input type="hidden" class="form-control" value="" autofocus="" name="id" id="id">
      		<div class="form-group">
              <label>Prescription Code:</label>
              <input type="text" class="form-control" value="{{ $pres_code }}" autofocus="" name="presc_code" readonly>
          </div>
          <div class="form-group">
            <label>Type of Medicine:</label>
            <select class="select2" name="type_of_medicine" id="type_of_medicine" required>
                <option>Select Type of Medicine</option>
                    <option value="1">General Drug</option>
                    <option value="0">Specific Facility Druglist</option>
            </select>
          </div>
          <div class="form-group">
            <label>Drug Code:</label>
            <select class="select2" name="drug_id" id="drug_id" required>
                <option>Select Drugs/Meds</option>
                @foreach($drugmed as $row)
                    <option value="{{ $row->id }}">{{ $row->drugcode }}</option>
                @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Frequency:</label>
            <select class="select2" name="frequency" id="frequency" required>
                <option>Select Frequency</option>
                    <option value="D">DAILY</option>
                    <option value="I">INDEFINITE</option>
                    <option value="M">MONTHLY</option>
                    <option value="O">OTHERS</option>
                    <option value="Q">QUARTERLY</option>
                    <option value="W">WEEKLY</option>
                    <option value="Y">YEARLY</option>
            </select>
          </div>
          <div class="form-group">
            <label>Dose Regimen:</label>
            <select class="select2" name="dose_regimen" id="dose_regimen" required>
                <option>Select Dose Regimen</option>
                    <option value="BID">2 X A DAY - EVERY 12 HOURS</option>
                    <option value="TID">3 X A DAY - EVERY 8 HOURS</option>
                    <option value="QID">4 X A DAY - EVERY 6 HOURS</option>
                    <option value="QHS">EVERY BEDTIME</option>
                    <option value="QOD">EVERY OTHER DAY</option>
                    <option value="OD">ONCE A DAY</option>
                    <option value="OTH">OTHERS</option>
            </select>
          </div>
          <div class="form-group">
              <label>Quantity:</label>
              <input type="text" class="form-control" name="total_qty" required>
          </div>
          <div class="form-group">
              <label>Medication:</label>
              <input type="text" class="form-control" name="medication">
          </div>
          <div class="form-group">
            <label>Prescribe By:</label>
            <select class="select2" name="prescribebyid" id="prescribebyid" required>
                <option>Select Doctor</option>
                @foreach($doctors as $row)
                    <option value="{{ $row->id }}">{{ $row->lname }}, {{ $row->fname }} {{ $row->mname }}</option>
                @endforeach
            </select>
          </div>
          <div class="form-group">
              <label>Encoded By:</label>
              <input type="text" class="encodedBy form-control" value="{{ $user->lname }}, {{ $user->fname }} {{ $user->mname }}" disabled>
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