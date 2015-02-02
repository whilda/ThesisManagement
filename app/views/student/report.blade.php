@extends('student/layout')

@section('pageTitle')
	Final Report
@stop

@section('report.nav') selected="selected" @stop
@section('report.menu') active @stop

@section('content')
    <h2>Final Report</h2>
  <form class="form-horizontal">
    <fieldset>
    <div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="report">File</label>
          <div class="controls">
            <input type="file" name="report" id="report" class="input-xlarge">
          </div>
        </div>

    <div class="control-group">
          <!-- Button -->
          <div class="controls">
            <input type="submit" class="btn btn-success" value="Submit"/>
          </div>
        </div>

    </fieldset>
  </form>
@stop