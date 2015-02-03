@extends('supervisor/student/layout')

@section('pageTitle')
	Thesis
@stop

@section('thesis.nav') selected="selected" @stop
@section('thesis.menu') active @stop

@section('content')
    <h2>Student Name Thesis</h2>
  <div class="form-horizontal">
    <fieldset>
		<div class="control-group">

          <!-- Text input-->
          <div class="control-label">Topic</div>
          <div class="controls input-xlarge" style="padding-top:5px">
            Topik
          </div>
        </div>
		<div class="control-group">

          <!-- Text input-->
          <div class="control-label">Title</div>
          <div class="controls input-xlarge" style="padding-top:5px">
            Judul
          </div>
        </div>
		<div class="control-group">

          <!-- Text input-->
          <div class="control-label">Abstract</div>
          <div class="controls input-xxlarge" style="padding-top:5px">
            Abstract aklsjdklasd asldkjaslkd askljdaskjd askdljaslkdjaslkjdaskljdlkasjdlkasj dlksajdklasjdlksjadlkaaksjdklasjdlkjaskldjslkadj daskljdklasjdkljaskdljaskldjkals klasjdkljsakdl
          </div>
        </div>
		<div class="control-group">

          <!-- Text input-->
          <div class="control-label">Field</div>
          <div class="controls input-xlarge" style="padding-top:5px">
            <a href="#"><span class="label label-info">asd</span></a> 
			<a href="#"><span class="label label-info">def</span></a> 
          </div>
        </div>
    </fieldset>
  </div>
@stop