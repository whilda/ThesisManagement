@extends('student/layout')

@section('pageTitle')
	Time Line
@stop

@section('timeline.nav') selected="selected" @stop
@section('timeline.menu') active @stop

@section('addResource')
<link rel='stylesheet' type='text/css' href='lib/fullcalendar-1.5.3/fullcalendar/fullcalendar.css' />
<link rel='stylesheet' type='text/css' href='lib/fullcalendar-1.5.3/fullcalendar/fullcalendar.print.css' media='print' />
<script type='text/javascript' src='lib/fullcalendar-1.5.3/fullcalendar/fullcalendar.min.js'></script>
<script type='text/javascript' src='lib/fullcalendar-1.5.3/jquery/jquery-ui-1.8.17.custom.min.js'></script>
@stop

@section('content')
    <script type='text/javascript'>

	$(document).ready(function() {

		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();

        /*
        Colors 
        #54a0f6
        #a93018
        #90c654
        #A97518
        #41B3DF
        */

        $('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			editable: false,
			events: [
				{
					title: 'All Day Event',
					start: new Date(y, m, 1),
                    color: '#54a0f6'
				},
				{
					title: 'Long Event',
					start: new Date(y, m, d-5),
					end: new Date(y, m, d-2),
                    color: '#a93018'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d-3, 16, 0),
					allDay: false,
                    color: '#41B3DF'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d+4, 16, 0),
					allDay: false,
                    color: '#A97518'
				},
				{
					title: 'Meeting',
					start: new Date(y, m, d, 10, 30),
					allDay: false,
                    color: '#54a0f6'
				},
				{
					title: 'Lunch',
					start: new Date(y, m, d, 12, 0),
					end: new Date(y, m, d, 14, 0),
					allDay: false,
                    color: '#90c654'
				},
				{
					title: 'Birthday Party',
					start: new Date(y, m, d+1, 19, 0),
					end: new Date(y, m, d+1, 22, 30),
					allDay: false,
                    color: '#54a0f6'
				},
				{
					title: 'Click for Google',
					start: new Date(y, m, 28),
					end: new Date(y, m, 29),
					url: 'http://google.com/',
                    color: '#54a0f6'
				}
			]
		});

	});

</script>
<style type='text/css'>

	#calendar {
		width: 100%;
		margin: 0 auto;
    }

</style>

<h2>Time Line</h2>
<div id='calendar'></div>
@stop