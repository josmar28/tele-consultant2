<div class="modal fade" role="dialog" id="IssueAndConcern">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="box box-danger direct-chat direct-chat-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span class="issue_concern_code"></span>
                    </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <!-- Conversations are loaded here -->
                    <div id="issue_and_concern_body" style="padding: 10px;">

                    </div>
                </div>

                <div class="box-footer issue_footer">
                    <form action="" method="post" id="sendIssue">
                        {{ csrf_field() }}
                        <input type="hidden" id="issue_meeting_id" />
                        <div class="input-group">
                            <textarea id="issue_message" rows="3" required placeholder="Type a message for your issue and concern regarding this transaction.." class="form-control"></textarea>
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-success btn-lg">Send</button>
                            </span>
                        </div>
                    </form>
                </div>
                <!-- /.box-footer-->
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->