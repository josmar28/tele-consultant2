<form id="docorder_form" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
      <label>Lab Request Codes:</label>
      <select multiple id="labrequestcodes" class="select2" required>
        <option value="BC">Blood Chemistry</option>
        <option value="CC">Clinical Chemistry</option>
        <option value="CBC">Complete Blood Count</option>
        <option value="F">Fecalysis</option>
        <option value="H">Hematology</option>
        <option value="I">Immunology</option>
        <option value="S">Serology</option>
        <option value="SM">Sputum Microscopy</option>
        <option value="U">Urinalysis</option>
          @foreach($labreq as $row)
              <option value="{{ $row->req_code }}">{{ $row->description }}</option>
          @endforeach
      </select>
    </div>
    <div class="form-group">
      <label>Imaging Request Codes:</label>
      <select multiple id="imagingrequestcodes" class="select2" required>
        <option value="ECG">ECG</option>
        <option value="MRI">MRI</option>
        <option value="US">Ultrasound</option>
        <option value="XR">X-ray</option>
          @foreach($imaging as $row)
              <option value="{{ $row->req_code }}">{{ $row->description }}</option>
          @endforeach
      </select>
    </div>
    <div class="form-group">
        <label>Alert Description:</label>
        <textarea class="form-control" name="alertdescription" rows="2">@if($docorder){{$docorder->alertdescription}}@endif</textarea>
    </div>
    <div class="form-group">
        <label>Treatment Plan:</label>
        <textarea class="form-control" name="treatmentplan" rows="2">@if($docorder){{$docorder->treatmentplan}}@endif</textarea>
    </div>
    <div class="form-group">
        <label>Remarks:</label>
        <textarea class="form-control" name="remarks" rows="3">@if($docorder){{$docorder->remarks}}@endif</textarea>
    </div>
</form>

<script>
  var labrequest = '{!! $labrequest !!}';
  var imgrequest = '{!! $imgrequest !!}';
  $(document).ready(function(){
    var labreq = labrequest.split(',');
    var img = imgrequest.split(',');
    $('#labrequestcodes').val(labreq).change();
    $('#imagingrequestcodes').val(img).change();
  })
</script>