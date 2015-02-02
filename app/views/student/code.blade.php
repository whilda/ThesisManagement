@extends('student/layout')

@section('pageTitle')
	Code
@stop

@section('code.nav') selected="selected" @stop
@section('code.menu') active @stop

@section('content')
    <h2>Input Code</h2>
  <form class="form-horizontal">
    <fieldset>
    <div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="kode">Kode</label>
          <div class="controls">
            <input type="text" name="kode" id="kode" class="input-xlarge">
            <p class="help-block">Kode yang diberikan dosen</p>
          </div>
        </div>

    <div class="control-group">
          <!-- Button -->
          <div class="controls">
            <input type="submit" class="btn btn-success" value="Masukkan"/>
          </div>
        </div>

    </fieldset>
  </form>
@stop