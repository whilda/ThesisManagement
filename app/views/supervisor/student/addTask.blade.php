@extends('supervisor/student/layout')

@section('pageTitle')
	Add Task for {{ $data['name'] }}
@stop

@section('task.nav') selected="selected" @stop
@section('task.menu') active @stop

@section('addResourceTop')
<link rel="stylesheet" href="{{ URL::to('/') }}/app-css/task.css">
@stop

@section('addResource')
<script src="{{ URL::to('/') }}/javascripts/overlay.js" type="text/javascript"></script>
<script src="{{ URL::to('/') }}/javascripts/task.js" type="text/javascript"></script>
@stop

@section('content')
	<div id="overlay" style="display:none"></div>
	<div id="confirm" class="overlayBoxes offset3 span6" style="display:none">
		<div class="alert alert-warning notif">
			<center>
				<b id="confirmText"></b><br/>
				<input type="button" id="confirmYes" class="btn btn-success" value="Ya">
				<input type="button" class="btn btn-info" onclick="cancelConfirm()" value="Tidak">
			</center>
		</div>
	</div>
    <h2>Tambah Task untuk {{ $data['name'] }}</h2>
  <form class="form-horizontal">
    <fieldset>
			<div class="control-group">

				  <!-- Text input-->
				  <label class="control-label" for="taskName">Name</label>
				  <div class="controls">
					<input type="text" name="taskName" id="taskName" class="input-xlarge" value="Nama task">
					<input type="hidden" name="oldName" value="Nama task">
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
				<div class="control-group">

				  <!-- Text input-->
				  <div class="control-label">Files</div>
				  <div id="delFile"></div>
				  <div class="controls" id="fileContainer">
					<div>
						<div class="input-prepend">
							<span class="add-on">asd.png</span>
						</div><div class="input-append">
							<span class="add-on"><a href="javascript:void(0)" taskFile="1" onclick="confirmDelFile(this)"><i class="icon-remove"></i></a></span>
						</div>
					</div>
					<div>
						<div class="input-prepend">
							<span class="add-on">def.pdf</span>
						</div><div class="input-append">
							<span class="add-on"><a href="javascript:void(0)" taskFile="2" onclick="confirmDelFile(this)"><i class="icon-remove"></i></a></span>
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
          <!-- Button -->
          <div class="controls">
            <input type="submit" class="btn btn-success" value="Tambahkan"/>
			<input type="button" class="btn btn-info" value="Kembali" onclick="window.history.go(-1)"/>
          </div>
        </div>

    </fieldset>
  </form>
@stop