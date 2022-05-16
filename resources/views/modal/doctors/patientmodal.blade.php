<div class="modal fade" id="patient_modal" role="dialog" aria-labelledby="users_modal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add Patient</h4>
      </div>
      <div class="modal-body">
      	<form id="patient_form" method="POST">
      		{{ csrf_field() }}
          <div class="text-right">
            <button id="deleteBtn" type="button" class="btnSave btn btn-danger hide"><i class="fas fa-trash"></i> Delete</button>
          </div>
          <input type="hidden" name="patient_id" id="patient_id">
          <input type="hidden" value="1" name="is_accepted">
         <!--  @if($user->level == 'admin')
          <div class="form-group">
            <label>Doctor:</label>
            <select class="form-control select2" name="doctor_id" id="doctor_id" required>
        		<option value="">Select Doctor ...</option>
	              @foreach($users as $doctor)
	                <option value="{{ $doctor->id }}">{{ $doctor->lname }}, {{ $doctor->fname }} {{ $doctor->mname }} @if($doctor->email)(<small>{{$doctor->email}}</small>)@endif</option>
                 @endforeach 
            </select>
	      </div>
          @endif -->
         <div class="row">
		     <div class="col-sm-6">
		     	<label class="required-field">PhilHealth Status:</label>
		            <select class="form-control select_phic" name="phic_status" required>
		            	<option value="None">None</option>
		                <option value="Member">Member</option>
		                <option value="Dependent">Dependent</option>
		            </select>
		     </div>
		     <div class="col-sm-6">
		     	<label>PhilHealth ID:</label>
		        <input type="text" class="form-control phicID" value="" name="phic_id" disabled>
		     </div>
		     <div class="col-sm-6">
		        <div class="form-group">
		            <label required-field>First Name:</label>
		            <input type="text" class="form-control" value="" name="fname" required>
		        </div>
		    </div>
		    <div class="col-sm-6">
		        <div class="form-group">
		            <label>Middle Name:</label>
		            <input type="text" class="form-control" value="" name="mname">
		        </div>
		    </div>
		    <div class="col-sm-6">
		        <div class="form-group">
		            <label class="required-field">Last Name:</label>
		            <input type="text" class="form-control" value="" name="lname" required>
		        </div>
		    </div>
		    <div class="col-sm-6">
		        <div class="form-group">
		            <label class="required-field">Contact Number:</label>
		            <input type="text" class="form-control" value="" name="contact" required>
		        </div>
		    </div>
		    <div class="col-sm-6">
		        <div class="form-group">
		            <label class="required-field">Birth Date:</label>
		            <input type="date" class="form-control" value="" min="1910-05-11" max="{{ date('Y-m-d') }}" name="dob" required>
		        </div>
		    </div>
		    <div class="col-sm-6">
		        <div class="form-group">
		            <label class="required-field">Sex:</label>
		            <select class="form-control sex" name="sex" required>
		                <option value="Male">Male</option>
		                <option value="Female">Female</option>
		            </select>
		        </div>
		    </div>
		    <div class="col-sm-6">
		        <div class="form-group">
		            <label class="required-field">Civil Status:</label>
		            <select class="form-control civil_status" name="civil_status" required>
		                <option value="Single">Single</option>
		                <option value="Married">Married</option>
		                <option value="Divorced">Divorced</option>
		                <option value="Separated">Separated</option>
		            </select>
		        </div>
		    </div>
		    <div class="col-sm-6">
		        <div class="form-group">
		            <label class="required-field">Religion:</label>
		            <select class="form-control civil_status select2" name="religion" required>
		                <option value="AGLIP">AGLIPAY</option><option value="ALLY">ALLIANCE OF BIBLE CHRISTIAN COMMUNITIES</option><option value="ANGLI">ANGLICAN</option><option value="BAPTI">BAPTIST</option><option value="BRNAG">BORN AGAIN CHRISTIAN</option><option value="BUDDH">BUDDHISM</option><option value="CATHO">CATHOLIC</option><option value="XTIAN">CHRISTIAN</option><option value="CHOG">CHURCH OF GOD</option><option value="EVANG">EVANGELICAL</option><option value="IGNIK">IGLESIA NI CRISTO</option><option value="MUSLI">ISLAM</option><option value="JEWIT">JEHOVAHS WITNESS</option><option value="MORMO">LDS-MORMONS</option><option value="LRCM">LIFE RENEWAL CHRISTIAN MINISTRY</option><option value="LUTHR">LUTHERAN</option><option value="METOD">METHODIST</option><option value="PENTE">PENTECOSTAL</option><option value="PROTE">PROTESTANT</option><option value="SVDAY">SEVENTH DAY ADVENTIST</option><option value="UCCP">UCCP</option><option value="UNKNO">UNKNOWN</option><option value="WESLY">WESLEYAN</option>
		            </select>
		        </div>
		    </div>
		    <div class="col-sm-6">
		        <div class="form-group">
		            <label>Educational Attainment:</label>
		            <select class="form-control civil_status select2" name="edu_attain">
		                <option value=""> -- SELECT EDUCATIONAL ATTAINMENT --</option><option value="03">COLLEGE</option><option value="01">ELEMENTARY EDUCATION</option><option value="02">HIGH SCHOOL EDUCATION</option><option value="05">NO FORMAL EDUCATION</option><option selected="selected" value="06">NOT APPLICABLE</option><option value="04">POSTGRADUATE PROGRAM</option><option value="07">VOCATIONAL</option>
		            </select>
		        </div>
		    </div>
		    <div class="col-sm-6">
		        <div class="form-group">
		            <label>Occupation:</label>
		            <input type="text" class="form-control" value="" name="occupation">
		        </div>
		    </div>
		    <div class="col-sm-6">
		        <div class="form-group">
		            <label>Monthly Income:</label>
		            <input type="text" class="form-control" value="" name="monthly_income">
		        </div>
		    </div>
		    <div class="col-sm-6">
		    	<div class="form-group">
		            <label>Select ID:</label>
		            <select class="form-control id_type select21" name="id_type">
		                <option value="umid">UMID</option>
		                <option value="dl">DRIVER'S LICENSE</option>
		                <option value="passport">PASSPORT ID</option>
		                <option value="postal">POSTAL ID</option>
		                <option value="tin">TIN ID</option>
		            </select>
		    	</div>
	        </div>
	        <div class="col-sm-6">
		        <div class="form-group">
                    <label id="selectID" class="required-field">CRN:</label>
                    <input id="idVal" name="id_type_no" type="text" class="form-control">
		        </div>
		    </div>
		    <div class="col-sm-6">
		        <div class="form-group">
		            <label class="required-field">Nationality:</label>
		            <select class="form-control select2" name="nationality_id" required>
		        		<option value="{{ $nationality_def->num_code }}" selected>{{ $nationality_def->nationality }}</option>
			              @foreach($nationality as $n)
			                <option value="{{ $n->num_code }}">{{ $n->nationality }}</option>
			                 @endforeach
	                </select>
		        </div>
		    </div>
		    <div class="col-sm-6">
		        <div class="form-group">
		            <label>House no./Lot/Bldg:</label>
		            <input type="text" class="form-control" value="" name="house_no">
		        </div>
		    </div>
		    <div class="col-sm-6">
		        <div class="form-group">
		            <label>Street:</label>
		            <input type="text" class="form-control" value="" name="street">
		        </div>
		    </div>
		    <div class="col-sm-6">
		        <div class="form-group">
		            <label class="required-field">Region:</label>
		            <select class="form-control select2" name="region" id="region" required>
		            	<option value="{{ $user->facility->region->reg_code }}" selected>{{ $user->facility->region->reg_desc }}</option>
		        		<option value="">Select Region...</option>
			             <!-- This will use in the future  
			             @foreach($region as $r)
			                <option value="{{ $r->reg_code }}">{{ $r->reg_desc }}</option>
			              @endforeach  -->
	                </select>
		        </div>
		    </div>
		    <div class="col-sm-6">
				<div class="form-group">
			        <label>Province:</label>
			        <select class="form-control select2" name="province" id="province">
			        	<option value="{{ $user->facility->province->prov_psgc }}" selected>{{ $user->facility->province->prov_name }}</option>
			            <option value="">Select Province...</option>
			        </select>
			    </div>
			</div>
		    <div class="col-sm-6">
		        <div class="form-group">
		            <label class="required-field">Municipality:</label>
		            <select class="form-control muncity filter_muncity select2" name="muncity" id="municipality" required>
		        		<option value="">Select Municipal/City...</option>
			              @foreach($municity as $m)
			                <option value="{{ $m->muni_psgc }}">{{ $m->muni_name }}</option>
			                 @endforeach 
			             <option value="others">Others</option>
	                </select>
		        </div>
		    </div>
			<div class="col-sm-6">
				<div class="form-group barangay_holder">
			        <label>Barangay:</label>
			        <select class="form-control barangay select2" name="brgy" required>
			            <option value="">Select Barangay...</option>
			        </select>
			    </div>
			</div>
		    <div class="col-sm-12">
		    	<div class="has-group others_holder hide">
			        <label class="required-field">Complete Address :</label>
			        <input type="text" name="address" class="form-control others" placeholder="Enter complete address..." />
			    </div>
		    </div>
		 </div>
	    
	    <hr>
	    <div class="text-left">
        	<h4>Create account</h4>
        </div>
		  <div id="collapseAccount">
			<div class="card card-body">
			 <div class="form-group">
		            <label class="required-field">Email Address:</label>
			        <input type="email" class="form-control email" id="email" name="email" value="" required>
			        <div class="email-has-error text-bold text-danger hide">
			            <small>Email already taken!</small>
			        </div>
		        </div>
		        <div class="form-group">
		            <label class="required-field">Username: <code id="usernamesug" onclick="getUsername()"></code></label>
			        <input type="text" class="form-control username" id="username" value="" name="username" required>
			        <div class="username-has-error text-bold text-danger hide">
			            <small>Username already taken!</small>
			        </div>
		        </div>
		 		<div class="row rowPass">
				    <div class="col-sm-12">
				        <div class="form-group">
				            <label class="required-field">Password:</label>
				            <div class="input-group">
						        <input type="password" class="form-control pwd" value="" name="password" required>
						        <span class="input-group-btn">
						            <button class="btn btn-default reveal" type="button"><i class="far fa-eye"></i></button>
						        </span> 
						    </div>
				        </div>
			            <button type="button" class="btn btn-warning btn-sm btn-flat generatePassword">
		                    <i class="fas fa-key"></i> Generate Password
		                </button>
				    </div>
				    <br>
				</div>
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

<div class="modal fade" id="meeting_info_modal" role="dialog" aria-labelledby="users_modal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Teleconsultation Schedule</h4>
      </div>
      <div class="modal-body" id="MeetingBody">
      	<form id="consultation_form" method="POST">
      		{{ csrf_field() }}
          <input type="hidden" class="form-control" value="" autofocus="" name="meeting_info_id" id="meeting_info_id">
          <input type="hidden" class="form-control" value="" autofocus="" name="patient_meeting_id">
          <div class="form-group">
		     	<label>Title:</label>
		        <input type="text" class="form-control" value="" name="title" required readonly>
		     </div>
		     <div class="row">
			     <div class="col-sm-6">
			     	<label>Date:</label>
			     	<input type="text" value="" name="datefrom" class="form-control daterange" placeholder="Select Date" required/>
			     </div>
			     <div class="col-sm-3">
			     	<label>Time:</label>
			     	<div class="input-group clockpicker">
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
			            <label>Email:</label>
				        <input type="text" class="form-control" value="" name="email" readonly>
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
		        <button type="button" class="btnCancel btn btn-danger" data-dismiss="modal" onclick="acceptPatient('-1')"><i class="fas fa-times"></i>&nbsp;Decline</button>
		        <button type="submit" class="btnSave btn btn-success"><i class="fas fa-check"></i> Accept</button>
		     </div>
	      </div>
      </div>
  	</form>
      </div>
    </div>
  </div>
</div>