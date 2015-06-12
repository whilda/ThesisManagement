@extends('student/layout')

@section('pageTitle')
	Cek Plagiasi
@stop

@section('content')
    <h2>{{ $data['_id'] }}</h2>
	<div class="span3">
	Hasil plagiasi pada:
	</div>
	<div class="span6">
		@foreach($data['plagdetails'] as $plagiasi)
		  <!-- Text input-->
			<ul class="unstyled">
			<li>{{ $plagiasi['nim'] }} :<span class="pull-right strong">{{ $plagiasi['similarity']*100 }}%</span>
				<div class="progress progress-important">
					<div class="bar" style="width: {{ $plagiasi['similarity']*100 }}%;"></div>
				</div>
			</li>
			</ul>
		@endforeach
	</div>
@stop