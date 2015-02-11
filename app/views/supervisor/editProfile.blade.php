@extends('supervisor/layout')

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
            <textarea name="alamat" id="alamat" class="input-xlarge">{{ $data['address'] }}</textarea>
          </div>
        </div>
		<div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="hp">No. Handphone</label>
          <div class="controls">
            <input type="text" name="hp" id="hp" class="input-xlarge" value="{{ $data['handphone'] }}">
          </div>
        </div>
		<div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="email">Email</label>
          <div class="controls">
            <input type="text" name="email" id="email" class="input-xlarge" value="{{ $data['email'] }}">
          </div>
        </div>
		<div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="field">Field</label>
          <div class="controls">
            <input type="text" name="field" id="field" class="input-xlarge" placeholder="Search Field">
          </div>
        </div>
		<div class="control-group clearfix">

          <!-- Text input-->
          <div class="control-label">Selected Field</div>
          <div class="controls">
			<div name="field asd">
				<div class="input-prepend">
					<input type="hidden" name="field[]" value="asd"/>
					<span class="add-on">asd</span>
				</div>
				<div class="input-append">
					<span class="add-on"><a href="javascript:void(0)"><i class="icon-remove"></i></a></span>
				</div>
			</div>
			<div name="field def">
				<div class="input-prepend">
					<input type="hidden" name="field[]" value="def"/>
					<span class="add-on">def</span>
				</div>
				<div class="input-append">
					<span class="add-on"><a href="javascript:void(0)"><i class="icon-remove"></i></a></span>
				</div>
			</div>
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