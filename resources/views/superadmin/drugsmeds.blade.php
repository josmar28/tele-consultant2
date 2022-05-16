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
                <form action="{{ asset('drugsmeds/') }}" method="POST" class="form-inline">
                    {{ csrf_field() }}
                    <div class="form-group-md" style="margin-bottom: 10px;">
                        <input type="text" class="form-control" name="keyword" placeholder="Search Sub Category..." value="@if(isset($keyword)){{ $keyword }}@endif">
                        <button type="submit" class="btn btn-success btn-sm btn-flat">
                            <i class="fa fa-search"></i> Search
                        </button>
                        <a href="{{ asset('drugsmeds/') }}" data-toggle="modal" class="btn btn-warning btn-sm btn-flat">
                            <i class="fa fa-hospital-o"></i> View all
                        </a>
                        <a href="#drugsmedsModal" data-toggle="modal" class="btn btn-info btn-sm btn-flat btn_drugsmeds">
                            <i class="fa fa-hospital-o"></i> Add Drugs and Meds
                        </a>
                    </div>
                </form>
            </div>
            <h3>List of Drugs and Meds</h3>
        </div>
        <div class="box-body">
            @if(count($data)>0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tr class="bg-black">
                            <th>Drugs/Meds Code&Description</th>
                            <th>Drugs/Meds Sub Category</th>
                            <th>Drugs/Meds Unit of Measure</th>
                            <th>Date Created</th>
                        </tr>
                        @foreach($data as $row)
                            <tr>
                                <td style="white-space: nowrap;">
                                    <b>
                                        <a
                                           href="#drugsmedsModal"
                                           data-toggle="modal"
                                           data-id = "{{ $row->id }}"
                                           class="title-info btn_drugsmeds"
                                        >
                                            {{ $row->drugcode }}
                                        </a>
                                    </b>
                                    <br>
                                    {{ $row->drugdescription }}
                                </td>
                                <td>
                                    <b class="text-green">{{ $row->subcat_name }}</b>
                                </td>
                                <td>
                                    <b class="text-green">{{ $row->unit_name }}</b>
                                </td>
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
$('.btn_drugsmeds').click(function(){
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
            var url = "<?php echo asset('drugmeds/drugsmeds_body') ?>";
            $.post(url,json,function(result){
                $(".drugsmeds_body").html(result);
            })
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


    @if(Session::get('drugmeds_update'))
        Lobibox.notify('success', {
            title: "",
            msg: "Successfully updated",
            size: 'mini',
            rounded: true
        });
        <?php
            Session::put("drugmeds_update",false);
        ?>
    @endif
</script>
@endsection

