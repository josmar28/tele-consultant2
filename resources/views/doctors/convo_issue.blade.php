
<div class="reco-body">
    @if(count($data)>0)
        @foreach($data as $row)
            <div class="direct-chat-msg left">
                <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-left">{{ $facility->facilityname }}</span><br>
                    <small class="direct-chat-timestamp pull-left text-yellow">{{ date('d M h:i a',strtotime($row->created_at)) }}</small>
                </div>
                <!-- /.direct-chat-info -->
                <img class="direct-chat-img" src="{{ URL::to('/public/img/dohro12logo2.png') }}" alt="Message User Image11"><!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                    {!! nl2br($row->issue) !!}
                </div>
                <!-- /.direct-chat-text -->
            </div>
        @endforeach
        @else <p>No data found.</p>
    @endif
</div>


