@extends('layouts.app')

@section('content')
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
    .dropdown-left-manual {
      right: 0;
      left: auto;
      padding-left: 1px;
      padding-right: 1px;
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container-fluid">
    <div class="box box-success">
        <div class="box-header with-border">
            <div class="pull-right">
                <form action="{{ asset('doctor/order') }}" method="POST" class="form-inline">
                    {{ csrf_field() }}
                    <div class="form-group-md" style="margin-bottom: 10px;">
                        <input type="text" class="form-control" name="keyword" placeholder="Search ..." value="{{ Session::get("keyword") }}">
                        <button type="submit" class="btn btn-success btn-sm btn-flat">
                            <i class="fa fa-search"></i> Search
                        </button>
                        <button type="submit" value="view_all" name="view_all" class="btn btn-warning btn-sm btn-flat">
                            <i class="fa fa-eye"></i> View All
                        </button>
                        <a data-toggle="modal" class="btn btn-info btn-sm btn-flat" data-target="#docorder_modal">
                            <i class="fas fa-notes-medical"></i> Add Doctor Order
                        </a>
                    </div>
                </form>
            </div>
            <h3>List of Doctor Orders</h3>
        </div>
        <div class="box-body">
            <br>
            @if(count($data)>0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tr class="bg-black">
                            <th>Patient</th>
                            <th>Lab Request Code</th>
                            <th>Imaging Request Code</th>
                            <th>Alert</th>
                            <th>Treatment Plan</th>
                            <th>Remarks</th>
                            <th>Date Encoded</th>
                        </tr>
                        
                        @foreach($data as $row)
                        <tr
                           data-toggle="modal"
                           data-id= "{{ $row->id }}"
                           data-target="#docorder_modal" 
                           onclick="getData('<?php echo $row->id?>')"
                        >
                            <td style="white-space: nowrap;">
                                <b class="title-info update_info">
                                    {{ $row->patient->lname }}, {{ $row->patient->fname }} {{ $row->patient->mname }}
                                </b>
                            </td>
                            <td>{{ $row->labrequestcodes }}</td>
                            <td>{{ $row->imagingrequestcodes }}</td>
                            <td>{{ $row->alertdescription }}</td>
                            <td>{{ $row->treatmentplan }}</td>
                            <td>{{ $row->remarks }}</td>
                            <td>{{\Carbon\Carbon::parse($row->created_at)->format('F d, Y h:i A')}}</td>
                        </tr>
                        @endforeach
                    </table>
                    
                </div>
            @else
                <div class="alert alert-warning">
                    <span class="text-warning">
                        <i class="fa fa-warning"></i> No Doctor Orders found!
                    </span>
                </div>
            @endif
        </div>
    </div>
</div>
    @include('modal.doctors.docordermodal')
@endsection
@section('js')
    @include('doctors.scripts.docorder')
@endsection

