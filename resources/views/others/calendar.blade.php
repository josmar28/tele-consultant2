<script>
	var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      eventClick:  function(info) {
      	if(info.event.allow == 'request') {
      		infoMeeting(info.event.id)
      	} else {
	        getMeeting(info.event.id, info.event.allow)
      	}
	  },
      headerToolbar: {
        left: 'prevYear,prev,next,nextYear today',
        center: 'title',
        right: 'dayGridMonth,dayGridWeek,dayGridDay,listWeek'
      },
      initialDate: moment(new Date).format(),
      navLinks: true,
      editable: true,
      dayMaxEvents: true,
      events: {
        url: "{{ url('/calendar-meetings') }}",
        failure: function() {
          alert('error getting teleconsultations')
        }
      },
    });
  	$( "#sel1" ).change(function() {
	  if(this.value == 0) {
	   $('#teleList').addClass('hide');
        $('#teleCalendar').removeClass('hide');
	    calendar.render();
	  } else {
	    $('#teleList').removeClass('hide');
	    $('#teleCalendar').addClass('hide');
	    calendar.render();
	  }
	});

</script>