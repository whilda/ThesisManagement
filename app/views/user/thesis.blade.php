@extends('user/layout')

@section('pageTitle')
	Thesis
@stop

@section('thesis.nav') selected="selected" @stop
@section('thesis.menu') active @stop

@section('content')
    <h2>Edit Thesis</h2>
  <form class="form-horizontal">
    <fieldset>
		<div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="topic">Topic</label>
          <div class="controls">
            <input type="text" name="topic" id="topic" class="input-xlarge" value="kosong/topik lama">
          </div>
        </div>
		<div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="title">Title</label>
          <div class="controls">
            <input type="text" name="title" id="title" class="input-xlarge" value="Judul Lama">
          </div>
        </div>
		<div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="abstract">Abstract</label>
          <div class="controls">
            <textarea type="text" name="abstract" id="abstract" class="input-xlarge">Abstract Lama</textarea>
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