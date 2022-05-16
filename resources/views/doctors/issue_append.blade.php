<div class="reco-body">
    <div class="direct-chat-msg left">
        <div class="direct-chat-info clearfix">
            <span class="direct-chat-name pull-left">{{ $facility_name }}</span><br>
            <small class="direct-chat-timestamp pull-left text-yellow">{{ date('d M h:i a') }}</small>
        </div>
        <!-- /.direct-chat-info -->
        <img class="direct-chat-img" src="{{ URL::to('/public/img/dohro12logo2.png') }}" alt="Message User Image22"><!-- /.direct-chat-img -->
        <div class="direct-chat-text">
            {!! nl2br($issue) !!}
        </div>
        <!-- /.direct-chat-text -->
    </div>
</div>
