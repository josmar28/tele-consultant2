<form id="diag_form" method="POST">
    <div class="pull-right">
        <button title="save" type="submit" class="btnSaveDiag btn btn-success hide"><i class="far fa-save"></i></button>
    </div>
	<div class="">
		<div class="box-header with-border" style="background-color: #00a65a; color: white;">
            <h4 style="">Diagnosis/Assessment</h4>
        </div>
        <div class="box-body">
        	<input type="hidden" name="patient_id" value="{{ $patient->id }}">
            <input type="hidden" name="id" value="@if($patient->diagassess){{ $patient->diagassess->id }} @endif">
                {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Summary of Assessment Findings:</label>
                        <textarea class="form-control" name="summary_assess" rows="2" required>@if($patient->diagassess) {{ $patient->diagassess->summary_assess }} @endif</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Diagnosis:</label>
                        <textarea class="form-control" name="diagnosis" rows="2" required>@if($patient->diagassess) {{ $patient->diagassess->diagnosis }} @endif</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <hr>
                    <label>Clinical Classification:</label>
                    <label class="radio-inline"><input type="radio" name="clinical_classification" value="1" required @if($patient->diagassess)@if($patient->diagassess->clinical_classification == 1)checked @endif @endif>Covid-19 Case</label>
                    <label class="radio-inline"><input type="radio" name="clinical_classification" value="0"  @if($patient->diagassess)@if($patient->diagassess->clinical_classification == 0)checked @endif @endif>Non-Covid-19 Case</label>
                </div>
                <div class="col-md-12 ifCovid hide">
                    <br>
                    <label>If Covid-19 Case:</label>
                    <label class="radio-inline"><input type="radio" name="if_covid" value="1" @if($patient->diagassess)@if($patient->diagassess->if_covid == 1)checked @endif @endif>Suspected Cases</label>
                    <label class="radio-inline"><input type="radio" name="if_covid" value="0"  @if($patient->diagassess)@if($patient->diagassess->if_covid == 0)checked @endif @endif>Probable Case</label>
                    <label class="radio-inline"><input type="radio" name="if_covid" value="2"  @if($patient->diagassess)@if($patient->diagassess->if_covid == 2)checked @endif @endif>Confirmed Case</label>
                </div>
            </div>
        </div>
	</div>
</form>