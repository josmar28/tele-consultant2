<form id="clinical_form" method="POST">
    {{ csrf_field() }}
</div>
<div id="formEdit" class="box-body disAble">
    <div class="pull-right">
        <button title="save" type="submit" class="btnSaveClinical btn btn-success hide"><i class="far fa-save"></i></button>
    </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Reason for Teleconsultation:</label>
                    <textarea class="form-control" name="reason_consult" rows="2" required>@if($patient->clinical) {{ $patient->clinical->reason_consult }} @endif</textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Date of Onset of Illness:</label>
                    <input type="text" class="form-control daterange" value="@if($patient->clinical){{ date('m/d/Y', strtotime($patient->clinical->date_onset_illness)) }}@endif" name="date_onset_illness" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Name of Referral Health Facility <small>(if Applicable)</small>:</label>
                    <select name="facility_id" class="select2">
                        <option value="">Select Facility</option>
                        @foreach($facility as $row)
                            <option value="{{ $row->id }}" @if($patient->clinical)@if($patient->clinical->facility_id == $row->id)selected @endif @endif>{{ $row->facilityname }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Date of Referral <small>(if Applicable)</small>:</label>
                    <input type="text" class="form-control daterange" value="@if($patient->clinical){{ date('m/d/Y', strtotime($patient->clinical->date_referral)) }}@endif" name="date_referral">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Known Medical Condition/s & Medical History:</label>
                    <textarea class="form-control" name="known_medical_history" rows="2" required>@if($patient->clinical) {{ $patient->clinical->known_medical_history }} @endif</textarea>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label>Current Medications:</label>
                    <input type="text" class="form-control" value="@if($patient->clinical){{$patient->clinical->current_medication}} @endif" name="current_medication" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Blood Type:</label>
                    <input type="text" class="form-control" value="@if($patient->clinical){{$patient->clinical->blood_type}} @endif" name="blood_type" required>
                </div>
            </div>
            <div class="col-md-12">
            <hr>
                <div class="box-header with-border" style="background-color: #00a65a; color: white;">
                    <h4>Physical Examination(Inspection)</h4>
                </div> 
                <div class="form-group">
                    <label>Clinical Status at the Time of Consult:</label>
                    <textarea class="form-control" name="clinical_status_time_consult" rows="2" required>@if($patient->clinical) {{ $patient->clinical->clinical_status_time_consult }} @endif</textarea>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Specific Findings:</label>
                    <textarea class="form-control" name="specific_findings" rows="2" required>@if($patient->clinical) {{ $patient->clinical->specific_findings }} @endif</textarea>
                </div>
            </div>
        </div>
</form>
@include('forms.physicalexam')