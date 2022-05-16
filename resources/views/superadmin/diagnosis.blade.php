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
                <form action="{{ asset('/diagnosis') }}" method="POST" class="form-inline">
                    {{ csrf_field() }}
                    <div class="form-group-md" style="margin-bottom: 10px;">
                        <input type="text" class="form-control" name="keyword" placeholder="Search diagnosis..." value="{{ Session::get("keyword") }}">
                        <button type="submit" class="btn btn-success btn-sm btn-flat">
                            <i class="fa fa-search"></i> Search
                        </button>
                        <button type="submit" value="view_all" name="view_all" class="btn btn-warning btn-sm btn-flat">
                            <i class="fa fa-eye"></i> View All
                        </button>
                        <a data-toggle="modal" class="btn btn-info btn-sm btn-flat" data-target="#diagnosis_modal">
                            <i class="fa fa-hospital-o"></i> Add Diagnosis
                        </a>
                    </div>
                </form>
            </div>
            <h3>List of Diagnosis</h3>
        </div>
        <div class="box-body">
            @if(count($data)>0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tr class="bg-black">
                            <th>Diagnosis code</th>
                            <th>Diagnosis Description</th>
                            <th>Diagnosis Priority</th>
                            <th>Diagnosis Category</th>
                            <th>Diagnosis Sub Category</th>
                            <th>Diagnosis Main Category</th>
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
                                           data-target="#diagnosis_modal" 
                                           onclick="getDataFromDiagnosis(this)" 
                                        >
                                            {{ $row->diagcode }}
                                        </a>
                                    </b>
                                </td>
                                <td>
                                    <b class="text-green">{{ $row->diagdesc }}</b>
                                </td>
                                <td>
                                    <b class="text-green">{{ $row->diagpriority }}</b>
                                </td>
                                <td>
                                    <b class="text-green">{{ $row->diagcategory }}</b>
                                </td>
                                <td>
                                    <b class="text-green">{{ $row->diagsubcat }}</b>
                                </td>
                                <td>
                                    <b class="text-green">{{ $row->diagmaincat }}</b>
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
                        <i class="fa fa-warning"></i> No Diagnosis Found!
                    </span>
                </div>
            @endif
        </div>
    </div>
</div>
    @include('modal.superadmin.diagnosisModal')
@endsection
@section('js')
    @include('superadmin.scripts.diagnosis')
@endsection

