</div>

<div class="modal fade" role="dialog" id="feedbackModal">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Feedback</h4>
               </div>
            <div class="modal-body feedback_body">
            </div><!-- /.modal-content -->
        </div>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" role="dialog" id="issueModal">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Issues and Concern</h4>
               </div>
            <div class="modal-body issue_body">
            </div><!-- /.modal-content -->
        </div>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" role="dialog" id="sfeedbackModal">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Feedback</h4>
               </div>
            <div class="modal-body">
        <form action="{{ asset('superadmin/feedback/response') }}" method="POST">
        {{ csrf_field() }}
            <table class="table table-hover table-form table-striped">
         <input type="hidden" id="id" name="id" class="form-control">
         <input type="hidden" name="action" class="form-control" value="notified">
            <tr>
                <td class="col-sm-3"><label>Prepared by</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8"><input type="text" id="prepared_by" class="form-control" value="" readonly></td>
            </tr>
            <tr>
                <td class="col-sm-3"><label>Subject</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8"><input type="text" id="subject" name="subject" class="form-control" readonly></td>
            </tr>
            <tr>
                <td class="col-sm-3"><label>Tel no.</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8"><input type="text" id="tel_no" name="tel_no" class="form-control" readonly></td>
            </tr>
            <tr>
                <td class=""><label>Message</label></td>
                <td>:</td>
                <td><textarea class="form-control" id="message" name="message" rows="10" style="resize:none;" readonly></textarea></td>
            </tr>
            <tr>
                <td class=""><label>Remarks</label></td>
                <td>:</td>
                <td><textarea class="form-control" id="remarks" name="remarks" rows="10" style="resize:none;" required></textarea></td>
            </tr>
        </table>
        <div class="modal-footer">
        <!-- <a data-toggle="modal" class="btn btn-danger btn-sm btn-flat btn_subremove">
        <i class="fa fa-trash"></i> Remove
        </a> -->

        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;Close</button>
        <button type="submit" class="btnSave btn btn-success"><i class="fas fa-check"></i> Save</button>
     </div>
     </form>
            </div><!-- /.modal-content -->
        </div>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
