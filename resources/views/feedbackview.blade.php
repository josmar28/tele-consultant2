@extends('layouts.app')

@section('content')
<style>
    label {
        padding: 0px;
    }
    .form-group {
        margin-bottom: 10px;
    }
</style>
<div class="container-fluid">
    <div class="box box-success">
        <div class="box-header with-border">
            <div class="pull-right">
                <form action="{{ asset('feedback/view') }}" method="POST" class="form-inline">
                    {{ csrf_field() }}
                    <div class="form-group-md" style="margin-bottom: 10px;">
                        <input type="text" class="form-control" name="keyword" placeholder="Search Feedback..." value="@if(isset($keyword)){{ $keyword }}@endif">
                        <button type="submit" class="btn btn-success btn-sm btn-flat">
                            <i class="fa fa-search"></i> Search
                        </button>
                        <a href="{{ asset('feedback/view') }}" data-toggle="modal" class="btn btn-warning btn-sm btn-flat">
                            <i class="fa fa-hospital-o"></i> View all
                        </a>
                    </div>
                </form>
            </div>
            <h3>List of Feedback</h3>
        </div>
        <div class="box-body">
            @if(count($data)>0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tr class="bg-black">
                            <th width="20%">Subject</th>
                            <th width="30%">Message</th>
                            <th width="25%">Remarks</th>
                            <th width="5%">Action</th>
                        </tr>
                        @foreach($data as $row)
                            <tr>
                                <td style="white-space: nowrap;">
                                    <b>
                                        <a
                                         href="#feedbackModal"
                                           data-toggle="modal"
                                           data-id = "{{ $row->id }}"
                                           class="title-info btn_feedback"
                                        >
                                            {{ $row->subject }}
                                        </a>
                                    </b>
                                    <br>
                                </td>
                                <td style="font-family: 'Times New Roman', Times, serif;">
                                  <b> {{ $row->message }}</b> 
                                </td>
                                <td style="font-family: 'Times New Roman', Times, serif;">
                                <b>  {{ $row->remarks }}</b> 
                                </td>
                                <td>
                                          @if($row->action == 'notified')
                                          <span class="badge bg-green">Notified</span>
                                          @elseif($row->action == 'pending')
                                          <span class="badge badge-warning">Pending</span>
                                          @elseif($row->action == 'declined')
                                          <span class="badge bg-red">Declined</span>
                                          @endif
                                </td>
                               
                            </tr>
                        @endforeach
                    </table>
                    <div class="text-center">
                    {{ $data->links() }}
                    </div>
                </div>
            @else
                <div class="alert alert-warning">
                    <span class="text-warning">
                        <i class="fa fa-warning"></i> No Drugs/Meds found!
                    </span>
                </div>
            @endif
        </div>
    </div>
</div>
    @include('modal.superadmin.drugsmedsModal')
@endsection
@section('js')
<script>
$('.btn_feedback').click(function(){
     var id = $(this).data('id');
     var json;
            if(id == 'empty'){
                json = {
                    "_token" : "<?php echo csrf_token()?>"
                };
            } else {
                json = {
                    "id" : id,
                    "_token" : "<?php echo csrf_token()?>"
                };
            }
            var url = "<?php echo asset('feedback') ?>";
            $.ajax({
                url: url,
                type: 'GET',
                data: json,
                success: function(data) {
                    $('.feedback_body').html(data);
                }
            });
});


@if(Session::get('drugmeds_add'))
        Lobibox.notify('success', {
            title: "",
            msg: "Successfully added",
            size: 'mini',
            rounded: true
        });
        <?php
            Session::put("drugmeds_add",false);
        ?>
    @endif


    @if(Session::get('feecback_update'))
        Lobibox.notify('success', {
            title: "",
            msg: "Successfully updated",
            size: 'mini',
            rounded: true
        });
        <?php
            Session::put("feecback_update",false);
        ?>
    @endif
</script>
@endsection

