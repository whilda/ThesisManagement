@extends('supervisor/layout')

@section('pageTitle')
	Task Template
@stop

@section('template.nav') selected="selected" @stop
@section('template.menu') active @stop

@section('content')
    <h2>Tambah Template</h2>
  <form class="form-horizontal">
    <fieldset>
		<div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="name">Name</label>
          <div class="controls">
            <input type="text" name="name" id="name" class="input-xlarge" value="Nama template">
          </div>
        </div>
		<div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="description">Description</label>
          <div class="controls">
            <textarea name="description" id="description" class="input-xlarge">Deskripsi Template</textarea>
          </div>
        </div>

    <div class="control-group">
          <!-- Button -->
          <div class="controls">
            <input type="submit" class="btn btn-success" value="Masukkan"/>
			<input type="button" class="btn btn-info" value="Kembali" onclick="window.history.go(-1)"/>
          </div>
        </div>

    </fieldset>
  </form>
@stop