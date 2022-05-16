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
                <form action="{{ asset('superadmin/lab_request') }}" method="POST" class="form-inline">
                    {{ csrf_field() }}
                    <div class="form-group-md" style="margin-bottom: 10px;">
                        <input type="text" class="form-control" name="keyword" placeholder="Search Sub Category..." value="@if(isset($keyword)){{ $keyword }}@endif">
                        <button type="submit" class="btn btn-success btn-sm btn-flat">
                            <i class="fa fa-search"></i> Search
                        </button>
                        <a href="{{ asset('superadmin/lab_request') }}" data-toggle="modal" class="btn btn-warning btn-sm btn-flat">
                            <i class="fa fa-hospital-o"></i> View all
                        </a>
                        <a href="#labrequestModal" data-toggle="modal" class="btn btn-info btn-sm btn-flat btn_labrequest">
                            <i class="fa fa-hospital-o"></i> Add Lab Request
                        </a>
                    </div>
                </form>
            </div>
            <h3>List of Lab Request</h3>
        </div>
        <div class="box-body">
            @if(count($data)>0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tr class="bg-black">
                            <th>Lab Request Code/Description</th>
                            <th>Lab Request Type</th>
                            <th>Lab Request Unit of Measure</th>
                            <th>Date Created</th>
                        </tr>
                        @foreach($data as $row)
                            <tr>
                                <td style="white-space: nowrap;">
                                    <b>
                                        <a
                                           href="#labrequestModal"
                                           data-toggle="modal"
                                           data-id = "{{ $row->id }}"
                                           class="title-info btn_labrequest"
                                        >
                                            {{ $row->req_code }}
                                        </a>
                                    </b>
                                    <br>
                                    {{ $row->description }}
                                </td>
                                <td>
                                <?php
                                if($row->req_type == 'LAB')
                                {
                                    $type = 'Laboratory';
                                }else{
                                    $type = 'Imaging';
                                }
                                ?>
                                {{$type}}
                                </td>
                                <td>{{$row->unit_name}}</td>
                                <td>{{ date('M d, Y',strtotime($row->created_at)) }}<br>{{ date('h:i:s A',strtotime($row->created_at)) }}</td>
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
                        <i class="fa fa-warning"></i> No Lab Request found!
                    </span>
                </div>
            @endif
        </div>
    </div>
</div>
    @include('modal.superadmin.labRequestModal')
@endsection
@section('js')
<script>
$('.btn_labrequest').click(function(){
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
            var url = "<?php echo asset('superadmin/lab_request/body') ?>";
            $.post(url,json,function(result){
                $(".labrequest_body").html(result);
            })
});
@if(Session::get('desc_valid'))
        Lobibox.notify('warning', {
            title: "",
            msg: "Description Already exist!",
            size: 'mini',
            rounded: true
        });
        <?php
            Session::put("desc_valid",false);
        ?>
    @endif

@if(Session::get('labrequest_add'))
        Lobibox.notify('success', {
            title: "",
            msg: "Successfully added",
            size: 'mini',
            rounded: true
        });
        <?php
            Session::put("labrequest_add",false);
        ?>
    @endif


    @if(Session::get('labrequest_update'))
        Lobibox.notify('success', {
            title: "",
            msg: "Successfully updated",
            size: 'mini',
            rounded: true
        });
        <?php
            Session::put("labrequest_update",false);
        ?>
    @endif
</script>
@endsection

