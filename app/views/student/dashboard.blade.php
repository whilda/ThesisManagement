@extends('student/layout')

@section('pageTitle')
	Dashboard
@stop

@section('addResourceTop')
	<style>
		.info h2{
			margin:0;
		}
	</style>
@stop

@section('dashboard.nav') selected="selected" @stop
@section('dashboard.menu') active @stop

@section('content')
    <div class="span8 main-content">

    <div class="row-fluid">
        <div class="row-fluid">
			@if ($data['thesis']['topic']=="")
			<div class="alert">Anda belum mengisi thesis. Klik link berikut untuk mengisi <a href="{{ URL::to('/student/thesis') }}">thesis</a></div>
			@elseif($data['status']==-1)
			<div class="alert">Anda belum memilih supervisor. Klik link berikut untuk memilih <a href="{{ URL::to('/student/supervisorList') }}">supervisor</a>.</div>
			@elseif($data['status']==0)
			<div class="alert">Permintaan anda belum direspon supervisor.</div>
			@elseif($data['status']==1)
			<div class="alert">Anda belum mengisi kode. Mintalah kode pada supervisor anda dan klik link berikut untuk mengisi <a href="{{ URL::to('/student/code') }}">kode</a>.</div>
			@else
            <h2>Available Tasks
                <span class="info">Ada {{ count($data['task']) }} Task yang harus diselesaikan.</span>
            </h2>
            <ul class="item-summary">
            

				@foreach($data['task'] as $task)
                <li>
				<?php
					$date=new DateTime($task['created_date']['$date']);
				?>
                    <div class="overview span4">
                        <p class="main-detail">{{ date_format($date, 'M jS') }}</p>
                        <p class="sub-detail"> </p>
						@if($task['status']==0)
                        <span class="label label-success">Active</span>
						@endif
						@if(count($task['comment'])==0)
						<span class="label label-info">New</span>
						@endif
                    </div>
                    <div class="info span8">
						<h2>{{ $task['name'] }}</h2>
                        <p>{{ $task['description'] }}</p>
                        <a class="btn btn-mini" href="{{ URL::to('/student/task/'.$task['id_task']) }}">View Task</a>
                    </div>
                    <div class="clearfix"></div>
                </li>
				@endforeach
            
            </ul>
			@endif
        </div>
	</div>
</div>
@stop