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
                <form action="{{ asset('doctor/prescription') }}" method="POST" class="form-inline">
                    {{ csrf_field() }}
                    <div class="form-group-md" style="margin-bottom: 10px;">
                        <input type="text" class="form-control" name="keyword" placeholder="Search patient..." value="{{ Session::get("keyword") }}">
                        <button type="submit" class="btn btn-success btn-sm btn-flat">
                            <i class="fa fa-search"></i> Search
                        </button>
                        <button type="submit" value="view_all" name="view_all" class="btn btn-warning btn-sm btn-flat">
                            <i class="fa fa-eye"></i> View All
                        </button>
                        <a data-toggle="modal" class="btn btn-info btn-sm btn-flat" data-target="#prescription_modal">
                            <i class="fas fa-prescription"></i> Add Prescription
                        </a>
                    </div>
                </form>
            </div>
            <h3>List of Prescription</h3>
        </div>
        <div class="box-body">
            <br>
            @if(count($data)>0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tr class="bg-black">
                            <th>Prescription</th>
                            <th>Medicine Type</th>
                            <th>Drugs/Meds</th>
                            <th>Frequency</th>
                            <th>Dose Regimen</th>
                            <th>Quantity</th>
                            <th>Prescribe By</th>
                            <th>Encoded By</th>
                            <th>Last Modified By</th>
                        </tr>
                        
                        @foreach($data as $row)
                        <tr
                           data-toggle="modal"
                           data-id= "{{ $row->id }}"
                           data-target="#prescription_modal" 
                           onclick="getData('<?php echo $row->id?>')"
                        >
                            <td style="white-space: nowrap;">
                                <b class="title-info update_info">
                                    {{ $row->presc_code }}
                                </b>
                            </td>
                            <td>{{ $row->type_med() }}</td>
                            <td>{{ $row->drugmed->drugcode }}</td>
                            <td>{{ $row->freq() }}</td>
                            <td>{{ $row->dose_reg() }}</td>
                            <td>{{ $row->total_qty }}</td>
                            <td>{{ $row->prescribe->lname }}, {{ $row->prescribe->fname }} {{ $row->prescribe->mname }}</td>
                            <td>{{ $row->encoded->lname }}, {{ $row->encoded->fname }} {{ $row->encoded->mname }}</td>
                            <td>@if($row->modified){{ $row->encoded->lname }}, {{ $row->encoded->fname }} {{ $row->encoded->mname }}@endif</td>
                        </tr>
                        @endforeach
                    </table>
                    
                </div>
            @else
                <div class="alert alert-warning">
                    <span class="text-warning">
                        <i class="fa fa-warning"></i> No Prescription found!
                    </span>
                </div>
            @endif
        </div>
    </div>
</div>
    @include('modal.doctors.prescriptionmodal')
@endsection
@section('js')
    @include('doctors.scripts.prescription')
@endsection

