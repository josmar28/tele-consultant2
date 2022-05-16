<?php
$user = Session::get('auth');
$searchKeyword = Session::get('searchKeyword');
$keyword = '';
if($searchKeyword){
    $keyword = $searchKeyword['keyword'];
}
?>
@extends('layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        label {
            padding: 0px;
        }
        .form-group {
            margin-bottom: 10px;
        }
        .disAble {
            pointer-events:none;
        }
    </style>
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3>{{ $title }}</h3>
                <form action="{{ asset('/admin-doctors') }}" method="GET">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="search" placeholder="Search name..." value="{{ $search }}">
                        </div>
                        <div class="col-md-4 float-right">
                            <button type="submit" class="btn btn-success btn-sm btn-flat">
                                <i class="fa fa-search"></i> Search
                            </button>
                            <a class="btn btn-warning btn-sm btn-flat" onclick="refreshPage()"><i class="fa fa-eye"></i> View All</a>
                            @if($user->facility_id!=25)
                                <a href="javascript:void(0)" data-toggle="modal" class="btn btn-primary btn-sm btn-flat add_info" data-target="#users_modal">
                                    <i class="fa fa-user-plus"></i> Add User
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
            <div class="box-body">
                @if(count($data)>0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <tr class="bg-black">
                                <th>Name</th>
                                <th>Facility</th>
                                <th>Level</th>
                                <th>Username</th>
                                <th>Status</th>
                                <th>Last Login</th>
                            </tr>
                            @foreach($data as $row)
                                <tr>
                                    <td style="width: 20%;">
                                        <a href="javascript:void(0)"
                                           data-toggle="modal"
                                           data-id= "{{ $row->id }}"
                                           class="title-info update_info"
                                           data-target="#users_modal" 
                                           onclick="getDataFromUser(this)" 
                                           >
                                           {{ $row->fname }} {{ $row->mname }} {{ $row->lname }}
                                            <br><label>
                                                @if($row->email)
                                                <small class="text-warning">
                                                    Email: {{ $row->email }}
                                                </small>
                                                @endif
                                            </label>
                                        </a>
                                    </td>
                                    <td>

                                        {{ \App\Facility::find($row->facility_id)->facilityname }}
                                    </td>
                                    <td>
                                        {{ $row->level }}<br />
                                    </td>
                                    <td>
                                        {{ $row->username }}
                                    </td>
                                    <td>
                                        <?php
                                            $status = ($row->login_status=='login') ? 'Login': 'Logout' ;
                                            $class = ($row->login_status=='login') ? 'text-success': 'text-danger';
                                        ?>
                                        <strong><span class="{{ $class }}">{{ $row->status=='deactivate' ? 'Deactivate' : $status }}</span></strong>
                                    </td>
                                    <td class="text-warning">
                                        <?php
                                            $status = ($row->login_status=='login') ? 'Login': 'Logout';
                                            $class = ($row->login_status=='login') ? 'text-success': 'text-danger';
                                        ?>
                                        @if($row->last_login)
                                            {{ date('M d, Y h:i A',strtotime($row->last_login)) }}
                                        @else
                                            Never Login
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        <div class="pagination">
                            {{ $data->links() }}
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning">
                        <span class="text-warning">
                            <i class="fa fa-warning"></i> No Users found!
                        </span>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @include('modal.admin.doctorModal')
@endsection
@section('js')
@include('superadmin.scripts.users')
@endsection

