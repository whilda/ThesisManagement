@extends('supervisor/student/layout')

@section('pageTitle')
	{{ (strtolower(substr(trim($data['name']),-1))=='s')?$data['name']."'":$data['name']."'s" }} Tasks
@stop

@section('task.nav') selected="selected" @stop
@section('task.menu') active @stop

@section('addResourceTop')
<style>
.info h2 {
  margin: 0;
}
</style>
@stop

@section('content')
    <div class="span8 main-content">
    <div class="row-fluid">
        <div class="row-fluid">
            <h2>{{ (strtolower(substr(trim($data['name']),-1))=='s')?$data['name']."'":$data['name']."'s" }} Tasks
                <span class="info">Ada {{ count($data['task']) }} Task yang harus diselesaikan.</span>
            </h2>
			@if($isSupervisor&&$data['status']==2)
			<a href="addTask" class="btn btn-mini">Tambah Task</a><br/><br/>
			@endif
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
						@if($isSupervisor)
                        <a class="btn btn-mini" href="{{ URL::to('/student/'.$data['_id'].'/view/'.$task['id_task']) }}">View Task</a>
						@endif
                    </div>
                    <div class="clearfix"></div>
                </li>
				@endforeach
            
            </ul>
        </div>
	</div>
</div>
@stop