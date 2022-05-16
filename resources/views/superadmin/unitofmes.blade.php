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
                <form action="{{ asset('drugsmeds/unitofmes') }}" method="POST" class="form-inline">
                    {{ csrf_field() }}
                    <div class="form-group-md" style="margin-bottom: 10px;">
                        <input type="text" class="form-control" name="keyword" placeholder="Search Unit of measure..." value="@if(isset($keyword)){{ $keyword }}@endif">
                        <button type="submit" class="btn btn-success btn-sm btn-flat">
                            <i class="fa fa-search"></i> Search
                        </button>
                        <a href="{{ asset('drugsmeds/unitofmes') }}" data-toggle="modal" class="btn btn-warning btn-sm btn-flat">
                            <i class="fa fa-hospital-o"></i> View all
                        </a>
                        <a href="#unitofmesModal" data-toggle="modal" class="btn btn-info btn-sm btn-flat btn_unitofmes">
                            <i class="fa fa-hospital-o"></i> Add Unit
                        </a>
                    </div>
                </form>
            </div>
            <h3>List of Unit of Measure</h3>
        </div>
        <div class="box-body">
            @if(count($data)>0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tr class="bg-black">
                              <th>Unit of Measure Code</th>
                            <th>Unit of Measure Name</th>
                        </tr>
                        @foreach($data as $row)
                            <tr>
                                <td style="white-space: nowrap;">
                                    <b>
                                        <a
                                           href="#unitofmesModal"
                                           data-toggle="modal"
                                           data-id = "{{ $row->id }}"
                                           class="title-info btn_unitofmes"
                                        >
                                            {{ $row->unit_code }}
                                        </a>
                                    </b>
                                </td>
                                <td>
                                    <b class="text-green">{{ $row->unit_name }}</b>
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
                        <i class="fa fa-warning"></i> No Unit of Measure found!
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
$('.btn_unitofmes').click(function(){
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
            var url = "<?php echo asset('drugmeds/unitofmes_body') ?>";
            $.post(url,json,function(result){
                $(".unitofmes_body").html(result);
            })
});


@if(Session::get('unitodmes_add'))
        Lobibox.notify('success', {
            title: "",
            msg: "Successfully added",
            size: 'mini',
            rounded: true
        });
        <?php
            Session::put("unitodmes_add",false);
        ?>
    @endif



    @if(Session::get('unitodmes_update'))
        Lobibox.notify('success', {
            title: "",
            msg: "Successfully updated",
            size: 'mini',
            rounded: true
        });
        <?php
            Session::put("unitodmes_update",false);
        ?>
    @endif
</script>
@endsection

