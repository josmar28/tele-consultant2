@if(count($patient->allmeetings)>0)
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <tr class="bg-black">
                <th>Date</th>
                <th>Time:</th>
                <th>Type of consultation</th>
                <th>Chief Complaint</th>
                <th>Attending Provider</th>
                <th></th>
            </tr>
            @foreach($patient->allmeetings as $row)
                <tr>
                  <td>{{ \Carbon\Carbon::parse($row->date_meeting)->format('l, F d, Y') }}</td>
                  <td>{{ \Carbon\Carbon::parse($row->from_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($row->to_time)->format('h:i A') }}</td>
                  <td>{{$row->pendmeet->telecategory->category_name}}</td>
                  <td>{{$row->title}}</td>
                  <td>{{$row->doctor->lname}}, {{$row->doctor->fname}} {{$row->doctor->mname}}</td>
                  <td><a data-toggle="tab" href="#tabsTelDet" onclick="telDetail('<?php echo $row->id; ?>', 'demographic','patientTab','<?php echo $row->docorder ? $row->docorder->id : ""; ?>', '{{$row}}')">Details</a></td>
                </tr>
            @endforeach
        </table>
        <div class="pagination">
            {{ $patient->allmeetings()->paginate(15)->links() }}
        </div>
    </div>
@else
    <div class="alert alert-warning">
        <span class="text-warning">
            <i class="fa fa-warning"></i> No Teleconsultations found!
        </span>
    </div>
@endif