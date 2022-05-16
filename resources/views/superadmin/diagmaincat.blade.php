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
                <form action="{{ asset('/diagnosis-main-category') }}" method="POST" class="form-inline">
                    {{ csrf_field() }}
                    <div class="form-group-md" style="margin-bottom: 10px;">
                        <input type="text" class="form-control" name="keyword" placeholder="Search main category..." value="{{ Session::get("keyword") }}">
                        <button type="submit" class="btn btn-success btn-sm btn-flat">
                            <i class="fa fa-search"></i> Search
                        </button>
                        <button type="submit" value="view_all" name="view_all" class="btn btn-warning btn-sm btn-flat">
                            <i class="fa fa-eye"></i> View All
                        </button>
                        <a data-toggle="modal" class="btn btn-info btn-sm btn-flat" data-target="#main_cat_modal">
                            <i class="fa fa-hospital-o"></i> Add Main Category
                        </a>
                    </div>
                </form>
            </div>
            <h3>List of Main Categories</h3>
        </div>
        <div class="box-body">
            @if(count($data)>0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tr class="bg-black">
                              <th>Diagnosis Category Code</th>
                                <th>Diagnosis Category Description</th>
                        </tr>
                        @foreach($data as $row)
                            <tr>
                                <td style="white-space: nowrap;">
                                    <b>
                                        <a
                                           href="javascript:void(0)"
                                           data-toggle="modal"
                                           data-id= "{{ $row->id }}"
                                           class="title-info update_info"
                                           data-target="#main_cat_modal" 
                                           onclick="getDataFromData(this)" 
                                        >
                                            {{ $row->diagcat }}
                                        </a>
                                    </b>
                                </td>
                                <td>
                                    <b class="text-green">{{ $row->catdesc }}</b>
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
                        <i class="fa fa-warning"></i> No Category found!
                    </span>
                </div>
            @endif
        </div>
    </div>
</div>
    @include('modal.superadmin.diagMainCatModal')
@endsection
@section('js')
    @include('superadmin.scripts.diagmaincat')
@endsection

