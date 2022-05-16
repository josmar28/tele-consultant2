<div class="modal fade" id="tele_modal" role="dialog" aria-labelledby="users_modal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalMeetingLabel">Schedule Teleconsultation</h4>
      </div>
      <div class="modal-body" id="meetingInfo">
      	<form id="schedule_form" method="POST">
      		{{ csrf_field() }}
    		<input type="hidden" name="meeting_id">
    		<input type="hidden" name="user_id" value="{{ Session::get('auth')->id }}">
      	<div class="form-group" id="facilityField">
            <label>Facility:</label>
            <select class="form-control select2 selectFacility" name="facility_id" required>
            	<option value="">Select Facility ...</option>
	              @foreach($facilities as $fac)
	                <option value="{{ $fac->id }}">{{ $fac->facilityname }}</option>
                 @endforeach 
            </select>
        </div>
	     <div id="scheduleMeeting" class="hide">
        <div class="form-group">
            <label>Teleconsult Category:</label>
            <select class="form-control select2" name="tele_cate_id" required>
              <option value="">Select Category ...</option>
                @foreach($telecat as $tel)
                  <option value="{{ $tel->id }}">{{ $tel->category_name }}</option>
                 @endforeach 
            </select>
        </div>
    		<div class="form-group">
          <label>Doctor:</label>
          <select class="form-control select2 selectDoctor" name="doctor_id" required>
          </select>
        </div>
        <div class="form-group">
        	 <label>Patient:</label>
          <select class="form-control select2" name="patient_id" id="patient_id" required>
          	<option value="">Select Patient ...</option>
              @foreach($patients as $pat)
                <option value="{{ $pat->id }}">{{ $pat->lname }}, {{ $pat->fname }} {{ $pat->mname }}</option>
               @endforeach 
          </select>
        </div>
	     	<div class="form-group">
		     	<label>Title:</label>
		        <input type="text" class="form-control" value="" name="title" required>
		     </div>
		     <div class="row">
			     <div class="col-sm-6">
			     	<label>Date of teleconsultation:</label>
			     	<input type="text" value="" name="date_from" class="form-control daterange" placeholder="Select Date" required/>
			     </div>
			     <div class="col-sm-3">
			     	<label>Time:</label>
			     	<div class="input-group clockpicker" data-placement="right" data-align="top" data-autoclose="true">
					    <input type="text" class="form-control" name="time" placeholder="Time" value="" required>
					    <span class="input-group-addon">
					        <span class="glyphicon glyphicon-time"></span>
					    </span>
					</div>
			     </div>
			     <div class="col-sm-3">
			     	<label>Duration:</label>
			     	<select class="form-control duration" name="duration" onchange="validateTIme()" required>
		                <option value="10">10 Minutes</option>
		                <option value="20">20 Minutes</option>
		                <option value="30">30 Minutes</option>
		                <option value="40">40 Minutes</option>
		                <option value="50">50 Minutes</option>
		            </select>
			     </div>
			 </div>
			 <div class="row">
			     <div class="col-sm-6">
			     	<div class="form-group">
			            <label>Patient Email:</label>
				        <input type="text" class="form-control" value="" name="email" required>
			        </div>
			     </div>
			     <div class="col-sm-6">
			     	<div class="form-group">
		     		  <br>
		              <label>Send Email to patient:</label><br>
		                <label><input type="radio" name="sendemail" value="true"  checked required>Yes</label>
		                <label><input type="radio" name="sendemail" value="false" required/>No</label>
			        </div>
			     </div>
			 </div>
		      <div class="modal-footer">
		        <button id="cancelBtn" type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;Close</button>
		        <button id="saveBtn" type="submit" class="btnSave btn btn-success"><i class="fas fa-check"></i> Save</button>
		     </div>
	      </div>
  	</form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="info_meeting_modal" role="dialog" aria-labelledby="users_modal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="myInfoLabel"></h3>
      </div>
      <div class="modal-body">
      	<div class="form-group">
	     	<label>Patient:</label>
	        <input type="text" id="patientName"class="form-control" readonly>
	     </div>
  		<div class="form-group">
  			<label class="text-success">Meeting Link:</label><br>
  			<label id="meetlink"></label>
  			<a href="javascript:void(0)"onclick="copyToClipboard('#meetlink')"><i class="far fa-copy"></i></a>

  		</div>
  		<div class="form-group">
  			<label class="text-success">Meeting Number:</label><br>
  			<label id="meetnumber"></label>

  		</div>
  		<div class="form-group">
  			<label class="text-success">Password:</label><br>
  			<label id="meetPass"></label>
  		</div>
  		<div class="form-group">
  			<label class="text-success">Host Key:</label><br>
  			<label id="meetKey"></label>
  		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btnMeeting btn btn-primary"><i class="fas fa-play-circle"></i> Join Teleconsult</button>
      </div>
    </div>
  </div>
</div>