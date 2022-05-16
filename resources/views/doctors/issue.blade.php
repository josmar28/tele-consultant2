@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="box box-success">
        <div class="box-body">
            <div class="box-header with-border">
                <h3>
                    Issue and Concern
                    <form action="{{ asset('doctor/issuesconcern') }}" method="POST" class="form-inline pull-right" style="margin-right: 30%">
                        {{ csrf_field() }}
                        <div class="form-group-sm">
                        <input type="text" class="form-control" name="daterange" value="@if(isset($daterange)){{ $daterange }}@endif" id="consolidate_date_range" placeholder="Input date range here...">
                            <button type="submit" class="btn-sm btn-info btn-flat" onclick="loadPage();"><i class="fa fa-search"></i> Filter</button>
                        </div>
                    </form>
                </h3>
            </div>
            @if(count($data)>0)
            <div class="table-responsive">
                <table class="table table-striped table-responsive">
                    <tr>
                        <th></th>
                        <th>Consultation Date</th>
                        <th>Requesting Facility</th>
                        <th>Requested Facility</th>
                        <th></th>
                    </tr>
                    @foreach($data as $row)
                        <tr>
                        <td width="5%" style="vertical-align:top">
                                <!-- <a href="{{ asset('doctor/referred?referredCode=').$row->code }}" class="btn btn-sm btn-success" target="_blank">
                                    <i class="fa fa-stethoscope"></i> Track
                                </a> -->
                            </td>
                            <td width="13%">
                                {{ date("F d,Y",strtotime($row->meeting->created_at)) }}<br>
                                <small class="text-yellow">({{ date('g:i a',strtotime($row->meeting->created_at)) }})</small>
                            </td>
                            <td width="23%;">
                                {{ $row->meeting->encoded->fname }} {{ $row->meeting->encoded->lname }}<br>
                                <span class="text-green">{{ $row->meeting->encoded->facility->facilityname }}</span><br>
                            </td>
                            <td width="23%;">
                            {{ $row->meeting->doctor->fname }} {{ $row->meeting->doctor->lname }}<br>
                                <span  class="text-green">{{ $row->meeting->doctor->facility->facilityname }}</span>
                            </td>
                            <td>
                                <h3>To : {{ $row->meeting->doctor->facility->facilityname }}</h3>
                                <?php
                                $issue = \App\Issue::where("meet_id","=",$row->meet_id)->get();
                                ?>
                                @if(count($issue) > 0)
                                    @foreach($issue as $row)
                                        <span class="text-green">={{ $row->issue }}</span><br>
                                        <small class="text-yellow">({{ date('F d,Y g:i a',strtotime($row->created_at)) }})</small>
                                        <br><br>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            @else
                <div class="alert alert-warning">
                    <span class="text-warning">
                        <i class="fa fa-warning"></i> No Issue found!
                    </span>
                </div>
            @endif
        </div>
    </div>
</div>

@include('modal.doctors.issueModal')

@endsection

@section('js')
    <script>
       
        $('#consolidate_date_range').daterangepicker();

        @if(Session::get('add_remark'))
        Lobibox.notify('success', {
            title: "",
            msg: "Successfully added ramark!",
            size: 'mini',
            rounded: true
        });
        <?php Session::put("add_remark",false); ?>
        @endif
    </script>
@endsection