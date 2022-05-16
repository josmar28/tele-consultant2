<form id="physical_form" method="POST">
    {{ csrf_field() }}
	<div class="row">
		<div class="col-md-12">
	        <div class="form-group">
	            <label>Head:</label>
	            <textarea class="form-control" name="head" rows="2" required>@if($patient->phyexam){{$patient->phyexam->head}}@endif</textarea>
	        </div>
	    </div>
	    <div class="col-md-6">
	    	<div class="form-group">
	      <label>Conjunctiva (eye anatomy):</label>
		      <select multiple id="conjunctiva" class="select2" required>
		        <option value="Ple">Pale</option>
		        <option value="Yw">Yellowish</option>
		        <option value="NA">Not Applicable</option>
		      </select>
		    </div>
	    </div>
	    <div class="col-md-6">
	        <div class="form-group">
	            <label>Conjunctiva Remarks:</label>
	            <textarea class="form-control" name="con_remarks" rows="2">@if($patient->phyexam){{$patient->phyexam->con_remarks}}@endif</textarea>
	        </div>
	    </div>
	    <div class="col-md-12">
	    	<div class="form-group">
	      <label>Neck:</label>
		      <select multiple id="neck" class="select2" required>
		        <option value="eln">Enlarged lymph nodes</option>
		        <option value="et">Enlarged thyroid</option>
		        <option value="NA">Not Applicable</option>
		      </select>
		    </div>
	    </div>
	    <div class="col-md-12">
	        <div class="form-group">
	            <label>Chest:</label>
	            <textarea class="form-control" name="chest" rows="2" required>@if($patient->phyexam){{$patient->phyexam->chest}}@endif</textarea>
	        </div>
	    </div>
	    <div class="col-md-6">
	    	<div class="form-group">
	      <label>Breast:</label>
		      <select multiple id="breast" class="select2" required>
		        <option value="ealn">Enlarged axillary lymph nodes</option>
		        <option value="mass">Mass</option>
		        <option value="nd">Nipple Discharge</option>
		        <option value="sopd">Skin orange peel or dimpling</option>
		        <option value="NA">Not Applicable</option>
		      </select>
		    </div>
	    </div>
	    <div class="col-md-6">
	        <div class="form-group">
	            <label>Breast Remarks:</label>
	            <textarea class="form-control" name="breast_remarks" rows="2">@if($patient->phyexam){{$patient->phyexam->breast_remarks}}@endif</textarea>
	        </div>
	    </div>
	    <div class="col-md-6">
	    	<div class="form-group">
	      <label>Thorax:</label>
		      <select multiple id="thorax" class="select2" required>
		        <option value="absrr">Abnormal breath sounds/respiratory rate</option>
		        <option value="ahscr">Abnormal heart sounds/cardiac rate</option>
		        <option value="NA">Not Applicable</option>
		      </select>
		    </div>
	    </div>
	    <div class="col-md-6">
	        <div class="form-group">
	            <label>Thorax Remarks:</label>
	            <textarea class="form-control" name="thorax_remarks" rows="2">@if($patient->phyexam){{$patient->phyexam->thorax_remarks}}@endif</textarea>
	        </div>
	    </div>
	    <div class="col-md-6">
	    	<div class="form-group">
	      <label>Abdomen:</label>
		      <select multiple id="abdomen" class="select2" required>
		        <option value="absrr">Enlarged liver</option>
		        <option value="mass">Mass</option>
		        <option value="scar">Scar</option>
		        <option value="tenderness">Tenderness</option>
		        <option value="NA">Not Applicable</option>
		      </select>
		    </div>
	    </div>
	    <div class="col-md-6">
	        <div class="form-group">
	            <label>Abdomen Remarks:</label>
	            <textarea class="form-control" name="abdomen_remarks" rows="2">@if($patient->phyexam){{$patient->phyexam->abdomen_remarks}}@endif</textarea>
	        </div>
	    </div>
	    <div class="col-md-6">
	    	<div class="form-group">
	      <label>Genitals:</label>
		      <select multiple id="genitals" class="select2" required>
		        <option value="absrr">Enlarged liver</option>
		        <option value="mass">Mass</option>
		        <option value="scar">Scar</option>
		        <option value="tenderness">Tenderness</option>
		        <option value="NA">Not Applicable</option>
		      </select>
		    </div>
	    </div>
	    <div class="col-md-6">
	        <div class="form-group">
	            <label>Genitals Remarks:</label>
	            <textarea class="form-control" name="genital_remarks" rows="2">@if($patient->phyexam){{$patient->phyexam->genital_remarks}}@endif</textarea>
	        </div>
	    </div>
	    <div class="col-md-6">
	    	<div class="form-group">
	      <label>Extremities:</label>
		      <select multiple id="extremities" class="select2" required>
		        <option value="edema">Edema</option>
		        <option value="fep">Full and Equal Pulses</option>
		        <option value="gd">Gross Deformity</option>
		        <option value="ng">Normal Gait</option>
		        <option value="pfd">Pain or forced dorsiflexion</option>
		        <option value="vari">Varicosities</option>
		        <option value="NA">Not Applicable</option>
		      </select>
		    </div>
	    </div>
	    <div class="col-md-6">
	        <div class="form-group">
	            <label>Extremities Remarks:</label>
	            <textarea class="form-control" name="extremities_remarks" rows="2">@if($patient->phyexam){{$patient->phyexam->extremities_remarks}}@endif</textarea>
	        </div>
	    </div>
	    <div class="col-md-12">
	        <div class="form-group">
	            <label>Others:</label>
	            <textarea class="form-control" name="others" rows="2">@if($patient->phyexam){{$patient->phyexam->others}}@endif</textarea>
	        </div>
	    </div>
	    <div class="col-md-12">
	        <div class="form-group">
	            <label>Waist Circumference:</label>
	            <textarea class="form-control" name="waist_circumference" rows="2">@if($patient->phyexam){{$patient->phyexam->waist_circumference}}@endif</textarea>
	        </div>
	    </div>
	</div>
</form>