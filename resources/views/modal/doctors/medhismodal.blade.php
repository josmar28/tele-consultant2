<div class="modal fade" id="medhis_modal" role="dialog" aria-labelledby="medhis_modal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalmedhisLabel">Medical History</h4>
      </div>
      <div class="modal-body">
      	<form id="medhis_form" method="POST">
      		{{ csrf_field() }}
          <input type="hidden" id="medhisid">
          <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>History of present illness:</label>
                    <textarea class="form-control" name="history_present_illness" rows="2"></textarea>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Present Medical, Family, Social History:</label>
                    <textarea class="form-control" name="present_med_fam_soc" rows="2"></textarea>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                  <label>ICD10:</label>
                  <div class="input-group">
                      <input type="hidden" name="icd10">
                      <input id="icdDesc" type="text" class="form-control" readonly>
                      <span class="input-group-btn">
                          <button class="btn btn-default revealICD" type="button">Search ICD</button>
                      </span> 
                  </div>
                </div>
            </div>
            <div class="col-sm-6">
              <label>Date of Diagnosis:</label>
              <input type="text" id="date_diagnosis" class="form-control daterange" placeholder="MM/DD/YYYY"/>
            </div>
            <div class="col-sm-6">
              <label>Time of Diagnosis:</label>
                <div class="input-group clockpicker">
                  <input type="text" id="time_diagnosis" class="form-control" placeholder="Time">
                  <span class="input-group-addon">
                      <span class="glyphicon glyphicon-time"></span>
                  </span>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
              <label>Past Medical History:</label>
                <select multiple id="past_med_history" class="select2">
                  <option value="1">Allergy</option>
                  <option value="2">Asthma</option>
                  <option value="3">Cancer</option>
                  <option value="4">Cerebrovascular disease</option>
                  <option value="5">Coronary artery disease</option>
                  <option value="6">Diabetes mellitus</option>
                  <option value="7">Emphysema</option>
                  <option value="8">Epilepsy/Seizure disorder</option>
                  <option value="9">Heart Attack</option>
                  <option value="10">Hepatitis</option>
                  <option value="11">Hyperlipidemia</option>
                  <option value="12">Hypertension</option>
                  <option value="13">Kidney Disease</option>
                  <option value="14">Others</option>
                  <option value="15">Peptic ulcer disease</option>
                  <option value="16">Pneumonia</option>
                  <option value="17">Stroke</option>
                  <option value="18">Thyroid disease</option>
                  <option value="19">Tuberculosis</option>
                  <option value="20">Urinary tract infection</option>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Specify:</label>
                  <input type="text" class="form-control" name="past_specify">
               </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Past Surgical History Operation:</label>
                    <textarea class="form-control" name="past_surg_his_op" rows="2"></textarea>
                </div>
            </div>
            <div class="col-sm-12">
                <label>Date of Surgical:</label>
                <input type="text" id="date_surgical" class="form-control daterange" placeholder="MM/DD/YYYY"/>
            </div>
            <div class="col-md-12">
              <div class="form-group">
              <label>Family History:</label>
                <select multiple id="fam_history" class="select2">
                  <option value="1">Allergy</option>
                  <option value="2">Asthma</option>
                  <option value="3">Cancer</option>
                  <option value="4">Cerebrovascular disease</option>
                  <option value="5">Coronary artery disease</option>
                  <option value="6">Diabetes mellitus</option>
                  <option value="7">Emphysema</option>
                  <option value="8">Epilepsy/Seizure disorder</option>
                  <option value="9">Heart Attack</option>
                  <option value="10">Hepatitis</option>
                  <option value="11">Hyperlipidemia</option>
                  <option value="12">Hypertension</option>
                  <option value="13">Kidney Disease</option>
                  <option value="14">Others</option>
                  <option value="15">Peptic ulcer disease</option>
                  <option value="16">Pneumonia</option>
                  <option value="17">Stroke</option>
                  <option value="18">Thyroid disease</option>
                  <option value="19">Tuberculosis</option>
                  <option value="20">Urinary tract infection</option>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Specify:</label>
                  <input type="text" class="form-control" name="fam_specify">
               </div>
            </div>
            <div class="col-sm-12">
              <label>Smoking:</label>
              <label class="radio-inline"><input type="radio" name="smoking" value="0" checked>No</label>
              <label class="radio-inline"><input type="radio" name="smoking" value="1">Quit</label>
              <label class="radio-inline"><input type="radio" name="smoking" value="2">Yes</label>
            </div>
            <div class="col-sm-12">
              <label>Alcohol:</label>
              <label class="radio-inline"><input type="radio" name="alcohol" value="0" checked>No</label>
              <label class="radio-inline"><input type="radio" name="alcohol" value="1">Quit</label>
              <label class="radio-inline"><input type="radio" name="alcohol" value="2">Yes</label>
            </div>
            <div class="col-sm-12">
              <label>Illicit drugs:</label>
              <label class="radio-inline"><input type="radio" name="illicit_drug" value="0" checked>No</label>
              <label class="radio-inline"><input type="radio" name="illicit_drug" value="1">Yes</label>
            </div>
            <div class="col-sm-12">
              <label>Oral Hypoclycemic Agents:</label>
              <label class="radio-inline"><input type="radio" name="oral_agents" value="0">No</label>
              <label class="radio-inline"><input type="radio" name="oral_agents" value="1">Yes</label>
            </div>
            <div class="col-sm-12">
              <label>Hypertension Medicines:</label>
              <label class="radio-inline"><input type="radio" name="hyper_med" value="0">No</label>
              <label class="radio-inline"><input type="radio" name="hyper_med" value="1">Yes</label>
            </div>
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

<div class="modal fade" id="icd_modal" role="dialog" aria-labelledby="icd_modal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <div class="pull-left form-inline">
          <div class="form-group-md" style="margin-bottom: 10px;">
              <input type="text" class="form-control searchicd" placeholder="Search...">
          </div>
        </div>
      </div>
      <div class="modal-body" id="icdTable">
        @if(count($diagnosis)>0)
          <div class="table-responsive">
              <table class="table table-striped table-hover">
                  <tr class="bg-black">
                      <th>Diagnosis code</th>
                      <th>Diagnosis Description</th>
                  </tr>
                  @foreach($diagnosis as $row)
                      <tr class="conts">
                          <td style="white-space: nowrap;">
                              <a href="#" class="text-info" onclick="getICD('{{$row->id}}','{{$row->diagcode}}', '{{$row->diagdesc}}')">{{ $row->diagcode }}</a>
                          </td>
                          <td>
                              <b class="text-green">{{ $row->diagdesc }}</b>
                          </td>
                      </tr>
                  @endforeach
              </table>
              <div class="text-center" id="diagPage">
            
                  {{ $diagnosis->links() }}
          
              </div>
          </div>
      @else
          <div class="alert alert-warning">
              <span class="text-warning">
                  <i class="fa fa-warning"></i> No Diagnosis Found!
              </span>
          </div>
      @endif
      </div>
    </div>
  </div>
</div>