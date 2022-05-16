<?php
$user = Session::get('auth');

$pending = 'pending';
?>
<form action="{{ asset('feedback') }}" method="POST">
    {{ csrf_field() }}
    <div class="modal-body">
        <table class="table table-hover table-form table-striped">
         <input type="hidden" name="id" class="form-control" value="@if(isset($data->id)){{ $data->id }}@endif">
         <input type="hidden" name="action" class="form-control" value="@if(isset($data->action)){{ $data->action }}@else{{ $pending }}@endif">
            <tr>
                <td class="col-sm-3"><label>Prepared by</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8"><input type="text" class="form-control" value="{{ $name }}" readonly></td>
            </tr>
            <tr>
                <td class="col-sm-3"><label>Subject</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8"><input type="text"  value="@if(isset($data->subject)){{ $data->subject }}@endif" name="subject" class="form-control"></td>
            </tr>
            <tr>
                <td class="col-sm-3"><label>Tel no.</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8"><input type="text" value="@if(isset($data->tel_no)){{ $data->tel_no }}@endif" name="tel_no" class="form-control"></td>
            </tr>
            <tr>
                <td class=""><label>Message</label></td>
                <td>:</td>
                <td><textarea class="form-control" name="message" rows="10" style="resize:none;">@if(isset($data->message)){{ $data->message }}@endif</textarea></td>
            </tr>
        </table>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Submit</button>
    </div>
</form>