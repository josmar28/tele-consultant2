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
                <form action="{{ asset('municipality').'/'.$province_id.'/'.$province_name }}" method="POST" class="form-inline">
                    {{ csrf_field() }}
                    <div class="form-group-md" style="margin-bottom: 10px;">
                        <input type="text" class="form-control" name="keyword_muncity" placeholder="Search municipality..." value="{{ Session::get("keyword_muncity") }}">
                        <button type="submit" class="btn btn-success btn-sm btn-flat">
                            <i class="fa fa-search"></i> Search
                        </button>
                        <button type="submit" value="view_all" name="view_all" class="btn btn-warning btn-sm btn-flat">
                            <i class="fa fa-eye"></i> View All
                        </button>
                        <a data-toggle="modal" class="btn btn-info btn-sm btn-flat" data-target="#municipal_modal">
                            <i class="fa fa-hospital-o"></i> Add Municipality
                        </a>
                    </div>
                </form>
            </div>
            <h1>{{ $title }}</h1>
            <b class="text-yellow" style="font-size: 13pt;">{{ $province_name }} Province</b>
        </div>
        <div class="box-body">
            @if(count($data)>0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tr class="bg-black">
                            <th>Municipality Name</th>
                            <th>Municipality Code</th>
                            <th>Zipcode</th>
                            <th width="5%;">Option</th>
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
                                           data-target="#municipal_modal" 
                                           onclick="getDataFromMunicipality(this)" 
                                        >
                                            {{ $row->muni_name }}
                                        </a>
                                    </b>
                                </td>
                                <td>
                                    <b class="text-green">{{ $row->muni_psgc }}</b>
                                </td>
                                <td>{{ $row->zipcode }}</td>
                                <td>
                                    <a href="{{ url('barangay').'/'.$province_id.'/'.$province_name.'/'.$row->muni_psgc.'/'.$row->muni_name }}" class="btn btn-block btn-social btn-instagram" target="_blank">
                                        <i class="fas fa-external-link-alt"></i> Show Barangay
                                    </a>
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
                        <i class="fa fa-warning"></i> No Municipality found!
                    </span>
                </div>
            @endif
        </div>
    </div>
</div>

    @include('modal.superadmin.municipalityModal')
@endsection
@section('js')
    @include('superadmin.scripts.municipality')
@endsection
