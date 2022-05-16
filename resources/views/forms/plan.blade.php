<style>
	.signature-pad {
      border-style: ridge;
    }
</style>
<form id="plan_form" method="POST">
    <div class="pull-right">
        <button title="save" type="submit" class="btnSavePlan btn btn-success hide"><i class="far fa-save"></i></button>
    </div>
	<div class="">
		<div class="box-header with-border" style="background-color: #00a65a; color: white;">
            <h4 style="">Plan of Management</h4>
        </div>
        <div class="box-body">
        	<input type="hidden" name="patient_id" value="{{ $patient->id }}">
            <input type="hidden" name="signaturephy" value="@if($patient->planmanage){{ asset('public/signatures/'.$patient->planmanage->signature) }} @endif">
            <input type="hidden" name="id" value="@if($patient->planmanage){{ $patient->planmanage->id }} @endif">
                {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Plan of Management:</label>
                        <textarea class="form-control" name="plan_management" rows="2" required>@if($patient->planmanage) {{ $patient->planmanage->plan_management }} @endif</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Prescription:</label>
                        <textarea class="form-control" name="prescription" rows="2" required>@if($patient->planmanage) {{ $patient->planmanage->prescription }} @endif</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Referral:</label>
                        <textarea class="form-control" name="referral" rows="2" required>@if($patient->planmanage) {{ $patient->planmanage->referral }} @endif</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Disposition:</label>
                        <textarea class="form-control" name="disposition" rows="2" required>@if($patient->planmanage) {{ $patient->planmanage->disposition }} @endif</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <canvas id="signature-pad" class="signature-pad " width=618 height=100></canvas>
                    <div class="actionsignature hide text-right">
                        <button type="button" id="draw">Sign</button>
                        <button type="button" id="erase">Erase</button>
                        <button type="button" id="clear">Clear</button>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control text-center" value="@if($patient->planmanage){{$patient->planmanage->name_physician}} @endif" name="name_physician">
                        <div class="text-center"><p>Name & Signature of Physician</p></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>License #:</label>
                        <textarea class="form-control" name="license_no" rows="2" required>@if($patient->planmanage) {{ $patient->planmanage->license_no }} @endif</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Professional Tax Receipt:</label>
                        <textarea class="form-control" name="prof_tax_receipt" rows="2" required>@if($patient->planmanage) {{ $patient->planmanage->prof_tax_receipt }} @endif</textarea>
                    </div>
                </div>
            </div>
        </div>
	</div>
</form>