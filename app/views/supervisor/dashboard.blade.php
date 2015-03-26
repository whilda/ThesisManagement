@extends('supervisor/layout')

@section('pageTitle')
	Dashboard
@stop

@section('dashboard.nav') selected="selected" @stop
@section('dashboard.menu') active @stop

@section('content')
    <div class="span8 main-content">

    <div class="row-fluid">
        <div class="row-fluid">
            <h2>Students' Progress
                <span class="info"></span>
            </h2>
            <ul class="item-summary">
            @if(count($data)==0)
			Anda belum memiliki mahasiswa bimbingan.
			@else
			@foreach($data as $student)
                <li>
					<div class="span3">
						<div class="thumbnail">
							<img src="{{ URL::to('/') }}/images/blog/442256_20337880.jpg" alt="">
						</div>
						<center>
						<p style="font-weight:bold">{{ $student['name'] }}</p>
						<p class="sub-detail">nim</p>
						</center>
					</div>
					<div class="span9">
						<div>
						  <!-- Text input-->
						  <div class="span3">Topic :</div>
						  <div class="span9">
							{{ $student['thesis']['topic'] }}
						  </div>
						</div>
						<div>
						  <!-- Text input-->
						  <div class="span3">Title :</div>
						  <div class="span9">
							{{ $student['thesis']['title'] }}
						  </div>
						</div>
						<div>
						  <!-- Text input-->
						  <div class="span3">Description :</div>
						  <div class="span9">
							{{ nl2br(htmlentities($student['thesis']['title'])) }}
						  </div>
						</div>
						<div>
						  <!-- Text input-->
						  <div class="span3">Field :</div>
						  <div class="span9">
							@foreach($student['thesis']['field'] as $field)
							<a href="#"><span class="label label-info">{{ $field }}</span></a> 
							@endforeach
						  </div>
						</div>
						<div>
						  <!-- Text input-->
						  <div class="span3">Progress :</div>
						  <div class="span9">
							<ul class="unstyled">
							<li>{{ $student['progress']['donetasks'] }}/{{ $tasks=$student['progress']['undonetasks']+$student['progress']['donetasks'] }} Tasks Completed <span class="pull-right strong">{{ ($tasks==0)?"0.00":number_format(($student['progress']['donetasks']/$tasks)*100,2) }}%</span>
								<div class="progress progress-important">
									<div class="bar" style="width: {{ ($tasks==0)?100:(($student['progress']['donetasks']/$tasks)*100) }}%;"></div>
								</div>
							</li>
							</ul>
						  </div>
						</div>
						<div class="clearfix">
						<a class="btn btn-mini" href="{{ URL::to('/student/'.$student['username']) }}">Lihat Mahasiswa</a>
						</div>
					</div>
                    <div class="clearfix"></div>
                </li>
				@endforeach
				@endif
            </ul>
        </div>
</div>
@stop