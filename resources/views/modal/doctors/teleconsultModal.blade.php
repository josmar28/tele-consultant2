<div class="modal fade" id="tele_modal" role="dialog" aria-labelledby="users_modal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalMeetingLabel">Schedule Teleconsultation</h4>
      </div>
      <div class="modal-body" id="meetingInfo">
      	<form id="tele_form" method="POST">
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
        <hr>
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
			     	<div class="input-group clockpicker" data-placement="top" data-align="top" data-autoclose="true">
					    <input type="text" class="form-control" name="time" placeholder="Time" value="" required>
					    <span class="input-group-addon">
					        <span class="glyphicon glyphicon-time"></span>
					    </span>
					</div>
			     </div>
			     <div class="col-sm-3">
			     	<label>Duration:</label>
			     	<select class="form-control duration" name="duration" onchange="validateTIme()" required>
		                <option value="15">15 Minutes</option>
                    <option value="30">30 Minutes</option>
		            </select>
			     </div>
			 </div>
       <br>
       <br>
		      <div class="modal-footer">
		        <button id="cancelBtn" type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;Close</button>
		        <button id="saveBtn" type="submit" class="btnSavePend btn btn-success"><i class="fas fa-check"></i> Save</button>
		     </div>
	      </div>
  	</form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="tele_request_modal" role="dialog" aria-labelledby="users_modal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalMeetingLabel">Request Teleconsultation</h4>
      </div>
      <div class="modal-body" id="meetingInfo">
      	<form id="schedule_form" method="POST">
      		{{ csrf_field() }}
    		<input type="hidden" name="req_meeting_id">
    		<input type="hidden" name="req_user_id" value>
      	<div class="row">
      		<div class="col-lg-8">
      			<label>Encoded by: <label class="text-muted" id="txtEncoded"></label></label><br>
      			<label id="req_fac"></label>
      		</div>
      		<div class="col-lg-4">
      			<label>Date Requested: <label class="text-muted" id="txtreqDate"></label></label>
      		</div>
      	</div>
      	<br>
	     <div id="scheduleMeeting">
        <div class="form-group">
        	 <label>Patient:</label>
	         <input type="text" class="form-control" value="" name="req_patient" readonly>
        </div>
	     	<div class="form-group">
		     	<label>Title:</label>
		        <input type="text" class="form-control" value="" name="req_title" readonly>
		     </div>
		     <div class="row">
			     <div class="col-sm-6">
			     	<label>Date of teleconsultation:</label>
			     	<input type="text" name="req_date" class="form-control"  readonly/>
			     </div>
			     <div class="col-sm-3">
			     	<label>Time:</label>
				    <input type="text" class="form-control" name="req_time" readonly>
			     </div>
			     <div class="col-sm-3">
			     	<label>Duration:</label>
				     <input type="text" class="form-control" name="req_duration" readonly>
			     </div>
			 </div>
		      <div class="modal-footer">
            <label class="countdowntoken"></label>
            <a class="refTok" href="https://zoom.us/oauth/authorize?response_type=code&client_id={{env('ZOOM_CLIENT_ID')}}&redirect_uri={{env('ZOOM_REDIRECT_URL')}}" target="_blank">Refresh your token here</a>
		        <button type="button" class="btnSave btn btn-danger" value="Declined"><i class="fas fa-times"></i>&nbsp;Decline</button>
		        <button id="acceptBtn" type="button" class="btnSave btn btn-success" value="Accept"><i class="fas fa-check"></i> Accept</button>
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
        <h4 id="timeConsult" class="text-success"></h4>
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btnMeeting btn btn-primary"><i class="fas fa-play-circle"></i> Start Consultation</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myrequest_modal" role="dialog" aria-labelledby="users_modal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalMeetingLabel">My Request</h4>
      </div>
      <div class="modal-body" id="meetingInfo">
      	@if(count($data_my_req)>0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tr class="bg-black">
                            <th></th>
                            <th>Teleconsult Date & Time</th>
                            <th>Requested To:</th>
                            <th>Date Requested:</th>
                            <th>Title / Patient</th>
                            <th>Status</th>
                        </tr>
                        @foreach($data_my_req as $row)
                            <tr onclick="getMeeting('<?php echo $row->meet_id?>', 'yes')">
                              <td style="width: 1%;"><button class="avatar btn-info"><i class="fas fa-calendar-day"></i></button></td>
                                <td style="width: 20%;">
                                    <a href="javascript:void(0)" class="title-info update_info">
                                       {{ \Carbon\Carbon::parse($row->time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($row->time)->addMinutes($row->duration)->format('h:i A') }}
                                        <br><b>
                                            <small class="text-warning">
                                                {{ \Carbon\Carbon::parse($row->datefrom)->format('l, F d, Y') }}
                                            </small>
                                        </b>
                                    </a>
                                </td>
                                <td>
                                  <b class="text-primary">{{ $row->doctor->lname }}, {{ $row->doctor->fname }} {{ $row->doctor->mname }}</b><br>
                                  <b>{{ $row->doctor->facility->facilityname }}</b>
                                </td>
                                <td>
                                  <b class="text-warning"> {{ \Carbon\Carbon::parse($row->reqDate)->format('l, h:i A F d, Y') }}</b>
                                </td>
                                <td>
                                  <b >{{ $row->title }}</b>
                                  <br>
                                  <b class="text-muted">Patient: {{ $row->patLname }}, {{ $row->patFname }} {{ $row->patMname }}</b>
                                </td>
                                <td>
                                  @if($row->status == 'Accept')
                                  <span class="badge bg-green">Accepted</span>
                                  @elseif($row->status == 'Pending')
                                  <span class="badge badge-warning">Pending</span>
                                  @elseif($row->status == 'Declined')
                                  <span class="badge bg-red">Declined</span>
                                  @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="pagination">
                        {{ $data->links() }}
                    </div>
                </div>
            @else
                <div class="alert alert-warning">
                    <span class="text-warning">
                        <i class="fa fa-warning"></i> No Teleconsultation found!
                    </span>
                </div>
            @endif
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Okay</button>
		     </div>
	      </div>
      </div>
    </div>
  </div>
</div>