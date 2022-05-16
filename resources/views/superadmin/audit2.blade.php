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
                <div class="col-md-12">
                    <form action="{{ asset('superadim/audit-trail') }}" method="POST" class="form-inline">
                        {{ csrf_field() }}
                        <div class="form-group-md" style="margin-bottom: 10px;">
                        <input type="text" class="form-control" id="reservation" name="daterange" value="@if(isset($daterange)){{ $daterange }}@endif" placeholder="Input date range here..." required>
                            <button type="submit" class="btn btn-info btn-sm btn-flat">
                                <i class="fa fa-search"></i> Search
                            </button>
                            <a href="{{ asset('superadim/audit-trail') }}" data-toggle="modal" class="btn btn-warning btn-sm btn-flat">
                            <i class="fa fa-hospital-o"></i> View all
                        </a>
                        </div>
                    </form>
                </div>
            </div>
            <h1>Audit Trail</h1>
        </div>
        <div class="box-body">
            @if(count($data)>0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tr class="bg-black">
                            <th>User</th>
                            <th>Event</th>
                            <th>Old Value / New Value</th>
                            <th>Url</th>
                            <th>Model Used</th>
                        </tr>
                        @foreach($data as $row)
                            <tr>
                                <td style="white-space: nowrap;">
                                    <b>
                                        {{$row->fname}} {{$row->lname}}
                                        <br>
                                    </b>
                                        {{$row->user_type}}
                                  
                                </td>
                                <td style="white-space: nowrap;">
                                    <b>
                                        {{$row->event}}
                                    </b>
                                </td>
                                <td>
                                    <b class="text-green">{{ $row->old_values }}{{ $row->new_values }}</b>
                                </td>
                                <td>
                                    <b class="text-green">{{ $row->url }}</b>
                                </td>
                                <td>
                                    <b class="text-green">{{ $row->auditable_type }}</b>
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
                        <i class="fa fa-warning"></i> No Audit Trail found!
                    </span>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $('#reservation').daterangepicker();
</script>
@endsection

