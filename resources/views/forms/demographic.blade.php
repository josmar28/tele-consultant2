<form id="demographic_form" method="POST">
    {{ csrf_field() }}
    <div class="pull-right">
        <button title="save" type="submit" class="btnSaveDemo btn btn-success hide"><i class="far fa-save"></i></button>
    </div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Name of physician:</label>
            <input type="text" class="form-control" name="name_physician" value="@if($patient->demoprof){{$patient->demoprof->name_physician}} @endif" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Date and Time of Teleconsultation:</label>
            <input type="text" class="form-control" value="@if($meeting){{ \Carbon\Carbon::parse($meeting->date_meeting)->format('M d, Y') }} {{ \Carbon\Carbon::parse($meeting->from_time)->format('h:i A') }}@endif" name="dateandtime" disabled>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Name and Address of Health Facility<em>(if applicable):</em></label>
            <input type="text" class="form-control" name="address_health" value="@if($patient->demoprof){{$patient->demoprof->address_health}} @endif">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Name of Telemedicine Partner<em>(if applicable):</em><small><br>If none, Indicate telemedicine platform being used:</small></label>
            <input type="text" class="form-control" name="tele_partner_platform" value="@if($patient->demoprof){{$patient->demoprof->tele_partner_platform}} @endif" required>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <label>Prior to teleconsultation proper, obtain patient consent:</label>
        <label class="radio-inline">
          <input type="radio" name="prior_tele_proper" value="1" required @if($patient->demoprof)@if($patient->demoprof->prior_tele_proper == 1)checked @endif @endif>Yes
        </label>
        <label class="radio-inline">
          <input type="radio" name="prior_tele_proper" value="0" @if($patient->demoprof)@if($patient->demoprof->prior_tele_proper == 0)checked @endif @endif>No
        </label>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <label>Is patient accompanied/assisted by another person during the consultation:</label>
        <label class="radio-inline">
          <input type="radio" name="is_patient_accompanied" value="1" required @if($patient->demoprof)@if($patient->demoprof->is_patient_accompanied == 1)checked @endif @endif>Yes
        </label>
        <label class="radio-inline">
          <input type="radio" name="is_patient_accompanied" value="0" @if($patient->demoprof)@if($patient->demoprof->is_patient_accompanied == 0)checked @endif @endif>No
        </label>
    </div>
</div>
<div id="companion" class="row hide">
    <div class="col-md-4">
        <div class="form-group">
            <label>Name of Companion:</label>
            <input type="text" class="form-control" value="@if($patient->demoprof){{$patient->demoprof->name_of_companion}} @endif" name="name_of_companion">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Relationship:</label>
            <input type="text" class="form-control" value="@if($patient->demoprof){{$patient->demoprof->relationship}} @endif" name="relationship">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Contact No:</label>
            <input type="text" class="form-control" value="@if($patient->demoprof){{$patient->demoprof->phone_no}} @endif" name="phone_no">
        </div>
    </div>
</div>
</form>