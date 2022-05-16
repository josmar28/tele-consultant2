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
                    <form action="{{ asset('audit-trail') }}" method="POST" class="form-inline">
                        {{ csrf_field() }}
                        <div class="form-group-md" style="margin-bottom: 10px;">
                            <input type="text" class="form-control" name="date_range" value="{{$search}}"placeholder="Filter your date here..." id="consolidate_date_range" readonly>
                            <button type="submit" class="btn btn-info btn-sm btn-flat">
                                <i class="fa fa-search"></i> Search
                            </button>
                            <button type="submit" value="view_all" name="view_all" class="btn btn-warning btn-sm btn-flat">
                                <i class="fa fa-eye"></i> View All
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <h1>User Logs</h1>
        </div>
        <div class="box-body">
            @if(count($data)>0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tr class="bg-black">
                            <th>User</th>
                            <th>Login</th>
                            <th>Logout</th>
                            <th>Status</th>
                        </tr>
                        @foreach($data as $row)
                            <tr>
                                <td style="white-space: nowrap;">
                                    <b>
                                        <a>
                                            {{ $row->user->lname }}, {{ $row->user->fname }} {{ $row->user->mname }}
                                        </a>
                                    </b>
                                </td>
                                <td>
                                    <b class="text-green">{{ $row->login }}</b>
                                </td>
                                <td>
                                    <b class="text-green">{{ $row->logout }}</b>
                                </td>
                                <td>
                                    <b class="text-green">{{ $row->status }}</b>
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
                        <i class="fa fa-warning"></i> No Barangay found!
                    </span>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

