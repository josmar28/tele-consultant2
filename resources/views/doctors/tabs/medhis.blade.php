<div class="box-header with-border">
    <div class="pull-right form-inline">
        <div class="form-group-md" style="margin-bottom: 10px;">
            <input type="text" class="form-control" name="keyword" placeholder="Search...">
            <a data-toggle="modal" class="btn btn-info btn-sm btn-flat" data-target="#medhis_modal">
                <i class="fa fa-hospital-o"></i> Add Medical History
            </a>
        </div>
    </div>
</div>
@if(count($patient->medhistory)>0)
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <tr class="bg-black">
                <th>Date Encoded</th>
                <th>ICD</th>
                <th>History of Present Illness</th>
                <th>Present Medical, Family, Social History</th>
            </tr>
            @foreach($patient->medhistory as $row)
                <tr
                   data-toggle="modal"
                   data-id= "{{ $row->id }}"
                   data-target="#medhis_modal" 
                   onclick="getData('<?php echo $row->id?>')"
                >
                  <td>{{ \Carbon\Carbon::parse($row->created_at)->format('l, F d, Y') }}</td>
                  <td>{{$row->icd10}}</td>
                  <td>{{$row->history_present_illness}}</td>
                  <td>{{$row->present_med_fam_soc}}</td>
                </tr>
            @endforeach
        </table>
        <div class="pagination">
            {{ $patient->medhistory()->paginate(15)->links() }}
        </div>
    </div>
@else
    <div class="alert alert-warning">
        <span class="text-warning">
            <i class="fa fa-warning"></i> No Medical History found!
        </span>
    </div>
@endif
@include('modal.doctors.medhismodal')