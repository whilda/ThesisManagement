@extends('user/layout')

@section('pageTitle')
	Edit Profile
@stop

@section('profile.nav') selected="selected" @stop
@section('profile.menu') active @stop

@section('content')
    <h2>Edit Profile</h2>
  <form class="form-horizontal">
    <fieldset>
		<div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="alamat">Alamat</label>
          <div class="controls">
            <textarea name="alamat" id="alamat" class="input-xlarge">Alamat Lama</textarea>
          </div>
        </div>
		<div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="hp">No. Handphone</label>
          <div class="controls">
            <input type="text" name="hp" id="hp" class="input-xlarge" value="HP lama">
          </div>
        </div>
		<div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="email">Email</label>
          <div class="controls">
            <input type="text" name="email" id="email" class="input-xlarge" value="email@lama">
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