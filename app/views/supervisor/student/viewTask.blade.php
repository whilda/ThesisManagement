@extends('supervisor/student/layout')

@section('pageTitle')
	{{ $task['name'] }}
@stop

@section('task.nav') selected="selected" @stop
@section('task.menu') active @stop

@section('addResourceTop')
<style>
.comment-header{
	border-bottom: 2px dotted #6F3A3A;
}
</style>
<link rel="stylesheet" href="{{ URL::to('/') }}/app-css/task.css">
@stop

@section('addResource')
<style>
.alert.comment {
  padding: 8px 35px 8px 14px;
  margin-bottom: 20px;
  text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
  background: #fcf8e3;
  border: 1px solid #fbeed5;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
}
.alert, .alert h4 {
  color: #c09853;
}
.alert.alert-info.comment {
  background: #d9edf7;
  border-color: #bce8f1;
  color: #3a87ad;
}
.alert.alert-danger.comment, .alert.alert-error.comment {
  background: #f2dede;
  border-color: #eed3d7;
  color: #b94a48;
  text-shadow:0 1px 0 rgba(255, 255, 255, 0.5);;
}
.alert.alert-success.comment {
  background: #dff0d8;
  border-color: #d6e9c6;
  color: #468847;
}

</style>
<script src="{{ URL::to('/') }}/javascripts/overlay.js" type="text/javascript"></script>
<script src="{{ URL::to('/') }}/javascripts/task.js" type="text/javascript"></script>
<script src="{{ URL::to('/') }}/javascripts/jquery.form.min.js" type="text/javascript"></script>
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
function confirmDelTask(){
	$("#confirmText").html("Apakah anda yakin menghapus task ini?");
	$("#confirmYes").attr("onclick","delThisTask()");
	displayConfirm();
}
function delThisTask(){
	cancelConfirm();
	var model={
		"task":"{{ $task['id_task'] }}",
	}
	$.ajax({  
		type: 'POST',  
		url: '<?php echo URL::to('/'); ?>/student/{{ $data['_id']}}/task/del',
		data: JSON.stringify(model),  
		dataType: 'text',
		contentType: 'application/json',
		success: function(data){
			try{
				var output=JSON.parse(data);
				if(output.code==1){
					$("#notif").attr("class", "alert alert-success closeNotif");
					$("#notif").html("Sukses menghapus task");
					displayNotif();
					setTimeout(function(){ window.location.href="{{ URL::to('/student/'.$data['_id'].'/tasks') }}"; },500);
				}else{
					$("#notif").attr("class", "alert alert-error closeNotif");
					$("#notif").html("Gagal menghapus task");
					displayNotif();
				}
			}catch(err){
				$("#notif").attr("class", "alert alert-error closeNotif");
				$("#notif").html("Gagal menghapus task");
				displayNotif();
			}
		},  
		error: function(ex) {
			$("#notif").attr("class", "alert alert-error closeNotif");
			$("#notif").html("Gagal menghapus task");
			displayNotif();
		},  
		timeout:60000  
	});
}
function confirmValidation(){
	$("#confirmText").html("Apakah anda yakin mengubah status task ini?");
	$("#confirmYes").attr("onclick","validateTask()");
	displayConfirm();
}
function validateTask(){
	cancelConfirm();
	var model={
		"task":"{{ $task['id_task'] }}",
	}
	$.ajax({  
		type: 'POST',  
		url: '<?php echo URL::to('/'); ?>/student/{{ $data['_id']}}/task/validation',
		data: JSON.stringify(model),  
		dataType: 'text',
		contentType: 'application/json',
		success: function(data){
			try{
				var output=JSON.parse(data);
				if(output.code==1){
					$("#notif").attr("class", "alert alert-success closeNotif");
					$("#notif").html("Sukses");
					displayNotif();
					setTimeout(function(){ window.location.reload(); },500);
				}else{
					$("#notif").attr("class", "alert alert-error closeNotif");
					$("#notif").html("Gagal");
					displayNotif();
				}
			}catch(err){
				$("#notif").attr("class", "alert alert-error closeNotif");
				$("#notif").html("Gagal");
				displayNotif();
			}
		},  
		error: function(ex) {
			$("#notif").attr("class", "alert alert-error closeNotif");
			$("#notif").html("Gagal");
			displayNotif();
		},  
		timeout:60000  
	});
}
function editTask(button){
	if(!$("#tasks").is(":visible")){
		$('#judulTipe').html("Edit Task");
		button.disabled=true;
		$("#loading").show();
		$.ajax({  
			type: 'GET',  
			url: '<?php echo URL::to('/'); ?>/student/{{ $data["_id"]}}/task/{{ $task['id_task'] }}',
			contentType: 'application/json',
			success: function(data){
				try{
					var task=JSON.parse(data);
					document.task.name.value=task.name;
					document.task.description.value=task.description;
					$(document.task).prop("action","{{ URL::to('/student/'.$data['_id'].'/task/'.$task['id_task'].'/edit') }}");
					document.task.duration.value=task.duration;
					$('#fileContainer').html("");
					$('#delFile').html("");
					for(var i=0;i<task.file.length;i++){
						var element=document.createElement("div");
						var child1=document.createElement("div");
						child1.className="input-prepend";
						$(child1).html("<span class=\"add-on\">"+task.file[i].filename+"</span>");
						var child2=document.createElement("div");
						child2.className="input-append";
						$(child2).html("<span class=\"add-on\"><a href=\"javascript:void(0)\" fileID=\""+task.file[i].fileid+"\" onclick=\"confirmDelFile(this)\"><i class=\"icon-remove\"></i></a></span>");
						$(element).append(child1,child2);
						$("#fileContainer").append(element);
					}
					var file = $("#file");
					file.replaceWith(file.val('').clone(true));
					$("#loading").hide();
					$("#tasks").slideToggle();
				}catch(err){
					$("#loading").hide();
					$("#notif").attr("class", "alert alert-error closeNotif");
					$("#notif").html("Internal Server error");
					displayNotif();
				}
			},  
			error: function(ex) {
				$("#loading").hide();
				$("#notif").attr("class", "alert alert-error closeNotif");
				$("#notif").html("Koneksi error");
				displayNotif();
			},  
			timeout:60000  
		});
	}else{
		$("#loading").hide();
		$("#tasks").slideUp();
	}
}
$("#work").ajaxForm({
	dataType: 'json',
	beforeSubmit: function(a,f,o) {
		var file=document.work.elements["file[]"];
		if(file.files.length>0){
		}else{
			return false;
		}
		$(document.work.submitBtn).prop("disabled",true);
	},
	success: function(data) {
		if(data.code==1){
			$("#notif").attr("class", "alert alert-success closeNotif");
			$("#notif").html("Sukses menambah file");
			displayNotif();
			setTimeout(function(){ window.location.reload(); },500);
		}else{
			$("#notif").attr("class", "alert alert-error closeNotif");
			$("#notif").html("Gagal menambah file");
			displayNotif();
		}
		$(document.work.submitBtn).prop("disabled",false);
	},
	error: function(ex) {
		$("#notif").attr("class", "alert alert-error closeNotif");
		$("#notif").html("Gagal menambah file");
		displayNotif();
		$(document.work.submitBtn).prop("disabled",false);
	}  
});
$("#task").ajaxForm({
	dataType: 'json',
	beforeSubmit: function(a,f,o) {
		var name=document.task.name.value;
		var description=document.task.description.value;
		var duration=document.task.duration.value;
		var error="";
		if(name==""){
			error+="<li>Name tidak boleh kosong</li>";
		}
		if(description==""){
			error+="<li>Description tidak boleh kosong</li>";
		}
		if(duration!=""&&(isNaN(duration)||duration<0)){
			error+="<li>Duration harus berbentuk angka dan &gt0</li>";
		}
		if(error!=""){
			$("#notif").attr("class", "alert alert-error closeNotif");
			$("#notif").html("<ul>"+error+"</ul>");
			displayNotif();
			return false;
		}
		$(document.task.simpan).prop("disabled",true);
		$(document.task.batal).prop("disabled",true);
	},
	success: function(data) {
		if(data.code==1){
			$("#notif").attr("class", "alert alert-success closeNotif");
			$("#notif").html("Sukses merubah task");
			displayNotif();
			setTimeout(function(){ window.location.reload(); },500);
		}else{
			$("#notif").attr("class", "alert alert-error closeNotif");
			$("#notif").html("Gagal merubah task");
			displayNotif();
		}
		$(document.task.simpan).prop("disabled",false);
		$(document.task.batal).prop("disabled",false);
		$("#tasks").slideToggle();
	},
	error: function(ex) {
		$("#notif").attr("class", "alert alert-error closeNotif");
		$("#notif").html("Gagal merubah task");
		displayNotif();
		$(document.task.simpan).prop("disabled",false);
		$(document.task.batal).prop("disabled",false);
		$("#tasks").slideToggle();
	}  
});
</script>
@stop

@section('content')
	<br/>
	<div id="overlay" style="display:none"></div>
	<div id="overlayBox" class="offset3 span6" style="display:none">
		<div class="alert alert-success closeNotif" id="notif">
			<center><b></b></center>
		</div>
	</div>
	<div id="confirm" class="overlayBoxes offset3 span6" style="display:none">
		<div class="alert alert-warning notif">
			<center>
				<b id="confirmText"></b><br/>
				<input type="button" id="confirmYes" class="btn btn-success" value="Ya">
				<input type="button" class="btn btn-info" onclick="cancelConfirm()" value="Tidak">
			</center>
		</div>
	</div>
	<div id="tasks" style="display:none">
		<h2 id="judulTipe"></h2>
		<form class="form-horizontal overlay-content" name="task" id="task" action="" method="POST" enctype="multipart/form-data">
			<fieldset>
				<div class="control-group">

				  <!-- Text input-->
				  <label class="control-label" for="name">Name</label>
				  <div class="controls">
					<input type="text" name="name" id="name" class="input-xlarge">
				  </div>
				</div>
				<div class="control-group">

				  <!-- Text input-->
				  <label class="control-label" for="description">Description</label>
				  <div class="controls">
					<textarea name="description" id="description" class="input-xlarge"></textarea>
				  </div>
				</div>
				<div class="control-group">

				  <!-- Text input-->
				  <label class="control-label" for="duration">Duration</label>
				  <div class="controls">
					<input type="text" maxlength="3" name="duration" id="duration" class="input-small"> hari
				  </div>
				</div>
				<div class="control-group">

				  <!-- Text input-->
				  <div class="control-label">Files</div>
				  <div id="delFile"></div>
				  <div class="controls" id="fileContainer">
				  </div>
				</div>
				<div class="control-group">

				  <!-- Text input-->
				  <label class="control-label" for="file">File</label>
				  <div class="controls">
					<input type="file" name="file[]" id="file" class="input-xlarge" multiple>
				  </div>
				</div>
				<div class="control-group">

				  <!-- Text input-->
				  <div class="controls">
					<input type="submit" class="btn btn-success" name="simpan" value="Simpan"> <input type="button" class="btn closeBtn" name="batal" value="Batal">
				  </div>
				</div>
				
			</fieldset>
		</form>
	</div>
  <div class="well">
	<div style="float:right;"><img class="loading" id="loading" style="display:none" alt="loading" src="{{ URL::to('/') }}/images/loading-icons/loading8.gif"> <a href="#" onclick="editTask(this)" class="btn btn-info">Edit</a> <a href="#" onclick="confirmDelTask()" class="btn btn-info">Delete</a></div>
	<h2>{{ $task['name'] }}</h2>
	<table>
		<tbody>
			<tr>
				<td style="min-width:140px">Status :</td>
				<td>{{ ($task['status']==1)?"Done":"Ongoing" }} <button class="btn btn-info btn-mini" onclick="confirmValidation()">Change</button></td>
			</tr>
			<tr>
			<?php $date=new DateTime($task['created_date']['$date']); ?>
				<td>Created Date :</td>
				<td>{{ $date->format('M jS') }}</td>
			</tr>
			<tr>
				<td>End Date :</td>
				<td>{{ ($task['duration']>0)?$date->modify("+".$task['duration']." day")->format('M jS'):"???" }}</td>
			</tr>
		</tbody>
	</table>
	<hr/>
	Description:
	<p>
		{{ $task['description'] }}
	</p>
	File:
	<table class="table">
      <thead>
        <tr>
          <th class="span6">Name</th>
          <th class="span6">Upload Date</th>
        </tr>
      </thead>
       <tbody>
	   @if(count($task['file'])>0)
	   @foreach($task['file'] as $file)
	    <tr>
          <td><a href="#">{{ $file['filename'] }}</a></td>
          <td>{{ (new DateTime($file['upload_date']['$date']))->format("j F Y") }}</td>
        </tr>
		@endforeach
		@else
		<tr><td colspan="2"><center><i>-No Attachment-<i></center></td></tr>
		@endif
       </tbody>
    </table>
	<form name="work" id="work" action="{{ URL::to('/') }}/student/{{ $data['_id'] }}/task/{{ $task['id_task'] }}/creatework" method="POST" enctype="multipart/form-data">
		Tambah File: <input type="file" name="file[]"/><input name="submitBtn" type="submit" class="btn btn-primary" value="Tambah">
	</form>
  </div>
  <h2>Comments</h2>
  <div class="well">
	<h2 class="comment-header">Tambah Comment</h2>
	<form class="form-horizontal">
		<div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="type">Type</label>
          <div class="controls">
            <select name="type" id="type" class="input-xlarge">
				<option value="1">Instruct</option>
				<option value="2">Comment</option>
				<option value="3">Clarify</option>
				<option value="3">Ask</option>
			</select>
          </div>
        </div>
		<div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="alamat">Text</label>
          <div class="controls">
            <textarea name="alamat" id="alamat" class="input-xxlarge" rows="6">Komentar</textarea>
          </div>
        </div>
		<div class="control-group">
          <div class="controls">
            <input type="submit" class="btn btn-success" value="Add Comment">
          </div>
        </div>
	</form>
  </div>
  <div class="alert alert-info comment">
	<div class="comment-header">Comment by Username on 01-01-15</div><br/>
	<p>Komentar panjang....</p>
	<p><a href="#"><i class="icon-paper-clip"></i> asd.pdf</a></p>
  </div>
  <div class="alert alert-error comment">
	<div class="comment-header">Instruction by Username on 01-01-15</div><br/>
	<p>Komentar panjang....</p>
	<p><a href="#"><i class="icon-paper-clip"></i> asd.pdf</a></p>
  </div>
  <div class="alert alert-success comment">
	<div class="comment-header">Clarify by Username on 01-01-15</div><br/>
	<p>Komentar panjang....</p>
	<p><a href="#"><i class="icon-paper-clip"></i> asd.pdf</a></p>
  </div>
  <div class="alert alert-block comment">
	<div class="comment-header">Ask by Username on 01-01-15</div><br/>
	<p>Komentar panjang....</p>
	<p><a href="#"><i class="icon-paper-clip"></i> asd.pdf</a></p>
  </div>
@stop