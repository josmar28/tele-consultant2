<script>
	var calendarEl = document.getElementById('my-calendar');
  var calendarFac = document.getElementById('fac-calendar');
    var mycalendar = new FullCalendar.Calendar(calendarEl, {
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
        url: "{{ url('/my-calendar-meetings') }}",
        failure: function() {
          alert('error getting teleconsultations')
        }
      },
    });
    var faccalendar = new FullCalendar.Calendar(calendarFac, {
      headerToolbar: {
        left: 'prev,next',
        center: 'title',
        right: 'dayGridMonth'
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
	    mycalendar.render();
	  } else {
	    $('#teleList').removeClass('hide');
	    $('#teleCalendar').addClass('hide');
	    mycalendar.render();
	  }
	});
  $( "#showCalendar" ).click(function() {
      faccalendar.render();
  });
  $('#calendar_meetings_modal').on('shown.bs.modal', function () {
     faccalendar.render();
  });

</script>