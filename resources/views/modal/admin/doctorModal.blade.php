<div class="modal fade" id="users_modal" role="dialog" aria-labelledby="users_modal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add User</h4>
      </div>
      <div class="modal-body">
      	<form id="user_form" method="POST">
      		{{ csrf_field() }}
      		<input type="hidden" id="user_id" class="form-control" value="" name="user_id">
      		<input type="hidden" name="facility_id" value="{{$facility}}">
      		<input type="hidden" value="doctor" name="level">
      		<div class="form-group">
		    	<label>Doctor Category:</label>
		    	<select class="select2" name="doc_cat_id" required>
		              <option>Select Doctor Category</option>
		              @foreach($doctors as $row)
		                  <option value="{{ $row->id }}">{{ $row->category_name }}</option>
		              @endforeach
		        </select>
		    </div>
      		<div class="form-group">
		        <label>First Name:</label>
		        <input type="text" class="form-control" value="" name="fname" required="">
		    </div>
		    <div class="form-group">
		        <label>Middle Name:</label>
		        <input type="text" class="form-control" value="" name="mname" required="">
		    </div>
		    <div class="form-group">
		        <label>Last Name:</label>
		        <input type="text" class="form-control" value="" name="lname" required="">
		    </div>
		    <div class="form-group">
		        <label>Contact Number:</label>
		        <input type="text" class="form-control" value="" name="contact" required="">
		    </div>
		    <div class="form-group">
		        <label>Email Address <small class="text-muted"></small></label>
		        <input type="text" class="form-control" name="email" value="" required>
		    </div>
		    <hr>
		    <div class="form-group">
		        <label>Designation:</label>
		        <input type="text" class="form-control" value="" name="designation">
		    </div>
		    <hr>
		    <div class="form-group">
		        <label>Username</label>
		        <input type="text" class="form-control username_1" id="username" name="username" value="" required="">
		        <div class="username-has-error text-bold text-danger hide">
		            <small>Username already taken!</small>
		        </div>
            </div>
            <div class="form-group">
		        <label>Password</label>
		        <input type="password" pattern=".{8,}" title="Password - minimum of 8 characters" class="form-control" id="password1" name="password" required="">
		    </div>
		    <div class="form-group">
		        <label>Confirm Password</label>
		        <input type="password" pattern=".{8,}" title="Confirm password - minimum of 8 Characters" class="form-control" id="password2" name="confirm" required="">
		        <div class="password-has-error has-error text-bold text-danger hide">
		            <small>Password not match!</small>
		        </div>
		        <div class="password-has-match has-match text-bold text-success hide">
		            <small><i class="fa fa-check-circle"></i> Password matched!</small>
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