<div class="modal fade" role="dialog" id="doctypeModal">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Add Document Type</h4>
               </div>
            <div class="modal-body doctype_body">
            </div><!-- /.modal-content -->
        </div>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" tabindex="-1" role="dialog" id="doctypeRemove" style="margin-top: 30px;z-index: 99999;">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h4 class="text-success"><i class="fa fa-question-circle"></i> Confirmation</h4>
                <hr />
                <div class="alert alert-warning">
                   <b style='color:black'> Are you sure you want to delete? </b>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
                <button type="button" class="btn btn-success confirmRemoveDoctype" data-dismiss="modal"><i class="fa fa-check"></i> Yes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->