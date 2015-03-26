@extends('supervisor/student/layout')

@section('pageTitle')
	{{ (strtolower(substr(trim($data['name']),-1))=='s')?$data['name']."'":$data['name']."'s" }} Thesis
@stop

@section('thesis.nav') selected="selected" @stop
@section('thesis.menu') active @stop

@section('content')
    <h2>{{ (strtolower(substr(trim($data['name']),-1))=='s')?$data['name']."'":$data['name']."'s" }} Thesis</h2>
  <div class="form-horizontal">
    <fieldset>
		<div class="control-group">

          <!-- Text input-->
          <div class="control-label">Topic</div>
          <div class="controls input-xlarge" style="padding-top:5px">
			@if($data['thesis']['topic']=="")
			-
			@else
            {{ $data['thesis']['topic'] }}
			@endif
          </div>
        </div>
		<div class="control-group">

          <!-- Text input-->
          <div class="control-label">Title</div>
          <div class="controls input-xlarge" style="padding-top:5px">
			@if($data['thesis']['title']=="")
			-
			@else
            {{ $data['thesis']['title'] }}
			@endif
          </div>
        </div>
		<div class="control-group">

          <!-- Text input-->
          <div class="control-label">Abstract</div>
          <div class="controls input-xxlarge" style="padding-top:5px">
			@if($data['thesis']['description']=="")
			-
			@else
            {{ nl2br(htmlentities($data['thesis']['description'])) }}
			@endif
          </div>
        </div>
		<div class="control-group">

          <!-- Text input-->
          <div class="control-label">Field</div>
          <div class="controls input-xlarge" style="padding-top:5px">
			@if(count($data['thesis']['field']==0))
			-
			@else
			@foreach($data['thesis']['field'] as $field)
            <a href="#"><span class="label label-info">{{ $field }}</span></a> 
			@endforeach
			@endif
          </div>
        </div>
    </fieldset>
  </div>
@stop