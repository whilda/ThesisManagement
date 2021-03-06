@extends('supervisor/layout')

@section('pageTitle')
	Task Template
@stop

@section('addResourceTop')
<link rel="stylesheet" href="{{ URL::to('/') }}/app-css/task.css">
@stop

@section('addResource')
<script src="{{ URL::to('/') }}/javascripts/overlay.js" type="text/javascript"></script>
<script src="{{ URL::to('/') }}/javascripts/task.js" type="text/javascript"></script>
@stop

@section('template.nav') selected="selected" @stop
@section('template.menu') active @stop

@section('content')
    <h2>Edit Template</h2>
	<div id="overlay" style="display:none"></div>
	<div id="overlayBox" class="offset3 span6" style="display:none">
		<img class="closeX" src="{{ URL::to('/') }}/assets/close_button.png"/>
		<h2 id="judulTipe"></h2>
		<form class="form-horizontal overlay-content" name="task">
			<fieldset>
				<div class="control-group">

				  <!-- Text input-->
				  <label class="control-label" for="taskName">Name</label>
				  <div class="controls">
					<input type="text" name="taskName" id="taskName" class="input-xlarge" value="Nama template">
					<input type="hidden" name="oldName" value="Nama Template">
					<input type="hidden" name="type" value="1">
				  </div>
				</div>
				<div class="control-group">

				  <!-- Text input-->
				  <label class="control-label" for="taskDesc">Description</label>
				  <div class="controls">
					<textarea name="taskDesc" id="taskDesc" class="input-xlarge"></textarea>
				  </div>
				</div>
				<div class="control-group">

				  <!-- Text input-->
				  <label class="control-label" for="taskDur">Duration</label>
				  <div class="controls">
					<input type="text" maxlength="3" name="taskDur" id="taskDur" class="input-small"> hari
				  </div>
				</div>
				<div class="control-group" id="fileContainer">

				  <!-- Text input-->
				  <div class="control-label">Files</div>
				  <div class="controls">
					<div name="field asd">
						<div class="input-prepend">
							<input type="hidden" name="field[]" value="asd"/>
							<span class="add-on">asd.png</span>
						</div>
						<div class="input-append">
							<span class="add-on"><a href="javascript:void(0)"><i class="icon-remove"></i></a></span>
						</div>
					</div>
					<div name="field def">
						<div class="input-prepend">
							<input type="hidden" name="field[]" value="asd"/>
							<span class="add-on">def.pdf</span>
						</div>
						<div class="input-append">
							<span class="add-on"><a href="javascript:void(0)"><i class="icon-remove"></i></a></span>
						</div>
					</div>
				  </div>
				</div>
				<div class="control-group">

				  <!-- Text input-->
				  <label class="control-label" for="file">File</label>
				  <div class="controls">
					<input type="file"name="file" id="file" class="input-xlarge" multiple>
				  </div>
				</div>
				<div class="control-group">

				  <!-- Text input-->
				  <div class="controls">
					<input type="button" class="btn btn-success" value="Simpan"> <input type="button" class="btn closeBtn" value="Batal">
				  </div>
				</div>
				
			</fieldset>
		</form>
	</div>
  <form class="form-horizontal" name="template">
    <fieldset>
		<div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="name">Name</label>
          <div class="controls">
            <input type="text" name="name" id="name" class="input-xlarge" value="Nama template">
			<input type="hidden" name="oldName" value="Nama Template">
			<input type="hidden" name="type" value="1">
          </div>
        </div>
		<div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="description">Description</label>
          <div class="controls">
            <textarea name="description" id="description" class="input-xlarge">Deskripsi Template</textarea>
          </div>
        </div>
		<div class="control-group" id="fileContainer">

				  <!-- Text input-->
				  <div class="control-label">Tasks</div>
				  <div class="controls">
					<div name="field asd">
						<div class="input-prepend">
							<input type="hidden" name="field[]" value="asd"/>
							<span class="add-on">Task 1</span>
						</div>
						<div class="input-append">
							<span class="add-on"><a href="javascript:void(0)" onclick="editTask(this)" taskName="Task 1"><i class="icon-pencil"></i></a></span>
						</div>
						<div class="input-append">
							<span class="add-on"><a href="javascript:void(0)"><i class="icon-remove"></i></a></span>
						</div>
					</div>
					<div name="field def">
						<div class="input-prepend">
							<input type="hidden" name="field[]" value="asd"/>
							<span class="add-on">Task 2</span>
						</div>
						<div class="input-append">
							<span class="add-on"><a href="javascript:void(0)" onclick="editTask(this)" taskName="Task 2"><i class="icon-pencil"></i></a></span>
						</div>
						<div class="input-append">
							<span class="add-on"><a href="javascript:void(0)"><i class="icon-remove"></i></a></span>
						</div>
					</div>
				  </div>
				</div>
		<div class="control-group">
		<div class="controls">
			<input type="button" class="btn" value="Tambah Task" onclick="tambahTask()"/>
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