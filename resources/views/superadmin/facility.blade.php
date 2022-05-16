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
<div class="col-md-12">
    <div class="box box-success">
        <div class="box-header with-border">
            <div class="pull-right">
                <form action="{{ asset('/facilities') }}" method="GET" class="form-inline">
                    {{ csrf_field() }}
                    <div class="form-group-md" style="margin-bottom: 10px;">
                        <input type="text" class="form-control" name="keyword" placeholder="Search Facility name..." value="{{ Session::get("keyword") }}">
                        <button type="submit" class="btn btn-success btn-sm btn-flat">
                            <i class="fa fa-search"></i> Search
                        </button>
                        <button type="submit" value="view_all" name="view_all" class="btn btn-warning btn-sm btn-flat">
                            <i class="fa fa-eye"></i> View All
                        </button>
                        <a data-toggle="modal" class="btn btn-info btn-sm btn-flat" data-target="#facility_modal">
                            <i class="fa fa-hospital-o"></i> Add Facility
                        </a>
                    </div>
                </form>
            </div>
            <h3>{{ $title }}</h3>
        </div>
        <div class="box-body">
            @if(count($data)>0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tr class="bg-black">
                            <th>Facility Name</th>
                            <th>Facility Code</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Facility Head</th>
                            <th>
                                Service<br>
                                Capability
                            </th>
                            <th>Ownership</th>
                            <th>Status</th>
                            <th>Remarks</th>
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
                                           data-target="#facility_modal" 
                                           onclick="getDataFromFacility(this)" 
                                        >
                                            {{ $row->facilityname }}
                                        </a>
                                    </b><br>
                                    <small class="text-success">
                                        (
                                        <?php
                                        isset($row->muncity) ? $comma_mun = "," : $comma_mun = " ";
                                        isset($row->barangay) ? $comma_bar = "," : $comma_bar = " ";
                                        !empty($row->address) ? $concat_addr = " - " : $concat_addr = " ";

                                        echo $row->province.$comma_mun.$row->muncity.$comma_bar.$row->barangay.$concat_addr.$row->address;
                                        ?>
                                        )
                                    </small>
                                </td>
                                <td>
                                    <b class="text-green">{{ $row->fshortcode }}</b>
                                </td>
                                <td><small>{{ $row->landlineno }}</small></td>
                                <td><small>{{ $row->emailaddress }}</small></td>
                                <td>
                                    <label><?php
                                        $row->facilityhead_lname ? $comma = ", " : $comma = " ";
                                        echo $row->facilityhead_lname.$comma.$row->facilityhead_fname.' '.$row->facilityhead_mi;
                                    ?></label>
                                    <br>
                                    <small class="text-success">{{ $row->facilityhead_position }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-purple">{{ $row->hosp_servcapability == 'primary_care_facility' ? 'Primary Care Facility' : $row->hosp_servcapability }}</span>
                                </td>
                                <td>
                                    <span class="
                                        <?php
                                    if($row->ownership == 'government'){
                                        echo 'badge bg-green';
                                    }
                                    elseif($row->ownership == 'private'){
                                        echo 'badge bg-blue';
                                    }
                                    elseif($row->ownership == 'RHU'){
                                        echo 'badge bg-yellow';
                                    }
                                    elseif($row->ownership == 'CIU/TTMF'){
                                        echo 'badge bg-purple';
                                    }
                                    elseif($row->ownership == 'Birthing Home'){
                                        echo 'badge bg-orange';
                                    }
                                    ?>">
                                    {{ $row->ownership ? $row->ownership : 'N/A' }}
                                </span>
                                </td>
                                <td>
                                    <span class="{{ $row->status ? 'badge bg-blue' : 'badge bg-red' }}">{{ $row->status ? 'Active' : 'Inactive' }}</span>
                                </td>
                                <td>
                                    <small class="text-success">{{ $row->remarks }}</small>
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
                        <i class="fa fa-warning"></i> No Facility found!
                    </span>
                </div>
            @endif
        </div>
    </div>
</div>
    @include('modal.superadmin.facilityModal')
@endsection
@section('js')
@include('superadmin.scripts.facilities')
@endsection

